<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\MultimediaController;
use App\Models\Moment; 
use App\Models\User; 
use App\Models\Multimedia; 



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


//moment/5 -> datos del momento 1
Route::get('/moment/{id}', [MomentController::class, 'show'])->name('moment.show');


//solo admin ver todas las fotos subidas 
Route::get('/admin/listAll', [MultimediaController::class, 'listAll'])->name('multimedia.listAll');

//guardo multimedia
Route::post('/multimedia/store', [MultimediaController::class, 'store'])->name('multimedia.store');












Route::get('/test', function () {
    
    $multi2 = new Multimedia;
    $multi2->name = "mult2";
    $multi2->moment_id = 1;
    $multi2->user_id = 1;
    $multi2->save();   

    $multimedia = Multimedia::find(1);
    $multimedia->user;
    
    dd($multimedia->user->nick);




    $user = User::find(1);
    dd($user->moments);
    //dd($moment->multimedia[0]->name);

    $multimedia = Multimedia::find(1);
    $moment = $multimedia->moment;
    dd($moment);

    dd(0);

    //creamos el momento 1

    $multi1 = new Multimedia;
    $multi1->name = "mult1";
    $multi1->moment_id = 1;
    $multi1->save();

    //creamos el momento 2

    $multi2 = new Multimedia;
    $multi2->name = "mult2";
    $multi2->moment_id = 1;
    $multi2->save();   

    //    $moment = Moment::find(1);
    //$user = $moment->user;
    //
    //dd($user->name);


});