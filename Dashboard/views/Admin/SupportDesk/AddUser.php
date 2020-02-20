<script>
$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#UserCode").blur(function () {
    
        IsNonEmpty("UserCode","ErrUserCode","Please Enter User Code");
                        
   });
   $("#UserName").blur(function () {
    
        IsNonEmpty("UserName","ErrUserName","Please Enter User Name");
                        
   });
   $("#Sex").change(function() {
		if ($("#Sex").val()=="0") {
			$("#ErrSex").html("Please select a Sex");  
		}else{
			$("#ErrSex").html("");  
		}
	});
	$("#MobileNumber").blur(function () {
			if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
				IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
			}              
		});	
   $("#EmailID").blur(function () {
			if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
			    IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
			}
		});

   $("#UserRole").blur(function () {
    
        IsNonEmpty("UserRole","ErrUserRole","Please Enter User Role");
                        
   });
	$("#LoginName").blur(function () {
		if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
					IsAlphabet("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
					}
	});
   $("#LoginPassword").blur(function () {
    
        IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password");
                        
   });
});       


function SubmitNewUser() {
                         $('#ErrUserCode').html("");
                         $('#ErrUserName').html("");
                         $('#ErrSex').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("UserCode","ErrUserCode","Please Enter Valid User Code")) {
                        IsAlphaNumeric("UserCode","ErrUserCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter User Name")) {
                        IsAlphabet("UserName","ErrUserName","Please Enter Alpha Numeric characters only");
                        }
                        if($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0"){
                        document.getElementById("ErrDateofBirth").innerHTML="Please select date of birth"; 
                        ErrorCount++;
                        }
                        if($("#Sex").val()=="0"){
                        document.getElementById("ErrSex").innerHTML="Please select your gender"; 
                        ErrorCount++;
                        }
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
                        IsAlphabet("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
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
function DateofBirthValidation() {
        
        if ($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0") {
            $('#ErrDateofBirth').html("Please select Date of Birth");
        } else {
            $('#ErrDateofBirth').html("");
        }
    }
</script>
<?php 
     $AInfo = $webservice->getData("Admin","GetSupportDeskUserInfo");
     $UserCode="";
        if ($AInfo['status']=="success") {
            $UserCode  =$AInfo['data']['SupportDeskUserCode'];
        }
        {
?>
<form method="post" id="frmfrn">
	<input type="hidden" value="" name="txnPassword" id="txnPassword">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Manage Users</h4>                    
						<h5 class="card-title">Create Users</h5>
						<div class="form-group row">
						<label class="col-sm-3 col-form-label">User Code<span id="star">*</span></label>
						<div class="col-sm-2">
							<input type="text" value="<?php echo isset($_POST['UserCode']) ? $_POST['UserCode'] : $UserCode;?>" class="form-control" id="UserCode" name="UserCode" maxlength="6">
							<span class="errorstring" id="ErrUserCode"><?php echo isset($ErrUserCode)? $ErrUserCode : "";?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">User Name<span id="star">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : "");?>">
							<span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
						</div>
					</div>
			  <div class="form-group row">
				<label class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
				  <div class="col-sm-5">
				   <div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
						<select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px" onchange="DateofBirthValidation()">
							<option value="0">Day</option>
							<?php for($i=1;$i<=31;$i++) {?>
							<option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:4px;margin-left:6px;">        
						<select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px" onchange="DateofBirthValidation()">
							<option value="0">Month</option>
							<?php foreach($_Month as $key=>$value) {?>
							<option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
						<select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px" onchange="DateofBirthValidation()">
							<option value="0">Year</option>
							<?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
							<option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>                             
							<?php } ?>
						</select>
					</div>
                    <br><span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
				  </div>
				</div>
				<div class="form-group row">
				  <label class="col-sm-3 col-form-label">Gender<span id="star">*</span></label>
				  <div class="col-sm-4">
				  <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
						<option value="0">--Choose Gender--</option>
						<?php foreach($AInfo['data']['Gender'] as $Sex) { ?>
							<option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($Sex[ 'CodeValue']==$_POST[ 'Sex']) ? ' selected="selected" ' : '';?>>
								<?php echo $Sex['CodeValue'];?>
							</option>
							<?php } ?>
					</select>
				  <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
				  </div>
				</div>
			   <div class="form-group row">
				  <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
				  <div class="col-sm-3" style="padding-right:0px">
						<select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode">
							<?php foreach($AInfo['data']['CountryName'] as $CountryCode) { ?>
							<option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST['CountryCode']==$CountryCode['ParamA']) ? " selected='selected' " : "";?>> <?php echo $CountryCode['str'];?></option>
							<?php } ?>
						</select>
					</div>
				  <div class="col-sm-6">
					<input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
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
							&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="SupportDesk.ConfirmGotoBackFromCreateSupportDeskUser()">Cancel</a>&nbsp;
							<a href="javascript:void(0)" onclick="SupportDesk.ConfirmCreateSupportDeskUser()" class="btn btn-primary" name="BtnupdateUser">Create User</a>
						</div>
					</div>
</div>
<div class="col-sm-3">
			<div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("SupportDesk/ManageUsers");?>"><small style="font-weight:bold;text-decoration:underline">List of Users</small></a></div>
        </div>
</form>  <?php }?>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 344px;min-height: 344px;" >
		
			</div>
		</div>
	</div>
