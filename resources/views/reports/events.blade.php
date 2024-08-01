@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Eventos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="events-table">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Marcación</th>
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
        ajax: 'getEvents',
        columns: [
            { data: 'dni', name: 'dni', orderable: false, searchable: false},
            { data: 'NAME', name: 'NAME' },
            { data: 'timestamp', name: 'timestamp'}

        ],
        order: [[2, 'desc']],
        columnDefs: [{
            targets: 0,
            className: 'dt-right'
        }]
    });
});
</script>


@endpush