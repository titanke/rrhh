@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
                </div>
                <div class="card-body">
                    <div class='row'>
                        <div class='col-12'>
                            <button class='btn btn-primary' data-toggle="modal" data-target="#newEmployeeModal"><i class='fas fa-plus-circle'></i> Nuevo</button>
                        </div>
                    </div>
                    <hr/>
                    <table class="table table-bordered table-striped" id="employees-table">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Nombres</th>
                                <th>Cargo</th>
                                <th>Régimen</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="newEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEmployeeModalLabel">Nuevo Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @include('employees.form_new_employee')
      <div id="message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="guardar_empleado">Guardar</button>
      </div>
    </div>
  </div>
</div>

@stop

@push('scripts')

<script>
var tablaEmployees = $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'getEmployees',
        columns: [
            { data: 'dni', name: 'dni', orderable: false, searchable: false},
            { data: 'plastname', name: 'plastname' },
            { data: 'mlastname', name: 'mlastname'},
            { data: 'name', name: 'name'},
            { data: 'position', name: 'position', orderable: false, searchable: false},
            { data: 'regimen', name: 'regimen', orderable: false, searchable: false},

        ],
        order: [[1, 'asc'], [2, 'asc'], [3, 'asc']],
        columnDefs: [{
            targets: 0,
            className: 'dt-right'
        }]
    });


$('#guardar_empleado').click( function() {
    if($('#dni').val() == "" || $('#plastname').val() == "" || $('#mlastname').val() == "" || $('#name').val() == "" || $('#position').val() == "" || $('#regimen').val() == ""){
        $('#message').html('<br/><div class="alert alert-danger" role="alert">Son necesarios completar todo los datos.</div>')
    }else{
        $('#message').html('');
        $.post( "{{route('employees.store')}}", $('#formEmployee').serialize(), function(data) {
            tablaEmployees.ajax.url('getEmployees').load();
            $('#newEmployeeModal').modal('hide');
            $(':input','#formJustificacion')
            .not(':button, :submit, :reset')
            .val('');
            $('#message').html('');
        },
        'json'
        );
    }
});

</script>



@endpush