<?php 
use app\Controladores\ArriendoController;
use app\Controladores\ObraController;

?>
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Arriendos</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br />
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                          <div class="form-group row">
                            <!--Fecha inicio -->
                          <div class="col-sm-6">   
                            <label class="col-form-label">Fecha de inicio</label>
                            <input type="date" id="fechaInicio" required="required" class="form-control">   
                          </div>
                            <!--Fecha de fin -->
                          <div class="col-sm-6">
                            <label class="col-form-label">Fecha de fin</label>
                            <input type="date" id="fechaFin" required="required" class="form-control" >
                          </div>
                          </div>
                          <div class="form-group row">
                            <!--Empresa -->
                          <div class="col-sm-6">   
                            <label class="col-form-label">Empresa</label>
                            <input type="text" id="empresa" required="required" class="form-control" maxlength="45" placeholder="Nombre de Empresa">   
                          </div>
                            <!--DESCRIPCION -->
                          <div class="col-sm-6">
                            <label class="col-form-label">Descripcion-opcional</label>
                            <input type="text" id="descripcionArriendo" required="required" class="form-control" maxlength="255" placeholder="Alguna descripcion">
                          </div>
                          </div>
                          <div class="form-group row">
                            <!--horas trabajadas -->
                          <div class="col-sm-6">   
                            <label class="col-form-label">H/T</label>
                            <input type="number" id="horasTrabajadas" required="required" class="form-control" min="1" max="2000" placeholder="ej:1,2,3,4..." >   
                          </div>
                            <!--obra -->
                          <div class="col-sm-6">
                            <label class="col-form-label">Obra: </label>
                            <select id="obra" class="form-control">
                            <option value='-1' selected >Seleccione</option>
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
                          </div>
                          <div class="form-group row">
                          <!--operador-->
                          <div class="col-sm-6">   
                            <label class="col-form-label">Operador</label>
                            <input type="text" id="operador" required="required" class="form-control" maxlength="45" placeholder="Nombre del Operador a cargo">   
                          </div>
                          <!--Tipo -->
                          <div class="col-sm-6">
                            <label class="col-form-label">Tipo de Maquina</label>
                            <select id="idTipoMaquina" class="form-control">
                            <option value='-1' selected >Seleccione</option>
                            <?php
                            $maquinaria = new ArriendoController();
                            $tipoMaquinas = $maquinaria->getAllTipoMaquina();
                            foreach ($tipoMaquinas as $tipoMaquina) {
                            ?>
                            <option value="<?= $tipoMaquina->IdTipoMaquina ?>"><?= $tipoMaquina->TipoMaquina ?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="item form-group">
                          <div class="col-md-6 col-sm-6 offset-md-8">
                            <button class="btn btn-primary" type="reset">Limpiar</button>
                            <button type="button" id="guardar-arriendo" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>