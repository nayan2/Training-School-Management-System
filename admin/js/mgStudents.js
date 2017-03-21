function idna(el){
    var rownumber = $(el).closest('tr').index();
    deleteAStudent(document.getElementById("example").rows[rownumber+1].cells[2].textContent);
}

$(document).ready(function() {
    var searchHash = location.hash.substr(1).replace("%20"," "),
    searchString = searchHash.substr(searchHash.indexOf('search='))
        .split('&')[0]
        .split('=')[1];
    $('#example').dataTable({
        mark: { element: 'span', className: 'highlight' },
        "oSearch": { "sSearch": searchString },
        "scrollX": true
    });
});

$(function(){
    $('#isdpt , #idpt').fdatepicker({
        format: 'yyyy-mm-dd',
        disableDblClickSelection: true,
        language: 'vi',
    });
});