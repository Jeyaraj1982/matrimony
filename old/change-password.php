<?php include_once("header.php");?>
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

}
.otpbox{
                   width:60px;
                   float:left;
                   text-align: center;
                   box-align:center;
                   border-radius:1px;
                  
               }
               .errorstring {color:red}
</style>
<script>/*                                                             
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
                 
  }   */
</script>
<!--<form method="POST" action="" onsubmit="return Submitotp();">
                <div class="form-group">
                <div align="center"><h5>Forget Password</h5></div>
                  <div class="input-group">
                    <p>We have sent an security code to your email. Please enter the code and continue</p>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                  <div class="a" id="otp">
                    <input type="text" class="otpbox"  maxlength="1" id="otpa"  name="otpa" value="<?php //echo (isset($_POST['otpa']) ? $_POST['otpa'] : "");?>">
                    <input type="text" class="otpbox" maxlength="1" id="otpb"  name="otpb" value="<?php //echo (isset($_POST['otpb']) ? $_POST['otpb'] : "");?>">
                    <input type="text" class="otpbox" maxlength="1" id="otpc"  name="otpc" value="<?php //echo (isset($_POST['otpc']) ? $_POST['otpc'] : "");?>">
                    <input type="text" class="otpbox" maxlength="1" id="otpd"  name="otpd" style=" border-left-width:1px;" value="<?php //echo (isset($_POST['otpd']) ? $_POST['otpd'] : "");?>">
                  </div>
                  <span class="errorstring" id="Errotp"><?php //echo isset($status)? $status : "";?></span>
                </div>
                </div>
                <div class="form-group row">           
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary submit-btn btn-block">Continue</button></div>
                 <div class="col-sm-4"><a href="../ForgetPassword.php" class="text-small forgot-password text-black">try again</a>
                </div>
                </div>
                </form>-->
         <nav class="navbar dashboard-menu">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="navbar-header">
                            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-inverse side-collapse in">
                            <div role="navigation" class="navbar-collapse" id="scroll-submenu1" style="height: auto;">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm visible-md visible-lg disabled dropdown-toggle" data-toggle="dropdown" href="my_matrimony.php">My Home</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-home.png"></span> My Home <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm disabled visible-md visible-lg dropdown-toggle " data-toggle="dropdown" href="recommended_matches.php">Matches</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle " data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-matches2.png"></span> Matches <span class="fa fa-angle-down"></span></a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="search_index.php">Search</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-search.png"></span> Search <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php">Messages</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-messages.png"></span> Messages <span class="fa fa-angle-down"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right user-profile">
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="help.php">Help</a>
                        </li>
                        <li class="dropdown drpprofile">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">

                                <img class="img-circle" src="">
                                <span class="fa fa-angle-down"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
         </nav> 
<script>
$(document).ready(function () {
   $("#newpassword").blur(function () {
        if (IsNonEmpty("newpassword","Errnewpassword","Please Enter New Password")) {
        IsFPassword("newpassword","Errnewpassword","Please Enter more than 6 Characters");
        }
                        
   });
$("#confirmnewpassword").blur(function () {
                                                                                                            
        if (IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Enter Confirm New Password")) {
        IsFPassword("confirmnewpassword","Errconfirmnewpassword","Please Enter more than 6 Characters");
        }                
   });
});

function SubmitPassword() {
                        $('#Errnewpassword').html("");
                        $('#Errconfirmnewpassword').html("");
                         ErrorCount=0;
                         IsNonEmpty("newpassword","Errnewpassword","Please Enter New Password")
                        IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Enter Confirm New Password")
                        if (ErrorCount>0) {
                            return false;
                        }
                        
                       var password = document.getElementById("newpassword").value;
                       var confirmPassword = document.getElementById("confirmnewpassword").value;
                             if (password != confirmPassword) {
                                 ErrorCount++;
                               $('#Errconfirmnewpassword').html("Passwords do not match.");
                              
                                }
                             
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
</script>         
         <div class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div style="background:white ;height: 310px;width: 361px;margin-top: 50px;margin-bottom:110px;padding-top:34px;border-radius: 10px;margin-left: 373px;padding-left:35px;padding-right:35px">
                               <p style="text-align: center;color: #E3425B;font-size: 21px;">Change Password</p>
            <?php
               
            if (isset($_POST['btnResetPassword'])) {
                 $response = $webservice->getData("Member","forgotPasswordchangePassword",$_POST);
                    if ($response['status']=="success") {
                         ?>
                          <form action="password-changed" id="reqFrm" method="post">
                                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                                        <input type="hidden" value="<?php echo $response['data']['reqEmail'];?>" name="reqEmail">
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
              <p style="margin-bottom: -10px;">Please enter new password bellow boxes and click "Save Password".</p> <br>               
              <form action="" method="post" onsubmit="return SubmitPassword();">
               <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
              
                <input type="password" placeholder="New Password" name="newpassword" id="newpassword" style="width: 100%;padding:7px;margin-bottom:10px" value="<?php echo isset($_POST['newpassword']) ? $_POST['newpassword'] : '';?>">
                <span class="errorstring" id="Errnewpassword"><?php echo isset($Errnewpassword)? $Errnewpassword : "";?>  </span>
                <input type="password" placeholder="  Confrim New Password" name="confirmnewpassword" id="confirmnewpassword" style="width: 100%;padding:7px;margin-bottom:10px" value="<?php echo isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';?>">
                 <span class="errorstring" id="Errconfirmnewpassword"><?php echo isset($Errconfirmnewpassword)? $Errconfirmnewpassword : "";?> </span>
                <?php
                    if (isset($errormessage)) {
                        echo "<span style='color:red;'>".$errormessage."</span><Br>";
                    }
                ?>
                <input type="submit" value="Save Password" name="btnResetPassword"  class="btn btn-primary" style="width: 100%;">
                
              </form>
                        </div>
                    </div>
                    </div>
                    
                    </div>
                </div>
        </div>
         <?php include_once("footer.php");?>
         
        <?php
               
            /*if (isset($_POST['btnResetPassword'])) {
                
                 $response = $webservice->forgotPasswordchangePassword($_POST);
                    if ($response['status']=="success") {
                         ?>
                          <form action="password-changed" id="reqFrm" method="post">
                                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                                        <input type="hidden" value="<?php echo $response['data']['reqEmail'];?>" name="reqEmail">
                                    </form>
                                    <script>
                                        document.getElementById("reqFrm").submit();
                                    </script>
                         <?php
                    } 
                    else{
                        $errormessage = $response['message']; 
                    }
              }    */                           
                 
               ?>