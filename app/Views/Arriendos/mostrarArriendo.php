<?php

use app\Controladores\ArriendoController;
use app\Controladores\Maquinaria;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Listado de Arriendos</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                     <!--INICIO PIE CHART TIPOS DE MAQUINA EN ARRIENDO--->
      <?php
          $maquinariaController= new Maquinaria();
          $tiposMaquinas = $maquinariaController->getTiposMaquina();
          foreach ($tiposMaquinas  as $tipoMaquina) {
      ?>
                
                <!-- pie chart -->
              <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tipo de maquinas arrendadas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div 
                        id="grafico-tipo-maquina-arrendada" 
                        style="width:350px; height:350px;"
                        data-cadenas='<?= $tipoMaquina->CargadoresCadenas ?>'
                        data-ruedas='<?= $tipoMaquina->CargadoresRuedas ?>'
                        data-compactadores='<?= $tipoMaquina->Compactadores ?>'
                        data-excavadoras='<?= $tipoMaquina->Excavadoras ?>'
                        data-manipuladoras='<?= $tipoMaquina->Manipuladores ?>'
                        data-minicargadores='<?= $tipoMaquina->Minicargadores ?>'
                        data-motoniveladores='<?= $tipoMaquina->Motoniveladoras ?>'
                        data-retroexcavadoras='<?= $tipoMaquina->Retroexcavadoras ?>'
                        data-tractores='<?= $tipoMaquina->Tractores ?>'
                        data-total-tipo-maquina='<?= $tipoMaquina->TotalTipoMaquina ?>'
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Pie chart -->
              <?php
                    }
              ?>
      <!--  FIN PIE CHART TIPOS DE MAQUINA EN ARRIENDO--->
                        <table id="" class="table table-striped table-bordered arriendo-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="1%">N°</th>
                                    <th width="20%">Empresa</th>
                                    <th width="15%">Fecha Inicio</th>
                                    <th width="15%">Fecha Fin</th>
                                    <th width="5%">H/T</th>
                                    <th width="20%">Operador</th>
                                    <th width="5%">Tipo Maquina</th>
                                    <th>obra</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Arriendo = new ArriendoController();
                                $Arrendable = $Arriendo->getAllArriendos();
                                
                                foreach ($Arrendable as $Arrendados) {
                                    
                                ?>
                                    <tr role="row" class="even">
                                        <th> </th>
                                        <td><?= $Arrendados->Empresa_MaqMaquinaArrendada ?></td>
                                        <td><?= date('d/m/Y',strtotime($Arrendados->FechaInicio_MaqMaquinaArrendada)); ?></td>
                                        <td><?= date('d/m/Y',strtotime($Arrendados->FechaFin_MaqMaquinaArrendada)); ?></td>
                                        <td><?= $Arrendados->HorasTrabajadas_MaqMaquinaArrendada ?></td>
                                        <td><?= $Arrendados->Operador_MaqMaquinaArrendada ?></td>
                                        <td><?= $Arrendados->TipoMaquina ?></td>
                                        <td><?= $Arrendados->NombreObra ?></td>
                                        <td>
                                            <button class="btn btn-dafaul btn-sm editar-arriendo"
                                                    data-id-arriendo-editar='<?= $Arrendados->ID_MaqMaquinaArrendada ?>' 
                                                    data-tipo-maquina-editar='<?= $Arrendados->TipoMaquina ?>' 
                                                    data-nombre-obra-editar='<?= $Arrendados->NombreObra ?>' 
                                                    data-horas-editar='<?= $Arrendados->HorasTrabajadas_MaqMaquinaArrendada ?>'
                                                    data-nombre-empresa-editar='<?= $Arrendados->Empresa_MaqMaquinaArrendada ?>'
                                                    data-fecha-inicio-editar='<?= $Arrendados->FechaInicio_MaqMaquinaArrendada ?>' 
                                                    data-fecha-fin-editar='<?= $Arrendados->FechaFin_MaqMaquinaArrendada ?>' 
                                                    data-nombre-operador-editar='<?= $Arrendados->Operador_MaqMaquinaArrendada ?>' 
                                                    data-toggle="modal" data-target="#Editar-Arriendo"
                                                    title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button data-id-arriendo='<?= $Arrendados->ID_MaqMaquinaArrendada ?>' 
                                                    data-fecha-fin-eliminar='<?= $Arrendados->FechaFin_MaqMaquinaArrendada ?>'
                                                    data-tipo-maquina-eliminar='<?= $Arrendados->TipoMaquina ?>' 
                                                    data-nombre-obra-eliminar='<?= $Arrendados->NombreObra ?>' 
                                                    data-horas-eliminar='<?= $Arrendados->HorasTrabajadas_MaqMaquinaArrendada ?>'
                                                    data-nombre-empresa-eliminar='<?= $Arrendados->Empresa_MaqMaquinaArrendada ?>'
                                                    data-fecha-inicio-eliminar='<?= $Arrendados->FechaInicio_MaqMaquinaArrendada ?>'
                                                    data-nombre-operador-eliminar='<?= $Arrendados->Operador_MaqMaquinaArrendada ?>' 
                                                    class="btn btn-dafault btn-sm eliminar-arriendo"
                                                    title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <button class="btn btn-default btn-sm detalle-descripcion"
                                            data-descripcion-arriendos='<?= $Arrendados->Nombre_MaqMaquinaArrendada ?>'
                                            data-toggle="modal"
                                            data-target="#ver-detalle-descripcion"
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
                </div>
            </div>
        </div>
    </div>
</div>