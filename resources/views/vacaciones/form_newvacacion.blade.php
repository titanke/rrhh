<form method="POST" action="guardarVacacion" id="formVacacion">
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="dni">Empleado</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="DNI" id="dni">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="buscarEmpleado"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div id="nombres_apellidos"></br></div>
            <input type="hidden" id="id_employee" name="id_employee"/>    
        </div>
        <div class="col-12">
            <label for="motivo">Motivo</label>
            <div class="form-group">
                <textarea type="text" class="form-control" id="motivo" name="motivo" placeholder="e.g. Resolucion 001-2024"></textarea>
            </div>
        </div>

        <div class="col-12">
            <label for="start">Periodo</label>
            <div class="input-daterange input-group" id="datepicker">    
                <input type="date" class="input-sm form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio"/>
                <input type="date" class="input-sm form-control" name="fecha_final" id="fecha_final" placeholder="Fecha Final"/>
            </div>
        </div>
    </div>
</form>