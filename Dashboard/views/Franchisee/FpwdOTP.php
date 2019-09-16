<!DOCTYPE html>
<html lang="en">
<?php
      /*  include_once("../../../config.php");
     
        print_r($_SESSION['OTP']);
        if (isset($_POST['otpa']))  {
            if($_SESSION['OTP']==$_POST['otpa'].$_POST['otpb'].$_POST['otpc'].$_POST['otpd'] ){
              header("Location:".AppUrl."views/Franchisee/FpwdNewPassword.php");  
            }
        else{
            $status = "Invaild security code";
        } 
        }  */  ?>
          <?php
               include_once("../../../config.php");
            if (isset($_POST['btnVerifyCode'])) {
                 
                 $response = $webservice->getData("Franchisee","forgotPasswordOTPvalidation",$_POST);
                    if ($response['status']=="success") {
                         ?>
                          <form action="FpwdNewPassword.php" id="reqFrm" method="post">
                                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                                        <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
                                    </form>
                                    <script>
                                        document.getElementById("reqFrm").submit();
                                    </script>
                         <?php
                    }
                    else{
                        $errormessage = $response['message']; 
                    }  
              }                               
                  ?>
<head>                                                        
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Franchisee Login</title>
  <link rel="stylesheet" href="../../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.html"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.html"></script>
  <script src="../../assets/js/todolist.html"></script>
  <script src="../../assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
</head>
<body>
<script>
    function VerificationCode() {
        $('#Errscode').html("");
         return IsNonEmpty("scode","Errscode","Please enter a received verification code");
         return IsNumeric("scode","Errscode","Please enter Numeric characters only");
    }
</script>
<style>
.errorstring {font-size:10px;color:red}
</style>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <div class="form-group">
                <div align="center"><h5>Forget Password</h5></div>
                  <div class="input-group">
                    <small>We have sent an security code to your email. Please enter the code and continue.</small>
                  </div>
                </div>
                <div class="form-group">
                    <form action="" method="post" onsubmit="return VerificationCode()"> 
                        <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                        <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                        <input type="text" class="form-control" maxlength="4"   placeholder="Verification code here ..." id="scode" name="scode" value="<?php echo isset($_POST['scode']) ? $_POST['scode'] : '';?>" >
                        <span class="errorstring" id="Errscode"><?php echo isset($Errscode)? $Errscode : "";?></span>
                </div>
                <div class="form-group">
                    <?php
                    if (isset($errormessage)) {
                        echo "<span style='color:red;'>".$errormessage."</span><Br>";
                    }
                ?>
                  <button type="submit" class="btn btn-primary submit-btn btn-block" name="btnVerifyCode">Verify your code</button>
                </div>
                <hr>
                <div class="form-group d-flex justify-content-between">
                  <a href="ForgetPassword.php" class="text-small forgot-password text-black">Back to SignIn</a>
                </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  