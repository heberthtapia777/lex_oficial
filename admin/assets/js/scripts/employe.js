$( document ).ready(function() {
    init();
  });

function init(){

	$('#tblEmpleado').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

	ListadoEmpleado();// Ni bien carga la pagina que cargue el metodo
	//ComboEmpleado();
	//ComboTipo_Documento();
	//$("#VerForm").hide();// Ocultamos el formulario
	//$("#txtClaveOtro").hide();
	//$("form#frmEmpleado").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos

	//$("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm

	function SaveOrUpdate(e){
		e.preventDefault();

        var formData = new FormData($("#frmEmpleado")[0]);

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
	};

	function Limpiar(){
		// Limpiamos las cajas de texto
		$("#txtIdEmpleado").val("");
	    $("#txtNombre").val("");
	    $("#txtApellidos").val("");
	    $("#txtNum_Documento").val("");
	    $("#txtDireccion").val("");
	    $("#txtTelefono").val("");
	    $("#txtEmail").val("");
	    $("#txtRepresentante").val("");
	    $("#txtLogin").val("");
	    $("#txtClave").val("");
	    $("#txtClaveOtro").val("");
	}

	function VerForm(){
		$("#VerForm").show();// Mostramos el formulario
		$("#btnNuevo").hide();
		$("#VerListado").hide();// ocultamos el listado
		initMap();
	}

	function OcultarForm(){
		$("#VerForm").hide();// Mostramos el formulario
		$("#btnNuevo").show();// ocultamos el boton nuevo
		$("#VerListado").show();
	}
}

function ListadoEmpleado(){
	var tabla = $('#tblEmpleado').dataTable(
		{   "aProcessing": true,
			   "aServerSide": true,
			   "scrollX": true,
   			dom: 'Bfrtip',
	        buttons: [
	            'copyHtml5',
	            'excelHtml5',
	            'csvHtml5',
	            'pdfHtml5'
	        ],
        	"aoColumns":[
        	     	{   "mDataProp": "0"},
                    {   "mDataProp": "1"},
                    {   "mDataProp": "2"},
                    {   "mDataProp": "3"},
                    {   "mDataProp": "4"},
                    {   "mDataProp": "5"},
                    {   "mDataProp": "6"},
                    {   "mDataProp": "7"},
                    {   "mDataProp": "8"}

        	],"ajax":
	        	{
	        		url: '../../ajax/employeAjax.php?op=list',
					type : "get",
					dataType : "json",
					error: function(e){
				   		console.log(e.responseText);
					}
	        	},
	        "bDestroy": true

    	}).DataTable();
    };

function eliminarEmpleado(id){// funcion que llamamos del archivo ajax/CategoriaAjax.php?op=delete linea 53
	bootbox.confirm("??Esta Seguro de eliminar el Empleado?", function(result){ // confirmamos con una pregunta si queremos eliminar
		if(result){// si el result es true
			$.post("./ajax/EmpleadoAjax.php?op=delete", {id : id}, function(e){// llamamos la url de eliminar por post. y mandamos por parametro el id
                swal("Mensaje del Sistema", e, "success");
				ListadoEmpleado();

            });
		}

	})
}

function cargarDataEmpleado(id,apellidos, nombre,tipo_documento,num_documento,direccion,coorX,coorY,telefono,email,fecha_nacimiento,foto, login, clave,estado){// funcion que llamamos del archivo ajax/CategoriaAjax.php linea 52

		$("#VerForm").show();// mostramos el formulario
		$("#btnNuevo").hide();
		$("#VerListado").hide();// ocultamos el listado
		$("#txtIdEmpleado").val(id);// recibimos la variable id a la caja de texto txtIdCategoria
	    $("#txtApellidos").val(apellidos);
	    $("#txtNombre").val(nombre);
 		$("#cboTipo_Documento").val(tipo_documento);
 		$("#txtNum_Documento").val(num_documento);
 		$("#txtDireccion").val(direccion);
 		$("#cx").val(coorX);
 		$("#cy").val(coorY);
 		$("#txtTelefono").val(telefono);
 		$("#txtEmail").val(email);
 		$("#txtFecha_Nacimiento").val(fecha_nacimiento);
 		//$("#txtLogo").val(logo);
 		$("#txtRutaImgEmp").val(foto);
 		$("#txtLogin").val(login);
 		//$("#txtClave").val(clave);
	    $("#txtRutaImgEmp").show();
 		$("#txtEstado").val(estado);
 		$("#txtClaveOtro").val(clave);
 		//$("#txtClaveOtro").show();
 		initMap();
 		listaMap(coorX,coorY);

 		$(".alert").hide();
 	}


 	function ComboTipo_Documento() {

        $.get("./ajax/EmpleadoAjax.php?op=listTipo_DocumentoPersona", function(r) {
                $("#cboTipo_Documento").html(r);

        })
    }

    function ComboEmpleado(){
			$.post("./ajax/EmpleadoAjax.php?op=listEmpleado", function(r){
	            $("#cboEmpleado").html(r);
	        });
	}
