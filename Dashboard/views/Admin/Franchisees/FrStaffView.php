<style>
.switch input { 
    display:none;
}
.switch {
    display:inline-block;
    width: 46px;
	height: 17px;
	margin: 2px;
    transform:translateY(50%);
    position:relative;
}

.slider {
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    border-radius:30px;
    box-shadow:0 0 0 2px #777, 0 0 4px #777;
    cursor:pointer;
    overflow:hidden;
     transition:.4s;
}
.slider:before {
    position:absolute;
    content:"";
    width:100%;
    height:100%;
    background:#777;
    border-radius:30px;
    transform:translateX(-30px);
    transition:.4s;
}

input:checked + .slider:before {
    transform:translateX(30px);
    background:limeGreen;
}
input:checked + .slider {
    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
}
</style>
<?php 
    $response = $webservice->getData("Admin","GetFranchiseeStaffs");
    $Staffs=$response['data']['Staffs'];
?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="<?php echo $Staffs[0]['StaffCode'];?>" name="StaffCode" id="StaffCode">
	<div class="col-12 grid-margin">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="padding:15px !important;max-width:770px !important;">
                    <h4 class="card-title">Manage Staffs</h4>
                        <h4 class="card-title">View Staff</h4>
						 <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Staff Code<span id="star">*</span></label>
                        <div class="col-sm-3"><small style="color:#737373;"><?php echo $Staffs[0]['StaffCode'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Staff Name<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['PersonName'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo PutDate($Staffs[0]['DateofBirth']);?></small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['Sex'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['CountryCode'];?>+<?php echo $Staffs[0]['MobileNumber'];?></small>&nbsp;
                            <small style="color:red;"><?php if($Staffs[0]['IsMobileVerified']=="1") { ?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="15%" style="margin-top: -12px;margin-left: 9px;width: 19px;"><?php } else { echo "Not verified"; }?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['EmailID'];?></small>&nbsp;
                            <small style="color:red;"><?php if($Staffs[0]['IsEmailVerified']=="1") { ?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="15%" style="margin-top: -12px;margin-left: 9px;width: 19px;"><?php } else { echo "Not verified"; }?></small>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Staff Role<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['UserRole'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Staffs[0]['LoginName'];?></small></div>
                    </div>
                    <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="LoginPassword" name="LoginPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Staffs[0]['LoginPassword']);?>">
                                        <span class="input-group-btn">
                                            <button  onclick="showHidePwd('LoginPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                        </span>          
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Transaction Password<span id="star">*</span></label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="StaffTransactionPassword" name="StaffTransactionPassword" Placeholder="Transaction Password" value="<?php echo (isset($_POST['TransactionPassword']) ? $_POST['TransactionPassword'] : $Staffs[0]['TransactionPassword']);?>">
                                        <span class="input-group-btn">
                                            <button  onclick="showHidePwd('StaffTransactionPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                        </span>          
                                    </div> 
                                </div>
                            </div>
							<br>
						
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
				<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="<?php echo GetUrl("Franchisees/FranchiseeStaffs/".$Staffs[0]['FrCode'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">List of Staffs</small></a>
					&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="FranchiseeStaff.ConfirmGotoBackFromEditFrStaff('<?php echo $Staffs[0]['FrCode'];?>')">Cancel</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
                       
                        <div class="form-group row">
                        <div class="col-sm-12 col-form-label">
                            Created On <br>
                            <?php echo putDateTime($Staffs[0]['CreatedOn']);?><br><br> 
                        </div>
                        <div class="col-sm-12 col-form-label">
                           
                             <span class="<?php echo ($Staffs[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                             &nbsp;&nbsp;&nbsp;
                             <small style="color:#737373;">
                                      <?php if($Staffs[0]['IsActive']==1){
                                          echo "Active";
                                      }                                  
                                      else{
                                          echo "Deactive";
                                      }
                                      ?>
                                      </small>
                             </div>
                            <div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmationfrEditFrStf('<?php echo $Staffs[0]['StaffCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Edit Staff</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Staffs[0]['IsActive']==1) { ?>
                                <a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmDeactiveFrStaff()"><small style="font-weight:bold;text-decoration:underline">Deactive Staff</small></a>                                   
                                 <?php } else {    ?>
                                    <a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmActiveFrStaff()"><small style="font-weight:bold;text-decoration:underline">Active Staff</small></a>                                   
                                <?php } ?>
							</div>
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmFrStaffChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a></div>
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmFrStaffResetTxnPswd()"><small style="font-weight:bold;text-decoration:underline">Reset Transaction Password</small></a></div>
							<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmDeleteFrStaff()"><small style="font-weight:bold;text-decoration:underline">Delete Staff</small></a></div>
							
							<div class="col-sm-12 col-form-label">
							<hr>
							<?php if($Staffs[0]['IsMobileVerified']==1) { ?>
								Mobile Number Verified <br> <?php echo PutDateTime($Staffs[0]['MobileVerifiedOn']);?><br>
							<?php } else {  ?>
								<div>
									<a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmFrStaffMobileVerified()"><label class="switch" style="background: none;">
										<input type="checkbox">
											<span class="slider"></span>
									</label></a>
									Mobile Number Verification
								</div>
							<?php } ?><br>
							<?php if($Staffs[0]['IsEmailVerified']==1) { ?>
								<br>Email Verified <br> <?php echo PutDateTime($Staffs[0]['EmailVerifiedOn']);?><br>
							<?php } else {  ?>
								<div>
									<a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmFrStaffEmailVerified()"><label class="switch" style="background: none;">
										<input type="checkbox">
											<span class="slider"></span>
									</label></a>
									Email ID verify
								</div>
							<?php } ?>
							<?php if($Staffs[0]['ChangePasswordFstLogin']==1) { ?>
								<br><div>
									<a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmFrStaffChnPswdFstLogin()"><label class="switch" style="background: none;">
										<input type="checkbox">
											<span class="slider"></span>
									</label></a>
									Change Password for first time login
								</div>
							<?php } ?>
								
							</div>
							<?php if(sizeof($response['data']['LastLogin'])>0){ ?>
							<div class="col-sm-12 col-form-label">
							<hr>
								Last Login <br><?php echo $response['data']['LastLogin'][0]['LoginOn'];?>
							</div>
							<?php } ?>
                        </div>
                    </div>
</div>
<br>
<div class=" grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
	
</div> 
</form> 
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
		
			</div>
		</div>
	</div>
	<div class="modal" id="ChnPswdNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="ChnPswd_body"  style="max-height: 462px;;min-height: 462px;;" >
		
			</div>
		</div>
	</div>
<?php	/*if(MobileNumber !=NewMobileNumber) { 
													content +='<br>Mobile Number Changed';
												} 
												<input type="Password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Staffs[0]['LoginPassword']);?>">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span></div>
                            <div class="col-sm-2"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
												*/ ?>

