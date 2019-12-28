         <!--<div class="row purchace-popup">
            <div class="col-12">
            <span class="d-flex alifn-items-center">
                <p>Like what you see? Check out our premium version for more.</p>
                <a href="https://github.com/BootstrapDash/StarAdmin-Free-Bootstrap-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                <i class="mdi mdi-close popup-dismiss"></i>
              </span>
            </div>
          </div> -->
<?php 
     $response = $webservice->getData("Admin","GetDashBoardItems",array()); 
?>

          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left"> 
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['MemberCount'] as $member) { ?>
                    <div class="float-right">
                      <p class="mb-0 text-right">Members</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $member['cnt']?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
					<p class="float-left"> 
					<i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Members/ManageMember">View</a>
					</p>
					<p class="float-right"> 
					Banned : 0
					</p>
                  </p>
                </div>
              </div> 
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['ProfileCount'] as $profile) { ?>
                    <div class="float-right">
                      <p class="mb-0 text-right">Active Profiles</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $profile['cnt']?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
				  <p class="float-left">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Profiles/Published">View</a>
				</p>	
				<p class="float-right"> 
					Banned : 0
					</p>
				 </p>
                </div>
              </div>
            </div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['ProfileVerification'] as $profv) { ?>
                    <div class="float-right">
                      <p class="mb-0 text-right">Submitted Profiles</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $profv['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Profiles/Requested">View</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <?php //foreach($response['data']['Document'] as $doc) { ?>
                    <div class="float-right">
                      <p class="mb-0 text-right">Expired Profiles</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0<?php //echo $doc['cnt']?></h3>
                      </div>
                    </div>
                    <?php// }?>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
                  </p></div>
            </div>
            </div>
            
          </div>
          <div class="row">
            <div class="col-lg-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Earning Chart</h4>
                  <canvas id="barChart" style="height:250px"></canvas>
                </div>
              </div>
            </div> 
           <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card" style="height: 164px;">
              <div class="card card-statistics">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['Document'] as $doc) { ?>
                    <div class="float-right">
                      <p class="mb-0 text-right">Document Verification (Member)</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $doc['cnt']?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Requests/Member/ViewDocumentsVerification">View</a>
                  </p>
                </div>
			</div>
              <br>
              <div class="card card-statistics" style="margin-top: 42px;">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <?php //foreach($response['data']['FranchiseeWalletRequestCount'] as $FranchiseeReqCount) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Profile Verification</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0<?php //echo $FranchiseeReqCount['cnt'];?></h3>
                      </div>
                    </div>
                    <?php// }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
                  </p>
                </div>
              </div>
              <br>
              <div class="card card-statistics" style="margin-top: 42px;">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <?php //foreach($response['data']['FranchiseeWalletRequestCount'] as $FranchiseeReqCount) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Profile Verification</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0<?php //echo $FranchiseeReqCount['cnt'];?></h3>
                      </div>
                    </div>
                    <?php// }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
                  </p>
                </div>
              </div>
       </div> 
       </div>
       </div>
       <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['OrderCount'] as $order) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Order Value</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $order['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="#">View</a>
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
                     <?php foreach($response['data']['InvoiceCount'] as $invoice) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Invoice Value</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $invoice['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="#">View</a>  
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
                    <?php foreach($response['data']['FranchiseeWalletRequestCount'] as $FranchiseeReqCount) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Wallet Update Request<br>( Franchisee )</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $FranchiseeReqCount['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Requests/Franchisee/ListOfFranchiseeAllBankRequests">View</a>
                  </p></div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['MemberWalletRequestCount'] as $MemberReqCount) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Wallet Update Request<br>( Member )</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $MemberReqCount['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Requests/Member/ListOfAllBankRequests">View</a>
                  </p>
                </div>
              </div>
            </div>
			
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Recent Members </h5>
                  <div class="fluid-container">
                   <?php foreach($response['data']['Member'] as $mem) { ?>
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-sm-2">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="profile image">
                      </div>  
                      <div class=" col-sm-3">
                      <div class="row">
                        <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Name Of Candidate: <?php echo $mem['MemberName'];?></p> <br>
                         <small class="mb-0 mr-2 text-muted text-muted">Age :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small> </div>
                        <div class="row">
                         <small class="mb-0 mr-2 text-muted text-muted">Sex  :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted"><?php echo $mem['Sex'];?></small>
                        </div>
                      </div>
                      <div class="col-sm-1">
                      <i class="menu-arrow"></i>
                      </div>
                      </div>
                      <?php }?> 
                    <div class=" d-flex" >
                            <a href="<?php echo SiteUrl?>Members/ManageMember"><small>View More</small></a>
                          </div>
                 </div>
            </div>
          </div>
          </div>
          <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Recent Draft Profiles </h5>
                  <div class="fluid-container">
                   <?php foreach($response['data']['Profile'] as $prof) { ?>
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-sm-2">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="profile image">
                      </div>  
                      <div class=" col-sm-3">
                      <div class="row">
                        <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Name Of Candidate: <?php echo $prof['ProfileName'];?></p> <br>
                         <small class="mb-0 mr-2 text-muted text-muted">Age :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted">xxx</small> </div>
                        <div class="row">
                         <small class="mb-0 mr-2 text-muted text-muted">Sex  :</small>  
                         <small class="mb-0 mr-2 text-muted text-muted"><?php echo $prof['Sex'];?></small>
                        </div>
                      </div>
                      <div class="col-sm-1">
                      <i class="menu-arrow"></i>
                      </div>
                      </div>
                      <?php }?> 
                    <div class=" d-flex" >
                            <a href="<?php echo SiteUrl?>Profiles/Drafted"><small>View More</small></a>
                          </div>
                 </div>
            </div>
          </div>
          </div>   
      </div> 
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <?php foreach($response['data']['OrderCount'] as $order) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Order Value</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $order['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="#">View</a>
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
                     <?php foreach($response['data']['InvoiceCount'] as $invoice) { ?>     
                    <div class="float-right">
                      <p class="mb-0 text-right">Invoice Value</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $invoice['cnt'];?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="#">View</a>  
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
                    <?php foreach($response['data']['PaypalCount'] as $paypal) { ?>  
                    <div class="float-right">
                      <p class="mb-0 text-right">Paypal Balance</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $paypal['cnt']?></h3>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                   <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="#">View</a>
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
                      <p class="mb-0 text-right"></p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">0</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Requests/Member/ListOfAllBankRequests">Renew</a>
                  </p>
                </div>
              </div>
            </div>
          </div> 
          
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">SMS Send Graph</h4>
                  <canvas id="barChart" style="height:250px"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Email Send Graph</h4>
                  <canvas id="barChart" style="height:230px"></canvas>
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
    theme: "light1",
    title:{
        text: "Earnings"
    },
    axisY:{
        includeZero: false
    },
    data: [{        
        type: "line",       
        dataPoints: [
            { y: 10000},
            { y: 20000,},
            { y: 12000 },
            { y: 35000},
            { y: 17000 }
        ]
    }]
});
chart.render();

}
</script>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
