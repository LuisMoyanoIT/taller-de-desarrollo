<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Mantencion extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetMantencion($idMantencion){
        $query="SELECT 
                    MANT.ID_MaqMantencion AS IdMantencion, MANT.Descripcion_MaqMantencion AS Mantencion, 
                    MANT.FechaProgramada_MaqMantencion AS FechaProgramada, MANT.FechaInicio_MaqMantencion AS FechaInicio, 
                    MANT.FechaFin_MaqMantencion AS FechaFin, MANT.TipoMantencion_MaqMantencion AS TipoMantencion, 
                    MANT.ID_MaqTipoEstadoMantencion AS IdEstado, MAQ.Nombre_MaqMaquina as NombreMaquina, MAQ.ID_MaqMaquina as IdMaquina
                FROM 
                    MaqMantencion MANT 
                LEFT JOIN MaqMaquina MAQ ON
                    MANT.ID_MaqMaquina = MAQ.ID_MaqMaquina
                WHERE
                    MANT.ID_MaqMantencion = :idMantencion";

        $row = $this->connect()->prepare($query);

        $row->bindParam(':idMantencion', $idMantencion);

        $row->execute();

        $rows = $row->fetch(PDO::FETCH_OBJ);

        return $rows;
    }

    function GetAllMantenciones(){
        $query="SELECT 
                    MANT.ID_MaqMantencion AS IdMantencion, MANT.Descripcion_MaqMantencion AS Mantencion, 
                    MANT.FechaProgramada_MaqMantencion AS FechaProgramada, MANT.FechaInicio_MaqMantencion AS FechaInicio, 
                    MANT.FechaFin_MaqMantencion AS FechaFin, MANT.TipoMantencion_MaqMantencion AS TipoMantencion,
                    MANT.ID_MaqTipoEstadoMantencion AS IdEstado, TEM.Descripcion_MaqTipoEstadoMantencion AS Estado, 
                    MAQ.Nombre_MaqMaquina as NombreMaquina, MAQ.ID_MaqMaquina as IdMaquina
                FROM 
                    MaqMantencion MANT 
                LEFT JOIN MaqTipoEstadoMantencion TEM ON
                    MANT.ID_MaqTipoEstadoMantencion = TEM.ID_MaqTipoEstadoMantencion
                LEFT JOIN MaqMaquina MAQ ON
                    MANT.ID_MaqMaquina = MAQ.ID_MaqMaquina
                    ORDER BY IdMantencion ASC";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function PostNuevaMantencion($mantencion, $fechaProgramada, $fechaInicio,  $idMaquina, $tipoMantencion){
        $query = "INSERT INTO 
                    MaqMantencion(Descripcion_MaqMantencion, FechaProgramada_MaqMantencion, FechaInicio_MaqMantencion, TipoMantencion_MaqMantencion, ID_MaqMaquina, ID_MaqTipoEstadoMantencion)
                  VALUES 
                    (:mantencion, :fechaProgramada, :fechaInicio, :tipoMantencion, :idMaquina, 1)";
                    
        //resultado de la query
        $conectar = $this->connect();
        $resultado = $conectar->prepare($query);
           
        $resultado->bindParam(':mantencion', $mantencion);
        $resultado->bindParam(':fechaInicio', $fechaInicio);
        $resultado->bindParam(':fechaProgramada', $fechaProgramada);
        //$resultado->bindParam(':fechaTermino', $fechaTermino);
        $resultado->bindParam(':tipoMantencion', $tipoMantencion);
        $resultado->bindParam(':idMaquina', $idMaquina);
        $resultado->execute();
        $nuevaMantencion = $conectar->lastInsertId();
        return $nuevaMantencion;        
    }

    function PostEditarMantencion($idMantencion,$mantencion, $fechaInicio, $fechaTermino, $fechaProgramada, $tipoMantencion){
        $query = "UPDATE MaqMantencion 
                  SET Descripcion_MaqMantencion = :mantencion, FechaProgramada_MaqMantencion = :fechaProgramada,
                  FechaInicio_MaqMantencion = :fechaInicio, FechaFin_MaqMantencion = :fechaTermino, TipoMantencion_MaqMantencion = :tipoMantencion
                  WHERE ID_MaqMantencion = :idMantencion";
                    
        //resultado de la query
        $resultado = $this->connect()->prepare($query);
        
        $resultado->bindParam(':idMantencion', $idMantencion);
        $resultado->bindParam(':mantencion', $mantencion);
        $resultado->bindParam(':fechaProgramada', $fechaProgramada);
        $resultado->bindParam(':fechaInicio', $fechaInicio);
        $resultado->bindParam(':fechaTermino', $fechaTermino);
        $resultado->bindParam(':tipoMantencion', $tipoMantencion);
        $resultado->execute();
        
        return true;        
    }


    //funcion que recibe una Id por parametro para eliminar la mantencion
    function PostEliminarMantencion($ideliminarmantencion)
    {
        $query="DELETE FROM MaqMantencion WHERE ID_MaqMantencion = :ideliminarmantencion";
        $resultado = $this->connect()->prepare($query);
        $resultado->bindParam(':ideliminarmantencion', $ideliminarmantencion);
        $resultado->execute();
        return true;
    }

    function PostCambiarEstadoMantencion($idMantencion,$nuevoEstado)
    {
        $query="UPDATE MaqMantencion SET ID_MaqTipoEstadoMantencion = :nuevoEstado WHERE ID_MaqMantencion = :idMantencion";

        $resultado = $this->connect()->prepare($query);

        $resultado->bindParam(':idMantencion', $idMantencion);
        $resultado->bindParam(':nuevoEstado', $nuevoEstado);

        $resultado->execute();

        return true;
    }

    function GetEstadosMantencion(){

        $query="SELECT
                SUM(CASE WHEN ID_MaqTipoEstadoMantencion = 1 THEN 1 ELSE 0 END) AS CantidadPendientes,
                SUM(CASE WHEN ID_MaqTipoEstadoMantencion = 2 THEN 1 ELSE 0 END) AS CantidadMantencion,
                SUM(CASE WHEN ID_MaqTipoEstadoMantencion = 3 THEN 1 ELSE 0 END) AS CantidadTerminadas,
                COUNT(1) AS TotalEstados
                FROM MaqMantencion";

        $resultado = $this->connect()->prepare($query);

        $resultado->execute();

        $rows = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }


}


?>