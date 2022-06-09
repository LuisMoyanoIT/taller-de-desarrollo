<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Maquina extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetMaquina($idMaquina){
        $query="SELECT 
                    M.*, 
                    TP.Descripcion_MaqTipoMaquina as TipoMaquina 
                FROM 
                    MaqMaquina M,
                    MaqTipoMaquina TP
                WHERE
                    M.ID_MaqTipoMaquina = TP.ID_MaqTipoMaquina
                AND
                    M.ID_MaqMaquina = :idMaquina";

        $row = $this->connect()->prepare($query);

        $row->bindParam(':idMaquina', $idMaquina);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }
// se muestran todas las maquinas a excepcion de las que tienen estado 5
    function GetAllMaquinas(){
        $query="SELECT
                    M.*,
                    TP.Descripcion_MaqTipoMaquina AS TipoMaquina,
                    TEM.Descripcion_MaqTipoEstadoMaquina AS Estado
                FROM
                    MaqMaquina M,
                    MaqTipoMaquina TP,
                    MaqTipoEstadoMaquina TEM
                WHERE
                    M.ID_MaqTipoMaquina = TP.ID_MaqTipoMaquina 
                AND M.ID_MaqTipoEstadoMaquina = TEM.ID_MaqTipoEstadoMaquina
                AND M.ID_MaqTipoEstadoMaquina <> 5
                ORDER BY M.ID_MaqMaquina ASC";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }


    function GetAllMaquinasByEstado($estado){
        
        $query="SELECT 
                    M.*, 
                    TP.Descripcion_MaqTipoMaquina as TipoMaquina 
                FROM 
                    MaqMaquina M,
                    MaqTipoMaquina TP
                WHERE
                    M.ID_MaqTipoMaquina = TP.ID_MaqTipoMaquina AND M.ID_MaqTipoEstadoMaquina=:estado";  //asignadas=1

        $row = $this->connect()->prepare($query);
        $row->bindParam(':estado', $estado);
        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function PostNuevaMaquina($nombre, $descripcion, $idTipoMaquina){
        $query = "INSERT INTO
                    MaqMaquina(Nombre_MaqMaquina, Descripcion_MaqMaquina, HorasTotales_MaqMaquina, ID_MaqTipoMaquina, ID_MaqTipoEstadoMaquina) 
                VALUES 
                    (:nombre, :descripcion, 0, :idTipoMaquina, 1)";
                    
        //resultado de la query
        $conectar = $this->connect();
        $resultado = $conectar->prepare($query);
           
        $resultado->bindParam(':nombre', $nombre);
        $resultado->bindParam(':descripcion', $descripcion);
        $resultado->bindParam(':idTipoMaquina', $idTipoMaquina);
        $resultado->execute();
        $nuevaMaquina = $conectar->lastInsertId();
        return $nuevaMaquina;        
    }

    
    function PostEditarEstadoMaquina($IdMaquina, $estado){
        $query = "UPDATE MaqMaquina 
                  SET ID_MaqTipoEstadoMaquina =:estado        
                  WHERE ID_MaqMaquina = :IdMaquina";
                    
        //resultado de la query
        $resultado = $this->connect()->prepare($query);
        
        $resultado->bindParam(':IdMaquina', $IdMaquina);
        $resultado->bindParam(':estado', $estado);

        $resultado->execute();
        return true;        
    }

    function postDeshabilitarMaquina($id){
        $query = "UPDATE MaqMaquina 
        SET ID_MaqTipoEstadoMaquina = 5  
        WHERE ID_MaqMaquina = :IdMaquina";
        
    $queryresult= $this->connect()->prepare($query);
    
    $queryresult->bindParam(':IdMaquina',$id);

    $queryresult->execute();
    return true;

    }
    function postEditarMaquina($idMaquinaEditar, $nombreEditar, $descripcionEditar){

        $query ="UPDATE MaqMaquina
        SET Nombre_MaqMaquina = :NombreMaquina , Descripcion_MaqMaquina = :DescripcionMaquina  
        WHERE ID_MaqMaquina = :IdMaquina";
        $resultadoedicion = $this->connect()->prepare($query);
        $resultadoedicion->bindParam(':IdMaquina',$idMaquinaEditar);
        $resultadoedicion->bindParam(':NombreMaquina',$nombreEditar);
        $resultadoedicion->bindParam(':DescripcionMaquina',$descripcionEditar);

        $resultadoedicion->execute();
        return true;

    }


    //funcion que sumara 1 a variables por cada vez que cuente 1 de los estados:
    function GetEstadosMaquina(){

        $query="SELECT
                SUM(CASE WHEN ID_MaqTipoEstadoMaquina = 1 THEN 1 ELSE 0 END) AS CantidadDisponible,
                SUM(CASE WHEN ID_MaqTipoEstadoMaquina = 2 THEN 1 ELSE 0 END) AS CantidadAsignada,
                SUM(CASE WHEN ID_MaqTipoEstadoMaquina = 3 THEN 1 ELSE 0 END) AS CantidadReasignada,
                SUM(CASE WHEN ID_MaqTipoEstadoMaquina = 4 THEN 1 ELSE 0 END) AS CantidadMantencion,
                SUM(CASE WHEN ID_MaqTipoEstadoMaquina = 5 THEN 1 ELSE 0 END) AS CantidadInhabilitadas,

                COUNT(1) AS TotalEstadosMaquina
                FROM MaqMaquina";

        $resultado = $this->connect()->prepare($query);

        $resultado->execute();

        $rows = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function PostEditarEstadoMaquinaRe($ReIdMaquina, $Reestado){
        $query = "UPDATE MaqMaquina 
                  SET ID_MaqTipoEstadoMaquina =:estado

                    
                  WHERE ID_MaqMaquina = :IdMaquina";
                    
        //resultado de la query
        $resultadoRe = $this->connect()->prepare($query);
        
        $resultadoRe->bindParam(':IdMaquina', $ReIdMaquina);

        $resultadoRe->bindParam(':estado', $Reestado);


        
        $resultadoRe->execute();
        return true; 
    }

    function GetTiposMaquina(){

        $query="SELECT
                SUM(CASE WHEN ID_MaqTipoMaquina = 1 THEN 1 ELSE 0 END) AS CargadoresCadenas,
                SUM(CASE WHEN ID_MaqTipoMaquina = 2 THEN 1 ELSE 0 END) AS CargadoresRuedas,
                SUM(CASE WHEN ID_MaqTipoMaquina = 3 THEN 1 ELSE 0 END) AS Compactadores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 4 THEN 1 ELSE 0 END) AS Excavadoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 5 THEN 1 ELSE 0 END) AS Manipuladores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 6 THEN 1 ELSE 0 END) AS Minicargadores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 7 THEN 1 ELSE 0 END) AS Motoniveladoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 8 THEN 1 ELSE 0 END) AS Retroexcavadoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 9 THEN 1 ELSE 0 END) AS Tractores,
               
                COUNT(1) AS TotalTipoMaquina
                FROM MaqMaquinaArrendada";

        $resultado = $this->connect()->prepare($query);

        $resultado->execute();

        $rows = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function GetTiposMaquinaDisponible(){

        $query="SELECT
                SUM(CASE WHEN ID_MaqTipoMaquina = 1 THEN 1 ELSE 0 END) AS CargadoresCadenas,
                SUM(CASE WHEN ID_MaqTipoMaquina = 2 THEN 1 ELSE 0 END) AS CargadoresRuedas,
                SUM(CASE WHEN ID_MaqTipoMaquina = 3 THEN 1 ELSE 0 END) AS Compactadores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 4 THEN 1 ELSE 0 END) AS Excavadoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 5 THEN 1 ELSE 0 END) AS Manipuladores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 6 THEN 1 ELSE 0 END) AS Minicargadores,
                SUM(CASE WHEN ID_MaqTipoMaquina = 7 THEN 1 ELSE 0 END) AS Motoniveladoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 8 THEN 1 ELSE 0 END) AS Retroexcavadoras,
                SUM(CASE WHEN ID_MaqTipoMaquina = 9 THEN 1 ELSE 0 END) AS Tractores,
               
                COUNT(1) AS TotalTipoMaquina
                FROM MaqMaquina
                WHERE ID_MaqTipoEstadoMaquina=1";

        $resultado = $this->connect()->prepare($query);

        $resultado->execute();

        $rows = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function GetMasHorasMaquina(){

        $query="SELECT
                M.Nombre_MaqMaquina AS NombreTop, M.HorasTotales_MaqMaquina AS HorasTop
                FROM
                MaqMaquina M 
                ORDER BY HorasTotales_MaqMaquina DESC
                LIMIT 10";


        $resultado = $this->connect()->prepare($query);

        $resultado->execute();

        $rows = $resultado->fetchAll(PDO::FETCH_OBJ);

        return $rows;
    }

    function GetMaquinaByNombre($nombre){
        $query="SELECT
                    Nombre_MaqMaquina
                FROM
                    MaqMaquina
                WHERE
                    Nombre_MaqMaquina = :nombre";

        $row = $this->connect()->prepare($query);

        $row->bindParam(':nombre', $nombre);

        $row->execute();

        $rows = $row->fetch(PDO::FETCH_OBJ);

        return $rows;
    }

}

?>