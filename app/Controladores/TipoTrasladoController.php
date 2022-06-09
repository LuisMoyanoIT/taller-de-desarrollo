<?php 
namespace app\Controladores;

use app\Modelos\Traslado;

Class TipoTrasladoController
{
    
    public function getTipoTraslado(){

        $tras = new Traslado();

        $allTipoTraslado = $tras->GetTipoTraslado();

        return $allTipoTraslado;
        
    }


}


?>