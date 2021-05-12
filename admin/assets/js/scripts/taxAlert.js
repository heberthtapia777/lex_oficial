$( document ).ready(function() {
	init();	
	$('ul#publi').addClass('show');
    $('ul li a#tax').addClass('active');
  });


function init(){
	validacion()
	ocultarForm();
	listaTaxAlert();
	$("#btnNuevo").click(verForm);    
}

var validator;

function validacion(){
	validator = $("#frmTaxAlert").submit(function() {
		// update underlying textarea before submit validation
		tinyMCE.triggerSave();
		}).validate({
			ignore: "",
			rules: {
				tax_title: "required",			
				tax_resume: "required",
				tax_contens: "required",
				tax_img: "required",	
				tax_file: "required"
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
		$(this).find('h5').html('Nuevo Tax Alert');
		$('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
	});// Mostramos el formulario
	$("#verLista").hide();// ocultamos el listado
	cargaEditor();  
}

function ocultarForm(){
	tinymce.remove();
	$("#frmTaxAlert").get(0).reset();
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
        var formData = new FormData($("#frmTaxAlert")[0]);       
    
        $.ajax({
            url: "../../ajax/taxAlertAjax.php?op=saveOrUpdate",
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
                        title: 'TAX ALERT registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						ocultarForm();
						listaTaxAlert();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar TAX ALERT.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'TAX ALERT actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        listaTaxAlert();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar TAX ALERT.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }

        });
    }
});

/**
 * Carga editor TINYMCE
 */

function cargaEditor(){   
    
    tinymce.init({
        selector: '#tax_resume, #tax_contens',
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

/**
 * Edita formulario
 */

 function cargaData(id){     

	tinymce.remove();
       
    $("#verForm").show("slow", function() {
        // Animation complete.
        $(this).find('h5').html('Actualizar Tax Alert');
      });// Mostramos el formulario
    $("#verLista").hide();// ocultamos el listado   
           

        $.ajax({
            url: "../../ajax/taxAlertAjax.php?op=edit",
            type: "POST",
            dataType: 'json',
            data:{
                id: id
            },            
            success: function(data){
                $('#id').val(id);
                $('#tax_title').val(data.tax_title);
                $('#tax_resume').val(data.tax_resume);                
                $('#tax_contens').val(data.tax_contens);

                cargaEditor();  
				
				$('#btnCancel').css('display','block');
				$('#btnNuevo').css('display', 'none');
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
}

/**
 * Elimina un Tax Alert
 */

 function delet(id){
    $.ajax({
        url: "../../ajax/taxAlertAjax.php?op=delete",
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
                    title: 'TAX ALERT eliminado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(listaTaxAlert())

            }
            if(data == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar TAX ALERT.',
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

function listaTaxAlert(){
	var table = $('#tblTaxAlert').dataTable(
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
                {   "mDataProp": "5"},
                {   "mDataProp": "6"}                
            ],"ajax":
            {
                url: '../../ajax/taxAlertAjax.php?op=list',
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
 * Cambia status del Tax Alert
 * @param {*} id 
 * @param {*} val 
 */

function status(id, val){	
    $.ajax({
        url: "../../ajax/taxAlertAjax.php?op=status",
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
                    title: 'Tax Alert INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tax Alert ACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>')
            }
            //listaTaxAlert();
            /*  OcultarForm();
            Limpiar();*/
        }

    });
}

lightbox.option({
	'resizeDuration': 200,
	'wrapAround': true
  })