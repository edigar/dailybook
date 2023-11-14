<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $notes = DB::table('notes')->where('user_id', Auth::id())->when($search, function (Builder $query, string $search) {
            $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('content', 'LIKE', '%' . $search . '%');
        })->orderByDesc('updated_at')->get();

        return view('home')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {
        $note = $request->validated();
        $note['user_id'] = Auth::id();

        Note::create($note);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $noteId)
    {
        $note = Note::findOrFail($noteId);
        return view('edit_note')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, int $noteId)
    {
        $note = Note::findOrFail($noteId);
        $noteData = $request->validated();

        $note->title = $noteData['title'];
        $note->content = $noteData['content'];
        $note->save();

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $noteId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $noteId)
    {
        Note::destroy($noteId);

        return redirect('home');
    }
}
