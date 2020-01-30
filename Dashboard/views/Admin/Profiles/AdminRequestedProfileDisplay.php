
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
     $response = $webservice->getData("Admin","GetProfilesRequestVerifyFrAdmin");
	
    if (sizeof($response['data'])>0) {
?>
    <form method="post" onsubmit="">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                <div class="col-sm-6">
                     <h4 class="card-title">Profile Requested</h4>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    <a href="<?php echo GetUrl("Profiles/Requested");?>"><img src="<?php echo SiteUrl?>assets/images/listicon.svg" style="width:30px"></a>&nbsp;&nbsp;
                    <a href="<?php echo GetUrl("Profiles/RequestedProfileDisplay");?>"><img src="<?php echo SiteUrl?>assets/images/rectangleListicon.svg" style="width:30px"></a>
                </div>
            </div>
                   <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                            ?>
                        
                       <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $ProfileInformation['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-6">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-5" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br>
                                                <?php if($Profile['IsApproved']==1 && $Profile['RequestToVerify']==1){  ?> 
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br> <?php } ?>
                                                <?php if($Profile['IsApproved']==0 && $Profile['RequestToVerify']==1){     echo "Submitted On: ".time_elapsed_string($Profile['RequestVerifyOn']); }?>
                                                 <?php if($Profile['IsApproved']==0 && $Profile['RequestToVerify']==0){    echo "Last Saved: ".time_elapsed_string($Profile['LastUpdatedOn']);  }?>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
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
                           <div style="float:right;line-height: 1px;">
                                <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==0){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                    <?php } elseif($Profile['IsApproved']==1){  ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                    <?php } else {?>
                                        <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                        <?php  }    ?>     
                            </div>
                        </div>
                        <br>
                         <?php    }?>
                        <br>
                </div>
            </div>
    </form>
    <?php     } else   { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                 <div class="form-group row">
                <div class="col-sm-6">
                     <h4 class="card-title">Profile Requested</h4>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    <a href="<?php echo GetUrl("Profiles/Requested");?>"><img src="<?php echo SiteUrl?>assets/images/listicon.svg" style="width:30px"></a>&nbsp;&nbsp;
                    <a href="<?php echo GetUrl("Profiles/RequestedProfileDisplay");?>"><img src="<?php echo SiteUrl?>assets/images/rectangleListicon.svg" style="width:30px"></a>
                </div>
            </div>
                    <br>
                    <br>
                    <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found in your account
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <?php } ?>
        