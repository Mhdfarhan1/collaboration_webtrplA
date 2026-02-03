<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/members', [MemberController::class, 'index'])->name('members');
Route::get('/search', [MemberController::class, 'searchMembers'])->name('members.search');

Route::get('/albums', function () {
    return view('albums');
})->name('albums');

Route::get('/albums/detail', function () {
    return view('albums-detail');
});
