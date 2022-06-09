$(function(){

    $(".minimalTabs").tabs({ 
        show: { effect: "slide", direction: "left", duration: 200, easing: "easeOutBack" } ,
        hide: { effect: "slide", direction: "right", duration: 200, easing: "easeInQuad" } 
    });

	/*Al presionar el boton guardar del formulario llamamos a la funcion 
	GuardarNuevaMaquina() que inicia el proceso de guardar los datos en la base de datos*/
	$('#guardar-maquina').click(function(){
		GuardarNuevaMaquina($(this));
	});

	$('.deshabilitar-maquina').click(function(){

		var deshabilitar = { 
			iddemaquina: $(this).data('id-deshabilitar'),
			estadodemaquina: $(this).data('estado-maquina'),
			
	}	
		DeshabilitarMaquina(deshabilitar);
	
	});

	//inicio funcion chart pie top horas maquinas

	CargarGraficohorasMaquinas(); 

	//fin funcion chart pie top horas maquinas


	$('.editar-maquina').click(function(){

		var editarM = {
			eIdMaquina:$(this).data('id-maquina'),
			eNombreMaquina:$(this).data('nombre-de-maquina'),
			eDescripcionMaquina:$(this).data('descripcion-maquina'),
			eTipoMaquina:$(this).data('tipo-maquinaria'),
		};
		HacerLaEdicionMaquina(editarM);
		
	});

	$('#guardar-MaquinaEditado').click(function(){
		GuardarEdicionMaquina($(this));
	}); 

	var t = $('#maquinaria-table').DataTable({
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

function HacerLaEdicionMaquina(editarM){
 
	$('#id-maquina-Editar').val(editarM.eIdMaquina);
	$('#nombre-maquina-Editar').val(editarM.eNombreMaquina);
	$('#descripcion-Editar').val(editarM.eDescripcionMaquina);
	$('#tipo-maquina-Editar').val(editarM.eTipoMaquina);
}

function GuardarEdicionMaquina(btn){

	/* Primero se desabilita el boton guardar para que el usuario haga dos click
		y llame dos veces a la funcion */
	btn.prop('disabled', true);

	//Obtenemos los datos ingresados por el usuario
	var EditardatosM = LeerDatosEdicionMaquina();

	//Validamos la informacion
	var EvalidarM = ValidarDatosEdicionMaquina(EditardatosM);

	if(EvalidarM != null){
		swal.fire({
			title: "Error",
			text: EvalidarM,
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
			data: EditardatosM,
			success: function(data){

				console.log(data);
                //refresca la pagina luego de presionar ok 
				swal.fire({
					title: "Edicion exitosa!",
					text: "Se han actualizado los datos!",
					type: "success"
				}).then((result) =>{
					window.location.reload();
				});
             
				btn.prop('disabled', false);
				$('#Editar-Maquina').modal('hide');
				//location.reload();

			},
			error: function() {
				//toastr.error("Error al guardar nuava maquina");
				console.log("No se ha podido enviar la información");
			}
		});

	}


}

function LeerDatosEdicionMaquina(){

	var EDatosM = {
		EIdMaquina:$('#id-maquina-Editar').val(),
		ENombre:$('#nombre-maquina-Editar').val().trim(),
		EDescripcion:$('#descripcion-Editar').val().trim(),
		Method: "postEditarMaquina"
	};

	return EDatosM;
}

function DeshabilitarMaquina(des){
var id=des.iddemaquina;

var validarinhabilitar = validacioninhabilitar(des);

if(validarinhabilitar != null){
	swal.fire({
		title: "Error",
		text: validarinhabilitar,
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
	title:'¿Estas seguro/a en inhabilitar esta maquina?',
	type:'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Si!',
	cancelButtonText: 'Cancelar'
}).then((result) => {
	if (result.isConfirmed) {

	  $.ajax({
		type: "POST",
		data: {
		  'id': id, 'Method': "postDeshabilitarMaquina"
		},
		url: 'app/Controladores/Enrutador/RouteController.php',
		success: function(response) {
		  console.log(response);
		  if (response == "1") {
			Swal.fire(
			  'Deshabilitada!',
			  'La Maquina ha sido deshabilitada con exito.',
			  'success'
			).then((result) => {
			 window.location.reload();
			 } )
		   
		  }
		}
	 });

	  
	}
  })
 }
}



function GuardarNuevaMaquina(btn){

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
			closeOnConfirm: true  //estaba en false
		});

		btn.prop('disabled', false);
		//return;
	}else{
		$.ajax({
			type: 'POST',
			url: 'app/Controladores/Enrutador/RouteController.php',
			data: datos,
			success: function(data){
				console.log(data);
				// Se recive un string con los datos de la maquina ingrasada
				var divi = data.split('"');
				var duplicado = divi[1];
				console.log(duplicado);
				
				if(duplicado == 'repetido??'){
					swal.fire({
						title: "Error",
						text: "Ingrese un nombre diferente",
						showCancelButton: false,
						type: "error",
						confirmButtonClass: "btn-danger",
						confirmButtonText: "OK",
						closeOnConfirm: true  //estaba en false
					});
				}else{
					var idM = divi[3];
					console.log(idM);
					var name = divi[7];
					console.log(name);
					var desc = divi[11];
					console.log(desc);
					var ht = divi[15];
					console.log(ht);
					var idtm = divi[19];
					console.log(idtm);
					var idtem = divi[23];
					console.log(idtem);
					var tm = divi[27];
					console.log(tm);

					var table = $('#maquinaria-table').DataTable();
	
					table.row.add( [
						"",
						name,
						tm,
						desc,
						ht,
						'<button class="btn btn-dafault">'+
							'<i class="fa fa-plus-square"></i>'+
						'</button>'+
						'<button class="btn btn-dafault">'+
							'<i class="fa fa-edit"></i>'+
						'</button>'+
						'<button class="btn btn-dafault">'+
							'<i class="fa fa-trash"></i>'+
						'</button>'
					]).draw();

					/*Cuadno una nueva maquina es ingrasada, se asegura de mostrar el nuevo 
					registro al inicio de la tabla*/
					var currentPage = table.page();

					var index = table.row(this).index(),
					rowCount = table.data().length-1,
					insertedRow = table.row(rowCount).data(),
					tempRow;
					console.log(index);
			
					for (var i=rowCount;i>index;i--) {
						tempRow = table.row(i-1).data();
						table.row(i).data(tempRow);
						table.row(i-1).data(insertedRow);
					}
				
					table.page(currentPage).draw(false);

					//Mensaje de que el registro a sido exitoso
					swal.fire({
						title: "Registro exitoso!",
						text: "Se ha agregado la máquina",
						type: "success"
					});
				}
				//Se desbloquea el boton para agregarnuevas maquinas
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

	var Datos = {
		Nombre : $('#nombreMaquina').val().trim(),
		Descripcion : $('#descripcionMaquina').val().trim(),
		IdTipoMaquina : $('#idTipoMaquina').val().trim(),
		Method: "postNuevaMaquina"
	};

	return Datos;
}

function ValidarDatos(datos){
    //Inicio validaciones nombre maquinaria
	if(datos.Nombre == ''){
		return "Debe ingresar un nombre para la Maquina"; 
	}
	//INICIO VALIDACION ENTRADA DE DATOS VALIDOS
	if(datos.Nombre.includes("<") || datos.Nombre.includes("@") || datos.Nombre.includes(">") || datos.Nombre.includes("}") || datos.Nombre.includes('"') || datos.Nombre.includes("!") || datos.Nombre.includes(")") || datos.Nombre.includes("'") || datos.Nombre.includes("(") || datos.Nombre.includes("[") || datos.Nombre.includes("]") || datos.Nombre.includes("`") || datos.Nombre.includes("?") || datos.Nombre.includes("#") )
	{
		return "Nombre debe tener solo numeros y caracteres.\t Simbolos permitidos: '-' y '/' ";
	}
	
	//FIN VALIDACION ENTRADA DE DATOS VALIDOS

	//INICIO VALIDACION LONGITUD DE DATOS
	if(datos.Nombre.length>45)
	{
		return "Nombre puede tener hasta 35 caracteres";
	}
	//FIN VALIDACION LONGITUD DE DATOS

	//Fin validaciones nombre maquinaria
	//INICIO VALIDACIONES DESCRIPCION
	if(datos.Descripcion == ''){
		return "Debe ingresar una descripcion para la Maquina"; 
	}
	//INICIO VALIDACION ENTRADA DE DATOS VALIDOS
	if(datos.Descripcion.includes("<") || datos.Descripcion.includes("@") || datos.Descripcion.includes(">") || datos.Descripcion.includes("}") || datos.Descripcion.includes('"') || datos.Descripcion.includes("!") || datos.Descripcion.includes(")") || datos.Descripcion.includes("'") || datos.Descripcion.includes("`") || datos.Descripcion.includes("?") || datos.Descripcion.includes("]") || datos.Descripcion.includes("(") || datos.Descripcion.includes("#"))
	{
		return "La descripcion debe tener solo numeros y caracteres.\t Simbolos permitidos: '-' y '/' ";
	}
	
	//FIN VALIDACION ENTRADA DE DATOS VALIDOS
	if(datos.Descripcion.length>200)
	{
		return "La descripcion puede tener hasta 200 caracteres";
	}
	//FIN VALIDACION LONGITUD DE DATOS

	//FIN VALIDACIONES DESCRIPCION

	if(datos.IdTipoMaquina < 0){
		return "Debe seleccionar un tipo de maquina"; 
	}

}

function ValidarDatosEdicionMaquina(EditardatosM){

	if(EditardatosM.ENombre==''){
		return"Debe agregar un Nombre a la maquina";
	}
	if(EditardatosM.EDescripcion==''){
		return"Debe agregar una descripcion a la maquina";
	}
	if(EditardatosM.ENombre.includes("<") || EditardatosM.ENombre.includes("@") || EditardatosM.ENombre.includes(">") || EditardatosM.ENombre.includes("}") || EditardatosM.ENombre.includes('"') || EditardatosM.ENombre.includes("'") || EditardatosM.ENombre.includes("!") || EditardatosM.ENombre.includes(")"))
	{
		return "Nombre no permite los caracteres ingresados ";
	}
	if(EditardatosM.EDescripcion.includes("<") || EditardatosM.EDescripcion.includes("@") || EditardatosM.EDescripcion.includes(">") || EditardatosM.EDescripcion.includes("}") || EditardatosM.EDescripcion.includes('"') || EditardatosM.EDescripcion.includes("'") || EditardatosM.EDescripcion.includes("!") || EditardatosM.EDescripcion.includes(")"))
	{
		return "Descripcion no permite los carcteres ingresados";
	}
}

function validacioninhabilitar(des){

	if(des.estadodemaquina == 2){
		return "No se puede eliminar una maquina Asignada";
	}
	if(des.estadodemaquina == 3){
		return "No se puede eliminar una maquina Reasignada";
	}
	if(des.estadodemaquina == 4){
		return "No se puede eliminar una maquina En mantencion";
	}
	
	
}

function CargarGraficohorasMaquinas(){

	/* var donutmaquina = $('#grafico-topdiez-maquina');
	var rankingdiez = $(donutmaquina).data('ranking');
	var horastop = $(donutmaquina).data('horas');
 */

	$.ajax({
		type: "POST",
		data: {
		  Method: "postDatosGraficoTopMaquinas"
		},
		url: 'app/Controladores/Enrutador/RouteController.php',
		success: function(data) {

			GraficarTophorasMaquinas(data);
		}
	 });
}

function GraficarTophorasMaquinas(data){

	console.log(data);
	// Se recive un string con los datos de la maquina ingrasada
	var divi = data.split('"');
	//top1 maquina
	var top1nom = divi[3];
	console.log('top1: ' + top1nom);
	var top1horas = divi[7];
	console.log('top1: ' + top1horas);

	//top2 maquina
	var top2nom = divi[11];
	console.log('top2: ' + top2nom);
	var top2horas = divi[15];
	console.log('top2: ' + top2horas);

	//top3 maquina
	var top3nom = divi[19];
	console.log('top3: ' + top3nom);
	var top3horas = divi[23];
	console.log('top3: ' + top3horas);

	//top4 maquina
	var top4nom = divi[27];
	console.log('top4: ' + top4nom);
	var top4horas = divi[31];
	console.log('top4: ' + top4horas);

	//top5 maquina
	var top5nom = divi[35];
	console.log('top5: ' + top5nom);
	var top5horas = divi[39];
	console.log('top5: ' + top5horas);

	//top6 maquina
	var top6nom = divi[43];
	console.log('top6: ' + top6nom);
	var top6horas = divi[47];
	console.log('top6: ' + top6horas);

	//top7 maquina
	var top7nom = divi[51];
	console.log('top7: ' + top7nom);
	var top7horas = divi[55];
	console.log('top7: ' + top7horas);

	//top8 maquina
	var top8nom = divi[59];
	console.log('top8: ' + top8nom);
	var top8horas = divi[63];
	console.log('top8: ' + top8horas);

	//top9 maquina
	var top9nom = divi[67];
	console.log('top9: ' + top9nom);
	var top9horas = divi[71];
	console.log('top9: ' + top9horas);

	//top10 maquina
	var top10nom = divi[75];
	console.log('top10: ' + top10nom);
	var top10horas = divi[79];
	console.log('top10: ' + top10horas);

	Morris.Bar({
		element: 'grafico-topdiez-maquina',
		data: [
			{ device: top1nom, geekbench: top1horas },
			{ device: top2nom, geekbench: top2horas },
			{ device: top3nom, geekbench: top3horas },
			{ device: top4nom, geekbench: top4horas },
			{ device: top5nom, geekbench: top5horas },
			{ device: top6nom, geekbench: top6horas },
			{ device: top7nom, geekbench: top7horas },
			{ device: top8nom, geekbench: top8horas },
			{ device: top9nom, geekbench: top9horas },
			{ device: top10nom, geekbench: top10horas }
		],
		xkey: 'device',
		ykeys: ['geekbench'],
		labels: ['Geekbench'],
		barRatio: 0.4,
		barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		xLabelAngle: 35,
		hideHover: 'auto',
		resize: true
	});
}
