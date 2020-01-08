
<?php                   
  if (isset($_POST['BtnSaveStaff'])) {         
    $response = $webservice->getData("Franchisee","CreateFranchiseeStaff",$_POST);
    if ($response['status']=="success") {
        ?>
        <script>location.href='<?php echo AppUrl;?>Staffs/Created';</script>
        <?php
    } else {
        $errormessage = $response['message']; 
    }
    }
?> 
<script>

$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#staffName").blur(function () {
    
        IsNonEmpty("staffName","ErrstaffName","Please Enter staff Name");
                        
   });
   $("#Sex").blur(function () {
    
        IsNonEmpty("Sex","ErrSex","Please Select a Sex");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });
   $("#EmailID").blur(function () {
    
        IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
                        
   }); 
   $("#UserRole").blur(function () {
    
        IsNonEmpty("UserRole","ErrUserRole","Please Enter User Role");
                        
   });
   $("#LoginName").blur(function () {
    
        IsNonEmpty("LoginName","ErrLoginName","Please Enter Login Name");
                        
   });
   $("#LoginPassword").blur(function () {
    
        IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password");
                        
   }); 
});       

function SubmitNewStaff() {
                         $('#ErrstaffName').html("");
                         $('#ErrSex').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("staffName","ErrstaffName","Please Enter staff Name")) {
                        IsAlphabet("staffName","ErrstaffName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
                        IsAlphaNumeric("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsPassword("LoginPassword","ErrLoginPassword","Please Enter More than 8 characters")) {
                        IsAlphaNumeric("LoginPassword","ErrLoginPassword","Alpha Numeric Characters only");
                        }
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<?php 
     $fInfo = $webservice->getData("Franchisee","GetFranchiseeStaffCodeCode"); 
	{
?>
<form method="post" id="frmfrn">
	<input type="hidden" value="" name="txnPassword" id="txnPassword">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Manage Staffs</h4>                    
						<h5 class="card-title">Create Staffs</h5>
						<div class="form-group row">
                          <label class="col-sm-3 col-form-label">Staff Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="staffName" name="staffName" value="<?php echo isset($_POST['staffName']) ? $_POST['staffName'] : $staffName;?>">
                            <span class="errorstring" id="ErrstaffName"><?php echo isset($ErrstaffName)? $ErrstaffName : "";?></span>
                          </div>
                        </div>
						
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                         <div class="col-sm-5">
                            <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                                <?php $dob=strtotime($ProfileInfo['DateofBirth'])  ; ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:4px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>>
                                            <?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>                                    
                            </div>
                            <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>                             
                                        <?php } ?>                                  
                                    </select>
                     </div>
                      </div>    
                        </div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
								<div class="col-sm-4">
									<select class="form-control" id="Sex"  name="Sex" >
									<?php foreach($fInfo['data']['Gender'] as $Sex) { ?>    
									<option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
									<?php } ?>
								</select>
							  <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
								</div>
								<label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
								<div class="col-sm-3">
									<select class="form-control" id="UserRole"  name="UserRole">
										<option value="Admin">Admin</option>
										<option value="View">View</option>
									</select>
									<span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
								</div>
							</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
							<div class="col-sm-3" style="padding-right:0px">
								<select class="selectpicker form-control" data-live-search="true" name="MobileNumberCountryCode" id="MobileNumberCountryCode">
									<?php foreach($fInfo['data']['Country'] as $CountryCode) { ?>
									<option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST['MobileNumberCountryCode']==$CountryCode['ParamA']) ? " selected='selected' " : "";?>> <?php echo $CountryCode['str'];?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" >
								<span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
							</div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : "");?>">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                          </div>
					</div>
					<div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-5">
								<div class="input-group">
									<input type="password" class="form-control pwd"  maxlength="8" id="LoginPassword" name="LoginPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>">
									<span class="input-group-btn">
										<button  onclick="showHidePwd('LoginPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
									</span>          
								</div>
								<span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span>
                         </div>
						 <div class="col-sm-4" style="padding-top: 5px;">
							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" id="PasswordFstLogin" name="PasswordFstLogin">
								<label class="custom-control-label" for="PasswordFstLogin" style="margin-top: 7px;">&nbsp;Change password on first login</label>
							</div>
						</div>
                     </div>  
					</div>
           
		</div>
	</div>
	<br>
	<div class="form-group row" >
						<div class="col-sm-12" style="text-align:right">
							&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="FranchiseeStaff.ConfirmGotoBackFromCreateFrStaff()">Cancel</a>&nbsp;
							<a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmCreateFranchiseeStaff()" class="btn btn-primary" name="BtnupdateStaff">Create Staff</a>
						</div>
					</div>
	</div>
		<div class="col-sm-3">
          
        </div>
           
</div>
</form>  <?php }?>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 344px;min-height: 344px;" >
		
			</div>
		</div>
	</div>
