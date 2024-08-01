@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Biometricos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="biometricos-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección IP</th>
                                <th>Ultima Carga</th>
                                <th>Eventos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>

                    <hr/>
                    <div id="log">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')

<script>
var tablaBiometricos = $('#biometricos-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'listBiometricos',
    columns: [
        { data: 'nombre', name: 'nombre', orderable: false, searchable: false},
        { data: 'ip', name: 'ip' , orderable: false, searchable: false},
        { data: 'sync', name: 'sync', orderable: false, searchable: false},
        { data: 'eventos', name: 'eventos', orderable: false, searchable: false},
        { data: 'id', name: 'id', orderable: false, searchable: false, render: function(data,type){
            return "<a onclick='sincronizar("+data+")' class='btn btn-primary' id='btn_sync"+data+"'><i class='fas fa-fw fa-sync' id='fa_icon"+data+"'></i> Sincronizar</a>";
        }},
    ],
});

function sincronizar(idBiometrico){
    $('#fa_icon'+idBiometrico).addClass('fa-spin')
    $('#btn_sync'+idBiometrico).addClass('btn-warning');
    $('#btn_sync'+idBiometrico).removeClass('btn-primary');
    $.ajax({
        url: "sincronizar/"+idBiometrico,
        cache: false,
        success: function(data){
            //console.log(data);
            tablaBiometricos.ajax.url('listBiometricos').load();
            $('#log').append(data);
            $('#fa_icon'+idBiometrico).removeClass('fa-spin');
        },
        error: function(){
            console.log("ERROR");
            $('#btn_sync'+idBiometrico).addClass('btn-danger');
            $('#btn_sync'+idBiometrico).removeClass('btn-warning');
        }
    });
}


</script>


@endpush