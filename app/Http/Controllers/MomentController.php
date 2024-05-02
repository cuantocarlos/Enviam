<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Illuminate\Http\Request;

class MomentController extends Controller
{

    //Formulario de creación momento
    public function create()
    {
        //devolvemos una vista
        return view('moment.create');
    }

    //Store de creación momento
    public function store(Request $request)
    {
        //devolvemos una vista
        $newMoment = new Moment;
        $newMoment->name=$request['name'];
        $newMoment->description=$request['description'];
        $newMoment->save();

        //dd($newMoment);
    }



        //si esta registrado hacer un listado de los momentos del usuario

        public function list()
        {
            //todos los momentos
            $moments = Moment::all(); //por ahora cogemos todos, luego escogeremos lo del user logeado
            //devolvemos una vista
            //return view('moment.list');
            
           // return view('moments.list', ['moments' => $moments]);
            return view('moment.list', compact('moments'));
            //compac crea un array con los mismos datos de 
        }
    

}
