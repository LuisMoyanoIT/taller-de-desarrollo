<?php

use app\Controladores\Maquinaria;
?>
<div id="Disponibles">
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Listado Maquinas que no estan en Mantencion</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table class="table table-striped table-bordered mantencion-table agregar" style="width:100%">
                  <thead>
                    <tr>
                      <th width="1%">N°</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>H/T</th>
                      <th></th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php

                    $sinEstadoMantencion = new Maquinaria();
                    $maquinasNoEnMantenciones = $sinEstadoMantencion->getAllMaquinas();

                    $num = 0;
                    foreach ($maquinasNoEnMantenciones as $noEnMantencion) {  //comienza foreach
                      if (isset($noEnMantencion) && $noEnMantencion->ID_MaqTipoEstadoMaquina != '4' && $noEnMantencion->ID_MaqTipoEstadoMaquina != '5') {
                        $num++;
                    ?>
                        <tr class="fila-maquina-<?= $noEnMantencion->ID_MaqMaquina ?>">
                          <td><?= $num ?></td>
                          <td><?= $noEnMantencion->Nombre_MaqMaquina ?></td>
                          <td><?= $noEnMantencion->TipoMaquina ?></td>
                          <th><?= $noEnMantencion->HorasTotales_MaqMaquina ?></th>
                          <td>
                            <button data-id-maquina='<?= $noEnMantencion->ID_MaqMaquina ?>' 
                                    data-nombre-maquina='<?= $noEnMantencion->Nombre_MaqMaquina ?>' 
                                    type="button" 
                                    class="btn btn-dafault agregar-mantencion" 
                                    data-toggle="modal"
                                    title="Agregar Mantencion" 
                                    data-target="#AgregarMantencion">
                              <i class="fa fa-plus-square"><abbr title="AgregarMantencion"></abbr></i>
                            </button>
                          </td>

                        </tr>
                    <?php
                      }  //fin if 
                    } //fin foreach 
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>