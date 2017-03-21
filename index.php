<!DOCTYPE html>
<html>
<title>TSMS-training school management system</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" type="text/css" href="css/foundation-datepicker.css">  
<script src="js/foundation-datepicker.js" type="text/javascript"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link type="text" href="http://foundation-datepicker.peterbeno.com/example.html">
<script src="js/moment.js" type="text/javascript"></script>
<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}
.bgimg {
    background-position: center;
    background-size: cover;
    background-image: url("pic/a.jpg");
    min-height: 80%;
}
.menu {
    display: none;
}
</style>
<body>

<!-- mySlides w3-animate-fading -->

<div class="" style="margin-top:50px">
  <img class="mySlides w3-animate-fading" src="pic/a.jpg" style="width:1400px;height: 550px">
  <img class="mySlides w3-animate-fading" src="pic/e.png" style="width:1400px;height: 550px">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 9000);    
}

$(document).ready(function(){
    $("#juser, #jpass").keypress(function(e){
      if(e.keyCode==13)
      $('#jsubmit').click();
    });
});

$(document).ready(function(){
  $("#iulevel,#iuname,#iufname,#iulname,#icname,#icity,#ipnumber,#iemail,#izcode,#inat,#isex,#irel,#ibgr,#idpt,#ipass,#icpass").keypress(function(e){
    if(e.keyCode==13)
    {
      $('#isubmitsignup').click();
    }
  });
});

$(document).ready(function(){

   $('a[href="#login"]').click(function(){
        $("#login").show();
        // window.history.pushState("", "", "");
        //cd=window.location.href.split('#');
        //alert(cd[0]);
        //alert(window.location.href);
        // window.history.pushState(null, "", location.href.split("/")[0]);
    });

$(function(){
    if (window.location.hash == "#login") {
        $("#login").show();
    }
});

   $('a[href="#signup"]').click(function(){
        $("#signup").show();
        });

$(function(){
    if (window.location.hash == "#signup") {
        $("#signup").show();
    }
});

});

</script>

  <!-- the writting upon the image -->
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white" style="font-size:90px;margin-top: 30px;">the<br>School of Training</span>
  </div>
<!-- end of the writting upon the image -->

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-teal">
    <div class="w3-col s3">
      <a href="#" class="w3-btn-block w3-teal w3-hover-white">HOME</a>
    </div>
    <div class="w3-col s3">
      <a href="#login" class="w3-btn-block w3-teal w3-hover-white">LOG IN</a>
    </div>
    <div class="w3-col s3">
      <a href="#signup" class="w3-btn-block w3-teal w3-hover-white">SIGN UP</a>
    </div>
    <div class="w3-col s3">
      <a href="#where" class="w3-btn-block w3-teal w3-hover-white">WHERE</a>
    </div>
  </div>
</div>

<!-- end of Links (sit on top) -->

<!-- login design div -->

<div id="login" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('login').style.display='none';var c=window.location.href.split('#');window.history.pushState('', '', c[0]);" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
          <img src="pic/avatar.jpg" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form name="login_tsms" class="w3-container" method="post" enctype="multipart/form-data">
        <div class="w3-section">
            
          <!-- <label><b>Username</b></label> -->
          <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Enter Username or userid" name="user" id="juser" required>
          <!-- <label><b>Password</b></label> -->
          </p>
          <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Enter Password" name="pass"  id="jpass" required autocomplete="off">
          <button class="w3-btn-block w3-green w3-section w3-padding" id="jsubmit" name="submit" onclick="checkvalidation()" value="Login" type="button">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" > Remember me
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('login').style.display='none';var c=window.location.href.split('#');window.history.pushState('','',c[0])" type="button" class="w3-btn w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>
    </div>
  </div>

<script type="text/javascript">
function checkvalidation()
{
        username=document.login_tsms.user.value;
        password=document.login_tsms.pass.value;
        if(username=="" || password=="")
        {
          messagebox('w3-panel w3-red','Error!','You cant place username and password field empty!');
        }
        else if(username == password)
        {
          messagebox('w3-panel w3-red','Error!','OPPS! Username and password cant be same.');
        }
        else
        {
            str="select * from users where '"+username+"' IN (id,username) and password ='"+password+"';";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
              resp=JSON.parse(xmlhttp.responseText);
              check(resp,username,password);

            }
          };
              var url="jsondb.php?q=read&sql="+str;
              xmlhttp.open("GET", url, true);
              xmlhttp.send(); 
        }
}
  </script>

<!-- SIGN Up design div -->

<div id="signup" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
<!-- pic/avatar.jpg -->
      <div class="w3-center"><br>
        <span onclick="document.getElementById('signup').style.display='none';var c=window.location.href.split('#');window.history.pushState('','',c[0])" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>     
        <br>
      </div>
        

      <form id="xxxx" name="signup_tsms" class="w3-container" action="sign_up_validation.php" autocomplete="off" method="post" enctype="multipart/form-data">
        <div class="w3-section">
          <img id="blah" src="pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:30%;" class="w3-circle w3-margin-top"><br>
          <label><b>UPLOAD PIC</b></label>
          <label class="w3-btn-block w3-green w3-section w3-padding">
            <input type="file" onchange="readURL(this)" id="iprofilepic" name="file_img" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">
            Choose a Pic*
          </label><br>
	        <select required class="w3-input w3-border w3-animate-input" placeholder="User level*" id="iulevel" name="ulevel" autofocus="off">
	          <option disabled selected="selected">User Level*</option>
	          <option value="student">Student</option>
	        </select></p>
	        <input class="w3-input w3-border w3-animate-input" type="text" id="iuname" onblur="CheckUserName()" placeholder="User name*" name="uname" required autocomplete="off"></p>	          
	        <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="iufname" name="ufname" required autocomplete="off"></p>	          
	        <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="iulname" name="ulname" required autocomplete="off"></p>	                    
	        <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="icname" name="cname"></p>           
	        <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="icity" name="city" required autocomplete="off"></p>          
	        <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa()" placeholder="Phone number*" id="ipnumber" name="pnumber" required autocomplete="off">
	        <label id="ipn" style="display: none;color: red;"></label></p>          
	        <input class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg()" placeholder="Email address*" id="iemail" name="email" required autocomplete="off">
	        <label id="iem" style="display: none;color: red;"></label></p> 	                   
	        <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu()" placeholder="Zip code" id="izcode" name="zcode">
	        <label id="izc" style="display: none;color: red;"></label></p>           
	        <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="inat" name="nat"></p>          
	        <select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="isex" name="sex" autofocus="off">
	          <option disabled selected="selected"><span style="">Sex*</span></option>
	          <option value="male">Male</option>
	          <option value="female">Female</option>
	          <option value="other">Other</option>
	        </select></p>          
	        <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="irel" name="rel"></p>          
	        <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="ibgr" name="bgr"></p>
	        <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="dpt" id="idpt">
	        <script>
	                    $(function(){
	                      $('#idpt').fdatepicker({
	                      format: 'yyyy-mm-dd',
	                      disableDblClickSelection: true,
	                      language: 'vi',
	                      });
	                    });
	        </script><br></p>          
	        <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Enter Password*" id="ipass" name="pass" required autocomplete="off"></p>          
	        <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Confirm Password*" onkeyup="check_confirm_pass()" id="icpass" name="cpass" required autocomplete="off">
	        <label id="incp" style="display: none;color: red;"></label>
	        <button class="w3-btn-block w3-green w3-section w3-padding"  onclick="mama()" id="isubmitsignup" name="submitsignup" value="Sign up" type="button">Sign Up</button>
        </div>
      </form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('signup').style.display='none';var c=window.location.href.split('#');window.history.pushState('','',c[0]);" type="button" class="w3-btn w3-red">Cancel</button>
      </div>
    </div>
  </div>
  <!-- End Of SIGN Up design div -->

<!-- Header with image -->
<header class=" w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-xlarge w3-hide-small">
    <span class="w3-tag">Open from 10am to 8pm</span>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-xlarge">
    <span class="w3-text-white w3-tag">House 83/B, Road 4, Kemal Ataturk Avenue Banani,Dhaka 1213</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-large">

<!-- About Container -->
<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide w3-padding-left w3-padding-right">ABOUT THIS SCHOOL</span></h5>
    <p>The School was founded in banani by Mr. Smith.This Training Schools is a guide to IT certifications, degrees and computer training courses. From novices to tech professionals wishing to improve their skill set, those interested in developing as IT professionals can explore certifications, career information and other opportunities here.</p>
    <p>In addition to our upcomming courses, we serve a lot of courses in different categories with our best faculties, as well as out best class room with lots of additional faciliy.</p>

    <img src="pic/c.jpg" style="width:100%;max-width:1000px" class="w3-margin-top">
    <p><strong>Opening hours:</strong> everyday from 10am to 8pm.</p>
    <p><strong>Address:House 83/B, Road 4, Kemal Ataturk Avenue Banani,Dhaka 1213.</strong> </p>
  </div>
</div>

<!-- add training vendors list -->

<div style="padding-left:10%;padding-right: 10%; height: 80%;width: 100%" class="w3-center w3-theme">

<div class="w3-container w3-padding-32 ">
  <h1>Courses Starting Soon</h1>
</div>

<div class=" w3-center w3-row-padding w3-theme-d4">

<div onclick="getcoursename()" style="margin-right: 36px;width: 30%;cursor: pointer;" class="w3-third w3-section">
<div class="w3-card-4">
<img src="pic/ccna-security.png" style=" height: 200px;width: 100%">
<div style="position: relative;" class="w3-container w3-teal">
<h4 name="haed1" id="ihead1" style="color: black;">CCNA-SECURITY</h4>
<p style="height: 200px;overflow: auto;">Achieving Cisco CCNA Security certification confirms that you have the associate-level knowledge and skills required to secure Cisco networks. It validates that you have the skills to develop a security infrastructure, recognize threats and vulnerabilities to networks, and mitigate security threats. The CCNA Security curriculum emphasizes core security technologies, including installing, troubleshooting and monitoring network devices to maintain data and device integrity, confidentiality, and availability, along with competency in the technologies Cisco uses in its security structure.</p>
</div>
</div>
</div>

<div onclick="getcoursename1()" style="margin-right: 36px;width: 30%;cursor: pointer;" class="w3-third w3-section">
<div class="w3-card-4">
<img src="pic/ccna-voice.png" style=" height: 200px;width: 100%">
<div style="position: relative;" class="w3-container w3-green">
<h4 id="ihead2" style="color: black">CCNA-VOICE</h4>
<p style="height: 200px;overflow: auto;">The Cisco Certified Network Associate Voice (CCNA Voice) validates associate-level knowledge and skills required to administer a voice network. The Cisco CCNA Voice certification confirms that the required skill set for specialized job roles in voice technologies such as voice technologies administrator, voice engineer, and voice manager. It validates skills in VoIP technologies such as IP PBX, IP telephony, handset, call control, and voicemail solutions.</p>
</div>
</div>
</div>

<div onclick="getcoursename2()" style="margin-right: 34px;width: 30%;cursor: pointer;" class="w3-third w3-section">
<div class="w3-card-4">
<img src="pic/ccna-wireless.png" style=" height: 200px;width: 100%">
<div style="position: relative;" class="w3-container w3-red">
<h4 id="ihead3" style="color: black;">CCNA-WIRELESS</h4>
<p style="height: 200px;overflow: auto;">Cisco Wireless technology growth places increased demands on networks and the professionals that support them. Ensuring this technology is optimally configured, monitored, and supported is paramount to achieving business outcomes and requires a workforce of skilled wireless professionals. Earn the CCNA Wireless certification and amplify your basic Cisco Wireless LAN's configuration, monitoring, troubleshooting and support skills for optimal performance of Cisco Wireless networks.</p>
</div>
</div>
<br><br><br>
</div>
</div>

</div>


<!-- Contact/Area Container -->
<div class="w3-container" id="where" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide w3-padding-left w3-padding-right">WHERE TO FIND US</span></h5>
    <p>Find us at some address at some place.</p>
    <div id="googleMap" class="w3-sepia" style="width:100%;height:400px;"></div>
</div>
</div>

<!-- contact section -->

  <div id="contactus" class="w3-container w3-padding-large w3-grey">
    <h4 id="contact"><b>Contact Us</b></h4>
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div style="padding-bottom: 27px;" class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p>tsms@gmail.com</p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p>House 83/B, Road 4, Kemal Ataturk Avenue Banani,Dhaka 1213</p>
      </div>
      <div  style="padding-bottom: 27px;" class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p>01830954149</p>
      </div>
    </div>
  </div>

<!-- messages section -->
<div id="id04" class="w3-modal">
  <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
    <div id="panel" class="w3-panel w3-red">
      <span onclick="document.getElementById('id04').style.display='none'" class="w3-closebtn">&times;</span>
      <h3 id="panelheaing">Danger!</h3>
      <p id="panelbody">Red often indicates a dangerous or negative situation.</p>
    </div>
  </div>
</div>

<script type="text/javascript">
function messagebox(classname,heading,body)
{
  document.getElementById("id04").style.display="block";
  document.getElementById("panel").className=classname;
  document.getElementById("panelheaing").innerHTML=heading;
  document.getElementById("panelbody").innerHTML=body;
}
</script>
<!-- end of messaging section -->

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-teal w3-padding-48 w3-large">
  <p>Powered by <a title="W3.CSS" class="w3-hover-text-green">SP2 PROJECT</a></p>
</footer>

<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCjercfIOR7SfSBZJpRkmhOB-yqJAMZgc&libraries=geometry"></script>

<script>
// Google Map Location

function getcoursename()
{
	alert($('#ihead1').html());
}
function getcoursename1()
{
	alert($('#ihead2').html());
}
function getcoursename2()
{
	alert($('#ihead3').html());
}
var myCenter = new google.maps.LatLng(23.794403, 90.406007);

function initialize() {
var mapProp = {
  center: myCenter,
  zoom: 12,
  scrollwheel: false,
  draggable: false,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
  position: myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-dark-grey";
}
document.getElementById("myLink").click();

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function validateZipeCode(code) {
    var re =/^\d+$/;
    return re.test(code);
}

var nayan;

function validatePhoneNumber(number) {
    var re =/^(?:\+88|01)?(?:\d{11}|\d{13})$/;
    return re.test(number);
}

function gg()
{
  if(validateEmail(document.signup_tsms.email.value)==false)
  {
      document.getElementById("iem").style.display="block";
      document.getElementById("iem").innerHTML="Invalid email address!";
  }
  else
  {
    document.getElementById("iem").innerHTML="";
    document.getElementById("iem").style.display="none";
  }
}
function aa()
{
  if(validatePhoneNumber(document.signup_tsms.pnumber.value)==false)
  {
    document.getElementById("ipn").style.display="block";
    document.getElementById("ipn").innerHTML="Invalid Phone number!"; 
  }
  else
  {
    document.getElementById("ipn").innerHTML=""; 
    document.getElementById("ipn").style.display="none"; 
  }
}
function uu()
{
  if(validateZipeCode(document.signup_tsms.zcode.value)==false)
  {
      document.getElementById("izc").style.display="block";
      document.getElementById("izc").innerHTML="Invalid Zipe code!"; 
  }
  else
  {
    document.getElementById("izc").innerHTML="";
    document.getElementById("izc").style.display="none"; 
  }
}
function check_confirm_pass()
{
  a=document.getElementById("ipass").value;
  b=document.getElementById("icpass").value;
  if(a!=b)
  {
    document.getElementById("incp").style.display="block";
    document.getElementById("incp").innerHTML="Password and Confirm Password is not match!"; 
  }
  else
  {
    document.getElementById("incp").innerHTML="";
    document.getElementById("incp").style.display="none"; 
  }
}
function mama()
{
   a=document.signup_tsms.ulevel.value;
   b=document.signup_tsms.uname.value;
   c=document.signup_tsms.ufname.value;
   d=document.signup_tsms.ulname.value;
   e=document.signup_tsms.cname.value;
   f=document.signup_tsms.city.value;
   g=document.signup_tsms.pnumber.value;
   h=document.signup_tsms.email.value;
   i=document.signup_tsms.pass.value;
   j=document.signup_tsms.cpass.value;
   k=document.signup_tsms.zcode.value;
   l=document.signup_tsms.nat.value;
   p=document.signup_tsms.sex.value;
   q=document.signup_tsms.rel.value;
   r=document.signup_tsms.bgr.value;
   s=document.signup_tsms.dpt.value;

   m=document.getElementById("ipn").innerHTML;
   n=document.getElementById("izc").innerHTML;
   o=document.getElementById("iem").innerHTML;
   rlm=document.getElementById("incp").innerHTML;

   var today = moment().format('YYYY-MM-D');

  if(a=="" || b=="" || c=="" || d=="" || f=="" || g=="" || h==""  || i=="" || j=="" || l=="" || p=="" || q=="" || r=="" || s=="" || document.getElementById('iprofilepic').files.length == 0)
    {
      messagebox('w3-panel w3-red','Error!','The field that contain * sign. cant left empty.');
    }
  else if(m== "Invalid Phone number!" || n== "Invalid Zipe code!" || o== "Invalid email address!" || rlm=="Password and Confirm Password is not match!")
    {
      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');
    }
  else if(document.getElementById('iprofilepic').files.length == 0)
    {
      messagebox('w3-panel w3-red','Error!','You cant left profile pic empty.');
    }
  else
    {

      str="INSERT into users (level,username,first_name,last_name,company_name,city,phone_number,email,zip_code,nationality,sex,religion,blood_group,dob,password,user_activation_date) VALUES ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"','"+f+"','"+g+"','"+h+"','"+k+"','"+l+"','"+p+"','"+q+"','"+r+"','"+s+"','"+i+"','"+today+"')";

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          resp=xmlhttp.responseText;
          if(resp == "true")
          {
             //window.location.href='validation.php?ulevel='+a+'&uname='+b+'';
             $('#xxxx').submit();
          }
          else
          {
             messagebox('w3-panel w3-red','Error!','Something went wrong! try again after some time.');
          }
        }
      };
      var url="jsondb.php?q=write&sql="+str;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
    }
}

function CheckUserName()
{
        username=document.signup_tsms.uname.value;
        str="select username from users;";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            resp=JSON.parse(xmlhttp.responseText);
            for(i = 0; i < resp.length; i++)
            {
              if(resp[i].username==username)
              {
                messagebox('w3-panel w3-red','Error!','User name already available!choose another one.');
                document.getElementById("iuname").value = "";
              }
            }
        }
  };
    var url="jsondb.php?q=read&sql="+str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(); 
}
function check(userstable,un,ps)
{
  len=userstable.length;
  if(len==0)
  {
    messagebox('w3-panel w3-red','Error!','Invalid username or userid or password!Try again.');
    document.getElementById("jpass").value="";
  }
  for(i=0;i<len;i++) 
  {
    if((userstable[i].id == un || userstable[i].username == un) && (userstable[i].password == ps))
    {
        le=userstable[i].level;
        window.location.href="validation.php?uname="+un+"&ulevel="+le+"";
    }
  } 
}
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                        $('#blah')
                        .attr('src', e.target.result)
                        .width(250)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

</body>
</html>
