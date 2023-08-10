<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{

	public function showUserList()
	{
	    $users = User::all();
	    return view('user-list', ['users' => $users]);
	}

	public function delete($id)
	{
	    try {
	        $user = User::findOrFail($id);
	        $user->delete();

	        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
	    } catch (ModelNotFoundException $e) {
	        return response()->json(['error' => 'Usuario no encontrado'], 404);
	    } catch (\Exception $e) {
	        return response()->json(['error' => 'Ocurrió un error al eliminar el usuario'], 500);
	    }
	}

	public function edit($id)
	{
	    $user = User::findOrFail($id);
	    return view('edit-user', ['user' => $user]);
	}

	public function update(Request $request, $id)
	{
	    $user = User::findOrFail($id);

	    try {
	        $user->update($request->all());
	    } catch (\Exception $e) {
	        return response()->json(['error' => 'Ocurrió un error al actualizar el usuario'], 500);
	    }

	    return response()->json(['user' => $user], 200);
	}


	public function create()
	{
	    return view('create-user');
	}
}