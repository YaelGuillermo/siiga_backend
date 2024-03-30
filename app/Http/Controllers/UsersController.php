<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();
        
        // Devolver la respuesta en formato JSON
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'first_surname' => 'required|string',
            'second_surname' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'neighborhood' => 'nullable|string',
            'street' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,user',
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Crear un nuevo usuario con los datos proporcionados
        $user = User::create($request->all());
        
        // Devolver la respuesta en formato JSON con el usuario creado
        return response()->json(['message' => 'User created successfully.', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar un usuario por su ID
        $user = User::findOrFail($id);
        
        // Devolver la respuesta en formato JSON
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buscar el usuario a actualizar por su ID
        $user = User::findOrFail($id);
        
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'first_surname' => 'string',
            'second_surname' => 'string',
            'date_of_birth' => 'date',
            'gender' => 'in:male,female,other',
            'neighborhood' => 'nullable|string',
            'street' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'string',
            'role' => 'string|in:admin,user',
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Actualizar los datos del usuario
        $user->update($request->all());
        
        // Devolver la respuesta en formato JSON con el usuario actualizado
        return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el usuario a eliminar por su ID
        $user = User::findOrFail($id);
        
        // Eliminar el usuario
        $user->delete();
        
        // Devolver una respuesta de éxito
        return response()->json(['message' => 'User deleted successfully.'], 204);
    }
}
