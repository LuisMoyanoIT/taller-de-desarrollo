<?php 
use app\Controladores\Maquinaria;
?>            
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Listado Maquinarias</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">   
                                 <!--INICIO PIE CHART Top 10 mas horas --->
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pie Chart <small>Tipos maquinas</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-topdiez-maquina" 
                        style="width:100%; height:300px;"
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Pie chart -->
            
      <!--  FIN PIE CHART Top 10 mas horas--->         
                                    <table id="maquinaria-table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">N°</th>
                                                <th width="15%">Nombre</th>
                                                <th width="5%">Tipo</th>
                                                <th>Descripcion</th>
                                                <th width="5%">H/T</th>
                                                <th width="20%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $maquinaria = new Maquinaria();
                                            $maquinas = $maquinaria->getAllMaquinas();
                                            
                                            foreach ($maquinas as $maquina) {
                                                
                                                ?>
                                                
                                                <tr role="row" class="even">
                                                    <td class="idnum"></td>
                                                    <td class="nombre"><?= $maquina->Nombre_MaqMaquina ?></td>
                                                    <td class="tipoMaquina"><?= $maquina->TipoMaquina ?></td>
                                                    <td class="descMaquina"><?= $maquina->Descripcion_MaqMaquina ?></td>
                                                    <td class="horasTotales"><?= $maquina->HorasTotales_MaqMaquina ?></td>
                                                    <td>
                                                        <button class="btn btn-dafault btn-sm editar-maquina"
                                                                data-id-maquina='<?=$maquina->ID_MaqMaquina?>' 
                                                                data-nombre-de-maquina='<?=$maquina->Nombre_MaqMaquina?>' 
                                                                data-descripcion-maquina='<?=$maquina->Descripcion_MaqMaquina?>' 
                                                                data-tipo-maquinaria='<?=$maquina->TipoMaquina?>' 
                                                                data-toggle="modal" data-target="#Editar-Maquina"
                                                                title="Editar" >
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-dafault btn-sm deshabilitar-maquina"  
                                                                data-id-deshabilitar='<?=$maquina->ID_MaqMaquina ?>' 
                                                                data-estado-maquina='<?= $maquina->ID_MaqTipoEstadoMaquina ?>' 
                                                                title="Deshabilitar">
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