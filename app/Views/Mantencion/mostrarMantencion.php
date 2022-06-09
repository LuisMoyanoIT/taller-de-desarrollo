<?php
use app\Controladores\MantencionController;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listado Mantenciones</h2>
                <div class="clearfix"></div>
            </div>
            <?php   
                    $mantencionController = new MantencionController();
                    $mantenciones = $mantencionController->getAllMantenciones();
                    foreach ($mantenciones->CantidadEstados as $cantidadEstados) {
                ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pie Chart <small>Sessions</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-estados" 
                        style="width:100%; height:300px;"
                        data-pendientes='<?= $cantidadEstados->CantidadPendientes ?>'
                        data-mantencion='<?= $cantidadEstados->CantidadMantencion ?>'
                        data-terminadas='<?= $cantidadEstados->CantidadTerminadas ?>'
                        data-totales='<?= $cantidadEstados->TotalEstados ?>'>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Pie chart -->
              <?php
                    }
              ?>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered mantencion-table mostrar" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="1%">N°</th>
                                    <th width="15%">Nombre</th>
                                    <th width="15%">Mantencion</th>
                                    <th width="10%">Tipo</th>
                                    <th width="5%">Estado</th>
                                    <th width="13%">Fecha Pro.</th>
                                    <th width="13%">Fecha Ini.</th>
                                    <th width="13%">Fecha Fin.</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                
                                foreach ($mantenciones->Mantenciones as $mantencion) {
                                    
                                    $estado = $mantencion->IdEstado;

                                ?>

                                    <tr role="row" class="even">
                                        <td></td>
                                        <td><?= $mantencion->NombreMaquina ?></td>
                                        <td data-id-mantencion='<?= $mantencion->IdMantencion ?>' class="desc-mantencion"><?= $mantencion->Mantencion ?></td>
                                        <td data-id-mantencion='<?= $mantencion->IdMantencion ?>' class="tipo-mantencion"><?= $mantencion->TipoMantencion ?></td>
                                        <td>
                                            <div class="col-md-6">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button data-id-mantencion = '<?= $mantencion->IdMantencion ?>'
                                                            data-id-maquina='<?= $mantencion->IdMaquina ?>'
                                                            data-estado = '1'
                                                            class="btn btn-<?= ($estado==1) ? 'danger' : 'secondary';?> cambiar-estado new" 
                                                            type="button" title="Pendiente" <?= ($estado==3) ? 'disabled' : '';?>>P
                                                    </button>
                                                    <button data-id-mantencion='<?= $mantencion->IdMantencion ?>'
                                                            data-id-maquina='<?= $mantencion->IdMaquina ?>'
                                                            data-estado = '2'
                                                            class="btn btn-<?= ($estado==2) ? 'warning' : 'secondary';?> cambiar-estado new" 
                                                            type="button" title="Mantencion" <?= ($estado==3) ? 'disabled' : '';?>>M
                                                    </button>
                                                    <button data-id-mantencion='<?= $mantencion->IdMantencion ?>'
                                                            data-id-maquina='<?= $mantencion->IdMaquina ?>'
                                                            data-estado = '3'
                                                            class="btn btn-<?= ($estado==3) ? 'success' : 'secondary';?> cambiar-estado new" 
                                                            type="button" title="Terminada" <?= ($estado==3) ? 'disabled' : '';?>>T
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-id-mantencion='<?= $mantencion->IdMantencion ?>' class="fecha-programada-mantencion"><?= date('d/m/Y',strtotime($mantencion->FechaProgramada)); ?></td>
                                        <td data-id-mantencion='<?= $mantencion->IdMantencion ?>' class="fecha-inicio-mantencion"><?= date('d/m/Y',strtotime($mantencion->FechaInicio)); ?></td>
                                        <td data-id-mantencion='<?= $mantencion->IdMantencion ?>' class="fecha-fin-mantencion"><?= ($mantencion->FechaFin == null) ? '' : date('d/m/Y',strtotime($mantencion->FechaFin)); ?></td>
                                        <td>                                        
                                                <button data-id-mantencion='<?= $mantencion->IdMantencion ?>'
                                                    data-id-maquina='<?= $mantencion->IdMaquina ?>' 
                                                    data-nombre-maquina='<?= $mantencion->NombreMaquina ?>'
                                                    data-mantencion='<?= $mantencion->Mantencion ?>' 
                                                    data-tipo-mantencion='<?= $mantencion->TipoMantencion ?>' 
                                                    data-fecha-programada='<?= $mantencion->FechaProgramada ?>' 
                                                    data-fecha-inicio='<?= $mantencion->FechaInicio ?>'
                                                    data-fecha-fin='<?= $mantencion->FechaFin ?>'
                                                    type="button" 
                                                    class="btn btn-dafault btn-sm editar-mantencion new" 
                                                    data-toggle="modal" 
                                                    data-target="#AgregarMantencion"
                                                    title="Editar">
                                                <i class="fa fa-edit"><abbr title="AgregarMantencion"></abbr></i>
                                            </button>
                                            <button 
                                                    class="btn btn-dafault btn-sm eliminar-mantencion new" 
                                                    data-id-eliminar-mantencion='<?=$mantencion->IdMantencion?>'
                                                    data-id-maquina='<?= $mantencion->IdMaquina ?>'
                                                    title="Eliminar" <?= ($estado==3) ? 'disabled' : '';?>>
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
                </div>

                
            </div>
        </div>
    </div>
</div>