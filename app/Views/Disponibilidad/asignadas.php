<?php

use app\Controladores\AsignarController;
use app\Controladores\ObraController;
use app\Controladores\TipoTrasladoController;
use app\Modelos\Maquina;
?>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Asignadas</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
           <!--INICIO PIE CHART DISPONIBLES   height:300px;  --->
      <?php
           $maquinariaCantidad = new Maquina();
           $mostrarCantidades = $maquinariaCantidad->GetEstadosMaquina();
          foreach ($mostrarCantidades  as $cantidadEstadosMaquina) {
      ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Resumen gráfico de máquinas asignadas</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-estado-asignadas" 
                        style="width:350px; height:350px;"
                        data-cantidad-asignadas='<?= $cantidadEstadosMaquina->CantidadAsignada ?>'
                        data-total-estados-maquina-as='<?= $cantidadEstadosMaquina->TotalEstadosMaquina ?>'
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
            <table class="table table-striped table-bordered disponibilidad-table" style="width:100%">
              <thead>
                <tr>
                  <th width="1%">N°</th>
                  <th>Nombre de Maquina</th>
                  <th>Tipo de Maquina</th>
                  <th>Obra</th>

                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $asignadas = new AsignarController();
                $mostrarAsignadas = $asignadas->getAllAsignaciones();
                $numAsig = 0;
                foreach ($mostrarAsignadas as $key) {
                  $numAsig++;
                ?>
                  <tr>
                    <td><?= $numAsig ?></td>
                    <td><?= $key->Nombre_MaqMaquina ?></td>
                    <td><?= $key->TipoMaquina ?></td>
                    <td><?= $key->Nombre_Obra ?></td>
                  
                    <td>
                      <button class="btn btn-dafault btn-sm editar-asignacion" 
                              data-id-asignacion='<?= $key->ID_MaqAsigna ?>' 
                              data-nombre-maq='<?= $key->Nombre_MaqMaquina ?>' 
                              data-tipo-asignada='<?= $key->TipoMaquina ?>' 
                              data-nombre-obra-asignada='<?= $key->Nombre_Obra ?>' 
                              data-fecha-real-asignacion='<?= $key->FechaRealInicio_MaqAsigna ?>' 
                              data-fecha-real-fin-asignacion='<?= $key->FechaRealFin_MaqAsigna ?>' 
                              data-fecha-prog-ia='<?= $key->FechaProgrInicio_MaqAsigna ?>' 
                              data-fecha-prog-fa='<?= $key->FechaProgrFin_MaqAsigna ?>' 
                              data-horas-trabajadas-asignacion='<?= $key->HorasTrabajadas_MaqAsigna ?>'
                              data-id-traslado-asignacion='<?= $key->ID_MaqTipoTraslado ?>'
                              data-fecha-inicio-traslado-as='<?= $key->FechaInicioTraslado_MaqAsigna ?>'
                              data-fecha-final-traslado-as='<?= $key->FechaFinTraslado_MaqAsigna ?>'
                              data-toggle="modal" 
                              data-target="#EditarAsignacion"
                              title="Editar">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button class="btn btn-dafault btn-sm eliminar-asignacion" 
                              data-id-asignar='<?= $key->ID_MaqAsigna ?>'
                              data-id-maquina-eliminar='<?= $key->ID_MaqMaquina ?>'
                              data-nombre-maquina-eliminar='<?= $key->Nombre_MaqMaquina ?>'
                              data-tipo-maquina-eliminar='<?= $key->TipoMaquina ?>'
                              data-nombre-obra-eliminar='<?= $key->Nombre_Obra ?>'
                              data-fecha-real-eliminar='<?= $key->FechaRealInicio_MaqAsigna ?>' 
                              data-fecha-real-eliminar='<?= $key->FechaRealFin_MaqAsigna ?>' 
                              title="Eliminar">
                        <i class="fa fa-trash"></i>
                      </button>
                      <button data-id-maquina-reasignada='<?= $key->ID_MaqMaquina ?>' 
                              data-nombre-maquina-reasignada='<?= $key->Nombre_MaqMaquina ?>' 
                              type="button" class="btn btn-dafault btn-sm reasignar-maquina" 
                              data-toggle="modal" data-target="#Reasignar"
                              title="Reasignar">
                        <i class="fa fa-plus-square"></i>
                      </button>
                      <button class="btn btn-default btn-sm detalle-asignacion"
                              data-detalle-id-asignar='<?= $key->ID_MaqAsigna ?>'
                              data-detalle-nombre-maq='<?= $key->Nombre_MaqMaquina ?>' 
                              data-detalle-tipo='<?= $key->TipoMaquina ?>'
                              data-detalle-obra='<?= $key->Nombre_Obra ?>' 
                              data-detalle-fecha-real-ini='<?= $key->FechaRealInicio_MaqAsigna ?>'
                              data-detalle-fecha-real-fin='<?= $key->FechaRealFin_MaqAsigna ?>'
                              data-detalle-fecha-prog-ini='<?= $key->FechaProgrInicio_MaqAsigna ?>'
                              data-detalle-fecha-prog-fin='<?= $key->FechaProgrFin_MaqAsigna ?>'
                              data-detalle-horas-trabajadas='<?= $key->HorasTrabajadas_MaqAsigna ?>'
                              data-detalle-id-traslado='<?= $key->ID_MaqTipoTraslado ?>'
                              data-detalle-inicio-traslado='<?= $key->FechaInicioTraslado_MaqAsigna ?>'
                              data-detalle-fin-traslado='<?= $key->FechaFinTraslado_MaqAsigna ?>'
                              data-toggle="modal"
                              data-target="#ver-detalle-asignacion"
                              title="Detalles">
                        <i class="fas fa-search-plus"></i>
                      </button>

                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <!---Inicio Modal Editar Maquina--->
          <div id="EditarAsignacion" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Editar Asignacion:</h4>
                </div>
                <div class="modal-body">
                  <form id="form-edAs" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input id="id-Asignacion" type="hidden" value="0">
                      <div class="form-group">
                        <label for="nombre-maquinaria">Nombre Maquina: </label>
                        <input id="nombre-maquinaria" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="TipoMaquinaAsignada">Tipo Maquina: </label>
                        <input id="TipoMaquinaAsignada" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="obra-easignacion">Nombre Obra: </label>
                        <input id="obra-easignacion" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="fecha-real-ia">Fecha Real Inicio: </label>
                        <input id="fecha-real-ia" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <div class="form-group">
                        <label for="fecha-real-fa">Fecha Real Fin: </label>
                        <input id="fecha-real-fa" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <div class="form-group">
                        <label for="fecha-prog-ia">Fecha Programada Inicio: </label>
                        <input id="fecha-prog-ia" type="date" class="form-control inputuser modal-input" required>
                      </div>
                      <divclass="form-group">
                        <label for="fecha-prog-fa">Fecha Programada Fin: </label>
                        <input id="fecha-prog-fa" type="date" class="form-control inputuser modal-input" placeholder="Fecha fin" required />
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                      <button id="cancelarEdic" type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
                      <button id="confirmarEdic" type="button" class="btn btn-default btn-confirmar">Guardar</button>
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


          <!---Fin Modal Editar Maquina--->


          <!---Inicio Modal Reasignar Maquina--->
          <div id="Reasignar" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Reasignar Maquina</h4>
                </div>
                <div class="modal-body">
                  <form id="form-reAsig" action="#" method="POST" enctype="multipart/form-data">
                    <input id="id-maquina-reasignada" type="hidden" value="0">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="obra-reasig">Nueva Obra</label>
                        <select id="obra-reasig" class="form-control">
                          <option value='-1' selected>Seleccione nueva obra</option>
                          <?php
                          $mostrarObrasRe = new ObraController();
                          $mostrarAllObrasRe = $mostrarObrasRe->getAllObras();

                          foreach ($mostrarAllObrasRe as $obraRe) {
                          ?>
                            <option value="<?= $obraRe->ID_Obra ?>"><?= $obraRe->Nombre_Obra ?></option>

                          <?php
                          }
                          ?>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="nombre-maquina-reasignada">Maquina</label>
                        <input id="nombre-maquina-reasignada" type="text" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="fecha-prog-inicio-reasignacion">Fecha Programada Inicio Reasignación</label>
                        <input id="fecha-prog-inicio-reasignacion" type="date" class="form-control inputuser modal-input" placeholder="Fecha prog. ini. Reasignación">
                      </div>
                      <div class="form-group">
                        <label for="fecha-prog-fin-reasignacion">Fecha programada Fin Reasignación</label>
                        <input id="fecha-prog-fin-reasignacion" type="date" class="form-control inputuser modal-input" placeholder="Fecha prog. fin Reasignación">
                      </div>
                      <div class="form-group">
                        <label for="horas-trabajadas-reasignacion">Horas Trabajadas Reasignación</label>
                        <input id="horas-trabajadas-reasignacion" type="number" class="form-control inputuser modal-input" placeholder="Horas Trabajadas Reasignación" min="1" max="2000">
                      </div>
                      <div class="form-group">
                          <label>Traslado</label>
                          <br>
													<input type="checkbox" class="flat check-traslado">
											</div>
                      <div class="form-group fecha-inicio-traslado" hidden>
                        <label for="fecha-ini-traslado-reasignacion">Fecha Inicio Traslado para Reasignación</label>
                        <input id="fecha-ini-traslado-reasignacion" type="date" class="form-control inputuser modal-input" placeholder="Fecha Inicio Traslado">
                      </div>
                      <div class="form-group fecha-final-traslado" hidden>
                        <label for="fecha-fin-traslado-reasignacion">Fecha Fin Traslado para Reasignación</label>
                        <input id="fecha-fin-traslado-reasignacion" type="date" class="form-control inputuser modal-input" placeholder="Fecha Fin Traslado">
                      </div>
                      <div class="form-group">
                        <button id="cancelar-reasignacion" type="button" class="btn btn-default btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button id="confirmarReasig" type="button" class="btn btn-default btn-confirmar">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!---Fin Modal Reasignar Maquina--->

          <!---Inicio Modal ver detalle asignación--->
          <div id="ver-detalle-asignacion" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Ver detalle de asignación:</h4>
                </div>
                <div class="modal-body">
                  <form id="form-detail-maq" action="#" method="POST" enctype="multipart/form-data">
                    <input id="detalle-id-asignacion" type="hidden" value="0">
                      <div class="form-group">
                        <label for="detalle-fecha-real-i">Fecha Real Inicio: </label>
                        <input id="detalle-fecha-real-i" type="date" class="form-control inputuser modal-input" readonly>
                      </div>
                      <div class="form-group">
                        <label for="detalle-fecha-real-f">Fecha Real Fin: </label>
                        <input id="detalle-fecha-real-f" type="date" class="form-control inputuser modal-input" readonly>
                      </div>
                      <div class="form-group">
                        <label for="detalle-fecha-prog-i">Fecha Programada Inicio: </label>
                        <input id="detalle-fecha-prog-i" type="date" class="form-control inputuser modal-input" readonly>
                      </div>
                      <div class="form-group">
                        <label for="detalle-fecha-prog-f">Fecha Programada Fin: </label>
                        <input id="detalle-fecha-prog-f" type="date" class="form-control inputuser modal-input"  readonly />
                    </div>
                    <div class="form-group">
                      <label for="detalle-horas-trabajadas">Horas Trabajadas: </label>
                      <div class="input-group">
                        <input id="detalle-horas-trabajadas" type="number" class="form-control inputuser modal-input" readonly>
                        <button class="btn btn-dafault sumar-restar-horas" type="button" data-suma-resta='sumar'>
                          <i class="fa fa-plus"></i>
                        </button>
                        <button class="btn btn-dafault sumar-restar-horas" type="button" data-suma-resta='restar'>
                          <i class="fa fa-minus"></i>
                        </button>
                      </div>
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

          <!---Fin Modal ver detalle asignacion--->
          
           
      
        </div>
      </div>
    </div>
  </div>
</div>