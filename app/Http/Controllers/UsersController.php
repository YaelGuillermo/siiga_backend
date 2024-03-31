<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $rules;
    protected $errorMessages;

    public function __construct()
    {
        $this->rules = [
            'name' => 'required|string|regex:/^((?!\s{5}).)*$/',
            'first_surname' => 'required|string|regex:/^((?!\s{3}).)*$/',
            'second_surname' => 'required|string|regex:/^((?!\s{3}).)*$/',
            'date_of_birth' => 'required|date|after_or_equal:2006-01-01',
            'gender' => 'required|in:Male,Female',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'phone_number' => 'required|string|regex:/^[0-9 -]{10,13}$/',
            'photo' => 'nullable|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'email_verified_at' => 'nullable|date',
            'role' => 'required|in:Parent,Administrator',
            'status' => 'required|boolean',
        ];

        $this->errorMessages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'first_surname.required' => 'The first surname field is required.',
            'first_surname.string' => 'The first surname must be a string.',
            'second_surname.required' => 'The second surname field is required.',
            'second_surname.string' => 'The second surname must be a string.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The gender must be Male or Female.',
            'neighborhood.required' => 'The neighborhood field is required.',
            'neighborhood.string' => 'The neighborhood must be a string.',
            'street.required' => 'The street field is required.',
            'street.string' => 'The street must be a string.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'The phone number must be a string.',
            'photo.string' => 'The photo must be a string.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'email_verified_at.date' => 'The email verified at must be a valid date.',
            'role.required' => 'The role field is required.',
            'role.in' => 'The role must be Parent or Administrator.',
            'active.required' => 'The active field is required.',
            'active.boolean' => 'The active must be true or false.',
        ];
    }

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
        $validator = Validator::make($request->all(), $this->rules, $errorMessages);

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
        $validator = Validator::make($request->all(), $this->rules, $errorMessages);

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
