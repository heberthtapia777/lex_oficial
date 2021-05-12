$.validator.setDefaults( {
    submitHandler: function (form, e) {
       	//alert( "submitted!" );
		e.preventDefault();
		var dato = JSON.stringify($('#formNum').serializeObject());

		$('.verFilter').removeClass("verFilter");

		$tabla = $("#tblBoletin").dataTable(
		{
			"aProcessing": true,
			"aServerSide": true,
			"language": {
                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json'
            },
			"filter": false,
        	"aoColumns":[
        	     	{   "mDataProp": "0"},
                    {   "mDataProp": "1"},
                    {   "mDataProp": "2"},
                    {   "mDataProp": "3"},
                    {   "mDataProp": "4"},
                    {   "mDataProp": "5"},
                    {   "mDataProp": "6"},
                    {   "mDataProp": "7"}

        	],"ajax":
	        	{
	        		url: 'ajax/conBusqueda.php?op=listBusquedaNum',
					type : "POST",
					async: false,
					dataType : "json",
					data: {res: dato},
					error: function(data){
				   		console.log(data.responseText);
					}
	        	},
	        "bDestroy": true

    	}).DataTable();

    }
} );

function generaSelect( id ){
	//alert(id);
	$.ajax({
		type: "post",
		url: "ajax/generaSelect.php",
		data: {id: id},
		success: function (response) {
			//console.log(response);
			$('#area').html(response);
		}
	});
}

