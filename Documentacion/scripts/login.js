$(function(){

    $('#login-user').click( function() {

        IniciarSesion($(this));

    });

});

async function IniciarSesion(btn){

    //var login= {
        user = $('#usuario').val(),
        pass = $('#password').val(),
        Method= 'postLogin'
    //}

    try{
        const proxyurl = "https://cors-anywhere.herokuapp.com/";
        let resultado = await fetch(proxyurl + 'http://146.83.198.35:1118/api/?rut=' + pass,{
        method:'GET'
        });
        let texto = await resultado.json();
        console.log(texto);
        if(texto.length == 0){
            Swal.fire(
                'Error!',
                'Usuario no existe.',
                'error'
            )

            console.log("No existe ese usuario");
        }else{
            location.href = "/PlantillaProyecto/index.php";
        }
    }catch{
        /* Swal.fire(
            'Error!',
            'Usuario no existe.',
            'success'
        ) */
        //console.log("No existe ese usuario");
    }

    /* $.ajax({
        type: 'POST',
        url: 'app/Controladores/Enrutador/RouteController.php',
        data: login,
        success: function (data) {
            console.log(data);
            
            /* Swal.fire(
                'Eliminado!',
                'La mantencion ha sido eliminada con exito.',
                'success'
            ).then((result) => {
                
            })	 */
            //location.href = "/";
        //}
    //});
}