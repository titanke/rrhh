@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resumen Asistencia</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <select class="form-control form-control-solid" id="yearSelector">
                                <option value='2024'>2024</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control form-control-solid" id="monthSelector">
                                <option value='1'>Enero</option>
                                <option value='2'>Febrero</option>
                                <option value='3'>Marzo</option>
                                <option value='4'>Abril</option>
                                <option value='5'>Mayo</option>
                                <option value='6'>Junio</option>
                                <option value='7'>Julio</option>
                                <option value='8'>Agosto</option>
                                <option value='9'>Setiembre</option>
                                <option value='10'>Octubre</option>
                                <option value='11'>Noviembre</option>
                                <option value='12'>Diciembre</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" type="button" onclick="recargarReporte();"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    
                    <hr/>
                    
                    <table class="table table-bordered table-striped" id="summary-table" style="font-size: 0.7em;">
                        <thead>                        
                            <tr>                                
                                <th>Reg.</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>01</th>
                                <th>02</th>
                                <th>03</th>
                                <th>04</th>
                                <th>05</th>
                                <th>06</th>
                                <th>07</th>
                                <th>08</th>
                                <th>09</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th>
                                <th>A</th>
                                <th>F</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')

<script>
    var tablaReporte = $('#summary-table').DataTable({
        processing: true,
        language: { "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>' },
        serverSide: true,
        ajax: 'getMonth2/'+$('#monthSelector').val()+'/'+$('#yearSelector').val(),
        columns: [ 
           
            { data: 'regimen', name: 'regimen', orderable: false},
            { data: 'dni', name: 'dni', orderable: false},
            { data: 'name', name: 'name'},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 1);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 2);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 3);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 4);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 5);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 6);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 7);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 8);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 9);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 10);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 11);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 12);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 13);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 14);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 15);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 16);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 17);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 18);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 19);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 20);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 21);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 22);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 23);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 24);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 25);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 26);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 27);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 28);                
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 29);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 30);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 31);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 32);
            }},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false, render: function(data, type, row){
                return evaluador(data, row.anio, row.mes, 33);
            }}
        ],
        
        order: [[2, 'asc']],
        columnDefs: [{
            targets: 1,
            className: 'dt-right'
        }],

        layout: {
        top2Start: {
            buttons: ['excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }]
            }
        }  

    });

function recargarReporte(){
    tablaReporte.ajax.url('getMonth2/'+$('#monthSelector').val()+'/'+$('#yearSelector').val()).load();
}

function evaluador(attendancesList, year, month, day){
    
    const attendances = attendancesList.split(",");
    const attencancesDay = [];
    var dayEvaluation = new Date(year, month-1, day);

    if(dayEvaluation > Date.now()){
        return "";
    }

    attendances.forEach(function(fecha){
        const date = new Date(fecha);                    
        if(date.getDate() == day){
            attencancesDay.push(fecha.substring(11,19));
        }
    });
    if(dayEvaluation.getMonth() != month-1){
        return "";
    }

    if(dayEvaluation.getDay() == 0 || dayEvaluation.getDay() == 6){
        if(attencancesDay.length >= 4){
        return "<span class='text-primary font-weight-bold' title='"+attencancesDay+"'>A</span>";
    }else{
        if(attencancesDay.length>0){
            return "<span class='text-danger font-weight-bold' title='"+attencancesDay+"'>F*</span>";
        }
        else{
            if(dayEvaluation.getDay() == 0){
            return "<span class='text-info font-weight-bold' title='"+attencancesDay+"'>D</span>";
        }
        else{
            return "<span class='text-info font-weight-bold' title='"+attencancesDay+"'>S</span>";
        }
        }
    }
    }
    if(attencancesDay.length >= 4){
        return "<span class='text-primary font-weight-bold' title='"+attencancesDay+"'>A</span>";
    }else{
        if(attencancesDay.length>0){
            return "<span class='text-danger font-weight-bold' title='"+attencancesDay+"'>F*</span>";
        }
        else{
            return "<span class='text-danger font-weight-bold' title='"+attencancesDay+"'>F</span>";
        }
    }
}
</script>


@endpush

