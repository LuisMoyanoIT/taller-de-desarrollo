<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class TipoEstadoMantencion extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllTipoEstadoMantencion(){
        $query="SELECT 
                    TEM.ID_MaqTipoEstadoMaquina as IdTipoEstadoMantencion,
                    TEM.Descripcion_MaqTipoEstadoMaquina as TipoEstadoMantencion 
                FROM 
                    MaqTipoEstadoMaquina TEM";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }
}


?>