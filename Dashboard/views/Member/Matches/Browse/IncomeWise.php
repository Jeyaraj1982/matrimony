<?php 
    $page="IncomeWise";
    include_once("browse_topmenu.php");
    $response = $webservice->getData("Matches","MatchesReligion",array()); 
?>
<?php if ($response['status']=="failed") {?>
<div style="margin:25px;margin-top:5px;padding:0px !important">
    <div class="card" style="padding:15px;">
        <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
            <!--<img src="<?php // echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
            No profiles found in your account<br><Br><br><Br><br><Br>  -->
            <?php echo $response['message'];?><br>  
            <?php if($response['data']['param']=="mobile") {?>
                  <a href="javascript:void(0)" onclick="MobileNumberVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verfiy now</a>
            <?php }?>
            <?php if($response['data']['param']=="email") {?>
                  <a href="javascript:void(0)" onclick="EmailVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verfiy now</a>
            <?php }?>
            <?php if($response['data']['param']=="profile") {?>
                  <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
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
                    No profiles found, for matched your income<br><Br><br><Br><br><Br>
                    <br>
                </div>
            </div>
        </div>       
    <?php } ?>
<?php } ?>


             
             
             
             
             
             