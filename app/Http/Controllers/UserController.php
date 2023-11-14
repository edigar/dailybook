<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::findOrFail(Auth::id());

        return view('profile')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $userData = $request->validated();

        if(!Hash::check($userData['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ]);
        }

        $anotherUser = User::select('email')->where('email', $userData['email'])->where('id', "<>", Auth::id())->get();

        if($anotherUser->isNotEmpty()) {
            return back()->withErrors([
                'email' => 'E-mail já cadastrado.',
            ])->onlyInput('name', 'email');
        }

        $user->name = $userData['name'];
        $user->email = $userData['email'];

        $user->save();

        return redirect('/perfil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        User::destroy(Auth::id());

        return redirect('/logout');
    }

    /**
     * Show the form for editing password.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('edit_password');
    }

    /**
     * Update password.
     *
     * @param \App\Http\Requests\UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $passwords = $request->validated();

        if(!Hash::check($passwords['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ]);
        }

        $user->password = Hash::make($passwords['new_password']);

        $user->save();

        return redirect('/perfil');
    }
}
