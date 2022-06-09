<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Arriendo extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllArriendos(){
        $query="SELECT 
                    A.*, 
                    TP.Descripcion_MaqTipoMaquina as TipoMaquina, O.Nombre_Obra as NombreObra 
                FROM 
                    MaqMaquinaArrendada A,
                    MaqTipoMaquina TP,
                    Obra O
                WHERE
                    A.ID_MaqTipoMaquina = TP.ID_MaqTipoMaquina AND A.ID_Obra=O.ID_Obra";
                

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function PostNuevoArriendo( $empresa, $descripcionArriendo, $fechaInicio, $fechaFin, $horasTrabajadas, $operador, $obra, $idTipoArriendo){
        $query = "INSERT INTO
                    MaqMaquinaArrendada(Empresa_MaqMaquinaArrendada, Nombre_MaqMaquinaArrendada, FechaInicio_MaqMaquinaArrendada, FechaFin_MaqMaquinaArrendada, HorasTrabajadas_MaqMaquinaArrendada, Operador_MaqMaquinaArrendada, ID_Obra, ID_MaqTipoMaquina) 
                VALUES 
                    ( :empresa, :descripcionArriendo,:fechaInicio, :fechaFin, :horasTrabajadas, :operador, :obra, :idTipoMaquina)";
                    
        //resultado de la query
        $resultado = $this->connect()->prepare($query);
        
           
        $resultado->bindParam(':empresa', $empresa);
        $resultado->bindParam(':descripcionArriendo', $descripcionArriendo);
        $resultado->bindParam(':fechaInicio', $fechaInicio);
        $resultado->bindParam(':fechaFin', $fechaFin);
        $resultado->bindParam(':horasTrabajadas', $horasTrabajadas);
        $resultado->bindParam(':operador', $operador);
        $resultado->bindParam(':obra', $obra);
        $resultado->bindParam(':idTipoMaquina', $idTipoArriendo);
        $resultado->execute();
        return true;        
    }

    function PostEditarArriendo($idArriendoEditar, $empresaEditar, $horasEditar,$fechaInicioEditar,$fechaFinEditar,$operadorEditar){
    $query= "UPDATE MaqMaquinaArrendada
             SET Empresa_MaqMaquinaArrendada = :empresaEditar, FechaInicio_MaqMaquinaArrendada = :fechaInicioEditar, 
             FechaFin_MaqMaquinaArrendada = :fechaFinEditar, HorasTrabajadas_MaqMaquinaArrendada = :horasEditar, Operador_MaqMaquinaArrendada = :operadorEditar 
             WHERE ID_MaqMaquinaArrendada = :idArriendoEditar";

        $resultadoA = $this->connect()->prepare($query);
       
        $resultadoA->bindParam(':idArriendoEditar', $idArriendoEditar);
        $resultadoA->bindParam(':empresaEditar', $empresaEditar);
        $resultadoA->bindParam(':horasEditar', $horasEditar);
        $resultadoA->bindParam(':fechaInicioEditar', $fechaInicioEditar);
        $resultadoA->bindParam(':fechaFinEditar', $fechaFinEditar);
        $resultadoA->bindParam(':operadorEditar', $operadorEditar);
        $resultadoA->execute();
        
        return true; 

    }

    function PostDeleteArriendo($idAriendo){

        
        $query="DELETE FROM MaqMaquinaArrendada WHERE ID_MaqMaquinaArrendada = :idAriendo";
        $resultado = $this->connect()->prepare($query);
        $resultado->bindParam(':idAriendo', $idAriendo);
        $resultado->execute();       

        return true;
    }
}


?>