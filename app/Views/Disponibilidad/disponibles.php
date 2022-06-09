<?php

use app\Controladores\Maquinaria;
use app\Controladores\ObraController;
use app\Controladores\TipoTrasladoController;
use app\Modelos\Maquina;

?>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Disponibles</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
           <!--INICIO PIE CHART DISPONIBLES--->
      <?php
           $maquinariaCantidad = new Maquina();
           $mostrarCantidades = $maquinariaCantidad->GetEstadosMaquina();
          foreach ($mostrarCantidades  as $cantidadEstadosMaquina) {
      ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Máquinas disponibles <small>Disponibles</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-estado-disponible" 
                        style="width:350px; height:350px;"
                        data-cantidad-disponibles='<?= $cantidadEstadosMaquina->CantidadDisponible ?>'
                        data-total-estados-maquina='<?= $cantidadEstadosMaquina->TotalEstadosMaquina ?>'
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Pie chart -->
              <?php
                    }
              ?>
      <!--  FIN PIE CHART DISPONIBLES--->

        <!--INICIO PIE CHART TIPOS MAQUINAS DISPONIBLES--->
        <?php
           $maquinariaController= new Maquinaria();
           $tiposMaquinasDisponible = $maquinariaController->getTiposMaquinaDisponible();
          foreach ($tiposMaquinasDisponible  as $tiposDisponibles) {
      ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tipos de maquinas disponibles</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-tipos-maquinas-disponibles" 
                        style="width:348px; height:348px;"
                        data-cadenas-disponibles='<?= $tiposDisponibles->CargadoresCadenas ?>'
                        data-ruedas-disponibles='<?= $tiposDisponibles->CargadoresRuedas ?>'
                        data-compactadores-disponibles='<?= $tiposDisponibles->Compactadores ?>'
                        data-excavadoras-disponibles='<?= $tiposDisponibles->Excavadoras ?>'
                        data-manipuladoras-disponibles='<?= $tiposDisponibles->Manipuladores ?>'
                        data-minicargadores-disponibles='<?= $tiposDisponibles->Minicargadores ?>'
                        data-motoniveladores-disponibles='<?= $tiposDisponibles->Motoniveladoras ?>'
                        data-retroexcavadoras-disponibles='<?= $tiposDisponibles->Retroexcavadoras ?>'
                        data-tractores-disponibles='<?= $tiposDisponibles->Tractores ?>'
                        data-total-tipo-maquina-disponibles='<?= $tiposDisponibles->TotalTipoMaquina ?>'
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Pie chart -->
              <?php
                    }
              ?>
      <!--  FIN PIE CHART TIPOS MAQUINAS DISPONIBLES--->
            <table class="table table-striped table-bordered disponibilidad-table" style="width:100%">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>H/T</th>
                  <th>Asignar</th>

                </tr>
              </thead>

              <tbody>
                <?php
                $estadoDisponible = 1;
                $maquinariaDisponible = new Maquinaria();                     //se asignan nombres propios de cada variable
                $mostrarDisponibles = $maquinariaDisponible->GetAllMaquinasByEstado($estadoDisponible); //debido a que en otras paginas no se podra ocupar
                //el mismo nombre
                $numDisp = 0;

                foreach ($mostrarDisponibles as $row) {  //comienza foreach
                  $numDisp++;
                ?>

                  <tr>
                    <td><?= $numDisp ?></td>
                    <td><?= $row->Nombre_MaqMaquina ?></td>
                    <td><?= $row->TipoMaquina ?></td>
                    <td><?= $row->HorasTotales_MaqMaquina ?></td>
                    <td>
                      <button data-id-maquina='<?= $row->ID_MaqMaquina ?>' 
                      data-nombre-maquina='<?= $row->Nombre_MaqMaquina ?>'
                      data-tipo-maquina-dis='<?= $row->TipoMaquina ?>' 
                      type="button" class="btn btn-dafault btn-sm asignar-maquina" 
                      data-toggle="modal" data-target="#Asignar"
                      title="Asignar">
                        <i class="fa fa-plus-square"></i>
                      </button>
                    </td>

                  </tr>
                <?php

                }  //fin foreach 
                ?>
              </tbody>
            </table>
          </div>

          <!---Inicio Modal Asignar Maquina--->
          <div id="Asignar" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Asignar Maquina:</h4>
                </div>
                <div class="modal-body">
                  <form id="form-regProd" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input id="idMaquina" type="hidden" value="0">
                      <input id="tipo-maquina-dis" type="hidden" value="0">
                      <div class="form-group">
                        <label for="obra">Obra: </label>
                        <select id="obra" class="form-control">
                          <option value='-1' selected>Seleccione</option>
                          <?php
                          $mostrarObras = new ObraController();
                          $mostrarAllObras = $mostrarObras->getAllObras();

                          foreach ($mostrarAllObras as $obr) {
                          ?>
                            <option value="<?= $obr->ID_Obra ?>"><?= $obr->Nombre_Obra ?></option>

                          <?php
                          }
                          ?>
                        </select>


                      </div>

                      <div class="form-group">
                        <label for="nombreMaquina">Maquina: </label>
                        <input id="nombreMaquina" type="text" class="form-control" readonly>
                      </div>



                      <div class="form-group">
                        <label for="fechaProgIni">Fecha Programada Inicio: </label>
                        <input id="fechaProgIni" type="date" class="form-control inputuser modal-input" placeholder="Fecha prog. Inicio" required>

                      </div>
                      <div class="form-group">
                        <label for="fechaProgFin">Fecha programada Fin: </label>
                        <input id="fechaProgFin" type="date" class="form-control inputuser modal-input" placeholder="Fecha prog. Fin" required>
                      </div>
                      
                      
                    <div class="form-group">
                      <label for="horasTrabajadas">Horas Trabajadas: </label>
                      <input id="horasTrabajadas" type="number" class="form-control inputuser modal-input" placeholder="Horas Trabajadas"  required>
                    </div>
                    <div class="form-group">
                          <label>Traslado</label>
                          <br>
													<input type="checkbox" class="flat check-traslado-asignacion">
										</div>
                    
                 
                    <div class="form-group fechaIniTraslado" hidden>
                      <label for="fechaIniTraslado">Fecha Inicio Traslado: </label>
                      <input id="fechaIniTraslado" type="date" class="form-control inputuser modal-input" placeholder="Fecha Inicio Traslado" required>
                    </div>
                    <div class="form-group fechaFinTraslado" hidden>
                      <label for="fechaFinTraslado">Fecha Fin Traslado: </label>
                      <input id="fechaFinTraslado" type="date" class="form-control inputuser modal-input" placeholder="Fecha Fin Traslado" required>
                    </div>

                    <!---->


                    <div class="form-group">
                      <button id="cancelarAsig" type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>


                      <button id="confirmarAsig" type="button" class="btn btn-default btn-confirmar">Guardar</button>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!---Fin Modal Asignar Maquina--->
      </div>
     

  


    </div>
  </div>
</div>
</div>
