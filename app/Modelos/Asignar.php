<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Asignar extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllAsignaciones(){
        $query="SELECT 
                   *,TP.Descripcion_MaqTipoMaquina as TipoMaquina ,O.Nombre_Obra as NombreObra
                FROM 
                    MaqMaquina M,
                    MaqAsigna A,
                    MaqTipoMaquina TP,
                    Obra O
                WHERE
                    M.ID_MaqMaquina = A.ID_MaqMaquina AND  M.ID_MaqTipoMaquina = TP.ID_MaqTipoMaquina
                    AND O.ID_Obra=A.ID_Obra";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }

    function PostDeleteAsignacion($idAsigna){

        
        $query="DELETE FROM MaqAsigna WHERE ID_MaqAsigna = :idAsignar";
        $resultado = $this->connect()->prepare($query);
        $resultado->bindParam(':idAsignar', $idAsigna);
        $resultado->execute();       

        return true;
    }

    function PostNuevaAsignacion($FechaProgInicioAsig, $FechaProgFinAsig, $FechaRealInicioAsignacion, $FechaRealFinAsignacion, $HorasTrabajadas,  $IdMaquina, $IdObra){
        $query = "INSERT INTO 
                    MaqAsigna(FechaProgrInicio_MaqAsigna, FechaProgrFin_MaqAsigna, FechaRealInicio_MaqAsigna, FechaRealFin_MaqAsigna, HorasTrabajadas_MaqAsigna, ID_MaqMaquina, ID_Obra, ID_MaqTipoTraslado)
                  VALUES 
                    (:FechaProgInicioAsig, :FechaProgFinAsig, :FechaRealInicioAsignacion, :FechaRealFinAsignacion, :HorasTrabajadas, :IdMaquina, :IdObra, 4)";
                    
        //resultado de la query
        $conectar = $this->connect();
        $resultado= $conectar->prepare($query);
           
        $resultado->bindParam(':FechaProgInicioAsig', $FechaProgInicioAsig);
        $resultado->bindParam(':FechaProgFinAsig', $FechaProgFinAsig);
        $resultado->bindParam(':FechaRealInicioAsignacion', $FechaRealInicioAsignacion);
        $resultado->bindParam(':FechaRealFinAsignacion', $FechaRealFinAsignacion);
        $resultado->bindParam(':HorasTrabajadas', $HorasTrabajadas);
       
        $resultado->bindParam(':IdMaquina', $IdMaquina);
        $resultado->bindParam(':IdObra', $IdObra);
        
        $resultado->execute();
        $nuevaAsignacion =$conectar->lastInsertId();
        return $nuevaAsignacion;        
      
    }


    function PostNuevoTrasladoAsignacion($nuevaAsig, $FechaInicioTraslado, $FechaFinTraslado)
    {
        $query = "UPDATE MaqAsigna 
        SET FechaInicioTraslado_MaqAsigna= :fechaInicioTraslado, FechaFinTraslado_MaqAsigna= :fechaFinalTraslado, ID_MaqTipoTraslado= 1
        WHERE ID_MaqAsigna= :idasignacion";

        //resultado de la query
        $conectar = $this->connect();
        $resultado = $conectar->prepare($query);
        $resultado->bindParam(':idasignacion', $nuevaAsig);
        $resultado->bindParam(':fechaInicioTraslado', $FechaInicioTraslado);
        $resultado->bindParam(':fechaFinalTraslado', $FechaFinTraslado);
        $resultado->execute();
        $IDASIGNACION = $conectar->lastInsertId();

        return $IDASIGNACION;

    }


    function PostEditarAsignacion($eIdAsignacion, $eFechaRealInicioAsignacion, $eFechaRealFinAsignacion, $eFechaProgInicioAsignacion, $eFechaProgFinAsignacion)
    {
        $query = "UPDATE MaqAsigna
                  SET FechaProgrInicio_MaqAsigna = :eFechaProgInicioAsignacion, FechaProgrFin_MaqAsigna = :eFechaProgFinAsignacion,
                  FechaRealInicio_MaqAsigna = :eFechaRealInicioAsignacion, FechaRealFin_MaqAsigna = :eFechaRealFinAsignacion
                  WHERE ID_MaqAsigna = :eIdAsignacion";
                    
        //resultado de la query
        $resultado = $this->connect()->prepare($query);
        
        $resultado->bindParam(':eIdAsignacion', $eIdAsignacion);
        $resultado->bindParam(':eFechaProgInicioAsignacion', $eFechaProgInicioAsignacion);
        $resultado->bindParam(':eFechaProgFinAsignacion', $eFechaProgFinAsignacion);
        $resultado->bindParam(':eFechaRealInicioAsignacion', $eFechaRealInicioAsignacion);
        $resultado->bindParam(':eFechaRealFinAsignacion', $eFechaRealFinAsignacion);
        
        $resultado->execute();
        
        return true; 

    }

    function GetHorasAsignar($idAsignacion){
        //SELECT Asig.HorasTrabajadas_MaqAsigna FROM MaqAsigna Asig WHERE Asig.ID_MaqAsigna = 1
        $query = "SELECT Asig.HorasTrabajadas_MaqAsigna 
                  FROM MaqAsigna Asig 
                  WHERE Asig.ID_MaqAsigna = :idAsignacion";

        $row = $this->connect()->prepare($query);

        $row->bindParam(':idAsignacion', $idAsignacion);
        $row->execute();

        $rows = $row->fetch(PDO::PARAM_INT);

        return $rows;

    }    

    function PostActualizarHoras($idAsignacion, $horasTotales){
        
        $query = "UPDATE MaqAsigna
                  SET HorasTrabajadas_MaqAsigna = :horasTotales
                  WHERE ID_MaqAsigna = :idAsignacion";

        $row = $this->connect()->prepare($query);

        $row->bindParam(':idAsignacion', $idAsignacion);
        $row->bindParam(':horasTotales', $horasTotales);
        $row->execute();

        return true;

    }   
    
}


?>