<?php $response = $webservice->getData("Admin","GetMemberPlanInfo");
    $Plan          = $response['data']['Plans'];
    $Subscribed          = $response['data']['SubscribedPlan'];?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
	<input type="hidden" value="<?php echo $Plan['PlanCode'];?>" name="PlanCode" id="PlanCode">
<div class="form-group row">
	<div class="col-sm-9">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<div style="padding:15px !important;max-width:770px !important;">
						<h4 class="card-title">Edit Member Plan</h4>
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
							<div class="col-sm-4"><small style="color:#737373;"><?php echo $Subscribed['cnt'];?></small></div>
						</div>
					</div>
				</div>
            </div>
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
		<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/Plan/ManagePlan");?>"><small style="font-weight:bold;text-decoration:underline">List of Plans</small></a></div>
		<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/Plan/EditPlan/". $Plan['PlanCode'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">Edit Plan</small></a></div>
        <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">View Subscribed</small></a></div>
		<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Delete</small></a></div>
        <div class="col-sm-12 col-form-label"><?php if($Plan['IsActive']==1) { ?>
			<a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>                                   
			 <?php } else {    ?>
				<a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Active</small></a>                                   
			<?php } ?>
		</div>
                            
	</div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
		
			</div>
		</div>
	</div>