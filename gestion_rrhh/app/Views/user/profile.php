                <!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4" style="margin-top: 50px;" >
            <div class="text-center">
                <?php foreach($forEdit as $data):  ?>
                    <img src="<?php echo base_url('uploads/'.$data->foto)?>" class="" alt="avatar" height="380" width="250" style="object-fit:cover">
                <?php endforeach; ?>
                <h6>Upload a different photo...</h6>
                    <input type="file" class="text-center center-block file-upload">
            </div>
            </hr><br>
        </div>

        <div class="col-sm-8" style="margin-top: 50px;">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                <hr>
                <form class="form" action="##" method="post" id="registrationForm">
                    <div class="form-group">
                    <?php foreach($forEdit as $data):  ?>
                        <div class="col-xs-6">
                            <label for="nombre"><h4>Nombre</h4></label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" value="<?= $data->Nombre; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6"><label for="last_name"><h4>Apellidos</h4></label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos" value ="<?= $data->Apellido; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="last_name"><h4>Equipo</h4></label>
                                <input type="text" class="form-control" name="equipo" id="equipo" placeholder="equipo" value="<?= $data->NombreEquipo; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="fechaNac"><h4>Fecha de Nacimineto</h4></label>
                                <input type="date" class="form-control" name="fechNac" id="fechNac" value="<?= $data->FechaNacimiento; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="mobile"><h4>Movil</h4></label>
                                <input type="text" class="form-control" name="movil" id="movil" placeholder="introduce tu móvil" value="<?= $data->Telefono; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" value="<?= $data->Email; ?>">
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="password"><h4>Contraseña</h4></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="contraseña">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="password2"><h4>Verifica la contraseña</h4></label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="password2">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                        <br>
                            <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Guardar</button>
                            <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
                        </div>
                    </div>
                </form>
                <hr>
            </div>
        </div>

    </div>
</div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
