function getAdminUsername(obj){
	var rowNumber=$(obj).closest('tr').index();
	deleteAAdmin(document.getElementById('iadminDetailsTable').rows[rowNumber+1].cells[1].textContent);
}

$(document).ready(function() {
    var searchHash = location.hash.substr(1),
    searchString = searchHash.substr(searchHash.indexOf('search='))
        .split('&')[0]
        .split('=')[1];
    $('#iadminDetailsTable').dataTable( {
        mark: 
        {
            element: 'span',
            className: 'highlight'
        },
        "oSearch": { "sSearch": searchString },
        "scrollX": true
    });
});

$(function(){
    $('#iadpt , #ieadpt').fdatepicker({
        format: 'yyyy-mm-dd',
    	disableDblClickSelection: true,
        language: 'vi',
    });
});