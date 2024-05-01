<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Moment;


class MomentController extends Controller
{
    //si esta registrado hacer un listado de los momentos del usuario 


    public function list(){

        //todos los momentos
        $moments = Moment::all();  

        //solo escogemos un momento
        $moment = Moment::whereId(2)->get();

        $momentPepe = Moment::whereName('pepe')->get();
        

        dd($momentPepe);

    }




    public function create(){

        // Crear un nuevo momento
        $moment = new Moment();
        $moment->name = 'Ejemplo de Momento';
        $moment->description = 'Este es un momento de ejemplo creado en Laravel.';
        $moment->link = 'www.google.com'; // Fecha y hora actual
        $moment->pin = 12345;
        $moment->save();

    }





}

