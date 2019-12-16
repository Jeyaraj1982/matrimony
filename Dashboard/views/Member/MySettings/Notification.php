<?php 
    $page="Notification";    
    include_once("settings_header.php");
?>
    <form method="post" action="">
        <div class="col-sm-9" style="margin-top: -8px;">
            <h4 class="card-title" style="margin-bottom:5px">Notifications & actions</h4>
            <span style="color:#999;">Select your preferences for notifications that are the most common for all members</span><br><Br> 
            <?php
                if (isset($_POST['savnotification'])) {
                    $response = $webservice->getData("Member","UpdateNotification",$_POST);
                    echo  ($response['status']=="success") ? $dashboard->showSuccessMsg($response['message'])
                                                           : $dashboard->showErrorMsg($response['message']);
                } else {
                    $response = $webservice->getData("Member","GetMemberInfo");
                }
                $Member=$response['data'];
            ?>
            <div class="form-group row" style="margin-bottom:0px;">
				<div class="col-sm-6">
					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="Sms" name="Sms" <?php echo ($Member['SMSNotification']==1) ? ' checked="checked" ' :'';?>>
						<label class="custom-control-label" for="Sms" style="vertical-align: middle;">SMS Notification</label>
					</div>
                </div>
            </div>
			<div class="form-group row" style="margin-bottom:0px;">
				<div class="col-sm-6">
					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="Email" name="Email" <?php echo ($Member['EmailNotification']==1) ? ' checked="checked" ' :'';?>>
						<label class="custom-control-label" for="Email" style="vertical-align: middle;">Email Notification</label>
					</div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-3"><button type="submit" name="savnotification" id="savprivacy" class="btn btn-primary" style="font-family:roboto">Update Notifications</button></div>
            </div>
        </div>
    </form>                
<?php include_once("settings_footer.php");?>                   