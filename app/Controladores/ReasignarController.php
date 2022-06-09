<?php 
namespace app\Controladores;

use app\Modelos\Reasignar;
use app\Modelos\Maquina;

Class ReasignarController
{
    public function postNuevaReasignacion()
    {   //se definen las variables y se envian al modelo
        $reasig = new Reasignar();

        $FechaProgrInicioReasig = filter_input(INPUT_POST, 'FechaProgrInicioReasig', FILTER_SANITIZE_STRING);
        $FechaProgrFinalReasig = filter_input(INPUT_POST, 'FechaProgrFinalReasig', FILTER_SANITIZE_STRING);
        $ReFechaInicioTraslado = filter_input(INPUT_POST, 'ReFechaInicioTraslado', FILTER_SANITIZE_STRING);
        $ReFechaFinalTraslado = filter_input(INPUT_POST, 'ReFechaFinalTraslado', FILTER_SANITIZE_STRING);
        $ReHorasTrabajadas = filter_input(INPUT_POST, 'ReHorasTrabajadas', FILTER_SANITIZE_STRING);
        $ReIdObra = filter_input(INPUT_POST, 'ReIdObra', FILTER_SANITIZE_STRING);
        $ReIdMaquina = filter_input(INPUT_POST, 'ReIdMaquina', FILTER_SANITIZE_STRING);

        $nuevaIdReasignacion = $reasig->PostNuevaReasignacion($FechaProgrInicioReasig, $FechaProgrFinalReasig,  $ReHorasTrabajadas, $ReIdObra, $ReIdMaquina);
        
        if($ReFechaInicioTraslado != '' && $ReFechaFinalTraslado != ''){
            
            $reasig->PostNuevoTrasladoReasignacion($ReFechaInicioTraslado, $ReFechaFinalTraslado, $nuevaIdReasignacion);
        }
        
        $IdMaquinaReasignada = new Maquina();
        $Reestado = 3;
        $IdMaquinaReasignada->PostEditarEstadoMaquinaRe($ReIdMaquina, $Reestado);

        return true;
    }     
    

    public function getAllReasignaciones(){

        $reasignacion = new Reasignar();

        $allReasignadas = $reasignacion->getAllReasignaciones();

        return $allReasignadas;
        
    }


     /*
    Funcion que recibe Id desde el routeController para enviarsela al Modelos/Reasignar.php en donde se realizara la consulta sql que elimina la funcion
    */
    public function postEliminarReasignacion()
    {
        $idDeleteReasig = filter_input(INPUT_POST,'ideletereasignacion',FILTER_SANITIZE_STRING);
        $idDeleteMaquinaRe=filter_input(INPUT_POST,'iddeletemaquinare',FILTER_SANITIZE_STRING);
        $FechaRealFinalRe=filter_input(INPUT_POST,'FechaRealFinalRe',FILTER_SANITIZE_STRING);
        $NombreMaquinaRe=filter_input(INPUT_POST,'NombreMaquinaRe',FILTER_SANITIZE_STRING);
        $TipoMaquinaRe=filter_input(INPUT_POST,'TipoMaquinaRe',FILTER_SANITIZE_STRING);
        $NombreObraRe=filter_input(INPUT_POST,'NombreObraRe',FILTER_SANITIZE_STRING);
        $FechaRealInicialRe=filter_input(INPUT_POST,'FechaRealInicialRe',FILTER_SANITIZE_STRING);
        $deleteRe = new Reasignar();
        $eliminarIdReasignacion=$deleteRe->PostEliminarReasignacion($idDeleteReasig);
        $IdMaquinaReasignada= new Maquina();
        $estado=1;
        $IdMaquinaReasignada->PostEditarEstadoMaquina($idDeleteMaquinaRe, $estado);

        $FechaRealInicio = date('d/m/Y',strtotime($FechaRealInicialRe));
        $FechaRealFin = date('d/m/Y',strtotime($FechaRealFinalRe));

        $texto_mail="Nombre máquina: " .  $NombreMaquinaRe . "\n Tipo máquina: " . $TipoMaquinaRe . "\nObra: ". $NombreObraRe . "\n Fecha inicio: ". $FechaRealInicio . "\n Fecha final: " . $FechaRealFin;
        $destinatario="luismocru@gmail.com";
        $asunto="Se ha eliminado la máquina de la obra";
        mail($destinatario, $asunto, $texto_mail);
        return $eliminarIdReasignacion;
    }

    public function postEditarReasignacion()
    {
        $editarReasig = new Reasignar();
        $editIdReasignacion = filter_input(INPUT_POST, 'EditIdReasignacion', FILTER_SANITIZE_STRING);
        $editFechaRealInicioReasig = filter_input(INPUT_POST, 'EditFechaRealInicioReasig', FILTER_SANITIZE_STRING);
        $editFechaRealFinalReasig = filter_input(INPUT_POST, 'EditFechaRealFinalReasig', FILTER_SANITIZE_STRING);
        $editFechaProgrInicioReasig = filter_input(INPUT_POST, 'EditFechaProgrInicioReasig', FILTER_SANITIZE_STRING);
        $editFechaProgrFinalReasig = filter_input(INPUT_POST, 'EditFechaProgrFinalReasig', FILTER_SANITIZE_STRING);
        $editHorasTrabajadas = filter_input(INPUT_POST, 'EditHorasTrabajadas', FILTER_SANITIZE_STRING);
        $editarReasignacion = $editarReasig->PostEditarReasignacion($editIdReasignacion, $editFechaRealInicioReasig, $editFechaRealFinalReasig, $editFechaProgrInicioReasig, $editFechaProgrFinalReasig, $editHorasTrabajadas);
        return $editarReasignacion;
    }

}



?>