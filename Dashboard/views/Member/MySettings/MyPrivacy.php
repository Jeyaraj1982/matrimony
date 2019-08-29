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
                    $response = $webservice->GetMemberInfo();
                }
                $Member=$response['data'];
            ?> 
            <div class="form-group row" style="margin-bottom:0px">
                <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="VerfiedMembers"  name="VerfiedMembers"  <?php echo ($Member['PrivacyVerifiedMember']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                <label for="VerfiedMembers" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Show photo for verified members</label>
            </div>
            <div class="form-group row" style="margin-bottom:0px">
                <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="nonVerfiedMembers" name="nonVerfiedMembers" <?php echo ($Member['PrivacyNonVerifiedMember']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                <label for="nonVerfiedMembers" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Show photo for non verified members</label>
            </div>
            <br><br>
            <div class="form-group row">
                <div class="col-sm-3"><button type="submit" name="savprivacy" id="savprivacy" class="btn btn-primary" style="font-family:roboto">Update Privacy</button></div>
            </div>
        </div>
    </form>                
<?php include_once("settings_footer.php");?>