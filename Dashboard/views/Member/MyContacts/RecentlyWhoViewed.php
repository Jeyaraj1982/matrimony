<div class="col-12 grid-margin bshadow padding0">
    <div class="card">
        <div class="card-body padding15">
            <h4 class="card-title widget_title">Recently who viewed my profile</h4>
            <h5 class="widget_subtitle">This page gives you quick access to view recently who viewed my profile.</h5>
        </div>
    </div>
</div> 
<div class="col-lg-12 grid-margin stretch-card padding0">
<?php
    $response = $webservice->getData("Member","GetRecentlyWhoViewedProfiles");
    if (sizeof($response['data'])>0) {
?>
    <div class="card">
        <div class="card-body">
                <?php 
                    foreach($response['data'] as $Profile) { 
                        echo DisplayProfileShortInformation($Profile);
                        echo "<br>";
                    }
                ?>                                                                     
        </div>
    </div>
<?php  } else { ?>
    <div class="col-lg-12 grid-margin stretch-card bshadow padding90 bgwhite">
        <div class="card">
            <div class="card-body widget_message">
                <img src="<?php echo ImageUrl;?>noprofile.svg"><Br><Br><Br>  
                <?php echo $lang['no_profiles_who_viewed_your_profile'];?><br><br>
            </div>
        </div>
    </div>
<?php } ?>
</div> 