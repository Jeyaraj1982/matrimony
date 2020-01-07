<?php
$page="FrStaffInfo";
    if (isset($_POST['Btnupdate'])) {
        $response = $webservice->getData("Franchisee","EditFranchiseeInfo",$_POST);
        if ($response['status']=="success") {   
            $successmessage =$response['message']; ?>
        <!--   <script>location.href='<?php //echo AppUrl;?>MySettings/FranchiseeInfoUpdated';</script>-->
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Franchisee","GetFranchiseeInfo");
    $Franchisee=$response['data'];
    $CountryCodes=$Franchisee['Country'];
?>
    <script>
        $(document).ready(function() {
            $("#MobileNumber").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
                    return false;
                }
            });
            $("#FranchiseeName").blur(function() {
                IsNonEmpty("FranchiseeName", "ErrFranchiseeName", "Please Enter Franchisee Name");
            });
            $("#MobileNumber").blur(function() {
                IsNonEmpty("MobileNumber", "ErrMobileNumber", "Please Enter Mobile Number");
            });
            $("#EmailID").blur(function() {
                IsNonEmpty("EmailID", "ErrEmailID", "Please Enter Email ID");
            });
        });

        function SubmitNewFranchisee() {
            $('#ErrFranchiseeName').html("");
            $('#ErrMobileNumber').html("");
            $('#ErrEmailID').html("");

            ErrorCount = 0;
            if (IsNonEmpty("FranchiseeName", "ErrFranchiseeName", "Please Enter Franchisee Name")) {
                IsAlphabet("FranchiseeName", "ErrFranchiseeName", "Please Enter Alpha Numeric characters only");
            }
            if (IsNonEmpty("MobileNumber", "ErrMobileNumber", "Please Enter MobileNumber")) {
                IsMobileNumber("MobileNumber", "ErrMobileNumber", "Please Enter Valid Mobile Number");
            }
            if (IsNonEmpty("EmailID", "ErrEmailID", "Please Enter EmailID")) {
                IsEmail("EmailID", "ErrEmailID", "Please Enter Valid EmailID");
            }
            return (ErrorCount == 0) ? true : false;
        }
    </script>
    <?php include_once("settings_header.php");?>
        <form method="post" action="" onsubmit="return SubmitNewFranchisee();">

            <div class="col-sm-9" style="margin-top: -8px;">
                <h4 class="card-title">Edit Staff Information</h4>
                <div class="form-group row">
                    <div class="col-sm-3" style="margin-right: -40px;"><small>Staff Code</small> </div>
                    <div class="col-sm-3">
                        <input type="text" disabled="disabled" class="form-control" id="FranchiseeCode" name="FranchiseeCode" style="width:84%" value="<?php echo (isset($_POST['FranchiseeCode']) ? $_POST['FranchiseeCode'] : $Franchisee['StaffCode']);?>" placeholder="Franchisee Code">
                        <span class="errorstring" id="ErrFranchiseeCode"><?php echo isset($ErrFranchiseeCode)? $ErrFranchiseeCode : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3" style="margin-right: -40px;"><small>Franchisee Name<span id="star">*</span></small> </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="FranchiseeName" name="FranchiseeName" value="<?php echo (isset($_POST['FranchiseeName']) ? $_POST['FranchiseeName'] : $Franchisee['PersonName']);?>" placeholder="Franchisee Name">
                        <span class="errorstring" id="ErrFranchiseeName"><?php echo isset($ErrFranchiseeName)? $ErrFranchiseeName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3" style="margin-right: -40px;"><small>Mobile Number<span id="star">*</span></small></div>
                    <div class="col-sm-9">
                        <?php if($Franchisee['IsMobileVerified']==0){ ?>
                            <div class="col-sm-4" style="margin-left: -15px;">
                                <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
                                   <?php foreach($CountryCodes as $CountryCode) { ?>
                                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Franchisee[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $CountryCode['str'];?>
                                   <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6" style="margin-left: -25px;width: 29%;">
                                <input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Franchisee['MobileNumber']);?>" placeholder="Mobile Number">
                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                            <div class="col-sm-3" style="padding-top: 7px;padding-left: 0px;"><a href="javascript:void(0)" onclick="MobileNumberVerificationForm()">Verfiy now</a></div>
                            <?php } else{ ?>
                                <div class="col-sm-4" style="margin-left: -15px;">
                                <select class="selectpicker form-control" disabled="disabled" blocked data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
                                   <?php foreach($CountryCodes as $CountryCode) { ?>
                                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Franchisee[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $CountryCode['str'];?>
                                   <?php } ?>
                                </select>
                                </div>
                                <div class="col-sm-6" style="margin-left: -15px;width: 29%;">
                                <input type="text" class="form-control" disabled="disabled" blocked maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Franchisee['MobileNumber']);?>" placeholder="Mobile Number"></div>
                                <div class="col-sm-3" style="color:#5dce37"><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" style="width:17%">&nbsp;Verified</div>
                            <?php }?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3" style="margin-right: -40px;"><small>Email ID<span id="star">*</span></small></div>
                    <div class="col-sm-9">
                        <?php if($Franchisee['IsEmailVerified']==0){ ?>
                        <div class="col-sm-8" style="margin-left: -15px;">
                            <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Franchisee['EmailID']);?>" placeholder="Email ID" style="width:87%">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                            <div class="col-sm-4" style="padding-top: 7px;padding-left: 0px;"><a href="javascript:void(0)" onclick="EmailVerificationForm()">Verfiy now</a> </div>
                            <?php } else{ ?>
                            <div class="col-sm-8" style="margin-left: -15px;">
                                <input type="text" disabled="disabled" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Franchisee['EmailID']);?>" placeholder="Email ID" style="width:87%"> </div>
                                <div class="col-sm-3" style="color:#5dce37;margin-left:-33px" ><img src="<?php echo SiteUrl?>assets/images/icon_verified.png" width="15%">&nbsp;Verified</div>
                        <?php }?>
                    </div>
                </div>   
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" style="margin-right: -40px;">Login Name</label>
					<div class="col-sm-5">
						<input type="text" disabled="disabled" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : $Franchisee['LoginName']);?>" >
						<span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" style="margin-right: -40px;">Login Password<span id="star">*</span></label>
					<div class="col-sm-5">
						<div class="input-group">
							<input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="LoginPassword" name="LoginPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Franchisee['LoginPassword']);?>">
							<span class="input-group-btn">
								<button  onclick="showHidePwd('LoginPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
							</span>          
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label" style="margin-right: -40px;">Transaction Password<span id="star">*</span></label>
					<div class="col-sm-5">
						<div class="input-group">
							<input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="StaffTransactionPassword" name="StaffTransactionPassword" Placeholder="Transaction Password" value="<?php echo (isset($_POST['TransactionPassword']) ? $_POST['TransactionPassword'] : $Franchisee['TransactionPassword']);?>">
							<span class="input-group-btn">
								<button  onclick="showHidePwd('StaffTransactionPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
							</span>          
						</div> 
					</div>
				</div>				
                <div class="form-group row">
                    <div class="col-sm-12" style="text-align:center;color:red">
                        <?php echo $successmessage;?>
                            <?php echo $errormessage;?>
                    </div>
                </div>
                <div class="form-group row">                                                                            
                    <div class="col-sm-4">
                        <button type="submit" name="Btnupdate" class="btn btn-primary mr-2" style="font-family: roboto;">Update Information</button>
                    </div>
                    <div class="col-sm-3" style="margin-left: -60px;margin-top: 6px;"><a href="FranchiseeInfo" style="color: #424141">Cancel</a></div>
                </div>
            </div>

        </form>
        <?php include_once("settings_footer.php");?>  