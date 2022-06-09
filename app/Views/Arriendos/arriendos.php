<!-- page content -->
<link rel="stylesheet" href="Documentacion/styles/arriendos.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Arriendos</h3>
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
                include "app/Views/Arriendos/mostrarArriendo.php";
              ?>
            </div>

            <div id="Agregar">
              <?php
                include "app/Views/Arriendos/agregarArriendo.php";
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
   
<!---Inicio Modal Editar Arriendo--->
<div id="Editar-Arriendo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modal-title-mantencion" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="form-regProd" action="#" method="POST" enctype="multipart/form-data">
          <input id="id-arriendo-Editar" type="hidden" value="0">
          <!-- Tipo Maquina -->
          <div class="form-group">
            <label>Tipo Maquina</label>
            <input id="tipo-maquina-Editar" type="text" class="form-control" readonly>
          </div>
          <!-- Obra -->
          <div class="form-group">
            <label>Obra</label>
            <input id="obra-Editar" type="text" class="form-control" readonly>
          </div>
          <!-- Descripcion -->
        <!--  <div class="form-group">
            <label>Nombre Maquina </label>
            <input id="nombre-Editar" class="form-control"readonly>
          </div> -->
          <!-- Empresa -->
          <div class="form-group">
            <label>Empresa </label>
            <input id="empresa-Editar" class="form-control">
              
          </div>
          <!-- Horas -->
          <div class="form-group">
            <label>H/T </label>
            <input type="number"id="horas-Editar" class="form-control">
              
          </div>
          <!-- FECHA inicio -->
          <div class="form-group">
            <label>Fecha Inicio </label>
            <input id="fecha-inicio-Editar" type="date" class="form-control">
          </div>
          <!-- FECHA fin -->
          <div class="form-group">
            <label>Fecha Fin </label>
            <input id="fecha-fin-Editar" type="date" class="form-control">
          </div>
          <!-- operador -->
          <div class="form-group">
            <label>Operador </label>
            <input id="operador-Editar" type="text" class="form-control">
          </div>
          <!-- Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
            <button type="button" id="guardar-ArriendoEditado" class="btn btn-default btn-confirmar">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!---Fin Modal Asignar Maquina--->
 <!---Inicio Modal ver detalle descripcion de arriendo--->
 <div id="ver-detalle-descripcion" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Ver descripcion:</h4>
                </div>
                <div class="modal-body">
                  <form id="form-detail-maq" action="#" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="detalle-fecha-real-i">Descripcion: </label>
                        <input id="detalle-descripcion" type="text" class="form-control inputuser modal-input" readonly>
                      </div>
                  
                    <div class="form-group">
                      <button id="cancelar-detalle" type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
                      
                    </div>
                </div>
                <!---MOdal Body-->
                </form>
              </div>
              <!---MOdal content--->
            </div>
            <!---MOdal DIalog--->
          </div>
          <!---Div editar asignacion--->

          <!---Fin Modal ver descripcion de arriendo--->