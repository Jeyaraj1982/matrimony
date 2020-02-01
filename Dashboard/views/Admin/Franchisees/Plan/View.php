<?php  
  $response = $webservice->getData("Admin","GetFranchiseePlanInfo");
    $Plan     = $response['data'];
?>   
<form method="post" action="" onsubmit="return SubmitNewPlan();">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Franchisees</h4>                                                                                          
                             <h4 class="card-title">View Plan</h4>                                                                                          
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                            <div class="col-sm-3">Plan Code</div>
                                            <div class="col-sm-2"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['PlanCode'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Plan Name</div>
                                            <div class="col-sm-8"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['PlanName'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Duration</div>
                                            <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['Duration'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Amount</div>
                                            <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['Amount'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Profile Active Commission</div>
                                            <div class="col-sm-3"> <small style="color:#737373; padding-top:50px;">
                                            <?php if($Plan['ProfileCommissionWithPercentage']>0){
                                                echo $Plan['ProfileCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['ProfileCommissionWithRupees'];
                                                  }
                                                  ?>         
                                            </small>
                                            </div>  
                                        </div>                              
                                        <div class="form-group row">
                                            <div class="col-sm-3">Wallet Refill Commission</div>
                                            <div class="col-sm-3">
                                               <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['RefillCommissionWithPercentage']>0){
                                                echo $Plan['RefillCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['RefillCommissionWithRupees'];  echo "&nbsp"; echo "RS";
                                                  }
                                                  ?>         
                                            </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Profile download Commission</div>
                                            <div class="col-sm-3">
                                                <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['ProfileDownloadCommissionWithPercentage']>0){
                                                echo $Plan['ProfileDownloadCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['ProfileDownloadCommissionWithRupees'];  echo "&nbsp"; echo "RS";
                                                  }
                                                  ?>         
                                            </small>
                                        </div>
                                       </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Profile Renewal Commission</div>
                                            <div class="col-sm-3">
                                            <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['RenewalCommissionWithPercentage']>0){
                                                echo $Plan['RenewalCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['RenewalCommissionWithRupees'];  echo "&nbsp"; echo "RS";
                                                  }
                                                  ?>         
                                            </small>
                                        </div>
                                       </div>
                                        <button type="submit" name="BtnSavePlan" class="btn btn-primary mr-2">Create Plan</button>
                                        <a href="../ManagePlan" style="text-decoration: underline;"><small>List of Plans</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
</form>