$( document ).ready(function() {
    validacion();
    init();
    $('ul#contac').addClass('show');
    $('ul li a#user').addClass('active');
});


function init(){
    ocultarForm();
    listadoUsuarios();
    comboTypeUser();

    $("#btnNuevo").click(verForm);
    $("#btnBuscarCliente").click(abrirModalCliente);

    $("#btnAgregarEmpresa").click(function(e){
		e.preventDefault();

        var opt = $("input[type=radio]#optEmpleado:checked");
		$("#txtIdEmpresa").val(opt.val());
		$("#txtEmpresa").val(opt.attr("data-empresa"));

		$("#modalListaEmpresa").modal("hide");
    });
}

function validacion() {
    validator = $("#frmUser").submit(function() {
        // update underlying textarea before submit validation
    }).validate({
        ignore: "",
        rules: {
            txtEmpresa: "required",
            cboTypeUser: "required",
            txtEmail: {
                required: true,
                email: true
            },
            txtUser: "required",
            txtPassword: {
                required: true,
                minlength: 5
            },
            txtPasswordRep: {
                required: true,
                minlength: 5,
                equalTo: "#txtPassword"
            },
            txtUsuario: "required"
        },
        messages: {
            txtEmail: "Por favor, introduce una dirección de correo válida",
            txtPassword: {
                required: "Por favor ingrese una contraseña",
                minlength: "Tu contraseña debe tener al menos 5 caracteres"
            },
            txtPasswordRep: {
                required: "Por favor ingrese una contraseña",
                minlength: "Tu contraseña debe tener al menos 5 caracteres",
                equalTo: "La contraseña no es igual"
            }
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

        $('#user_date').val(fecha+' '+hora);
        $(this).find('h5').html('Nuevo Usuario');
        $('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
    });// Mostramos el formulario
    //$("#btnNuevo").hide();
    $("#verLista").hide();// ocultamos el listado
    //comboTypeUser();
    //initMap();
}

function ocultarForm(){

    $("#frmUser").get(0).reset();
    $("#verForm").hide();// Mostramos el formulario

    $('#btnCancel').css('display', 'none');
	$('#btnNuevo').css('display', 'block');
    $("#verLista").show();

}

function abrirModalCliente(){
    $("#modalListaEmpresa").modal("show");

    var table = $('#tblEmpresa').dataTable(
		{   "aProcessing": true,
			"aServerSide": true,
        	"aoColumns":[
        	     	{   "mDataProp": "0"},
                    {   "mDataProp": "1"},
                    {   "mDataProp": "2"},
                    {   "mDataProp": "3"},
                    {   "mDataProp": "4"}
            ],
            "ajax":
	        	{
	        		url: '../../ajax/usersAjax.php?op=listEmpleado',
					type : "get",
					dataType : "json",

					error: function(e){
				   		console.log(e.responseText);
					}
                },

	        "bDestroy": true

        }).DataTable();
}

$.validator.setDefaults( {
    submitHandler: function () {

        var formData = new FormData($("#frmUser")[0]);

        $.ajax({
            url: "../../ajax/usersAjax.php?op=SaveOrUpdate",
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
                        title: 'USUARIO registrado exitosamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) =>{
						//ocultarForm();
						//listadoUsuarios();
					})

                }
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al registrar USUARIO.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'USUARIO actualizado correctamente.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        ocultarForm();
                        listadoUsuarios();
                    })
                }
                if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al actulizar USUARIO.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }

        });
    }

});

function listadoUsuarios(){
    var table = $('#tblUsuarios').dataTable(
		{   "aProcessing": true,
			"aServerSide": true,
            "scrollX": true,
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
                    {   "mDataProp": "2"},
                    {
                        "mDataProp": "3",
                        className: 'dt-body-center'
                    },
                    {   "mDataProp": "4"},
                    {   "mDataProp": "5"},
                    {   "mDataProp": "6"},
                    {   "mDataProp": "7"},
                    {   "mDataProp": "8"}

            ],
            "ajax":
	        	{
	        		url: '../../ajax/usersAjax.php?op=list',
					type : "get",
					dataType : "json",
					error: function(e){
				   		console.log(e.responseText);
					}
                },

	        "bDestroy": true

        }).DataTable();

};

function cargaData(id){

    $("#verForm").show("slow", function() {
        // Animation complete.
        $(this).find('h5').html('Actualizar Usuario');
    });// Mostramos el formulario

    $("#verLista").hide();// ocultamos el listado

    $.ajax({
        url: "../../ajax/usersAjax.php?op=edit",
        type: "POST",
        dataType: 'json',
        data:{
            id: id
        },
        success: function(data){

            $("#txtIdUsuario").val(id);
            $("#txtIdEmpresa").val(data.idEmp);
            $("#txtEmpresa").val(data.empresa);
            $("#txtUsuario").val(data.name);
            $("#cboTypeUser").val(data.title);
            $("#txtEmail").val(data.email);
            $("#txtUser").val(data.username);

            $('#btnCancel').css('display','block');
            $('#btnNuevo').css('display', 'none');
        },
            error: function(e) {
                console.log(e.responseText);
            }
    });
}

function comboTypeUser(){
    $.post("../../ajax/usersAjax.php?op=listTypeUser", function(r){
        $("#cboTypeUser").html(r);
    });
}

/**
 * Cambia status del Tax Alert
 * @param {*} id
 * @param {*} val
 */

 function status(id, val){
    $.ajax({
        url: "../../ajax/usersAjax.php?op=status",
        type: "POST",
        data:{
            id: id,
            val: val
        },
        success: function(data)
        {
            if(val == 1){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 0)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario ACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-success"><i class="fas fa-check-circle"></i></span></a>')
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