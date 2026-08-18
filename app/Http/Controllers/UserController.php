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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.listAll')->with('success', 'Usuario eliminado correctamente');
    }
}
