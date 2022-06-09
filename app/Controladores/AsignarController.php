<?php 
namespace app\Controladores;

use app\Modelos\Asignar;
use app\Modelos\Maquina;
use app\Modelos\Obras;

Class AsignarController
{
    public function postNuevaAsignacion(){   //se definen las variables y se envian al modelo
        $asig= new Asignar();
        
        $FechaProgInicioAsig = filter_input(INPUT_POST,'FechaProgInicioAsig',FILTER_SANITIZE_STRING);
        $FechaProgFinAsig = filter_input(INPUT_POST,'FechaProgFinAsig',FILTER_SANITIZE_STRING);
        $FechaRealInicioAsignacion = $FechaProgInicioAsig;
        $FechaRealFinAsignacion = $FechaProgFinAsig;
        $HorasTrabajadas = filter_input(INPUT_POST,'HorasTrabajadas',FILTER_SANITIZE_STRING);
        $FechaInicioTraslado = filter_input(INPUT_POST,'FechaInicioTraslado',FILTER_SANITIZE_STRING);
        $FechaFinTraslado = filter_input(INPUT_POST,'FechaFinTraslado',FILTER_SANITIZE_STRING);
        $IdMaquina = filter_input(INPUT_POST,'IdMaquina',FILTER_SANITIZE_STRING);
        $IdObra = filter_input(INPUT_POST,'IdObra',FILTER_SANITIZE_STRING);
        $TipoMaquinaAsignada =filter_input(INPUT_POST,'TipoMaquinaDisponible',FILTER_SANITIZE_STRING);
        $NombreMaquinaAsignada=filter_input(INPUT_POST,'NombreMaquina',FILTER_SANITIZE_STRING);
        //$IdTipoTraslado = filter_input(INPUT_POST,'IdTipoTraslado',FILTER_SANITIZE_STRING); NombreMaquina
        
        $nuevaAsig = $asig->PostNuevaAsignacion($FechaProgInicioAsig, $FechaProgFinAsig, $FechaRealInicioAsignacion, $FechaRealFinAsignacion, $HorasTrabajadas,  $IdMaquina, $IdObra);

        if($FechaInicioTraslado != '' && $FechaFinTraslado != '')
        {
          $asig->PostNuevoTrasladoAsignacion($nuevaAsig, $FechaInicioTraslado, $FechaFinTraslado);   
        }

        $IdMaquinaAsignada= new Maquina();
        $estado=2;
        $IdMaquinaAsignada->PostEditarEstadoMaquina($IdMaquina, $estado);
        $FechaProgInicio = date('d/m/Y',strtotime($FechaProgInicioAsig));
        $FechaProgFin = date('d/m/Y',strtotime($FechaProgFinAsig));

        $SolicitarNombre = new Obras();
        $NombreObra = $SolicitarNombre->GetObraById($IdObra);

        $texto_mail="Nombre máquina: " .  $NombreMaquinaAsignada . "\n Tipo máquina: " . $TipoMaquinaAsignada . "\nObra: ". $NombreObra[0]->Nombre_Obra . "\n Fecha inicio: ". $FechaProgInicio . "\n Fecha final: " . $FechaProgFin . "\n Horas trabajadas: " . $HorasTrabajadas;
        $destinatario="luismocru@gmail.com";
        $asunto="Nueva asignación";
        mail($destinatario, $asunto, $texto_mail);

        return $nuevaAsig;
    }    
    

    public function getAllAsignaciones(){

        $asignacion = new Asignar();

        $allAsignadas = $asignacion->getAllAsignaciones();

        return $allAsignadas;
        
    }

    public function postDeleteAsignacion(){
    
        $id = filter_input(INPUT_POST,'idAsig',FILTER_SANITIZE_STRING);
        //enviar id por ajax y ahi hacer la 
        $IdMaquinaDelete=filter_input(INPUT_POST,'idMaqAsig',FILTER_SANITIZE_STRING); 
        $delete =  new  Asignar();
        $deleteAsignada = $delete->PostDeleteAsignacion($id);
        $IdMaquinaAsignada= new Maquina();
        $estado=1;
        $IdMaquinaAsignada->PostEditarEstadoMaquina($IdMaquinaDelete, $estado);


        //$texto_mail="Se cambio de estado";
        //$destinatario="luismocru@gmail.com";
        //$asunto="eliminado asignacion";
        //mail($destinatario, $asunto, $texto_mail);

        return $deleteAsignada;
    }


    
    public function postEditarAsignacion()
    {
        $editarAsig= new Asignar();
        $eIdAsignacion=filter_input(INPUT_POST,'EIdAsignacion',FILTER_SANITIZE_STRING);
        $eFechaRealInicioAsignacion=filter_input(INPUT_POST,'EFechaRealInicioAsignacion',FILTER_SANITIZE_STRING);
        $eFechaRealFinAsignacion=filter_input(INPUT_POST,'EFechaRealFinAsignacion',FILTER_SANITIZE_STRING);
        $eFechaProgInicioAsignacion=filter_input(INPUT_POST,'EFechaProgInicioAsignacion',FILTER_SANITIZE_STRING);
        $eFechaProgFinAsignacion=filter_input(INPUT_POST,'EFechaProgFinAsignacion',FILTER_SANITIZE_STRING);
        $eNombreMaquina=filter_input(INPUT_POST,'ENombreMaquina',FILTER_SANITIZE_STRING);
        $eTipoMaquina=filter_input(INPUT_POST,'ETipoMaquina',FILTER_SANITIZE_STRING);
        $eNombreObra=filter_input(INPUT_POST,'ENombreObra',FILTER_SANITIZE_STRING);

        $editarAsignacion=$editarAsig->PostEditarAsignacion($eIdAsignacion, $eFechaRealInicioAsignacion, $eFechaRealFinAsignacion, $eFechaProgInicioAsignacion, $eFechaProgFinAsignacion );
        
        $eFechaRealInicio = date('d/m/Y',strtotime($eFechaRealInicioAsignacion));
        $eFechaRealFin = date('d/m/Y',strtotime($eFechaRealFinAsignacion));
        $texto_mail="Nombre máquina: " .  $eNombreMaquina . "\n Tipo máquina: " . $eTipoMaquina . "\nObra: ". $eNombreObra . "\n Fecha inicio: ". $eFechaRealInicio . "\n Fecha final: " . $eFechaRealFin;
        $destinatario="luismocru@gmail.com";
        $asunto="Se ha modificado la asignación";
        mail($destinatario, $asunto, $texto_mail);



        return $editarAsignacion;
    }
    
    public function postCambiarHorasTrabajadas(){

        $asignacion= new Asignar();
        $idAsignacion=filter_input(INPUT_POST,'IdAsig',FILTER_SANITIZE_STRING);
        $horasTrabajadas=filter_input(INPUT_POST,'Horas',FILTER_SANITIZE_STRING);
        
        
        $horasAsignacion=$asignacion->GetHorasAsignar($idAsignacion);

        $horasTotales = $horasAsignacion->HorasTrabajadas_MaqAsigna + $horasTrabajadas;

        $horasCambiadas = $asignacion->PostActualizarHoras($idAsignacion, $horasTotales);

        return $horasCambiadas;
    }
}



?>