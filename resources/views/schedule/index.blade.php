@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Horarios</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="employees-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Hora de entrada</th>                                
                                <th>Hora de Salida</th>
                                <th>Descanso</th>
                                <th>Salida Descanso</th>
                                <th>Regreso Descanso</th>                                
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
$(function() {
    $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'listSchedules',
        columns: [
            { data: 'name', name: 'name'},
            { data: 'entry_time', name: 'entry_time' },
            { data: 'exit_time', name: 'exit_time'},
            { data: 'hasBreak', name: 'hasBreak'},
            { data: 'break_out', name: 'break_out'},
            { data: 'break_return', name: 'break_return'},           
            
        ],
        order: [[1, 'asc']],
        columnDefs: [{
            targets: 0,
            className: 'dt-left'
        }]
    });
});
</script>


@endpush