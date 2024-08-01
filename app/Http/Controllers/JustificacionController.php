<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use DB;

class JustificacionController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('justificaciones.index');
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
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_final' => 'required',
            'justificacion' => 'required',
        ]);
    
        $j = Justificacion::create($request->all());

        $insertJustificacion = AttendanceController::insertJustificacion($j);
    
        return json_encode($j);
    }

    /**
     * Display the specified resource.
     */
    public function show(Justificacion $justificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Justificacion $justificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Justificacion $justificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Justificacion $justificacion)
    {
        //
    }

    public function getJustificaciones(){
        $data = DB::select('
        SELECT
            j.id, 
            e.dni, 
            CONCAT(e.plastname," ",e.mlastname, " ",e.name) as empleado, 
            j.justificacion, 
            j.fecha,
            j.hora_inicio,
            j.hora_final
        FROM justificaciones AS j
        LEFT JOIN employees AS e ON(j.id_employee = e.id)');        

        return Datatables::of($data)->make(true);    
    }

    public function borrarJustificacion(Request $request){
        $j = Justificacion::find($request->idJustificacion);
        $e = Employee::find($j->id_employee);
        $a = Attendance::
            where('id',$e->dni)
            ->where('state', 55)
            ->where('type', $j->id)
            ->where('reloj', 'JUSTIFICAC')
            ->delete();
        $j->delete();
    }
}
