function checkx() {
    a = document.changespass.npass.value;
    b = document.changespass.cpass.value;
    c = document.changespass.currpass.value;
    if (a == "" || b == "" || c == "") {
        messagebox('w3-panel w3-yellow', 'Warning!', 'You cant left any of the field empty.');
    } else if (a != b) {
        messagebox('w3-panel w3-red', 'Error!', 'New Password and confirm password is not match.');
    } else {
        var f = confirm('Are you sure to change your current password?');
        if (f == true) {
            username = document.getElementById("username").innerHTML;
            str = "select password from users where username='" + username + "'";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    resp = JSON.parse(xmlhttp.responseText);
                    checkcurrentpassword(resp[0].password);
                }
            };
            var url = "jsondb.php?q=read&sql=" + str;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        } else {
            document.changespass.npass.value = "";
            document.changespass.cpass.value = "";
            document.changespass.currpass.value = "";
        }
    }
}

function validationofchangepassword(value) {
    if (value == "true") {
        messagebox('w3-panel w3-green', 'Success!', 'Password Successfully changed.');
        window.location.href = '../index.php';
    } else {
        messagebox('w3-panel w3-red', 'Error!', 'Someting Went wrong!Try again after some time.');
    }
}

function checkcurrentpassword(pass) {
    if (document.changespass.currpass.value == pass) {
        c = document.changespass.cpass.value;
        username = document.getElementById("username").innerHTML;

        str = "UPDATE users set password='" + c + "' where username='" + username + "' or id='" + username + "'";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                resp = xmlhttp.responseText;
                validationofchangepassword(resp);
            }
        };
        var url = "jsondb.php?q=write&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    } else {
        messagebox('w3-panel w3-red', 'Error!', 'Current Password is not match!');
    }
}

function c() {
    alert(document.getElementById('mac').value);
}

function addvendorswithdetails() {
    x = document.getElementById("file_img").value;
    alert(x);
}

function value(vendorname) {
    document.getElementById('id02').style.display = 'block';
    str = "select * from vendors where heading ='" + vendorname + "' ";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = JSON.parse(xmlhttp.responseText);
            for (i = 0; i < resp.length; i++) {
                document.getElementById("nayan1").src = resp[i].pic_path;
                document.getElementById("nayan2").innerHTML = resp[i].heading;
                document.getElementById("nayan3").innerHTML = resp[i].body;
            }
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function deletex() {
    var con = confirm("Are you really wants to delete this vendor!");
    if (con == true) {
        heading = document.getElementById("nayan2").value;

        str = "delete from vendors where heading='" + heading + "'";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                resp = xmlhttp.responseText;
                if (resp == "true") {
                    window.location.href = 'managevendors.php';
                    messagebox('w3-panel w3-green', 'Success!', 'Data successfully deleted.');
                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

function coudeletex() {
    var con = confirm("Are you really wants to delete this Course!");
    if (con == true) {
        var name = $('#icorname').val();

        str = "delete from courses where name='" + name + "'";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                resp = xmlhttp.responseText;
                if (resp == "true") {
                    window.location.href = 'managecourses.php';
                    messagebox('w3-panel w3-green', 'Success!', 'Data successfully deleted.');

                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

function editx() {
    var x = confirm("Are you confirm to edit info about this vendor!");
    if (x == true) {
        $('#xxxx').submit();
    }
}

function coueditx() {
    var x = confirm("Are you confirm to edit info about this course!");
    if (x == true) {
        $('#icourseeditform').submit();
    }
}

function uppercase(val) {
    val.value = val.value.toUpperCase();
}
//understand it carefully
function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(id)
                .attr('src', e.target.result)
                .width(250)
                .height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function addABatch(courseName) {
    $('#id09').show();
    $('#addABatchPanelHeading').html("Add A Batch Into: " + courseName);
    $('#ihcourseName').val(courseName);
}

function d() {
    if ($('#iadovendor').val().trim() == "" || $('#inovendor').val().trim() == "" || document.getElementById('ifile_img').files.length == 0) {
        messagebox('w3-panel w3-yellow', 'Warning!', 'You cant left any of the field empty.');
    } else {
        var con = confirm('Are to sure to add a new vendor?');
        if (con == true) {
            $('#iiaddvendors').submit();
        }
    }
}

function cnayan() {
    username = document.getElementById("username").innerHTML;
    str = "select * from users where username='" + username + "' or id='" + username + "'";


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = JSON.parse(xmlhttp.responseText);

            $("#venpic").attr("src", resp[0].pic_path);
            document.getElementById("pronameofuser").innerHTML = resp[0].first_name + " " + resp[0].last_name;
            document.getElementById("User_Id").innerHTML = resp[0].id;
            document.getElementById("User_Level").innerHTML = resp[0].level;
            document.getElementById("UserName").innerHTML = resp[0].username;
            document.getElementById("First_Name").innerHTML = resp[0].first_name;
            document.getElementById("Last_Name").innerHTML = resp[0].last_name;
            document.getElementById("Company_Name").innerHTML = resp[0].company_name;
            document.getElementById("City").innerHTML = resp[0].city;
            document.getElementById("Phone_Number").innerHTML = resp[0].phone_number;
            document.getElementById("Email").innerHTML = resp[0].email;
            document.getElementById("Zip_Code").innerHTML = resp[0].zip_code;
            document.getElementById("Nationality").innerHTML = resp[0].nationality;
            document.getElementById("Sex").innerHTML = resp[0].sex;
            document.getElementById("Religion").innerHTML = resp[0].religion;
            document.getElementById("Blood_Group").innerHTML = resp[0].blood_group;
            document.getElementById("Date_of_Birth").innerHTML = resp[0].dob;
            document.getElementById("User_Activation_Date").innerHTML = resp[0].user_activation_date;
            document.getElementById("User_Deactivation_Date").innerHTML = resp[0].user_inactivation_date;
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function messagebox(classname, heading, body) {
    document.getElementById("id08").style.display = "block";
    document.getElementById("panel").className = classname;
    document.getElementById("panelheaing").innerHTML = heading;
    document.getElementById("panelbody").innerHTML = body;
}

function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
// important do not remove[learning purpose]

// function gethead(obj)
// {
//   alert(obj.querySelector( '#venpichead' ).innerHTML);
// }
// function gethead(obj) {
//     alert(obj.getElementsByClassName("venpichead")[0].innerHTML);
// }

// function addcourse(row,column)
// {
//   tablerow=row;
//   tablecolumn=column;
// }
//   str="select * from courses where vendor_heading='"+name+"';";
//   //$("#myTable td").remove(); 
//     //$("#myTable tr").slice(-2).remove();

//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function() {
//   if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
//   {
//       resp=JSON.parse(xmlhttp.responseText);
//       getval(resp,resp.length);   
//       // var x=resp.length * -1;
//       // $("#myTable tr").slice(x).remove();
//   }
// };
// var url="jsondb.php?q=read&sql="+str;
// xmlhttp.open("GET", url, true);
// xmlhttp.send();
// function getval(ary,num)
// {
//   for(i = 0; i < num; i++)
//   {
//     $('#co1').html(ary[i].vendor_heading);
//     $('#co2').html(ary[i].pic_path);
//     $('#co3').html(ary[i].name);
//     $('#co4').html(ary[i].code);
//     $('#co5').html(ary[i].adding_date);
//     $('#co6').html(ary[i].details);
//   }
//   var num1=document.getElementById('myTable').rows.length-1;
//   var num2 = num1-num;
//   num = num2 * -1;
//   $("#myTable tr").slice(num).remove();
// }
// function fulltable()
// { 
//     $("#myTable td").remove();
//     str="select * from courses;";
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
//     {
//         resp=JSON.parse(xmlhttp.responseText);
//         var table = document.getElementById("myTable");   
//         for(i = 0; i < resp.length; i++)
//         {
//           var row = table.insertRow(1);
//           var cell1 = row.insertCell(0);
//           var cell2 = row.insertCell(1);
//           var cell3 = row.insertCell(2);
//           var cell4 = row.insertCell(3);
//           var cell5 = row.insertCell(4);
//           var cell6 = row.insertCell(5);
//           var cell7 = row.insertCell(6);
//           cell1.innerHTML = ary[i].vendor_heading;
//           cell2.innerHTML = ary[i].pic_path;
//           cell3.innerHTML = ary[i].name;
//           cell4.innerHTML = ary[i].code;
//           cell5.innerHTML = ary[i].adding_date;
//           cell6.innerHTML = ary[i].details;
//           cell7.innerHTML = ;
//         }
//     }
//   };
//   var url="jsondb.php?q=read&sql="+str;
//   xmlhttp.open("GET", url, true);
//   xmlhttp.send();
// }
function getvendornameforcourse(val) {
    //alert($('#myTable tr:eq('tablerow') td:eq(1)').text());
    $('#id03').show();
    $('#courseinvendor').html("Add A Course Into: " + val);
    $('#ihidecourseinvendor').attr('value', val);
}

function coursename(obj) {
    // stsrt changing here
    $('#id02').show();
    str = "select * from courses where name ='" + obj.innerHTML + "' ";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = JSON.parse(xmlhttp.responseText);
            $('#icoup').attr('src', resp[0].pic_path);
            $('#icorname').val(resp[0].name);
            $('#icbvn').val(resp[0].vendor_heading);
            $('#icouc').val(resp[0].code);
            $('#icad').val(resp[0].adding_date);
            $('#icoudetails').val(resp[0].details);
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function addcou() {
    if (document.getElementById("ifile_img2").files.length == 0 || $('#inocou').val() == "" || $('#icocou').val() == "" || $('#idocou').val() == "") {
        messagebox('w3-panel w3-yellow', 'Warning!', 'Some field contains error value or You left some field empty.');
    } else {
        var s = confirm("Are you really wants to add this course!")
        if (s == true) {
            $('#iaddcourse').submit();
        }
    }
}

function addCourse(){
    if (document.getElementById("ifile_img2").files.length == 0 || $('#inocou').val() == "" || $('#icocou').val() == "" || $('#idocou').val() == ""  || $('#ivendorName').val() == "") {
        messagebox('w3-panel w3-yellow', 'Warning!', 'Some field contains error value or You left some field empty.');
    } else {
        var s = confirm("Are you really wants to add this course!")
        if (s == true) {
            $('#iaddcourse').submit();
        }
    }
}

function checkvendorname() {
    var name = $('#inovendor').val();
    str = "select heading from vendors;";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = JSON.parse(xmlhttp.responseText);
            for (i = 0; i < resp.length; i++) {
                if (resp[i].heading == name) {
                    messagebox('w3-panel w3-red', 'Error!', 'Vendor name already available! Please choose another one.');
                    $('#inovendor').val("");
                }
            }
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function checkBatchCode() {
    var name = $('#ibatchCode').val();
    var str = "select batch_code from batches;";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var resp = JSON.parse(xmlhttp.responseText);
            for (i = 0; i < resp.length; i++) {
                if (resp[i].batch_code == name) {
                    messagebox('w3-panel w3-red', 'Error!', 'Batch code already available! Please choose another one.');
                    $('#ibatchCode').val("");
                }
            }
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function addANewBatch() {

    var courseName=$('#ihcourseName').val();
    var batchCode=$('#ibatchCode').val();
    var batchStartingDate=$('#ibatchStartingDate').val();
    var roomNumber=$('#ibatchRoomNumber').val();
    var facultyName=$('#iassignABatchFaculty').val();
    var amount=$('#ibatchAmount').val();
    var details=$('#ibatchDetails').val();
    var dayValueError=$('#limitDayExitWarning').html();
    
    if(courseName=="" || batchCode=="" || batchStartingDate=="" || roomNumber=="" || facultyName=="" || amount==""){
        messagebox('w3-panel w3-red', 'Error!', 'The field that Contains * sign Cant be empty.');
    }
    else if(dayValueError != ""){
        messagebox('w3-panel w3-red', 'Error!', 'Some Field Contains Error Value,Please Solve It First.');
    }
    else{if(confirm('Are You Confirm To A Add A New Batch Into:'+courseName) == true){
            var dayInAWeek=$('#idayInAWeek').val();
            var batch1Day=$('#ibatchDay').val();
            var day1StartTime=$('#iday1StartTime').val();
            var day1EndTime=$('#iday1EndTime').val();
            var batch2Day=$('#ibatch2Day').val();
            var day2StartTime=$('#iday2StartTime').val();
            var day2EndTime=$('#iday2EndTime').val();

            if(dayInAWeek == 1){
                routine=batch1Day+'-'+day1StartTime+' to '+day1EndTime;
            }else{
                routine=batch1Day+'-'+day1StartTime+' to '+day1EndTime+' and '+batch2Day+'-'+day2StartTime+' to '+day2EndTime;
            }           
            str = "INSERT into batches (course_name,batch_code,batch_starting_date,room_number,faculty_name,amount,details,routine) VALUES ('"+courseName+"','"+batchCode+"','"+batchStartingDate+"','"+roomNumber+"','"+facultyName+"','"+amount+"','"+details+"','"+routine+"')";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    resp = xmlhttp.responseText;
                    if (resp == "true") {
                        messagebox('w3-panel w3-green','Success!','Batch Are Successfully Added.');
                        window.location.href='managecourses.php';
                    } else {
                        messagebox('w3-panel w3-red', 'Error!', 'Something went wrong! try again after some time.');
                    }
                }
            };
            var url = "jsondb.php?q=write&sql=" + str;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    }
}

function checkcoursename() {
    var cname = $('#inocou').val();
    str = "select name from courses;";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = JSON.parse(xmlhttp.responseText);
            for (i = 0; i < resp.length; i++) {
                if (resp[i].name == cname) {
                    messagebox('w3-panel w3-red', 'Error!', 'Course name already available! Please choose another one.');
                    $('#inocou').val("");
                }
            }
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

// function showCourseData() {
//     str = "select * from courses;";

//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             resp = JSON.parse(xmlhttp.responseText);
            
//         }
//     };
//     var url = "jsondb.php?q=read&sql=" + str;
//     xmlhttp.open("GET", url, true);
//     xmlhttp.send();
// }
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function validateZipeCode(code) {
    var re =/^\d+$/;
    return re.test(code);
}

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
function mama(){
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

   var today = moment().format('YYYY-MM-DD');

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
    }else{

      if(confirm("Are you confirm to add this student? ") == true)
      {
          str="INSERT into users (level,username,first_name,last_name,company_name,city,phone_number,email,zip_code,nationality,sex,religion,blood_group,dob,password,user_activation_date) VALUES ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"','"+f+"','"+g+"','"+h+"','"+k+"','"+l+"','"+p+"','"+q+"','"+r+"','"+s+"','"+i+"','"+today+"')";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              resp=xmlhttp.responseText;
              if(resp == "true")
              {
                var userName = document.signup_tsms.uname.value;
                var batchCode = $('#chooseABatch').val();
                var CourseName = $('#ichooseACourse').val();
                var sql = "INSERT into studentassignbatches values ('"+userName+"' , '"+courseName+"' , '"+batchCode+"')";
                var xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function() {
                    if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                        resp=xmlhttp1.responseText;
                        if(resp1 == "true"){
                            messagebox('w3-panel w3-green','Success!','Student Are Successfully Added.');
                            $('#xxxx').submit();
                        }else{
                            messagebox('w3-panel w3-red','Error!','Something went wrong! try again after some time.');
                        }
                    }
                };
                var url="jsondb.php?q=write&sql="+sql;
                xmlhttp1.open("GET", url, true);
                xmlhttp1.send();
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
function gg1()
{
  if(validateEmail(document.submitEditStudentDetails.semail.value)==false)
  {
      document.getElementById("isem").style.display="block";
      document.getElementById("isem").innerHTML="Invalid email address!";
  }
  else
  {
    document.getElementById("isem").innerHTML="";
    document.getElementById("isem").style.display="none";
  }
}
function aa1()
{
  if(validatePhoneNumber(document.submitEditStudentDetails.spnumber.value)==false)
  {
    document.getElementById("ispn").style.display="block";
    document.getElementById("ispn").innerHTML="Invalid Phone number!"; 
  }
  else
  {
    document.getElementById("ispn").innerHTML=""; 
    document.getElementById("ispn").style.display="none"; 
  }
}
function uu1()
{
  if(validateZipeCode(document.submitEditStudentDetails.szcode.value)==false)
  {
      document.getElementById("iszc").style.display="block";
      document.getElementById("iszc").innerHTML="Invalid Zipe code!"; 
  }
  else
  {
    document.getElementById("iszc").innerHTML="";
    document.getElementById("iszc").style.display="none"; 
  }
}
function validEditStudentDetails()
{
   var a=document.submitEditStudentDetails.sulevel.value;
   var b=document.submitEditStudentDetails.suname.value;
   var c=document.submitEditStudentDetails.sufname.value;
   var d=document.submitEditStudentDetails.sulname.value;
   var e=document.submitEditStudentDetails.scname.value;
   var f=document.submitEditStudentDetails.scity.value;
   var g=document.submitEditStudentDetails.spnumber.value;
   var h=document.submitEditStudentDetails.semail.value;
   var k=document.submitEditStudentDetails.szcode.value;
   var l=document.submitEditStudentDetails.snat.value;
   var p=document.submitEditStudentDetails.ssex.value;
   var q=document.submitEditStudentDetails.srel.value;
   var r=document.submitEditStudentDetails.sbgr.value;
   var s=document.submitEditStudentDetails.sdpt.value;

   var m=document.getElementById("ispn").innerHTML;
   var n=document.getElementById("iszc").innerHTML;
   var o=document.getElementById("isem").innerHTML;

   var today = moment().format('YYYY-MM-DD');

  if(m== "Invalid Phone number!" || n== "Invalid Zipe code!" || o== "Invalid email address!")
    {
      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');
    }
  else
    {
      if(confirm("Are you confirm to edit details? ") == true)
      {
          str="update users set level='"+a+"',first_name='"+c+"',last_name='"+d+"',company_name='"+e+"',city='"+f+"',phone_number='"+g+"',email='"+h+"',zip_code='"+k+"',nationality='"+l+"',sex='"+p+"',religion='"+q+"',blood_group='"+r+"',dob='"+s+"' where username='"+b+"';";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              resp=xmlhttp.responseText;
              if(document.getElementById('istudentProfilePic').files.length == 0)
              {
                 messagebox('w3-panel w3-green','Success!','Data successfully edited.');
                 $('#editStudentDetailsPanelCancleButton').click();
              }
              else if(document.getElementById('istudentProfilePic').files.length > 0)
              {
                $('#isubmitEditStudentDetails').submit();
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
}
function changeUserDetails(obj)
{
    var username=obj.innerHTML;
    $('#editStudentDetails').show();
    str="select * from users where username='"+username+"'";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            resp=JSON.parse(xmlhttp.responseText);
            $('#studentProfilePicture').attr("src",resp[0].pic_path);
            $('#isulevel').val(resp[0].level);
            $('#isuname').val(resp[0].username);
            $('#isufname').val(resp[0].first_name);
            $('#isulname').val(resp[0].last_name);
            $('#iscname').val(resp[0].company_name);
            $('#iscity').val(resp[0].city);
            $('#ispnumber').val(resp[0].phone_number);
            $('#isemail').val(resp[0].email);
            $('#iszcode').val(resp[0].zip_code);
            $('#isnat').val(resp[0].nationality);
            $('#issex').val(resp[0].sex);
            $('#isrel').val(resp[0].religion);
            $('#isbgr').val(resp[0].blood_group);
            $('#isdpt').val(resp[0].dob);
            getStudentAssignBatches(resp[0].username);
            getStudentAssignCourses(resp[0].username);
        }
    };
    var url="jsondb.php?q=read&sql="+str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();    
}
function deleteAStudent(username)
{
    if(confirm('Are you really wants to remove a student username likely: '+username+'!') == true)
    {
        str = "delete from users where username='"+username+"'";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                resp = xmlhttp.responseText;
                if (resp == "true") {
                    messagebox('w3-panel w3-green', 'Success!', 'User successfully deleted.');
                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send(); 
    }
}
function deleteAAdmin(username)
{
    if(confirm('Are you sure to remove this admin named:'+username) == true)
    {
        str='delete from users where username="'+username+'"';
        var xmlRequest = new XMLHttpRequest();
        xmlRequest.readystatechange(function(){
            if(xmlRequest.readyState == 4 && xmlRequest.status == 200)
            {
                var result=xmlRequest.responseText;
                if(result == true){
                    messagebox('w3-panel w3-green', 'Success!', 'User successfully deleted.');
                }else{
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        });
        var url="jsondb.php?q=delete&sql=" + str;
        xmlRequest.open("GET", url, true);
        xmlRequest.send();
    }
}
function gg3()
{
  if(validateEmail(document.editAAdminDetailsForm.eaemail.value)==false)
  {
      document.getElementById("ieaem").style.display="block";
      document.getElementById("ieaem").innerHTML="Invalid email address!";
  }
  else
  {
    document.getElementById("ieaem").innerHTML="";
    document.getElementById("ieaem").style.display="none";
  }
}
function aa3()
{
  if(validatePhoneNumber(document.editAAdminDetailsForm.eapnumber.value)==false)
  {
    document.getElementById("ieapn").style.display="block";
    document.getElementById("ieapn").innerHTML="Invalid Phone number!"; 
  }
  else
  {
    document.getElementById("ieapn").innerHTML=""; 
    document.getElementById("ieapn").style.display="none"; 
  }
}
function uu3()
{
  if(validateZipeCode(document.editAAdminDetailsForm.eazcode.value)==false)
  {
      document.getElementById("ieazc").style.display="block";
      document.getElementById("ieazc").innerHTML="Invalid Zipe code!"; 
  }
  else
  {
    document.getElementById("ieazc").innerHTML="";
    document.getElementById("ieazc").style.display="none"; 
  }
}
function changeAdminDetails(username)
{
    $('#editAdminDetails').show();
    str="select * from users where username='"+username.innerHTML+"'";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            resp=JSON.parse(xmlhttp.responseText);
            $('#editAdminDummyProfilePic').attr("src",resp[0].pic_path);
            $('#ieaulevel').val(resp[0].level);
            $('#ieauname').val(resp[0].username);
            $('#ieafname').val(resp[0].first_name);
            $('#iealname').val(resp[0].last_name);
            $('#ieacname').val(resp[0].company_name);
            $('#ieacity').val(resp[0].city);
            $('#ieapnumber').val(resp[0].phone_number);
            $('#ieaemail').val(resp[0].email);
            $('#ieazcode').val(resp[0].zip_code);
            $('#ieanat').val(resp[0].nationality);
            $('#ieasex').val(resp[0].sex);
            $('#iearel').val(resp[0].religion);
            $('#ieabgr').val(resp[0].blood_group);
            $('#ieadpt').val(resp[0].dob);
        }
    };
    var url="jsondb.php?q=read&sql="+str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function editAAdminDetails(){
   var a=document.editAAdminDetailsForm.eaulevel.value;
   var b=document.editAAdminDetailsForm.eauname.value;
   var c=document.editAAdminDetailsForm.eafname.value;
   var d=document.editAAdminDetailsForm.ealname.value;
   var e=document.editAAdminDetailsForm.eacname.value;
   var f=document.editAAdminDetailsForm.eacity.value;
   var g=document.editAAdminDetailsForm.eapnumber.value;
   var h=document.editAAdminDetailsForm.eaemail.value;
   var k=document.editAAdminDetailsForm.eazcode.value;
   var l=document.editAAdminDetailsForm.eanat.value;
   var p=document.editAAdminDetailsForm.easex.value;
   var q=document.editAAdminDetailsForm.earel.value;
   var r=document.editAAdminDetailsForm.eabgr.value;
   var s=document.editAAdminDetailsForm.eadpt.value;

   var m=document.getElementById("ieapn").innerHTML;
   var n=document.getElementById("ieazc").innerHTML;
   var o=document.getElementById("ieaem").innerHTML;

  if(m== "Invalid Phone number!" || n== "Invalid Zipe code!" || o== "Invalid email address!")
    {
      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');
    }
  else
    {
      if(confirm("Are you confirm to edit details? ") == true)
      {
          str="update users set level='"+a+"',first_name='"+c+"',last_name='"+d+"',company_name='"+e+"',city='"+f+"',phone_number='"+g+"',email='"+h+"',zip_code='"+k+"',nationality='"+l+"',sex='"+p+"',religion='"+q+"',blood_group='"+r+"',dob='"+s+"' where username='"+b+"';";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              resp=xmlhttp.responseText;
              if(document.getElementById('ieditAdminProfilePic').files.length == 0)
              {
                 messagebox('w3-panel w3-green','Success!','Data successfully edited.');
                 $('#editAdminDetailsPanelCancleButton').click();
              }
              else if(document.getElementById('ieditAdminProfilePic').files.length > 0)
              {
                $('#ieditAAdminDetailsForm').submit();
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
}
function gg2()
{
  if(validateEmail(document.adminDetailsForm.aemail.value)==false)
  {
      document.getElementById("iaem").style.display="block";
      document.getElementById("iaem").innerHTML="Invalid email address!";
  }
  else
  {
    document.getElementById("iaem").innerHTML="";
    document.getElementById("iaem").style.display="none";
  }
}
function aa2()
{
  if(validatePhoneNumber(document.adminDetailsForm.apnumber.value)==false)
  {
    document.getElementById("iapn").style.display="block";
    document.getElementById("iapn").innerHTML="Invalid Phone number!"; 
  }
  else
  {
    document.getElementById("iapn").innerHTML=""; 
    document.getElementById("iapn").style.display="none"; 
  }
}
function uu2()
{
  if(validateZipeCode(document.adminDetailsForm.azcode.value)==false)
  {
      document.getElementById("iazc").style.display="block";
      document.getElementById("iazc").innerHTML="Invalid Zipe code!"; 
  }
  else
  {
    document.getElementById("iazc").innerHTML="";
    document.getElementById("iazc").style.display="none"; 
  }
}
function check_confirm_pass_for_admin()
{
  var a=document.getElementById("iapass").value;
  var b=document.getElementById("iacpass").value;
  if(a!=b)
  {
    document.getElementById("iancp").style.display="block";
    document.getElementById("iancp").innerHTML="Password and Confirm Password is not match!"; 
  }
  else
  {
    document.getElementById("iancp").innerHTML="";
    document.getElementById("iancp").style.display="none"; 
  }
}
function CheckAdminUserName()
{
        username=document.adminDetailsForm.auname.value;
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
                document.getElementById("iauname").value = "";
              }
            }
        }
  };
    var url="jsondb.php?q=read&sql="+str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function submitANewAdmin(){
   var a=document.adminDetailsForm.aulevel.value;
   var b=document.adminDetailsForm.auname.value;
   var c=document.adminDetailsForm.afname.value;
   var d=document.adminDetailsForm.alname.value;
   var e=document.adminDetailsForm.acname.value;
   var f=document.adminDetailsForm.acity.value;
   var g=document.adminDetailsForm.apnumber.value;
   var h=document.adminDetailsForm.aemail.value;
   var i=document.adminDetailsForm.apass.value;
   var j=document.adminDetailsForm.acpass.value;
   var k=document.adminDetailsForm.azcode.value;
   var l=document.adminDetailsForm.anat.value;
   var p=document.adminDetailsForm.asex.value;
   var q=document.adminDetailsForm.arel.value;
   var r=document.adminDetailsForm.abgr.value;
   var s=document.adminDetailsForm.adpt.value;

   var m=document.getElementById("iapn").innerHTML;
   var n=document.getElementById("iazc").innerHTML;
   var o=document.getElementById("iaem").innerHTML;
   var rlm=document.getElementById("iancp").innerHTML;

   var today = moment().format('YYYY-MM-DD');


   if(a=="" || b=="" || c=="" || d=="" || f=="" || g=="" || h==""  || i=="" || j=="" || l=="" || p=="" || q=="" || r=="" || s=="" || document.getElementById('iadminProfilePic').files.length == 0)
    {
      messagebox('w3-panel w3-red','Error!','The field that contain * sign. cant left empty.');
    }
  else if(m== "Invalid Phone number!" || n== "Invalid Zipe code!" || o== "Invalid email address!" || rlm=="Password and Confirm Password is not match!")
    {
      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');
    }
  else if(document.getElementById('iadminProfilePic').files.length == 0)
    {
      messagebox('w3-panel w3-red','Error!','You cant left profile pic empty.');
    }
  else
    {
      if(confirm("Are you confirm to add a new admin? ") == true)
      {
          str="INSERT into users (level,username,first_name,last_name,company_name,city,phone_number,email,zip_code,nationality,sex,religion,blood_group,dob,password,user_activation_date) VALUES ('"+a+"','"+b+"','"+c+"','"+d+"','"+e+"','"+f+"','"+g+"','"+h+"','"+k+"','"+l+"','"+p+"','"+q+"','"+r+"','"+s+"','"+i+"','"+today+"')";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              resp=xmlhttp.responseText;
              if(resp == "true")
              {
                 $('#iadminDetailsForm').submit();
                 messagebox('w3-panel w3-green','Success!','Student Are Successfully Added.');
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
}
function triggerdeleteAFaculty(id,name){
    if(confirm('Are You Really Wants To Delete This Faculty Named: '+name) == true){
        var str='delete from faculties where id="'+id+'"';
        var xmlhttpRequest = new XMLHttpRequest();
        xmlhttpRequest.onreadystatechange = function(){
            if(xmlhttpRequest.readyState == 4 && xmlhttpRequest.status == 200){
                var resp=xmlhttpRequest.responseText;
                if(resp == "true"){
                    messagebox('w3-panel w3-green','Success!','Instructor Are Successfully deleted.');
                    window.location.href='manageinstructors.php';
                }else{
                    messagebox('w3-panel w3-red','Error!','Something Went Wrong, Try Again After Some Time!');
                }
            }
        };
        var url="jsondb.php?q=delete&sql=" + str;
        xmlhttpRequest.open("GET", url, true);
        xmlhttpRequest.send();
    }
}
function gg4(){
  if(document.instructorDetailsForm.iemail.value == ""){
    document.getElementById("iiem").innerHTML="";
    document.getElementById("iiem").style.display="none";
  }
  else if(validateEmail(document.instructorDetailsForm.iemail.value) == false){
      document.getElementById("iiem").style.display="block";
      document.getElementById("iiem").innerHTML="Invalid email address!";
  }else{
    document.getElementById("iiem").innerHTML="";
    document.getElementById("iiem").style.display="none";
  }
}
function aa4(){
  if(document.instructorDetailsForm.ipnumber.value == ""){
    document.getElementById("iipn").innerHTML=""; 
    document.getElementById("iipn").style.display="none"; 
  }   
  else if(validatePhoneNumber(document.instructorDetailsForm.ipnumber.value)==false){
    document.getElementById("iipn").style.display="block";
    document.getElementById("iipn").innerHTML="Invalid Phone number!"; 
  }else{
    document.getElementById("iipn").innerHTML=""; 
    document.getElementById("iipn").style.display="none"; 
  }
}
function uu4(){
  if(document.instructorDetailsForm.izcode.value == ""){
    document.getElementById("iizc").innerHTML="";
    document.getElementById("iizc").style.display="none"; 
  }
  else if(validateZipeCode(document.instructorDetailsForm.izcode.value)==false){
      document.getElementById("iizc").style.display="block";
      document.getElementById("iizc").innerHTML="Invalid Zipe code!"; 
  }else{
    document.getElementById("iizc").innerHTML="";
    document.getElementById("iizc").style.display="none"; 
  }
}

function submitANewInstructor(){

   var courseName=document.instructorDetailsForm.icourseName.value;
   var batchCode=document.instructorDetailsForm.ibatchCode.value;
   var firstName=document.instructorDetailsForm.ifname.value;
   var lastName=document.instructorDetailsForm.ilname.value;
   var facultyName=firstName+" "+lastName;
   var companyName=document.instructorDetailsForm.icname.value;
   var city=document.instructorDetailsForm.icity.value;
   var phoneNumber=document.instructorDetailsForm.ipnumber.value;
   var email=document.instructorDetailsForm.iemail.value;
   var zipCode=document.instructorDetailsForm.izcode.value;
   var nationality=document.instructorDetailsForm.inat.value;
   var sex=document.instructorDetailsForm.isex.value;
   var religion=document.instructorDetailsForm.irel.value;
   var bloodGroup=document.instructorDetailsForm.ibgr.value;
   var dateOfBirth=document.instructorDetailsForm.idpt.value;

   var errorPhoneNumber=$('#iipn').html();
   var errorZipCode=$('#iizc').html();
   var errorEmailAddress=$('#iiem').html();
   var todayDate = moment().format('YYYY-MM-DD');

   
    if(firstName == "" || lastName == "" || city == "" || phoneNumber == "" || email == ""  || zipCode == "" || nationality == "" || sex == "" || religion == "" || bloodGroup == "" || dateOfBirth == "" || $('#iinstructorProfilePic').get(0).files.length == 0){

      messagebox('w3-panel w3-red','Error!','The field that contain * sign. cant left empty.');

    }else if(errorPhoneNumber== "Invalid Phone number!" || errorZipCode== "Invalid Zipe code!" || errorEmailAddress== "Invalid email address!"){

      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');

    }else if(document.getElementById('iinstructorProfilePic').files.length == 0){

      messagebox('w3-panel w3-red','Error!','You cant left profile pic empty.');

    }else{
      if(confirm("Are you confirm to add a new Instructor Named: " + facultyName +"?") == true){
          var str="INSERT into faculties (course_name,batch_code,first_name,last_name,faculty_name,company_name,city,phone_number,email,zip_code,nationality,sex,religion,blood_group,dob,faculty_activation_date) VALUES ('"+courseName+"','"+batchCode+"','"+firstName+"','"+lastName+"','"+facultyName+"','"+companyName+"','"+city+"','"+phoneNumber+"','"+email+"','"+zipCode+"','"+nationality+"','"+sex+"','"+religion+"','"+bloodGroup+"','"+dateOfBirth+"','"+todayDate+"')";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                var resp=xmlhttp.responseText;
                if(resp == "true"){
                    messagebox('w3-panel w3-green','Success!','New Instructor Are Successfully added.');
                    $('#iinstructorDetailsForm').submit();
                }else{
                    messagebox('w3-panel w3-red','Error!','Something Went Wrong, Try Again After Some Time!');
                }
            }
          };
          var url="jsondb.php?q=write&sql="+str;
          xmlhttp.open('GET', url, true);
          xmlhttp.send();
      }
    }
}

function editFacultyDetails(id){
    $('#EditAInstructor').show();
    var str="select * from faculties where id="+id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var res=JSON.parse(xmlhttp.responseText);
            $('#editInstructorDummyPic').attr('src',res[0].pic_path);
            $('#ieicourseName').val(res[0].course_name);
            showForEditBatchCode();
            $('#ieibatchCode').val(res[0].batch_code);
            $('#ieifname').val(res[0].first_name);
            $('#ieilname').val(res[0].last_name);
            $('#ieinstructorname').val(res[0].faculty_name);
            $('#ieicname').val(res[0].company_name);
            $('#ieicity').val(res[0].city);
            $('#ieipnumber').val(res[0].phone_number);
            $('#ieiemail').val(res[0].email);
            $('#ieizcode').val(res[0].zip_code);
            $('#ieinat').val(res[0].nationality);
            $('#ieisex').val(res[0].sex);
            $('#ieirel').val(res[0].religion);
            $('#ieibgr').val(res[0].blood_group);
            $('#ieidpt').val(res[0].dob);
            $('#iefactivationdate').val(res[0].faculty_activation_date);
            $('#iefdeactivationdate').val(res[0].faculty_inactivation_date);
            $('#iefacultyactivation').val(res[0].faculty_active);
            $('#facultyId').html(res[0].faculty_name);
            getFacultyActiveCourses(res[0].faculty_name);
        }
    };
    var url="jsondb.php?q=read&sql="+str;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function checkInstructorEmail(){
    if($('#iiemail').val() !=""){
        var instructorEmailaddess=$('#iiemail').val();
        var str='select email from faculties';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                var res=JSON.parse(xmlhttp.responseText);
                for(var i=0;i<res.length;i++){
                    if(res[i].email == instructorEmailaddess){
                        messagebox('w3-panel w3-red','Error!','Email address already available!Enter another one.');
                        $('#iiemail').val("");
                    }
                }
            }
        };
        var url="jsondb.php?q=read&sql="+str;
        xmlhttp.open('GET', url, true);
        xmlhttp.send();
    }
}

function showBatchCode(){
    var courseName=$('#iicourseName').val();
    var sql='select batch_code from batches where course_name="'+courseName+'"';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        var result=JSON.parse(xmlhttp.responseText);
        for(var i=0;i<result.length;i++){
            $('#iibatchCode').append("<option value='" + result[i].batch_code+ "'>" + result[i].batch_code + "</option>");
        }
      }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function showForEditBatchCode(){
    var courseName=$('#ieicourseName').val();
    var sql='select batch_code from batches where course_name="'+courseName+'"';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        var result=JSON.parse(xmlhttp.responseText);
        for(var i=0;i<result.length;i++){
            $('#ieibatchCode').append("<option value='" + result[i].batch_code+ "'>" + result[i].batch_code + "</option>");
        }
      }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function getFacultyActiveCourses(facultyName){
    $('#facultyActiveCoursesList li').remove();
    getCourseName(facultyName);
    var sql='select course_name from batches where faculty_name="'+facultyName+'"';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var result=JSON.parse(xmlhttp.responseText);
            for(var i=0; i<result.length; i++){
                $('#facultyActiveCoursesList').append("<li><a class='cventablehead' href='manageinstructordetails.php?courseName="+result[i].course_name+"&facultyName="+facultyName+"' >"+result[i].course_name+"</a></li>");
            }
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function getStudentAssignBatches(userName){
    $('#studentAssignBatchesList li').remove();
    var sql = 'SELECT batch_code from studentassignbatches WHERE username ="'+userName+'";';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var result=JSON.parse(xmlhttp.responseText);
            for(var i=0; i<result.length; i++){
                $('#studentAssignBatchesList').append("<li class='cventablehead'><a href='managestudentdetails.php?batchCode="+result[i].batch_code+"&userName="+userName+"' >"+result[i].batch_code+"</a></li>");
            }
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function getStudentAssignCourses(userName){
    $('#studentAssignCoursesList li').remove();
    var sql = "SELECT course_name from studentassignbatches WHERE username ='"+userName+"';";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var result=JSON.parse(xmlhttp.responseText);
            for(var i=0; i<result.length; i++){
                $('#studentAssignCoursesList').append("<li class='cventablehead'><a href='managestudentdetails.php?courseName="+result[i].course_name+"&userName="+userName+"' >"+result[i].course_name+"</a></li>");
            }
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function getCourseName(name){
    $('#facultyActiveBatchesList li').remove();
    var facultyName = name;
    var sql='select batch_code from batches where faculty_name="'+facultyName+'"';

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var result=JSON.parse(xmlhttp.responseText);
            for(var i=0; i<result.length; i++){
                $('#facultyActiveBatchesList').append("<li><a class='cventablehead' href='manageinstructordetails.php?batchCode="+result[i].batch_code+"&facultyName="+facultyName+"' >"+result[i].batch_code+"</a></li>");
            }
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url,true);
    xmlhttp.send();
}
function submitToEditInstructorDetails(){
    var facultyId=$('#facultyId').html();
    var courseName=document.editInstructorDetailsForm.eicourseName.value;
    var batchCode=document.editInstructorDetailsForm.eibatchCode.value;
    var firstName=document.editInstructorDetailsForm.eifname.value;
    var lastName=document.editInstructorDetailsForm.eilname.value;
    var facultyName=firstName+" "+lastName;
    var companyName=document.editInstructorDetailsForm.eicname.value;
    var city=document.editInstructorDetailsForm.eicity.value;
    var phoneNumber=document.editInstructorDetailsForm.eipnumber.value;
    var email=document.editInstructorDetailsForm.eiemail.value;
    var zipCode=document.editInstructorDetailsForm.eizcode.value;
    var nationality=document.editInstructorDetailsForm.einat.value;
    var sex=document.editInstructorDetailsForm.eisex.value;
    var religion=document.editInstructorDetailsForm.eirel.value;
    var bloodGroup=document.editInstructorDetailsForm.eibgr.value;
    var dateOfBirth=document.editInstructorDetailsForm.eidpt.value;

    var errorPhoneNumber=$("#eiipn").html();
    var errorZipCode=$("#eiizc").html();
    var errorEmailAddress=$("#eiiem").html();
    
    
    if(firstName=="" || lastName=="" || city=="" || phoneNumber=="" || email==""  || zipCode=="" || nationality=="" || sex=="" || religion=="" || bloodGroup=="" || dateOfBirth==""){
      messagebox('w3-panel w3-red','Error!','The field that contain * sign. cant left empty.');
    }
    else if(errorPhoneNumber== "Invalid Phone number!" || errorZipCode== "Invalid Zipe code!" || errorEmailAddress== "Invalid email address!"){
      messagebox('w3-panel w3-red','Error!','Some field contains Invalid value! try again.');
    }
    else{
      if(confirm("Are you confirm to edit Instructor details? ") == true){
          var str="UPDATE faculties set course_name='"+courseName+"',batch_code='"+batchCode+"',first_name='"+firstName+"',last_name='"+lastName+"',faculty_name='"+facultyName+"',company_name='"+companyName+"',city='"+city+"',phone_number='"+phoneNumber+"',email='"+email+"',zip_code='"+zipCode+"',nationality='"+nationality+"',sex='"+sex+"',religion='"+religion+"',blood_group='"+bloodGroup+"',dob='"+dateOfBirth+"' where id="+facultyId+"";
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                var resp=xmlhttp.responseText;
                if(resp == "true"){
                    if(document.getElementById('ieditInstructorProfilePic').files.length > 0){
                        $('#iinstructorDetailsForm').submit();
                    }else{
                        messagebox('w3-panel w3-green','Success!','Instructor Details Are Successfully Edited.');
                    }
                }else{
                    messagebox('w3-panel w3-red','Error!','Something Went Wrong, Try Again After Some Time!');
                }
            }
          };
          var url="jsondb.php?q=write&sql="+str;
          xmlhttp.open('GET', url, true);
          xmlhttp.send();
      }
    }
}
function checkFacultyName(){
    var firstName=$('#iifname').val();
    var lastName=$('#iilname').val();
    var facultyName=firstName+" "+lastName;

    var sql="SELECT faculty_name from faculties;";
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var result=JSON.parse(xmlhttp.responseText);
            for(var i=0; i<result.length; i++){
                if(result[i].faculty_name == facultyName){
                    messagebox('w3-panel w3-red','Error!','Faculty Name which is may like "['+facultyName+']" is already available, please choose another one!');
                    $('#iifname').val("");
                    $('#iilname').val("");
                }
            }
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function fillChooseACourse(){
    var vendorName=$('#ichooseAVendor').val();
    $('#ichooseACourse option').remove();
    $('#ichooseACourse').append("<option>Choose A Course*</option>");
    var sql="select name from courses where vendor_heading='"+vendorName+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result=JSON.parse(xmlhttp.responseText);
            result.forEach(function(obj){
                $('#ichooseACourse').append("<option value="+obj.name+">"+obj.name+"</option>");
            });
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function fillChooseABatch(){
    var courseName = $('#ichooseACourse').val();
    $('#chooseABatch option').remove();
    $('#chooseABatch').append("<option>Choose A Batch</option>");
    var sql="select batch_code from batches where course_name='"+courseName+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result=JSON.parse(xmlhttp.responseText);
            result.forEach(function(obj){
                $('#chooseABatch').append("<option value="+obj.batch_code+">"+obj.batch_code+"</option>");
            });
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function addANewBatchFromBatchPanel(){
    var vendorName=$('#ichooseAVendor').val();
    var courseName=$('#ichooseACourse').val();
    var batchCode=$('#ibatchCode').val();
    var batchStartingDate=$('#ibatchStartingDate').val();
    var roomNumber=$('#ibatchRoomNumber').val();
    var facultyName=$('#iassignABatchFaculty').val();
    var amount=$('#ibatchAmount').val();
    var details=$('#ibatchDetails').val();
    var dayValueError=$('#limitDayExitWarning').html();
    
    if(vendorName=="" || courseName=="" || batchCode=="" || batchStartingDate=="" || roomNumber=="" || facultyName=="" || amount==""){
        messagebox('w3-panel w3-red', 'Error!', 'The field that Contains * sign Cant be empty.');
    }
    else if(dayValueError != ""){
        messagebox('w3-panel w3-red', 'Error!', 'Some Field Contains Error Value,Please Solve that First.');
    }
    else{if(confirm('Are You Confirm To Add A New Batch Into: '+courseName) == true){
            var dayInAWeek=$('#idayInAWeek').val();
            var batch1Day=$('#ibatchDay').val();
            var day1StartTime=$('#iday1StartTime').val();
            var day1EndTime=$('#iday1EndTime').val();
            var batch2Day=$('#ibatch2Day').val();
            var day2StartTime=$('#iday2StartTime').val();
            var day2EndTime=$('#iday2EndTime').val();

            if(dayInAWeek == 1){
                routine=batch1Day+'-'+day1StartTime+' to '+day1EndTime;
            }else{
                routine=batch1Day+'-'+day1StartTime+' to '+day1EndTime+' and '+batch2Day+'-'+day2StartTime+' to '+day2EndTime;
            }           
            str = "INSERT into batches (course_name,batch_code,batch_starting_date,room_number,faculty_name,amount,details,routine) VALUES ('"+courseName+"','"+batchCode+"','"+batchStartingDate+"','"+roomNumber+"','"+facultyName+"','"+amount+"','"+details+"','"+routine+"')";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    resp = xmlhttp.responseText;
                    if (resp == "true") {
                        messagebox('w3-panel w3-green','Success!','Batch Are Successfully Added.');
                        window.location.href='manageBatches.php';
                    }else {
                        messagebox('w3-panel w3-red', 'Error!', 'Something went wrong! try again after some time.');
                    }
                }
            };
            var url = "jsondb.php?q=write&sql=" + str;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    }
}

function checkToEditBatchCode(){
    var name = $('#iebatchCode').val();
    var str = "select batch_code from batches;";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var resp = JSON.parse(xmlhttp.responseText);
            for (i = 0; i < resp.length; i++) {
                if (resp[i].batch_code == name) {
                    messagebox('w3-panel w3-red', 'Error!', 'Batch code already available! Please choose another one.');
                    $('#iebatchCode').val("");
                }
            }
        }
    };
    var url = "jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function editANewBatchFromBatchPanel(){ 

    var vendorName=$('#ichooseToEditAVendor').val();
    var courseName=$('#ichooseToEditACourse').val();
    var batchCode=$('#iebatchCode').val();
    var batchStartingDate=$('#iebatchStartingDate').val();
    var roomNumber=$('#iebatchRoomNumber').val();
    var facultyName=$('#ieassignABatchFaculty').val();
    var amount=$('#iebatchAmount').val();
    var details=$('#iebatchDetails').val();
    
    if(vendorName == "" || courseName == "" || batchCode == "" || batchStartingDate == "" || roomNumber == "" || facultyName == "" || amount == ""){
        
        messagebox('w3-panel w3-red', 'Error!', 'The field that Contains * sign Cant be empty.');

    }else{
        if(confirm('Are You Confirm To Edit This Batch Info: '+ batchCode) == true){

            var batch1Day=$('#iebatchDay').val();
            var day1StartTime=$('#ieday1StartTime').val();
            var day1EndTime=$('#ieday1EndTime').val();
            var batch2Day=$('#iebatch2Day').val();
            var day2StartTime=$('#ieday2StartTime').val();
            var day2EndTime=$('#ieday2EndTime').val();

            if(batch2Day == "" || day2StartTime == "" || day2EndTime == ""){

                routine = batch1Day + '-' + day1StartTime + ' to ' + day1EndTime;

            }else{

                routine = batch1Day + '-' + day1StartTime + ' to ' + day1EndTime + ' and ' + batch2Day + '-' + day2StartTime + ' to ' + day2EndTime;
            
            }

            var str = "UPDATE batches set course_name='"+courseName+"',batch_code='"+batchCode+"',batch_starting_date='"+batchStartingDate+"',room_number='"+roomNumber+"',faculty_name='"+facultyName+"',amount='"+amount+"',details='"+details+"',routine='"+routine+"'";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    resp = xmlhttp.responseText;
                    if (resp == "true") {
                        messagebox('w3-panel w3-green','Success!','Batch Details Are Successfully Eited.');
                        window.location.href='manageBatches.php';
                    }else {
                        messagebox('w3-panel w3-red', 'Error!', 'Something went wrong! try again after some time.');
                    }
                }
            };
            var url = "jsondb.php?q=write&sql=" + str;
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    }
}

function addDetailsToEditABatch(batchCode){
    $('#editABatch').show();
    var str="select * from batches where batch_code='"+batchCode+"'";
    var xr = new XMLHttpRequest();
    xr.onreadystatechange = function(){
        if(xr.status == 200 && xr.readyState == 4){
            var result=JSON.parse(xr.responseText);
            $('#iebatchCode').val(result[0].batch_code);
            $('#iebatchStartingDate').val(result[0].batch_starting_date);
            $('#iebatchRoutine').val(result[0].routine);
            $('#iebatchRoomNumber').val(result[0].room_number);
            $('#ieassignABatchFaculty').val(result[0].faculty_name);
            $('#iebatchAmount').val(result[0].amount);
            $('#iebatchDetails').val(result[0].details);
            selectVendorAndCourse(result[0].course_name);
        }
    };
    var url="jsondb.php?q=read&sql=" + str;
    xr.open("GET", url, true);
    xr.send();
}

function selectVendorAndCourse(courseName){
    var str="select vendor_heading from courses where name='"+courseName+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result = JSON.parse(xmlhttp.responseText);
            $('#ichooseToEditAVendor').val(result[0].vendor_heading);
            fillToEditACourse();
            $('#ichooseToEditACourse').val(courseName);
        }
    };
    var url="jsondb.php?q=read&sql=" + str;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function fillToEditACourse(){
    var vendorName=$('#ichooseToEditAVendor').val();
    $('#ichooseToEditACourse option').remove();
    $('#ichooseToEditACourse select').val("Choose A Course*");
    var sql="select name from courses where vendor_heading='"+vendorName+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result=JSON.parse(xmlhttp.responseText);
            result.forEach(function(obj){
                $('#ichooseToEditACourse').append("<option>"+obj.name+"</option>");
            });
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}
function deleteACourse(obj){   
    if(confirm("Do you wants to delete the course named: "+obj+"?") == true){
        var sql="select batch_code from batches where course_name = '"+obj+"'";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
                var results = JSON.parse(xmlhttp.responseText);
                var len=results.length;
                if(len <= 0){
                    var str="";
                    var xmlhttp1 = new XMLHttpRequest();
                    xmlhttp1.onreadystatechange = function(){
                        if(xmlhttp1.status == 200 && xmlhttp1.readyState == 4){
                            var result=xmlhttp1.responseText;
                            if(result == "true"){
                                messagebox('w3-panel w3-green', 'Success!', 'Course Successfully Deleteed.');
                                window.location.href='managecourses.php';                        
                            }else{
                                messagebox('w3-panel w3-red', 'Error!', 'someting went wrong! try again after some time!');
                            }
                        }
                    };
                    var url1="jsondb.php?q=delete&sql=" + str;
                    xmlhttp1.open('GET', url1, true);
                    xmlhttp1.send();
                }else{
                    messagebox('w3-panel w3-yellow', 'Warning!', 'You cant delete this course! because this coure contains some batch, first delete them then come back!');
                }
                /*results.forEach(function(result){
                    alert(result.batch_code);
                });*/
            }
        };
        var url="jsondb.php?q=read&sql=" + sql;
        xmlhttp.open('GET', url, true);
        xmlhttp.send();
    }
}
function deleteABatch(batchCode){
    if(confirm('do you really wants to delete a batch named: '+batchCode) == true){
        var str="delete from batches where batch_code='"+batchCode+"'";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
                var result = xmlhttp.responseText;
                if(result == "true"){
                    messagebox('w3-panel w3-green', 'Success!', 'Batch Successfully Deleteed.');
                    window.location.href='manageBatches.php';                        
                }else {
                    messagebox('w3-panel w3-red', 'Error!', 'someting went wrong! try again after some time!');
                }
            }
        };
        var url="jsondb.php?q=delete&sql=" + str;
        xmlhttp.open('GET', url,true);
        xmlhttp.send();
        // $.get( "test.php", { str: "yes" } )
        //   .done(function( result ) {
        //     //console.log( "JSON Data: " + json.users[ 3 ].name );
        //     alert(result);
        //   });
          // .fail(function( jqxhr, textStatus, error ) {
          //   var err = textStatus + ", " + error;
          //   console.log( "Request Failed: " + err );
        //});
    }
}

function studentDetailsAgainstBatch(){
    var batchCode=$('#batchListAgainstStudent').val();
    $('#studentDetails tbody tr').remove();
    var sql="select username from studentassignbatches where batch_code='"+batchCode+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result=JSON.parse(xmlhttp.responseText);
            result.forEach(function(obj){
                addStudentToTable(obj.username);
            });
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function addStudentToTable(userName){
    var sql="select * from users where username='"+userName+"'";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
            var result=JSON.parse(xmlhttp.responseText);
            result.forEach(function(obj){
                $('#studentDetails tbody').append("<tr><td>"+obj.first_name+"</td><td>"+obj.last_name+"</td><td><a href='managestudents.php#search="+obj.username+"' class='batchUnderline'>"+obj.username+"</a></td><td><img height='60px' width='80px' src="+obj.pic_path+"></td><td>"+obj.company_name+"</td><td>"+obj.city+"</td><td>"+obj.phone_number+"</td><td>"+obj.email+"</td><td>"+obj.zip_code+"</td><td>"+obj.nationality+"</td><td>"+obj.sex+"</td><td>"+obj.religion+"</td><td>"+obj.blood_group+"</td><td>"+obj.dob+"</td></tr>");
            });
        }
    };
    var url="jsondb.php?q=read&sql=" + sql;
    xmlhttp.open('GET', url, true);
    xmlhttp.send();
}

function deleteABatchFromAStudent(){
    if(confirm("Are you confirm to delete batch "+$('#batchCode').html()+" from student "+$('#studentName').html()+"? ") == true){
        str = "DELETE FROM studentassignbatches WHERE username = '"+$('#userName').html()+"' AND course_name = '"+$('#courseName').html()+"' AND batch_code = '"+$('#batchCode').html()+"';";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = xmlhttp.responseText;
            if (resp == "true") {
                window.location.href = 'managestudents.php';
                    messagebox('w3-panel w3-green', 'Success!', 'Batch successfully removed.');
                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

function deleteABatchFromAFaculty(){
    if(confirm("Are you confirm to delete batch "+$('#batchCode').html()+" from faculty "+$('#facultyName').html()+"? ") == true){
        str = "UPDATE batches SET faculty_name = '' WHERE course_name = '"+$('#courseName').html()+"' AND batch_code = '"+$('#batchCode').html()+"';";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = xmlhttp.responseText;
            if (resp == "true") {
                window.location.href = 'manageinstructors.php';
                    messagebox('w3-panel w3-green', 'Success!', 'Batch successfully removed.');
                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

function deleteACourseFromAFaculty(){
    if(confirm("Are you confirm to delete Course "+$('#courseName').html()+" from faculty "+$('#facultyName').html()+"? ") == true){
        str = "UPDATE batches SET faculty_name = '' WHERE course_name = '"+$('#courseName').html()+"';";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            resp = xmlhttp.responseText;
            if (resp == "true") {
                window.location.href = 'manageinstructors.php';
                    messagebox('w3-panel w3-green', 'Success!', 'Batch successfully removed.');
                } else if (resp == "false") {
                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
                }
            }
        };
        var url = "jsondb.php?q=delete&sql=" + str;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

