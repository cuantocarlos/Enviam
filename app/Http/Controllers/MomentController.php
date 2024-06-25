<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MultimediaController;
use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MomentController extends Controller
{

    //Formulario de creación momento
    public function create()
    {
        //devolvemos una vista
        return view('moment.create');
    }

    public function createNewMoment(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'pics.*' => 'mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:100480',
        ]);
        $newMoment = new Moment;
        $newMoment->name = $request['name'];
        $newMoment->description = $request['description'];
        //if user not logged
        $userId = null;
        if (Auth::check()) {
            // El usuario está autenticado
            $userId = Auth::id();
        }
        $newMoment->user_id = $userId;
        $newMoment->save();
        if ($request->hasFile('pics')) { //if contains pics I send them to MultimediaController
            //envio las fotos a la función storeNew de MultimediaController
            $multimediaController = new MultimediaController;
            $request['moment_id'] = $newMoment->id;
            $multimediaController->create($request);
        }
        // return view('moment.show', compact('newMoment'));
        //necesito que redirija a /moment/{id} para que muestre el momento creado
        return Redirect::route('moment.show', ['id' => $newMoment->id]);
    }

    //Store de creación momento
    public function store(Request $request)
    {
        //devolvemos una vista
        $newMoment = new Moment;
        $newMoment->name = $request['name'];
        $newMoment->description = $request['description'];

        //if user not logged
        $userId = null;
        if (Auth::check()) {
            // El usuario está autenticado
            $userId = Auth::id();
        }
        $newMoment->user_id = $userId;

        $newMoment->save();

    }

    //el admin puede ver todos los momentos
    public function listAllMoments()
    {
        //todos los momentos
        $moments = Moment::all(); //por ahora cogemos todos, luego escogeremos lo del user logeado
        //devolvemos una vista
        //return view('moment.list');

        // return view('moments.list', ['moments' => $moments]);
        return view('adminAllMoments', compact('moments'));
        //compac crea un array con los mismos datos de
    }

    //all user moments
    public function userMoments()
    {
        $moments = Moment::where('user_id', Auth::id())->get();
        return view('dashboard', compact('moments'));
    }

    //Show the specific moment
    public function show($id)
    {
        $moment = Moment::find($id);

        if ($moment === null) {
            return view('moment.show', ['moment' => null, 'multimedia' => null]);
        }

        $multimedia = $moment->multimedia;
        return view('moment.show', ['moment' => $moment, 'multimedia' => $multimedia]);
    }

    // public function mostrarTodosMomentosPropios($id)//borrar
    // {
    //     $moment = Moment::find($id);
    //     $enviar = array(
    //         "moment" => $moment,
    //         'user_id' => $id,
    //     );
    //     dd($moment);
    //     return view('dashboard',$enviar);
    // }

    public function destroy($id)
    {
        // Search el "momento" por ID
        $moment = Moment::find($id);

        // Si el "momento" existe, eliminarlo
        $moment->delete();
        //eliminar la carpeta con las fotos
        Storage::deleteDirectory('public/moments/' . $id);
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('adminAllMoments');
        }

    }

    //Download files from a moment
    public function download($id)
    {
        $moment = Moment::find($id);
        $zip = new \ZipArchive();
        $zipFileName = $moment->name . '.zip';
        $zip->open(storage_path('app/public/moments/' . $zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($moment->multimedia as $multimedia) {
            $zip->addFile(storage_path('app/public/moments/' . $id . '/' . $multimedia->name), $multimedia->name);
        }
        $zip->close();
        return response()->download(storage_path('app/public/moments/' . $zipFileName));
    }
}
