<?php 
    $page="OccupationWise";
    include_once("browse_topmenu.php");
    $response = $webservice->getData("Matches","MatchesReligion",array()); 
?>    
<?php if ($response['status']=="failed") {?>
<div style="margin:25px;margin-top:5px;padding:0px !important">
    <div class="card" style="padding:15px;">
        <div class="card-body" style="padding-top:80px;padding-bottom:80px;text-align:center;color:#aaa">
            <?php if($response['data']['param']=="mobile") {?>
                <img src="<?php echo ImageUrl;?>mobile_number_not_verfied.png"><br><br><br>
                <?php echo $response['message'];?><br><br><a href="javascript:void(0)" onclick="MobileNumberVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verify now</a>
            <?php }?>
            <?php if($response['data']['param']=="email") {?>   
                <img src="<?php echo ImageUrl;?>email_address_not_verified.png"><br><br><br>
                <?php echo $response['message'];?><br><br><a href="javascript:void(0)" onclick="EmailVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verify now</a>
            <?php }?>
            <?php if($response['data']['param']=="profile") {?>
                <img src="<?php echo ImageUrl;?>profile_informations.png" style="width:128px"><br><br><br>
                <?php echo $response['message'];?><br><br><a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
            <?php }?>
            <br>
        </div>
    </div>
</div>
<?php }  else { ?>
    <?php if (sizeof($response['data'])>0) { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php 
                        foreach($response['data'] as $Profile) {   
                            echo DisplayBrowseMatchesProfileShortInformation($Profile); ?><br>
                     <?php    }
                    ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div style="margin:25px;margin-top:5px;padding:0px !important">
            <div class="card" style="padding:15px;">
                <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                    <img src="<?php // echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
                    No profiles found, for matched your occupation<br><Br><br><Br><br><Br>
                    <br>
                </div>
            </div>
        </div>       
    <?php } ?>
<?php } ?>
 
             
             
             
             
             