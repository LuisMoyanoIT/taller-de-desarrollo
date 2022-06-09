<!-- page content -->
<link rel="stylesheet" href="Documentacion/styles/maquinas.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Maquinaria</h3>
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
                include "app/Views/Maquinaria/mostrarMaquinaria.php";
              ?>
            </div>

            <div id="Agregar">
              <?php
                include "app/Views/Maquinaria/agregarMaquinaria.php";
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- /page content -->

   <!--modal para editar la maquina-->
<div id="Editar-Maquina" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modal-title-mantencion" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form-regProd" action="#" method="POST" enctype="multipart/form-data">
          <input id="id-maquina-Editar" type="hidden" value="0">
          <!-- Nombre Maquina -->
          <div class="form-group">
            <label>Nombre Maquina</label>
            <input id="nombre-maquina-Editar" type="text" class="form-control">
          </div>
          <!-- Descripcion -->
          <div class="form-group">
            <label>Descripcion Maquina</label>
            <input id="descripcion-Editar" type="text" class="form-control">
          </div>
          <!-- Tipo Maquina -->
          <div class="form-group">
            <label>Tipo de maquina </label>
            <input id="tipo-maquina-Editar" class="form-control" readonly>
              
          </div>
           <!-- Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
            <button type="button" id="guardar-MaquinaEditado" class="btn btn-default btn-confirmar">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>