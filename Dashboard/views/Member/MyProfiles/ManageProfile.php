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
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"All")); 
    if (sizeof($response['data'])>0) {
?>
    <form method="post" action="<?php echo GetUrl(" MyProfiles/CreateProfile ");?>" onsubmit="">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Profiles</h4>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <!--<button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Profile</button>-->
                        </div>
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="Drafted"><small style="font-weight:bold;text-decoration:underline">Drafted</small></a>&nbsp;|&nbsp;
                            <a href="Posted"><small style="font-weight:bold;text-decoration:underline">Posted</small></a>&nbsp;|&nbsp;
                            <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a><!-- &nbsp;|&nbsp;
                            <a href="Expired"><small style="font-weight:bold;text-decoration:underline">Expired</small></a>&nbsp;|&nbsp;
                            <a href="#"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>-->
                        </div>
                    </div>                                
                    <br>
                    <br>
                        <?php foreach($response['data'] as $Profile) {  echo DisplayManageProfileShortInfo($Profile);   }?>
                        <br>
                </div>
            </div>
    </form>
    <?php     } else   { ?>

        <div class="col-lg-12 grid-margin stretch-card bshadow" style="background:#fff;padding:90px;">
            <div class="card">
                <div class="card-body" style="text-align:center;font-family:'Roboto'">
                    <img src="<?php echo AppUrl;?>assets/images/noprofile.jpg">
                    <Br>
                    <div style="padding:30px;padding-top:10px;font-size:20px;color:#ccc;font-family:'Roboto'">There are no profiles</div>

                    <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
                    <!-- <?php echo GetUrl("Profile/CreateProfile");?>-->
                </div>
            </div>
        </div>

        <?php } ?>