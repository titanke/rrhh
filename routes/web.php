<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BiometricoController;
use App\Http\Controllers\VacacionesController;
use App\Http\Controllers\JustificacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('employees');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::resource('attendances', AttendanceController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('biometricos', BiometricoController::class);
    Route::resource('vacaciones', VacacionesController::class);
    Route::resource('justificaciones', JustificacionController::class);

    Route::post('storeCom', [JustificacionController::class, 'storeCom'])->name('storeCom');
    Route::get('getVacaciones', [VacacionesController::class, 'getVacaciones'])->name('getVacaciones');
    Route::get('getJustificaciones', [JustificacionController::class, 'getJustificaciones'])->name('getJustificaciones');

    Route::get('listBiometricos', [BiometricoController::class, 'listBiometricos'])->name('listBiometricos');
    Route::get('sincronizar/{idBiometrico}', [BiometricoController::class, 'sincronizar'])->name('sincronizar');

    Route::get('getEmployees', [EmployeeController::class, 'listEmployees'])->name('listEmployees');
    Route::get('listSchedules', [ScheduleController::class, 'listSchedules'])->name('listSchedules');
    Route::get('events', [AttendanceController::class, 'events'])->name('events');
    Route::get('getEvents', [AttendanceController::class, 'getEvents'])->name('getEvents');
    Route::get('today', [AttendanceController::class, 'today'])->name('today');
    Route::get('getToday', [AttendanceController::class, 'getToday'])->name('getToday');
    Route::get('at', [AttendanceController::class, 'at'])->name('at');

    Route::get('buscarEmpleado/{dni}', [EmployeeController::class, 'buscarEmpleado'])->name('buscarEmpleado');
    Route::get('borrarVacaciones/{idVacacion}', [VacacionesController::class, 'borrarVacaciones'])->name('vacaciones.borrar');
    Route::get('borrarJustificacion/{idJustificacion}', [JustificacionController::class, 'borrarJustificacion'])->name('justificacion.borrar');


    Route::get('noAttendance', [AttendanceController::class, 'noAttendance'])->name('noAttendance');
    Route::get('getNoAttendanceToday', [AttendanceController::class, 'getNoAttendanceToday'])->name('getNoAttendanceToday');

    Route::get('month', [AttendanceController::class, 'month'])->name('month');
    Route::get('getMonth', [AttendanceController::class, 'getMonth'])->name('getMonth');

    Route::get('month2', [AttendanceController::class, 'month2'])->name('month2');
    Route::get('getMonth2/{mes?}/{anio?}', [AttendanceController::class, 'getMonth2'])->name('getMonth2');
    Route::get('month3', [AttendanceController::class, 'month3'])->name('month3');

});


Route::get('/users2', [UserController::class, 'index2'])->name('users.index2');
