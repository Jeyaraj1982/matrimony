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
    $Plan=$response['data']['Plan'];
	
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
    <input type="hidden" value="" name="DeletedRemarks" id="DeletedRemarks">
    <input type="hidden" value="" name="SmsMessage" id="SmsMessage">
    <input type="hidden" value="" name="EmailSubjectMessage" id="EmailSubjectMessage">
    <input type="hidden" value="" name="EmailContentMessage" id="EmailContentMessage">
    <input type="hidden" value="" name="PopupSubjectMessage" id="PopupSubjectMessage">
    <input type="hidden" value="" name="PopupContentMessage" id="PopupContentMessage">
    <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode">
    <?php
         $disbaled = ( $Member['IsActive']==0 || $Member['IsDeleted']==1 ) ? true : false;
         $stars = (!($disbaled)) ? '<span id="star">*</span>' : ""; 
     ?>
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Edit Member</h4>
                            <?php if($Member['IsDeleted']==1){ ?>
                            <div class="alert alert-warning">
                                <strong>Warning!</strong>&nbsp;Member Status has deleted So you can't edit the details
                            </div> 
                            <?php } else {?>
                            <?php if($Member['IsActive']==0) {?>
                            <div class="alert alert-warning">
                                <strong>Warning!</strong>&nbsp;Member Status has deactivated So you can't edit the details
                            </div>
                            <?php } }?>
							<div class="form-group row">
								<div class="col-sm-3"><small>Member Code</small> </div>
								<div class="col-sm-3">
									<input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo $Member['MemberCode'];?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-3"><small>Member Name<?php echo $stars; ?></small> </div>
								<div class="col-sm-9">
                                    <?php if($disbaled) { ?>
                                        <input type="text" class="form-control" disabled="disabled" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>">
									<?php } else { ?>
                                        <input type="text" class="form-control" id="MemberName" maxlength="60" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
									    <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
								    <?php } ?>
                                </div>
							</div>
							<div class="form-group row">
								<div class="col-sm-3"><small>Date of Birth<?php echo $stars; ?></small></div>
								<div class="col-sm-5" >
									<?php if($Member['IsActive']==0 || $Member['IsDeleted']==1 ) { ?>
                                    <div class="col-sm-4" style="max-width:75px !important;padding:0px !important;">
                                            <?php $dob=strtotime($Member['DateofBirth'])  ; ?>
                                            <select class="form-control" disabled="disabled">
                                                <?php for($i=1;$i<=31;$i++) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                                            <select class="form-control" disabled="disabled">
                                                <?php foreach($_Month as $key=>$value) {?>
                                                    <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" style="max-width:120px !important;padding:0px !important;">
                                            <select class="form-control" disabled="disabled">
                                                <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
									<?php } else { ?>
										<div class="col-sm-4" style="max-width:75px !important;padding:0px !important;">
                                        <?php $dob=strtotime($Member['DateofBirth'])  ; ?>
                                            <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                                <?php for($i=1;$i<=31;$i++) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                                        <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                            <?php foreach($_Month as $key=>$value) {?>
                                                <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" style="max-width:120px !important;padding:0px !important;">
                                        <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                            <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-3"><small>Gender<?php echo $stars; ?></small></div>
							    <div class="col-sm-5">
                                    <?php if($disbaled) { ?>
                                        <select class="form-control" disabled="disabled">
										    <?php foreach($Gender as $Sex) { ?>
										    <option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($Member[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $Sex['CodeValue'];?></option>
										    <?php } ?>
									    </select>
                                    <?php } else { ?>
                                         <select class="selectpicker form-control" data-live-search="false" id="Sex" name="Sex">
                                            <?php foreach($Gender as $Sex) { ?>
                                            <option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($Member[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $Sex['CodeValue'];?></option>
                                            <?php } ?>
                                        </select>
									    <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                                    <?php } ?>
							  </div>
							</div>
							<div class="form-group row">
								<div class="col-sm-3"><small>Mobile Number<?php echo $stars; ?></small></div>
								<div class="col-sm-3">
                                <?php if($disbaled) { ?>
                                    <select class="form-control" disabled="disabled">
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                            <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                                <?php echo $CountryCode['str'];?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                <?php } else{ ?>
									<select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
										<?php foreach($CountryCodes as $CountryCode) { ?>
											<option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
												<?php echo $CountryCode['str'];?>
											</option>
											<?php } ?>
									</select>
                                <?php } ?>
								</div>
								<div class="col-sm-6">
                                 <?php if($disbaled) { ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" disabled="disabled" value="<?php echo $Member['MobileNumber'];?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button" style="background: #eeeeee;"><?php if($Member['IsMobileVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                                        </span>          
                                    </div>
								 <?php } else { ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" id="MobileNumber" oldvalue="<?php echo $Member['MobileNumber'];?>" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button"><?php if($Member['IsMobileVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                                        </span>          
                                    </div>
                                    <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
								<?php } ?>
                                </div>                                                          
                                </div>                                   
							<div class="form-group row">
								<div class="col-sm-3"><small>Whatsapp Number</small></div>
								<div class="col-sm-3">
                                <?php if($disbaled ) { ?>
                                    <select class="form-control" disabled="disabled">
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                            <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                                <?php echo $CountryCode['str'];?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                <?php } else{ ?>
									<select class="selectpicker form-control" data-live-search="true" name="WhatsappCountryCode" id="WhatsappCountryCode" style="width: 61px;">
										<?php foreach($CountryCodes as $CountryCode) { ?>
											<option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamB']) ? " selected='selected' " : "") : (($Member[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
												<?php echo $CountryCode['str'];?>
											</option>
											<?php } ?>
									</select>
                                <?php } ?>
								</div>
								<div class="col-sm-6">
                                <?php if($disbaled ) { ?>
                                    <input type="text" class="form-control" disabled="disabled"  value="<?php echo $Member['WhatsappNumber'];?>">
								<?php } else { ?>
                                    <input type="text" class="form-control" maxlength="10" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $Member['WhatsappNumber']);?>" placeholder="Whatsapp Number">
									<span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
								<?php } ?>
                                </div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-3"><small>Email ID<?php echo $stars; ?></small></div>
								<div class="col-sm-9">
                                <?php if($disbaled) { ?>
                                    <div class="input-group">
                                        <input type="text" disabled="disabled" class="form-control"  value="<?php echo $Member['EmailID'];?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button" style="background: #eeeeee;"><?php if($Member['IsEmailVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                                        </span>          
                                    </div>
								<?php } else { ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="60" id="EmailID" oldvalue="<?php echo $Member['EmailID'];?>" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default reveal" type="button"><?php if($Member['IsEmailVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                                        </span>          
                                    </div>
									<span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                                <?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Login Password</label>
								<div class="col-sm-5">
									<div class="input-group">
										<input type="password" disabled="disabled" class="form-control pwd" id="MemberPassword" name="MemberPassword"   value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Member['MemberPassword']);?>">
										<span class="input-group-btn">
											<button  onclick="showHidePwd('MemberPassword',$(this))" class="btn btn-default reveal" type="button" style="background: #eeeeee;"><i class="glyphicon glyphicon-eye-close"></i></button>
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
						
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
				<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="Member.ConfirmGotoBackFromEditMember()">Cancel</a>&nbsp;
				<?php if (!($disbaled)) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmEditMember()" name="Btnupdate" id="Btnupdate" class="btn btn-primary mr-2">Update Information</a>
				<?php } ?>
                </div>
			</div>
		</div>
		
        <div class="col-sm-3">
            <div class="col-sm-12 col-form-label">
                Created On <br>
                <?php echo putDateTime($Member['CreatedOn']);?><br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                Franchisee <br>
                <span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)<br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                <span class="<?php if($Member['IsDeleted']==1){ echo "DeletedDot"; } else { if($Member['IsActive']==0) { echo "Deactivedot"; } else { echo "Activedot"; } }?>"></span>
                 &nbsp;&nbsp;&nbsp;
                 <small style="color:#737373;"> 
                 <?php if($Member['IsDeleted']==1){ 
                           echo "Deleted";
                       } else {  
                           if($Member['IsActive']==0) {
                             echo "Deactive"."( ".PutDatetime($Member['DeactivatedOn'])." )";
                           } else {
                              echo "Active";   
                             } 
                       }?>
                 </small>
            </div>
            <?php if($Member['IsDeleted']==1) { ?>
                <div class="col-sm-12 col-form-label">
                     Deleted On <br>
                <?php echo putDateTime($Member['DeletedOn']);?>
                </div>
            <?php } ?>
            <div class="col-sm-12 col-form-label"><a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a></div>
            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/ViewMember/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">View Member</small></a></div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmMemberChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Change Password</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmResetPassword()"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Reset Password</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsDeleted']==1 ){   ?>
                    <?php if($Member['IsActive']==1) { ?>
                        <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Active</small></a>
                    <?php } else { ?>
                        <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Deactive</small></a>
                    <?php }   ?>
                <?php  } else {  
                              if($Member['IsActive']==0) {  ?>
                                    <a href="javascript:void(0)" onclick="Member.ConfirmActiveMember()"><small style="font-weight:bold;text-decoration:underline">Active</small></a>                                         
                           <?php } else {     ?>
                              <a href="javascript:void(0)" onclick="Member.ConfirmDeactiveMember()"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a> 
                        <?php } 
                       }?>
            </div>
            <div class="col-sm-12 col-form-label"> 
                    <?php if($Member['IsDeleted']==0) { ?>
                        <a href="javascript:void(0)" onclick="Member.ConfirmDeleteMember()"><small style="font-weight:bold;text-decoration:underline">Delete</small></a>                                   
                    <?php } else { ?>    
                        <a href="javascript:void(0)" onclick="Member.ConfirmRestoreMember()"><small style="font-weight:bold;text-decoration:underline">Restore</small></a>                                   
                    <?php } ?>
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Profiles</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Profiles</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ShowMemberCurrentPlan('<?php echo $Plan['PlanCode'];?>','<?php echo $Plan['PlanName'];?>','<?php echo $Plan['Decreation'];?>','<?php echo $Plan['Amount'];?>','<?php echo $Plan['FreeProfiles'];?>','<?php echo PutDateTime($Plan['StartingDate']);?>','<?php echo PutDateTime($Plan['EndingDate']);?>')"><small style="font-weight:bold;text-decoration:underline">Member Plan</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Member Plan</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmSendIndividualSmsToMember('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>','<?php echo $Member['MobileNumber'];?>','<?php echo $Member['CountryCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Send Individual Sms</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Send Individual Sms</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmSendIndividualEmailToMember('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>','<?php echo $Member['EmailID'];?>')"><small style="font-weight:bold;text-decoration:underline">Send Individual Email</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Send Individual Email</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmPopupMessage('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>')"><small style="font-weight:bold;text-decoration:underline">Popup Message</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Popup Message</small></a>
                <?php }   ?> 
            </div>
        </div>    
    </div>
</form> 
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
		
			</div>
		</div>
	</div>