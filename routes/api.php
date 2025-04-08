<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Estudiantes
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']); // Espacio extra eliminado
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::patch('/students/{id}', [StudentController::class, 'updatePartial']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/search', [StudentController::class, 'search']); // Ruta para búsqueda

//Profesores
Route::get('/teachers', [TeacherController::class, 'indexTeacher']);
Route::get('/teachers/{id}', [TeacherController::class, 'showTeacher']); // Espacio extra eliminado
Route::post('/teachers', [TeacherController::class, 'storeTeacher']);
Route::put('/teachers/{id}', [TeacherController::class, 'updateTeacher']);
Route::patch('/teachers/{id}', [TeacherController::class, 'updatePartialTeacher']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroyTeacher']);

/* Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
}); */