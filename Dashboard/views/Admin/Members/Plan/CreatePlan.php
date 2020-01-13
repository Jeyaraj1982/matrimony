
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

 ?>  


<script>
$(document).ready(function () {
  $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#Decreation").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrDecreation").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });

  $("#Photos").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrPhotos").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });

	$("#FreeProfiles").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrFreeProfiles").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#Freeprofiles").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrFreeprofiles").html("Digits Only").show().fadeIn("fast");   
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
   $("#Photos").blur(function () {
    
        IsNonEmpty("Photos","ErrPhotos","Please Number of photos");
                        
   });
   $("#Freeprofiles").blur(function () {
    
        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Number of  Free profiles");
                        
   });
   $("#ShortDescription").blur(function () {
    
        IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter hort Description");
                        
   });
   $("#DetailDescription").blur(function () {
    
        IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Description");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
   });

function SubmitNewPlan() {
                         $('#ErrPlanCode').html("");
                         $('#ErrPlanName').html("");
                         $('#ErrDecreation').html("");
                         $('#ErrAmount').html("");
                         $('#ErrPhotos').html("");
                         $('#ErrFreeprofiles').html("");
                         $('#ErrShortDescription').html("");
                         $('#ErrDetailDescription').html("");
                         $('#ErrRemarks').html("");
                         ErrorCount=0;
                         
                        IsNonEmpty("PlanCode","ErrPlanCode","Please Enter PlanCode"); 
                        if (IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name")){
                            IsAlphabet("PlanName","ErrPlanName","Please Enter Alphabets characters only");    
                        }
                        if (IsNonEmpty("Decreation","ErrDecreation","Please Enter Duration")) {
                            IsAlphaNumeric("Decreation","ErrDecreation","Please Alpha Numeric characters only");
                        }
                        
                        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        IsNonEmpty("Photos","ErrPhotos","Please Enter Number of photos");
                        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Number of  Free profiles");
                        if (IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter Short Description")){
                        IsAlphaNumeric("ShortDescription","ErrShortDescription","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Detail Description")){
                        IsAlphaNumeric("DetailDescription","ErrDetailDescription","Please Enter Alpha Numeric characters only");
                        }
                        
                         if (ErrorCount==0) {
                            return true;         
                        } else{
                            return false;
                        }
                 }
    
</script> 
 <?php                   
 if (isset($_POST['BtnSavePlan'])) {   
    $response = $webservice->getData("Admin","CreateMemberPlan",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
   $response = $webservice->getData("Admin","GetMemberPlanCode");
     $FranchiseeCode="";
        if ($response['status']=="success") {
            $PlanCode  =$response['data']['PlanCode'];
        }
?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
<div class="form-group row">
	<div class="col-sm-9">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<div style="padding:15px !important;max-width:770px !important;">
						<h4 class="card-title">Create Member Plan</h4>
							 <div class="form-group row">
									<label for="Plan Code" class="col-sm-3 col-form-label">Plan Code<span id="star">*</span></label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="PlanCode" maxlength="7" name="PlanCode" value="<?php echo isset($_POST['PlanCode']) ? $_POST['PlanCode'] : $PlanCode;?>" placeholder="Plan Code">
									<span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
								</div>
							</div>
							<div class="form-group row">
									<label for="PlanName" class="col-sm-3 col-form-label">Plan Name<span id="star">*</span></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : "");?>" placeholder="Plan Name">
									<span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
								</div>
							</div>
							<div class="form-group row">
									<label for="Decreation" class="col-sm-3 col-form-label">Duration<span id="star">*</span></label>
								<div class="col-sm-4">
								<div class="input-group">
									<input type="text" class="form-control" id="Decreation" name="Decreation" value="<?php echo (isset($_POST['Decreation']) ? $_POST['Decreation'] : "");?>" placeholder="Duration">
									<div class="input-group-addon">days</div>
								</div>
									<span class="errorstring" id="ErrDecreation"><?php echo isset($ErrDecreation) ? $ErrDecreation : "";?></span>
								</div>                                                                                     
							</div>
							<div class="form-group row">
									<label for="Amount" class="col-sm-3 col-form-label">Amount<span id="star">*</span></label>
								<div class="col-sm-4">
								<div class="input-group">
								  <div class="input-group-addon">Rs</div>
									<input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : "");?>" placeholder="Amount"> </div>
									<span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="Benefits" class="col-sm-3 col-form-label">Benefits<?php if($Subscribed['cnt']>0){ } else { ?><span id="star">*</span><?php } ?></label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">Photos</div>
										<input type="text" class="form-control" id="Photos" name="Photos" value="<?php echo (isset($_POST['Photos']) ? $_POST['Photos'] : "");?>" placeholder="0">
									</div>
									<span class="errorstring" id="ErrPhotos"><?php echo isset($ErrPhotos) ? $ErrPhotos : "";?></span>
								</div>   
							</div>
							<div class="form-group row">	
								<div class="col-sm-3"></div>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">Profiles</div>
										<input type="text" class="form-control" id="Freeprofiles" name="Freeprofiles" value="<?php echo (isset($_POST['Freeprofiles']) ? $_POST['Freeprofiles'] : "");?>" placeholder="0">
									</div>
									<span class="errorstring" id="ErrFreeprofiles"><?php echo isset($ErrFreeprofiles) ? $ErrFreeprofiles : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="ShortDescription" class="col-sm-3 col-form-label">Short Description<span id="star">*</span></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="ShortDescription" name="ShortDescription" value="<?php echo (isset($_POST['ShortDescription']) ? $_POST['ShortDescription'] : "");?>" placeholder="Short Description">
									<span class="errorstring" id="ErrShortDescription"><?php echo isset($ErrShortDescription) ? $ErrShortDescription : "";?></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="DetailDescription" class="col-sm-3 col-form-label">Detail Description<span id="star">*</span></label>
								<div class="col-sm-9">
									<textarea  rows="5" class="form-control" id="DetailDescription" name="DetailDescription" value="<?php echo (isset($_POST['DetailDescription']) ? $_POST['DetailDescription'] : "");?>" placeholder="Detail Description"></textarea>
									<span class="errorstring" id="ErrDetailDescription"><?php echo isset($ErrDetailDescription) ? $ErrDetailDescription : "";?></span>
								</div>
							</div>
							<div class="form-group row">
									<label for="Remarks" class="col-sm-3 col-form-label">Remarks<span id="star">*</span></label>
								<div class="col-sm-9">
									<textarea  rows="5" class="form-control" id="Remarks" name="Remarks" value="<?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : "");?>" placeholder="Remarks"></textarea>
									<span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
								</div>
							</div>
					</div>
				</div>
            </div>
		</div>
		<br>
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
			&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="Member.ConfirmGotoBackFromCreatePlan()">Cancel</a>&nbsp;
			<a href="javascript:void(0)" onclick="Member.ConfirmCreateMemberPlan()" class="btn btn-primary" name="BtnupdateStaff">Create Plan</a>
			<!--<button type="submit" name="BtnSavePlan" class="btn btn-primary mr-2">Create Plan</button>-->
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/Plan/ManagePlan");?>"><small style="font-weight:bold;text-decoration:underline">List of Plans</small></a></div>
		             
	</div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
		
			</div>
		</div>
	</div>