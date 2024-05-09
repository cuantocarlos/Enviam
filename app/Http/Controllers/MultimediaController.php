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


    //all multimedia content
    public function listAll(){
        $multimedia = Multimedia::orderBy('created_at', 'desc')->get();
        return view('multimedia.listAll', compact('multimedia'));
    }

}
