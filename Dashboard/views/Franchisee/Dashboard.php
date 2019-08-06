<style>
#verifybtn{background: #0eb1db;;border:1px#32cbf3;box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
#verifybtn:hover{background:#149dc9;}
input:focus{border:1px solid #ccc;}
#errormsg{text-align:center;color:red;padding-bottom:5px;padding-top:5px;}
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
                                 
                      </tbody>
                   </table> 
                </div>
                <div class=" d-flex" >
                   <a href=""><small>View More</small></a>
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
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>assets/images/userimage.jpg" alt="profile image">
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



  <?php //   $fInfo = $webservice->getData("Franchisee","GetMyProfile");  ?>   
<script>
   <?php  
  /*  if ($fInfo['status']=="success") {
        if($fInfo['data']['WelcomeMsg']==1) {
            if($fInfo['data']['IsMobileVerified']==0 || $fInfo['data']['IsEmailVerified']==0){
            ?>
                $( document ).ready(function() {FCheckVerification();});
            <?php 
            }
        } else {
   ?>
            $( document ).ready(function() {$("#FranchiseeWelcome").modal('show');});
   <?php 
        } 
        
    } else {
            //logout invalid session
    } */
   ?>
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

