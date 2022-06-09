$(function(){

    $(".minimalTabs").tabs({ 
        show: { effect: "slide", direction: "left", duration: 200, easing: "easeOutBack" } ,
        hide: { effect: "slide", direction: "right", duration: 200, easing: "easeInQuad" } 
    });

	
	
	ActivarEventosAgregarMantencion();

	ActivarEventosMostrarMantencion();
	
	/*Al presionar el boton guardar del formulario llamamos a la funcion 
	GuardarNuevaMaquina() que inicia el proceso de guardar los datos en la base de datos*/
	$('#guardar-mantencion').click(function(){
		GuardarNuevaMantencion($(this));
	});

	
	
	var t = $('.mantencion-table').DataTable({
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

	$('[data-toggle="tooltip"]').tooltip();
});

function ActivarEventosMostrarMantencion(){

	var porcentajes = CargarGraficoEstados(); 

	var grafica = Morris.Donut({
		element: 'grafico-estados',
		data: porcentajes,
		colors: ['#26B99A', '#34495E', '#ACADAC'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});

	ActivarEventosFilaMantencion(grafica);
}

function ActivarEventosAgregarMantencion(){

	$('.agregar-mantencion').click(function(){
		
		var mantencion = {
			IdMan:				0,
			IdMaq: 				$(this).data('id-maquina'),
			NombreMaquina: 		$(this).data('nombre-maquina'),
			Mantencion: 		'',
			TipoMantencion: 	-1,
			FechaProgramada:	'',
			FechaInicio: 		'',
			FechaFin: 			''
		};
		CargarNuevaMantencion(mantencion);
	});

}


function CargarNuevaMantencion(mantencion){

	if(mantencion.IdMan == 0){
		$('#guardar-mantencion').html('Agregar');
		$('#modal-title-mantencion').html('Agregar Mantencion');
		$('#divFechaInicio').prop('hidden', true);
		$('#divFechaTermino').prop('hidden', true);
		
	}else{
		$('#guardar-mantencion').html('Guardar Cambios');
		$('#modal-title-mantencion').html('Editar Mantencion');
		$('#divFechaInicio').prop('hidden', false);
		$('#divFechaTermino').prop('hidden', false);
	}

	//Se resetean los datos del Modal
	$('#idMantencion').val(mantencion.IdMan);
	$('#idMaquina').val(mantencion.IdMaq);
	$('#nombreMaquina').val(mantencion.NombreMaquina);
	$('#mantencion').val(mantencion.Mantencion);
	$('#tipoMantencion').val(mantencion.TipoMantencion);
	$('#fechaProgramada').val(mantencion.FechaProgramada);
	$('#fechaInicio').val(mantencion.FechaInicio);
	$('#fechaTermino').val(mantencion.FechaFin);

	//$('#AgregarMantencion').modal({ backdrop : 'static'});
}

function GuardarNuevaMantencion(btn){

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
				
				//Mensaje de que el registro a sido exitoso
				

				btn.prop('disabled', false);
				console.log(data);
				if(data == '1'){
					ActualizarFila(datos);
					swal.fire({
						title: "Mantencion Editada",
						text: "Los datos se han actucalizado",
						type: "success"
					});
				}else{

					$('.fila-maquina-' + datos.IdMaquina).prop('hidden', true);
					AgregarNuevaFila(data);
					swal.fire({
						title: "Mantencion Agregada",
						text: "La mantencion se ha agregado con exito",
						type: "success"
					});
				}

				
				$('#AgregarMantencion').modal('hide');
			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido obtener la información");
			}
		});

	}


}

function LeerDatos(){
	var idm = $('#idMantencion').val();
	//var fechaProgramada = (new Date($('#fechaProgramada').val())).toISOString().split('T')[0];
	var fechaProgramada = $('#fechaProgramada').val();
	var fechaInicio = '';
	var fechaTermino = null;
	var metodo = '';

	if(idm == 0){
		metodo = "postNuevaMantencion";
		fechaInicio = fechaProgramada;
	}else{
		metodo = "postEditarMantencion";
		//fechaInicio = (new Date($('#fechaInicio').val())).toISOString().split('T')[0];
		//fechaTermino = (new Date($('#fechaTermino').val())).toISOString().split('T')[0];
		fechaInicio = $('#fechaInicio').val();
		fechaTermino = $('#fechaTermino').val();
	}

	var Datos = {
		IdMantencion : idm,
		IdMaquina : $('#idMaquina').val(),
		Mantencion : $('#mantencion').val().trim(),
		FechaProgramada: fechaProgramada,
		FechaInicio: fechaInicio,
		FechaTermino: fechaTermino,
		TipoMantencion : $('#tipoMantencion').val(),
		Method: metodo
	};

	return Datos;
}

function ValidarDatos(datos){

	var fechaActual  = (new Date()).toISOString().split('T')[0];

	var desc = /(^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\. -]{1,45})+$/g;

	if(desc.test(datos.Mantencion) == false){
		return "Debe ingresar una descripcion para la Mantencion"; 
	}
	
	if(datos.TipoMantencion == -1 || datos.TipoMantencion == null){
		return "Debe seleccionar un tipo de mantencion"; 
	}

	//Validar que las fechas no esten vacias
	if (datos.FechaProgramada == '') {
		return "Debe ingresar una Fecha Programada para la Mantencion";
	}

	if (datos.FechaInicio == '') {
		return "Debe ingresar una Fecha inicial para la Mantencion";
	}

	if (datos.FechaTermino == '') {
		return "Debe ingresar una Fecha de termino para la Mantencion";
	}

	
	datos.FechaProgramada = (new Date(datos.FechaProgramada)).toISOString().split('T')[0];
	datos.FechaInicio = (new Date(datos.FechaInicio)).toISOString().split('T')[0];
	datos.FechaTermino = (new Date(datos.FechaTermino)).toISOString().split('T')[0];


	// Validaciones fecha programada

	if(datos.IdMantencion == 0 && datos.FechaProgramada < fechaActual){
		return "Debe ingresar una Fecha Programada despues de la fecha actual"; 
	}

	//Validaciones fecha inicio
	if(!isNaN(datos.FechaInicio) || datos.FechaInicio < datos.FechaProgramada){
		return "Debe ingresar una Fecha de Inicio valida para la Mantencion"; 
	}
	//Validaciones fecha termino
	if(datos.IdMantencion != 0 && (!isNaN(datos.FechaTermino) || datos.FechaTermino <= datos.FechaInicio)){
		return "Debe ingresar una Fecha de Termino valida para la Mantencion"; 
	}

}

function AgregarNuevaFila(data) {

	console.log(data);
	// Se recive un string con los datos de la maquina ingrasada
	var divi = data.split('"');
	var idmant = divi[3];
	console.log(idmant);
	var mant = divi[7];
	console.log(mant);
	var fprog = divi[11];
	console.log(fprog);
	var fini = divi[15];
	console.log(fini);
	var ffin = '';
	console.log(ffin);
	var tm = divi[21];
	console.log(tm);
	var idest = divi[25];
	console.log(idest);
	var nomaq = divi[29];
	console.log(nomaq);
	var idmaq = divi[33];
	console.log(idmaq);

	var table = $('.mantencion-table.mostrar').DataTable();

	table.row.add([
		"",
		nomaq,
		mant,
		tm,
		'<div class="col-md-6">' +
		'<div class="btn-group btn-group-sm" role="group">' +
		'<button data-id-mantencion = "' + idmant + '"' +
        'data-estado = "1"'+
        'class= "btn btn-danger cambiar-estado new"' +
        'type = "button" title = "Pendiente">P' +
        '</button>' +
        '<button data-id-mantencion = "' + idmant + '"' +
        'data-estado = "2"'+
        'class="btn btn-secondary cambiar-estado new"' +
        'type="button" title="Mantencion">M' +
		'</button >' +
        '<button data-id-mantencion = "' + idmant + '"' +
		'data-estado = "3"'+
        'class="btn btn-secondary cambiar-estado new"' + 
        'type="button" title="Terminada">T' +
        '</button>' +
        '</div>' +
        '</div>',
		fprog,
		fini,
		ffin,
		'<button data-id-mantencion="' + idmant + '"' +
		'data-id-maquina="' + idmaq + '"' +
		'data-nombre-maquina="' + nomaq + '"' +
		'data-mantencion="' + mant + '"' +
		'data-tipo-mantencion="' + tm + '"' +
		'data-fecha-programada="' + fprog + '"' +
		'data-fecha-inicio="' + fini + '"' +
		'data-fecha-fin="' + ffin + '"' +
		'type="button"' +
		'class="btn btn-dafault btn-sm editar-mantencion new"' +
		'data-toggle="modal"' +
		'data-target="#AgregarMantencion"'+ 
		'title="Editar">' +
		'<i class="fa fa-edit"><abbr title="AgregarMantencion"></abbr></i>' +
		'</button>' +
		'<button class="btn btn-dafault btn-sm eliminar-mantencion new"'+
		'data-id-eliminar-mantencion="' + idmant + '"' +
		'title="Eliminar">' +
		'<i class="fa fa-trash"></i>' +
		'</button>'
	]).draw();

	/*Cuadno una nueva maquina es ingrasada, se asegura de mostrar el nuevo 
	registro al inicio de la tabla*/
	var currentPage = table.page();

	var index = table.row(this).index(),
		rowCount = table.data().length - 1,
		insertedRow = table.row(rowCount).data(),
		tempRow;
	console.log(index);

	for (var i = rowCount; i > index; i--) {
		tempRow = table.row(i - 1).data();
		table.row(i).data(tempRow);
		table.row(i - 1).data(insertedRow);
	}

	table.page(currentPage).draw(false);

	ActivarEventosFilaMantencion();
}

function ActualizarFila(datos){
	//Actualizar los datos del boton
	$('.editar-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').data('mantencion', datos.Mantencion);
	$('.editar-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').data('tipo-mantencion', datos.TipoMantencion);
	$('.editar-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').data('fecha-programada', datos.FechaProgramada);
	$('.editar-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').data('fecha-inicio', datos.FechaInicio);
	$('.editar-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').data('fecha-fin', datos.FechaTermino);

	//Actualizo los datos en la tabla
	$('.desc-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').html(datos.Mantencion);
	$('.tipo-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').html(datos.TipoMantencion);
	$('.fecha-programada-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').html(datos.FechaProgramada);
	$('.fecha-inicio-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').html(datos.FechaInicio);
	$('.fecha-fin-mantencion[data-id-mantencion="'+datos.IdMantencion+'"]').html(datos.FechaTermino);
}



//funcion para eliminar una mantencion dado una Id en particular

function EliminarMantencion(eliminarman){
	
	Swal.fire({
		title: 'Estas seguro de eliminar esta mantencion?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'POST',
				url: 'app/Controladores/Enrutador/RouteController.php',
				data: eliminarman,
				success: function (response) {
					console.log(response);
					
					Swal.fire(
						'Eliminado!',
						'La mantencion ha sido eliminada con exito.',
						'success'
					).then((result) => {
						window.location.reload();
					})	
				}
			});
		}
	})
}

function CambiarEstado(btn, estadoMantencion, grafica){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	$.ajax({
		type: 'POST',
		url: 'app/Controladores/Enrutador/RouteController.php',
		data: estadoMantencion,
		success: function (data) {
			console.log(data);
			btn.prop('disabled', false);

			ActualizarBotones(estadoMantencion);
			//CargarGraficoEstados();
			ActualizarDatosEstados(data);
			var porcentajesActuales = CargarGraficoEstados();
			grafica.setData(porcentajesActuales); 

		},
		error: function () {
					//toastr.error("Error al guardar nuava maquina");
			console.log("No se ha podido obtener la información");
			btn.prop('disabled', false);
		}
	});
		
}

function ActualizarBotones(estadoMantencion){

	//Definimos una variable que representa los tres botones de la botonera en la cual hemos hecho "click"
	var idMan = $('.cambiar-estado[data-id-mantencion='+ estadoMantencion.IdMan +']');
	//Definimos una variable que representa al boton exacto en el cual hicimos el "click"
	var newEstado = $('.cambiar-estado[data-id-mantencion='+ estadoMantencion.IdMan +'][data-estado='+estadoMantencion.Estado+']');
	var btnEliminar = $('.eliminar-mantencion[data-id-eliminar-mantencion='+ estadoMantencion.IdMan +']');

	//Se remueve el color de todos los botones
	$(idMan).removeClass('btn-secondary');
	$(idMan).removeClass('btn-danger');
	$(idMan).removeClass('btn-warning');
	$(idMan).removeClass('btn-success');
	//Se pinta con el color representativo de un estado no seleccionado(secondary es el color plomo)
	$(idMan).addClass('btn-secondary');
	//Se remueve el color anterior pero en solo el boton del estado que hemos seleccionado
	$(newEstado).removeClass('btn-secondary');
	//Y nuevamente se pinta ese boton con el color correspondiente a su estado
	switch(estadoMantencion.Estado){
		case 1 : $(newEstado).addClass('btn-danger');break;
		case 2 : $(newEstado).addClass('btn-warning');break;
		case 3 : $(newEstado).addClass('btn-success');$(idMan).prop('disabled', true);$(btnEliminar).prop('disabled', true);break;
	}
}

function CargarGraficoEstados(){

	var donut = $('#grafico-estados');
	var cantidadPendientes = $(donut).data('pendientes');
	var cantidadMantencion = $(donut).data('mantencion');
	var cantidadTerminadas = $(donut).data('terminadas');
	var totalEstados = $(donut).data('totales');


	var porcentajePendientes = 0;
	var porcentajeMantencion = 0;
	var porcentajeTerminadas = 0;

	if(totalEstados > 0){
		porcentajePendientes = Math.round((cantidadPendientes*100)/totalEstados);
		porcentajeMantencion = Math.round((cantidadMantencion*100)/totalEstados);
		porcentajeTerminadas = Math.round((cantidadTerminadas*100)/totalEstados);
	}

	var porcentajes= [
		{ label: 'Pendiente', value: porcentajePendientes },
		{ label: 'Mantencion', value: porcentajeMantencion },
		{ label: 'Terminada', value: porcentajeTerminadas }
	]
	
	return porcentajes;

}


function ActualizarDatosEstados(data){

	console.log(data);
	// Se recive un string con los datos de la maquina ingrasada
	var divi = data.split('"');
	var pendientes = divi[3];
	console.log(pendientes);
	var mantencion = divi[7];
	console.log(mantencion);
	var terminadas = divi[11];
	console.log(terminadas);
	var totales = divi[15];
	console.log(totales);
	
	var donut = $('#grafico-estados');
	$(donut).data('pendientes',pendientes);
	$(donut).data('mantencion',mantencion);
	$(donut).data('terminadas',terminadas);
	$(donut).data('totales',totales);

}

function ActivarEventosFilaMantencion(grafica){

	$('.editar-mantencion.new').click(function(){
		
		var mantencion = {
			IdMan:				$(this).data('id-mantencion'),
			IdMaq: 				$(this).data('id-maquina'),
			NombreMaquina: 		$(this).data('nombre-maquina'),
			Mantencion: 		$(this).data('mantencion'),
			TipoMantencion: 	$(this).data('tipo-mantencion'),
			FechaProgramada:	$(this).data('fecha-programada'),
			FechaInicio: 		$(this).data('fecha-inicio'),
			FechaFin: 			$(this).data('fecha-fin')
		};
		CargarNuevaMantencion(mantencion);
	});

	$('.editar-mantencion').removeClass('new');

	//se recibe la Id desde la tabla y se envia a la funcion EliminarMantencion
	//que enviara por ajax la Id al controlador.
	$('.eliminar-mantencion.new').click(function(){
		
		var eliminarMantencion = {
			IdMantencion : $(this).data('id-eliminar-mantencion'),
			IdMaquina : $(this).data('id-maquina'),
			Method : "postEliminarMantencion"
		};

		EliminarMantencion(eliminarMantencion);
	});

	$('.eliminar-mantencion').removeClass('new');

	$('.cambiar-estado.new').click(function(){

		// Obtenemos los datos necesarios para cmabiar el estado de la mantencion
		var estadoMantencion = {
			IdMan:		$(this).data('id-mantencion'),
			IdMaquina:	$(this).data('id-maquina'),
			Estado: 	$(this).data('estado'),
			Method : 	"postCambiarEstado"
			
		};
		//Identificamos la botonera
		var idBotonera = $('.cambiar-estado[data-id-mantencion='+estadoMantencion.IdMan+']');
		//Almacenamos el estado anterior
		var estadoAnterior = $(idBotonera).data('id-estado');
		//Almacenamos el estado nuevo
		var nuevoEstado = estadoMantencion.Estado;
		//Si el usuario selecciona el estado anterior no se realiza nada
		if(nuevoEstado == estadoAnterior){
			return 1;
		}else if(nuevoEstado == '3'){//Si el usuario selecciona el estado "Temianda" se pregunta si esta seguro

			Swal.fire({
				title: 'Esta seguro cambiar el estado de la mantencion a terminda?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					CambiarEstado($(this),estadoMantencion,grafica); 
				}
			})
		}else{//Cambiamos el estado y actualizamos los datos de la botonera
			CambiarEstado($(this),estadoMantencion,grafica);
			$(idBotonera).data('id-estado', nuevoEstado);
		}
	});

	$('.cambiar-estado').removeClass('new');

}