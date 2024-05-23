<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multimedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MultimediaController extends Controller
{

    //si se acaba de crear un momento y se suben fotos
    public function create(Request $request)
    {
        $request->validate([
            'pics.*' => 'required|file|mimes:jpeg,heif,png,jpg,gif,svg|max:4072',
        ]);

        if ($request->hasFile('pics')) {
            $files = $request->file('pics');
            foreach ($files as $file) {
                // Genera un nombre único para cada archivo
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                
                // Guarda el archivo en el directorio especificado
                $file->storeAs('public/moments/'.$request['moment_id'], $fileName);

                
                // Crea y guarda la entrada en la base de datos
                $newMultimedia = new Multimedia;
                $newMultimedia->name = $fileName; // Guarda el nombre del archivo en la base de datos
                $newMultimedia->moment_id = $request['moment_id'];
                if (Auth::user()) {
                    $newMultimedia->user_id = Auth::user()->id;
                }
                $newMultimedia->save();
            }
        }
        // dd($request);
    }



        //Ya existe y hay que guardar fotos nuevas
    public function store(Request $request){

        $request->validate([
            'pics.*' => 'required|file|mimes:jpeg,heif,png,jpg,gif,svg|max:4072', // Ajustar según necesidades
        ]);


        if ($request->hasFile('pics')) {
            $files = $request->file('pics');
            foreach ($files as $file) {
                // Genera un nombre único para cada archivo
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                
                // Guarda el archivo en el directorio especificado
                $file->storeAs('public/moments/'.$request['moment_id'], $fileName);

                
                // Crea y guarda la entrada en la base de datos
                $newMultimedia = new Multimedia;
                $newMultimedia->name = $fileName; // Guarda el nombre del archivo en la base de datos
                $newMultimedia->moment_id = $request['moment_id'];
    
                // Recojo el ID del usuario de la sesión
                if (Auth::user()) {
                    $newMultimedia->user_id = Auth::user()->id;
                }
                
                $newMultimedia->save();
                
            }
            //redirect to the same moment
            return Redirect::route('moment.show', ['id' => $request->moment_id]);
            
        }
    }

    // public function download($id)
    // {
    //     $multimedia = Multimedia::findOrFail($id);

    //     $file_path = storage_path('app/public/moments/' . $multimedia->moment_id . '/' . $multimedia->name);

    //     return response()->download($file_path);
    // }



    //all multimedia content
    public function listAll(){
        $multimedia = Multimedia::orderBy('created_at', 'desc')->get();
        return view('multimedia.listAll', compact('multimedia'));
    }

}
