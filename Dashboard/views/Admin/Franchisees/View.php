<?php
  $response = $webservice->getData("Admin","GetFranchiseeInfo");
  $FranchiseeBanks      = $response['data']['PrimaryBankAccount'];                                
    $FranchiseeStaff = $response['data']['FranchiseeStaff'];
    $Franchisee          = $response['data']['Franchisee'];       
    
    $page="PrimaryDetails";
    include_once("topmenu.php");  
?>

<form method="post" id="frmfrn">
    <input type="hidden" value="<?php echo $Franchisee['Plan'];?>" name="PlanName" id="PlanName">
    <div class="form-group row">
	    <div class="col-12 grid-margin">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div style="padding:15px !important;max-width:770px !important;">
                            
							    <h4 class="card-title">Business Information</h4>
                            
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Franchisee Code</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['FranchiseeCode'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Franchisee Name</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['FranchiseName'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label"> Email Id</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['ContactEmail'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Mobile Number</label>
								<label class="col-sm-9  col-form-label" style="color:#737373;">+<?php echo $Franchisee['ContactNumberCountryCode'];?>-<?php echo $Franchisee['ContactNumber'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Whatsapp Number </label>
								<label class="col-sm-9  col-form-label" style="color:#737373;">+<?php echo $Franchisee['ContactWhatsappCountryCode'];?>-<?php echo $Franchisee['ContactWhatsapp'];?></label>
							</div>
							<?php if(strlen(trim($Franchisee['ContactLandline']))>0 ) { ?> 
							<div class="form-group row mb0">   
							    <label class="col-sm-3 col-form-label">Landline Number </label>
								<label class="col-sm-9  col-form-label" style="color:#737373;">+<?php echo $Franchisee['LandlineCountryCode'];?>-<?php echo $Franchisee['LandlineStdCode'];?>-<?php echo $Franchisee['ContactLandline'];?></Label>
							</div>
							<?php } ?>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Address</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine1'];?></label>
							</div>      
							<?php if(strlen(trim($Franchisee['BusinessAddressLine2']))>0 ) { ?> 
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label"></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine2'];?></label>
							</div>
							<?php } ?>
                            <?php if(strlen(trim($Franchisee['BusinessAddressLine3']))>0 ) { ?>  
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label"></label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine3'];?></label>
							</div>
							<?php } ?>  
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">City Name</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['CityName'];?></label>
                            </div>
                            <div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Landmark</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['Landmark'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Country Name </label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['CountryName'];?></label>
							</div>
							<div class="form-group row mb0">
                                <label class="col-sm-3 col-form-label">State Name</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['StateName'];?></label>
                            </div>
                            <div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">District Name</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $Franchisee['DistrictName'];?></label>
							</div>
							<div class="form-group row mb0">
								<label class="col-sm-3 col-form-label">Pin Code</label>
								<label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisee['PinCode'];?></label>
                            </div>
                            <div class="form-group row mb0">
                                <label class="col-sm-3 col-form-label">Plan</label>
								<label class="col-sm-9 col-form-label" style="color:#737373;"><a href="javascript:void(0)" onclick="ViewFranchiseePlanDetails()"><?php echo $Franchisee['Plan'];?></a></label>
							</div>
						</div>
			        </div>
		        </div>
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <div style="padding:15px !important;max-width:770px !important;">
                            <h4 class="card-title">Bank Account Details</h4>
                           <table class="table table-bordered">
								<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
									<tr>
										<th>Bank Name</th>
										<th>A/C Name</th>
										<th>A/C Number</th>
										<th>IFS Code</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($FranchiseeBanks as $FranchiseeBank) { ?>
									<tr>    
										<td><?php echo $FranchiseeBank['BankName'];?></td>
										<td><?php echo $FranchiseeBank['AccountName'];?></td>
										<td><?php echo $FranchiseeBank['AccountNumber'];?></td>
										<td><?php echo $FranchiseeBank['IFSCode'];?></td>
										<td><?php echo $FranchiseeBank['AccountType'];?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="card">
            <div class="card-body">
                <div style="padding:15px !important;max-width:770px !important;">
                    <h4 class="card-title">Primary Staff Information</h4>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Person Name</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['PersonName'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Father's Name</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['FatherName'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Date of birth</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo PutDate($FranchiseeStaff['DateofBirth']);?> </label>
                        
                    </div>
                    <div class="form-group row mb0">
                       <label class="col-sm-3 col-form-label">Gender</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['Sex'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Email Id</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['EmailID'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Mobile Number</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;">+<?php echo $FranchiseeStaff['CountryCode'];?>-<?php echo $FranchiseeStaff['MobileNumber'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;">+<?php echo $FranchiseeStaff['WhatsappNumberCountryCode'];?>-<?php echo $FranchiseeStaff['WhatsappNumber'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine1'];?></label>
                    </div>
                    <?php if(strlen(trim($FranchiseeStaff['AddressLine2']))>0 ) { ?> 
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label"></label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine2'];?></label>
                    </div>
                    <?php } if(strlen(trim($FranchiseeStaff['AddressLine3']))>0 ) { ?>  
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label"></label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['AddressLine3'];?></label>
                    </div>
                    <?php } ?>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">ID Proof</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['IDProof'];?></label>
                    </div>
					<div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">ID Number</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['IDProofNumber'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Login Name</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $FranchiseeStaff['LoginName'];?></label>
                    </div>
                    <div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Login Password</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><span id='pwd'><a href="javascript:ShowPwd()">Show Password</a></span></label>
                    </div>
					<div class="form-group row mb0">
                        <label class="col-sm-3 col-form-label">Transaction Password</label>
                        <label class="col-sm-9 col-form-label" style="color:#737373;"><span id='Txnpwd'><a href="javascript:ShowTxnPwd()">Show Transaction Password</a></span></label>
                    </div> 
                </div>    
            </div>
        </div>
	</div> 
    <div class="col-sm-3">
                    <div class="form-group row mb0">
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
                        <div class="form-group row mb0">
                            Created On<br>
                            <?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?>
                        </div>
                        <div class="form-group row mb0">
                            Last Updated On<br>
                            <?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?>
                        </div>
                        <div class="form-group row mb0" style="border-bottom:1px solid #737373;">
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrEdit('<?php echo $Franchisee['FranchiseeCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Edit Franchisee</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Franchisee['IsActive']==1) { ?>
                                <a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Block Franchisee</small></a>                                   
                                <?php } else {    ?>
                                <a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeCode'];?>')"><small style="font-weight:bold;text-decoration:underline">UnBlock Franchisee</small></a>
                                <?php } ?>
                            </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrResetPassword('<?php echo $Franchisee['FranchiseeCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a></div>  
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">View Staffs</small></a></div>  
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="ConfirmationfrBlock('<?php echo $Franchisee['FranchiseeCode'];?>')"><small style="font-weight:bold;text-decoration:underline">View Transactions</small></a></div>  
                        </div>
                        <div class="form-group row mb0">
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/MangeFranchisees"); ?>"><small style="font-weight:bold;text-decoration:underline">List of franchisees</small></a></div>  
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
function ShowTxnPwd() {
    var Txnpwd ='<?php echo $FranchiseeStaff['TransactionPassword'];?>';
    $('#Txnpwd').html(Txnpwd);
}

 function ConfirmationfrEdit(FranchiseeCode) {
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
						+ '<a href="'+AppUrl+'Franchisees/Edit/'+FranchiseeCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     }
	 function ConfirmationfrResetPassword(FranchiseeCode) {
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
						+ '<a href="'+AppUrl+'Franchisees/ResetPassword/'+FranchiseeCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     }
	 function ConfirmationfrBlock(FranchiseeCode) {
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
						+ '<a href="'+AppUrl+'Franchisees/BlockFranchisee/'+FranchiseeCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
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
   