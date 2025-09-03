                <!-- Begin Page Content -->
                <div class="container-fluid">


                <div class="row">
                    <div class="col-sm-4" style="margin-top: 50px;">
                        <div class="text-center" id="fotodiv" style="border:green">
                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-thumbnail"
                                alt="avatar" >
                            <h6>Upload a different photo...</h6>
                            <input type="file" accept="image/*" class="text-center center-block file-upload" id="foto">
                        </div>
                        </hr><br>
                        <div class="row g-3">
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value="" id="lun">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lunes
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value="" id="mar">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Martes
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value=""  id="mie">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Miercoles
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value=""  id="jue">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Jueves
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value=""  id="vie">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Viernes
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value="" id="sab">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Sabado
                                </label>
                            </div>
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="checkbox" value=""  id="dom">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Domingo
                                </label>
                            </div>
                        </div>
                        
                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4>Horaios</h4>
                                </label>
                                <select class="form-control" id="tipoSelectHorario">
                                    <?php foreach ($horarios as $Horario) { ?>
                                        <option value="<?php echo $Horario->Id; ?>"><?php echo $Horario->HoraInicio; ?>-<?php echo $Horario->HoraFinal; ?></option>
                                    <?php } ?>
                                </select>
                                <br>
                                <button class="btn btn-success" onclick="agregar()"><i
                                            class="glyphicon glyphicon-ok-sign" ></i> Agregar</button>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered"  width="100%" cellspacing="0" id="horarios">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Dias</th>
                                        <th>Horario</th>
                                        <th>Acciones</th>

                                    </thead>
                                    <tbody id="dataTableBody">

                                    </tbody>
                                </table>


                            </div>
                        </div>

                    </div>

            <div class="col-sm-8" style="margin-top: 50px;">



                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="##" method="post" id="registrationForm">
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="nombre">
                                        <h4>Nombre</h4>
                                    </label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        placeholder="nombre" onchange='camposVacios()' >
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h4>Apellidos</h4>
                                    </label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos"
                                        placeholder="apellidos" onchange='camposVacios()'>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h4>Equipo</h4>
                                    </label>
                                    <select class="form-control" id="tipoSelectEquipo">
                                    <?php foreach ($team as $teams) { ?>
                                            <option value="<?php echo $teams->Id; ?>"><?php echo $teams->NombreEquipo; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-3">
                                    <label for="last_name">
                                        <h4>Tipo de usuario</h4>
                                    </label>
                                    <select class="form-control" id="tipoSelectTipo">
                                        <?php foreach ($userType as $type) { ?>
                                            <option value="<?php echo $type->Id; ?>"><?php echo $type->Nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-3">
                                    <label for="fechaNac">
                                        <h4>Fecha de Nacimineto</h4>
                                    </label>
                                    <input type="date" class="form-control" name="fechNac" id="fechNac" onchange='camposVacios()'>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-3">
                                    <label for="fechaNac">
                                        <h4>Fecha de Ingreso</h4>
                                    </label>
                                    <input type="date" class="form-control" name="fechaIng" id="fechaIng" onchange='camposVacios()'>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="mobile">
                                        <h4>Movil</h4>
                                    </label>
                                    <input type="number" class="form-control" name="movil" id="movil"
                                        placeholder="introduce tu móvil" onchange='camposVacios()'>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="you@email.com" onchange='camposVacios()' >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="password">
                                        <h4>Contraseña</h4>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="contraseña" onchange='verfPass()'>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password2">
                                        <h4>Verifica la contraseña</h4>
                                    </label>
                                    <input type="password" class="form-control" name="password2" id="password2"
                                        placeholder="password2" onchange='verfPass()'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <a class="btn btn-success" onclick='agregarUsuario()'><i
                                            class="glyphicon glyphicon-ok-sign"></i> Guardar</a>
                                    <button class="btn btn-danger" type="reset"><i
                                            class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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