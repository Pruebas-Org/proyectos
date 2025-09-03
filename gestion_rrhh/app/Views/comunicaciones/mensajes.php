<div class="container-fluid mt-5">
  <form>
    <div class ="form-row">
      <div class="form-group col-md-6">
        <label for="typenot"><h4>Tipo de Notificación</h4></label>
          <select class="form-control" id="tipoSelectnoti">
            <?php foreach ($typeNot as $tipo) { ?>
              <option value="<?php echo $tipo->Id; ?>"><?php echo $tipo->Nombre; ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="usuarios"><h4>Remitente</h4></label>
          <select class="form-control" id="usuarios">
          </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-12">
        <label for="mensaje">Mensaje</label>
          <textarea class="form-control" id="mensaje" rows="4" placeholder="Ingrese su mensaje aquí"></textarea>
      </div>
    </div>
   
  </form>

  <button class="btn btn-primary" onclick="sendMessage()">Enviar</button>
</div>




