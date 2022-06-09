<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class TipoMaquina extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllTipoMaquina(){
        $query="SELECT 
                    TP.ID_MaqTipoMaquina as IdTipoMaquina,
                    TP.Descripcion_MaqTipoMaquina as TipoMaquina 
                FROM 
                    MaqTipoMaquina TP";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }
}


?>