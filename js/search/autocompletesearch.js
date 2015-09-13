/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#country_name').autocomplete({
    source: function( request, response ) {
	$.ajax({
            url : 'php/search/searchcomuni.php',
            dataType: "json",
            data: {
		name_startsWith: request.term,
		type: 'country'
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.DESCR_COMUNE,
			value: "cod_com=" + item.COD_COMUNE + "&&cod_prov=" + item.COD_PROVINCIA,
                    }
		}));
            }
	});
    },
    select: function( event, ui ) {
        event.preventDefault();
        $("#country_name").val(ui.item.label);
    },
    autoFocus: true,
    minLength: 0,
    change: function (event, ui)
    {
        window.location.href = "index.php?content=com&&" + ui.item.value;
        //console.log(event);
        //console.log(ui);
    }
});