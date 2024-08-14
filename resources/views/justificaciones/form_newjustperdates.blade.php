<form method="POST" action="guardar_justificacionPF" id="formJustificacion2">
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="dni">Empleado</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="DNI" id="dni2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="buscarEmpleado2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div id="nombres_apellidos2"></br></div>
            <input type="hidden" id="id_employee2" name="id_employee2"/>    
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="fecha">Fecha Inicio</label>
            <input type="date" class="form-control" placeholder="Fecha" id="fecha2" name="fecha2" max="{{date('Y-m-d')}}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="fecha">Fecha Final</label>
            <input type="date" class="form-control" placeholder="Fecha" id="fecha_final2" name="fecha_final2" max="{{date('Y-m-d')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="justificacion">Justificación</label>
                <textarea type="text" class="form-control" id="justificacion2" name="justificacion2" placeholder="e.g. Comisión de Servicio"></textarea>
            </div>
        </div>
    </div>
</form>