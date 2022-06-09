<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Obras extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllObras(){
        $query="SELECT 
                    *
                FROM 
                    Obra";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }

    

    function GetObraById($IdObra)
    {
        $query="SELECT Nombre_Obra
                FROM Obra
                WHERE ID_Obra = :IdObra
                ";
        

        $conectar = $this->connect();
        $resultado = $conectar->prepare($query);
        $resultado->bindParam(':IdObra', $IdObra);
        $resultado->execute();
        $valor = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $valor;
    }


    
}


?>