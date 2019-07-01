<?php
    $page="Notification";
                   
  if (isset($_POST['savnotification'])) {         
    $response = $webservice->UpdateNotification($_POST);
    if ($response['status']=="success") {
           $successmessage= $response['message'];
    } else {
        $errormessage = $response['message']; 
    }
    }
    $res = $webservice->GetMemberInfo();
    $Member=$res['data'];
?>  
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title" style="margin-bottom:5px">Notifications & actions</h4>
        <span style="color:#999;">Select your preferences for notifications that are the most common for all members</span><br><Br><br>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-1" style="margin-right: -23px;">
            <input type="checkbox"  id="Sms" name="Sms" <?php echo ($Member['SMSNotification']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
            <label for="Sms" class="col-sm-11" style="margin-top: 2px;color:#444">SMS Notification</label>
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-1" style="margin-right: -23px;">
            <input type="checkbox"  id="Email" name="Email" <?php echo ($Member['EmailNotification']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
            <label for="Email" class="col-sm-11" style="margin-top: 2px;color:#444">Email Notification</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php echo $successmessage;?><?php echo $errormessage; ?></div>
        </div>
        <br><br>
        <div class="form-group row">
            <div class="col-sm-3"><button type="submit" name="savnotification" id="savprivacy" class="btn btn-primary" style="font-family:roboto">Update Notifications</button></div>
        </div>
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   