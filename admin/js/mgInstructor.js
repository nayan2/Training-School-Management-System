      $(function(){
        $('#ieidpt , #iefdeactivationdate , #iidpt').fdatepicker({
          format: 'yyyy-mm-dd',
          disableDblClickSelection: true,
          language: 'vi',
        });
      });

                      function deleteAFaculty(obj){
                  var rownumber=$(obj).closest('tr').index();
                  triggerdeleteAFaculty(document.getElementById('ifacultyDetailsTable').rows[rownumber+1].cells[0].textContent,document.getElementById('ifacultyDetailsTable').rows[rownumber+1].cells[1].textContent);
                }
                $(document).ready(function() {
                  var searchHash = location.hash.substr(1).replace("%20"," "),
                  searchString = searchHash.substr(searchHash.indexOf('search='))
                          .split('&')[0]
                          .split('=')[1];
                    $('#ifacultyDetailsTable').dataTable( {
                      mark: {
                        element: 'span',
                        className: 'highlight'
                      },
                      "oSearch": { "sSearch": searchString },
                      "scrollX": true
                    });
                });
                function facultyId(obj){
                  var rowNumber = $(obj).closest('tr').index();
                  editFacultyDetails(document.getElementById('ifacultyDetailsTable').rows[rowNumber+1].cells[0].textContent);
                }