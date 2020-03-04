<?php 
  if (isset($_POST['boardmsgbutton'])) {
        //$response = $webservice->WelcomeMessage();
        $response = $webservice->getData("Franchisee","BoardMessage",$_POST);
    }
?>
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
    $PublishedProfilesCount = $response['data']['PublishedProfiles'];
    $MaleProfileCount = $response['data']['MaleProfileCount'];
    $FemaleProfileCount = $response['data']['FemaleProfileCount'];
    $OnlineMembercount = $response['data']['OnlineMembercount'];
    $FreeMemberCount = $response['data']['FreeMemberCount'];
    $LandingPageProfileCount = $response['data']['LandingPageProfileCount'];
    $FranchiseeStaffCount = $response['data']['FranchiseeStaffCount'];
    $PaidMemberCount = $response['data']['PaidMemberCount'];
    $documentverification = $response['data']['documentverification'];
    $ordercount = $response['data']['ordercount'];
    $invoicecount = $response['data']['invoicecount'];
    $FranchiseeWalletRequestCount = $response['data']['FranchiseeWalletRequestCount'];
    $MemberWalletRequestCount = $response['data']['MemberWalletRequestCount'];
?>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body" style="padding: 0.88rem 0.81rem;">
                <div class="clearfix">
                    <div class="float-left"> 
                      <!--<i class="mdi mdi-cube text-danger icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">My Members</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $MemberCount['cnt']; ?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">                                                                               
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("Members/ManageMembers");?>">View</a>
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
                        <!--<i class="mdi mdi-receipt text-warning icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Active Profiles</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $PublishedProfilesCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("PublishedProfiles");?>">View</a>
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
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Submitted to Review</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $PostedProfilesCount['cnt'];?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i><a href="<?php echo GetUrl("PostedProfiles");?>">View</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body" style="padding: 0.88rem 0.81rem;">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-poll-box text-success icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Expired Profiles</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">0<?php //echo $doc['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body" style="padding: 0.88rem 0.81rem;">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Groom</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $MaleProfileCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Profiles/PublishedGroom">View</a>
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
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i> -->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Bride</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $FemaleProfileCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Profiles/PublishedBride">View</a>
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
                        <!-- <i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Online Members</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $OnlineMembercount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Members/ManageOnlineMembers">View</a>
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
                      <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Free Members</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $FreeMemberCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Members/ManageFreeMembers">View</a>
                    </p>    
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body" style="padding: 0.88rem 0.81rem;">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Landing Page Profiles</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $LandingPageProfileCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Profiles/Published">View</a>
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
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Staffs</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $FranchiseeStaffCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Franchisees/MangeFranchisees">View</a>
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
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right"></p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
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
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right"></p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a>View</a>
                    </p>    
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Earning Chart</h4>
                <!--<canvas id="barChart" style="height:250px"></canvas>-->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card" style="height: 164px;">
        <div class="card card-statistics">
            <div class="card-body" style="padding: 0.88rem 0.81rem;">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-account-location text-info icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Paid Members</p>
                        <div class="fluid-container"> 
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $PaidMemberCount['cnt']?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <p class="float-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Members/ManagePaidMembers">View</a>
                    </p>    
                </p>
            </div>
            <br>
            <div class="card card-statistics" style="margin-top: 42px;">
                <div class="card-body" style="padding: 0.88rem 0.81rem;">
                    <div class="clearfix">
                        <div class="float-left">
                            <!--<i class="mdi mdi-poll-box text-success icon-lg"></i>-->
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Document Verification (Member)</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0"><?php echo $documentverification['cnt']?></h3>
                            </div>
                        </div>
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
                        <!--<i class="mdi mdi-cube text-danger icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Order Value</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $ordercount['cnt'];?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Accounts/ManageOrder">View</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-receipt text-warning icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Invoice Value</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $invoicecount['cnt'];?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Accounts/Invoice/Invoices">View</a>  
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">                                                                       
                    <div class="float-left">
                        <!--<i class="mdi mdi-poll-box text-success icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Wallet Update Request<br>( Franchisee )</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $FranchiseeWalletRequestCount['cnt'];?></h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i><a href="<?php echo SiteUrl?>Requests/Franchisee/ListOfFranchiseeAllBankRequests">View</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <!--<i class="mdi mdi-cube text-danger icon-lg"></i>-->
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Wallet Update Request<br>( Member )</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $MemberWalletRequestCount['cnt'];?></h3>
                        </div>
                    </div>
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
        <!--<div class="card">
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
          </div>-->
    <div>
        <div class="member_dashboard_widget_title">Recent Members</div>
            <div class="card" style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                    <?php 
                        $Members = $webservice->getData("Franchisee","GetRecentMembersForDashboard");   
                        $RecentMembers = $Members['data'];  
                        if (sizeof($RecentMembers)>0) {  ?>
                        <div>
                        <?php  foreach($RecentMembers as $RecentMember) { ?>
                            <div class="col-sm-12" id="resCon_a001">
                                <div class="col-sm-10">
                                    <div style="text-align:right;">
                                        <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo $RecentMember['MemberCode'];?></span>
                                    </div><br>
                                    <div><a href="<?php echo GetUrl("Members/ViewMember/".$RecentMember['MemberCode'].".html");?>"><?php echo $RecentMember['MemberName'];?></a></div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <span style="color:#999 !important;"><?php echo $RecentMember['Sex'];?></span> <br>
                                            <span><button class="btn btn-success" style="padding: 0px 4px;font-size: 12px;background: #b3d285;border: #b3d285;"><?php echo $RecentMember['CreatedBy'];?></button> </span>
                                        </div>
                                        <div class="col-sm-6" style="height: 20px;float:right;margin-right: -33px;line-height:12px;font-size: 11px;text-align: right">
                                            <span style="color:#999 !important;">
                                                <br>Created on&nbsp;<?php echo time_elapsed_string($RecentMember['CreatedOn']);?>
                                            </span>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        <?php    }  ?> 
                        </div>
                        <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>Members/ManageMembers">View All</a>
                         </div>
                    <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;">No members found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div>
            <div class="member_dashboard_widget_title">Recent Draft Profiles</div>
                <div class="card" style="background:#dee9ea;">
                    <div class="card-body" style="padding:10px !important;">
                    <?php $DProfile = $webservice->getData("Franchisee","GetRecentProfilesForDashboard",array("ProfileFrom"=>"Draft"));  
                          $RecentProfiles = $DProfile['data'];   
                     if (sizeof($RecentProfiles)>0) {  ?>
                    <div>
                    <?php  foreach($RecentProfiles as $Profiles) { $Profile = $Profiles['ProfileInfo']; ?>
                       <div class="col-sm-12" id="resCon_a001">
                            <div style="text-align:right;">
                                <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo $Profile['ProfileCode'];?></span>
                            </div>      <br>
                            <div class="col-sm-2" style="margin-left:-15px">
                                <div class="enlarge">
                                    <div>
                                        <img src="<?php echo $Profiles['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                                        <span><img src="<?php echo $Profiles['ProfileThumb'];?>" alt="" /><br /><a href="<?php echo GetUrl("Profiles/ViewDraftProfile/".$Profile['ProfileCode'].".htm");?>"><?php echo $Profile['ProfileName'];?></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div style="margin-top:-17px;margin-left: 73px;"><?php echo $Profile['ProfileName'];?></div>
                                <div style="height: 20px">
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['City'];?></span>
                                </div> <br>
                                    <div style="height: 20px;float:right;margin-left: 170px;line-height:12px;font-size: 11px;text-align: right"><span style="color:#999 !important;">
                                        <?php if ($Profile['CreatedOn']!=0) { ?> 
                                            My last visited&nbsp;<?php echo time_elapsed_string($Profile['CreatedOn']);?>
                                        <?php }  ?>
                                    <br />
                            </div> <br>
                        </div>
                    </div>
                <?php  }   ?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                    <a href="<?php echo SiteUrl;?>DraftedProfiles">View All</a>
                </div>
                <?php } else { ?>
                <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                    <div style="text-align:center;">
                        <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;margin-right:185px;margin-left:185px">No profiles found </h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>   
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div>
            <div class="member_dashboard_widget_title">Recent Published Profiles</div>
                <div class="card" style="background:#dee9ea;">
                    <div class="card-body" style="padding:10px !important;">
                    <?php $DProfile = $webservice->getData("Franchisee","GetRecentProfilesForDashboard",array("ProfileFrom"=>"Published"));  
                          $RecentProfiles = $DProfile['data'];   
                     if (sizeof($RecentProfiles)>0) {  ?>
                    <div>
                    <?php  foreach($RecentProfiles as $Profiles) { $Profile = $Profiles['ProfileInfo']; ?>
                       <div class="col-sm-12" id="resCon_a001">
                            <div style="text-align:right;">
                                <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo $Profile['ProfileCode'];?></span>
                            </div>      <br>
                            <div class="col-sm-2" style="margin-left:-15px">
                                <div class="enlarge">
                                    <div>
                                        <img src="<?php echo $Profiles['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                                        <span><img src="<?php echo $Profiles['ProfileThumb'];?>" alt="" /><br /><a href="<?php echo GetUrl("Profiles/ViewDraftProfile/".$Profile['ProfileCode'].".htm");?>"><?php echo $Profile['ProfileName'];?></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div style="margin-top:-17px;margin-left: 73px;"><?php echo $Profile['ProfileName'];?></div>
                                <div style="height: 20px">
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['City'];?></span>
                                </div> <br>
                                    <div style="height: 20px;float:right;margin-left: 170px;line-height:12px;font-size: 11px;text-align: right"><span style="color:#999 !important;">
                                        <?php if ($Profile['CreatedOn']!=0) { ?> 
                                            My last visited&nbsp;<?php echo time_elapsed_string($Profile['CreatedOn']);?>
                                        <?php }  ?>
                                    <br />
                            </div> <br>
                        </div>
                    </div>
                <?php  }   ?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                    <a href="<?php echo SiteUrl;?>PublishedProfiles">View All</a>
                </div>
                <?php } else { ?>
                <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                    <div style="text-align:center;">
                        <h5 style="margin-top: 197px;color: #aaa;font-weight: normal;line-height: 19px;margin-right:185px;margin-left:185px">No profiles found </h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div>
            <div class="member_dashboard_widget_title">Recent Rejected Profiles</div>
                <div class="card" style="background:#dee9ea;">
                    <div class="card-body" style="padding:10px !important;">
                    <?php $DProfile = $webservice->getData("Franchisee","GetRecentProfilesForDashboard",array("ProfileFrom"=>"Rejected"));  
                          $RecentProfiles = $DProfile['data'];   
                     if (sizeof($RecentProfiles)>0) {  ?>
                    <div>
                    <?php  foreach($RecentProfiles as $Profiles) { $Profile = $Profiles['ProfileInfo']; ?>
                       <div class="col-sm-12" id="resCon_a001">
                            <div style="text-align:right;">
                                <span style="color:#333333 !important;font-size: 12px;font-weight:Bold;color:#777;float: left"><?php echo $Profile['ProfileCode'];?></span>
                            </div>      <br>
                            <div class="col-sm-2" style="margin-left:-15px">
                                <div class="enlarge">
                                    <div>
                                        <img src="<?php echo $Profiles['ProfileThumb'];?>" style="border-radius: 50%;width: 100px;border: 1px solid #ddd !important;height: 100px;padding: 5px;background: #fff;" alt="" />
                                        <span><img src="<?php echo $Profiles['ProfileThumb'];?>" alt="" /><br /><a href="<?php echo GetUrl("Profiles/ViewDraftProfile/".$Profile['ProfileCode'].".htm");?>"><?php echo $Profile['ProfileName'];?></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div style="margin-top:-17px;margin-left: 73px;"><?php echo $Profile['ProfileName'];?></div>
                                <div style="height: 20px">
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['Age'];?>&nbsp;yrs</span><br>
                                    <span style="color:#999 !important;margin-left: 73px;"><?php echo $Profile['City'];?></span>
                                </div> <br>
                                    <div style="height: 20px;float:right;margin-left: 170px;line-height:12px;font-size: 11px;text-align: right"><span style="color:#999 !important;">
                                        <?php if ($Profile['CreatedOn']!=0) { ?> 
                                            My last visited&nbsp;<?php echo time_elapsed_string($Profile['CreatedOn']);?>
                                        <?php }  ?>
                                    <br />
                            </div> <br>
                        </div>                                                                                          
                    </div>
                <?php  }   ?> 
                </div>
                <div style="clear:both;padding:3px;text-align:center;">
                    <a href="<?php echo SiteUrl;?>Rejected">View All</a>
                </div>
                <?php } else { ?>
                <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                    <div style="text-align:center;">
                        <h5 style="margin-top: 197px;margin-right:185px;margin-left:185px;color: #aaa;font-weight: normal;line-height: 19px;">No profiles found </h5>
                    </div>
                </div>
                <?php } ?>
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
   <?php } else{ ?>
   <?php if(sizeof($response['data']['Popup'])>0) { ?> 
        $(document).ready(function(){
            $("#FranchiseeBoard").modal('show');
            $(".hide-modal").click(function(){
                $("#FranchiseeBoard").modal('hide');
            });                                                                                            
        });
       <?php } } ?>
</script>
      <div class="modal fade" id="FranchiseeBoard" role="dialog" data-backdrop="static" style="padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" >
            <div class="modal-content" style="max-height: 500px;min-height: 500px;">
                <form method="POST" id="frmBrd" action="">
                <input type="hidden" name="ReqID" value="<?php echo $response['data']['Popup']['ReqID'];?>">
                    <div class="modal-header">   
                        <h4 class="modal-title">Latest Message</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body" style="max-height:375px;min-height: 375px;overflow-y:scroll;">
                            <p style="color:#959494"><?php echo $response['data']['Popup']['Message'];?></p>  <br>
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
  </script>
