<?php
    if (isset($_POST['BtnUpdatePassword'])) {
               $getpassword = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_SESSION['UserDetails']['PersonID']."'");
        if ($getpassword[0]['LoginPassword']==$_POST['CurrentPassword']) {
        $ChangePasswordID = $mysql->execute("update  _tbl_franchisees_staffs set LoginPassword='".$_POST['ConfirmNewPassword']."' where PersonID='".$_SESSION['UserDetails']['PersonID']."'" );
        echo "Successfully Updated";
        } else {
            $errorCurrentPassword = "Current Password is wrong";
            echo "$errorCurrentPassword";
        }
      }
?>
<script>

$(document).ready(function () {
    /*$('#NewPassword, #ConfirmNewPassword').on('keyup', function () {
  if ($('#NewPassword').val() == $('#ConfirmNewPassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
}); */
                                                                           
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
<form method="post" action="" onsubmit="return SubmitChangePassword();">
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Change Password</h4>
             <form class="forms-sample">
                <div class="form-group">
                  <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" placeholder="Enter Current Password">
                  <span class="errorstring" id="ErrCurrentPassword"><?php echo isset($ErrCurrentPassword)? $ErrCurrentPassword : "";?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="NewPassword"  name="NewPassword" placeholder="New Password">
                  <span class="errorstring" id="ErrNewPassword"><?php echo isset($ErrNewPassword)? $ErrNewPassword : "";?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="ConfirmNewPassword"  name="ConfirmNewPassword" placeholder="Confirm New Password">
                  <span class="errorstring" id="ErrConfirmNewPassword"><?php echo isset($ErrConfirmNewPassword)? $ErrConfirmNewPassword: "";?></span>
                </div>
               <button type="submit" name="BtnUpdatePassword" class="btn btn-success mr-2">Change Password</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</form>  