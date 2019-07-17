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
                    <?php foreach($response['data'] as $Profile) { ?>
                        <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center">
                                    <img src="<?php echo SiteUrl?>assets/images/prof1.jpg" style="height: 159px;margin-bottom: -18px;">
                                    <button type="button" class="btn btn-primary" style="padding: 0px 0px;font-size: 13px;margin-top: 8px;">Add a Photo</button>
                                </div>
                                <div class="col-sm-9">
                                    <div style="border-bottom:1px solid #d7d7d7;width:100%;padding-bottom: 10px;font-size: 21px;color: #514444cc;">
                                        <?php echo $Profile['ProfileName'];?>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['City'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Occupation'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        Am a very simple man by nature I love to learn from people I like travelling I love people that love I love to learn from people I like travelling I love people that love......<a href="<?php echo GetUrl(" MyProfiles/View/ ". $Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                                <?php if($Profile['IsApproved']==1){?>
                                    <a href="<?php echo GetUrl("MyProfiles/View/". $Profile['ProfileID'].".htm ");?>">View</a>
                                    <?php }else{  ?>
                                        <a href="<?php echo GetUrl("MyProfiles/Edit/GeneralInformation/". $Profile['ProfileID'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl(" MyProfiles/View/ ". $Profile['ProfileID'].".htm ");?>">View</a>
                                    <?php  }    ?>
                            </div>
                        </div>
                        <br>
                        <?php }?>
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