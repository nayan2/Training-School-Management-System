function idna(el){
  var rowNumber=$(el).closest('tr').index();
  var batchCode=document.getElementById('myTable').rows[rowNumber+1].cells[0].textContent;
  addDetailsToEditABatch(batchCode);
}

$(document).ready(function() {
  var searchHash = location.hash.substr(1).replace("%20"," "),
  searchString = searchHash.substr(searchHash.indexOf('search='))
    .split('&')[0]
    .split('=')[1];
  $('#myTable,#studentDetails').dataTable( {
    mark: {
      element: 'span',
      className: 'highlight'
    },
    "oSearch": { "sSearch": searchString },
    "scrollX": true
  });
}); 

function sendBatchCodeToDelete(obj){
  var rowNumber=$(obj).closest('tr').index();
  deleteABatch(document.getElementById('myTable').rows[rowNumber+1].cells[0].textContent);
}


