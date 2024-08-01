@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Justificaciones</h6>
                </div>
                <div class="card-body">
                    <div class='row'>
                        <div class='col-12'>
                            <button class='btn btn-primary' data-toggle="modal" data-target="#newJustificacionModal"><i class='fas fa-plus-circle'></i> Nuevo</button>
                        </div>
                    </div>
                    <hr/>
                    <table class="table table-bordered table-striped" id="justificaciones-table">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Justificación</th>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Hora Final</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newJustificacionModal" tabindex="-1" role="dialog" aria-labelledby="newJustificacionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newJustificacionModalLabel">Registrar Justificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @include('justificaciones.form_newjustificacion')
      <div id="message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="guardar_justificacion">Justificar</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')

<script>
var tablaJustificaciones= $('#justificaciones-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'getJustificaciones',
        columns: [
            { data: 'dni', name: 'dni', orderable: false, searchable: false},
            { data: 'empleado', name: 'empleado' },
            { data: 'justificacion', name: 'justificacion', orderable: false, searchable: false},
            { data: 'fecha', name: 'fecha', render: function(data,type){
                return data.substr(8,2)+"-"+data.substr(5,2)+"-"+data.substr(0,4);
            }},
            { data: 'hora_inicio', name: 'hora_inicio', render: function(data, type){
                return data;
            }},
            { data: 'hora_final', name: 'hora_final', render: function(data, type){
                return data;
            }},
            { data: 'id', name: 'id', orderable: false, searchable: false, render: function(data, type){
                return "<button onclick='borrarJustificacion("+data+")' class='btn btn-danger btn-sm' title='Eliminar'><i class='fas fa-trash'></i></button>";
            } },

        ],
        order: [[3, 'desc']],
        
    });

$('#buscarEmpleado').click(function(){
    var dni = $('#dni').val();
    if(dni.length == 8){
        $.ajax({
            url: "buscarEmpleado/"+dni,
            cache: false,
            success: function(data){
                data = $.parseJSON(data);
                if(data != null){
                    $('#id_employee').val(data.id);
                    $('#nombres_apellidos').html("<div class='alert alert-success' role='alert'>"+data.name+" "+data.plastname+" "+data.mlastname+"</div>");
                    $('#message').html('');
                }else{
                    $('#message').html('<br/><div class="alert alert-danger" role="alert">No se encuentra a personal.</div>')
                }
            }
        });
    }
});

$('#guardar_justificacion').click( function() {
    if($('#id_employee').val() == ""){
        $('#message').html('<br/><div class="alert alert-danger" role="alert">No se ha identificado al personal.</div>')
    }else if($('#fecha').val() == ""){
        $('#message').html('<br/><div class="alert alert-warning" role="alert">Se require la fecha de Justificación.</div>');
    }else if($('#hora_inicio').val() == ""){
        $('#message').html('<br/><div class="alert alert-warning" role="alert">Se require hora de inicio.</div>')
    }else if($('#hora_final').val() == ""){
        $('#message').html('<br/><div class="alert alert-warning" role="alert">Se require hora final.</div>')
    }else if(Date.parse('01/01/2000 '+$('#hora_final').val()) <= Date.parse('01/01/2000 '+$('#hora_inicio').val())){
        $('#message').html('<br/><div class="alert alert-warning" role="alert">La hora de fin debe ser mayor a la hora de inicio.</div>')
    }else if($('#justificacion').val() == ""){
        $('#message').html('<br/><div class="alert alert-warning" role="alert">Se require la justificacion.</div>')
    }else{
        $('#message').html('');
        $.post( "{{route('justificaciones.store')}}", $('#formJustificacion').serialize(), function(data) {
            tablaJustificaciones.ajax.url('getJustificaciones').load();
            $('#newJustificacionModal').modal('hide');
            $(':input','#formJustificacion')
            .not(':button, :submit, :reset')
            .val('');
            $('#nombres_apellidos').html('<br/>');
            $('#message').html('');
        },
        'json'
        );
    }
});

function borrarJustificacion(idJustificacion){
    if (confirm("¿Esta seguro de eliminar el registro de justificacion?")) {
        $.ajax({
            url: "borrarJustificacion/"+idJustificacion,
            cache: false,
            success: function(data){
                tablaJustificaciones.ajax.url('getJustificaciones').load();
            }
        });
    } else {
        tablaJustificaciones.ajax.url('getJustificaciones').load();
    }
}
</script>


@endpush