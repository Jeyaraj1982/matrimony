<?php
    if (isset($_POST['welcomebutton'])) {
        $response = $webservice->WelcomeMessage();
    }  
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"All"));
    $whoviewed = $webservice->getData("Member","GetRecentlyWhoViewedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
    $WhoViewedYourProfile = $whoviewed['data'];       

    $whofavorited = $webservice->getData("Member","GetWhoFavouriteMyProfiles",array("requestfrom"=>"0","requestto"=>"5"));
    $WhoFavoritedYourProfiles = $whofavorited['data']; 

    $myrecentviewed = $webservice->getData("Member","GetRecentlyViewedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
    $MyRecentlyViewed = $myrecentviewed['data'];

    $myfavorited = $webservice->getData("Member","GetFavouritedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
    $MyFavouritedProfiles = $myfavorited['data'];
    
    $mutualprofile = $webservice->getData("Member","GetMutualProfiles",array("requestfrom"=>"0","requestto"=>"5"));
    $MutualProfiles = $mutualprofile['data'];
    
    
    $latestupdates = $webservice->getData("Member","GetLatestUpdates");
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
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:374px">
                    <div id="resCon_a002" style="background:white;width:97%;text-align:left;padding:0px;height: 351px;overflow:auto">
                    </div>
                </div>
             </div>
          </div>
          <?php }?>
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div class="member_dashboard_widget_title">My Recent Profiles</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <div class="col-sm-12" id="resCon_a001" style="height: 327px;">
                    <?php if (sizeof($response['data'])==0) {      ?>
                            <div style="text-align:center;margin-top: 115px;">
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
            <div class="member_dashboard_widget_title">Who viewed your profile</div>
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
                         <?php if (sizeof($WhoViewedYourProfile)>=3) { ?>
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/RecentlyWhoViewed">View All</a>
                            </div>
                          <?php } ?> 
                    <?php } else { ?>
                         <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;">No Profiles Found </h5>
                            </div>
                         </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <Br>
        <div>
            <div class="member_dashboard_widget_title">Who favorited your profile</div>
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
                     <?php if (sizeof($WhoFavoritedYourProfiles)>=3) { ?>
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/MutualProfiles">View All</a>
                            </div>
                          <?php } ?> 
                    <?php } else { ?>
                    <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;">No Profiles Found </h5>
                            </div>
                         </div>                                                        
                    <?php } ?>
                </div>
            </div>
        </div>
        <br><div>
            <div class="member_dashboard_widget_title">Mutual Profile</div>
            <div class="card" style="background:#dee9ea">
                <div class="card-body member_dashboard_widget_container" id="slideshow" >
                    <?php if (sizeof($MutualProfiles)>0) { ?>
                        <div style="height:280px;overflow:hidden">
                            <?php
                                foreach($MutualProfiles as $Profile) {
                                   // echo dashboard_view_1($Profile);
                                    echo dashboard_mutual_profiles($Profile);
                                }
                            ?> 
                         </div> 
                         <?php if (sizeof($MutualProfiles)>=3) { ?>
                            <div style="clear:both;padding:3px;text-align:center;">
                                        <a href="<?php echo SiteUrl;?>MyContacts/MutualProfiles">View All</a>
                            </div>
                          <?php } ?>
                    <?php } else { ?>
                         <div id="resCon_a002" class="resCon_a002" style="height:303px;overflow:hidden;width:552px;padding:10px;margin-top:0px !important">
                            <div style="text-align:center;margin-top: 127px;">
                                <h5 style="color: #aaa;">No Profiles Found </h5>
                            </div>
                         </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div class="member_dashboard_widget_title">My Recently Viewed</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php if (sizeof($MyRecentlyViewed)>0) { ?>
                <div>
                    <?php
                     foreach($MyRecentlyViewed as $Profile) { 
                       echo dashboard_view_2($Profile);
                    }?> 
                </div>
                <?php if (sizeof($MyRecentlyViewed)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyRecentViewed">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
         </div>
</div>


<div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 600px;max-width: 600px;">
            
    </div>
    <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">My Favourited</div>
            <div class="card" style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php if (sizeof($MyFavouritedProfiles)>0) {  ?>
                <div>
                    <?php
                     foreach($MyFavouritedProfiles as $Profile) { 
                       echo dashboard_myfavorited_view_2($Profile);
                     }
                    ?> 
                </div>
                <?php if (sizeof($MyFavouritedProfiles)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyFavorited">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
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
                $('#verificationContent').html('<span style="color:red">Your mobile number not verify &nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">Verfiy now</a></span>');
                setTimeout(function(){$("#verifydiv").show(500)},1500);
            <?php } else if ($response['data']['IsEmailVerified']==0) { ?>
                $('#verificationContent').html('<span style="color:red">Your email address not verify &nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">Verfiy now</a></span>');
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
/*$(document).ready(function () {
    var itemsMainDiv = ('#slideshow');
    var itemsDiv = ('.resCon_a002');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();
    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "resCon_a002" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});  */
</script>   

 
<script>
/*$('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<4;i++) {
    next=next.next();
    if (!next.length) {
      next=$(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  } 
});  */
</script>
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