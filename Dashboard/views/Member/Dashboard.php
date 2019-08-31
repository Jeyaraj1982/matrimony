<?php
    if (isset($_POST['welcomebutton'])) {
        $response = $webservice->WelcomeMessage();
    }  
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"All"));
?>
    <style>
        div, label,a,h1,h2,h3,h4,h5,h6 {font-family:'Roboto' !important;}
        #resCon_a001 {background:white;padding:10px;border-bottom: 1px solid #d5d5d5;cursor:pointer;}
        #resCon_a002 {float:left;width:143px;height: 235px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
        #resCon_a0021 {float:left;width:143px;height: 235px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
        #resCon_a001:hover {background:#f1f1f1;}
        #resCon_a002:hover {background:#f1f1f1;}
        #resCon_a0021:hover {background:#f1f1f1;}
        #verifybtn{background: #0eb1db;border:1px#32cbf3;box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
        #verifybtn:hover{background:#149dc9;}
        input:focus{border:1px solid #ccc;}
        #errormsg{text-align:center;color:red;padding-bottom:5px;padding-top:5px;}
        #resCon_a002 a:hover{color: #337ab7;}
        #resCon_a0021 a:hover{color: #337ab7;}
        #UpdatesDiv_:hover {
    background: #c3d1d2;
}
    </style>                                                 
    <script>
        function myFunction() {
            var x = document.getElementById("verifydiv");
            if (!(x.style.display === "none")) {
                $('#verifydiv').hide(1000);
            }
        }
       
    </script>
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
    <div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">                                                                     
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Latest Updates</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:435px">
                    <div id="resCon_a002" style="background:white;width:97%;text-align:left;padding:0px;height:380px">
                    <?php
                        $latestupdates = $webservice->getData("Member","GetLatestUpdates");
                        foreach($latestupdates['data'] as $Row) { 
                    ?>   
                    <div id="UpdatesDiv_<?php echo $Row['LatestID'];?>" name="UpdatesDiv_<?php echo $Row['LatestID'];?>" style="border-bottom:1px solid #c3d1d2;padding: 5px;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width:64px;padding-right: 15px;">
                                    <img src="<?php  echo $Row['ProfilePhoto']?>" style="border-radius: 50%;width: 64px;border: 1px solid #ddd !important;height: 64px;padding: 5px;background: #fff;">
                                </td>
                                <td>
                                    <?php echo $Row['VisterProfileCode'];?> &nbsp;<?php echo $Row['Subject'];?><br>
                                     <a href="<?php echo GetUrl("view/".$Row['VisterProfileCode'].".htm ");?>">View Profile</a>
                                     <span style="float:right;font-size: 12px;color: #514444cc;"><?php echo putDateTime($Row['ViewedOn']);?></span>
                                </td>
                                <td style="width:10px;">
                                 <div class="col-sm-1"><a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $Row['LatestID'];?>')" name="Hide" style="font-family:roboto"><button type="button" class="close" style="margin-top: -27px;margin-right: -9px;">&times;</button></a></div>
                                </td>
                            </tr>                                                 
                        </table>
                    </div>                                       
                   <?php }?>  
                  </div>
                  <div style="width:97%;text-align:center;">
                          <a href="<?php echo SiteUrl;?>LatestUpdates">View All</a>
                  </div>                      
             </div>   
        </div>
        </div>
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">My Recent Profiles</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php if (sizeof($response['data'])==0) {      ?>
                            <div style="text-align:center;">
                                <h5 style="margin-top:84px;color: #aaa;">No Profiles Found<br><br> <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a> </h5>
                            </div>
                        <?php } else { ?>
                <div>
                            <?php foreach($response['data'] as $Profile) { 
                         echo  DisplayManageProfileShortInfoforDashboard($Profile); ?> <br>
                         <?php    } } ?>
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
        </script>
    <div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recent Visitors</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" id="slideshow" style="padding-left: 4px;padding-right: 0px;height:315px">
                <?php
                    $recentlyviewedprofiles = $webservice->getData("Member","GetRecentlyWhoViewedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
                    $Profiles = $recentlyviewedprofiles['data'];       
                    if (sizeof($Profiles)>0) {
                ?>
                <div>
                 <?php
                     foreach($Profiles as $Profile) { 
                       echo dashboard_view_1($Profile);
                    }?> 
                    <button class="btn btn-primary leftLst"><</button>
                    <button class="btn btn-primary rightLst">></button>
                   </div> 
                
                <?php } else { ?>
                  <div id="resCon_a002" class="resCon_a002"  style="background:white;width:97%">
                        <div style="text-align:center;">
                            <h5 style="margin-top:84px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                <?php } ?>
              </div>
            </div>
        </div> 
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">My Recently Viewed</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php
                    $recentlyviewedprofiles = $webservice->getData("Member","GetRecentlyViewedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
                    //print_r($recentlyviewedprofiles);
                    $Profiles = $recentlyviewedprofiles['data']; 
                    if (sizeof($Profiles)>0) {
                ?>
                <div>
                    <?php
                     foreach($Profiles as $Profile) { 
                       echo dashboard_view_2($Profile);
                    }?> 
                </div>
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
    <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">
             <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recent Favouriters</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" id="slideshow" style="padding-left: 4px;padding-right: 0px;height:315px">
                <?php
                    $recentlyviewedprofiles = $webservice->getData("Member","GetWhoFavouriteMyProfiles",array("requestfrom"=>"0","requestto"=>"5"));
                    $Profiles = $recentlyviewedprofiles['data']; 
                    if (sizeof($Profiles)>0) {
                ?>                            
                <div>
                 <?php
                     foreach($Profiles as $Profile) { 
                       echo dashboard_view_1_Recent_Favouriters($Profile);
                    }?> 
                    <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
                   </div> 
                
                <?php } else { ?>
                  <div id="resCon_a002" class="resCon_a002"  style="background:white;width:97%;height:293px">
                        <div style="text-align:center;">
                            <h5 style="margin-top:84px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>                                                        
                <?php } ?>
              </div>
            </div>
        </div> 
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">My Favourited</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php
                    $favouritedprofiles = $webservice->getData("Member","GetFavouritedProfiles",array("requestfrom"=>"0","requestto"=>"5"));
                    //print_r($recentlyviewedprofiles);
                    $Profiles = $favouritedprofiles['data']; 
                    if (sizeof($Profiles)>0) {
                ?>
                <div>
                    <?php
                     foreach($Profiles as $Profile) { 
                       echo dashboard_view_2($Profile);
                    }?> 
                </div>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="card"  style="background:#dee9ea;">
                 <div class="card-body" style="padding:10px !important;">    
                  <?php // for ($x = 0; $x <= 4; $x++) { ?>
                   <div class="col-sm-12" id="resCon_a001">
                      <div class="col-sm-2"><img src="<?php // echo SiteUrl?>assets/images/userimage.jpg" style="border-radius:115px;width:30px"></div>
                        <div class="col-sm-10">
                          <div style="margin-top:0px">Conard G</div>
                          <span style="color:#999 !important">39 yrs, 5' 6',Konkani, Mumbai Hotel & Hospitality Proffession</span>
                        </div>
                    </div>
                   <?php// }?>
                  <div class="col-sm-12" style="padding:10px;text-align:center;background:#fff"><a href="#" >View More</a></div> 
                </div>
               </div>--> 
         </div>
        </div>
        <div class="row">
            <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Invited Profiles</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:258px">
                    <div id="resCon_a002" style="background:white;width:97%">
                        <div style="text-align:center;">
                            <h5 style="margin-top:84px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                   </div> 
                </div>
              <!--<div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:258px">
                <div>
                 <?php
                   //for ($x = 0; $x <= 3; $x++) {
                   ?>
                    <div id="resCon_a002">
                        <img src="<?php //echo SiteUrl?>assets/images/userimage.jpg" style="border-radius:115px;width:88%"><br>
                        <h5 style="margin-bottom:-10px">Justin L</h5><br>
                        <span style="color:#bfacac;">Bengaluru / Banglore</span><br>
                        <button type="submit" class="btn btn-primary" style="background:transparent;color:#00c1ff;padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</button> 
                    </div>
                    <?php// }?> 
                   </div> 
                </div>
              </div>-->
              <br>
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recent Visitors</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:158px">
                    <div id="resCon_a002" style="background:white;width:97%;height:136px">
                        <div style="text-align:center;">
                            <h5 style="margin-top:35px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                   </div> 
                </div>
            </div>
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
              <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recent Invitations</div>
              <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="card"  style="background:#dee9ea;">
                 <div class="card-body" style="padding:10px !important;">    
                  <?php // for ($x = 0; $x <= 4; $x++) { ?>
                   <div class="col-sm-12" id="resCon_a001">
                      <div class="col-sm-2"><img src="<?php // echo SiteUrl?>assets/images/userimage.jpg" style="border-radius:115px;width:30px"></div>
                        <div class="col-sm-10">
                          <div style="margin-top:0px">Conard G</div>
                          <span style="color:#999 !important">39 yrs, 5' 6',Konkani, Mumbai Hotel & Hospitality Proffession</span>
                        </div>
                    </div>
                   <?php// }?>
                  <div class="col-sm-12" style="padding:10px;text-align:center;background:#fff"><a href="#" >View More</a></div> 
                </div>
               </div>-->
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
$(document).ready(function () {
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

});
</script>   

 
<script>
$('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
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
});
</script>


