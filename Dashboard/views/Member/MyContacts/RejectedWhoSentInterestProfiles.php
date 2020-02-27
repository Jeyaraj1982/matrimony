<?php 
    $page="RejectedWhoSentInterestProfiles";
    include_once("WhoSentInterest_top_menu.php");
    $response = $webservice->getData("Member","GetRejectedWhoSentInterestMyProfiles");
?>
    <?php $Profiles = $response['data']; 
    if (sizeof($Profiles)>0) { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php 
                    foreach($Profiles as $Profile) { 
                        echo DisplayWhoSentInterestMyProfile($Profile);
                        echo "<br>";
                    }
                ?>  
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div style="margin:25px;margin-top:5px;padding:0px !important">
            <div class="card" style="padding:15px;">
                <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                    <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br><br><br>
                No recently Rejected profiles found at this time<br><br>
                    <br>
                </div>
            </div>
        </div>       
    <?php } ?>


             