<?php
session_start();
if( isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin"){
  echo "<h1 style='display:none' id='username'>".$_SESSION['username']."</h1>";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TSMS-Admin Page | </title>
  <?php include 'pageHead.php'; ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#icurrpass, #inpass, #icpass').keypress(function(e){
      if(e.keyCode == 13){
          $('#isubmitx').click();
        }
      });
    });
  </script>
</head>
<body class="w3-theme">
  <?php include 'pageSideNavigationBar.php'; ?>
  <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
    <div id="guts">
      <form name="changespass" class="w3-container">
        <h2 class="w3-text-blue">Change password</h2></p>      
        <input required autocomplete="off" placeholder="Current Password" id="icurrpass" name="currpass" class="w3-input w3-border w3-animate-input" type="password" style="width:30%"><p>      
        <input required autocomplete="off" name="npass" placeholder="New Password" id="inpass" class="w3-input w3-border w3-animate-input" type="password" style="width:30%"></p>         
        <input required  autocomplete="off" name="cpass" placeholder="Confirm Password" id="icpass" class="w3-input w3-border w3-animate-input" type="password" style="width:30%"></p>
        <button name="submitx" id="isubmitx" onclick="checkx()" type="button" class="w3-btn w3-red w3-border w3-border-red w3-round-xlarge">Change Password</button>
      </form>
    </div>
  </section>
  <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php } else{ header("location:../index.php"); }?>