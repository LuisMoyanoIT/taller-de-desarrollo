<?php

use app\Controladores\Maquinaria;
?>
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Todas</h2>
        <div class="clearfix"></div>
      </div>
     <!--INICIO PIE CHART TODAS--->
     <?php
          $estadosMaquinas = $maquinariaController->getEstadosMaquina();
          foreach ($estadosMaquinas  as $estadoMaquina) {
      ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pie Chart <small>Todas</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-estado-todas" 
                        style="width:300px; height:300px;"
                        data-disponibles='<?= $estadoMaquina->CantidadDisponible ?>'
                        data-asignadas='<?= $estadoMaquina->CantidadAsignada ?>'
                        data-reasignadas='<?= $estadoMaquina->CantidadReasignada ?>'
                        data-mantenciones='<?= $estadoMaquina->CantidadMantencion ?>'
                        data-inhabilitadas='<?= $estadoMaquina->CantidadInhabilitadas ?>'
                        data-cantidad-total='<?= $estadoMaquina->TotalEstadosMaquina ?>'
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
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-striped table-bordered disponibilidad-table" style="width:100%">
              <thead>
                <tr>
                  <th width="1%">N°</th>
                  <th>Name</th>
                  <th>Tipo</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
              <?php

              $maquinariaController = new Maquinaria();
              $maquinarias = $maquinariaController->getAllMaquinas();
              $numTodas = 0;
              foreach ($maquinarias as $maquinaria) {
                $numTodas++;
              ?>
                  <tr role="row" class="even">
                      <td><?= $numTodas ?></td>
                      <td><?= $maquinaria->Nombre_MaqMaquina ?></td>
                      <td><?= $maquinaria->TipoMaquina ?></td>
                      <td><?= $maquinaria->Estado ?></td>    
                  </tr>

              <?php

              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
     
    </div>
  </div>
</div>