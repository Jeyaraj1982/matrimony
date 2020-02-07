<style>
#verifybtn{background: #0eb1db;;border:1px#32cbf3;box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
#verifybtn:hover{background:#149dc9;}
input:focus{border:1px solid #ccc;}
#errormsg{text-align:center;color:red;padding-bottom:5px;padding-top:5px;}
</style>
<?php 
$response = $webservice->getData("Franchisee","DashboardCounts");
$MemberCount = $response['data']['Member'];
$DraftedProfilesCount = $response['data']['DraftedProfiles'];
$PostedProfilesCount = $response['data']['PostedProfiles'];

?>
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">My Member</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $MemberCount['cnt']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("Members/ManageMembers");?>">View</a>
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
                      <p class="mb-0 text-right">Drafted Profiles</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $DraftedProfilesCount['cnt'];?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("DraftedProfiles");?>">View</a>
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
                      <p class="mb-0 text-right">Posted Profile</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $PostedProfilesCount['cnt'];?></h3>
                      </div>
                    </div>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                     <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("PostedProfiles");?>">View</a>
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
                      <p class="mb-0 text-right">My Wallet</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>">Renew</a>
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
                <h5 class="card-title">My Earnings </h5>
                  <div id="chartContainer" style="height: 100%; width: 100%;"></div>
                    
                  </div>
                </div>
                 </div>
              <!--weather card ends-->
            
     <div class="col-5 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Upcomming Renewals </h5>
                
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
                      <h5 class="text-primary">My Orders</h5>
                      <p>0</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">My Invoices</h5>
                      <p>0</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">My Payments</h5>
                      <p>0</p>
                    </div>
                  </div>
                  <div class="chart-container">
                    <canvas id="dashboard-area-chart" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div> 
      
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

<div class="modal" id="myModal" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Mobile_VerificationBody"  style="max-height: 529px;min-height: 529px;" >
                    <img src='../../../images/loader.gif'> Loading ....
                </div>
            </div>
        </div>
   
<script>
   <?php  
   if($fInfo['data']['WelcomeMsg']!=1) {?>
            $( document ).ready(function() {$("#FranchiseeWelcome").modal('show');});
   <?php } ?>
</script>


