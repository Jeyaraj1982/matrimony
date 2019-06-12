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
<?php
  /*  if (isset($_POST['welcomebutton'])) {
       $welcome=$mysql->execute("update _tbl_franchisees_staffs set WelcomeMsg='1' where  FranchiseeID='".$_Franchisee['FranchiseeID']."'");
       unset($_POST); 
       ?>                        
  <?   }  */                                               
?>
 <style>
                            #verifybtn{
                                background: #0eb1db;;
                                border:1px#32cbf3;
                                box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
                            }
                            #verifybtn:hover{
                                 background:#149dc9;
                            }
                            input:focus{
                                border:1px solid #ccc;
                            }
                            #errormsg{
                                text-align:center;
                                color:red;
                                padding-bottom:5px;
                                padding-top:5px;
                            }
                        </style>
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Member</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">10</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("Member/ManageMembers");?>">View</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Expired Profiles</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">10</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("Member/ManageMembers");?>">View</a>
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
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>">Refill</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("MyAccounts/MyTransactions");?>">View Txn</a>
                  </p>
                  </div>
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
                      <p class="mb-0 text-right">Franchisee Info</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="#">Renew</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
              <!--weather card-->
              <!--<div class="card card-weather">-->
                <div class="card-body">
                  <div id="chartContainer" style="height: 100%; width: 100%;"></div>
                    
                  </div>
                </div>
                 </div>
              <!--weather card ends-->
            
     <div class="col-5 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">News & Events</h5>
                  <div class="table-responsive">
                  <table id="myTable" class="table">
                  <thead>
                        <tr>
                          
                        </tr>
                      </thead>
                      <tbody> 
                        <?php $News = $mysql->select("select * from _tbl_franchisees_news"); ?>
                        <?php foreach($News as $New) { ?>
                                <tr> 
                                <td><b><?php echo $New['NewsTitle'];?></b> <br> <small><?php echo $New['CreatedOn'];?></small></td>               
                                </tr>
                        <?php } ?>            
                      </tbody>
                   </table> 
                </div>
                <div class=" d-flex" >
                   <a href="<?php //echo GetUrl("MyAccounts/RefillWallet");?>"><small>View More</small></a>
                </div>
              </div>
     </div>
  
    
             <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Upcomming Renewals
                 </h5>
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3"> 
                      <div class="col-sm-2">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>images/userimage.jpg" alt="profile image">
                      </div>  
                      <div class=" col-sm-3">
                      <div class="row">
                        <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Name Of Candidate</p> <br>
                         <small class="mb-0 mr-2 text-muted text-muted">Age :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small>
                        </div>
                        <div class="row">
                         <small class="mb-0 mr-2 text-muted text-muted">Sex  :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small>
                        </div>
                      </div>
                      <div class="col-sm-1">
                      <i class="menu-arrow"></i>
                      </div>
                      </div> 
                   <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-sm-2">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>images/userimage.jpg" alt="profile image">
                      </div>  
                      <div class=" col-sm-3">
                      <div class="row">
                        <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Name Of Candidate</p> <br>
                         <small class="mb-0 mr-2 text-muted text-muted">Age :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small>
                        </div>
                        <div class="row">
                         <small class="mb-0 mr-2 text-muted text-muted">Sex  :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small>
                        </div>
                      </div>
                      <div class="col-sm-1">
                      <i class="menu-arrow"></i>
                      </div>
                      </div>
                        <div class=" d-flex" >
                            <a href="#"><small>View More</small></a>
                          </div>
                      </div>
                </div>
              </div>
              </div>
          </div>

            
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row d-none d-sm-flex mb-4">
                    <div class="col-4">
                      <h5 class="text-primary">Unique Visitors</h5>
                      <p>34657</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Bounce Rate</h5>
                      <p>45673</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Active session</h5>
                      <p>45673</p>
                    </div>
                  </div>
                  <div class="chart-container">
                    <canvas id="dashboard-area-chart" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Orders</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            First name
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Sales
                          </th>
                          <th>
                            Deadline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium">
                            1
                          </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            2
                          </td>
                          <td>
                            Messsy Adam
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td class="text-success"> 24.56%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            3
                          </td>
                          <td>
                            John Richards
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $138.00
                          </td>
                          <td class="text-danger"> 28.76%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            Apr 12, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            4
                          </td>
                          <td>
                            Peter Meggik
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.45%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            5
                          </td>
                          <td>
                            Edward
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 160.25
                          </td>
                          <td class="text-success"> 18.32%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            May 03, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            6
                          </td>
                          <td>
                            Henry Tom
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 150.00
                          </td>
                          <td class="text-danger"> 24.67%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            June 16, 2015
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
             
          
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        
        
      
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Profile"
    },
    axisY:{
        includeZero: false
    },
    data: [{        
        type: "line",       
        dataPoints: [
            { x: 20/3, y:1,},
            { x: 21/3, y:2,}, 
            { x: 22/3, y:1,}, 
            { x: 23/3, y:15,},
            { x: 24/3, y:3,},
            { x:25/3,  y:5,}, 
            { x:26/3, y: 5,}
            ]
    }]
});
chart.render();

}


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
        
   <div class="modal fade" id="FranchiseeWelcome" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body">
                    <div style="padding:10px;">
                    <h3 style="text-align:left;margin-top:0px">Welcome <?php echo "<b style='color:red'>";echo $_Franchisee['PersonName'] ; echo "</b>";?></h3><br>
                    <input type="button" class="btn btn-primary" onclick="VisitedWelcomeMsg();" name="welcomebutton" value="Continue"/>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body">
                    <div id="Mobile_VerificationBody" style="height: 315px;">
                   Loading ....
                </div>
            </div>
        </div>
    </div>
</div>

 
<script>
var API_URL = "http://nahami.online/sl/Dashboard/Webservice/webservice.php?LoginID=<?php echo $_Franchisee['LoginID'];?>&";
     function VisitedWelcomeMsg() {
         $('#FranchiseeWelcome').modal('hide'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=VisitedWelcomeMsg", 
                        success: function(result2){
                           FCheckVerification();
                               
                        }
                    });
    }
   
    function MobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Franchisee&a=MobileNumberVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
    function ChangeMobileNumberF() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=ChangeMobileNumber", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
    function EmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Franchisee&a=EmailVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    ); 
    }  
    
    function ChangeEmailID() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
    function FCheckVerification() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=CheckVerification", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    } 
     function MobileNumberOTPVerification(frmid) {
         
         $('#errormsg').html("");
         if ($.trim($("#mobile_otp_2").val()).length!=4){
         $('#errormsg').html("Verification code is invalid");
         return false;
         }
                         
         var param = $( "#"+frmid).serialize();
         $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
                    $.post("http://nahami.online/sl/Dashboard/Webservice/webservice.php?m=Franchisee&a=MobileNumberOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }
     function EmailOTPVerification(frmid1) {
         
         $('#errormsg').html("");
         if ($.trim($("#email_otp").val()).length!=4){
         $('#errormsg').html("Verification code is invalid");
         return false;
         }
         
         var param = $( "#"+frmid1).serialize();
         $('#Mobile_VerificationBody').html("<div style='text-align:center;padding-top: 35%;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
                    $.post("http://nahami.online/sl/Dashboard/Webservice/webservice.php?m=Franchisee&a=EmailOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }
   <?php    
    $t=$mysql->select("select * from _tbl_franchisees_staffs where  FranchiseeID='".$_Franchisee['FranchiseeID']."'");
    if($t[0]['WelcomeMsg']==1){
        if($t[0]['IsMobileVerified']==0 || $t[0]['IsEmailVerified']==0){
               ?>
    $( document ).ready(function() {
    FCheckVerification();
});
<?php }}else{
    ?>
     $( document ).ready(function() {
   $("#FranchiseeWelcome").modal('show');
});
      
    <?php
} 
?>
     $('#Errmobile_otp').html("");
     $('#Erremail_otp').html("");

                      
                      
                      
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php print_r($t);?>
