var validator;
$( document ).ready(function() {
	init();
	$('ul#publi').addClass('show');
	$('ul li a#bol').addClass('active');

	validator = $("#frmBoletin").validate({
		ignore: "",
		rules: {
			nroRef: "required",
			dateImpresion: {
				required: true,
				date: true
			},
			cboIndice: "required",
			datePubli: {
				required: true,
				date: true
			},
			dateBoletin: {
				required: true,
				date: true
			},
			asunto: "required",
			intro: "required",
			cont: "required",
		},
		errorElement: "em",
		errorPlacement: function(label, element) {
			// Add the `invalid-feedback` class to the label element
			label.addClass( "invalid-feedback" );

			if ( element.prop( "type" ) === "checkbox" ) {
				label.insertAfter( element.next() );
			} else {
				//label.insertAfter( element );
				// position label label after generated textarea
				if (element.is("textarea")) {
					label.insertAfter(element.next());
				} else {
					label.insertAfter(element)
				}
			}
		},
		highlight: function(error, errorClass, validClass) {
			$(error)
				.addClass("is-invalid")
				.removeClass("is-valid");
		},
		unhighlight: function(error, errorClass, validClass) {
			$(error)
				.addClass("is-valid")
				.removeClass("is-invalid");
		}
	});

	validator.focusInvalid = function() {
		// put focus on tinymce on submit validation
		if (this.settings.focusInvalid) {
			try {
				var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
				if (toFocus.is("textarea")) {
					tinyMCE.get(toFocus.attr("id")).focus();
				} else {
					toFocus.filter(":visible").focus();
				}
			} catch (e) {
				// ignore IE throwing errors when focusing hidden elements
			}
		}
	}
});

function init(){

	$('#dateImpresion').datepicker({
	   // uiLibrary: 'materialdesign',
		locale: 'es-es',
		format: 'yyyy-mm-dd',
		footer: true,
		modal: true
	});
	$('#datePubli').datepicker({
		// uiLibrary: 'materialdesign',
		locale: 'es-es',
		format: 'yyyy-mm-dd',
		footer: true,
		modal: true
	});
	$('#dateBoletin').datepicker({
		// uiLibrary: 'materialdesign',
		locale: 'es-es',
		format: 'yyyy-mm-dd',
		footer: true,
		modal: true
	});

	ocultarForm();
	listaBoletin();
	comboTypeIndice();
	comboTemas();

	$("#btnNuevo").click(verForm);
}
//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
	// Configuration options
	var conf = $.extend( {
		pages: 5,     // number of pages to cache
		url: '',      // script url
		data: null,   // function or object with parameters to send to the server
					// matching how `ajax.data` works in DataTables
		method: 'GET' // Ajax HTTP method
	}, opts );

	// Private variables for storing the cache
	var cacheLower = -1;
	var cacheUpper = null;
	var cacheLastRequest = null;
	var cacheLastJson = null;

	return function ( request, drawCallback, settings ) {
		var ajax          = false;
		var requestStart  = request.start;
		var drawStart     = request.start;
		var requestLength = request.length;
		var requestEnd    = requestStart + requestLength;

		if ( settings.clearCache ) {
			// API requested that the cache be cleared
			ajax = true;
			settings.clearCache = false;
		}
		else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
			// outside cached data - need to make a request
			ajax = true;
		}
		else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
				JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
				JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
		) {
			// properties changed (ordering, columns, searching)
			ajax = true;
		}

		// Store the request for checking next time around
		cacheLastRequest = $.extend( true, {}, request );

		if ( ajax ) {
			// Need data from the server
			if ( requestStart < cacheLower ) {
				requestStart = requestStart - (requestLength*(conf.pages-1));

				if ( requestStart < 0 ) {
					requestStart = 0;
				}
			}

			cacheLower = requestStart;
			cacheUpper = requestStart + (requestLength * conf.pages);

			request.start = requestStart;
			request.length = requestLength*conf.pages;

			// Provide the same `data` options as DataTables.
			if ( typeof conf.data === 'function' ) {
				// As a function it is executed with the data object as an arg
				// for manipulation. If an object is returned, it is used as the
				// data object to submit
				var d = conf.data( request );
				if ( d ) {
					$.extend( request, d );
				}
			}
			else if ( $.isPlainObject( conf.data ) ) {
				// As an object, the data given extends the default
				$.extend( request, conf.data );
			}

			return $.ajax( {
				"type":     conf.method,
				"url":      conf.url,
				"data":     request,
				"dataType": "json",
				"cache":    false,
				"success":  function ( json ) {
					cacheLastJson = $.extend(true, {}, json);

					if ( cacheLower != drawStart ) {
						json.data.splice( 0, drawStart-cacheLower );
					}
					if ( requestLength >= -1 ) {
						json.data.splice( requestLength, json.data.length );
					}

					drawCallback( json );
				}
			} );
		}
		else {
			json = $.extend( true, {}, cacheLastJson );
			json.draw = request.draw; // Update the echo for each response
			json.data.splice( 0, requestStart-cacheLower );
			json.data.splice( requestLength, json.data.length );

			drawCallback(json);
		}
	}
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
	return this.iterator( 'table', function ( settings ) {
		settings.clearCache = true;
	});
});

function abrirModalBuscaBol(){
	$("#modalBuscaBoletin").modal("show");

}

$('.btn-rigth').on('click',function(){

	idCon = $(this).attr("id");
	idNam = $(this).attr("name");

	$('#modalBuscaBoletin').modal({show:true});

	$('#idCon').val(idCon);
	$('#idNam').val(idNam);

});

$('#modalBuscaBoletin').on('hidden.bs.modal', function (e) {
	// put your default event here
	$("#frmSearch")[0].reset();
	$('#resSearch').html('');
});

$( "#frmSearch" ).submit(function( event ) {
	event.preventDefault();
	var formData = new FormData($("#frmSearch")[0]);

	$.ajax({
		url: "../../ajax/boletinAjax.php?op=search",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(data){
			$('#resSearch').html(data);
		}

	});
});

$.validator.setDefaults( {
	submitHandler: function () {
		//alert( "submitted!" );
		//$("#frmBoletin").submit();
		var formData = new FormData($("#frmBoletin")[0]);

		$.ajax({
			url: "../../ajax/boletinAjax.php?op=saveOrUpdate",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				//  $('#resSearch').html(data);
				if(data == 0){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'BOLETIN registrado exitosamente.',
						showConfirmButton: false,
						timer: 2000
					}).then((result) =>{
						limpiar();
						ocultarForm();
						listaBoletin();
					})
				}
				if(data == 1){
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Error al registrar BOLETIN.',
						showConfirmButton: false,
						timer: 2000
					})
				}
				if(data == 2){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'BOLETIN actualizado correctamente.',
						showConfirmButton: false,
						timer: 2000
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						limpiar();
						ocultarForm();
						//listaBoletin();
					})
				}
				if(data == 3){
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Error al actulizar BOLETIN.',
						showConfirmButton: false,
						timer: 2000
					})
				}
			}

		});
	}
});

function addIdBoletin(id, idNam, idCon){
	var check = '<span id="'+id+'"><input type="checkbox" class="btn-check" id="'+idCon+'Check[]" name="'+idCon+'Check[]" value="'+id+'" onclick="delCheck('+id+', &#39;'+idCon+'&#39;)" checked="checked" ><label class="btn btn-primary btn-xs" for="'+idCon+'Check[]">'+id+'</label></span>';
	$('#check'+idCon).append(check);
	$('div#resSearch').find('span#'+id).remove();

}

function delCheck(id, idCon){
	$('#check'+idCon).find('#'+id).remove();
	$('div#check'+idCon).find('span#'+id).remove();
}

function limpiar() {

	$("#frmBoletin")[0].reset();
	validator.resetForm();
	$("#frmBoletin")
		.find("input")
		.removeClass("is-valid");
	$("#frmBoletin")
		.find("select")
		.removeClass("is-valid");
	$("table#upload tbody").html("");
	tinymce.remove();

	$("#idBoletin").val("");
}

function verForm(){
	$.ajax({
		url: "../../inc/sessionControljs.php",
		type: "POST",
		success: function(data){
			if(data == 0){
				window.location.href = '../../index.html';
			}else{
				//validator.resetForm();
				$("#verForm").show("slow", function() {
					// Animation complete.
					$(this).find('h5').html('Nuevo Boletín');
					$('#btnCancel').css('display','block');
					$('#btnNuevo').css('display', 'none');
				});// Mostramos el formulario
				$("#verLista").hide();// ocultamos el listado
				comboTemas();
				cargaEditor();
				for (let i = 1; i <= 12; i++) {
					$('#check'+i).html('');
				}
			}
		}
		})

}

function ocultarForm(){
	//validator.resetForm();
	tinymce.remove();
	$("#frmBoletin").get(0).reset();
	$("#intro, #cont").html('');
	$("#verForm").hide();// Mostramos el formulario
	$('#btnCancel').css('display', 'none');
	$('#btnNuevo').css('display', 'block');
	$("#verLista").show();
}

function cancelar() {
	limpiar();
	ocultarForm();
}

function block(idBol, val){
	$.ajax({
		url: "../../ajax/boletinAjax.php?op=block",
		type: "POST",
		data:{
			idBol: idBol,
			val: val
		},
		success: function(data)
		{
			if(val == 0){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Boletin BLOQUEADO',
					showConfirmButton: false,
					timer: 1500
				})
				$('a#'+idBol).parent('td').html('<a href="#" id="'+idBol+'" onclick="block('+idBol+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
			}else{
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Boletin HABILITADO',
					showConfirmButton: false,
					timer: 1500
				})
				$('a#'+idBol).parent('td').html('<a href="#" id="'+idBol+'" onclick="block('+idBol+', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>')
			}
		}

	});
}

function listaBoletin(){

	var table = $('#tblBoletin').dataTable(
		{   "aProcessing": true,
			"aServerSide": true,
			"scrollX": true,
			//"bFilter": false,
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
			},
   			dom: 'Bfrtip',
			buttons: [
				'excelHtml5',
				'pdfHtml5'
			],
			"aoColumns":[
				{   "mDataProp": "0"},
				{   "mDataProp": "1"},
				{
					"mDataProp": "2",
					"width": "20%", "targets": 0
				},
				{   "mDataProp": "3"},
				{   "mDataProp": "4"},
				{   "mDataProp": "5"},
				{   "mDataProp": "6"},
				{   "mDataProp": "7"},
				{
					"mDataProp": "8",
					className: 'dt-body-center'
				},
				{   "mDataProp": "9"}
			],"ajax":
			{
				url: '../../ajax/boletinAjax.php?op=list',
				type : "get",
				dataType : "json",
				error: function(e){
					   console.log(e.responseText);
				}
			},
			"order": [[ 1, 'desc' ]],
			"bDestroy": true

		}).DataTable();

		table.on( 'draw.dt', function () {
			var PageInfo = $('#tblBoletin').DataTable().page.info();
				 table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
					cell.innerHTML = i + 1 + PageInfo.start;
			});
			/*$('.dataTables_filter input').on( 'keyup', function () {
				table.search( this.value ).draw();
			} );*/
				//alert('entra');
			   /* if ($(this).val().length < 3 ) return;
					table.fnFilter($(this).val()); */

		});
		$('input[type="text"]').val('');
		$('#button-addon2').click(function(){

			$('#tblBoletin').DataTable().search(
				$('#buscar').val()
			).draw();
		})


}

function cargaDataBoletin(idBoletin){
	tinymce.remove();
	$.ajax({
		url: "../../inc/sessionControljs.php",
		type: "POST",
		success: function(data){
			//alert(data);
			if(data != 1){
				window.location.href = '../../index.html';
			}else{
				$.ajax({
					url: "../../ajax/boletinAjax.php?op=editBoletin",
					cache: false,
					async: true,
					type: "POST",
					dataType: 'json',
					data:{
						idBoletin: idBoletin
					},
					success: function(data){
						$("#verForm").show("slow", function() {
							// Animation complete.
							$(this).find('h5').html('Editar Boletín: '+idBoletin);
						});// Mostramos el formulario
						$("#verLista").hide();// ocultamos el listado

						$('#idBoletin').val(idBoletin);
						$('#nroRef').val(data.circular);
						$('#dateImpresion').val(data.dateCirc);
						//$('#imgBol').val(data.imagen);
						$('#pieImg').val(data.pie_imagen);
						$('#cboIndice').val(data.idIn);
						comboVerCheck(data.idTema);
						$('#datePubli').val(data.datePubli);
						$('#dateBoletin').val(data.dateCrea);
						$('#asunto').val(data.asunto);
						$('#intro').html(data.intro);
						$('#cont').html(data.cont);
						$('#info').val(data.info);
						$('#nota').val(data.nota);
						comboCargaConcor(idBoletin);

						cargaEditor();

						$('#btnCancel').css('display','block');
						$('#btnNuevo').css('display', 'none');
					},
					error: function(e) {
						console.log(e.responseText);
					}
				});
			}
		}
	})
}

function comboTypeIndice(){
	$.post("../../ajax/boletinAjax.php?op=listTypeIndice", function(r){
		$("#cboIndice, #tipo").html(r);
	});
}

function comboTypeIndiceEdit( idIn, indice){
	// $.post("../../ajax/boletinAjax.php?op=listTypeIndiceEdit&idIn="+idIn+"&indice="+indice+"", function(r){
	// 	$('#indice').html(r);
	// })
	// $.ajax({
	// 	url: "../../ajax/boletinAjax.php?op=listTypeIndice",
	// 	type: 'post',
	// 	cache: false,
	// 	async: false,
	// 	success: function(data) {
	// 		$("#indice, #tipo").html(data);
	// 	},
	// 	complete: function () {
	// 		alert(idIn);
	// 		$('#indice').val(idIn);
	// 	}
	// });
	// $.post("../../ajax/boletinAjax.php?op=listTypeIndice", function(r){
	// 	$("#indice, #tipo").html(r);
	// });


	// $.post("../../ajax/boletinAjax.php?op=listTypeIndice", function(r){
	// 	$("#tipo").html(r);
	// })
}

function comboTemas(){
	$.ajax({
		url: "../../ajax/boletinAjax.php?op=listTemas",
		type: 'post',
		//cache: false,
		//async: true,
		success: function(data) {
			$("#checkTema").html(data);
		}
	});
}

function comboVerCheck( temas ){
	$.ajax({
		url: "../../ajax/boletinAjax.php?op=listTemasCheck&temas="+temas+"",
		type: 'post',
		dataType: 'json',
		cache: false,
		async: false,
		success: function(data) {
			//comboTemas();
			$.each(data, function(index, valor) {
				$('#checkTema'+valor).prop("checked", true);
			})
		}
	});
}

/** GUARDAR FUNCION */
/*function cargaTemasCheck(){
	$.when(comboTemas()).then(comboVerCheck());
}*/

function comboCargaConcor( id ){
	$.ajax({
		url: "../../ajax/boletinAjax.php?op=listCargaConcor&idBol="+id+"",
		type: 'post',
		dataType: 'json',
		cache: false,
		asincrono: false,
		beforeSend: function(data) {
			for (let i = 1; i <= 12; i++) {
				$('#check'+i).html('');
			}
		},
		success: function(data) {
			$.each(data.idCon, function(index, valor) {
				addIdBoletin(data.idCon[index], '', data.idCla[index]);
			})
		}
	});
}

function deletBoletin(idBol){
	$.ajax({
		url: "../../ajax/boletinAjax.php?op=delete",
		type: "POST",
		data: {
			idBol: idBol
		},
		success: function(data){
			//  $('#resSearch').html(data);
			if(data == 0){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'BOLETIN eliminado exitosamente.',
					showConfirmButton: false,
					timer: 2000
				}).then(listaBoletin())

			}
			if(data == 1){
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Error al eliminar BOLETIN.',
					showConfirmButton: false,
					timer: 2000
				})
			}
		}

	});
}

function cargaEditor(){

	tinymce.init({
		selector: '#intro, #cont',
		language: 'es',
		height : "480",
		plugins: 'print preview importcss searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',

		mobile: {
		plugins: 'print preview importcss searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons'
		},

		menubar: ' edit view format table tc help',
		toolbar: 'undo redo | bold italic underline strikethrough | formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print',
		autosave_ask_before_unload: true,

		setup: function(editor) {
			editor.on('change', function(e) {
				tinymce.triggerSave();
				$("#" + editor.id).valid();
			});
		}
	});
}
