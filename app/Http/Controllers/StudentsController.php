<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function index()
    {
        // Obtener todos los estudiantes
        $students = Student::all();
        
        // Devolver la respuesta en formato JSON
        return response()->json($students);
    }

    public function show($id)
    {
        // Buscar un estudiante por su ID
        $student = Student::findOrFail($id);
        
        // Devolver la respuesta en formato JSON
        return response()->json($student);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'first_surname' => 'required|string',
            'second_surname' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'curp' => 'required|string|max:18|regex:/^[A-Za-z]{4}\d{6}[H,M][A-Za-z]{5}[A-Za-z0-9]{2}\d$/',
            'blood_type' => 'required|string',
            'photo' => 'nullable|string',
            'birth_certificate' => 'nullable|string',
            'user_id' => 'required|exists:users,id' // Asumiendo que hay una relación con la tabla de usuarios
        ], [
            'curp.regex' => 'The CURP format is invalid.'
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Crear un nuevo estudiante con los datos proporcionados
        $student = Student::create($request->all());
        
        // Devolver la respuesta en formato JSON con el estudiante creado
        return response()->json(['message' => 'Student created successfully.', 'student' => $student], 201);
    }

    public function update(Request $request, $id)
    {
        // Buscar el estudiante a actualizar por su ID
        $student = Student::findOrFail($id);
        
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'first_surname' => 'string',
            'second_surname' => 'string',
            'date_of_birth' => 'date',
            'gender' => 'in:male,female,other',
            'curp' => 'string|max:18|regex:/^[A-Za-z]{4}\d{6}[H,M][A-Za-z]{5}[A-Za-z0-9]{2}\d$/',
            'blood_type' => 'string',
            'photo' => 'nullable|string',
            'birth_certificate' => 'nullable|string',
            'user_id' => 'exists:users,id' // Asumiendo que hay una relación con la tabla de usuarios
        ], [
            'curp.regex' => 'The CURP format is invalid.'
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Actualizar los datos del estudiante
        $student->update($request->all());
        
        // Devolver la respuesta en formato JSON con el estudiante actualizado
        return response()->json(['message' => 'Student updated successfully.', 'student' => $student], 200);
    }

    public function destroy($id)
    {
        // Buscar el estudiante a eliminar por su ID
        $student = Student::findOrFail($id);
        
        // Eliminar el estudiante
        $student->delete();
        
        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Student deleted successfully.'], 204);
    }
}
