$( document ).ready(function() {
    validacion();
    init();
    $('ul#contac').addClass('show');
    $('ul li a#client').addClass('active');
});


function init(){   
    ocultarForm();
    listadoClientes();
    comboTypePlan();

    $("#btnNuevo").click(verForm);    
}

function validacion() {

    validator = $("#frmClient").submit(function() {
        // update underlying textarea before submit validation				
    }).validate({
        ignore: "",
        rules: {
            client_emp: "required",
            client_nit: "required",					
            client_email: {
                required: true,
                email: true
            },
            client_fono: "required",
            client_fax: "required",
            client_address: "required",
            client_city: "required",
            client_sus: "required",
            client_plan: "required",
            client_lic: "required"
        },				
        messages: {
            client_email: "Por favor, introduce una dirección de correo válida"					
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

}

function verForm(){
    $("#verForm").show("slow", function(){
        var hoy = new Date();
        var fecha = hoy.getFullYear() + '-' + hoy.getMonth() + '-' + hoy.getDate();

        var hora = hoy.getHours();
		var minutos = hoy.getMinutes();

        if (hora < 10) hora = "0" + hora;
		if (minutos < 10) minutos = "0" + minutos;
		//if (segundos < 10) segundos = "0" + segundos;

		hora = hora+':'+minutos;

        $('#client_date').val(fecha+' '+hora);
        $(this).find('h5').html('Nuevo Cliente');
        $('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
    });// Mostramos el formulario
    //$("#btnNuevo").hide();
    $("#verLista").hide();// ocultamos el listado
    //comboTypeUser();
    //initMap();
}

function ocultarForm(){
    
    $("#frmClient").get(0).reset();       
    $("#verForm").hide();// Mostramos el formulario
    
    $('#btnCancel').css('display', 'none');
	$('#btnNuevo').css('display', 'block');
    $("#verLista").show();

}

$.validator.setDefaults( {
    submitHandler: function () {
        //alert( "submitted!" );     
        //$("#frmBoletin").submit();
        var formData = new FormData($("#frmClient")[0]);       
    
        $.ajax({
            url: "../../ajax/clientAjax.php?op=saveOrUpdate",
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
                        title: 'CLIENTE registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						ocultarForm();
						listadoClientes();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar CLIENTE.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'CLIENTE actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        ocultarForm();
                        listadoClientes();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar CLIENTE.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }

        });       
    }
    
});


function listadoClientes(){
    var table = $('#tblCliente').dataTable(
		{   "aProcessing": true,
			"aServerSide": true,
            "scrollX": true,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
            },          
   			"dom": 'Bfrtip',
	        "buttons": [	            
	            'excelHtml5',	            
	            'pdfHtml5'
	        ],
        	"aoColumns":[
        	     	{   "mDataProp": "0"},
                    {   "mDataProp": "1"},
                    {   "mDataProp": "2"},
                    {   "mDataProp": "3"},
                    {   "mDataProp": "4"},
                    {   "mDataProp": "5"},
                    {   
                        "mDataProp": "6",
                        className: 'dt-body-center'
                    },   
                    {   "mDataProp": "7"},
                    {   "mDataProp": "8"},
                    {   "mDataProp": "9"}
            ],
            "ajax":
	        	{
	        		url: '../../ajax/clientAjax.php?op=list',
					type : "get",
					dataType : "json",
					error: function(e){
				   		console.log(e.responseText);
					}
                },            
	        "bDestroy": true
        }).DataTable();        
};

function comboTypePlan(){
    $.post("../../ajax/clientAjax.php?op=listTypePlan", function(r){
        $("#client_plan").html(r);
    });
}

/**
 * Edita formulario
 */

 function cargaData(id){   
       
    $("#verForm").show("slow", function() {
        // Animation complete.
        $(this).find('h5').html('Actualizar Cliente');
      });// Mostramos el formulario
    $("#verLista").hide();// ocultamos el listado             

        $.ajax({
            url: "../../ajax/clientAjax.php?op=edit",
            type: "POST",
            dataType: 'json',
            data:{
                id: id
            },            
            success: function(data){
                var hoy = new Date();
                var fecha = hoy.getFullYear() + '-' + hoy.getMonth() + '-' + hoy.getDate();

                var hora = hoy.getHours();
                var minutos = hoy.getMinutes();

                if (hora < 10) hora = "0" + hora;
                if (minutos < 10) minutos = "0" + minutos;
                //if (segundos < 10) segundos = "0" + segundos;

                hora = hora+':'+minutos;

                $('#client_date').val(fecha+' '+hora);
                
                $("#client_id").val(id);
                $("#client_emp").val(data.client_emp);
                $("#client_nit").val(data.client_nit);
                $("#client_email").val(data.client_email);
                $("#client_fono").val(data.client_fono);
                $("#client_fax").val(data.client_fax);
                $("#client_address").val(data.client_address);
                $("#client_city").val(data.client_city);
                $("#client_sus").val(data.client_sus);
                $("#client_plan").val(data.client_plan);
                $("#client_lic").val(data.client_lic);
				
				$('#btnCancel').css('display','block');
				$('#btnNuevo').css('display', 'none');
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
}

/**
 * Cambia status del Tax Alert
 * @param {*} id 
 * @param {*} val 
 */

 function status(id, val){	
    $.ajax({
        url: "../../ajax/clientAjax.php?op=status",
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
                    title: 'Cliente INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cliente ACTIVO',
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

/**
 * Elimina un Cliente
 */

 function delet(id){
    $.ajax({
        url: "../../ajax/clientAjax.php?op=delete",
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
                    title: 'CLIENTE eliminado exitosamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(listadoClientes())

            }
            if(data == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar CLIENTE.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }            
        }

    });
}