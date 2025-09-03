<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mensajes/Notificaciones</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th align='center'>Tipo</th>
                            <th align='center'>Emisor</th>
                            <th align='center'>Fecha/hora</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($allNotiMes as $notimes): ?>
                        <tr>
                            <td align='center'><?= $notimes->tipo; ?></td>
                            <td align='center'><?= $notimes->Emisor; ?></td>
                            <td align='center'><?= $notimes->created_at; ?></td>
                            <td align='center'>
                            <a href="#" onclick="loadDetails(<?= $notimes->TipoNotificacion; ?>,<?= $notimes->Id; ?>)" class="view-details" data-toggle="modal" data-target="#detailsModal">
                            <i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
