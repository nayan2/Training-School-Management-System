<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-amber.css">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type='text/javascript' src='js/search.js'></script>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
<link rel="stylesheet" href="../css/style.css">
<script type='text/javascript' src='js/modernizr.js'></script>
<script type='text/javascript' src='js/dynamicpage.js'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
<link rel="stylesheet" type="text/css" href="../css/foundation-datepicker.css">
<script src="../js/foundation-datepicker.js" type="text/javascript"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link type="text" href="http://foundation-datepicker.peterbeno.com/example.html">
<script src="../js/moment.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)'></script>
<script type='text/javascript' src='https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js'></script>

<script>
$(function(){
  $('#text-search').bind('keyup change', function(ev) {
    // pull in the new value
    var searchTerm = $(this).val();
    // remove any old highlighted terms
    $('body').removeHighlight();
    // disable highlighting if empty
    if(searchTerm){
      // highlight the new term
       $('body').highlight( searchTerm );
    }
  });
});

jQuery.fn.highlight = function(pat){
  function innerHighlight(node, pat){ 
    var skip = 0;
    if(node.nodeType == 3){
      var pos = node.data.toUpperCase().indexOf(pat);
      if(pos >= 0){
        var spannode = document.createElement('span');
        spannode.className = 'highlight';
        var middlebit = node.splitText(pos);
        var endbit = middlebit.splitText(pat.length);
        var middleclone = middlebit.cloneNode(true);
        spannode.appendChild(middleclone);
        middlebit.parentNode.replaceChild(spannode, middlebit);
        skip = 1;
      }
    }else if(node.nodeType == 1 && node.childNodes && !/(script|style) /i.test(node.tagName)){
      for(var i = 0; i < node.childNodes.length; ++i){
        i += innerHighlight(node.childNodes[i], pat);
      }
    }
    return skip;
  }
  return this.each(function(){
    innerHighlight(this, pat.toUpperCase());
  });
};

jQuery.fn.removeHighlight = function(){
  function newNormalize(node){
    for(var i = 0, children = node.childNodes, nodeCount = children.length; i < nodeCount; i++){
      var child = children[i];
      if(child.nodeType == 1){
        newNormalize(child);
          continue;
      }
      if (child.nodeType != 3) { continue; }
        var next = child.nextSibling;
        if(next == null || next.nodeType != 3) { continue; }
          var combined_text = child.nodeValue + next.nodeValue;
          new_node = node.ownerDocument.createTextNode(combined_text);
          node.insertBefore(new_node, child);
          node.removeChild(child);
          node.removeChild(next);
          i--;
          nodeCount--;
        }
    }
    return this.find("span.highlight").each(function(){
      var thisParent = this.parentNode;
      thisParent.replaceChild(this.firstChild, this);
      newNormalize(thisParent);
    }).end();
};
</script>

<!-- top navigation bar -->
<div style="position: fixed; width: 100%; z-index: 99999;" class="w3-container w3-teal">
    <ul class="w3-navbar w3-container">
        <li class="w3-right" ><a href="destroy.php">Log Out</a></li>
        <li class="w3-right w3-dropdown-hover w3-hover-orange">
          <a class="w3-hover-orange" >Options<i class="fa fa-caret-down"></i></a>
          <div class="w3-dropdown-content w3-white w3-card-4">
            <a href="changepassword.php">change password</a>
          </div>
        </li>
        <li class="w3-right" ><a href="userprofile.php">User Profile</a></li>
        <li class="w3-right" ><a href="index.php">Home</a></li>
        <li class="w3-right" ><button class="w3-btn w3-black" id="sgo">Go</button></li>
        <li class="w3-right" ><input type="text" class="w3-input" id="text-search" placeholder="Search.."></li>
    </ul>
</div>
<!-- end of top navigation bar -->