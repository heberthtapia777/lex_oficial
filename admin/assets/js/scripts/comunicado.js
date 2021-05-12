$( document ).ready(function() {
	init();	
	$('ul#publi').addClass('show');
    $('ul li a#com').addClass('active');
  });


function init(){ 
    validacion();
	ocultarForm();
	listaCom();
	$("#btnNuevo").click(verForm);    
}

var validator;

function validacion(){
    validator = $("#frmCom").submit(function() {
        // update underlying textarea before submit validation
        tinyMCE.triggerSave();
        }).validate({
            ignore: "",
            rules: {
                com_title: "required",			
                com_resume: "required",
                com_contens: "required",
                com_autor: "required",
                accept: { uploadFile: true } 
                //com_file[]: "required"
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
		$(this).find('h5').html('Nuevo Comunicado');
        $('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
	});// Mostramos el formulario
	$("#verLista").hide();// ocultamos el listado
	cargaEditor();
    
}

function ocultarForm(){
	tinymce.remove();
	$("#frmCom").get(0).reset();
	$("#com_resume, #com_contens").html('');
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
        var formData = new FormData($("#frmCom")[0]);       
    
        $.ajax({
            url: "../../ajax/comunicadoAjax.php?op=saveOrUpdate",
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
                        title: 'COMUNICADO registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						ocultarForm();
						listaCom();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar COMUNICADO.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'COMUNICADO actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        ocultarForm();
                        listaCom();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar COMUNICADO.',
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
        selector: '#com_resume, #com_contens',
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
        $(this).find('h5').html('Actualizar Comunicado');
      });// Mostramos el formulario
    $("#verLista").hide();// ocultamos el listado   
           

        $.ajax({
            url: "../../ajax/comunicadoAjax.php?op=edit",
            type: "POST",
            dataType: 'json',
            data:{
                id: id
            },            
            success: function(data){
                $('#com_id').val(id);
                $('#com_title').val(data.com_title);
                $('#com_resume').val(data.com_resume);                
                $('#com_contens').val(data.com_contens);
                $('#com_autor').val(data.com_autor);

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
 * Elimina un COMUNICADO
 */

 function delet(id){
    $.ajax({
        url: "../../ajax/comunicadoAjax.php?op=delete",
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
                    title: 'COMUNICADO eliminado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(listaCom())

            }
            if(data == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar el COMUNICADO.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }            
        }

    });
}

/**
 * Lista los COMUNICADO
 */

function listaCom(){
	var table = $('#tblCom').dataTable(
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
                {   "mDataProp": "2"},
                {   "mDataProp": "3"},
                {   "mDataProp": "4"},
                {   "mDataProp": "5"}
            ],"ajax":
            {
                url: '../../ajax/comunicadoAjax.php?op=list',
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
        url: "../../ajax/comunicadoAjax.php?op=status",
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
                    title: 'Comunicado INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Comunicado ACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 0)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>')
            }
            //listaCom();
            /*  OcultarForm();
            Limpiar();*/
        }

    });
}

lightbox.option({
	'resizeDuration': 200,
	'wrapAround': true
  })