
<?php   
    if (isset($_POST['BtnSavePlan'])) {

        $response = $webservice->getData("Admin","EditMemberPlan",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","GetMemberPlanInfo");
    $Plan          = $response['data']['Plans'];
    $Subscribed = $response['data']['SubscribedPlan'];
	$Currency = $response['data']['Currency'];

 ?>  


<script>

$(document).ready(function () {
  $("#FranchiseeCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrFranchiseeCommission").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   
   $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    
   $("#PlanCode").blur(function () {
    
        IsNonEmpty("PlanCode","ErrPlanCode","Please Enter Plan Code");
                        
   });
   $("#PlanName").blur(function () {
    
        IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name");
                        
   });
   $("#Decreation").blur(function () {
    
        IsNonEmpty("Decreation","ErrDecreation","Please Enter Decreation");
                        
   });
   $("#Amount").blur(function () {
    
        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        
   });
   $("#FranchiseeCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("FranchiseeCommissionWithPercentage","ErrFranchiseeCommissionWithPercentage","Please Enter Franchisee Commission");
                        
   });
   $("#FranchiseeCommissionWithRupees").blur(function () {
    
        IsNonEmpty("FranchiseeCommissionWithRupees","ErrFranchiseeCommissionWithRupees","Please Enter Franchisee Commission");
                        
   });
   $("#Photos").blur(function () {
    
        IsNonEmpty("Photos","ErrPhotos","Please Upload photos");
                        
   });
    $("#Freeprofiles").blur(function () {
    
        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Free profiles");
                        
   });
   $("#ShortDescription").blur(function () {
    
        IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter Short Description");
                        
   });
   $("#DetailDescription").blur(function () {
    
        IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Detail Description");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
   });

function SubmitNewPlan() {
                         $('#ErrPlanName').html("");
                         $('#ErrDecreation').html("");
                         $('#ErrAmount').html("");
                         $('#ErrFranchiseeCommissionWithPercentage').html("");
                         $('#ErrFranchiseeCommissionWithRupees').html("");
                         $('#ErrPhotos').html("");
                         $('#ErrVideos').html("");
                         $('#ErrFreeprofiles').html("");
                         $('#ErrShortDescription').html("");
                         $('#ErrDetailDescription').html("");
                         $('#ErrRemarks').html("");
                         ErrorCount=0;
                         
                         
                        if (IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name")) {
                            IsAlphabet("PlanName","ErrPlanName","Please Enter Alphabets characters only");    
                        }
                        IsNonEmpty("Decreation","ErrDecreation","Please Enter Decreation");
                        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        if (parseInt($('#FranchiseeCommissionWithPercentage').val())>0 && parseInt($('#FranchiseeCommissionWithPercentage').val())==0) {
                           
                        } else if (parseInt($('#FranchiseeCommissionWithPercentage').val())==0 && parseInt($('#FranchiseeCommissionWithPercentage').val())>0) {
                             
                        } else {
                            $('#ErrFranchiseeCommissionWithPercentage').html("Either % or Rs Must be Zero");
                        }
                        IsNonEmpty("Photos","ErrPhotos","Please upload Photos");
                     //   IsNonEmpty("Videos","ErrVideos","Please upload Videos");
                        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Freeprofiles");
                        IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter Short Description");
                        IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Detail Description");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
                         if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script> 
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
								<label for="Plan Code" class="col-sm-3 col-form-label">Plan Code</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="PlanCode" disabled="disabled" name="PlanCode" value="<?php echo $Plan['PlanCode'];?>" placeholder="Plan Code">
									<span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="PlanName" class="col-sm-3 col-form-label">Plan Name<?php if($Subscribed['cnt']>0){ } else { ?><span id="star">*</span><?php } ?></label>
								<div class="col-sm-9">
								<?php if($Subscribed['cnt']>0){ ?> 
									<input type="text" disabled="disabled" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : $Plan['PlanName']);?>" placeholder="Plan Name">
									<span style="font-size: 12px;color: #999;">couldn't able to edit, because this plan has subscribed <?php echo $Subscribed['cnt'];?> members</span>
								<?php } else { ?>
									<input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : $Plan['PlanName']);?>" placeholder="Plan Name">
									<span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
								<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="Decreation" class="col-sm-3 col-form-label">Duration<?php if($Subscribed['cnt']>0){ } else { ?><span id="star">*</span><?php } ?></label>
								<div class="col-sm-4">
								<?php if($Subscribed['cnt']>0){ ?> 
									<div class="input-group">
										<input type="text" disabled="disabled" class="form-control" id="Decreation" name="Decreation" value="<?php echo (isset($_POST['Decreation']) ? $_POST['Decreation'] : $Plan['Decreation']);?>" placeholder="Duration" style="text-align:right">
										<div class="input-group-addon">days</div>
									</div>
									<span style="font-size: 12px;color: #999;">couldn't able to edit</span>	
								<?php } else { ?>
									<div class="input-group">
										<input type="text" class="form-control" id="Decreation" name="Decreation" value="<?php echo (isset($_POST['Decreation']) ? $_POST['Decreation'] : $Plan['Decreation']);?>" placeholder="Duration" style="text-align:right">
										<div class="input-group-addon">days</div>
									</div>
									<span class="errorstring" id="ErrDecreation"><?php echo isset($ErrDecreation) ? $ErrDecreation : "";?></span>
								<?php } ?>
								 </div>
							</div>
							<div class="form-group row">
								<label for="Amount" class="col-sm-3 col-form-label">Amount<?php if($Subscribed['cnt']>0){ } else { ?><span id="star">*</span><?php } ?></label>
								<div class="col-sm-4">
								<?php if($Subscribed['cnt']>0){ ?> 
									<div class="input-group">
										<div class="input-group-addon"><?php echo $Currency;?></div>
											<input type="text" disabled="disabled" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : $Plan['Amount']);?>" placeholder="Amount">
									</div>
									<span style="font-size: 12px;color: #999;">couldn't able to edit</span>	
								<?php } else { ?>
									<div class="input-group">
										<div class="input-group-addon"><?php echo $Currency;?></div>
										<input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : $Plan['Amount']);?>" placeholder="Amount">
									</div>
									<span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
								<?php } ?>
								 </div>
							</div>
							<div class="form-group row">
								<label for="Benefits" class="col-sm-3 col-form-label">Benefits<?php if($Subscribed['cnt']>0){ } else { ?><span id="star">*</span><?php } ?></label>
								<div class="col-sm-4">
								<?php if($Subscribed['cnt']>0){ ?> 
									<div class="input-group">
										<div class="input-group-addon">Photos</div>
											<input type="text" disabled="disabled" class="form-control" id="Photos" name="Photos" value="<?php echo (isset($_POST['Photos']) ? $_POST['Photos'] : $Plan['Photos']);?>" placeholder="0">
									</div>
									<span style="font-size: 12px;color: #999;">couldn't able to edit</span>	
								<?php } else { ?>
									<div class="input-group">
										<div class="input-group-addon">Photos</div>
										<input type="text" class="form-control" id="Photos" name="Photos" value="<?php echo (isset($_POST['Photos']) ? $_POST['Photos'] : $Plan['Photos']);?>" placeholder="0">
									</div>
									<span class="errorstring" id="ErrPhotos"><?php echo isset($ErrPhotos) ? $ErrPhotos : "";?></span>
								<?php } ?>
								</div>   
							</div>
							<!--<div class="form-group row">
								<div class="col-sm-3"></div>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">Videos</div>
										<input type="text" class="form-control" id="Videos" name="Videos" value="<?php echo (isset($_POST['Videos']) ? $_POST['Videos'] : $Plan['Videos']);?>" placeholder="0">
									</div>
									<span class="errorstring" id="ErrVideos"><?php echo isset($ErrVideos) ? $ErrVideos : "";?></span>
								</div>    
							</div>-->
							<div class="form-group row">	
								<div class="col-sm-3"></div>
								<div class="col-sm-4">
								<?php if($Subscribed['cnt']>0){ ?> 
									<div class="input-group">
										<div class="input-group-addon">Profiles</div>
											<input type="text" disabled="disabled" class="form-control" id="Freeprofiles" name="Freeprofiles" value="<?php echo (isset($_POST['Freeprofiles']) ? $_POST['Freeprofiles'] : $Plan['FreeProfiles']);?>" placeholder="0">
									</div>
									<span style="font-size: 12px;color: #999;">couldn't able to edit</span>	
								<?php } else { ?>
									<div class="input-group">
										<div class="input-group-addon">Profiles</div>
										<input type="text" class="form-control" id="Freeprofiles" name="Freeprofiles" value="<?php echo (isset($_POST['Freeprofiles']) ? $_POST['Freeprofiles'] : $Plan['FreeProfiles']);?>" placeholder="0">
									</div>
									<span class="errorstring" id="ErrFreeprofiles"><?php echo isset($ErrFreeprofiles) ? $ErrFreeprofiles : "";?></span>
								<?php } ?>
								 </div>
							</div>
							<div class="form-group row">
								<label for="ShortDescription" class="col-sm-3 col-form-label">Short Description<span id="star">*</span></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="ShortDescription" name="ShortDescription" value="<?php echo (isset($_POST['ShortDescription']) ? $_POST['ShortDescription'] : $Plan['ShortDescription']);?>" placeholder="Short Description">
									<span class="errorstring" id="ErrShortDescription"><?php echo isset($ErrShortDescription) ? $ErrShortDescription : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="DetailDescription" class="col-sm-3 col-form-label">Detail Description<span id="star">*</span></label>
								<div class="col-sm-9">
									<textarea rows="5" class="form-control" id="DetailDescription" name="DetailDescription"><?php echo (isset($_POST['DetailDescription']) ? $_POST['DetailDescription'] : $Plan['DetailDescription']);?> </textarea>
									<span class="errorstring" id="ErrDetailDescription"><?php echo isset($ErrDetailDescription) ? $ErrDetailDescription : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="Remarks" class="col-sm-3 col-form-label">Remarks<span id="star">*</span></label>
								<div class="col-sm-9">
									<textarea rows="5" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Plan['Remarks']);?> </textarea>
									<span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
								</div>
							</div>
                            <div class="form-group row">                           
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="IsDefault" name="IsDefault" <?php echo ($Plan['IsDefault']==1) ? ' checked="checked" ' :'';?>>
                                        <label class="custom-control-label" for="IsDefault" style="vertical-align: middle;">Make as Default Plan</label>
                                    </div>
                                </div>
                            </div>
					</div>
				</div>
            </div>
		</div>
		<br>
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
			&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="Member.ConfirmGotoBackFromEditPlan()">Cancel</a>&nbsp;
			<a href="javascript:void(0)" onclick="Member.ConfirmEditMemberPlan()" class="btn btn-primary" name="BtnupdateStaff">Update Plan</a>
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
		<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/Plan/View/". $Plan['PlanCode'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">View Plan</small></a></div>
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