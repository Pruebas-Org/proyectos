<div class="container-fluid">
    <div class="card-header">
        <form class="row g-3">
            <div class="col-md-3">
                <label for="exampleFormControlSelect1">Tipo de Usuario</label>
                <select class="form-control" id="tipoSelect" onchange="getPermisos()">
                    <?php foreach ($allTypes as $tipos) { ?>
                        <option value="<?php echo $tipos->Id; ?>"><?php echo $tipos->Nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="exampleFormControlSelect1">Modulo</label>
                <select class="form-control" id="modulosSelect">
                    <?php foreach ($allModules as $modulos) { ?>
                        <option value="<?php echo $modulos->Id; ?>"><?php echo $modulos->NombreItem; ?></option>
                    <?php } ?>
                </select>
            </div>
        </form>
        <br>
        <div class="row">                                
            <div class="col">
                <button type="button" class="btn btn-primary" onclick= agregarDetalle()>Agregar Permiso</button>
            </div>
        </div>                        
    </div>          
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Modulo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableBody">
                    </tbody>
                </table>
                <br>    
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" onclick= finalizarPermisos()>Confirmar</button>
                    <button type="button" class="btn btn-primary" onclick= nuevoPermisos()>Nuevo Permiso</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>