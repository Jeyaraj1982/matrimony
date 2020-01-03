<?php
    $page="ChangeTxnPassword";
    if (isset($_POST['BtnUpdatePassword'])) {
        $response = $webservice->getData("Franchisee","ChangeTransactionPassword",$_POST); 
        if ($response['status']=="success") {
            unset($_POST);
           $sucessmessage=$response['message'];
           ?>
        <script>location.href='<?php echo AppUrl;?>MySettings/ChangeTxnpwdCompleted';</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
?>
<script>
    $(document).ready(function () {
        $("#CurrentTransactionPassword").blur(function () {
            IsNonEmpty("CurrentTransactionPassword","ErrCurrentTransactionPassword","Please Enter Current Transaction Password");
        });
        $("#NewTransactionPassword").blur(function () {    
            if(IsNonEmpty("NewTransactionPassword","ErrNewTransactionPassword","Please Enter New Transaction Password")){
            IsPassword("NewTransactionPassword","ErrNewTransactionPassword","Please Enter more than 6 characters");
        }
        });
        $("#ConfirmNewTransactionPassword").blur(function () { 
            if(IsNonEmpty("ConfirmNewTransactionPassword","ErrConfirmNewTransactionPassword","Please Enter Confirm New Transaction Password")){
        IsPassword("ConfirmNewTransactionPassword","ErrConfirmNewTransactionPassword","Please Enter more than 6 characters");
         }
        });
    });
    
    function SubmitChangePassword() {
        $('#ErrCurrentTransactionPassword').html("");
        $('#ErrNewTransactionPassword').html("");
        $('#ErrConfirmNewPassword').html("");
        
        ErrorCount=0;
        
        IsNonEmpty("CurrentTransactionPassword","ErrCurrentTransactionPassword","Please Enter Current Transaction Password");
         if(IsNonEmpty("NewTransactionPassword","ErrNewTransactionPassword","Please Enter New Transaction Password")){
            IsPassword("NewTransactionPassword","ErrNewTransactionPassword","Please Enter more than 6 characters");
        }
		if(IsNonEmpty("ConfirmNewTransactionPassword","ErrConfirmNewTransactionPassword","Please Enter Confirm New Transaction Password")){
        IsPassword("ConfirmNewTransactionPassword","ErrConfirmNewTransactionPassword","Please Enter more than 6 characters");
         }
        
        var password = document.getElementById("NewTransactionPassword").value;
        var confirmPassword = document.getElementById("ConfirmNewTransactionPassword").value;
        if (password != confirmPassword) {
            ErrorCount++;
            $('#ErrConfirmNewTransactionPassword').html("Passwords do not match.");
        }

        return (ErrorCount==0) ? true : false;
    }
</script>
<?php include_once("settings_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Change Transaction Password</h4>
        <form class="forms-sample" method="post" action="" onsubmit="return SubmitChangePassword();">
            <div class="form-group">
                <input type="password" class="form-control" id="CurrentTransactionPassword" name="CurrentTransactionPassword" value="<?php echo (isset($_POST['CurrentTransactionPassword']) ? $_POST['CurrentTransactionPassword'] : "");?>" placeholder="Current Transaction Password">
                <span class="errorstring" id="ErrCurrentTransactionPassword"><?php echo isset($ErrCurrentTransactionPassword)? $ErrCurrentTransactionPassword : "";?></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="NewTransactionPassword"  name="NewTransactionPassword" value="<?php echo (isset($_POST['NewTransactionPassword']) ? $_POST['NewTransactionPassword'] : "");?>" placeholder="New Transaction Password">
                <span class="errorstring" id="ErrNewTransactionPassword"><?php echo isset($ErrNewTransactionPassword)? $ErrNewTransactionPassword : "";?></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="ConfirmNewTransactionPassword"  name="ConfirmNewTransactionPassword" value="<?php echo (isset($_POST['ConfirmNewTransactionPassword']) ? $_POST['ConfirmNewTransactionPassword'] : "");?>" placeholder="Confirm New Transaction Password">
                <span class="errorstring" id="ErrConfirmNewTransactionPassword"><?php echo isset($ErrConfirmNewTransactionPassword)? $ErrConfirmNewTransactionPassword : "";?></span>
            </div>
            <button type="submit" name="BtnUpdatePassword" class="btn btn-primary mr-2" style="font-family: roboto;">Change Transaction Password</button>
            <div class="col-sm-12" style="text-align: center;color:red"><?php echo $sucessmessage ;?></div>  
            <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>
        </form>
    </div>
<?php include_once("settings_footer.php");?>    