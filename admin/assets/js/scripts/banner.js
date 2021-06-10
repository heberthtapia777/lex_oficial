$( document ).ready(function() {
	init();	
	$('ul#home').addClass('show');
    $('ul li a#banner').addClass('active');
  });


function init(){
	validacion()
	ocultarForm();
	listaBanner();
	$("#btnNuevo").click(verForm);    
}

var validator;

function validacion(){
	validator = $("#frmBanner").submit(function() {
		// update underlying textarea before submit validation
		tinyMCE.triggerSave();
		}).validate({
			ignore: "",
			rules: {
				/*banner_title: "required",			
				banner_subtitle: "required",	*/			
				banner_img: "required"
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
		$(this).find('h5').html('Nuevo Banner');
		$('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
	});// Mostramos el formulario
	$("#verLista").hide();// ocultamos el listado
}

function ocultarForm(){
	tinymce.remove();
	$("#frmBanner").get(0).reset();
	$("#tax_resume, #tax_contens").html('');
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
        var formData = new FormData($("#frmBanner")[0]);       
    
        $.ajax({
            url: "../../ajax/bannerAjax.php?op=saveOrUpdate",
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
                        title: 'BANNER registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						ocultarForm();
						listaBanner();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar BANNER.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'BANNER actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        ocultarForm();
                        listaBanner();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar BANNER.',
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
        $(this).find('h5').html('Actualizar Banner');
      });// Mostramos el formulario
    $("#verLista").hide();// ocultamos el listado   
           

        $.ajax({
            url: "../../ajax/bannerAjax.php?op=edit",
            type: "POST",
            dataType: 'json',
            data:{
                id: id
            },            
            success: function(data){
                $('#banner_id').val(id);
                $('#banner_title').val(data.banner_title);
                $('#banner_subtitle').val(data.banner_subtitle);
                $('#banner_img').val(data.banner_img);
				
				$('#btnCancel').css('display','block');
				$('#btnNuevo').css('display', 'none');
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
}

/**
 * Elimina un BANNER
 */

 function delet(id){
    $.ajax({
        url: "../../ajax/bannerAjax.php?op=delete",
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
                    title: 'BANNER eliminado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(listaBanner())

            }
            if(data == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar BANNER.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }            
        }

    });
}

/**
 * Lista los Tax Alert
 */

function listaBanner(){
	var table = $('#tblBanner').dataTable(
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
                {   
                    "mDataProp": "2",
                    "width": "20%", "targets": 0 
                },                                
                {   "mDataProp": "3"},
                {   "mDataProp": "4"},
                {   "mDataProp": "5"}            
            ],"ajax":
            {
                url: '../../ajax/bannerAjax.php?op=list',
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

/**
 * Cambia status del Banner
 * @param {*} id 
 * @param {*} val 
 */

function status(id, val){	
    $.ajax({
        url: "../../ajax/bannerAjax.php?op=status",
        type: "POST",
        data:{
            id: id,
            val: val
        },        
        success: function(data)
        {
            if(val == 0){				
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Banner INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Banner ACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>')
            }
            //listaBanner();
            /*  OcultarForm();
            Limpiar();*/
        }

    });
}

lightbox.option({
	'resizeDuration': 200,
	'wrapAround': true
  })