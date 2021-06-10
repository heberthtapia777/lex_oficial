$( document ).ready(function() {
	init();	
	$('ul#home').addClass('show');
    $('ul li a#indice').addClass('active');
  });


function init(){
	validacion()
	ocultarForm();
	listaIndice();
	$("#btnNuevo").click(verForm);    
}

var validator;

function validacion(){
	validator = $("#frmIndice").submit(function() {
		// update underlying textarea before submit validation
		tinyMCE.triggerSave();
		}).validate({
			ignore: "",
			rules: {
				indice_title: "required"				
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
			highlight: function ( error, errorClass, validClass ) {
			$( error ).addClass( "is-invalid" ).removeClass( "is-valid" );
			},
			unhighlight: function (error, errorClass, validClass) {
			$( error ).addClass( "is-valid" ).removeClass( "is-invalid" );
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
}

function verForm(){        
	$("#verForm").show("slow", function() {
		// Animation complete.
		$(this).find('h5').html('Nuevo Indice');
		$('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
	});// Mostramos el formulario
	$("#verLista").hide();// ocultamos el listado
}

function ocultarForm(){
	$("#frmIndice").get(0).reset();
	$("#verForm").hide();// Mostramos el formulario
	$('#btnCancel').css('display', 'none');
	$('#btnNuevo').css('display', 'block');
	$("#verLista").show();
}

/**
 * Funcion despues de la validacion se envia
 * el formulario para guardar y editar
 */

$.validator.setDefaults( {
    submitHandler: function () {
        var formData = new FormData($("#frmIndice")[0]);       
    
        $.ajax({
            url: "../../ajax/indiceAjax.php?op=saveOrUpdate",
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
                        title: 'INDICE registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						ocultarForm();
						listaIndice();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar INDICE.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'INDICE actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        ocultarForm();
                        listaIndice();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar INDICE.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }

        });
    }
});

/**
 * Edita formulario
 */

 function cargaData(id){  
       
    $("#verForm").show("slow", function() {
        // Animation complete.
        $(this).find('h5').html('Actualizar Indice');
      });// Mostramos el formulario
    $("#verLista").hide();// ocultamos el listado   
           

        $.ajax({
            url: "../../ajax/indiceAjax.php?op=edit",
            type: "POST",
            dataType: 'json',
            data:{
                id: id
            },            
            success: function(data){
                $('#indice_id').val(id);
                $('#indice_title').val(data.indice_title);
				
				$('#btnCancel').css('display','block');
				$('#btnNuevo').css('display', 'none');
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
}

/**
 * Elimina un INDICE
 */

 function delet(id){
    $.ajax({
        url: "../../ajax/indiceAjax.php?op=delete",
        type: "POST",
        data: {
            id: id
        },              
        success: function(data){
            //  $('#resSearch').html(data);
            if(data == 0){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'INDICE eliminado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(listaIndice())

            }
            if(data == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar INDICE.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }            
        }

    });
}

/**
 * Lista los Indice
 */

function listaIndice(){
	var table = $('#tblIndice').dataTable(
		{   "aProcessing": true,
            "aServerSide": true,
            "scrollX": true,
            "bFilter": true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
            },        
            "aoColumns":[
                {   "mDataProp": "0"},
                {   "mDataProp": "1"},                                  
                {   "mDataProp": "2"}
            ],"ajax":
            {
                url: '../../ajax/indiceAjax.php?op=list',
                type : "get",
                dataType : "json",
                error: function(e){
                       console.log(e.responseText);
                }
            },
            //"order": [[ 0, 'desc' ]],
	        "bDestroy": true

        }).DataTable();	
	
}