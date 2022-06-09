<?php 
use app\Controladores\TrasladoController;
?>   
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Traslados</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="lightTab">
        <div class="minimalTabs">

          <ul>
            <li><a href="#Mostrar">
                <span><b>Mostrar</b></span></a></li>
          </ul>

          <div class="contents">
            <div id="Mostrar">
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Listado Traslados</h2>
                      <ul class="nav navbar-right panel_toolbox" style="justify-content:flex-end;">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="traslados-table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="1%">N°</th>
                                <th width="25%">Maquina</th>
                                <th width="24%">Obra</th>
                                <th width="15%">Tipo Traslado</th>
                                <th width="15%">Fecha de Inicio</th>
                                <th width="20%">Fecha de Termino</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $trasladoController = new TrasladoController();
                              $traslados = $trasladoController->getAllTraslados();
                              $id = 0;
                              foreach ($traslados as $traslado) {
                                $id++;
                                
                              ?>

                                <tr role="row" class="even">
                                  <td><?= $id ?></td>
                                  <td><?= $traslado->NombreMaquina ?></td>
                                  <td><?= $traslado->Obra ?></td>
                                  <td><?= $traslado->TipoTraslado ?></td>
                                  <td><?= $traslado->FechaInicio ?></td>
                                  <td><?= $traslado->FechaFinal ?></td>
                                  
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
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->