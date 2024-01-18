<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/cadastrar', [UserController::class, 'create'])->name('get.register');
Route::post('/cadastrar', [UserController::class, 'store'])->name('post.register');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [NoteController::class, 'index'])->name('home');

    Route::post('/nota', [NoteController::class, 'store'])->name('post.note');
    Route::get('/nota/{noteId}', [NoteController::class, 'edit'])->name('edit.note');
    Route::put('/nota/{noteId}', [NoteController::class, 'update'])->name('update.note');
    Route::delete('/nota/{noteId}', [NoteController::class, 'destroy'])->name('delete.note');

    Route::get('/perfil', [UserController::class, 'edit'])->name('profile');
    Route::patch('/usuario', [UserController::class, 'update'])->name('update.user');
    Route::patch('/usuario/imagem', [UserController::class, 'updateImage'])->name('update.user-image');
    Route::get('usuario/alterar-senha', [UserController::class, 'editPassword'])->name('edit.password');
    Route::patch('usuario/alterar-senha', [UserController::class, 'updatePassword'])->name('update.password');
    Route::delete('usuario', [UserController::class, 'destroy'])->name('delete.user');
});
