<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

use Rats\Zkteco\Lib\ZKTeco;
use Yajra\Datatables\Datatables;

use App\Models\Employee;
use App\Models\Justificacion;
use App\Models\Schedule;
use Illuminate\Support\Facades\Cache;

use DateTime;
use DateTimeZone;
use DateInterval;


use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
    
    public static function insertJustificacion(Justificacion $jus){
        $horario = Schedule::find(1);
        $empleado = Employee::find($jus->id_employee);

        $he = new DateTime($jus->fecha." ".$horario->entry_time);
        $hs = new DateTime($jus->fecha." ".$horario->exit_time);

        $hba = new DateTime($jus->fecha." ".$horario->break_out);
        $hbb = new DateTime($jus->fecha." ".$horario->break_return);

        $ji = new DateTime($jus->fecha." ".$jus->hora_inicio);
        $jf = new DateTime($jus->fecha." ".$jus->hora_final);

        
        if($ji <= $he){
            $t3 = Attendance::firstOrCreate(
                ['id' => intval($empleado->dni),
                'state' => '55', // 55 JUSTIFICACION
                'timestamp' => $jus->fecha.' '.$horario->entry_time,
                'type' => $jus->id,
                'reloj' => 'JUSTIFICAC']);
        }

        if($jf >= $hs){
            $t4 = Attendance::firstOrCreate(
                ['id' => intval($empleado->dni),
                'state' => '55', // 55 JUSTIFICACION
                'timestamp' => $jus->fecha.' '.$horario->exit_time,
                'type' => $jus->id,
                'reloj' => 'JUSTIFICAC']);
        }

        // 8.25 8.00 / 8.25 13:00 / 17:30 17:30 / 17.30 14:30

        if($ji > $he && $ji < $hba && $jf <= $hs && $jf > $hbb){
            $t1 = Attendance::firstOrCreate(
                ['id' => intval($empleado->dni),
                'state' => '55', // 55 JUSTIFICACION
                'timestamp' => $jus->fecha.' '.$horario->break_out,
                'type' => $jus->id,
                'reloj' => 'JUSTIFICAC']);
            
            $t2 = Attendance::firstOrCreate(
                ['id' => intval($empleado->dni),
                'state' => '55', // 55 JUSTIFICACION
                'timestamp' => $jus->fecha.' '.$horario->break_return,
                'type' => $jus->id,
                'reloj' => 'JUSTIFICAC']);
        }

    }

    public static function insertJustificacion2($id_empleado, $fecha_inicio, $fecha_final, $id){
        $empleado = Employee::find($id_empleado);
        $horario = Schedule::find(1);

        for($fi = new DateTime($fecha_inicio); $fi <= new DateTime($fecha_final); $fi->add(new DateInterval('P1D'))) {
            $ha = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '55', 
                'timestamp' => $fi->format('Y-m-d').' 08:00:00',
                'type' => $id,
                'reloj' => 'JUSTIFICAC']);
            $hd = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '55',
                'timestamp' => $fi->format('Y-m-d').' 17:30:00',
                'type' => $id,
                'reloj' => 'JUSTIFICAC']);
        }
    }
    
    public static function insertVacaciones($id_empleado, $fecha_inicio, $fecha_final, $idVacacion){
        $empleado = Employee::find($id_empleado);

        for($fi = new DateTime($fecha_inicio); $fi <= new DateTime($fecha_final); $fi->add(new DateInterval('P1D'))){
            
            $ha = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '33', // 33 VACACION
                'timestamp' => $fi->format('Y-m-d').' 08:00:00',
                'type' => $idVacacion,
                'reloj' => 'VACACIONES']);
            
            $hb = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '33', // 33 VACACION
                'timestamp' => $fi->format('Y-m-d').' 13:00:00',
                'type' => $idVacacion,
                'reloj' => 'VACACIONES']);
            
            $hc = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '33', // 33 VACACION
                'timestamp' => $fi->format('Y-m-d').' 14:30:00',
                'type' => $idVacacion,
                'reloj' => 'VACACIONES']);
            
            $hd = Attendance::create(
                ['id' => intval($empleado->dni),
                'state' => '33', // 33 VACACION
                'timestamp' => $fi->format('Y-m-d').' 17:30:00',
                'type' => $idVacacion,
                'reloj' => 'VACACIONES']);
        }
    }
    
    public function events(){
        return view('reports.events');
    }

    public function getEvents(Request $request){

        $data = DB::select('SELECT e.dni, CONCAT(e.plastname," ",e.mlastname,", ",e.name) NAME, a.timestamp FROM attendances as a 
        inner join employees as e ON (CAST(e.dni AS UNSIGNED) = CAST(a.id AS UNSIGNED))');        

        return Datatables::of($data)->make(true);
    }

    public function today(){
        return view('reports.today');
    }

    public function month(){
        return view('reports.month');
    }

    public function getToday(Request $request)
    {
        $data = DB::select('SELECT 
                e.dni,
                CONCAT(e.plastname," ",e.mlastname,", ",e.name) NAME, 
                GROUP_CONCAT(TIME(a.TIMESTAMP) SEPARATOR ", ") marcas 
            FROM employees AS e
            LEFT JOIN attendances AS a ON (CAST(e.dni AS UNSIGNED) = CAST(a.id AS UNSIGNED) AND DATE(a.TIMESTAMP) = DATE(CURTIME()))
            GROUP BY e.dni, e.plastname, e.mlastname, e.name');

        return Datatables::of($data)->make(true);
    }

    public function noAttendance(){
        return view('reports.noAttendanceToday');
    }

    public function getNoAttendanceToday(Request $request)
    {
        $data = DB::select('SELECT 
                e.dni,
                e.regimen,
                CONCAT(e.plastname," ",e.mlastname,", ",e.name) NAME, 
                GROUP_CONCAT(TIME(a.TIMESTAMP) SEPARATOR ", ") marcas 
            FROM employees AS e
            LEFT JOIN attendances AS a ON (CAST(e.dni AS UNSIGNED) = CAST(a.id AS UNSIGNED) AND DATE(a.TIMESTAMP) = DATE(CURTIME()))
            GROUP BY e.dni, e.plastname, e.mlastname, e.name, e.regimen
            HAVING COUNT(a.timestamp) = 0');

        return Datatables::of($data)->make(true);
    }


    public function getMonth(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $dni = $request->input('dni');

    $data = DB::select('SELECT 
        e.dni,
        DATE(a.timestamp) fecha,
        CONCAT(e.plastname," ",e.mlastname,", ",e.name) name,
        e.regimen, 
        IFNULL(GROUP_CONCAT(TIME(a.TIMESTAMP) SEPARATOR ", "), 0) marcas
    FROM employees AS e 
    LEFT JOIN attendances AS a ON (CAST(e.dni AS UNSIGNED) = CAST(a.id AS UNSIGNED) AND DATE(a.TIMESTAMP) BETWEEN "'.$startDate.'" AND "'.$endDate.'")
    WHERE e.dni = "'.$dni.'"
    GROUP BY e.dni, DATE(a.TIMESTAMP),e.plastname, e.mlastname, e.name, e.regimen');
    return Datatables::of($data)->make(true);
    }

    public function month2(Request $request){
        return view('reports.month2');
    }

    public function getMonth2(Request $request)
    {
        $year = $request->anio;
        $month = $request->mes;
    
    
        $data = DB::select('SELECT 
                e.dni,
                CONCAT(e.plastname," ",e.mlastname,", ",e.name) name,
                e.regimen,
                "'.$year.'" anio,
                "'.$month.'" mes, 
            IFNULL(
                GROUP_CONCAT(
                    CASE
                        WHEN a.reloj = "JUSTIFICAC" THEN CONCAT(a.TIMESTAMP, "J")
                        WHEN a.reloj = "VACACIONES" THEN CONCAT(a.TIMESTAMP, "V")
                        ELSE a.TIMESTAMP
                    END SEPARATOR ","
                ),
                ""
            ) AS marcas            
            FROM employees AS e
            LEFT JOIN attendances AS a 
                ON (
                    CAST(e.dni AS UNSIGNED) = CAST(a.id AS UNSIGNED) 
                    AND MONTH(a.TIMESTAMP) = "'.$month.'" 
                    AND YEAR(a.TIMESTAMP) = "'.$year.'")            
            GROUP BY e.dni, e.plastname, e.mlastname, e.name, e.regimen');
    
        return Datatables::of($data)->make(true);
    }

    public function month3(Request $request){
        return view('reports.month3');
    }
}
