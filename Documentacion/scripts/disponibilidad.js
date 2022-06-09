$(function(){

    $(".minimalTabs").tabs({ 
        show: { effect: "slide", direction: "left", duration: 200, easing: "easeOutBack" } ,
        hide: { effect: "slide", direction: "right", duration: 200, easing: "easeInQuad" } 
    });

	$('.asignar-maquina').click(function(){

		var asignar = {
			IdMaq: $(this).data('id-maquina'),
			NombreMaquina: $(this).data('nombre-maquina'),
			TipoMaquinaDis: $(this).data('tipo-maquina-dis')
		};
		CargarAsignacion(asignar);
		
	});

	$('.check-traslado-asignacion').on('ifChanged', function(){

		if($(this).prop('checked')) {
			//$(this).is(':checked') 
			//  si el checkbox ha sido seleccionado
			$('.sel-tipo-traslado').prop('hidden', false);
			$('.fechaIniTraslado').prop('hidden', false);
			$('.fechaFinTraslado').prop('hidden', false);
		} else {
			// Hacer algo si el checkbox ha sido deseleccionado
			$('.sel-tipo-traslado').prop('hidden', true);
			$('.fechaIniTraslado').prop('hidden', true);
			$('.fechaFinTraslado').prop('hidden', true);
		}
    });



	$('#confirmarAsig').click(function(){
		GuardarAsignacion($(this));
	});
	  
	$('.eliminar-asignacion').click(function(){

		var eliminar = {
			IdEliminarAsignacion: $(this).data('id-asignar'),
			IdMaquinaEliminada:$(this).data('id-maquina-eliminar')
		};
		eliminarAsignacion(eliminar);
		
	});

	$('.editar-asignacion').click(function(){

		var editar = {
			IdAsignacion:$(this).data('id-asignacion'),
			NombreMaq:$(this).data('nombre-maq'),
			TipoMaquinaAsignada:$(this).data('tipo-asignada'),
			NombreObraAsignada:$(this).data('nombre-obra-asignada'),
			FechaRIA:$(this).data('fecha-real-asignacion'),
			FechaRFA:$(this).data('fecha-real-fin-asignacion'),
			FechaProgIniciAsignacion:$(this).data('fecha-prog-ia'),
			FechaProgFiAsignacion:$(this).data('fecha-prog-fa'),
			HorasTrabajadas:$(this).data('horas-trabajadas-asignacion'),
			IdTipoTrasladoAsignacion:$(this).data('id-traslado-asignacion'),
			FechaInicioTrasladoAsignacion:$(this).data('fecha-inicio-traslado-as'),
			FechaFinTrasladoAsignacion:$(this).data('fecha-final-traslado-as')
		};
		HacerLaEditacion(editar);
		
	});

	$('#confirmarEdic').click(function(){
		GuardarEdicionAsignada($(this));
	});

	$('.reasignar-maquina').click(function () {

		var reasignar = {
			IdMaquina: $(this).data('id-maquina-reasignada'),
			Nombre: $(this).data('nombre-maquina-reasignada')
		};
		CargarReasignacion(reasignar);
	});

	$('.check-traslado').on('ifChanged', function(){

		if($(this).prop('checked')) {
			//$(this).is(':checked') 
			//  si el checkbox ha sido seleccionado
			$('.sel-tipo-traslado').prop('hidden', false);
			$('.fecha-inicio-traslado').prop('hidden', false);
			$('.fecha-final-traslado').prop('hidden', false);
		} else {
			// Hacer algo si el checkbox ha sido deseleccionado
			$('.sel-tipo-traslado').prop('hidden', true);
			$('.fecha-inicio-traslado').prop('hidden', true);
			$('.fecha-final-traslado').prop('hidden', true);
		}
    });

	$('#confirmarReasig').click(function(){
		GuardarReasignacion($(this));
	});

	$('.editar-reasignacion').click(function () {

		var editarRe = {
			IdReasignacion: 	$(this).data('id-reasignacion'),
			NombreMaquinaRe: 	$(this).data('nombre-maquina-reasignada'),
			TipoMaquinaRe: 		$(this).data('tipo-reasignada'),
			NombreObraRe:		$(this).data('nombre-obra-reasignada'),
			FechaRealIniRe: 	$(this).data('freal-ini-reasignacion'),
			FechaRealFinRe: 	$(this).data('freal-fin-reasignacion'),
			FechaProgIniRe: 	$(this).data('fprog-ini-reasignacion'),
			FechaProgFinRe: 	$(this).data('fprog-fin-reasignacion'),
			HorasTrabajadasRe:	$(this).data('horas-trabajadas-reasignacion')
		};
		CargarEdicionReasignada(editarRe);
	});

	$('#confirmarEdicion').click(function () {
		GuardarEditReasignada($(this));
	});
	
	//funcion que recibe IdReasignar para enviarsela a funcion que la elimina mediante ajax
	$('.eliminar-reasignacion').click(function(){

		var eliminarReasigna = {
			IdEliminarReasignada:$(this).data('id-eliminar-reasignacion'),
			IdEliminarMaquinaRE:$(this).data('id-eliminar-maquina-re'),
			FechaRealEliminarRE:$(this).data('fecha-real-eliminar'),
			NombreMaquinaEliminar:$(this).data('nombre-maquina-eliminar'),
			TipoMaquinaEliminar:$(this).data('tipo-maquina-eliminar'),
			NombreObraEliminar:$(this).data('nombre-obra-eliminar'),
			FechaRealiniEliminar:$(this).data('fecha-real-ini-eliminar')

		};
		
		eliminarReasignacion(eliminarReasigna);
		
	});

	//inicio funcion chart pie disponibles/todas
	var porcentajesMaquina = CargarGraficoEstadosMaquina(); 

	var grafica = Morris.Donut({
		element: 'grafico-estado-disponible',
		data: porcentajesMaquina,
		colors: ['#26B99A', '#34495E'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});
	//fin funcion chart pie disponibles/todas

	//inicio funcion chart pie todas

	var porcentajes = CargarGraficoEstadosTodas(); 

	var graficoTodas = Morris.Donut({
		element: 'grafico-estado-todas',
		data: porcentajes,
		colors: ['#26B99A', '#34495E', '#ACADAC', '#344977', '#ACAD00'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});

	//fin funcion chart pie todas

	//inicio funcion ver detalle asignacion
	$('.detalle-asignacion').click(function(){

		var detalle = {
			
			IdAsignacion:$(this).data('detalle-id-asignar'),
			DetalleFechaRI:$(this).data('detalle-fecha-real-ini'),
			DetalleFechaRF:$(this).data('detalle-fecha-real-fin'),
			DetalleFechaProgInicio:$(this).data('detalle-fecha-prog-ini'),
			DetalleFechaProgFin:$(this).data('detalle-fecha-prog-fin'),
			DetalleHorasTrabajadas:$(this).data('detalle-horas-trabajadas'),

		};
		MostrarDetalleAsignacion(detalle);
		
	});

	//fin funcion ver detalle asignacion

	//inicio funcion sumar horas
	$('.sumar-restar-horas').click(function(){
	
		ActualizarHorasTrabajadas($(this));

	});
	//fin funcion ver detalle asignacion

	//inicio funcion chart pie asignadas/todas
	var porcentajesMaquinaAsignada = CargarGraficoEstadosMaquinaAsignada(); 

	var grafica = Morris.Donut({
		element: 'grafico-estado-asignadas',
		data: porcentajesMaquinaAsignada,
		colors: ['#26B99A', '#34495E'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});
	//fin funcion chart pie asignadas/todas

	//inicio funcion chart pie Tipos maquinas disponibles

	var porcentajesTipoMaquinasDisponibles = CargarGraficoTiposMaquinasDisponibles(); 

	var graficoTipoMaquinasDisponibles = Morris.Donut({
		element: 'grafico-tipos-maquinas-disponibles',
		data: porcentajesTipoMaquinasDisponibles,
		colors: ['#26B99A', '#34495E', '#ACADAC', '#344977', '#ACAD00', '#FFFF00', '#00FF00', '#008080', '#800080'],
		formatter: function (y) {
			return y + "%";
		},
		resize: true
	});

	//fin funcion chart pie Tipos maquinas disponibles

	//inicio limpiar modal asignar
	$('#cancelarAsig').click(function(){
		var limpiarModal ={
			LimpiarObra: -1,
			LimpiarFechaInicio: null,
			LimpiarFechaFin: null,
			LimpiarHorasTrabajadas: null
		}
		LimpiarModalAsignada(limpiarModal);
	});
	//fin limpiar modal asignar


	$('.disponibilidad-table').DataTable({
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
			}
		}
	});
});


function CargarAsignacion(asignar){

	$('#idMaquina').val(asignar.IdMaq);
	$('#nombreMaquina').val(asignar.NombreMaquina);
	$('#tipo-maquina-dis').val(asignar.TipoMaquinaDis);

}


function GuardarAsignacion(btn){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var datos = LeerDatos();

	//Validamos la informacion
	var validar = ValidarDatos(datos);

	if(validar != null){
		Swal.fire({
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

				Swal.fire({
					title: "Registro exitoso!",
					text: "Se ha registrado su asignación",
					type: "success"
				}).then((result) =>{
					btn.prop('disabled', false);
				$('#Asignar').modal('hide');
				window.location.reload();

				})

				//btn.prop('disabled', false);
				//$('#Asignar').modal('hide');
				//location.reload();

			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});

	}


}


function LeerDatos(){

try
{
	var fechaInicioTrasladoAsignacion= null;
	var fechaFinTrasladoAsignacion= null;

	if($('.check-traslado-asignacion').prop('checked')){

		fechaInicioTrasladoAsignacion = $('#fechaIniTraslado').val();
		fechaFinTrasladoAsignacion = $('#fechaFinTraslado').val();
	}

	var Datos = {
		IdMaquina : $('#idMaquina').val(),
		TipoMaquinaDisponible: $('#tipo-maquina-dis').val(),
		IdObra : $('#obra').val(),
		NombreMaquina:$('#nombreMaquina').val(),
		FechaProgInicioAsig :$('#fechaProgIni').val(),
		FechaProgFinAsig: $('#fechaProgFin').val(),
		HorasTrabajadas : $('#horasTrabajadas').val().trim(),
		FechaInicioTraslado:fechaInicioTrasladoAsignacion,
		FechaFinTraslado: fechaFinTrasladoAsignacion,
		Method: "postNuevaAsignacion"
	};

	return Datos;

}catch(e){
	console.log("error");
	};
	return Datos;
	


}
	




function ValidarDatos(datos){
	//variable que almacena una fecha antigua con la finalidad de hacer una comparacion en caso de ser vacia
	//var checkdate=(new Date(1999-01-01)).toISOString().split('T')[0];
	//console.log(datos.FechaProgInicioAsig);
	//var fechaProgIni=datos.FechaProgInicioAsig;
	console.log("fecha actual es:");


	//obtenemos la fecha actual new Date();
	var today= (new Date()).toISOString().split('T')[0];
	console.log(today);
	
	


	
	//var diainicio=datos.FechaProgInicioAsig.getDate();

	if(datos.IdObra == -1){
		return "Debe seleccionar una obra para realizar la asignacion"; 
	}

	if(datos.FechaProgInicioAsig == '' ){
		return "Debe seleccionar una fecha  inicial programada"; 
	}

	if(datos.FechaProgFinAsig == '' ){
		return "Debe seleccionar una fecha  final programada"; 
	}

	if(datos.FechaInicioTraslado == '')
	{
		return "Debe seleccionar una fecha inicial de traslado"
	}

	if(datos.FechaFinTraslado == '')
	{
		return "Debe seleccionar una fecha final de traslado"
	}

	if(datos.HorasTrabajadas == '')
	{
		return "Debe ingresar la cantidad de horas"
	}

	datos.FechaProgInicioAsig= (new Date(datos.FechaProgInicioAsig)).toISOString().split('T')[0];
	datos.FechaProgFinAsig= (new Date(datos.FechaProgFinAsig)).toISOString().split('T')[0];




	if(today>datos.FechaProgInicioAsig)
	{
		return "Debe seleccionar una fecha de inicio mayor  a la fecha actual"; 

	}

	if(datos.FechaProgInicioAsig>=datos.FechaProgFinAsig)
	{
		return "La fecha final debe ser mayor a fecha inicial"; 

	}

	if($('.check-traslado-asignacion').prop('checked')){
		
		datos.FechaInicioTraslado = (new Date(datos.FechaInicioTraslado)).toISOString().split('T')[0];
		datos.FechaFinTraslado = (new Date(datos.FechaFinTraslado)).toISOString().split('T')[0];

		if (datos.FechaInicioTraslado < today) {
			return "La fecha de traslado inicial no puede ser menor a la fecha actual";
		}

		if (datos.FechaFinTraslado < datos.FechaInicioTraslado) {
			return "La fecha final de traslado no puede ser menor a la fecha inicial";
		}
	}

	

	

	if(datos.HorasTrabajadas >1000 || datos.HorasTrabajadas<= 0 ){
		return "Debe ingresar una cantidad de horas entre el rango 1 y 1000"; 
	}

	var primerdia=moment(datos.FechaProgInicioAsig);
	var ultimodia=moment(datos.FechaProgFinAsig);
	var dias = ultimodia.diff(primerdia,"days");

	//se multiplica por 8 porque eso es lo que trabajan maximo los trabajadores por dia
	horaspordia=dias*8;
	//validacion de horas que no sea mayor a lo debido
	if(datos.HorasTrabajadas > horaspordia){
		return "la cantidad de horas no puede superar a lo debido que son 8 horas por dia";
	}
	

	

	

	
}



 
function eliminarAsignacion(elim) {

	var eliminarAsignacion = {
		idAsig : elim.IdEliminarAsignacion,
		idMaqAsig:elim.IdMaquinaEliminada,
		Method : "postEliminarAsignacion"
	};

	Swal.fire({
		title: 'Estas seguro de eliminar esta asignación?',
		type: 'error',
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
				data: eliminarAsignacion,
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


//funcion para cargar los datos de la tabla al modal
function HacerLaEditacion(editar){

	$('#id-Asignacion').val(editar.IdAsignacion);
	$('#nombre-maquinaria').val(editar.NombreMaq);
	$('#TipoMaquinaAsignada').val(editar.TipoMaquinaAsignada);
	$('#obra-easignacion').val(editar.NombreObraAsignada);
	$('#fecha-real-ia').val(editar.FechaRIA);
	$('#fecha-real-fa').val(editar.FechaRFA);
	$('#fecha-prog-ia').val(editar.FechaProgIniciAsignacion);
	$('#fecha-prog-fa').val(editar.FechaProgFiAsignacion);
	$('#horas-trabajadas-asig').val(editar.HorasTrabajadas);
	$('#id-traslado-asignacion').val(editar.IdTipoTrasladoAsignacion);
	$('#fecha-ini-traslado-as').val(editar.FechaInicioTrasladoAsignacion);
	$('#fecha-fin-traslado-as').val(editar.FechaFinTrasladoAsignacion);
	

}


//funcion para enviar los datos a asignarController
function GuardarEdicionAsignada(btn){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var Editardatos = LeerDatosEdicion();

	//Validamos la informacion
	var Evalidar = ValidarDatosEdicion(Editardatos);

	if(Evalidar != null){
		swal.fire({
			title: "Error",
			text: Evalidar,
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
			data: Editardatos,
			success: function(data){

				console.log(data);

				swal.fire({
					title: "Edicion exitosa!",
					text: "Se han actualizado los datos!",
					type: "success"
				}).then((result)=>{
					btn.prop('disabled', false);
					$('#EditarAsignacion').modal('hide');
					window.location.reload();

				})

				//btn.prop('disabled', false);
				//$('#EditarAsignacion').modal('hide');
				//location.reload();

			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});

	}


}

function LeerDatosEdicion(){

	try
	{
		var EDatos = {
			EIdAsignacion:$('#id-Asignacion').val(),
			EFechaRealInicioAsignacion:(new Date($('#fecha-real-ia').val())).toISOString().split('T')[0],
			EFechaRealFinAsignacion:(new Date($('#fecha-real-fa').val())).toISOString().split('T')[0],
			EFechaProgInicioAsignacion: (new Date($('#fecha-prog-ia').val())).toISOString().split('T')[0],
			EFechaProgFinAsignacion: (new Date($('#fecha-prog-fa').val())).toISOString().split('T')[0],
			ENombreMaquina:$('#nombre-maquinaria').val(),
			ETipoMaquina: $('#TipoMaquinaAsignada').val(),
			ENombreObra: $('#obra-easignacion').val(),

			Method: "postEditarAsignacion"
		};
	
		return EDatos;

	}catch(e)
	{
		var EDatos = {
			EIdAsignacion:$('#id-Asignacion').val(),
			EFechaRealInicioAsignacion:(new Date(1999-01-01)).toISOString().split('T')[0],
			EFechaRealFinAsignacion:(new Date(1999-01-01)).toISOString().split('T')[0],
			EFechaProgInicioAsignacion: (new Date(1999-01-01)).toISOString().split('T')[0],
			EFechaProgFinAsignacion: (new Date(1999-01-01)).toISOString().split('T')[0],
			//EHorasTrabajadasAsignacion : (new Date(1999-01-01)).toISOString().split('T')[0],
			//EIdTipoTraslado:$('#id-traslado-asignacion').val().trim(),
			//EFechaInicioTraslado:(new Date(1999-01-01)).toISOString().split('T')[0],
			//EFechaFinalTraslado:(new Date(1999-01-01)).toISOString().split('T')[0],
			Method: "postEditarAsignacion"
		};
	
		return EDatos;
		
	}

	
}

function ValidarDatosEdicion(EdatosA){

	//variable que almacena una fecha antigua con la finalidad de hacer una comparacion en caso de ser vacia
	var checkdate=(new Date(1999-01-01)).toISOString().split('T')[0];

	//obtenemos la fecha actual new Date();
	var today= (new Date()).toISOString().split('T')[0];

	if(EdatosA.EFechaRealInicioAsignacion=== checkdate){
		return "Todas las fechas deben estar completadas"; 
	}

	if( today>EdatosA.EFechaRealInicioAsignacion){
		return "Debe seleccionar una fecha real de inicio mayor o igual a la fecha actual"; 
	}

	if(EdatosA.EFechaRealInicioAsignacion >= EdatosA.EFechaRealFinAsignacion ){
		return "La fecha real inicial no puede ser mayor a la fecha real final"; 
	}

	if(today > EdatosA.EFechaProgInicioAsignacion){
		return "Debe seleccionar una fecha de inicio mayor o igual a la fecha actual"; 
	}

	if(EdatosA.EFechaProgInicioAsignacion > EdatosA.EFechaProgFinAsignacion){
		return "La fecha inicial no puede ser mayor a la fecha final"; 
	}

	


}

/*R E A S I G N A C I O N*/

function CargarReasignacion(reasignar) {

	$('#id-maquina-reasignada').val(reasignar.IdMaquina);
	$('#nombre-maquina-reasignada').val(reasignar.Nombre);

}


function GuardarReasignacion(btn) {

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var datosRe = LeerDatosReasignacion();

	//Validamos la informacion
	var validarRe = ValidarDatosReasignacion(datosRe);

	if (validarRe != null) {
		Swal.fire({
			title: "Error",
			text: validarRe,
			showCancelButton: false,
			type: "error",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "OK",
			closeOnConfirm: false
		});

		btn.prop('disabled', false);
		return;
	} else {
		$.ajax({
			type: 'POST',
			url: 'app/Controladores/Enrutador/RouteController.php',
			data: datosRe,
			success: function (data) {

				console.log(data);

				Swal.fire({
					title: "Reasignacion Confirmada!",
					text: "Precione OK para continuar!",
					type: "success",
					confirmButtonText: 'ok!',
				}).then(() => {
					btn.prop('disabled', false);
					$('#Reasignar').modal('hide');
					location.reload();

				});


			},
			error: function () {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});

	}


}


function LeerDatosReasignacion() {

	var fechaInicioTraslado = null;
	var fechaFinalTraslado = null;

	if($('.check-traslado').prop('checked')){

		fechaInicioTraslado = $('#fecha-ini-traslado-reasignacion').val();
		fechaFinalTraslado = $('#fecha-fin-traslado-reasignacion').val();
	}

	var DatosReasignacion = {
		ReIdMaquina: $('#id-maquina-reasignada').val(),
		ReIdObra: $('#obra-reasig').val().trim(),
		FechaProgrInicioReasig: $('#fecha-prog-inicio-reasignacion').val(),
		FechaProgrFinalReasig: $('#fecha-prog-fin-reasignacion').val(),
		ReFechaInicioTraslado: fechaInicioTraslado,
		ReFechaFinalTraslado: fechaFinalTraslado,
		ReHorasTrabajadas: $('#horas-trabajadas-reasignacion').val().trim(),
		Method: "postNuevaReasignacion"
	};

	return DatosReasignacion;
}


function ValidarDatosReasignacion(datosRe) {

	var fechaActual  = (new Date()).toISOString().split('T')[0];

	if (datosRe.ReIdObra < 0) {
		return "Debe seleccionar una fecha";
	}

	if (datosRe.FechaProgrInicioReasig == '') {
		return "Debe ingresar una Fecha Programada inicial para la Reasignacion";
	}

	if (datosRe.FechaProgrFinalReasig == '') {
		return "Debe ingresar una Fecha Programada inicial para la Reasignacion";
	}
	
	if (datosRe.ReFechaInicioTraslado == '') {
		return "Debe ingresar una Fecha del inicio del traslado";
	}
	
	if (datosRe.ReFechaFinalTraslado == '') {
		return "Debe ingresar una Fecha del termino del traslado";
	}
	
	if (datosRe.ReHorasTrabajadas == '') {
		return "Debe indicar la cantidad de horas";
	}

	datosRe.FechaProgrInicioReasig = (new Date(datosRe.FechaProgrInicioReasig)).toISOString().split('T')[0];
	datosRe.FechaProgrFinalReasig = (new Date(datosRe.FechaProgrFinalReasig)).toISOString().split('T')[0];
	
	
	
	if (datosRe.FechaProgrInicioReasig < fechaActual) {
		return "Debe ingresar una Fecha Programada inicial valida para la Reasignacion";
	}
	
	if (datosRe.FechaProgrFinalReasig < datosRe.FechaProgrInicioReasig) {
		return "Debe ingresar una Fecha Programada final valida para la Reasignacion";
	}
	
	if($('.check-traslado').prop('checked')){
		
		datosRe.ReFechaInicioTraslado = (new Date(datosRe.ReFechaInicioTraslado)).toISOString().split('T')[0];
		datosRe.ReFechaFinalTraslado = (new Date(datosRe.ReFechaFinalTraslado)).toISOString().split('T')[0];

		if (datosRe.ReFechaInicioTraslado < fechaActual) {
			return "Debe ingresar una Fecha del inicio del traslado valida";
		}

		if (datosRe.ReFechaFinalTraslado < datosRe.ReFechaInicioTraslado) {
			return "Debe ingresar una Fecha del termino del traslado valida";
		}
	}
}

function CargarEdicionReasignada(editarRe) {

	$('#id-Reasignacion').val(editarRe.IdReasignacion);
	$('#idMaquina').val(editarRe.IdMaq);
	$('#nombre-maquina-reasig').val(editarRe.NombreMaquinaRe);
	$('#tipo-maquina-reasignada').val(editarRe.TipoMaquinaRe);
	$('#obra-reasignada').val(editarRe.NombreObraRe);
	$('#fecha-real-inicio-reasig').val(editarRe.FechaRealIniRe);
	$('#fecha-real-final-reasig').val(editarRe.FechaRealFinRe);
	$('#fecha-prog-inicio-reasig').val(editarRe.FechaProgIniRe);
	$('#fecha-prog-final-reasig').val(editarRe.FechaProgFinRe);
	$('#horas-trabajadas-reasig').val(editarRe.HorasTrabajadasRe);
}



//funcion para enviar los datos a reasignarController
function GuardarEditReasignada(btn) {

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var EditardatosReasig = LeerDatosEdicionReasignada();

	//Validamos la informacion
	var EditvalidarRe = ValidarDatosEdicionReasignada(EditardatosReasig);

	if (EditvalidarRe != null) {
		Swal.fire({
			title: "Error",
			text: validarRe,
			showCancelButton: false,
			type: "error",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "OK",
			closeOnConfirm: false
		});
		btn.prop('disabled', false);
		return;
	} else {
		$.ajax({
			type: 'POST',
			url: 'app/Controladores/Enrutador/RouteController.php',
			data: EditardatosReasig,
			success: function (data) {
				console.log(data);
				Swal.fire({
					title: "Reasignacion Editada!",
					text: "Precione OK para continuar!",
					type: "success",
					confirmButtonText: 'ok!',
				}).then(() => {
					btn.prop('disabled', false);
					$('#EditarReasignacion').modal('hide');
					location.reload();

				});
			},
			error: function () {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});
	}
}


function LeerDatosEdicionReasignada() {

	var EditDatosRe = {
		EditIdReasignacion: $('#id-Reasignacion').val().trim(),
		EditFechaRealInicioReasig: (new Date($('#fecha-real-inicio-reasig').val())).toISOString().split('T')[0],
		EditFechaRealFinalReasig: (new Date($('#fecha-real-final-reasig').val())).toISOString().split('T')[0],
		EditFechaProgrInicioReasig: (new Date($('#fecha-prog-inicio-reasig').val())).toISOString().split('T')[0],
		EditFechaProgrFinalReasig: (new Date($('#fecha-prog-final-reasig').val())).toISOString().split('T')[0],
		EditHorasTrabajadas: $('#horas-trabajadas-reasig').val().trim(),
		Method: "postEditarReasignacion"
	};
	return EditDatosRe;
}

function ValidarDatosEdicionReasignada(EdDatosReasig) {

	if (EdDatosReasig.EditFechaRealInicioReasig == '') {
		return "Debe seleccionar una fecha inicial";
	}

	if (EdDatosReasig.EditFechaRealFinalReasig == '') {
		return "Debe seleccionar una fecha final";
	}

	if (EdDatosReasig.EditFechaProgrInicioReasig == '') {
		return "Debe seleccionar una fecha inicial";
	}

	if (EdDatosReasig.EditFechaProgrFinalReasig == '') {
		return "Debe seleccionar una fecha final";
	}

	if (EdDatosReasig.EditHorasTrabajadas == '') {
		return "Debe indicar la cantidad de horas";
	}


}



//funcion que se ejecuta al presionar boton "eliminar reasignacion" representada por un icono de basura
//desde reasignadas.php envia Id a traves del boton y eliminarReasignacion recibe la Id y se la envia al controlador
function eliminarReasignacion(IdREASIGNA) {

	var eliminarIdReasignacion = {
		ideletereasignacion : IdREASIGNA.IdEliminarReasignada,
		iddeletemaquinare: IdREASIGNA.IdEliminarMaquinaRE,
		FechaRealFinalRe: IdREASIGNA.FechaRealEliminarRE,
		NombreMaquinaRe: IdREASIGNA.NombreMaquinaEliminar,
		TipoMaquinaRe: IdREASIGNA.TipoMaquinaEliminar,
		NombreObraRe: IdREASIGNA.NombreObraEliminar,
		FechaRealInicialRe: IdREASIGNA.FechaRealiniEliminar,
		Method : "postEliminarReasignacion"
	};

	var ValidarFechaReasignacion= ValidarFechaRe(eliminarIdReasignacion);

	if(ValidarFechaReasignacion != null)
	{
		swal.fire({
			title: "Error",
			text: ValidarFechaReasignacion,
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
		title: 'Estas seguro de eliminar esta reasignación?',
		icon: 'error',
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
				data: eliminarIdReasignacion,
				success: function (response) {
					console.log(response);
					
						Swal.fire(
							'Eliminado!',
							'La reasignacion ha sido eliminada con exito.',
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

//fin funcion eliminar reasignacion


function ValidarFechaRe(eliminarIdReasignacion){

	//obtenemos la fecha actual new Date();
	var today= (new Date()).toISOString().split('T')[0];

	if(eliminarIdReasignacion.FechaRealFinalRe < today){
		return "No se puede eliminar  una reasignación finalizada";
	}


}


//INICIO FUNCION CHARTPIE DISPONIBLES/TOTALES
function CargarGraficoEstadosMaquina()
{
	var donutmaquina = $('#grafico-estado-disponible');
	var cantidadDisponibles = $(donutmaquina).data('cantidad-disponibles');
	var totalEstadosMaquina = $(donutmaquina).data('total-estados-maquina');

	var cantidadNoDisponible= totalEstadosMaquina - cantidadDisponibles;
	var porcentajeMaquinasDisponibles = 0;
	var porcentajeMaquinasTerminadas = 0;

	if(totalEstadosMaquina > 0){
		porcentajeMaquinasDisponibles = Math.round((cantidadDisponibles*100)/totalEstadosMaquina);
		porcentajeMaquinasTerminadas = Math.round((cantidadNoDisponible*100)/totalEstadosMaquina);
	}

	var porcentajesMaq= [
		{ label: 'Disponibles', value: porcentajeMaquinasDisponibles },
		{ label: 'No disponibles', value: porcentajeMaquinasTerminadas }
	]
	
	return porcentajesMaq;
}
//FIN FUNCION CHARTPIE DISPONIBLES/TOTALES

//INICIO FUNCION CHARTPIE DISPONIBLES/TOTALES
function CargarGraficoEstadosTodas()
{
	var donutmaquina = $('#grafico-estado-todas');
	var cantidadDisponibles = $(donutmaquina).data('disponibles');
	var cantidadAsignadas = $(donutmaquina).data('asignadas');
	var cantidadReasignadass = $(donutmaquina).data('reasignadas');
	var cantidadMantenciones = $(donutmaquina).data('mantenciones');
	var cantidadInhabilitadas = $(donutmaquina).data('inhabilitadas');
	var totalEstadosMaquina = $(donutmaquina).data('cantidad-total');

	//var cantidadNoDisponible= totalEstadosMaquina - cantidadDisponibles;
	var porcentajeDisponibles = 0;
	var porcentajeAsignadas = 0;
	var porcentajeReasignadas = 0;
	var porcentajeMantencion = 0;
	var porcentajeInhabilitadas = 0;

	if(totalEstadosMaquina > 0){
		porcentajeDisponibles = Math.round((cantidadDisponibles*100)/totalEstadosMaquina);
		porcentajeAsignadas = Math.round((cantidadAsignadas*100)/totalEstadosMaquina);
		porcentajeReasignadas = Math.round((cantidadReasignadass*100)/totalEstadosMaquina);
		porcentajeMantencion = Math.round((cantidadMantenciones*100)/totalEstadosMaquina);
		porcentajeInhabilitadas = Math.round((cantidadInhabilitadas*100)/totalEstadosMaquina);
	}

	var porcentajesMaq= [
		{ label: 'Disponibles', value: porcentajeDisponibles },
		{ label: 'Asignadas', value: porcentajeAsignadas },
		{ label: 'Reasignadas', value: porcentajeReasignadas },
		{ label: 'Mantenciones', value: porcentajeMantencion },
		{ label: 'Inhabilitadas', value: porcentajeInhabilitadas }
	]
	
	return porcentajesMaq;
}
//FIN FUNCION CHARTPIE DISPONIBLES/TOTALES



//INICIO FUNCION MOSTRAR DETALLE ASIGNACION
function MostrarDetalleAsignacion(detalle)
{
	$('#detalle-id-asignacion').val(detalle.IdAsignacion);
	$('#detalle-fecha-real-i').val(detalle.DetalleFechaRI);
	$('#detalle-fecha-real-f').val(detalle.DetalleFechaRF);
	$('#detalle-fecha-prog-i').val(detalle.DetalleFechaProgInicio);
	$('#detalle-fecha-prog-f').val(detalle.DetalleFechaProgFin);
	$('#detalle-horas-trabajadas').val(detalle.DetalleHorasTrabajadas);

}
//FIN FUNCION MOSTRAR DETALLE ASIGNACION





//INICIO FUNCION CHARTPIE ASIGNADAS/TOTALES
function CargarGraficoEstadosMaquinaAsignada()
{
	var donutmaquina = $('#grafico-estado-asignadas');
	var cantidadAsignadas = $(donutmaquina).data('cantidad-asignadas');
	var totalEstadosMaquina = $(donutmaquina).data('total-estados-maquina-as');

	var cantidadNoDisponible= totalEstadosMaquina - cantidadAsignadas;
	var porcentajeMaquinasAsignadas = 0;
	var porcentajeMaquinasTerminadas = 0;

	if(totalEstadosMaquina > 0){
		porcentajeMaquinasAsignadas = Math.round((cantidadAsignadas*100)/totalEstadosMaquina);
		porcentajeMaquinasTerminadas = Math.round((cantidadNoDisponible*100)/totalEstadosMaquina);
	}

	var porcentajesMaq= [
		{ label: 'Asignadas', value: porcentajeMaquinasAsignadas },
		{ label: 'No asignadas', value: porcentajeMaquinasTerminadas }
	]
	
	return porcentajesMaq;
}
//FIN FUNCION CHARTPIE ASIGNADAS/TOTALES


//INICIO FUNCION CHARTPIE TIPOS DE MAQUINAS DISPONIBLES
function CargarGraficoTiposMaquinasDisponibles()
{
	var donutmaquina = $('#grafico-tipos-maquinas-disponibles');
	var cantidadCadenas = $(donutmaquina).data('cadenas-disponibles');
	var cantidadRuedas = $(donutmaquina).data('ruedas-disponibles');
	var cantidadCompactadores = $(donutmaquina).data('compactadores-disponibles');
	var cantidadExcavadoras = $(donutmaquina).data('excavadoras-disponibles');
	var cantidadManipuladoras = $(donutmaquina).data('manipuladoras-disponibles');
	var cantidadMinicargadores = $(donutmaquina).data('minicargadores-disponibles');
	var cantidadMotoniveladores = $(donutmaquina).data('motoniveladores-disponibles');
	var cantidadRetroexcavadoras = $(donutmaquina).data('retroexcavadoras-disponibles');
	var cantidadTractores = $(donutmaquina).data('tractores-disponibles');
	var totalTipoMaquina = $(donutmaquina).data('total-tipo-maquina-disponibles');

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
//FIN FUNCION CHARTPIE TIPOS DE MAQUINAS DISPONIBLES

//INICIO FUNCION ACTUALIZAR HORAS TRABAJADAS
function ActualizarHorasTrabajadas(btn){

	if(btn.data('suma-resta') == 'sumar'){
		Titulo =  'Sumar horas trabajadas';
	}else{
		Titulo =  'Restar horas trabajadas';
	}

	Swal.fire({
		title: Titulo,
		input: 'number',
		showCancelButton: true,
		confirmButtonText: 'Confirmar',
		showLoaderOnConfirm: true,
		preConfirm: (login) => {
		  return fetch(`//api.github.com/users/${login}`)
			.then(response => {
			  if (!response.ok) {
				throw new Error(response.statusText)
			  }
			  return response.json()
			})
			.catch(error => {
			  Swal.showValidationMessage(
				`Request failed: ${error}`
			  )
			})
		},
		allowOutsideClick: () => !Swal.isLoading()
	  }).then((result) => {
		  
		if (result.isConfirmed) {

			if(btn.data('suma-resta') == 'sumar'){
				horasAux =  result.value.login;
			}else{
				horasAux =  result.value.login*'-1';
			}

			var cambiaHoras = {
				IdAsig: $('#detalle-id-asignacion').val(),
				Horas: horasAux,
				Method: 'postCambiarHorasTrabajadas' 
			}

			$.ajax({
				type: 'POST',
				url: 'app/Controladores/Enrutador/RouteController.php',
				data: cambiaHoras,
				success: function (response) {

					Swal.fire(
						'Cambiado!',
						'Las horas han sido actualizadas.',
						'success'
					).then((result) => {
						//window.location.reload();
					})
				}
			});
		}
	})
}
//FIN FUNCION  ACTUALIZAR HORAS TRABAJADAS


// INICIO FUNCION QUE LIMPIA EL MODAL DE ASIGNAR
function LimpiarModalAsignada(limpiarModal){

	$('#obra').val(limpiarModal.LimpiarObra);
	$('#fechaProgIni').val(limpiarModal.LimpiarFechaInicio);
	$('#fechaProgFin').val(limpiarModal.LimpiarFechaFin);
	$('#horasTrabajadas').val(limpiarModal.LimpiarHorasTrabajadas);

	if($('.check-traslado-asignacion').prop('checked'))
	{
		$('#fechaIniTraslado').val(null);
		$('#fechaFinTraslado').val(null);
		//$('.check-traslado-asignacion').prop('checked', false);
		//$('.sel-tipo-traslado').prop('hidden', true);
		$('.fechaIniTraslado').prop('hidden', true);
		$('.fechaFinTraslado').prop('hidden', true);
		$('.check-traslado-asignacion').iCheck('uncheck');

	}
	

}

//FIN FUNCION QUE LIMPIA EL MODAL DE ASIGNAR