<style>
    .content-wrapper {
        padding: 0px !important;
        padding-left: 2px !important;
    }
</style>
<?php $page="MyFavorited";?>
    <form method="post" action="" onsubmit="">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php  
                         $response = $webservice->getData("Franchisee","GetMemberProfileData",array("ProfileCode"=>$_GET['Code'], "request"=>"MyFavorited"));      
                            $Profile = $response['data']['primarydata']['ProfileInfo'];
                            ?>
                            <div style="min-height: 200px;width:100%;background:white;padding:20px" >
                                <div class="form-group row">
                                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                        <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;
                                            <?php echo $Profile['ProfileCode'];?>
                                        </div>
                                        <img src="<?php echo $response['data']['primarydata']['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                        <div style="line-height: 25px;color: #867c7c;font-size:14px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                            <div class="form-group row">
                                                <div class="col-sm-8">
                                                    <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (
                                                        <?php echo $Profile['Age'];?> Yrs) </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7">
                                                    <div style="line-height: 25px;color: #867c7c;font-size:14px">
                                                        <?php echo $Profile['City'];?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div>
                                                <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                    <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?>
                                                        <br>
                                                        <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?>
                                                            <br>
                                                            <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                                                <br>
                                                                <br>
                                                </div>
                                            </div>
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
                                                <?php echo $Profile['OccupationType'];?>
                                            </div>
                                            <div>
                                                <?php echo $Profile['AnnualIncome'];?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                            <?php echo $Profile['AboutMe'];?>
                                        </div>
                                        <div class="col-sm-12">
                                    <div style="float:right;">
                                        <a href="<?php echo GetUrl("ViewPublishedProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                    </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                         <?php include_once("ProfileDetailsTopMenu.php");?>
                                <?php 
                        foreach($response['data']['results']   as $result) { 
                            $Profile = $result['ProfileInfo'];
                           
                            ?>
                                    <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                                        <div class="form-group row">
                                            <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;
                                                    <?php echo $Profile['ProfileCode'];?>
                                                </div>
                                                <img src="<?php echo $result['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px;">
                                                    <?php echo $Profile['Position'];?>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (
                                                                <?php echo $Profile['Age'];?> Yrs) 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-7">
                                                            <div style="line-height: 25px;color: #867c7c;font-size:14px">
                                                                <?php echo $Profile['City'];?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div>
                                                        <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                            <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?>
                                                                <br>
                                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?>
                                                                    <br>
                                                                        <br>
                                                        </div>
                                                    </div>
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
                                                        <?php echo $Profile['OccupationType'];?>
                                                    </div>
                                                    <div>
                                                        <?php echo $Profile['AnnualIncome'];?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                                    <?php echo $Profile['AboutMe'];?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                    <div style="float:right;line-height: 1px;">
                                        <a href="<?php echo GetUrl("ViewPublishedProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                    </div>
                            </div>
                                    </div>
                                    <br>  
                                  
                                    <?php } ?>

                </div>
            </div>
        </div>
    </form>