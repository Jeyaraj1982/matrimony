<?php
    $page="ChangePassword";
    if (isset($_POST['BtnUpdatePassword'])) {
        $response = $webservice->getData("Member","MemberChangePassword",$_POST); 
        if ($response['status']=="success") {
            unset($_POST);
           $sucessmessage=$response['message'];
           ?>
        <script>location.href='<?php echo AppUrl;?>MySettings/ChangepwdCompleted';</script>
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

        return (ErrorCount==0) ? true : false;
    }
</script>
<?php include_once("settings_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Change Password</h4>
        <form class="forms-sample" method="post" action="" onsubmit="return SubmitChangePassword();">
            <div class="form-group">
                <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" value="<?php echo (isset($_POST['CurrentPassword']) ? $_POST['CurrentPassword'] : "");?>" placeholder="Current Password">
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
<?php include_once("settings_footer.php");?>    