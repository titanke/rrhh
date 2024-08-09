@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Asistencia mensual</h6>
       
        </div>
        <div class="card-body">
        <div class="form-inline">
            <label for="startDate">Desde: </label>
            <input type="date" class="form-control mr-2" id="startDate" name="startDate" required>
            <label for="endDate">Hasta: </label>
            <input type="date" class="form-control mr-2" id="endDate" name="endDate" required>
            <label for="endDate">DNI: </label>
            <input type="text" class="form-control mr-2" id="dni" name="dni" required>
            <button type="button" class="btn btn-primary" id="filterButton">Filtrar</button>
          </div>
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
            <tbody></tbody> </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')

<script>
$(function() {
  const table = $('#events-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'getMonth',
      data: function(d) {
        d.dni = $('#dni').val();
        d.startDate = $('#startDate').val();
        d.endDate = $('#endDate').val();
      }
    },
    columns: [
      { data: 'fecha', name: 'fecha', orderable: false, searchable: false },
      { data: 'regimen', name: 'regimen' },
      { data: 'dni', name: 'dni' },
      { data: 'name', name: 'name' },
      { data: 'marcas', name: 'marcas', orderable: false, searchable: false }
    ],
    order: [[1, 'asc']],
    columnDefs: [{ targets: 1, className: 'dt-right' }],
            layout: {
        topEnd: {
            buttons: ['excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }]
            }
        }
  });

  $('#filterButton').click(function() {
    table.ajax.reload(); 
  });
});
</script>

@endpush
