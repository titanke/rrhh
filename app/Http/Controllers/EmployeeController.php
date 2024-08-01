<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index');
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
            'dni' => 'required',
            'plastname' => 'required',
            'mlastname' => 'required',
            'name' => 'required',
            'position' => 'required',
            'regimen' => 'required',
        ]);
    
        $e = Employee::create($request->all());
    
        return json_encode($e);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function listEmployees(Request $request){        

        $data = DB::select('SELECT * FROM employees');        

        return Datatables::of($data)->make(true);
    }

    public function buscarEmpleado(Request $request){
        $empleado = Employee::where('dni',$request->dni)->first();
        return json_encode($empleado);
    }
}
