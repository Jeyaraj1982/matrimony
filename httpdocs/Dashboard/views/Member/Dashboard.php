
   <?php
    if (isset($_POST['welcomebutton'])) {
       $welcome=$mysql->execute("update _tbl_members set WelcomeMsg='1' where  MemberID='".$_Member['MemberID']."'");
       unset($_POST);                         
    
     }                                                 
?>
 <style>
div, label,a,h1,h2,h3,h4,h5,h6 {font-family:'Roboto' !important;}
#resCon_a001 {
   background:white;padding:10px;border-bottom: 1px solid #d5d5d5;cursor:pointer;
}
#resCon_a002 {
 float:left;width:143px;height:275px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;border-radius:5px;cursor:pointer;
}
#resCon_a001:hover {
    background:#f1f1f1;
}
#resCon_a002:hover {
    background:#f1f1f1;
}
</style>                                                 
         <!--<div class="row purchace-popup">
            <div class="col-12">
            <span class="d-flex alifn-items-center">
                <p>Like what you see? Check out our premium version for more.</p>
                <a href="https://github.com/BootstrapDash/StarAdmin-Free-Bootstrap-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                <i class="mdi mdi-close popup-dismiss"></i>
              </span>
            </div>
          </div>-->
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Profiles</p>
                      <div class="fluid-container">
                      <?php //$Profiles = $mysql->select("SELECT COUNT(*) FROM _tbl_master_Member"); ?>
                        <?php //foreach($Profiles as $Profile) { ?>
                        <h3 //class="font-weight-medium text-right mb-0"><?php //echo $Profile['MemberID'];?></h3>
                        <?php // } ?>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("Profile/CreateProfile");?>"> Create profile</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Contacts</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">10</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i><a href="">view</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Wallet</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">5000.00</h3>
                      </div>
                    </div>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Member/RefillWallet">Refill Wallet</a>
                  </p></div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Expired Profile</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Member/RenewProfile">Renew</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">
            <div style="width:135px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Saved contacts</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:298px">
                <div>
                 <?php
for ($x = 0; $x <= 3; $x++) {
                   ?>
                    <div id="resCon_a002">
                        <img src="<?php echo SiteUrl?>images/userimage.jpg" style="border-radius:115px;width:88%"><br>
                        <h5 style="margin-bottom:-10px">Justin L</h5><br>
                        <span style="color:#bfacac;">43 yrs, 5' 6', Tamil Bengaluru / Banglore</span><br>
                        <button type="submit" class="btn btn-primary" style="background:transparent;color:#00c1ff;padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</button> 
                    </div>
                    <?php }?> 
                   </div> 
                </div>
              </div>
            </div>
     <div class="col-5 grid-margin" style="max-width: 35.667%;">
              <div style="width:135px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Saved contacts</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding:10px !important">
                <?php  for ($x = 0; $x <= 4; $x++) { ?>
                    <div>
                    <div class="col-sm-12" id="resCon_a001">
                        <div class="col-sm-2"><img src="<?php echo SiteUrl?>images/userimage.jpg" style="border-radius:115px;width:30px"></div>
                        <div class="col-sm-10">
                            <div style="margin-top:0px">Conard G</div>
                            <span style="color:#999 !important">39 yrs, 5' 6',Konkani, Mumbai Hotel & Hospitality Proffession</span>
                        </div>
                    </div>
                     </div>
                     <?php }?>
                     <div class="col-sm-12" style="padding:10px;text-align:center;background:#fff"><a href="#" >View More</a></div>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">
            <div style="width:135px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Saved contacts</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;height:298px">
                <div>
                 <?php
for ($x = 0; $x <= 3; $x++) {
                   ?>
                    <div id="resCon_a002">
                        <img src="<?php echo SiteUrl?>images/userimage.jpg" style="border-radius:115px;width:88%"><br>
                        <h5 style="margin-bottom:-10px">Justin L</h5><br>
                        <span style="color:#bfacac;">43 yrs, 5' 6', Tamil Bengaluru / Banglore</span><br>
                        <button type="submit" class="btn btn-primary" style="background:transparent;color:#00c1ff;padding: 3px 27px;border-radius: 25px;border-top: 1px solid #83c25d;border-bottom: 1px solid #00c1ff;">View</button> 
                    </div>
                    <?php }?> 
                   </div> 
                </div>
              </div>
            </div>
     <div class="col-5 grid-margin" style="max-width: 35.667%;">
              <div style="width:135px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Saved contacts</div>
              <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding:10px !important">
                <?php  for ($x = 0; $x <= 4; $x++) { ?>
                    <div>
                    <div class="col-sm-12" id="resCon_a001">
                        <div class="col-sm-2"><img src="<?php echo SiteUrl?>images/userimage.jpg" style="border-radius:115px;width:30px"></div>
                        <div class="col-sm-10">
                            <div style="margin-top:0px">Conard G</div>
                            <span style="color:#999 !important">39 yrs, 5' 6',Konkani, Mumbai Hotel & Hospitality Proffession</span>
                        </div>
                    </div>
                     </div>
                     <?php }?>
                     <div class="col-sm-12" style="padding:10px;text-align:center;background:#fff"><a href="#" >View More</a></div>
                </div>
              </div>
            </div>
          </div>
         
    
   <script>
  /* function openwelcomemsg() {
    
     
       var w = ($(window).width()-600)/2;
        $.blockUI({ 
            message: $('#MemberWelcome'), 
            css: { 'top': '35%',
                   'border':'0px',
                   'border-radius':'10px',
                   'cursor':'default',
                   'height':'300px',
                   'width':'600px',
                   'left':w + 'px'
                   } 
        }); 
 
        //setTimeout($.unblockUI, 2000); 
 
   }
   function _popupclose() {
    $.unblockUI();
}  */

<?php 
$m=$mysql->select("select * from _tbl_members where MemberID='".$_Member['MemberID']."'");
if($m[0]['WelcomeMsg']==0) {
    ?>
  // setTimeout("openwelcomemsg()", 2000);
    $(document).ready(function(){
        $("#MemberWelcome").modal('show');
    
    $(".hide-modal").click(function(){
        $("#MemberWelcome").modal('hide');
    });
    }); 
  <?php }?>
   
   </script>  

   
   <!--<div id="MemberWelcome" style="display:none;">
    <form method="POST" action="" >
        <div style="padding:10px;">
            <h3 style="text-align:left;margin-top:0px">Welcome <?php // echo "<b style='color:red'>";echo $_Member['MemberName'] ; echo "</b>";?></h3><br>
            <input type="submit" class="btn btn-primary" name="welcomebutton" value="Continue"/>
        </div>
     </form>    
   </div> 
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
   <div class="modal fade" id="MemberWelcome" role="dialog" data-backdrop="static" style="padding-top:350px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width:367px">
        <div class="modal-content">
            <div class="modal-body">
                    <form method="POST" action="" >
                    <div style="padding:10px;">
                    <h3 style="text-align:left;margin-top:0px">Welcome <?php echo "<b style='color:red'>";echo $_Member['MemberName'] ; echo "</b>";?></h3><br>
                    <input type="submit" class="btn btn-primary" name="welcomebutton" value="Continue"/>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>