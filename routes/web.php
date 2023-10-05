<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

include_once 'auth.php';

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile', [ProfileController::class, 'update']);

    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('super.admin');

    Route::get('users/datatable', [UserController::class, 'datatable'])
        ->name('users.datatable');

    Route::resource('notes', NoteController::class)
        ->except(['create', 'show', 'edit', 'destroy']);

    Route::get('notes/create', [NoteController::class, 'create'])
        ->name('notes.create')
        ->middleware('customer.service');

    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])
        ->name('notes.edit')
        ->middleware('note.access');

    Route::put('/notes/{note}/reactivate', [NoteController::class, 'reactivate'])
        ->name('notes.reactivate')
        ->middleware('note.reactivate');

    Route::put('/notes/{note}/destroy', [NoteController::class, 'destroy'])
        ->name('notes.destroy')
        ->middleware('note.destroy');

    Route::get('notes/datatable', [NoteController::class, 'datatable'])
        ->name('notes.datatable');
});
