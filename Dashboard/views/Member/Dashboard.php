<?php
    if (isset($_POST['welcomebutton'])) {
        $response = $webservice->WelcomeMessage();
    }  
    $response = $webservice->getData("Member","GetMyProfiles",array("ProfileFrom"=>"All"));
   // if (sizeof($response['data'])>0) {
?>
    <style>
        div, label,a,h1,h2,h3,h4,h5,h6 {font-family:'Roboto' !important;}
        #resCon_a001 {background:white;padding:10px;border-bottom: 1px solid #d5d5d5;cursor:pointer;}
        #resCon_a002 {float:left;width:143px;height: 235px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
        #resCon_a001:hover {background:#f1f1f1;}
        #resCon_a002:hover {background:#f1f1f1;}
        #verifybtn{background: #0eb1db;border:1px#32cbf3;box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
        #verifybtn:hover{background:#149dc9;}
        input:focus{border:1px solid #ccc;}
        #errormsg{text-align:center;color:red;padding-bottom:5px;padding-top:5px;}
        #resCon_a002 a:hover{color: #337ab7;}
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
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">My Recent Profiles</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:258px">
                    <div id="resCon_a002" style="background:white;width:97%;text-align:left">
                    <?php if (sizeof($response['data'])==0) {      ?>
                        <div style="text-align:center;">
                            <h5 style="margin-top:84px;color: #aaa;">No Profiles Found<br><br> <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a> </h5>
                        </div>
                    <?php } else {?>                                                                                        
                    <?php if (sizeof($response['data'])>0) { ?>
                    <?php foreach($response['data'] as $Profile) { ?>
                        <div class="form-group row">
                            <div class="col-sm-3" style="text-align:center">
                               <img src="<?php echo SiteUrl?>assets/images/prof1.jpg" style="height: 159px;margin-bottom: -18px;">
                            </div>
                            <div class="col-sm-9">
                                <div style="border-bottom:1px solid #d7d7d7;width:100%;padding-bottom: 10px;font-size: 21px;color: #514444cc;text-align:left"> 
                                    <?php echo $Profile['ProfileName'];?>
                                </div>
                                <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                    <div><?php echo $Profile['Height'];?></div>
                                    <div><?php echo $Profile['Religion'];?></div>
                                    <div><?php echo $Profile['Caste'];?></div>
                                </div>   
                                <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                    <div><?php echo $Profile['MaritalStatus'];?></div>
                                    <div><?php echo $Profile['City'];?></div>
                                    <div><?php echo $Profile['Occupation'];?></div>
                                </div>
                            </div>
                        </div>
                        <div style="float:right;line-height: 1px;">
                    <?php if($Profile['IsApproved']==1){?>
                        <a href="<?php echo GetUrl("MyProfiles/View/". $Profile['ProfileID'].".htm");?>">View</a>
                          <?php }else{  ?>
                                  <a href="<?php echo GetUrl("MyProfiles/Edit/GeneralInformation/". $Profile['ProfileID'].".htm");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MyProfiles/View/". $Profile['ProfileID'].".htm");?>">View</a>
                         <?php  }    ?>
                     </div> 
                    <?php } ?>
                <?php } }?> 
                    </div>                                    
                   </div> 
                </div>
              <br>
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recent Visitors</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:158px">
                    <div id="resCon_a002" style="background:white;width:97%;height:136px">
                        <div style="text-align:center;">
                            <h5 style="margin-top:35px;color: #aaa;">No Visitors Found </h5>
                        </div>
                    </div>
                   </div> 
                </div>
            </div>
         
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
            <div style="width:156px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Recomended Profiles</div>
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
