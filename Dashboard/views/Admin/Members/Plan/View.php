  <?php $response = $webservice->getData("Admin","GetMemberPlanInfo");
    $Plan          = $response['data'];?>
<form method="post" action="" onsubmit="return SubmitNewPlan();">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">View Plan</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                            <div class="col-sm-3">Plan Code</div>
                                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Plan['PlanCode'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Plan Name</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['PlanName'];?></small></div>
                                            </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Duration</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['Decreation'];?> &nbsp;&nbsp;days</small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Amount</div>
                                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Plan['Amount'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Photo</div>
                                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Plan['Photos'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">Video</div>
                                            <div class="col-sm-3"><small style="color:#737373;"><?php echo $Plan['Videos'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">Free Profiles</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['FreeProfiles'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">Short Description</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['ShortDescription'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">Detail Description</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['DetailDescription'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">Status</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;
                                            <?php if($Plan['IsActive']==1){
                                                echo "Active";
                                                }                                  
                                                else{
                                                echo "Deactive";
                                                 }?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">Created On</div>
                                            <div class="col-sm-4"><small style="color:#737373;"><?php echo $Plan['CreatedOn'];?></small></div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-sm-3">No of Profiles</div>
                                            <div class="col-sm-4"><small style="color:#737373;"></small></div>
                                        </div>
                                 </form>
                                 </div>
                             </div>
                           </div>
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManagePlan"><small style="font-weight:bold;text-decoration:underline">List of Plans</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/Plan/EditPlan/".$_GET['Code'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">Edit Plan</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/Plan/Delete/".$_GET['Code'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">Delete Plan</small></a>
</div>
</form>
                       
                                            
                                 