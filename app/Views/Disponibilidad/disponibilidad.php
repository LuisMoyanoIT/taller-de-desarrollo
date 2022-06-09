<!-- page content -->
<link rel="stylesheet" href="Documentacion/styles/disponibilidad.css">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Disponibilidad</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="lightTab">
        <div class="minimalTabs">

          <ul>
            <li><a href="#Disponibles">
                <span><b>Disponibles</b></span></a></li>
            <li><a href="#Asignadas">
                <span><b>Asignadas</b></span></a></li>
            <li><a href="#Reasignadas">
                <span><b>Reasignadas</b></span></a></li>
            <li><a href="#Todas">
                <span><b>Todas</b></span></a></li>
            <li><a href="#Historial">
                <span><b>Historial</b></span></a></li>
          </ul>

          <div class="contents">
            <!--- Inicia pestaña disponibles-->
            <div id="Disponibles">
              <?php
              include 'disponibles.php';
              ?>
            </div>
            <!--- Fin pestaña disponibles-->
            <!--- Inicia pestaña Asignadas-->
            <div id="Asignadas">
              <?php
              include 'asignadas.php';
              ?>
            </div>
            <!--- Fin pestaña Asignadas-->
            <!--- Inicia pestaña Reasignadas-->
            <div id="Reasignadas">
              <?php
              include 'reasignadas.php';
              ?>
            </div>
            <!--- Fin pestaña Reasignadas-->
            <!--- Inicia pestaña Todas-->
            <div id="Todas">
              <?php
              include 'todas.php';
              ?>
            </div>
            <!--- Fin pestaña Todas-->
            <!--- Inicia pestaña Historial-->
            <div id="Historial">
              <?php
              include 'historial.php';
              ?>
            </div>
            <!--- FIn pestaña historial-->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- /page content -->