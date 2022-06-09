<?php 
namespace app\Controladores;

use app\Modelos\Obras;

Class ObraController
{
    
    public function getAllObras(){

        $Obritas = new Obras();

        $allObras = $Obritas->GetAllObras();

        return $allObras;
        
    }


}


?>