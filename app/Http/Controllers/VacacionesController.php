<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Vacacion;
use App\Models\Attendance;
use App\Models\Employee;

use DB;

class VacacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vacaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_employee' => 'required',
            'motivo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
        ]);
    
        $v = Vacacion::create($request->all());

        $insertVacacion = AttendanceController::insertVacaciones($v->id_employee, $v->fecha_inicio, $v->fecha_final, $v->id);
    
        return json_encode($v);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getVacaciones(){
        $data = DB::select('
        SELECT
            v.id, 
            e.dni, 
            CONCAT(e.plastname," ",e.mlastname, " ",e.name) as empleado, 
            v.motivo, 
            v.fecha_inicio,
            v.fecha_final
        FROM vacaciones AS v
        LEFT JOIN employees AS e ON(v.id_employee = e.id)');        

        return Datatables::of($data)->make(true);
    }

    public function borrarVacaciones(Request $request){
        $v = Vacacion::find($request->idVacacion);
        $e = Employee::find($v->id_employee);
        $a = Attendance::
            where('id',$e->dni)
            ->where('state', 33)
            ->where('type', $v->id)
            ->where('reloj', 'VACACIONES')
            ->delete();
        $v->delete();
    }
}
