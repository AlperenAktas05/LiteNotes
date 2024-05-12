<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [NoteController::class, 'index']) ->name("dashboard");

    Route::get("/app", [\App\Http\Controllers\NoteController::class, "app"]) -> name('app');

    Route::get("/notes", [\App\Http\Controllers\NoteController::class, "index"]) -> name('index');

    Route::get("/notes/createNote", [\App\Http\Controllers\NoteController::class, "createNote"]) -> name('createNote');

    Route::post("/notes/addNote", [\App\Http\Controllers\NoteController::class, "addNote"]) -> name('addNote');

    Route::get("/notes/{note}", [\App\Http\Controllers\NoteController::class, "noteDetails"]) -> name('noteDetails');

    Route::get("/notes/updateNote/{note}", [\App\Http\Controllers\NoteController::class, "updateNote"]) -> name('updateNote');

    Route::post("/notes/updateNote/updated/{note}", [\App\Http\Controllers\NoteController::class, "updatedNote"]) -> name('updatedNote');

    Route::get("notes/deleteNote/{note}", [\App\Http\Controllers\NoteController::class, "deleteNote"]) -> name('deleteNote');
});

