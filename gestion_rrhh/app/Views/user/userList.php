                <!-- Begin Page Content -->
                <div class="container-fluid">
            <div class="col-sm-12" style="margin-top: 50px;">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="col-sm-4">
                                        <label for="teamFilter">Filtrar por Equipo:</label>
                                        <select id="teamFilter" class="form-control" onchange="filterTableByTeam()">
                                            <option value="">Todos</option>
                                            <!-- Aquí se generarán las opciones dinámicamente con JavaScript -->
                                        </select>
                                    </div>
                                <br>
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <div class="table-responsive" id="proTeamScroll" tabindex="2" style="height: 400px;  outline: none;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr align='center'>
                                                            <th align='center'>Avatar.</th>
                                                            <th align='center'>Nombre</th>
                                                            <th align='center'>Fecha Ingreso</th>
                                                            <th align='center'>Equipo</th>
                                                            <th align='center'>Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($dataProfile as $data):  ?>
                                                        <tr align='center'>
                                                            <td class="table-img"><img src="<?php echo base_url('uploads/'); ?><?=$data->foto;?>" alt=""style="object-fit:cover">
                                                            </td>
                                                            <td>
                                                                <p class="m-0 font-12">
                                                                <?= $data->Nombre; ?> <?= $data->Apellido; ?>
                                                                </p>
                                                            </td>
                                                            <td><?= $data->FechaIngreso; ?></td>
                                                            <td class="text-truncate">
                                                                <?= $data->NombreEquipo; ?>
                                                            </td>

                                                            <td>
                                                                <a data-toggle="tooltip" href="<?php echo base_url('profile/'.$data->idUsuarios); ?>" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                      
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                        <hr>

                    </div>
                </div>

            </div>
 

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
