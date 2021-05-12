$( document ).ready(function() {
    init();
    $('ul#contac').addClass('show');
    $('ul li a#user').addClass('active');
  });


function init(){
    ocultarForm();
    listadoUsuarios();  

    $("#btnNuevo").click(verForm);     
    $("#btnBuscarCliente").click(abrirModalCliente);

    $("#btnAgregarEmpresa").click(function(e){
		e.preventDefault();

        var opt = $("input[type=radio]#optEmpleado:checked");
        alert(opt.val());
		$("#txtIdEmpresa").val(opt.val());
		$("#txtEmpresa").val(opt.attr("data-empresa"));

		$("#modalListaEmpresa").modal("hide");
    });   
        
}

function verForm(){
    $("#verForm").show("slow", function(){
        $(this).find('h5').html('Nuevo Usuario');
        $('#btnCancel').css('display','block');
		$('#btnNuevo').css('display', 'none');
    });// Mostramos el formulario
    //$("#btnNuevo").hide();
    $("#verLista").hide();// ocultamos el listado
    comboTypeUser();
    //initMap();
}

function ocultarForm(){
    $("#frmUsuarios").get(0).reset();
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
        //alert( "submitted!" );     
        //$("#frmBoletin").submit();
        var formData = new FormData($("#frmUsuarios")[0]);       
    
        $.ajax({
            url: "../../ajax/usersAjax.php?op=saveOrUpdate",
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
						ocultarForm();
						listaBoletin();
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
                        listaBoletin();
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
} );


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

function cargarDataUsuario(idUsuario){
       $("#VerForm").show();
       $("#btnNuevo").hide();
       $("#VerListado").hide();

       $("#txtIdUsuario").val(idUsuario);
       $("#cboSucursal").val(idSucursal);
       $("#txtIdEmpleado").val(idempleado);
       $("#txtEmpleado").val(empleado);
       $("#cboTipoUsuario").val(tipo_usuario);
       $("#cboGrupo").val(num_grupo);

        $.ajax({
            url: "./ajax/EmpleadoAjax.php?op=SaveOrUpdate",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
                swal("Mensaje del Sistema", datos, "success");
                ListadoEmpleado();
                OcultarForm();
                Limpiar();
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
            if(val == 0){				
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario INACTIVO',
                    showConfirmButton: false,
                    timer: 1500
                })
				$('a#'+id).parent('td').html('<a href="#" id="'+id+'" onclick="status('+id+', 1)"><span class="badge bg-danger"><i class="fas fa-times-circle"></i></span></a>')
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario ACTIVO',
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
