<?php

namespace App\Http\Controllers;

use App\Models\Biometrico;
use Illuminate\Http\Request;

use Rats\Zkteco\Lib\ZKTeco;
use Yajra\Datatables\Datatables;

use DB;

class BiometricoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('biometrico.index');
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
    public function show(Biometrico $biometrico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biometrico $biometrico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biometrico $biometrico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biometrico $biometrico)
    {
        //
    }

    public function listBiometricos(){
        $data = Biometrico::all();
        return Datatables::of($data)->make(true);
    }

    public function sincronizar(Request $request){

        $biometrico = Biometrico::find($request->idBiometrico);


        $zk = new ZKTeco($biometrico->ip,$biometrico->puerto);
        $log = "";

        if($zk->connect()){
            $log.="---------------------------------<br/>";
            $log.= date('d-m-Y H:i:s').":- CONECTANDO ".$biometrico->nombre."<br/>";
            $zk->disableDevice();  
            $attendances = $zk->getAttendance($biometrico->nombre);
            $data = 0;
            foreach (array_chunk($attendances,1000) as $a){
                $data += DB::table('attendances')->insertOrIgnore($a);
            }
            $log.= date('d-m-Y H:i:s').":-Se insertaron: ".$data." registros.<br/>";
            //$zk->clearAttendance(); 
            $biometrico->eventos = $data;
            $biometrico->sync = date('Y-m-d H:i:s');

            $biometrico->save();

            $zk->setTime(date('Y-m-d H:i:s'));

            $zk->enableDevice();
        }else{
            $log = $log."LOG: No se pudo conectar a ".$biometrico->nombre."<br/>";
        }

        return $log;
    }
}
