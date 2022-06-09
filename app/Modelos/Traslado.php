<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Traslado extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllTrasladosAsigna(){
        $query="SELECT ASIG.FechaInicioTraslado_MaqAsigna AS FechaInicio , ASIG.FechaFinTraslado_MaqAsigna AS FechaFinal, 
                       MAQ.Nombre_MaqMaquina AS NombreMaquina, O.Nombre_Obra AS Obra, TT.Descripcion_MaqTipoTraslado AS TipoTraslado 
                FROM MaqAsigna ASIG	
                LEFT JOIN MaqMaquina MAQ ON
                    ASIG.ID_MaqMaquina = MAQ.ID_MaqMaquina
                LEFT JOIN Obra O ON
                    ASIG.ID_Obra = O.ID_Obra
                LEFT JOIN MaqTipoTraslado TT ON
                    ASIG.ID_MaqTipoTraslado = TT.ID_MaqTipoTraslado
                WHERE ASIG.ID_MaqTipoTraslado != 4";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }

    function GetAllTrasladosReasigna(){
        $query="SELECT REASIG.FeachaInicioTraslado_MaqReasigna AS FechaInicio , REASIG.FechaFinalTraslado_MaqReasigna AS FechaFinal, 
                       MAQ.Nombre_MaqMaquina AS NombreMaquina, O.Nombre_Obra AS Obra, TT.Descripcion_MaqTipoTraslado AS TipoTraslado 
                FROM MaqReasigna REASIG
                LEFT JOIN MaqMaquina MAQ ON
                    ASIG.ID_MaqMaquina = MAQ.ID_MaqMaquina
                LEFT JOIN Obra O ON
                    REASIG.ID_Obra = O.ID_Obra
                LEFT JOIN MaqTipoTraslado TT ON
                    REASIG.ID_MaqTipoTraslado = TT.ID_MaqTipoTraslado
                WHERE REASIG.ID_MaqTipoTraslado != 4";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function GetTipoTraslado(){
        $query="SELECT 
                    *
                FROM 
                    MaqTipoTraslado";
    
        $row = $this->connect()->prepare($query);
    
        $row->execute();
    
        $rows = $row->fetchAll(PDO::FETCH_OBJ);
    
        return $rows;
    
    }
}


?>