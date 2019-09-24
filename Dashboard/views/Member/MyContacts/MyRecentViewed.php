<div class="col-12 grid-margin" style="padding:0px !important">
    <div class="card">
        <div class="card-body" style="padding:15px !important">
            <h4 class="card-title" style="font-size: 22px;margin-top:0px;margin-bottom:15px">My Recently Viewed Profiles</h4>
            <h5 style="color:#666">This page gives you quick access to view recently viewed profiles by you.</h5>
        </div>
    </div>
</div> 
<div class="col-lg-12 grid-margin stretch-card"  style="padding:0px !important;">
<?php
    $response = $webservice->getData("Member","GetRecentlyViewedProfiles",array("ProfileFrom"=>"All"));
    $Profiles = $response['data']; 
    if (sizeof($Profiles)>0) {
?>
    <div class="card">
        <div class="card-body">
                <?php 
                    foreach($Profiles as $Profile) { 
                        echo DisplayMyRecentViewedProfileShortInformation($Profile);
                        echo "<br>";
                    }
                ?>                                                                     
        </div>
    </div>
<?php  } else { ?>
    <div class="col-lg-12 grid-margin stretch-card bshadow" style="background:#fff;padding:90px;">
        <div class="card">
            <div class="card-body" style="text-align:center;font-family:'Roboto'">
                <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br> 
                No recently viewed profiles found at this time<br><br>
            </div>
        </div>
    </div>
<?php } ?>                                                                                                       
</div>  