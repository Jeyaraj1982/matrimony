<?php
$page="ChangePassword";
    if (isset($_POST['BtnUpdatePassword'])) {
        $response = $webservice->MemberChangePassword($_POST);
        if ($response['status']=="success") {
            unset($_POST);
           $sucessmessage=$response['message'];
           ?>
        <script>location.href='http://nahami.online/sl/Dashboard/MySettings/ChangepwdCompleted';</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
?>
<script>

$(document).ready(function () {
$("#CurrentPassword").blur(function () {
    
        IsNonEmpty("CurrentPassword","ErrCurrentPassword","Please Enter Current Password");
                        
   });
   $("#NewPassword").blur(function () {
    
        IsNonEmpty("NewPassword","ErrNewPassword","Please Enter New Password");
                        
   });
   $("#ConfirmNewPassword").blur(function () {
                                                                                                            
        IsNonEmpty("ConfirmNewPassword","ErrConfirmNewPassword","Please Confirm New Password");
                        
   });
   
});
     
                                                                                      
    function SubmitChangePassword() {
                        $('#ErrCurrentPassword').html("");
                        $('#ErrNewPassword').html("");
                        $('#ErrConfirmNewPassword').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("CurrentPassword","ErrCurrentPassword","Please Enter Current Password");
                        if (IsNonEmpty("NewPassword","ErrNewPassword","Please Enter New Password")) {
                        IsAlphaNumeric("NewPassword","ErrNewPassword","Alpha Numeric Characters only");
                        }
                        if (IsNonEmpty("ConfirmNewPassword","ErrConfirmNewPassword","Please Enter Confirm New Password")) {
                        IsAlphaNumeric("ConfirmNewPassword","ErrConfirmNewPassword","Alpha Numeric Characters only");
                        }
                        
                       var password = document.getElementById("NewPassword").value;
                       var confirmPassword = document.getElementById("ConfirmNewPassword").value;
                             if (password != confirmPassword) {
                                 ErrorCount++;
                               $('#ErrConfirmNewPassword').html("Passwords do not match.");
                              
                                }
                             
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="font-size: 22px;">My Settings</h4>
                <h5 style="color:#666">Control, protect and secure your account, all in one place.</h5>
                <h6 style="color:#999">This page gives you quick access to settings and tools that let you safeguard your data, protect your privacy and decide how your information can make us.</h6>
            </div>
        </div>
</div>
<form method="post" action="" onsubmit="return SubmitChangePassword();">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="form-group-row">
            <div class="col-sm-12">
            <div class="col-sm-3" style="width: 21%;">
            <div class="sidemenu" style="width: 200px;margin-left: -58px;margin-top: -30px;margin-bottom: -41px;border-right: 1px solid #eee;">
                <?php include_once("sidemenu.php");?>
            </div>
            </div>
            <div class="col-sm-9" style="margin-top: -8px;">
              <h4 class="card-title">Change Password</h4>
             <form class="forms-sample">
                <div class="form-group">
                  <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" value="<?php echo (isset($_POST['CurrentPassword']) ? $_POST['CurrentPassword'] : "");?>" placeholder="Enter Current Password">
                  <span class="errorstring" id="ErrCurrentPassword"><?php echo isset($ErrCurrentPassword)? $ErrCurrentPassword : "";?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="NewPassword"  name="NewPassword" value="<?php echo (isset($_POST['NewPassword']) ? $_POST['NewPassword'] : "");?>" placeholder="New Password">
                  <span class="errorstring" id="ErrNewPassword"><?php echo isset($ErrNewPassword)? $ErrNewPassword : "";?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="ConfirmNewPassword"  name="ConfirmNewPassword" value="<?php echo (isset($_POST['ConfirmNewPassword']) ? $_POST['ConfirmNewPassword'] : "");?>" placeholder="Confirm New Password">
                  <span class="errorstring" id="ErrConfirmNewPassword"><?php echo isset($ErrConfirmNewPassword)? $ErrConfirmNewPassword : "";?></span>
                </div>
               <button type="submit" name="BtnUpdatePassword" class="btn btn-primary mr-2" style="font-family: roboto;">Change Password</button>
               <div class="col-sm-12" style="text-align: center;color:red"><?php echo $sucessmessage ;?></div>  
               <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
  </div>
</form>                
                