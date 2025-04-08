<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function indexTeacher()
    {
        $teacher = Teacher::all();

        $data1 = [
            'teacher' => $teacher,
            'status' => 200
        ];
        return response()->json($data1, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|in:1,2,3,4,5,6',
            'especialist' => 'required|in:Mathematics,Spanish,English'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'grade' => $request->grade,
            'especialist' => $request->especialist
        ]);

        if (!$teacher) {
            $data = [
                'message' => 'Error al crear el profesor',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'teacher' => $teacher,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'teacher' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $teacher->delete();

        $data = [
            'message' => 'Profesor eliminado correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|in:1,2,3,4,5,6',
            'especialist' => 'required|in:Mathematics,Spanish,English'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $teacher->update([
            'name' => $request->name,
            'grade' => $request->grade,
            'especialist' => $request->especialist
        ]);

        $data = [
            'teacher' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function updatePartial(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'grade' => 'sometimes|required|in:1,2,3,4,5,6',
            'especialist' => 'sometimes|required|in:Mathematics,Spanish,English'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $teacher->update($request->only(['name', 'grade', 'especialist']));

        $data = [
            'teacher' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function searchTeacher(Request $request)
    {
        $query = $request->get('query'); // Obtén el valor de búsqueda desde la solicitud
        $teachers = Teacher::where('id', $query) // Cambia 'id' por el campo que deseas buscar
            ->orWhere('name', 'LIKE', "%$query%") // Ejemplo: búsqueda por nombre
            ->get();

        if ($teachers->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron profesores',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'teachers' => $teachers,
            'status' => 200
        ], 200);
    }
}
