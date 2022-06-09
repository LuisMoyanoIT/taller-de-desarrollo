<?php
namespace app\Controladores;

use app\Modelos\Maquina;
use app\Modelos\TipoMaquina;

class Maquinaria{

    public function getAllMaquinas(){

        $maquina = new Maquina();

        $allMaquinas = $maquina->GetAllMaquinas();

        return $allMaquinas;
        
    }

    public function getAllTipoMaquina(){

        $tipoMaquina = new TipoMaquina();

        $allTipoMaquina = $tipoMaquina->GetAllTipoMaquina();

        return $allTipoMaquina;
        
    }

    public function postNuevaMaquina(){
        
        $maquina = new Maquina();

        $nombre = filter_input(INPUT_POST,'Nombre',FILTER_SANITIZE_STRING);
        $descripcion  = filter_input(INPUT_POST,'Descripcion',FILTER_SANITIZE_STRING);
        $idTipoMaquina  = filter_input(INPUT_POST,'IdTipoMaquina',FILTER_SANITIZE_STRING);
        
        $nombreRepetido = $maquina->GetMaquinaByNombre($nombre);

        if(isset($nombreRepetido) && $nombreRepetido != false){

            $repetido = 'repetido??';
            return $repetido;        
        }

        $idMaquina = $maquina->PostNuevaMaquina($nombre, $descripcion, $idTipoMaquina);

        $nuevaMaquina = $maquina->GetMaquina($idMaquina);
        
        return $nuevaMaquina;
    }
     //funcion para seleccionar las maquinas segun su estado 1:disponibles, 2:asignadas, 3:reasignadas, 4: en mantencion, 5:inhabilitadas
    public function GetAllMaquinasByEstado($estado){

        $maquina = new Maquina();
        $allMaquinasByEstado =$maquina->GetAllMaquinasByEstado($estado);
        return $allMaquinasByEstado;
    }
    //funcion para asignar una maquina con estado disponible
    public function postNuevaAsignacion()
    {
        $maquina= new Maquina();

    }
    public function postDeshabilitarMaquina(){
    $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING); 
    $deshabilitarM =  new  Maquina();
        $dmaquina = $deshabilitarM->postDeshabilitarMaquina($id);
        return $dmaquina;
    }
   
    public function postEditarMaquina(){
    
        
        $maquinaM = new Maquina();

        $idMaquinaEditar = filter_input(INPUT_POST,'EIdMaquina',FILTER_SANITIZE_STRING);
        $nombreEditar= filter_input(INPUT_POST,'ENombre',FILTER_SANITIZE_STRING);
        $descripcionEditar= filter_input(INPUT_POST,'EDescripcion',FILTER_SANITIZE_STRING);

        $editableM = $maquinaM->postEditarMaquina($idMaquinaEditar, $nombreEditar, $descripcionEditar);
            return $editableM;

    }

    public function getEstadosMaquina(){

        $estados = new Maquina();

        $allEstadosMaquinas = $estados->GetEstadosMaquina();

        return $allEstadosMaquinas;
        
    }

    public function getTiposMaquina(){

        $tipos = new Maquina();

        $allTiposMaquinas = $tipos->GetTiposMaquina();

        return $allTiposMaquinas;
        
    }

    public function getTiposMaquinaDisponible(){

        $tipos = new Maquina();

        $allTiposMaquinasDisponibles = $tipos->GetTiposMaquinaDisponible();

        return $allTiposMaquinasDisponibles;
        
    }
    
    public function getMasHorasMaquina(){

        $masHoras = new Maquina();

        $allHorasMaquinas = $masHoras->GetMasHorasMaquina();

        return $allHorasMaquinas;
    }

}

?>