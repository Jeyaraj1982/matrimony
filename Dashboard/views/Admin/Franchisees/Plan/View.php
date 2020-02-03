 <?php  
  $response = $webservice->getData("Admin","GetFranchiseePlanInfo");
    $Plan     = $response['data']['Plan'];
?>
<form method="post" id="frmfrn">
    <div class="form-group row">
        <div class="col-sm-9">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div style="padding:15px !important;max-width:770px !important;">
                            <h4 class="card-title">Franchisees</h4>                                                                                          
                            <h4 class="card-title">View Plan</h4>                                                                                           
                                <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Plan Code</label>
                                            <div class="col-sm-2"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['PlanCode'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Plan Name</label>
                                            <div class="col-sm-8"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['PlanName'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Duration</label>
                                            <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['Duration'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Amount</label>
                                            <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Plan['Amount'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Profile Active Commission</label>
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
                                            <label class="col-sm-3 col-form-label">Wallet Refill Commission</label>
                                            <div class="col-sm-3">
                                               <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['RefillCommissionWithPercentage']>0){
                                                echo $Plan['RefillCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['RefillCommissionWithRupees'];  echo "&nbsp"; echo "INR";
                                                  }
                                                  ?>         
                                            </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Profile download Commission</label>
                                            <div class="col-sm-3">
                                                <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['ProfileDownloadCommissionWithPercentage']>0){
                                                echo $Plan['ProfileDownloadCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['ProfileDownloadCommissionWithRupees'];  echo "&nbsp"; echo "INR";
                                                  }
                                                  ?>         
                                            </small>
                                        </div>
                                       </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Profile Renewal Commission</label>
                                            <div class="col-sm-3">
                                            <small style="color:#737373; padding-top:50px;">
                                               <?php if($Plan['RenewalCommissionWithPercentage']>0){
                                                echo $Plan['RenewalCommissionWithPercentage'];echo "&nbsp"; echo "%";
                                                 }                                  
                                                 else{
                                                 echo $Plan['RenewalCommissionWithRupees'];  echo "&nbsp"; echo "INR";
                                                  }
                                                  ?>         
                                            </small>
                                        </div>
                                       </div>    
                        </div>
                    </div>
                </div>
            </div>
           <br>
          <div class="col-12 grid-margin" style="padding-right:0px;text-align: right;">
            &nbsp;<a href="javascript:void(0)" onclick="Franchisee.ConfirmGotoBackFromCreatePlan()" class="btn btn-default" style="padding:7px 20px">Cancel</a>
          </div>
        </div>
        <div class="col-sm-3">
            <div class="col-sm-12 col-form-label">
                <span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                 &nbsp;&nbsp;&nbsp;
                 <small style="color:#737373;">
                    <?php if($Plan['IsActive']==1){
                      echo "Active";
                    }else{
                      echo "Deactive";
                    }?>
                 </small>
            </div>
        <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/Plan/ManagePlan");?>"><small style="font-weight:bold;text-decoration:underline">List of Plans</small></a></div>
        <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/Plan/Edit/". $Plan['PlanCode'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Plan</small></a></div>
        <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">View Subscribed</small></a></div>
        <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Delete</small></a></div>
        <div class="col-sm-12 col-form-label"><?php if($Plan['IsActive']==1) { ?>
            <a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>                                   
             <?php } else {    ?>
                <a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Active</small></a>                                   
            <?php } ?>
        </div>
    </div>
        </div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
                </div>
            </div>
        </div>