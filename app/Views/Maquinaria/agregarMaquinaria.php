<?php 
use app\Controladores\Maquinaria;

?>
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Formulario Agregar Maquinarias</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br />
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                          <div class="form-group row">
                            <!--NOMBRE -->
                            <div class="col-sm-6">   
                                <label class="col-form-label">Nombre</label>
                                <input type="text" id="nombreMaquina" required="required" class="form-control" >   
                            </div>
                            <!--DESCRIPCION -->
                            <div class="col-sm-6">
                                <label class="col-form-label">Descripcion</label>
                                <input type="text" id="descripcionMaquina" required="required" class="form-control" >
                            </div>
                          </div>
                          <div class="form-group row">
                            <!--DESCRIPCION -->
                            <div class="col-sm-6">
                                <label class="col-form-label">Tipo</label>
                                <select id="idTipoMaquina" class="form-control">
                                <option value='-1' selected >Seleccione</option>
                                <?php
                                  $maquinaria = new Maquinaria();
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
                                <button type="button" id="guardar-maquina" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>