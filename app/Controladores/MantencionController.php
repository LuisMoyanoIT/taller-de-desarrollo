<?php
namespace app\Controladores;

use app\Modelos\Mantencion;
use app\Modelos\TipoEstadoMantencion;
use app\Modelos\Maquina;
use stdClass;

class MantencionController{

    public function getAllMantenciones(){

        $mantencion = new Mantencion();

        $allMantencion = new stdClass();

        $allMantencion->Mantenciones = $mantencion->GetAllMantenciones();

        $allMantencion->CantidadEstados = $mantencion->GetEstadosMantencion();

        return $allMantencion;
        
    }

    public function getAllTipoEstadoMantencion(){

        $tipoEstadoMantencion = new TipoEstadoMantencion();

        $allTipoEstadoMantencion = $tipoEstadoMantencion->GetAllTipoEstadoMantencion();

        return $allTipoEstadoMantencion;
        
    }

    public function postNuevaMantencion(){
        
        $nuevaMantencion = new Mantencion();

        $mantencion  = filter_input(INPUT_POST,'Mantencion',FILTER_SANITIZE_STRING);
        $fechaProgramada  = filter_input(INPUT_POST,'FechaProgramada',FILTER_SANITIZE_STRING);
        $fechaInicio  = filter_input(INPUT_POST,'FechaInicio',FILTER_SANITIZE_STRING);
        //$fechaTermino  = filter_input(INPUT_POST,'FechaTermino',FILTER_SANITIZE_STRING);
        $idMaquina = filter_input(INPUT_POST,'IdMaquina',FILTER_SANITIZE_STRING);
        $tipoMantencion  = filter_input(INPUT_POST,'TipoMantencion',FILTER_SANITIZE_STRING);
        
            
        $idMantencion = $nuevaMantencion->PostNuevaMantencion($mantencion, $fechaProgramada, $fechaInicio,  $idMaquina, $tipoMantencion);

        $maquina= new Maquina();
        $estado=4;
        $maquina->PostEditarEstadoMaquina($idMaquina, $estado);

        $nuevaMaquina = $nuevaMantencion->GetMantencion($idMantencion);

        return $nuevaMaquina;
    }
    
    public function postEditarMantencion(){
        
        $nuevaMantencion = new Mantencion();

        $idMantencion = filter_input(INPUT_POST,'IdMantencion',FILTER_SANITIZE_STRING);
        $mantencion  = filter_input(INPUT_POST,'Mantencion',FILTER_SANITIZE_STRING);
        $fechaInicio  = filter_input(INPUT_POST,'FechaInicio',FILTER_SANITIZE_STRING);
        $fechaTermino  = filter_input(INPUT_POST,'FechaTermino',FILTER_SANITIZE_STRING);
        $fechaProgramada  = filter_input(INPUT_POST,'FechaProgramada',FILTER_SANITIZE_STRING);
        $tipoMantencion  = filter_input(INPUT_POST,'TipoMantencion',FILTER_SANITIZE_STRING);
        
            
        $nuevaMaquina = $nuevaMantencion->PostEditarMantencion($idMantencion, $mantencion, $fechaInicio, $fechaTermino, $fechaProgramada, $tipoMantencion);
        
        return $nuevaMaquina;
    }

    //funcion que recibe la Id desde Ajax y se la envia al modelo para que realice la consulta
    public function postEliminarMantencion()
    {
        $ideliminarmantencion=filter_input(INPUT_POST,'IdMantencion',FILTER_SANITIZE_STRING);
        $idMaquina=filter_input(INPUT_POST,'IdMaquina',FILTER_SANITIZE_STRING);
        $delman= new Mantencion();
        $deleteidmantencion=$delman->PostEliminarMantencion($ideliminarmantencion);

        $maquina= new Maquina();
        $estado=1;
        $maquina->PostEditarEstadoMaquina($idMaquina, $estado);

        return $deleteidmantencion;

    }

    public function postCambiarEstadoMantencion()
    {
        $idMantencion=filter_input(INPUT_POST,'IdMan',FILTER_SANITIZE_STRING);
        $idMaquina=filter_input(INPUT_POST,'IdMaquina',FILTER_SANITIZE_STRING);
        $nuevoEstado=filter_input(INPUT_POST,'Estado',FILTER_SANITIZE_STRING);
        
        $cambiarEstado= new Mantencion();
        $cambiarEstado->PostCambiarEstadoMantencion($idMantencion,$nuevoEstado);

        $contadores = $cambiarEstado->GetEstadosMantencion();

        if(isset($nuevoEstado) && $nuevoEstado == 3){

            $maquina= new Maquina();
            $estado=1;
            $maquina->PostEditarEstadoMaquina($idMaquina, $estado);
        }

        //$texto_mail="Se cambio de estado";
        //$destinatario="luismocru@gmail.com";
        //$asunto="Cambio de estado";
        
        //mail($destinatario, $asunto, $texto_mail);

        return $contadores;
    }

    

}

?>