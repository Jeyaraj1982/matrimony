<?php
    if (isset($_POST['welcomebutton'])) {
        $response = $webservice->WelcomeMessage();
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
    
    $mutualprofile = $webservice->getData("Member","GetMutualProfiles",array("requestfrom"=>"0","requestto"=>"3"));
    $MutualProfiles = $mutualprofile['data'];
    
    
    $latestupdates = $webservice->getData("Member","GetLatestUpdates");

    $DashboardCounts        = $webservice->getData("Member","DashboardCounts");
    $MyRecentlyViewedCount  = $DashboardCounts['data']['MyRecentlyViewedCount'];
    $RecentlyWhoViewedCount = $DashboardCounts['data']['RecentlyWhoViewed'];
    $MyFavoritedCount       = $DashboardCounts['data']['MyFavorited'];
    $WhofavoritedCount      = $DashboardCounts['data']['Whofavorited'];
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
                <div class="modal-content" id="model_body" style="height: 220px;">
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
                                        <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/RecentlyWhoViewed">View All(<?php echo $RecentlyWhoViewed['cnt'];?>)</a>
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
                                        <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/MutualProfiles">View All (<?php echo $WhoFavoritedCount['cnt'];?>)</a>
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
                                        <a href="<?php echo SiteUrl;?>MyContacts/MutualProfiles">View All (<?php echo $MutualCount['cnt'];?>)</a>
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
                    <?php
                     foreach($MyRecentlyViewed as $Profile) { 
                       echo dashboard_view_2($Profile);
                    }?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyRecentViewed">View All (<?php echo $MyRecentlyViewedCount['cnt'];?>)</a>
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
                            <a href="<?php echo SiteUrl;?>MyContacts/MyFavorited">View All <?php echo $MyFavoritedCount['cnt'];?></a>
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
        <?php } else { ?>
            <?php  if ($response['data']['IsMobileVerified']==0) { ?>
                $('#verificationContent').html('<span style="color:#666;font-size:13px;"><img src="assets/images/exclamation-mark.png" style="margin-top: -3px;margin-right: 3px;">&nbsp;Your mobile number is not verified. Click to&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">verify now</a></span>');
                setTimeout(function(){$("#verifydiv").show(500)},1500);
            <?php } else if ($response['data']['IsEmailVerified']==0) { ?>
                $('#verificationContent').html('<span style="color:#666;font-size:13px;"><img src="assets/images/exclamation-mark.png" style="margin-top: -3px;margin-right: 3px;">&nbsp;Your email address is not verified.Click to &nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">verify now</a></span>');
                setTimeout(function(){$("#verifydiv").show(500)},1500);
            <?php } ?>
        <?php } ?>
    </script>  
    <?php  if($response['data']['WelcomeMsg']==0) {     ?>
    <div class="modal fade" id="MemberWelcome" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" style="width:367px">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="" >
                        <div style="padding:10px;">
                            <h3 style="text-align:left;margin-top:0px">Welcome <?php echo "<b style='color:red'>";echo $_Member['MemberName'] ; echo "</b>";?></h3>
                        </div>
                        <div style="padding:10px;overflow: auto;"><?php echo $_Member['WelcomeMessage'] ?></div>
                        <div style="text-align:center;"><input type="submit" class="btn btn-primary" name="welcomebutton" value="Continue"/></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<script>
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
        $.post(API_URL + "m=Member&a=HideLatestUpdates", param, function(result2) {
            $('#model_body').html(result2);
            $('#UpdatesDiv_'+LatestID).hide();
        }
    );
   
}
    function HideDiv(divid) {
        $('#mutprofile_div_'+divid).hide(500);       
    }
</script>