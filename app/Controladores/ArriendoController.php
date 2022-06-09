<?php
namespace app\Controladores;

use app\Modelos\Arriendo;
use app\Modelos\TipoMaquina;

class ArriendoController{

    public function getAllArriendos(){

        $Arriendo = new Arriendo();

        $allArriendo = $Arriendo->GetAllArriendos();

        return $allArriendo;
        
    }

    public function getAllTipoMaquina(){

        $tipoMaquina = new TipoMaquina();

        $allTipoMaquina = $tipoMaquina->GetAllTipoMaquina();

        return $allTipoMaquina;
        
    }

    public function PostNuevoArriendo(){
        //SE SANITIZAN LAS VARIABLES Y POSTERIORMENTE SE ENVIAN AL MODELO
        $maquina = new Arriendo();

        $fechaInicio = filter_input(INPUT_POST,'FechaInicio',FILTER_SANITIZE_STRING);
        $fechaFin= filter_input(INPUT_POST,'FechaFin',FILTER_SANITIZE_STRING);
        $empresa = filter_input(INPUT_POST,'Empresa',FILTER_SANITIZE_STRING);
        $descripcionArriendo  = filter_input(INPUT_POST,'DescripcionArriendo',FILTER_SANITIZE_STRING);
        $horasTrabajadas= filter_input(INPUT_POST,'HorasTrabajadas',FILTER_SANITIZE_STRING);
        $obra= filter_input(INPUT_POST,'Obra',FILTER_SANITIZE_STRING);
        $operador= filter_input(INPUT_POST,'Operador',FILTER_SANITIZE_STRING);
        $idTipoMaquina  = filter_input(INPUT_POST,'IdTipoArriendo',FILTER_SANITIZE_STRING);
            
        $arriendo = $maquina->PostNuevoArriendo($empresa, $descripcionArriendo, $fechaInicio, $fechaFin, $horasTrabajadas, $operador, $obra, $idTipoMaquina);
            return $arriendo;

    }
    public function PostEditarArriendo(){
        
        $maquinaA = new Arriendo();
        $idArriendoEditar = filter_input(INPUT_POST,'EIdArriendo',FILTER_SANITIZE_STRING);
        $empresaEditar= filter_input(INPUT_POST,'Eempresa',FILTER_SANITIZE_STRING);
        $horasEditar= filter_input(INPUT_POST,'Ehoras',FILTER_SANITIZE_STRING);
        $fechaInicioEditar = filter_input(INPUT_POST,'Efechainicio',FILTER_SANITIZE_STRING);
        $fechaFinEditar= filter_input(INPUT_POST,'Efechafin',FILTER_SANITIZE_STRING);
        $operadorEditar= filter_input(INPUT_POST,'Eoperador',FILTER_SANITIZE_STRING);
            
        $resultado = $maquinaA->PostEditarArriendo($idArriendoEditar, $empresaEditar,$horasEditar,$fechaInicioEditar,$fechaFinEditar,$operadorEditar);
            return $resultado;
    }

    public function postDeleteArriendo(){
    
        $id = filter_input(INPUT_POST,'idArrien',FILTER_SANITIZE_STRING);
        $fechafe = filter_input(INPUT_POST,'fechafine',FILTER_SANITIZE_STRING);
        $fechaie = filter_input(INPUT_POST,'fechainie',FILTER_SANITIZE_STRING);
        $tipome = filter_input(INPUT_POST,'tipomaquinae',FILTER_SANITIZE_STRING);
        $obraee = filter_input(INPUT_POST,'obrae',FILTER_SANITIZE_STRING);
        $horase = filter_input(INPUT_POST,'horae',FILTER_SANITIZE_STRING);
        $empresael = filter_input(INPUT_POST,'empresae',FILTER_SANITIZE_STRING);
        $operae = filter_input(INPUT_POST,'operadore',FILTER_SANITIZE_STRING);
        $fechai = date('d/m/Y',strtotime($fechaie));
        $fechaf = date('d/m/Y',strtotime($fechafe));
        $delete =  new  Arriendo();
        $deleteArriendo = $delete->PostDeleteArriendo($id);
        
        //POSTERIOR A LA ELIMINACION DEL ARRIENDO ENVIARA EL CORREO NOTIFICANDO
        $texto_mail="Se elimino un arriendo con fecha inicial: ". $fechai . ", fecha final: " . $fechaf .", con " . $horase . " horas de la empresa: " . $empresael . ", con tipo de maquina: " . $tipome . " que ocuparia el operador " . $operae . ", para la obra: " . $obraee;
        $destinatario="mplqmyalyt@gmail.com";
        $asunto="Eliminacion arriendo";
        
        mail($destinatario, $asunto, $texto_mail);
        
        
        return $deleteArriendo;
    }
}
?>