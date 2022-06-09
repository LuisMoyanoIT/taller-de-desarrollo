<?php 
namespace app\Controladores;

use app\Modelos\Traslado;

Class TrasladoController{
    
    public function getAllTraslados(){

        $traslados = new Traslado();

        $trasladosAsigna = $traslados->GetAllTrasladosAsigna();

        $trasladosReasigna = $traslados->GetAllTrasladosReasigna();

        $allTraslados = array_merge($trasladosAsigna, $trasladosReasigna);

        return $allTraslados;
        
    }


}


?>