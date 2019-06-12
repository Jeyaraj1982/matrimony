<!DOCTYPE html>
<html lang="en">
<?php
        include_once("../../config.php");
     
        print_r($_SESSION['OTP']);
        if (isset($_POST['otpa']))  {
            if($_SESSION['OTP']==$_POST['otpa'].$_POST['otpb'].$_POST['otpc'].$_POST['otpd'] ){
              header("Location:http://nahami.online/sl/Dashboard/views/Member/FpwdNewPassword.php");  
            }
        else{
            $status = "Invaild security code";
        } 
        }
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Franchisee Login</title>
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/css/style.css">
  <link rel="shortcut icon" href="http://nahami.online/sl/Dashboard/images/favicon.png" />
  <script src="http://nahami.online/sl/Dashboard/vendors/js/vendor.bundle.base.js"></script>
  <script src="http://nahami.online/sl/Dashboard/vendors/js/vendor.bundle.addons.js"></script>
  <script src="http://nahami.online/sl/Dashboard/js/off-canvas.js"></script>
  <script src="http://nahami.online/sl/Dashboard/js/hoverable-collapse.html"></script>
  <script src="http://nahami.online/sl/Dashboard/js/misc.js"></script>
  <script src="http://nahami.online/sl/Dashboard/js/settings.html"></script>
  <script src="http://nahami.online/sl/Dashboard/js/todolist.html"></script>
  <script src="http://nahami.online/sl/Dashboard/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
</head>
<script>                                                             
$(document).ready(function () {
    $("#otpa").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#Errotp").html("Numeric value Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#otpa").blur(function () {
        IsNonEmpty("otpa","Errotp","Please Enter Security Code");
   });
   
     $("#otpb").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#Errotp").html("Numeric value Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#otpb").blur(function () {
        IsNonEmpty("otpb","Errotp","Please Enter Security Code");
   });
   
     $("#otpc").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#Errotp").html("Numeric value Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#otpc").blur(function () {
        IsNonEmpty("otpc","Errotp","Please Enter Security Code");
   });
   
     $("#otpd").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#Errotp").html("Numeric value Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#otpd").blur(function () {
        IsNonEmpty("otpd","Errotp","Please Enter Security Code");
   });
});

function Submitotp() {
                         $('#Errotp').html("");
                         
                         ErrorCount=0;
        
                   IsNonEmpty("otpa","Errotp","Please Enter Security Code"); 
                   IsNonEmpty("otpb","Errotp","Please Enter Security Code"); 
                   IsNonEmpty("otpc","Errotp","Please Enter Security Code"); 
                   IsNonEmpty("otpd","Errotp","Please Enter Security Code"); 
                        
                         
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;                           
                        }
                 
  }
</script>
<style>
.otpbox{
                   width:60px;
                   float:left;
                   text-align: center;
                   box-align:center;
                   border-radius:1px;
                  
               }
               .errorstring {font-size:10px;color:red}
</style>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
            <form method="POST" action="" onsubmit="return Submitotp();">
                <div class="form-group">
                <div align="center"><h5>Forget Password</h5></div>
                  <div class="input-group">
                    <small>We have sent an security code to your email. Please enter the code and continue</small>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                  <div class="a" id="otp">
                    <input type="text" class="form-control otpbox"  maxlength="1" id="otpa"  name="otpa" value="<?php echo (isset($_POST['otpa']) ? $_POST['otpa'] : "");?>">
                    <input type="text" class="form-control otpbox" maxlength="1" id="otpb"  name="otpb" value="<?php echo (isset($_POST['otpb']) ? $_POST['otpb'] : "");?>">
                    <input type="text" class="form-control otpbox" maxlength="1" id="otpc"  name="otpc" value="<?php echo (isset($_POST['otpc']) ? $_POST['otpc'] : "");?>">
                    <input type="text" class="form-control otpbox" maxlength="1" id="otpd"  name="otpd" style=" border-left-width:1px;" value="<?php echo (isset($_POST['otpd']) ? $_POST['otpd'] : "");?>">
                  </div>
                  <span class="errorstring" id="Errotp"><?php echo isset($status)? $status : "";?></span>
                </div>
                </div>
                <div class="form-group row">           
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary submit-btn btn-block">Continue</button></div>
                 <div class="col-sm-4"><a href="../ForgetPassword.php" class="text-small forgot-password text-black">try again</a>
                </div>
                </div>
                </form>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  