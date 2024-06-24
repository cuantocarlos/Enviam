<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MultimediaController extends Controller
{

    //si se acaba de crear un momento y se suben fotos
    public function create(Request $request)
    {
        $request->validate([
            'pics.*' => 'required|file|mimes:jpeg,heif,png,jpg,gif,svg|max:10072',
        ]);

        if ($request->hasFile('pics')) {
            $files = $request->file('pics');
            foreach ($files as $file) {
                // Genera un nombre único para cada archivo
                $originalName = $file->getClientOriginalName();
                $fileName = $originalName;

                // Verificar si el archivo ya existe en la carpeta de destino
                $counter = 1;
                while (Storage::exists("public/moments/{$request['moment_id']}/{$fileName}")) {
                    // Cambiar el nombre solo si ya existe otro archivo con el mismo nombre
                    $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $counter . '.' . $file->getClientOriginalExtension();
                    $counter++;
                }

                // Guardar el archivo en el directorio especificado
                $file->storeAs("public/moments/{$request['moment_id']}", $fileName);

                // Crear y guardar la entrada en la base de datos
                $newMultimedia = new Multimedia;
                $newMultimedia->name = $fileName; // Guardar el nombre del archivo en la base de datos
                $newMultimedia->moment_id = $request['moment_id'];
                if (Auth::user()) {
                    $newMultimedia->user_id = Auth::user()->id;
                }
                $newMultimedia->save();
            }
        }
        // Redirigir o devolver una respuesta según lo necesario
    }

    //Ya existe el Momento y hay que guardar fotos nuevas
    public function store(Request $request)
    {
        $request->validate([
            'pics.*' => 'required|file|mimes:jpeg,heif,png,jpg,gif,svg|max:10072',
        ]);

        if ($request->hasFile('pics')) {
            $files = $request->file('pics');
            foreach ($files as $file) {
                // Obtener el nombre original del archivo
                $originalName = $file->getClientOriginalName();
                $fileName = $originalName;

                // Verificar si el archivo ya existe en la carpeta de destino
                $counter = 1;
                while (Storage::exists("public/moments/{$request['moment_id']}/{$fileName}")) {
                    // Cambiar el nombre solo si ya existe otro archivo con el mismo nombre
                    $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $counter . '.' . $file->getClientOriginalExtension();
                    $counter++;
                }

                // Guardar el archivo en el directorio especificado
                $file->storeAs("public/moments/{$request['moment_id']}", $fileName);

                // Crear y guardar la entrada en la base de datos
                $newMultimedia = new Multimedia;
                $newMultimedia->name = $fileName; // Guardar el nombre del archivo en la base de datos
                $newMultimedia->moment_id = $request['moment_id'];

                // Recojo el ID del usuario de la sesión
                if (Auth::user()) {
                    $newMultimedia->user_id = Auth::user()->id;
                }

                $newMultimedia->save();
            }

            // Redireccionar al momento específico
            return redirect()->route('moment.show', ['id' => $request->moment_id]);
        }
    }

    public function download($id)
    {
        $multimedia = Multimedia::findOrFail($id);

        $file_path = storage_path('app/public/moments/' . $multimedia->moment_id . '/' . $multimedia->name);

        return response()->download($file_path);
    }

    //all multimedia content
    public function listAll()
    {
        $multimedia = Multimedia::orderBy('created_at', 'desc')->get();
        return view('multimedia.listAll', compact('multimedia'));
    }

    //delete multimedia
    public function destroy($id)
    {
        $multimedia = Multimedia::find($id);
        //$multimedia->delete();
        //delete file
        // dd($multimedia);

        $filePath = 'moments/' . $multimedia->moment_id . '/' . $multimedia->name;
        // Storage::delete('public/moments/' . $multimedia->moment_id . '/' . $multimedia->name);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        //llevo otra vez al mismo momento
        // return Redirect::route('moment.show', ['id' => $multimedia->moment_id]);
        return \response()->json(['success' => 'Multimedia deleted']);
    }
}
