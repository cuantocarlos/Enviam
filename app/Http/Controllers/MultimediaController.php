<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multimedia;

class MultimediaController extends Controller
{
    public function store(Request $request){
        $newMultimedia = new Multimedia;
        $newMultimedia->name=$request['name'];
        $newMultimedia->save();
    }


    //todos el contenido multimedia
    public function listAll(){
        $multimedia = Multimedia::all();
        return view('multimedia.listAll', compact('multimedia'));
    }
}
