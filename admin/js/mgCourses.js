// function idna1(obj)
// {
//   alert($(obj).closest('tr').index());
// }
// function idna(obj){
//   alert($(obj).closest('tr').index());
// }
//addABatch
function idna(el){
  var rownumber = $(el).closest('tr').index();
  addABatch(document.getElementById("myTable").rows[rownumber+1].cells[0].textContent);
}

function sendCourseNameToDeleteACourse(obj){
  var rownumber = $(obj).closest('tr').index();
  deleteACourse(document.getElementById("myTable").rows[rownumber+1].cells[0].textContent);
}

$(function(){
  $('#icad,#ibatchStartingDate').fdatepicker({
    format: 'yyyy-mm-dd',
    disableDblClickSelection: true,
    language: 'vi',
  });
});

$(document).ready(function() {
  var searchHash = location.hash.substr(1),
  searchString = searchHash.substr(searchHash.indexOf('search='))
    .split('&')[0]
    .split('=')[1];
  $('#myTable').dataTable( {
    mark: {
      element: 'span',
      className: 'highlight'
    },
    "oSearch": { "sSearch": searchString }
  });

  $('#idayInAWeek').keyup(function(){
    dayInAWeek = $(this).val();
    if(dayInAWeek == 1){

      $('#limitDayExitWarning').hide();
      $('#limitDayExitWarning').html("");
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").show();
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").css('display','inline');

    }else if(dayInAWeek == 2){

      $('#limitDayExitWarning').hide();
      $('#limitDayExitWarning').html("");
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").show();
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").css('display','inline');

    }else if(dayInAWeek == ""){

      $('#limitDayExitWarning').hide();
      $('#limitDayExitWarning').html("");
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").hide();
      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").hide();
          
    }else{

      $('#limitDayExitWarning').show();
      $('#limitDayExitWarning').html('Not applicable more than Two');

    }
  });

  for(var i = 10; i <= 20; i+=.30){
    var ij=i.toFixed(2);
    var jk=(i % 1).toFixed(1);
    if(jk == .6){

      ij=+ij + .40;
      i=+i + .40;

    }
    if(i >= 12){

      if(i >= 13){

        ij= (+ij - 12).toFixed(2);
      }

      val=ij+' PM';
      tex=ij+' PM';

    }else{
            val=ij+' AM';
            tex=ij+' AM';
    }
    $('#iday1StartTime').append($('<option>', {
      value: val,
      text: tex
    }));
  }
  $('#iday1StartTime').change(function(){

    var originialValueOfDay1StartTime=$(this).val().split(' ')[0];
    $('#iday1EndTime option').remove();
    $('#iday1EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");
    //alert(originialValueOfDay1StartTime);

    for(var i = +originialValueOfDay1StartTime + .30; i <= 20; i += .30){
      var modifyedi=i.toFixed(2);
      var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

      if(afterDotOfi == 6){

          modifyedi = +modifyedi + .40; 
          i = +i + .40;

        }if(+modifyedi >= 13){

          modifyedi = (+modifyedi - 12).toFixed(2);

        }if(+originialValueOfDay1StartTime <= 8 && +originialValueOfDay1StartTime >= 1){

          if(+modifyedi == 8.30){
            break;
          }

        }if(+modifyedi <= 8 && +modifyedi >= 1){

              modifyedi = modifyedi + ' PM';

        }else if(+modifyedi >= 10 && +modifyedi <= 11.30){

          modifyedi = modifyedi + ' AM';

        }else{

          modifyedi = modifyedi + ' PM';

        }
      $('#iday1EndTime').append("<option>"+modifyedi+"</option>");
    }
  });

  for(var i = 10; i <= 20; i += .30){

    var ij=i.toFixed(2);
    var jk=(i % 1).toFixed(1);
    if(jk == .6){

      ij=+ij + .40;
      i=+i + .40;

    }
    if(i >= 12){

      if(i >= 13){

        ij= (+ij - 12).toFixed(2);

      }

      val=ij+' PM';
      tex=ij+' PM';

    }else{

      val=ij+' AM';
      tex=ij+' AM';

    }
    $('#iday2StartTime').append($('<option>', {
      value: val,
      text: tex
    }));
  }
  $('#iday2StartTime').change(function(){

    var originialValueOfDay2StartTime=$(this).val().split(' ')[0];
    $('#iday2EndTime option').remove();
    $('#iday2EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");

    for(var i = +originialValueOfDay2StartTime + .30; i <= 20; i += .30){

      var modifyedi=i.toFixed(2);
      var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

      if(afterDotOfi == 6){

        modifyedi = +modifyedi + .40; 
        i = +i + .40;

      }if(+modifyedi >= 13){

        modifyedi = (+modifyedi - 12).toFixed(2);

      }if(+originialValueOfDay2StartTime <= 8 && +originialValueOfDay2StartTime >= 1){

        if(+modifyedi == 8.30){
          break;
        }
      }if(+modifyedi <= 8 && +modifyedi >= 1){

        modifyedi = modifyedi + ' PM';

      }else if(+modifyedi >= 10 && +modifyedi <= 11.30){

        modifyedi = modifyedi + ' AM';

      }else{

        modifyedi = modifyedi + ' PM';
      }
      $('#iday2EndTime').append("<option>"+modifyedi+"</option>");
    }          
  });
});