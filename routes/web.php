<?php

use App\Http\Controllers\MomentController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\ProfileController;
use App\Models\Moment;
use App\Models\Multimedia;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MomentController::class, 'userMoments'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


            //URL              //CONTROLADOR          //FUNCIÓN         //ALIAS
Route::get('/moment/create', [MomentController::class, 'create'])->name('moment.create');
Route::post('/moment/create', [MomentController::class, 'createNewMoment'])->name('moment.createNewMoment');
Route::post('/moment/store', [MomentController::class, 'store'])->name('moment.store');

// Route::get('/mostrarTodos', [MomentController::class, 'mostrarTodosMomentosPropios'])->name('moment.mostrarTodos');
//show moment for use at dashboard and for share moments
Route::get('/moment/{id}', [MomentController::class, 'show'])->name('moment.show');
//eliminar un momento
Route::delete('/moment/{id}', [MomentController::class, 'destroy'])->name('moment.destroy');
//All user moments


//guardo multimedia
Route::post('/multimedia/store', [MultimediaController::class, 'store'])->name('multimedia.store');
//descargar un multimedia4
Route::get('/multimedia/download/{id}', [MultimediaController::class, 'download'])->name('multimedia.download');
//eliminar un multimedia
Route::delete('/multimedia/{id}', [MultimediaController::class, 'destroy'])->name('multimedia.destroy');


//ADMIN
Route::middleware('admin')->group(function () {
//ver todas las fotos subidas
    Route::get('/admin/listAllMultimedia', [MultimediaController::class, 'listAll'])->name('multimedia.listAll');
//ver todos los momentos
    Route::get('/admin/moments', [MomentController::class, 'listAllMoments'])->name('moment.listAll');
});













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