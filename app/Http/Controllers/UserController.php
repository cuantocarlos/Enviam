<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    // listar todos los usuarios para el panel de administracion
    public function listAllUsers()
    {
        $users = User::all();

        return view('adminAllUsers', compact('users'));
    }

    public function destroy($id)
    {
        // Evitar que el admin se elimine a sí mismo
        if (auth()->id() === (int)$id) {
            return redirect()->route('users.listAll')->with('error', 'No puedes eliminar tu propia cuenta');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.listAll')->with('success', 'Usuario eliminado correctamente');
    }
}
