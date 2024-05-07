<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\MultimediaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




//Moments



            //URL              //CONTROLADOR            //FUNCIÓN         //ALIAS
Route::get('/moment/create', [MomentController::class, 'create'])->name('moment.create');
Route::post('/moment/store', [MomentController::class, 'store'])->name('moment.store');

Route::get('/moments', [MomentController::class, 'list'])->name('moment.list');

//solo admin ver todas las fotos subidas 
Route::get('/admin/listAll', [MultimediaController::class, 'listAll'])->name('multimedia.listAll');
