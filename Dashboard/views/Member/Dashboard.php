<?php
    if (isset($_POST['welcomebutton'])) {
        $response = $webservice->getData("Member","WelcomeMessage");          
    }
    if (isset($_POST['boardmsgbutton'])) {
		$response = $webservice->getData("Member","BoardMessage",$_POST);
    }  
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"All"));
	$whoviewed = $webservice->getData("Member","GetRecentlyWhoViewedProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $WhoViewedYourProfile = $whoviewed['data'];       

    $whofavorited = $webservice->getData("Member","GetWhoFavouriteMyProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $WhoFavoritedYourProfiles = $whofavorited['data']; 

    $myrecentviewed = $webservice->getData("Member","GetRecentlyViewedProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MyRecentlyViewed = $myrecentviewed['data'];

    $myfavorited = $webservice->getData("Member","GetFavouritedProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MyFavouritedProfiles = $myfavorited['data'];
    
    $WhoDownloaded = $webservice->getData("Member","GetWhoDownloadMyProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $WhoDownloadMyProfiles = $WhoDownloaded['data'];
    
    $MyDownloaded = $webservice->getData("Member","GetMyDownloadMyProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MyDownloadedProfiles = $MyDownloaded['data']; 
	
	$myshortlisted = $webservice->getData("Member","GetShortListProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MyShortlistedProfiles = $myshortlisted['data'];
	
	$whoshortlisted = $webservice->getData("Member","GetWhoShortListedMyProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $WhoShortlistedProfiles = $whoshortlisted['data'];
    
    $mutualprofile = $webservice->getData("Member","GetMutualProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MutualProfiles = $mutualprofile['data'];
    
    
    $latestupdates = $webservice->getData("Member","GetLatestUpdates");
 
    $DashboardCounts        = $webservice->getData("Member","DashboardCounts");
	$MyRecentlyViewedCount  = $DashboardCounts['data']['MyRecentlyViewed'];
    $RecentlyWhoViewedCount = $DashboardCounts['data']['MyRecentlyWhoViewed'];
    $MyFavoritedCount       = $DashboardCounts['data']['MyFavorited']; 
	$WhofavoritedCount      = $DashboardCounts['data']['WhoFavorited'];
    $WhoShortListedCount    = $DashboardCounts['data']['WhoShortListed'];
    $MyShortListedCount    = $DashboardCounts['data']['MyShortListed'];
    $MutualCount            = $DashboardCounts['data']['Mutual'];

?>
    <script>
        function myFunction() {
            var x = document.getElementById("verifydiv");
            if (!(x.style.display === "none")) {
                $('#verifydiv').hide(1000);
            }
        }
        function mynotification() {
            var x = document.getElementById("notificationdiv");
            if (!(x.style.display === "none")) {
                $('#notificationdiv').hide(1000);
            }
        }
    </script>
      <?php $notificationresponse = $webservice->getData("Member","GetMyNotifications");   ?>  
         <?php  if(sizeof($notificationresponse['data'])>0) { ?>
     <div class="row" id="notificationdiv" >
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card card-statistics" style="border-radius: 5px;">
                <div class="card-body" style="border-radius: 5px;background: #fffdc4;border: 1px solid #ccc;padding: 12px;">
                    <div class="col-sm-6" id="notificationContent"><?php echo $notificationresponse['data']['Message'];?></div>
                    <a href="javascript:void(0)" onclick="mynotification()" class="close" style="outline:none" >&times;</a>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
  
    <div class="row" id="verifydiv" style="display: none;">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card card-statistics" style="border-radius: 5px;">
                <div class="card-body" style="border-radius: 5px;background: #fffdc4;border: 1px solid #ccc;padding: 12px;">
                    <div class="col-sm-6" id="verificationContent"></div>
                    <a href="javascript:void(0)" onclick="myFunction()" class="close" style="outline:none" >&times;</a>
                </div>
            </div>
        </div>
    </div> 
    <div class="row" id="notificationdiv" style="display: none;">
        <div class="col-sm-12 grid-margin stretch-card">
            <div class="card card-statistics" style="border-radius: 5px;">
                <div class="card-body" style="border-radius: 5px;background: #fffdc4;border: 1px solid #ccc;padding: 12px;">
                    <div class="col-sm-6" id="notificationContent"></div>
                    <a href="javascript:void(0)" onclick="mynotification()" class="close" style="outline:none" >&times;</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <?php  if(sizeof($latestupdates['data'])>0){?>
    <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">                                                                     
            <div class="member_dashboard_widget_title">Latest Updates</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:345px">
                    <div id="resCon_a002" class="resCon_a002" style="background:white;width:97%;text-align:left;padding:0px;height:300px;overflow:auto">
                    <?php foreach($latestupdates['data'] as $Row) { ?>   
                    <div id="UpdatesDiv_<?php echo $Row['LatestID'];?>" name="UpdatesDiv_<?php echo $Row['LatestID'];?>" style="border-bottom:1px solid #e5e5e5;padding: 5px;padding-bottom:6px;background:#fff;overflow:auto;">
                        <table style="width: 100%;">
                            <tr class='tblrow'>
                                <td style="width:60px;text-align:left">
                                    <img src="<?php  echo $Row['ProfilePhoto']?>" style="border-radius: 50%;width: 48px;border: 1px solid #ddd !important;height: 48px;padding: 1px;background: #fff;">
                                </td>
                                <td style="font-size:13px;color:#555;">
                                    <?php echo $Row['VisterProfileCode'];?> &nbsp;<?php echo $Row['Subject'];?><br>
                                     <a href="<?php echo GetUrl("ViewProfile/".$Row['VisterProfileCode'].".htm?source=DashboardLatestUpdatesView");?>">View Profile</a>
                                </td>
                                <td style="width:94px;text-align:right;line-height: 24px;padding: 0px;">
                                 <a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $Row['LatestID'];?>')" name="Hide" style="font-family:roboto">&times;</a><br>
                                  <span style="float:right;font-size: 11px;color: #bbb;"><?php echo time_elapsed_string($Row['ViewedOn']);?></span>
                                </td>
                            </tr>                                                 
                        </table>
                    </div>                                       
                   <?php }?> 
                   </div>
                    <div style="clear:both;padding:7px; text-align:center;">
                          <a href="<?php echo SiteUrl;?>LatestUpdates">View All</a>
                  </div>
                  </div>
             </div>   
        </div>
        <?php }else{?>
          <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">       
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding:10px !important;height:374px">
                    <div id="resCon_a002" style="background:white;width:100%;text-align:left;padding:0px;height: 351px;overflow:auto">
                    </div>
                </div>
             </div>
          </div>
          <?php }?>
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div class="member_dashboard_widget_title">My Recent Profile</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <div class="col-sm-12" id="resCon_a001" style="height: 327px;">
                    <?php if (sizeof($response['data'])==0) {      ?>
                            <div style="text-align:center;margin-top: 140px;">
                                <h5 style="color: #aaa;"><a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a> </h5>
                            </div>
                        <?php } else { ?>
                <div>
                            <?php foreach($response['data'] as $Profile) { 
                         echo  DisplayManageProfileShortInfoforDashboard($Profile); ?> <br>
                         <?php    }  ?>
                </div>
                <?php }?>
                </div>              
                </div>
            </div>
         </div> 
         <div class="modal" id="Delete" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="model_body" style="height: 300px;">
                </div>
            </div>
        </div>                                                
        </div>
<div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">
        <div>
            <div class="member_dashboard_widget_title">Who viewed my profile</div>
            <div class="card" style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow" >
                    <?php if (sizeof($WhoViewedYourProfile)>0) { ?>
                        <div style="height:280px;overflow:hidden">
                            <?php
                                foreach($WhoViewedYourProfile as $Profile) {
                                    echo dashboard_view_1($Profile);
                                }
                            ?> 
                         </div> 
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/RecentlyWhoViewed">View All(<?php echo $RecentlyWhoViewedCount;?>)</a>
                            </div>
                    <?php } else { ?>
                         <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;font-weight: normal;line-height: 19px;"><?php echo $lang['no_profiles_who_viewed_your_profile'];?></h5>
                            </div>
                         </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <Br>
        <div>
            <div class="member_dashboard_widget_title">Who liked my profile</div>
            <div class="card"  style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow">
                    <?php if (sizeof($WhoFavoritedYourProfiles)>0) { ?>                            
                    <div style="height:280px;overflow:hidden">
                        <?php
                            foreach($WhoFavoritedYourProfiles as $Profile) { 
                                echo dashboard_view_1_Recent_Favouriters($Profile);
                            }
                        ?> 
                    </div> 
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/RecentlyWhofavourited">View All (<?php echo $DashboardCounts['data']['WhoFavorited'];?>)</a>
                            </div>
                    <?php } else { ?>
                    <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;font-weight: normal;line-height: 19px;">you don't have active profile to view recently who liked your profile </h5>
                            </div>
                         </div>                                                        
                    <?php } ?>
                </div>
            </div>
        </div>
        <br>
        <div>
            <div class="member_dashboard_widget_title">Mutually liked profiles</div>
            <div class="card" style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow" >
                    <?php if (sizeof($MutualProfiles)>0) { ?>
                        <div style="height:280px;overflow:hidden">
                            <?php
                                foreach($MutualProfiles as $Profile) {
                                    echo dashboard_mutual_profiles($Profile);
                                }
                            ?> 
                         </div> 
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/MutualProfiles">View All (<?php echo $MutualCount;?>)</a>
                            </div>
                    <?php } else { ?>
                         <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;font-weight: normal;line-height: 19px;">you don't have mutually liked profiles</h5>
                            </div>
                         </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="col-5 grid-margin" style="max-width: 35.667%;">
        <div>
            <div class="member_dashboard_widget_title">My Recently Viewed</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;height: 480px;">
                    <?php if (sizeof($MyRecentlyViewed)>0) { ?>
                <div>
                    <?php $i=1; 
					foreach($MyRecentlyViewed as $Profile) { 
					   if($i<=3){
                       echo dashboard_view_2($Profile);
					   }
					   $i++;
                    }?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyRecentViewed">View All (<?php echo $MyRecentlyViewedCount;?>)</a>
                         </div>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;">recently you didn't view any profiles </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
         <br>            
        <div>
            <div class="member_dashboard_widget_title">I liked profiles</div>
            <div class="card" style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;height: 480px;">
                    <?php if (sizeof($MyFavouritedProfiles)>0) {  ?>
                <div>
                    <?php
                     foreach($MyFavouritedProfiles as $Profile) { 
                       echo dashboard_myfavorited_view_2($Profile);
                     }
                    ?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyFavorited">View All (<?php echo $MyFavoritedCount;?>)</a>
                         </div>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;">recently you didn't like any profiles </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">
        <div>
            <div class="member_dashboard_widget_title">Who shortlisted my profile</div>
            <div class="card" style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow" >
                    <?php if (sizeof($WhoShortlistedProfiles)>0) { ?>
                        <div style="height:280px;overflow:hidden">
                            <?php
                                foreach($WhoShortlistedProfiles as $Profile) {
                                    echo dashboard_whoshortlisted_view_1($Profile);
                                }
                            ?> 
                         </div> 
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/WhoShortListProfiles">View All(<?php echo $WhoShortListedCount;?>)</a>
                            </div>
                    <?php } else { ?>
                         <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;font-weight: normal;line-height: 19px;"><?php echo $lang['no_profiles_who_shortlisted_your_profile'];?></h5>
                            </div>
                         </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <Br>
        <div>
            <div class="member_dashboard_widget_title">Who viewed my contact</div>
            <div class="card"  style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow">
                    <?php if (sizeof($WhoDownloadMyProfiles)>0) { ?>                            
                    <div style="height:280px;overflow:hidden">
                        <?php
                            foreach($WhoDownloadMyProfiles as $Profile) { 
                                echo dashboard_whodownloaded_view_1($Profile);
                            }
                        ?> 
                    </div> 
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/WhoViewedMyContacts">View All (<?php echo $DashboardCounts['data']['WhoDownloaded'];?>)</a>
                            </div>
                    <?php } else { ?>
                    <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;font-weight: normal;line-height: 19px;">you don't have active profile to view recently who viewed contacts </h5>
                            </div>                                                  
                         </div>                                                        
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="col-5 grid-margin" style="max-width: 35.667%;">
        <div>
            <div class="member_dashboard_widget_title">My shortlisted profile</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;height: 480px;">
                    <?php if (sizeof($MyShortlistedProfiles)>0) { ?>
                <div>
                    <?php
                     foreach($MyShortlistedProfiles as $Profile) { 
                       echo dashboard_myshortlisted_view_2($Profile);
                    }?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/ShortListProfiles">View All (<?php echo $MyShortListedCount;?>)</a>
                         </div>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;">recently you didn't view any profiles </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
          <br>            
        <div>
            <div class="member_dashboard_widget_title">My viewed contacts</div>
            <div class="card" style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;height: 480px;">
                    <?php if (sizeof($MyDownloadedProfiles)>0) {  ?>
                <div>
                    <?php
                     foreach($MyDownloadedProfiles as $Profile) { 
                       echo dashboard_mydownloaded_view_2($Profile);
                     }
                    ?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyDownloaded">View All (<?php echo $DashboardCounts['data']['MyDownloaded'];?>)</a>
                         </div>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;">recently you didn't viwed any contacts </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>            
    </div> 
</div>
<div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">
    </div>
     <div class="col-5 grid-margin" style="max-width: 35.667%;">
          
         </div>
</div>
<?php $response = $webservice->getData("Member","GetMemberInfo");?>
    <script>
        <?php if($response['data']['WelcomeMsg']==0) { ?>
        $(document).ready(function(){
            $("#MemberWelcome").modal('show');
            $(".hide-modal").click(function(){
                $("#MemberWelcome").modal('hide');
            });
        });   
        <?php  
         
         } else { ?>
            <?php  if ($response['data']['IsMobileVerified']==0) { ?>
                $('#verificationContent').html('<span style="color:#666;font-size:13px;"><img src="assets/images/exclamation-mark.png" style="margin-top: -3px;margin-right: 3px;">&nbsp;Your mobile number is not verified. Click to&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">verify now</a></span>');
                setTimeout(function(){$("#verifydiv").show(500)},1500);
            <?php } elseif ($response['data']['IsEmailVerified']==0) { ?>
                $('#verificationContent').html('<span style="color:#666;font-size:13px;"><img src="assets/images/exclamation-mark.png" style="margin-top: -3px;margin-right: 3px;">&nbsp;Your email address is not verified.Click to &nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">verify now</a></span>');
                setTimeout(function(){$("#verifydiv").show(500)},1500);
            <?php } else { 
            if(sizeof($response['data']['Popup'])>0) { ?> 
        $(document).ready(function(){
            $("#MemberBoard").modal('show');
            $(".hide-modal").click(function(){
                $("#MemberBoard").modal('hide');
            });
        });
       <?php    } ?>
        <?php } } ?>
        
    </script>  
    <?php  if($response['data']['WelcomeMsg']==0) {     ?>
    <div class="modal fade" id="MemberWelcome" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" style="width:367px">
            <div class="modal-content">
            <form method="POST" action="" >
                 <div class="modal-header">   
                        <h4 class="modal-title">Welcome <?php echo "<b style='color:red'>";echo $_Member['MemberName'] ; echo "</b>";?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
                 </div> 
                 <div class="modal-body" style="max-height:175px;min-height: 175px;overflow-y:scroll;">
                    <p><?php echo $_Member['WelcomeMessage'] ?></p>
                 </div>
                 <div class="modal-footer">
                        <a href="javascript:void(0);" onclick="ReadWelcomeMessage()" class="btn btn-primary" name="welcomebutton" >Continue</a>
                 </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        function ReadWelcomeMessage() {
         $.ajax({url: getAppUrl() + "m=Member&a=WelcomeMessage", success: function(result){
                    $('#MemberWelcome').hide();
    }});
}
    </script>
    <?php } ?>
    <div class="modal fade" id="MemberBoard" role="dialog" data-backdrop="static" style="padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" >
            <div class="modal-content" style="max-height: 500px;min-height: 500px;">
                <form method="POST" id="frmBrd" action="">
                <input type="hidden" name="BoardID" value="<?php echo $response['data']['Popup'][0]['BoardID'];?>">
                    <div class="modal-header">   
                        <h4 class="modal-title">Latest Message</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body" style="max-height:375px;min-height: 375px;overflow-y:scroll;">
                            <p><b><?php echo $response['data']['Popup'][0]['MessageSubject'];?></b></p>
                            <p style="color:#959494"><?php echo $response['data']['Popup'][0]['MessageContent'];?></p>  <br>
                    </div>
                    <div class="modal-footer">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="IhaveRead" name="check" onclick="IhaveReadFn();" value="1">
                            <label class="custom-control-label" for="IhaveRead" style="font-weight:normal;margin-top:3px">&nbsp;I have Read</label>
                        </div>&nbsp;&nbsp;
                        <button type="submit" disabled="disabled" class="btn btn-primary" name="boardmsgbutton" id="boardmsgbutton">Continue</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<script>

function IhaveReadFn() {
    
    if($("#IhaveRead").prop("checked") == true){ 
        $('#boardmsgbutton').removeAttr("Disabled");
    }
    
    if($("#IhaveRead").prop("checked") == false){
        $('#boardmsgbutton').attr("Disabled","Disabled");
    }
}
        function showConfirmDelete(LatestID) {                                           
        $('#Delete').modal('show'); 
        var content = '<div class="modal-body" style="padding:20px">'
                        + '<div  style="height: 315px;">'
                            + '<form method="post" id="form_'+LatestID+'" name="form_'+LatestID+'" > '
                                + '<input type="hidden" value="'+LatestID+'" name="LatestID">'
                                  + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                   + '<h4 class="modal-title">Confirm delete Updates</h4><br>'
                                + '<div style="text-align:center">Are you sure want to Delete?  <br><br>'
                                    + '<button type="button" class="btn btn-primary" name="Delete"  onclick="ConfirmDelete(\''+LatestID+'\')">Yes</button>&nbsp;&nbsp;'
                                    + '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                                + '</div>'
                            + '</form>'
                        + '</div>'
                     +  '</div>';
        $('#model_body').html(content);
    }

function ConfirmDelete(LatestID) {
       var param = $( "#form_"+LatestID).serialize();
        $('#model_body').html(preloader);
        $.post(getAppUrl() + "m=Member&a=HideLatestUpdates", param, function(result) {
            if (!(isJson(result))) {
                $('#model_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                   var data = obj.data; 
                   var content = '<div class="modal-header">'
                            +'<h4 class="modal-title">Confirmation For Delete</h4>'
                            +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                        +'</div>'
                        +'<div class="modal-body" style="text-align:center">'
                            +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" style="height:100px;"></p>'
                            +'<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h4>    <br>'
                            +'<a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>'
                         +'</div>';
                   $('#model_body').html(content);
            $('#UpdatesDiv_'+LatestID).hide();
         }
        });
}
    function HideDiv(divid) {
        $('#mutprofile_div_'+divid).hide(500);       
    }
</script>
<div class="modal" id="myModal" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Mobile_VerificationBody"  style="max-height: 529px;min-height: 529px;" >
                    <img src='../../../images/loader.gif'> Loading ....
                </div>
            </div>
        </div>