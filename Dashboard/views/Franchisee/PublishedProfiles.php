<style>
.jmatri_box {min-height: 200px;width:100%;background:#fff;padding:10px 15px;max-width:770px !important;border:1px solid #d5ecf2;cursor:pointer}
.jmatri_box:hover {border:1px solid #bee1ea;background:#edf5f7}
</style>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6"><h4 class="card-title">Published</h4></div>
                    <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="DraftedProfiles"><small>Drafted</small></a>&nbsp;|&nbsp;
                        <a href="PostedProfiles"><small>Requested</small></a>&nbsp;|&nbsp;
                        <a href="PublishedProfiles"><small style="font-weight:bold;text-decoration:underline">Published</small></a>&nbsp;|&nbsp;
                        <a href="Rejected"><small>Rejected</small></a>
                    </div>
                </div>
                   <?php 
                         $response = $webservice->getData("Franchisee","GetMyProfiles",array("ProfileFrom"=>"Published"));
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                        ?>
               <div class="jmatri_box box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                                    <img src="<?php echo $P['ProfileThumb'];?>" style="width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $P['Position'];?></div>    
                                </div>
                                <div class="col-sm-9" style="padding:0px;">
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;padding-bottom:10px;font-size: 21px;color: #514444cc;">
                                        <div class="form-group row" style="margin-bottom:0px">                                                                                     
                                            <div class="col-sm-12"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs)</div>
                                        </div>
                                        <div class="form-group row" style="margin-bottom:0px">
                                            <div class="col-sm-6">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                            </div>
                                            <div class="col-sm-6" style="float:right;font-size: 12px;text-align:right">
                                                <img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;">&nbsp;<?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom:0px">
                                <div class="col-sm-10">
                                    <div style="line-height: 25px;color: #867c7c;font-size:11px;">Member ID:&nbsp;<?php echo $P['Members']['MemberCode'];?>&nbsp;|&nbsp;
                                    Doc attached:<?php echo sizeof($P['Documents']);?></div><br>
                                    <a href="<?php echo GetUrl("ListOfProfile/".$Profile['ProfileCode'].".htm?source=RecentlyViewedCount");?>">Recently Viewed (<?php echo $P['RecentlyViewed'];?>)</a> &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("MyFavoritedProfiles/".$Profile['ProfileCode'].".htm?source=MyFavorited");?>">My Liked (<?php echo $P['MyFavorited'];?>)</a> &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("RecentlyWhoViewed/".$Profile['ProfileCode'].".htm?source=RecentlyWhoViewed");?>">Who Viewed (<?php echo $P['RecentlyWhoViwed'];?>)</a> &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("WhoFavorited/".$Profile['ProfileCode'].".htm?source=WhoFavorited");?>">Who Liked(<?php echo $P['WhoFavorited'];?>)</a> &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Mutual/".$Profile['ProfileCode'].".htm?source=Mutual");?>">Mutual(<?php echo $P['MutualCount'];?>)</a>
                                </div>
                                <div class="col-sm-2" style="text-align: right;font-size:12px;">
                                    <a href="<?php echo GetUrl("ViewPublishedProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                </div>
                            </div>
                        </div>  
                        <br> 
                <?php }} else {?>   
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
                  <?php }?> 
                                                              
                </div>
              </div>
            </div>
        </form>   
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>