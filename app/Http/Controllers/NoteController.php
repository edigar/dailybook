<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $notes = Note::where('user_id', Auth::id())->when($search, function (Builder $query, string $search) {
            $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('content', 'LIKE', '%' . $search . '%');
        })->orderByDesc('updated_at')->get();

        return view('home')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNoteRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNoteRequest $request): RedirectResponse
    {
        $note = $request->validated();
        $note['user_id'] = Auth::id();

        Note::create($note);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Note $post
     */
    public function show(Note $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $noteId
     * @return View
     */
    public function edit(int $noteId): View
    {
        $note = Note::findOrFail($noteId);
        return view('edit_note')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoteRequest $request
     * @param  int  $noteId
     * @return RedirectResponse
     */
    public function update(UpdateNoteRequest $request, int $noteId): RedirectResponse
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
     * @param  int  $noteId
     * @return RedirectResponse
     */
    public function destroy(int $noteId): RedirectResponse
    {
        Note::destroy($noteId);

        return redirect('home');
    }
}
