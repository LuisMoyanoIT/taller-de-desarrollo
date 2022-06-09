<?php
namespace app\Modelos;

use Conexion\Conexion;
use PDO;

class Reasignar extends Conexion{

    function __construct()
    {
        parent::__construct();
    }

    function GetAllReasignaciones(){
        $query="SELECT
        R.ID_MaqReasigna as IdReasigna,
        M.Nombre_MaqMaquina as Nombre,
        TM.Descripcion_MaqTipoMaquina as Tipo,
        O.Nombre_Obra as Obra,
        R.FechaRealInicio_MaqReasigna, 
        R.FechaRealFinal_MaqReasigna, 
        R.FechaProgrInicio_MaqReasigna, 
        R.FechaProgrFin_MaqReasigna,       
        R.HorasTrabajadas_MaqReasigna,
        M.ID_MaqMaquina as ID

     FROM 
         MaqMaquina M,
         MaqReasigna R,
         MaqTipoMaquina TM,
         Obra O
     WHERE
         M.ID_MaqMaquina = R.ID_MaqMaquina 
         AND O.ID_Obra=R.ID_Obra
         AND  M.ID_MaqTipoMaquina = TM.ID_MaqTipoMaquina";

        $row = $this->connect()->prepare($query);

        $row->execute();

        $rows = $row->fetchAll(PDO::FETCH_OBJ);

        return $rows;

    }

    function PostNuevaReasignacion($FechaProgrInicioReasig, $FechaProgrFinalReasig, $ReHorasTrabajadas, $ReIdObra, $ReIdMaquina)
    {
        $query = "INSERT INTO 
                    MaqReasigna(FechaProgrInicio_MaqReasigna, FechaProgrFin_MaqReasigna, FechaRealInicio_MaqReasigna, FechaRealFinal_MaqReasigna, HorasTrabajadas_MaqReasigna, ID_Obra, ID_MaqMaquina, ID_MaqTipoTraslado)
                  VALUES 
                    (:FechaProgrInicioReasig, :FechaProgrFinalReasig, :FechaRealInicioReasig, :FechaRealFinalReasig, :HorasTrabajadas, :IdObra, :IdMaquina, 4)";
        
        //consulta de prueba con datos antiguos
        /*
        INSERT INTO MaqReasigna(FechaProgrInicio_MaqReasigna, FechaProgrFin_MaqReasigna, FechaRealInicio_MaqReasigna, FechaRealFinal_MaqReasigna, HorasTrabajadas_MaqReasigna, ID_Obra, ID_MaqMaquina, ID_MaqTipoTraslado) VALUES ('2020/01/01','2020/01/01','2020/01/01','2020/01/01', 51, 1, 101, 4)
        */
        //resultado de la query
        $conectar = $this->connect();
        $resultadoRe = $conectar->prepare($query);
        $resultadoRe->bindParam(':FechaProgrInicioReasig', $FechaProgrInicioReasig);
        $resultadoRe->bindParam(':FechaProgrFinalReasig', $FechaProgrFinalReasig);
        $resultadoRe->bindParam(':FechaRealInicioReasig', $FechaProgrInicioReasig);
        $resultadoRe->bindParam(':FechaRealFinalReasig', $FechaProgrFinalReasig);
        $resultadoRe->bindParam(':HorasTrabajadas', $ReHorasTrabajadas);
        $resultadoRe->bindParam(':IdObra', $ReIdObra);
        $resultadoRe->bindParam(':IdMaquina', $ReIdMaquina);
        $resultadoRe->execute();
        $nuevaReasignacion = $conectar->lastInsertId();

        return $nuevaReasignacion;
    }

    function PostNuevoTrasladoReasignacion($ReFechaInicioTraslado, $ReFechaFinalTraslado, $IdReasigna)
    {
        $query = "UPDATE Reasigna 
                  SET FechaInicioTraslado= :fechaInicioTraslado, FechaFinalTraslado= :fechaFinalTraslado, IdTipoTraslado= 1
                  WHERE IdReasigna= :idReasigna";

        //resultado de la query
        $conectar = $this->connect();
        $resultadoRe = $conectar->prepare($query);
        $resultadoRe->bindParam(':idReasigna', $IdReasigna);
        $resultadoRe->bindParam(':fechaInicioTraslado', $ReFechaInicioTraslado);
        $resultadoRe->bindParam(':fechaFinalTraslado', $ReFechaFinalTraslado);
        $resultadoRe->execute();
        $nuevaReasignacion = $conectar->lastInsertId();

        return $nuevaReasignacion;
    }


    //funcion que recibe La id desde el controlador ReasignarController.php y ejecuta consulta sql
    function PostEliminarReasignacion($idDeleteReasig)
    {
        $query="DELETE FROM MaqReasigna WHERE ID_MaqReasigna = :IdReasigna";
        $resultado = $this->connect()->prepare($query);
        $resultado->bindParam(':IdReasigna', $idDeleteReasig);
        $resultado->execute();       
        return true;

    }

    function PostEditarReasignacion($editIdReasignacion, $editFechaRealInicioReasig, $editFechaRealFinalReasig, $editFechaProgrInicioReasig, $editFechaProgrFinalReasig, $editHorasTrabajadas)
    {
        //var_dump($editIdReasignacion, $editFechaRealInicioReasig, $editFechaRealFinalReasig, $editFechaProgrInicioReasig, $editFechaProgrFinalReasig, $editReHorasTrabajadas);
        $query = "UPDATE Reasigna
                  SET FechaProgrInicioReasig = :editFechaProgrInicioReasig, FechaProgrFinalReasig = :editFechaProgrFinalReasig,
                  FechaRealInicioReasig = :editFechaRealInicioReasig, FechaRealFinalReasig = :editFechaRealFinalReasig, HorasTrabajadas = :editHorasTrabajadas 
                  WHERE IdReasigna = :editIdReasignacion";

        //resultado de la query
        $resultado = $this->connect()->prepare($query);
        $resultado->bindParam(':editIdReasignacion', $editIdReasignacion);
        $resultado->bindParam(':editFechaProgrInicioReasig', $editFechaProgrInicioReasig);
        $resultado->bindParam(':editFechaProgrFinalReasig', $editFechaProgrFinalReasig);
        $resultado->bindParam(':editFechaRealInicioReasig', $editFechaRealInicioReasig);
        $resultado->bindParam(':editFechaRealFinalReasig', $editFechaRealFinalReasig);
        $resultado->bindParam(':editHorasTrabajadas', $editHorasTrabajadas);
        $resultado->execute();

        return true;
    }
}


?>