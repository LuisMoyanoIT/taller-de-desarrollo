<!-- page content -->
<link rel="stylesheet" href="Documentacion/styles/mantencion.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Mantención</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="lightTab">
        <div class="minimalTabs">

          <ul>
            <li><a href="#Mostrar">
                <span><b>Mostrar</b></span></a></li>
            <li><a href="#Agregar">
                <span><b>Agregar</b></span></a></li>
          </ul>

          <div class="contents">
            <div id="Mostrar">
              <?php
              include "app/Views/Mantencion/mostrarMantencion.php";
              ?>
            </div>

            <div id="Agregar">
              <?php
              include "app/Views/Mantencion/agregarMantencion.php";
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!---Inicio Modal Agregar Mantencion--->
<div id="AgregarMantencion" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modal-title-mantencion" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form-regProd" action="#" method="POST" enctype="multipart/form-data">
          <input id="idMantencion" type="hidden" value="0">
          <input id="idMaquina" type="hidden" value="0">
          <!-- NOMBRE -->
          <div class="form-group">
            <label>Nombre</label>
            <input id="nombreMaquina" type="text" class="form-control" readonly>
          </div>
          <!-- MANTENCION -->
          <div class="form-group">
            <label>Mantencion</label>
            <input id="mantencion" type="text" class="form-control">
          </div>
          <!-- TIPO MANTENCION -->
          <div class="form-group">
            <label>Tipo Mantencion </label>
            <select id="tipoMantencion" class="form-control">
              <option value='-1' selected>Seleccione</option>
              <option value='Preventiva'>Preventiva</option>
              <option value='Correctiva'>Correctiva</option>
            </select>
          </div>
          <!-- FECHA PROGRAMADA -->
          <div class="form-group">
            <label>Fecha Programada </label>
            <input id="fechaProgramada" type="date" class="form-control">
          </div>
          <!-- FECHA INICIO -->
          <div class="form-group" id="divFechaInicio">
            <label>Fecha de Inicio </label>
            <input id="fechaInicio" type="date" class="form-control">
          </div>
          <!-- FECHA TERMINO -->
          <div class="form-group" id="divFechaTermino">
            <label>Fecha de Termino </label>
            <input id="fechaTermino" type="date" class="form-control">
          </div>
          <!-- Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
            <button type="button" id="guardar-mantencion" class="btn btn-default btn-confirmar"></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!---Fin Modal Asignar Maquina--->