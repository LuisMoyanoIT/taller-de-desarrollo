<?php
// Logica que captura la pagina que queremos abrir

/* use app\Controladores\Maquinaria; */

$pagina = isset($_GET['p']) ? $_GET['p'] : 'Layout/home';

require_once 'autoload.php';

// Llamamos a la cabecera
require_once 'app/Views/Layout/cabecera.php';

/* $Maquina = new Maquinaria(); */


// El parametro enviado tiene la estructura carpeta/archivo de la pagina a cargar, y lo llamamos
require_once 'app/Views/' .$pagina. '.php';

/* echo $Maquina->crear(); */

// Llamamos al pie de pagina
require_once 'app/Views/Layout/footer.php';

/*Separa el parametro capturado en dos variables, 
una con el nombre de la carpeta y otro con el nombre del archio
usamos el nombre del archivo para traer el .js correspondiente*/
list($carpeta, $archivo) =  explode("/", $pagina);

?>

<!-- almacenamos la variable en un div para pasarla al script -->
<div class="pagina" data-pag = <?= $archivo?>></div>

<script>
    //Recogemos la variable almacenada en el div y cargamos el script correspondiente a la pagina
    var pagina = $('.pagina').data('pag');
    var script = document.createElement('script');
    script.src ='Documentacion/scripts/'+pagina+'.js';
    document.getElementsByTagName('script')[0].parentNode.appendChild(script);
</script>

<!-- <script src='Documentacion/scripts/'+pagina+'.js'></script> -->


</body>
</html>