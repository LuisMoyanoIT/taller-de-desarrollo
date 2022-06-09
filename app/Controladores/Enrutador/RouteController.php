<?php
require_once '../../../autoload.php';

use app\Controladores\Maquinaria;
use app\Controladores\ArriendoController;
use app\Controladores\MantencionController;
use app\Controladores\AsignarController;
use app\Controladores\ReasignarController;

//Comprobamos que el valor no venga vacío
if (isset($_POST['Method']) && !empty($_POST['Method'])) {

    $funcion = $_POST['Method'];

    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch ($funcion) {
        case 'postNuevaMantencion':
            $mantencionController = new MantencionController();
            $nuevaMantencion = $mantencionController->postNuevaMantencion();
            //echo $nuevaMantencion;
            //print_r($nuevaMantencion);
            var_dump($nuevaMantencion);
            break;
        case 'postNuevaMaquina':
            $maquina = new Maquinaria();
            $nueva = $maquina->postNuevaMaquina();
            //echo $nueva;
            //print_r($nueva);
            /* if($nueva == 'repetido??'){

            } */
            var_dump($nueva);
            break;
        case 'postNuevoArriendo':
            $arriendoController = new ArriendoController();
            $nuevoArriendo = $arriendoController->PostNuevoArriendo();
            echo $nuevoArriendo;
            break;
        case 'postEditarArriendo':
            $arriendoEdit = new ArriendoController();
            $edicionArriendo = $arriendoEdit->PostEditarArriendo();
            echo $edicionArriendo;
            break;
        case 'postEditarMantencion':
            $mantencionController = new MantencionController();
            $editarMantencion = $mantencionController->postEditarMantencion();
            echo $editarMantencion;
            break;
        case 'postNuevaAsignacion':
            $asig = new AsignarController;
            $nuevaAsig = $asig->postNuevaAsignacion();
            echo $nuevaAsig;
            break;
        case 'postEliminarAsignacion':
            $delete = new AsignarController;
            $eliminarAsig = $delete->postDeleteAsignacion();
            echo $eliminarAsig;
            break;
        case 'postEditarAsignacion':
            $editar= new AsignarController();
            $asignacion=$editar->postEditarAsignacion();
            var_dump($asignacion);
            break;
        case 'postEliminarArriendo':
            $arriendoDelete = new ArriendoController();
            $eliminarArriendo = $arriendoDelete->postDeleteArriendo();
            echo $eliminarArriendo;
            break;
        case 'postDeshabilitarMaquina':
            $deshabilitar= new Maquinaria();
            $desmaquina= $deshabilitar->postDeshabilitarMaquina();
            echo $desmaquina;
            break;
        case 'postEliminarMantencion':
            $delman= new MantencionController();
            $deleteidmantencion= $delman->postEliminarMantencion();
            echo $deleteidmantencion;
            break;
        case 'postNuevaReasignacion':
            $reasignarController = new ReasignarController();
            $nuevaReasignacion = $reasignarController->postNuevaReasignacion();
            echo $nuevaReasignacion;
            break;
        case 'postEditarMaquina':
            $editarmaquina = new Maquinaria();
            $maquinaeditada = $editarmaquina->postEditarMaquina();
            echo $maquinaeditada;
            break;
        case 'postEliminarReasignacion':
            $deleteReasignacion = new ReasignarController();
            $eliminarByIdReasignacion=$deleteReasignacion->postEliminarReasignacion();
            echo $eliminarByIdReasignacion;
            break;        
        case 'postCambiarEstado':
            $mantencionController = new MantencionController();
            $estadoMantencion = $mantencionController->postCambiarEstadoMantencion();
            //echo $estadoMantencion;
            var_dump($estadoMantencion);
            break;
        case 'postEditarReasignacion':
            $editarRe= new ReasignarController();
            $reasignacion=$editarRe->postEditarReasignacion();
            echo($reasignacion);
            break;
        case 'postCambiarHorasTrabajadas':
            $asignarController= new AsignarController();
            $actualizarHoras=$asignarController->postCambiarHorasTrabajadas();
            echo $actualizarHoras;
            break;
        case 'postDatosGraficoTopMaquinas':
            $maquinariaControl= new Maquinaria();
            $topMaquinas = $maquinariaControl->getMasHorasMaquina();
            var_dump ($topMaquinas);
            break;
                            

    }
}
