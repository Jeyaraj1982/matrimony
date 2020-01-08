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
if (isset($_POST['Btnupdate'])) {

        $response = $webservice->getData("Admin","EditMemberInfo",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","GetMemberInfo");
    $Member          = $response['data']['MemberInfo'];
    $CountryCodes=$response['data']['Countires'];
    $Gender=$response['data']['Gender'];
	
?>
<script>
        $(document).ready(function() {
            $("#MobileNumber").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
                    return false;
                }
            });
			$("#WhatsappNumber").keypress(function (e) {
			if ($('#WhatsappNumber').val().trim().length==0) {
				$("#ErrWhatsappNumber").html("");
			}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#ErrWhatsappNumber").html("Digits Only").fadeIn("fast");
				return false;
			}
		});
            $("#MemberName").blur(function() {

                IsNonEmpty("MemberName", "ErrMemberName", "Please Enter Member Name");

            });
            $("#MobileNumber").blur(function() {

                IsNonEmpty("MobileNumber", "ErrMobileNumber", "Please Enter Mobile Number");

            });
            $("#EmailID").blur(function() {

                IsNonEmpty("EmailID", "ErrEmailID", "Please Enter Email ID");

            });
            $("#MemberPassword").blur(function() {

                IsNonEmpty("MemberPassword", "ErrMemberPassword", "Please Enter Member Password");

            });
            
        });

       
        function SubmitNewMember() {
            $('#ErrMemberName').html("");
            $('#ErrMobileNumber').html("");
            $('#ErrWhatsappNumber').html("");
            $('#ErrEmailID').html("");
            $('#ErrMemberPassword').html("");
            
            ErrorCount = 0;

            if (IsNonEmpty("MemberName", "ErrMemberName", "Please Enter Member Name")) {
                IsAlphabet("MemberName", "ErrMemberName", "Please Enter Alphabets characters only");
            }

            if (IsNonEmpty("MobileNumber", "ErrMobileNumber", "Please Enter Mobile Number")) {
                IsMobileNumber("MobileNumber", "ErrMobileNumber", "Please Enter Valid Mobile Number");
            }
			
			if ($('#WhatsappNumber').val().trim().length>0) {
				IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
			}

            if (IsNonEmpty("EmailID", "ErrEmailID", "Please Enter Email ID")) {
                IsEmail("EmailID", "ErrEmailID", "Please Enter Valid Email ID");
            }

            if (IsNonEmpty("MemberPassword", "ErrMemberPassword", "Please Enter Member Password")) {
                IsLogin("MemberPassword", "ErrMemberPassword", "Please Enter Valid Member Password");
            }
            

            if (ErrorCount == 0) {
                return true;
            } else {
                return false;
            }

        }
    </script>

<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode">
	<div class="col-12 grid-margin">
		<div class="col-sm-9">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-body">
						<div style="padding:15px !important;max-width:770px !important;">
							<h4 class="card-title">Manage Members</h4>
							<h4 class="card-title">Edit Member</h4>
								<div class="form-group row">
									<div class="col-sm-3"><small>Member Code</small> </div>
									<div class="col-sm-3">
										<input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo $Member['MemberCode'];?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"><small>Member Name<span id="star">*</span></small> </div>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
										<span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"><small>Date of Birth<span id="star">*</span></small></div>
									<div class="col-sm-5" >
										<?php if($Member['IsActive']==1){ ?>
										<div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
											<?php $dob=strtotime($Member['DateofBirth'])  ; ?>
												<select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
													<?php for($i=1;$i<=31;$i++) {?>
													<option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
													<?php } ?>
												</select>
										</div>
										<div class="col-sm-4" style="max-width:73px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
											<select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
												<?php foreach($_Month as $key=>$value) {?>
													<option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
											<select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
												<?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
													<option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
												<?php } ?>
											</select>
										</div>
										<?php } else { ?>
											<div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
											<?php $dob=strtotime($Member['DateofBirth'])  ; ?>
												<select class="form-control" disabled="disabled">
													<?php for($i=1;$i<=31;$i++) {?>
													<option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
													<?php } ?>
												</select>
										</div>
										<div class="col-sm-4" style="max-width:73px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
											<select class="form-control" disabled="disabled">
												<?php foreach($_Month as $key=>$value) {?>
													<option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
											<select class="form-control" disabled="disabled">
												<?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
													<option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
												<?php } ?>
											</select>
										</div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"><small>Gender<span id="star">*</span></small></div>
								  <div class="col-sm-5">
										<select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
											<?php foreach($Gender as $Sex) { ?>
											<option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($Member[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $Sex['CodeValue'];?></option>
											<?php } ?>
										</select>
										<span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
								  </div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"><small>Mobile Number<span id="star">*</span></small></div>
									<div class="col-sm-3">
										<select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
											<?php foreach($CountryCodes as $CountryCode) { ?>
												<option value="<?php echo $CountryCode['ParamB'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
													<?php echo $CountryCode['str'];?>
												</option>
												<?php } ?>
										</select>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
										<span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
									</div>
									<div class="col-sm-1">
										<?php if($Member['IsMobileVerified']=1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: 8px;margin-left: -23px;"><?php } ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3"><small>Whatsapp Number<span id="star">*</span></small></div>
									<div class="col-sm-3">
										<select class="selectpicker form-control" data-live-search="true" name="WhatsappCountryCode" id="WhatsappCountryCode" style="width: 61px;">
											<?php foreach($CountryCodes as $CountryCode) { ?>
												<option value="<?php echo $CountryCode['ParamB'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
													<?php echo $CountryCode['str'];?>
												</option>
												<?php } ?>
										</select>
									</div>
									<div class="col-sm-5">
										<input type="text" class="form-control" maxlength="10" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $Member['WhatsappNumber']);?>" placeholder="Whatsapp Number">
										<span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-3"><small>Email ID<span id="star">*</span></small></div>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
										<span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
									</div>
									<div class="col-sm-1">
										<?php if($Member['IsEmailVerified']=1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="margin-top: 8px;margin-left: -23px;"><?php } ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Login Password</label>
									<div class="col-sm-5">
										<div class="input-group">
											<input type="password" disabled="disabled" class="form-control pwd" id="MemberPassword" name="MemberPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Member['MemberPassword']);?>">
											<span class="input-group-btn">
												<button  onclick="showHidePwd('MemberPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
											</span>          
										</div>
									</div>
								</div>
								<?php if($Member['ReferedBy']>0){ ?>
								<div class="form-group row">
									<div class="col-sm-3"><small>Franchisee Name</small></div>
									<div class="col-sm-9"><span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)</small></div>
								</div>
								<?php } ?>
								<br>
								<a href="javascript:void(0)" onclick="Member.ConfirmEditMember()" name="Btnupdate" id="Btnupdate" class="btn btn-primary mr-2">Update Information</a>
						</div>
					</div>
				</div>
			</div>	
			
			<div class="col-12 grid-margin">
				<div class="col-sm-12" style="text-align: center; padding-top:5px;color:skyblue;">
					<a href="../ManageMember"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a>&nbsp;|&nbsp;
					<a href="<?php echo GetUrl("Members/ViewMember/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">View Member</small></a>&nbsp;|&nbsp;
					<a href="<?php echo GetUrl("Members/BlockMember/".$_REQUEST['Code'].".htm "); ?>"><small style="font-weight:bold;text-decoration:underline">Block Member</small></a>&nbsp;|&nbsp;
					<a href="<?php echo GetUrl("Members/ResetPassword/".$_REQUEST['Code'].".htm "); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group row">
				<div class="col-sm-12 col-form-label"><a href="javascript:void(0)" onclick="Member.ConfirmMemberChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a></div>
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
	<div class="modal" id="ChnPswdNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="ChnPswd_body"  style="max-height: 462px;;min-height: 462px;;" >
		
			</div>
		</div>
	</div>
