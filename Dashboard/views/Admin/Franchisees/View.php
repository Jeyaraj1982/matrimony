<?php
  $response = $webservice->getData("Admin","GetFranchiseeInfo");
  $FranchiseeBank      = $response['data']['PrimaryBankAccount'];                                
    $FranchiseeStaff = $response['data']['FranchiseeStaff'];
    $Franchisee          = $response['data']['Franchisee'];       
?>

<form method="post" id="frmfrn">
    <input type="hidden" value="<?php echo $Franchisee['Plan'];?>" name="PlanName" id="PlanName">
	<div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
				<div class="form-group row">
					<div class="col-sm-9">
						<div style="padding:15px !important;max-width:770px !important;">
							<h4 class="card-title">Business Information</h4>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
								<label class="col-sm-3  col-form-label" style="color:#737373;"><?php echo $Franchisee['FranchiseeCode'];?></label>
								<div class="col-sm-2"><small>Status:</small></div>
								<div class="col-sm-3"><span class="<?php echo ($Franchisee['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;">
									  <?php if($Franchisee['IsActive']==1){
										  echo "Active";
									  }                                  
									  else{
										  echo "Deactive";
									  }
									  ?></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Franchisee Name<span id="star">*</span></label>
								<label class="col-sm-9  col-form-label" style="color:#737373;"><?php echo $Franchisee['FranchiseName'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"> Email Id<span id="star">*</span></label>
								<label class="col-sm-9  col-form-label" style="color:#737373;"><?php echo $Franchisee['ContactEmail'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
								<label class="col-sm-9  col-form-label" style="color:#737373;">+<?php echo $Franchisee['ContactNumberCountryCode'];?>-<?php echo $Franchisee['ContactNumber'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Whatsapp Number </label>
								<label class="col-sm-3  col-form-label" style="color:#737373;">+<?php echo $Franchisee['ContactWhatsappCountryCode'];?>-<?php echo $Franchisee['ContactWhatsapp'];?></label>
							</div>
							<div class="form-group row">   
							   <label class="col-sm-3 col-form-label">Landline Number </label>
								<label class="col-sm-3  col-form-label" style="color:#737373;">+<?php echo $Franchisee['LandlineCountryCode'];?>-<?php echo $Franchisee['LandlineStdCode'];?>-<?php echo $Franchisee['ContactLandline'];?></Label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine1'];?></label>
							</div>
							<?php if(sizeof(trim($Franchisee['BusinessAddressLine2']))>0 ) { ?> 
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine2'];?></label>
							</div>
							<?php } if(sizeof(trim($Franchisee['BusinessAddressLine3']))>0 ) { ?>  
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine3'];?></label>
							</div>
							<?php } ?>  
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">City Name<span id="star">*</span></label>
								<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisee['CityName'];?></label>
								<label class="col-sm-2 col-form-label">Landmark<span id="star">*</span></label>
								<label class="col-sm-4 col-form-label" style="color:#737373;"><?php echo $Franchisee['Landmark'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Country Name <span id="star">*</span></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['CountryName'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">State Name<span id="star">*</span></label>
								<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisee['StateName'];?></label>
								<label class="col-sm-2 col-form-label">District Name<span id="star">*</span></label>
								<label class="col-sm-4 col-form-label" style="color:#737373;"><?php echo $Franchisee['DistrictName'];?></label>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Pin Code<span id="star">*</span></label>
								<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisee['PinCode'];?></label>
								<label class="col-sm-2 col-form-label">Plan<span id="star">*</span></label>
								<label class="col-sm-4 col-form-label" style="color:#737373;"><?php echo $Franchisee['Plan'];?><br>
								<a href="javascript:void(0)" onclick="ViewFranchiseePlanDetails()">view plan</a></label>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Created On</label><br>
							<label class="col-sm-12 col-form-label"><?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?></label>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Last Updated On</label><br>
							<label class="col-sm-12 col-form-label"><?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?></label>
						</div>
						<div class="form-group row" style="border-bottom:1px solid #737373;">
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrEdit('<?php echo $Franchisee['FranchiseeID'];?>')"><small style="font-weight:bold;text-decoration:underline">Edit Franchisee</small></a></div>
							<div class="col-sm-12 col-form-label"><?php if($Franchisee['IsActive']==1) { ?>
								<a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeID'];?>')"><small style="font-weight:bold;text-decoration:underline">Block Franchisee</small></a>                                   
								<?php } else {    ?>
								<a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeID'];?>')"><small style="font-weight:bold;text-decoration:underline">UnBlock Franchisee</small></a>
								<?php } ?>
							</div>
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrResetPassword('<?php echo $Franchisee['FranchiseeID'];?>')"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a></div>  
							<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">View Staffs</small></a></div>  
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeID'];?>')"><small style="font-weight:bold;text-decoration:underline">View Transactions</small></a></div>  
						</div>
						<div class="form-group row">
							<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/MangeFranchisees"); ?>"><small style="font-weight:bold;text-decoration:underline">List of franchisees</small></a></div>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
				<div style="padding:15px !important;max-width:770px !important;">
					<h4 class="card-title">Primary Account Details</h4>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeBank['BankName'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Account Holder Name<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeBank['AccountName'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeBank['AccountNumber'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $FranchiseeBank['IFSCode'];?></label>
						<label class="col-sm-2 col-form-label">Account Type<span id="star">*</span></label>
						<label class="col-sm-4 col-form-label" style="color:#737373;"><?php echo  $FranchiseeBank['AccountType'];?></label>
					</div>
				</div>
			</div>
        </div>
    </div>
	
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
				<div style="padding:15px !important;max-width:770px !important;">
					<h4 class="card-title">Profile Information</h4>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Person Name<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['PersonName'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Father's Name<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['FatherName'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Date of birth<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo PutDate($FranchiseeStaff['DateofBirth']);?> </label>
						<label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['Sex'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Email Id<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['EmailID'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;">+<?php echo $FranchiseeStaff['CountryCode'];?>-<?php echo $FranchiseeStaff['MobileNumber'];?></label>
						<label class="col-sm-3 col-form-label">Whatsapp Number </label>
						<label class="col-sm-3 col-form-label" style="color:#737373;">+<?php echo $FranchiseeStaff['WhatsappNumberCountryCode'];?>-<?php echo $FranchiseeStaff['WhatsappNumber'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine1'];?></label>
					</div>
					<?php if(sizeof(trim($FranchiseeStaff['AddressLine2']))>0 ) { ?> 
					<div class="form-group row">
						<label class="col-sm-3 col-form-label"></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine2'];?></label>
					</div>
					<?php } if(sizeof(trim($FranchiseeStaff['AddressLine3']))>0 ) { ?>  
					<div class="form-group row">
						<label class="col-sm-3 col-form-label"></label>
						<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine3'];?></label>
					</div>
					<?php } ?>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Adhaar Number<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AadhaarNumber'];?></label>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['LoginName'];?></label>
						<label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
						<label class="col-sm-3 col-form-label" style="color:#737373;"><span id='pwd'><a href="javascript:ShowPwd()">Show Password</a></span></label>
					</div> 
				</div>	
			</div>
		</div>
	</div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
            
                </div>
            </div>
        </div>
	
	<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
            
                </div>
            </div>
        </div>
<script> 
function ShowPwd() {
    var pwd ='<?php echo $FranchiseeStaff['LoginPassword'];?>';
    $('#pwd').html(pwd);
}

 function ConfirmationfrEdit(FranchiseeID) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
						+ '<h4 class="modal-title">Confirmation For Edit</h4>'
						+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
					+ '</div>'
					+ '<div class="modal-body">'
						+'<div class="col-sm-12">Are you sure want to Edit</div>'
					+ '</div>' 
					+ '<div class="modal-footer">'
						+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<a href="'+AppUrl+'Franchisees/Edit/'+FranchiseeID+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     }
	 function ConfirmationfrResetPassword(FranchiseeID) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
						+ '<h4 class="modal-title">Confirmation For Reset Password</h4>'
						+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
					+ '</div>'
					+ '<div class="modal-body">'
						+'<div class="col-sm-12">Are you sure want to reset password</div>'
					+ '</div>' 
					+ '<div class="modal-footer">'
						+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<a href="'+AppUrl+'Franchisees/ResetPassword/'+FranchiseeID+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     }
	 function ConfirmationfrBlock(FranchiseeID) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
						+ '<h4 class="modal-title">Confirmation For Block</h4>'
						+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
					+ '</div>'
					+ '<div class="modal-body">'
						+'<div class="col-sm-12">Are you sure want to Block</div>'
					+ '</div>' 
					+ '<div class="modal-footer">'
						+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<a href="'+AppUrl+'Franchisees/BlockFranchisee/'+FranchiseeID+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     }
	 function ViewFranchiseePlanDetails() { 
	 var param = $("#frmfrn").serialize();
	$('#Publish_body').html(preloading_withText("View Plan ...","95"));
	 $('#PubplishNow').modal('show'); 
        $.post(API_URL + "m=Admin&a=ViewFranchiseePlanDetails",param,function(result) {
      $('#Publish_body').html(result);  
        });
    }
</script>
   