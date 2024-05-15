<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        
        //if user not logged
        $userId = null;
        if (Auth::check()) {
            // El usuario está autenticado
            $userId = Auth::id();
        }
        $newMoment->user_id = $userId;

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

        //Show the specific moment
        public function show($id)
        {
            $moment = Moment::find($id);
            return view('moment.show', compact('moment'));
        }

}
