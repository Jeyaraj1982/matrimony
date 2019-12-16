<?php 
    $page="MyPrivacy"; 
    include_once("settings_header.php");
?>
    <form method="post" action="">
        <div class="col-sm-9" style="margin-top: -8px;">
            <h4 class="card-title" style="margin-bottom:5px">My Privacy</h4>
            <span style="color:#999;">Protect your personal data and you can control it shares data.</span><br><br>
            <?php
                if (isset($_POST['savprivacy'])) {         
                    $response = $webservice->getData("Member","UpdatePrivacy",$_POST);
                    echo  ($response['status']=="success") ? $dashboard->showSuccessMsg($response['message'])
                                                           : $dashboard->showErrorMsg($response['message']);
                } else {
                    $response = $webservice->getData("Member","GetMemberInfo");
                }
                $Member=$response['data'];
            ?> 
            <div class="form-group row" style="margin-bottom:0px">
				<div class="col-sm-6">
					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="VerfiedMembers" name="VerfiedMembers" <?php echo ($Member['PrivacyVerifiedMember']==1) ? ' checked="checked" ' :'';?>>
						<label class="custom-control-label" for="VerfiedMembers" style="vertical-align: middle;">Show photo for verified members</label>
					</div>
                </div>
            </div>
            <div class="form-group row" style="margin-bottom:0px">
				<div class="col-sm-6">
					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="nonVerfiedMembers" name="nonVerfiedMembers" <?php echo ($Member['PrivacyNonVerifiedMember']==1) ? ' checked="checked" ' :'';?>>
						<label class="custom-control-label" for="nonVerfiedMembers" style="vertical-align: middle;">Show photo for non verified members</label>
					</div>
                </div>
            </div>
            <br><br>
            <div class="form-group row">
                <div class="col-sm-3"><button type="submit" name="savprivacy" id="savprivacy" class="btn btn-primary" style="font-family:roboto">Update Privacy</button></div>
            </div>
        </div>
    </form>                
<?php include_once("settings_footer.php");?>