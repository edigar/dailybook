<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserImageRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
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
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit(): View
    {
        $user = User::findOrFail(Auth::id());

        return view('profile')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request): RedirectResponse
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
     * Update the user image.
     *
     * @param UpdateUserImageRequest $request
     * @return RedirectResponse
     */
    public function updateImage(UpdateUserImageRequest $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::id());
        $userData = $request->validated();

        if(isset($userData['image'])) {
            Storage::disk('local')->put("public/profile", $userData['image']);
            if(!empty($user->image)) {
                Storage::delete($user->image);
            }
        }

        $user->image = 'public/profile/' . $userData['image']->hashName();

        $user->save();

        return redirect('/perfil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        User::destroy(Auth::id());

        return redirect('/logout');
    }

    /**
     * Show the form for editing password.
     *
     * @return View
     */
    public function editPassword(): View
    {
        return view('edit_password');
    }

    /**
     * Update password.
     *
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
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
