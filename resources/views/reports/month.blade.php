@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asistencia mensual</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="events-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Regimen</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Marcaciones</th>
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
    $('#events-table').DataTable({
        processing: true,
        language: { "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>' },
        serverSide: true,
        ajax: 'getMonth',
        columns: [
            { data: 'fecha', name: 'fecha', orderable: false, searchable: false},
            { data: 'regimen', name: 'regimen'},
            { data: 'dni', name: 'dni'},
            { data: 'name', name: 'name'},
            { data: 'marcas', name: 'marcas', orderable: false, searchable: false}

        ],
        order: [[1, 'asc']],
        columnDefs: [{
            targets: 1,
            className: 'dt-right'
        }]
    });
});
</script>


@endpush