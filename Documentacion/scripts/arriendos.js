$(function(){

    $(".minimalTabs").tabs({ 
        show: { effect: "slide", direction: "left", duration: 200, easing: "easeOutBack" } ,
        hide: { effect: "slide", direction: "right", duration: 200, easing: "easeInQuad" } 
	});
	
	/*Al presionar el boton guardar del formulario llamamos a la funcion 
	GuardarNuevaMaquina() que inicia el proceso de guardar los datos en la base de datos*/
	$('#guardar-arriendo').click(function(){
		GuardarNuevoArriendo($(this));
	});

	//inicio funcion chart pie de Arriendos

	var porcentajesArriendos = CargarGraficoTiposMaquinas(); 

	var graficoTodas = Morris.Donut({
		element: 'grafico-tipo-maquina-arrendada',
		data: porcentajesArriendos,
		colors: ['#26B99A', '#34495E', '#ACADAC', '#344977', '#ACAD00', '#FFFF00', '#00FF00', '#008080', '#800080'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});

	//fin funcion chart pie todas
	
	$('.editar-arriendo').click(function(){

		var editarA = {
			eIdArriendo:$(this).data('id-arriendo-editar'),
			eTipoMaquina:$(this).data('tipo-maquina-editar'),
			eObraArriendo:$(this).data('nombre-obra-editar'),
			eEmpresaArriendo:$(this).data('nombre-empresa-editar'),
			eHorasEditar:$(this).data('horas-editar'),
			eFechaInicioArriendo:$(this).data('fecha-inicio-editar'),
			eFechaFinArriendo:$(this).data('fecha-fin-editar'),
			eOperadorArriendo:$(this).data('nombre-operador-editar'),
		
		};
		HacerLaEdicionArriendo(editarA);
		
	});

	$('#guardar-ArriendoEditado').click(function(){
		GuardarEdicionArriendo($(this));
	});

	$('.eliminar-arriendo').click(function(){
	var Eliminarriendo = {	

		eliminar:$(this).data('id-arriendo'),
		fechafinale: $(this).data('fecha-fin-eliminar'),
		fechainiciale: $(this).data('fecha-inicio-eliminar'),
		tipomaquinae: $(this).data('tipo-maquina-eliminar'),
		obraeliminar: $(this).data('nombre-obra-eliminar'),
		horaseliminar: $(this).data('horas-eliminar'),
		empresaeliminar: $(this).data('nombre-empresa-eliminar'),
		operadoreliminar: $(this).data('nombre-operador-eliminar')
	};
		EliminarArriendo(Eliminarriendo);
	});

	//inicio funcion ver detalle asignacion
	$('.detalle-descripcion').click(function(){

		var detalle = {
			

			DetalleDescripcion:$(this).data('descripcion-arriendos'),
			

		};
		MostrarDetalleDescripcion(detalle);
		
	});

	//fin funcion ver detalle asignacion

	var t = $('.arriendo-table').DataTable({
		"language"  : {
			"sProcessing":     "Procesando...",
			"sLengthMenu":	   "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de MAX registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "&nbsp;&nbsp;Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    },
			//Enumeracion de las columnos de la DataTable
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]]
		}
		
	});

	//Enumeracion de las columnos de la DataTable
	t.on( 'order.dt search.dt', function () {
		t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();


});



//INICIO FUNCION MOSTRAR DETALLE ASIGNACION
function MostrarDetalleDescripcion(detalle)
{

	$('#detalle-descripcion').val(detalle.DetalleDescripcion);	

}
//FIN FUNCION MOSTRAR DETALLE ASIGNACION


function HacerLaEdicionArriendo(editarA){

	$('#id-arriendo-Editar').val(editarA.eIdArriendo);
	$('#tipo-maquina-Editar').val(editarA.eTipoMaquina);
	$('#obra-Editar').val(editarA.eObraArriendo);
	$('#empresa-Editar').val(editarA.eEmpresaArriendo);
	$('#horas-Editar').val(editarA.eHorasEditar);
	$('#fecha-inicio-Editar').val(editarA.eFechaInicioArriendo);
	$('#fecha-fin-Editar').val(editarA.eFechaFinArriendo);
	$('#operador-Editar').val(editarA.eOperadorArriendo);

}


function GuardarEdicionArriendo(btn){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var EditardatosA = LeerDatosEdicionArriendo();

	//Validamos la informacion
	var EvalidarA = ValidarDatosEdicionArriendo(EditardatosA);

	if(EvalidarA != null){
		swal.fire({
			title: "Error",
			text: EvalidarA,
			showCancelButton: false,
			type: "error",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "OK",
			closeOnConfirm: false
		});

		btn.prop('disabled', false);
		return;
	}else{
		$.ajax({
			type: 'POST',
			url: 'app/Controladores/Enrutador/RouteController.php',
			data: EditardatosA,
			success: function(data){

				console.log(data);

				swal.fire({
					title: "Edicion exitosa!",
					text: "Se han actualizado los datos!",
					type: "success"
				}).then((result) =>{
					window.location.reload();
				});

				btn.prop('disabled', false);
				$('#Editar-Arriendo').modal('hide');
				//location.reload();

			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});

	}


}


function LeerDatosEdicionArriendo(){
try{

	var EDatosA = {
		EIdArriendo:$('#id-arriendo-Editar').val(),
		Eempresa:$('#empresa-Editar').val().trim(),
		Ehoras:$('#horas-Editar').val().trim(),
		Efechainicio: (new Date($('#fecha-inicio-Editar').val())).toISOString().split('T')[0],
		Efechafin: (new Date($('#fecha-fin-Editar').val())).toISOString().split('T')[0],
		Eoperador : $('#operador-Editar').val().trim(),
		Method: "postEditarArriendo"
	};

	return EDatosA;

}catch(e){

	var EDatosA = {
		EIdArriendo:$('#id-arriendo-Editar').val(),
		Eempresa:$('#empresa-Editar').val().trim(),
		Ehoras:$('#horas-Editar').val().trim(),
		Efechainicio: (new Date(1999-01-01)).toISOString().split('T')[0],
		Efechafin: (new Date(1999-01-01)).toISOString().split('T')[0],
		Eoperador : $('#operador-Editar').val().trim(),
		Method: "postEditarArriendo"
	};

	return EDatosA;

}
	
}



function GuardarNuevoArriendo(btn){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var datos = LeerDatos();

	//Validamos la informacion
	var validar = ValidarDatos(datos);

	if(validar != null){
		swal.fire({
			title: "Error",
			text: validar,
			showCancelButton: false,
			type: "error",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "OK",
			closeOnConfirm: false
		});

		btn.prop('disabled', false);
		return;
	}else{
		$.ajax({
			type: 'POST',
			url: 'app/Controladores/Enrutador/RouteController.php',
			data: datos,
			success: function(data){

				console.log(data);

				swal.fire({
					title: "Registro exitoso!",
					text: "Se ha registrado su arriendo",
					type: "success"
				}).then((result) =>{
					window.location.reload();
				});

				btn.prop('disabled', false);
			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido obtener la información");
			}
		});

	}


}


function LeerDatos(){
	try
	{
	var Datos = { 
		
		FechaInicio: (new Date($('#fechaInicio').val())).toISOString().split('T')[0],
		FechaFin: (new Date($('#fechaFin').val())).toISOString().split('T')[0],
		Empresa : $('#empresa').val().trim(),
		DescripcionArriendo : $('#descripcionArriendo').val().trim(),
		HorasTrabajadas : $('#horasTrabajadas').val().trim(),
		Obra : $('#obra').val().trim(),
		Operador : $('#operador').val().trim(),
		IdTipoArriendo : $('#idTipoMaquina').val().trim(),
		Method: "postNuevoArriendo"
	};

	return Datos;

    }catch(e){
		var Datos = { 
			
			FechaInicio: (new Date(1999-01-01)).toISOString().split('T')[0],
			FechaFin: (new Date(1999-01-01)).toISOString().split('T')[0],
			Empresa : $('#empresa').val().trim(),
			DescripcionArriendo : $('#descripcionArriendo').val().trim(),
			HorasTrabajadas : $('#horasTrabajadas').val().trim(),
			Obra : $('#obra').val().trim(),
			Operador : $('#operador').val().trim(),
			IdTipoArriendo : $('#idTipoMaquina').val().trim(),
			Method: "postNuevoArriendo"
		};
	
		return Datos;

	}
}

function ValidarDatos(datos){

	//variable que almacena una fecha antigua con la finalidad de hacer una comparacion en caso de ser vacia
	var checkdate=(new Date(1999-01-01)).toISOString().split('T')[0];
	
	//saco la diferencia de dias para poder hacer una validacion en horas 
	var primerdia=moment(datos.FechaInicio);
	var ultimodia=moment(datos.FechaFin);
	var dias = ultimodia.diff(primerdia,"days");
	
 	//lo multiplico por 8 porque eso es lo que trabajan maximo los trabajadores por dia
	horaspordia=dias*8;
	console.log(horaspordia);
    //solo permite estos carcteres 
	var desc = /(^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\. -]{1,45})+$/g;

	//obtenemos la fecha actual new Date();
	var today= (new Date()).toISOString().split('T')[0];
	console.log(today);

    //valida que haya escogido al menos una obra  
	if(datos.Obra== -1){
        return "Debe seleccionar al menos una obra para registrar un arriendo";
	}
	//valida que la fecha de inicio no este vacio
	if(datos.FechaInicio === checkdate){
		return "Debe agregar una fecha"; 
	}
	//valida que la fecha final no este vacio 
	if(datos.FechaFin === checkdate ){
		return "Debe agregar una fecha final"; 
	}
	//validacion de horas que no sea mayor a lo debido
	if(datos.HorasTrabajadas > horaspordia){
		return "la cantidad de horas no puede superar a lo debido que son 8 horas por dia";
	}
	//valida que la fecha inicial no sea inferior a hoy(no importa en que fecha lea esto)
	if(today>datos.FechaInicio)
	{
		return "Debe seleccionar una fecha de inicio mayor o igual a la fecha actual"; 
	}
	//valida que la fecha fin no sea anterior a hoy
	if(today>datos.FechaFin)
	{
		return "Debe seleccionar una fecha de Final mayor o igual a la fecha actual"; 
	}
    //valida que la fecha de inicio no sea anterior a la fecha inicial
	if(datos.FechaFin < datos.FechaInicio || datos.FechaFin == datos.FechaInicio){
    return "La fecha final no puede ser inferior o igual a la inicial";
	}
    //valida que el nombre de la empresa no este vacio 
	if(datos.Empresa == ''){
		return "Debe ingresar un nombre de la Empresa"; 
	}
    //valida que el nombre del operador no este vacio 
	if(datos.Operador == ''){
		return "Debe ingresar un nombre del Operador"; 
	}
	//valida que que operador no tenga esos caracteres 
	if(datos.Operador.includes("<") || datos.Operador.includes("@") || datos.Operador.includes(">") || datos.Operador.includes("}") || datos.Operador.includes('"') || datos.Operador.includes("'") || datos.Operador.includes("!") || datos.Operador.includes(")"))
	{
		return "Operador no permite tener los caracteres ingresados";
	}
    //valida que horas trabajadas no este vacio ni tenga esos caracteres
	if(datos.HorasTrabajadas == '' || datos.HorasTrabajadas== '+' || datos.HorasTrabajadas < 0 || datos.HorasTrabajadas== 0){
		return "Debe ingresar un numero de horas correctamente"; 
	}
	//valida que eliga al menos un tipo de maquina
	if(datos.IdTipoArriendo < 0){
		return "Debe seleccionar un tipo de maquina"; 
	}
	//valida que Empresa no tenga esos caracteres 
	if(datos.Empresa.includes("<") || datos.Empresa.includes("@") || datos.Empresa.includes(">") || datos.Empresa.includes("}") || datos.Empresa.includes('"') || datos.Empresa.includes("'") || datos.Empresa.includes("!") || datos.Empresa.includes(")"))
	{
		return "Empresa no permite tener los caracteres ingresados";
	}
	//no se permite esos caracteres en DEscripcion 
	if(datos.DescripcionArriendo.includes("<") || datos.DescripcionArriendo.includes("@") || datos.DescripcionArriendo.includes(">") || datos.DescripcionArriendo.includes("}") || datos.DescripcionArriendo.includes('"') || datos.DescripcionArriendo.includes("'") || datos.DescripcionArriendo.includes("!") || datos.DescripcionArriendo.includes(")"))
	{
		return "Empresa no permite tener los caracteres ingresados";
	}
	//maximo caracteres permitidos
	if(datos.DescripcionArriendo.length > 30){
		return "Exedio en Descripcion el maximo de caracteres permitido 30";
	}
	//maximo caracteres permitidos
	if(datos.Operador.length > 30){
		return "Exedio en operador el maximo de caracteres permitido 30";
	}
	//maximo caracteres permitidos
	if(datos.Empresa.length > 30){
		return "Exedio en Empresa el maximo de caracteres permitido 30";
	}

}
//validaciones donde se edita un arriendo
function ValidarDatosEdicionArriendo(EdatosArriendo){

	//variable que almacena una fecha antigua con la finalidad de hacer una comparacion en caso de ser vacia
	var checkdate=(new Date(1999-01-01)).toISOString().split('T')[0];
	console.log(EdatosArriendo.Efechafin);
	var fechaProgIni=EdatosArriendo.Efechafin;

	//saco la diferencia de dias para poder hacer una validacion en horas 
	var primerdia=moment(EdatosArriendo.Efechainicio);
	var ultimodia=moment(EdatosArriendo.Efechafin);
	var dias = ultimodia.diff(primerdia,"days");
	
 	//lo multiplico por 8 porque eso es lo que trabajan maximo los trabajadores por dia
	horaspordia=dias*8;

	 //solo permite estos carcteres 
	 var desc = /(^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\. -]{1,45})+$/g;
	 if(desc.test(EdatosArriendo.Eempresa) == false){
		return "Debe ingresar una empresa para el arriendo"; 
	}
	//Valida que la fecha de inicio no este vacia 
	if(EdatosArriendo.Efechainicio === checkdate){
    	return "Debe agregar una fecha inicial";
	}
	//valida que la fecha final no este vacia
    if(EdatosArriendo.Efechafin === checkdate){
    	return "debe agregar una fecha final";
	}
	//validacion horas
	if(EdatosArriendo.Ehoras > horaspordia){
		return "la cantidad de horas no puede superar a lo debido que son 8 horas por dia";
	}
	//valida que la fecha final no sea anterior a la fecha inicial 
	if(EdatosArriendo.Efechafin<EdatosArriendo.Efechainicio){
		return"La fecha final no puede ser inferior a la inicial";
	}
	//valida que el nombre de la empresa no este vacia
	if(EdatosArriendo.Eempresa==''){
		return "Debe agregar el nombre de una empresa";
	}
	//valida que no tengo algunos caracteres operador 
	if(EdatosArriendo.Eoperador.includes("<") || EdatosArriendo.Eoperador.includes("@") || EdatosArriendo.Eoperador.includes(">") || EdatosArriendo.Eoperador.includes("}") || EdatosArriendo.Eoperador.includes('"') || EdatosArriendo.Eoperador.includes("'") || EdatosArriendo.Eoperador.includes("!") || EdatosArriendo.Eoperador.includes(")"))
	{
		return "Operador no permite tener los caracteres ingresados";
	}
	//valida que operador no este vacio 
	if(EdatosArriendo.Eoperador==''){
		return "Debe agregar un nombre de algun operador";
	}
	//valida que no este vacia la hora
	if(EdatosArriendo.Ehoras == '' || EdatosArriendo.Ehoras < 0 || EdatosArriendo.Ehoras== 0){
		return "Debe ingresar un numero de horas correctamente"; 
	}
	//validacion de cantidad de caracteres
	if(EdatosArriendo.Eempresa.length > 30){
		return "Exedio en Empresa el maximo de caracteres permitido 30";
	}
	if(EdatosArriendo.Eoperador.length > 30){
		return "Exedio en operador el maximo de caracteres permitido 30";
	}
}

function EliminarArriendo(EliminarArriendo){

	
	var eliminarArriendo = {
		idArrien : EliminarArriendo.eliminar,
		fechafine : EliminarArriendo.fechafinale,
		fechainie : EliminarArriendo.fechainiciale,
		tipomaquinae : EliminarArriendo.tipomaquinae,
		obrae : EliminarArriendo.obraeliminar,
		horae : EliminarArriendo.horaseliminar,
		empresae : EliminarArriendo.empresaeliminar,
		operadore : EliminarArriendo.operadoreliminar,
		Method : "postEliminarArriendo"
	};
  var validarEliminar = validardatoseliminar(EliminarArriendo);

  if(validarEliminar != null){
	swal.fire({
		title: "Error",
		text: validarEliminar,
		showCancelButton: false,
		type: "error",
		confirmButtonClass: "btn-danger",
		confirmButtonText: "OK",
		closeOnConfirm: false
	});

	btn.prop('disabled', false);
	return;
}else{

	Swal.fire({
		title: 'Estas seguro de eliminar este arriendo?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si!',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'POST',
				url: 'app/Controladores/Enrutador/RouteController.php',
				data: eliminarArriendo,
				success: function (response) {
					console.log(response);
					
						Swal.fire(
							'Eliminado!',
							'La asignacion ha sido eliminada con exito.',
							'success'
						).then((result) => {
							window.location.reload();
						})

					
				}
			});


		}
	})
}
}

function validardatoseliminar(EliminarArriendo){

	//obtenemos la fecha actual new Date();
	var today= (new Date()).toISOString().split('T')[0];

	if(EliminarArriendo.fechafinale < today){
		return"No se puede eliminar un Arriendo que ya finalizo";
	}


}

//INICIO FUNCION CHARTPIE TIPOS DE MAQUINAS EN ARRIENDOS
function CargarGraficoTiposMaquinas()
{
	var donutmaquina = $('#grafico-tipo-maquina-arrendada');
	var cantidadCadenas = $(donutmaquina).data('cadenas');
	var cantidadRuedas = $(donutmaquina).data('ruedas');
	var cantidadCompactadores = $(donutmaquina).data('compactadores');
	var cantidadExcavadoras = $(donutmaquina).data('excavadoras');
	var cantidadManipuladoras = $(donutmaquina).data('manipuladoras');
	var cantidadMinicargadores = $(donutmaquina).data('minicargadores');
	var cantidadMotoniveladores = $(donutmaquina).data('motoniveladores');
	var cantidadRetroexcavadoras = $(donutmaquina).data('retroexcavadoras');
	var cantidadTractores = $(donutmaquina).data('tractores');
	var totalTipoMaquina = $(donutmaquina).data('total-tipo-maquina');

	//var cantidadNoDisponible= totalEstadosMaquina - cantidadDisponibles;
	var porcentajeCadenas = 0;
	var porcentajeRuedas = 0;
	var porcentajeCompactadores = 0;
	var porcentajeExcavadoras = 0;
	var porcentajeManipuladoras = 0;
	var porcentajeMinicargadores = 0;
	var porcentajeRetroexcavadoras = 0;
	var porcentajeTractores = 0;
	var porcentajeMotoniveladoras = 0;

	if(totalTipoMaquina > 0){
		porcentajeCadenas = Math.round((cantidadCadenas*100)/totalTipoMaquina);
		porcentajeRuedas = Math.round((cantidadRuedas*100)/totalTipoMaquina);
		porcentajeCompactadores = Math.round((cantidadCompactadores*100)/totalTipoMaquina);
		porcentajeExcavadoras = Math.round((cantidadExcavadoras*100)/totalTipoMaquina);
		porcentajeManipuladoras = Math.round((cantidadManipuladoras*100)/totalTipoMaquina);
		porcentajeMinicargadores = Math.round((cantidadMinicargadores*100)/totalTipoMaquina);
		porcentajeRetroexcavadoras = Math.round((cantidadMotoniveladores*100)/totalTipoMaquina);
		porcentajeTractores = Math.round((cantidadRetroexcavadoras*100)/totalTipoMaquina);
		porcentajeMotoniveladoras = Math.round((cantidadTractores*100)/totalTipoMaquina);
	}

	var porcentajesMaq= [
		{ label: 'Cargadores de cadenas', value: porcentajeCadenas },
		{ label: 'Cargadores de Ruedas', value: porcentajeRuedas },
		{ label: 'Compactadores', value: porcentajeCompactadores },
		{ label: 'Excavadoras', value: porcentajeExcavadoras },
		{ label: 'Manipuladores telescopicos', value: porcentajeManipuladoras },
		{ label: 'Minicargadores y cargador', value: porcentajeMinicargadores },
		{ label: 'Motoniveladoras', value: porcentajeRetroexcavadoras },
		{ label: 'Retroexcavadoras cargadoras', value: porcentajeTractores },
		{ label: 'Tractores topadores', value: porcentajeMotoniveladoras }
	]
	
	return porcentajesMaq;
}
//FIN FUNCION CHARTPIE TIPOS DE MAQUINAS EN ARRIENDO
