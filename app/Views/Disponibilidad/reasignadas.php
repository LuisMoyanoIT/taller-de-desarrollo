<?php

use app\Controladores\ReasignarController;

?>


<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Reasignadas</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-striped table-bordered disponibilidad-table" style="width:100%">
              <thead>
                <tr>
                  <th width="1%">N°</th>
                  <th>Maquina</th>
                  <th>Tipo</th>
                  <th>Obra</th>
               
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $reasignadas = new ReasignarController();
                $mostrarReasignadas = $reasignadas->getAllReasignaciones();
                $numReasig = 0;
                foreach ($mostrarReasignadas as $key) {
                  $numReasig++;
                ?>
                  <tr>
                    <td><?= $numReasig ?></td>
                    <td><?= $key->Nombre ?></td>
                    <td><?= $key->Tipo ?></td>
                    <td><?= $key->Obra ?></td>
                    
                    <td>
                      <button class="btn btn-dafault btn-sm editar-reasignacion" 
                              data-id-reasignacion='<?= $key->IdReasigna ?>' 
                              data-nombre-maquina-reasignada='<?= $key->Nombre ?>' 
                              data-tipo-reasignada='<?= $key->Tipo ?>' 
                              data-nombre-obra-reasignada='<?= $key->Obra ?>'
                              data-freal-ini-reasignacion='<?= $key->FechaRealInicioReasig ?>' 
                              data-freal-fin-reasignacion='<?= $key->FechaRealFinalReasig ?>' 
                              data-fprog-ini-reasignacion='<?= $key->FechaProgrInicioReasig ?>' 
                              data-fprog-fin-reasignacion='<?= $key->FechaProgrFinalReasig ?>' 
                              data-horas-trabajadas-reasignacion='<?= $key->HorasTrabajadas ?>' 
                              data-toggle="modal" data-target="#EditarReasignacion"
                              title="Editar">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button class="btn btn-dafault btn-sm eliminar-reasignacion" 
                              data-id-eliminar-reasignacion='<?= $key->IdReasigna ?>'
                              data-id-eliminar-maquina-re='<?= $key->ID ?>'
                              data-nombre-maquina-eliminar='<?= $key->Nombre ?>'
                              data-tipo-maquina-eliminar='<?= $key->Tipo ?>'
                              data-nombre-obra-eliminar='<?= $key->Obra ?>'
                              data-fecha-real-ini-eliminar='<?= $key->FechaRealInicioReasig ?>'
                              data-fecha-real-eliminar='<?= $key->FechaRealFinal_MaqReasigna ?>' 

                                
                              title="Eliminar">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <!---Inicio Modal Editar Maquina Reasignada--->
          <div id="EditarReasignacion" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Editar Reasignacion</h4>
                </div>
                <div class="modal-body">
                  <form id="form-editReas" action="#" method="POST" enctype="multipart/form-data">
                  <input id="id-Reasignacion" type="hidden" value="0">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="nombre-maquina-reasig">Nombre Maquina</label>
                        <input id="nombre-maquina-reasig" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="tipo-maquina-reasignada">Tipo Maquina</label>
                        <input id="tipo-maquina-reasignada" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="obra-reasignada">Nombre Obra</label>
                        <input id="obra-reasignada" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="fecha-real-inicio-reasig">Fecha Real Inicio</label>
                        <input id="fecha-real-inicio-reasig" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <div class="form-group">
                        <label for="fecha-real-final-reasig">Fecha Real Fin</label>
                        <input id="fecha-real-final-reasig" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <div class="form-group">
                        <label for="fecha-prog-inicio-reasig">Fecha Programada Inicio</label>
                        <input id="fecha-prog-inicio-reasig" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <divclass="form-group">
                        <label for="fecha-prog-final-reasig">Fecha Programada Fin</label>
                        <input id="fecha-prog-final-reasig" type="date" class="form-control inputuser modal-input" placeholder="Fecha fin" required />
                    </div>
                    <div class="form-group" hidden>
                      <label for="horas-trabajadas-reasig">Horas Trabajadas</label>
                      <input id="horas-trabajadas-reasig" type="number" class="form-control inputuser modal-input" placeholder="Horas Trabajadas" min="1" max="2000" required>
                    </div>
                    <div class="form-group">
                      <button id="cancelarEdicion" type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
                      <button id="confirmarEdicion" type="submit" class="btn btn-default btn-confirmar">Guardar</button>
                    </div>
                </div>
                <!---Modal Body-->
                </form>
              </div>
              <!---Modal content--->
            </div>
            <!---Modal DIalog--->
          </div>
          <!---Div editar reasignacion--->
          <!---Fin Modal Editar Maquina Reasignada--->
        </div>
      </div>
    </div>
  </div>
</div>