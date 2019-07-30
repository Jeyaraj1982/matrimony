
<style>
    .bshadow {
        -webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        -moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
    }
    .box-shaddow {
        box-shadow: 0 0 5px #e9e9e9 !important;
        -moz-box-shadow: 0 0 5px #e9e9e9 !important;
        -webkit-box-shadow: 0 0 24px #e9e9e9 !important;
    }
</style>
<?php
    $response = $webservice->getData("Member","DownloadedProfiles",array());
    $Profiles = $response['data']['Profiles']; 
    $ProfileDetails = $response['data']['ProfileDetails']; 
    if (sizeof($Profiles)>0) {
?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Download Profiles</h4>
                    <?php foreach($Profiles as $Profile) { 
                        echo DisplayProfileShortInfo($Profile);
                        ?>
                       
                        <br> 
                        <?php }?>                                                                     
                        
                </div>
            </div>
    <?php     } else   { ?>

        <div class="col-lg-12 grid-margin stretch-card bshadow" style="background:#fff;padding:90px;">
            <div class="card">
                <div class="card-body" style="text-align:center;font-family:'Roboto'">
                    <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br> 
            No downloaded profiles found at this time<br><br>
                </div>
            </div>
        </div>

        <?php } ?>

