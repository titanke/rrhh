<form method="POST" action="nuevoEmpleado" id="formEmployee">
    @csrf
    <div class="row">
        <div class="col-6 mb-3">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni">
        </div>
        <div class="col-6 mb-3">
            <label for="plastname">Apellido Paterno</label>
            <input type="text" class="form-control" id="plastname" name="plastname">
        </div>
        <div class="col-6 mb-3">
            <label for="mlastname">Apellido Materno</label>
            <input type="text" class="form-control" id="mlastname" name="mlastname">
        </div>
        <div class="col-6 mb-3">
            <label for="name">Nombres</label>
            <input type="text" class="form-control" id="name" name="name"> 
        </div>
        <div class="col-6 mb-3">
            <label for="position">Cargo</label>
            <input type="text" class="form-control" id="position" name="position">
        </div>
        <div class="col-6 mb-3">
            <label for="regimen">Régimen</label>
            <select name='regimen' id="regimen" class='form-control'>
                <option value="276 PROYECTOS">276 PROYECTOS</option>
                <option value="CONTRALORIA">CONTRALORIA</option>
                <option value="CAS TRANSITORIO">CAS TRANSITORIO</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label for="dependencia">Oficina</label>
            <select name='dependencia' id="dependencia" class='form-control'>
                <option value="">- SELECCIONE -</option>
            </select>
        </div>
    </div>
    
</form>