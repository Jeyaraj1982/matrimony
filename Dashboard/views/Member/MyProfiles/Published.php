<style>
    .bshadow {-webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);-moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);}
    .box-shaddow {box-shadow: 0 0 5px #e9e9e9 !important;-moz-box-shadow: 0 0 5px #e9e9e9 !important;-webkit-box-shadow: 0 0 24px #e9e9e9 !important;}
</style>
<?php
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"Published"));
    if (sizeof($response['data'])>0) {
?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title" style="margin-bottom: 5px;">Manage Profiles</h4>
                    <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;font-weight: normal;font-size: 13px;">Published Profiles</h4>
                    <div class="form-group row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="ManageProfile"><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                            <a href="Drafted"><small style="font-weight:bold;text-decoration:underline">Drafted</small></a>&nbsp;|&nbsp;
                            <a href="Posted"><small style="font-weight:bold;text-decoration:underline">Posted</small></a>&nbsp;|&nbsp;
                            <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a>
                        </div>
                    </div>
                        <?php foreach($response['data'] as $Profile) { 
                         echo  PublishedProfileList($Profile); ?> <br> <?php    }?>
                        <br>
                </div>
            </div>
    <?php } else { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="margin-bottom: 5px;">Manage Profiles</h4>
                    <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;font-weight: normal;font-size: 13px;">Published Profiles</h4>
                    <div class="form-group row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="ManageProfile"><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                            <a href="Drafted"><small style="font-weight:bold;text-decoration:underline">Drafted</small></a>&nbsp;|&nbsp;
                            <a href="Posted"><small style="font-weight:bold;text-decoration:underline">Posted</small></a>&nbsp;|&nbsp;
                            <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="card-body" style="padding:80px;padding-bottom:200px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found in your account
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <?php } ?>
        