<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
            // Obtener el usuario autenticado
            $user = JWTAuth::user();

            $newToken = JWTAuth::customClaims(['user' => $user])->fromUser($user);

            return response()->json(compact('newToken'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    }



    public function create(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario'], 500);
        }
    }

    public function read(Request $request, $id)
    {
        Log::info('Este es un mensaje de información.');

        $user = User::findOrFail($id);

        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        try {
            $user = User::findOrFail($id);
            $user->update($request->all());

            return response()->json(['user' => $user], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al actualizar el usuario'], 500);
        }
    }



    public function delete(Request $request)
    {
        Log::info('Este es un mensaje de información DE.');
        $id = $request->input('id');
        
        try {
            $user = User::findOrFail($id);
            $user->delete();
            
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al eliminar el usuario'], 500);
        }
    }
}   
