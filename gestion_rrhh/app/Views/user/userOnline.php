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
                                                            <th align='center'>Status</th>
                                                            <th align='center'>Equipo</th>
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
                                                            
                                                            <td>
                                                                <div class="badge-outline <?= $data->Status === 'en_trabajo' ? 'col-green' : 'col-red'; ?>">
                                                                    <?php if ($data->Status === 'en_trabajo'): ?>
                                                                        <span style="color: green;">●</span>
                                                                    <?php else: ?>
                                                                        <span style="color: red;">●</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                            <td class="text-truncate">
                                                                <?= $data->NombreEquipo; ?>
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