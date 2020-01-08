<?php 
$page="PrimaryDetails";
    include_once("topmenu.php");  
    if (isset($_POST['Btnupdate'])) {
        
        $response = $webservice->getData("Admin","EditFranchisee",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","GetFranchiseeInfo");
	 $Franchisee          = $response['data']['Franchisee'];
    $FranchiseeBanks      = $response['data']['PrimaryBankAccount'];                                
    $FranchiseeStaff = $response['data']['FranchiseeStaff'];
?>
<style>
#star{color:red;}
</style>
<script>
    $(document).ready(function () {
        $("#BusinessMobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrBusinessMobileNumber").html("Digits Only").fadeIn("slow");
                return false;
            }
        });
   
        $("#BusinessWhatsappNumber").keypress(function (e) {
			if ($('#BusinessWhatsappNumber').val().trim().length==0) {
				$("#ErrBusinessWhatsappNumber").html("");
			}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#ErrBusinessWhatsappNumber").html("Digits Only").fadeIn("fast");
				return false;
			}
		});
		
		$("#BusinessLandlineNumber").keypress(function (e) {
			if ($('#BusinessLandlineNumber').val().trim().length==0) {
				$("#ErrBusinessLandlineNumber").html("");
			}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#ErrBusinessLandlineNumber").html("Digits Only").fadeIn("fast");
				return false;
			}
		});
		
		$("#LandlineStdCode").keypress(function (e) {
			if ($('#LandlineStdCode').val().trim().length==0) {
				$("#ErrLandlineStdCode").html("");
			}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#ErrLandlineStdCode").html("Digits Only").fadeIn("fast");
				return false;
			}
		});
		
        $("#MobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMobileNumber").html("Digits Only").fadeIn("slow");
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
		
		$("#FranchiseeName").blur(function () {
			IsNonEmpty("FranchiseeName","ErrFranchiseeName","Please Enter Franchisee Name");
		});
		$("#FranchiseeEmailID").blur(function () {
			if (IsNonEmpty("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter EmailID")) {
			    IsEmail("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter Valid EmailID");    
			}
		});
		$("#BusinessMobileNumber").blur(function () {
			if (IsNonEmpty("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter MobileNumber")) {
				IsMobileNumber("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter Valid MobileNumber");
			}              
		});
		$("#BusinessWhatsappNumber").blur(function () {
		   if ($('#BusinessWhatsappNumber').val().trim().length==0) {
				$("#ErrBusinessWhatsappNumber").html("");
			}
		   if ($('#BusinessWhatsappNumber').val().trim().length>0) {
				IsWhatsappNumber("BusinessWhatsappNumber","ErrBusinessWhatsappNumber","Please Enter Valid Whatsapp Number");
			}
		});
		$("#BusinessLandlineNumber").blur(function () {
			if ($('#BusinessLandlineNumber').val().trim().length>0) {
				IsNumeric("BusinessLandlineNumber","ErrBusinessLandlineNumber","Please Enter Valid Landline Number");
				if (IsNonEmpty("LandlineStdCode","ErrLandlineStdCode","Please Enter Std code")) {
					IsNumeric("LandlineStdCode","ErrLandlineStdCode","Please Enter Valid Std code");
				}
			}
		});
		$("#BusinessAddress1").blur(function () {
			IsNonEmpty("BusinessAddress1","ErrBusinessAddress1","Please Enter Valid Address Line1");
        });
		$("#CityName").blur(function () {
			IsNonEmpty("CityName","ErrCityName","Please Enter City Name");
		});
		$("#Landmark").blur(function () {
			IsNonEmpty("Landmark","ErrLandmark","Please Enter Landmark");
		});
		$("#CountryName").change(function() {
			if ($("#CountryName").val()=="0") {
				$("#ErrCountryName").html("Please select Country Name");  
			}else{
				$("#ErrCountryName").html("");  
			}
		});
		$("#StateName").change(function() {
			if ($("#StateName").val()=="0") {
				$("#ErrStateName").html("Please select State Name");  
			}else{
				$("#ErrStateName").html("");  
			}
		});
		$("#DistrictName").change(function() {
			if ($("#DistrictName").val()=="0") {
				$("#ErrDistrictName").html("Please select District Name");  
			}else{
				$("#ErrDistrictName").html("");  
			}
		});
		$("#PinCode").blur(function () {
			IsNonEmpty("PinCode","ErrPinCode","Please Enter PinCode");
		});
	
	
		
		$("#PersonName").blur(function () {
			if (IsNonEmpty("PersonName","ErrPersonName","Please Enter Person Name")) {
				IsAlphabet("PersonName","ErrPersonName","Please Enter Alphanumeric Charactors only");
			}
		});
		$("#FatherName").blur(function () {
			if (IsNonEmpty("FatherName","ErrFatherName","Please Enter Father's Name")) {
				IsAlphabet("FatherName","ErrFatherName","Please Enter Alphabet Charactors only");
			}                                                                                 
		});
		$("#Sex").change(function() {
			if ($("#Sex").val()=="0") {
				$("#ErrSex").html("Please select Gender");  
			}else{
				$("#ErrSex").html("");  
			}
		});
		$("#EmailID").blur(function () {
			if (IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")) {
				IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
			}
		});
		$("#MobileNumber").blur(function () {
			IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
		});
		$("#WhatsappNumber").blur(function () {
		   if ($('#WhatsappNumber').val().trim().length==0) {
				$("#ErrWhatsappNumber").html("");
			}
		   if ($('#WhatsappNumber').val().trim().length>0) {
				IsWhatsappNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
			}
		});
		$("#Address1").blur(function () {
			IsNonEmpty("Address1","ErrAddress1","Please Enter Address Line1");
		});
		$("#IDProof").change(function() {
			if ($("#IDProof").val()=="0") {
				$("#ErrIDProof").html("Please select ID Proof");  
			}else{
				$("#ErrIDProof").html("");  
			}
		});
		$("#IDProofNumber").blur(function () {
			IsNonEmpty("IDProofNumber","ErrIDProofNumber","Please Enter ID Proof Number");
		});
		$("#UserName").blur(function () {
			if (IsNonEmpty("UserName","ErrUserName","Please Enter Login Name")) {
				IsAlphaNumerics("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
			}
		});
		$("#Password").blur(function () {
			IsNonEmpty("Password","ErrPassword","Please Enter Password");
		});
	});



 function SubmitNewFranchisee() {
                         $('#ErrFranchiseeName').html("");
                         $('#ErrFranchiseeEmailID').html("");
                         $('#ErrBusinessMobileNumber').html("");
                         $('#ErrBusinessWhatsappNumber').html("");
                         $('#ErrBusinessLandlineNumber').html("");
                         $('#ErrLandlineStdCode').html("");
                         $('#ErrBusinessAddress1').html("");
                         $('#ErrBusinessAddress2').html("");
                         $('#ErrBusinessAddress3').html("");
                         $('#ErrLandmark').html("");
                         $('#ErrCityName').html("");
                         $('#ErrCountryName').html("");
                         $('#ErrStateName').html("");
                         $('#ErrDistrictName').html("");
                         $('#ErrPinCode').html("");
						 $('#ErrPersonName').html("");
                         $('#ErrFatherName').html("");
                         $('#ErrSex').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
						 $('#ErrAddress1').html("");
                         $('#ErrAddress2').html("");
                         $('#ErrAddress3').html("");
                         $('#ErrIDProof').html("");
                         $('#ErrIDProofNumber').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         
                         ErrorCount=0;
						
                        if (IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code")) {
							$('html, body').animate({
							scrollTop: $("#FranchiseeCode").offset().top
							}, 2000);
                        IsAlphaNumeric("FranchiseeCode","ErrFranchiseeCode","Please Enter Alpha Numeric characters only");
						}
                        if (IsNonEmpty("FranchiseeName","ErrFranchiseeName","Please Enter Franchisee Name")) {
                        IsAlphabet("FranchiseeName","ErrFranchiseeName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter EmailID")) {
                            IsEmail("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter Valid EmailID");    
                        }
                        
                        if (IsNonEmpty("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter Valid MobileNumber");
                        }
                        
                        if ($('#BusinessWhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("BusinessWhatsappNumber","ErrBusinessWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
                        if ($('#BusinessLandlineNumber').val().trim().length>0) {
                            IsNumeric("BusinessLandlineNumber","ErrBusinessLandlineNumber","Please Enter Valid Landline Number");
                            if (IsNonEmpty("LandlineStdCode","ErrLandlineStdCode","Please Enter Std code")) {
                            IsNumeric("LandlineStdCode","ErrLandlineStdCode","Please Enter Valid Std code");
                            }
                        }
                        
                        IsNonEmpty("BusinessAddress1","ErrBusinessAddress1","Please Enter Valid Address Line1");
                        
						if (IsNonEmpty("CityName","ErrCityName","Please Enter Valid City Name")) {
                        IsAlphabet("CityName","ErrCityName","Please Enter Alphabet Charactors only");
                        }
						IsNonEmpty("Landmark","ErrLandmark","Please Enter Landmark");
                        if (IsNonEmpty("PinCode","ErrPinCode","Please Enter Valid PinCode")) {
                        IsNumeric("PinCode","ErrPinCode","Please Enter Numeric Charactors only");
                        }
                        
                        if (IsNonEmpty("PersonName","ErrPersonName","Please Enter Person Name")) {
                        IsAlphabet("PersonName","ErrPersonName","Please Enter Alphanumeric Charactors only");
                        }
                        if (IsNonEmpty("FatherName","ErrFatherName","Please Enter Father's Name")) {
                        IsAlphabet("FatherName","ErrFatherName","Please Enter Alphabet Charactors only");
                        }
                        
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        
                        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        IsNonEmpty("Address1","ErrAddress1","Please Enter Valid Address Line1");
                        IsNonEmpty("IDProofNumber","ErrIDProofNumber","Please Enter ID Proof Number");
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter Login Name")) {
                        IsAlphaNumerics("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsNonEmpty("Password","ErrPassword","Please Enter Login Password")) {
                        IsAlphaNumeric("Password","ErrPassword","Alpha Numeric Characters only");
                        }
                        if ($("#CountryName").val() == "0") {
							$("#ErrCountryName").html("Please select Country Name");
							ErrorCount++;
						}
						if ($("#StateName").val() == "0") {
							$("#ErrStateName").html("Please select State Name");
							ErrorCount++;
						}
						if ($("#DistrictName").val() == "0") {
							$("#ErrDistrictName").html("Please select District Name");
							ErrorCount++;
						}
						if ($("#Plan").val() == "0") {
							$("#ErrPlan").html("Please select Plan");
							ErrorCount++;
						}
						
						if ($("#Sex").val() == "0") {
							$("#ErrSex").html("Please select Gender");
							ErrorCount++;
						}
						if ($("#IDProof").val() == "0") {
							$("#ErrIDProof").html("Please select ID Proof");
							ErrorCount++;
						}
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
							alert(ErrorCount);
                            return false;
                        }
   
                 }                                                  
    
</script>


<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $Franchisee['FranchiseeCode'];?>" name="FranCode" id="FranCode">
    <input type="hidden" value="<?php echo $Franchisee['Plan'];?>" name="PlanName" id="PlanName">
       <div class="form-group row">
    
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
				    <div class="form-group row mb0">
						    <div style="padding:15px !important;max-width:770px !important;">
					    <h4 class="card-title">Business Information</h4>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
						    <div class="col-sm-3">
							    <input type="text" class="form-control" disabled="disabled" id="FranchiseeCode" name="FranchiseeCode" Placeholder="Franchisee Code" value="<?php echo (isset($_POST['FranchiseeCode']) ? $_POST['FranchiseeCode'] : $Franchisee['FranchiseeCode']);?>">
							    <span class="errorstring" id="ErrFranchiseeCode"><?php echo isset($ErrFranchiseeCode)? $ErrFranchiseeCode : "";?></span>
						    </div>
						    <div class="col-sm-2"> </div>
						    <div class="col-sm-3">
                           
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Franchisee Name<span id="star">*</span></label>
						    <div class="col-sm-9">
							    <input type="text" class="form-control" id="FranchiseeName" name="FranchiseeName" Placeholder="Franchisee Name" value="<?php echo (isset($_POST['FranchiseeName']) ? $_POST['FranchiseeName'] : $Franchisee['FranchiseName']);?>">
							    <span class="errorstring" id="ErrFranchiseeName"><?php echo isset($ErrFranchiseeName)? $ErrFranchiseeName : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label"> Email Id<span id="star">*</span></label>
						    <div class="col-sm-9">
							    <input type="type" class="form-control" id="FranchiseeEmailID" name="FranchiseeEmailID" Placeholder="Email ID" value="<?php echo (isset($_POST['FranchiseeEmailID']) ? $_POST['FranchiseeEmailID'] : $Franchisee['ContactEmail']);?>">
							    <span class="errorstring" id="ErrFranchiseeEmailID"><?php echo isset($ErrFranchiseeEmailID)? $ErrFranchiseeEmailID : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
						    <div class="col-sm-3">
							    <select class="selectpicker form-control" data-live-search="true" name="ContactNumberCountryCode" id="ContactNumberCountryCode" style="width: 61px;">
								    <?php foreach($response['data']['CountryCode'] as $CountryCode) { ?>
									    <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'ContactNumberCountryCode'])) ? (($_POST[ 'ContactNumberCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "") : (($Franchisee[ 'ContactNumberCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "");?> >
										    <?php echo $CountryCode['str'];?>
									    </option>
								    <?php } ?>                       
							    </select>
						    </div>
						    <div class="col-sm-6">
							    <input type="text" maxlength="10" class="form-control" id="BusinessMobileNumber" name="BusinessMobileNumber" Placeholder="Mobile Number" value="<?php echo (isset($_POST['BusinessMobileNumber']) ? $_POST['BusinessMobileNumber'] : $Franchisee['ContactNumber']);?>">
							    <span class="errorstring" id="ErrBusinessMobileNumber"><?php echo isset($ErrBusinessMobileNumber)? $ErrBusinessMobileNumber : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Whatsapp Number </label>
						    <div class="col-sm-3">
							    <select class="selectpicker form-control" data-live-search="true" name="ContactWhatsappCountryCode" id="ContactWhatsappCountryCode" style="width: 61px;">
								    <?php foreach($response['data']['CountryCode'] as $CountryCode) { ?>
									    <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'ContactWhatsappCountryCode'])) ? (($_POST[ 'ContactWhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "") : (($Franchisee[ 'ContactWhatsappCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "");?> >
										    <?php echo $CountryCode['str'];?>
									    </option>
								    <?php } ?> 
							    </select>
						    </div>
						    <div class="col-sm-6">
							    <input type="text" maxlength="10" class="form-control" id="BusinessWhatsappNumber" name="BusinessWhatsappNumber" Placeholder="Whatsapp Number" value="<?php echo (isset($_POST['BusinessWhatsappNumber']) ? $_POST['BusinessWhatsappNumber'] : $Franchisee['ContactWhatsapp']);?>">
							    <span class="errorstring" id="ErrBusinessWhatsappNumber"><?php echo isset($ErrBusinessWhatsappNumber)? $ErrBusinessWhatsappNumber : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Landline Number </label>
						    <div class="col-sm-3">
							    <select class="selectpicker form-control" data-live-search="true" name="LandlineCountryCode" id="LandlineCountryCode" style="width: 61px;">
								    <?php foreach($response['data']['CountryCode'] as $CountryCode) { ?>
									    <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'LandlineCountryCode'])) ? (($_POST[ 'LandlineCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "") : (($Franchisee[ 'LandlineCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "");?> >
										    <?php echo $CountryCode['str'];?>
									    </option>
								    <?php } ?> 
							    </select>
							</div>
						    <div class="col-sm-2">
                                <input type="text" class="form-control" id="LandlineStdCode" name="LandlineStdCode" Placeholder="Std" value="<?php echo (isset($_POST['LandlineStdCode']) ? $_POST['LandlineStdCode'] : $Franchisee['LandlineStdCode']);?>">
                                <span class="errorstring" id="ErrLandlineStdCode"><?php echo isset($ErrLandlineStdCode)? $ErrLandlineStdCode : "";?></span>
                            </div>
                            <div class="col-sm-4">
							    <input type="text" class="form-control" id="BusinessLandlineNumber" name="BusinessLandlineNumber" Placeholder="Landline Number" value="<?php echo (isset($_POST['BusinessLandlineNumber']) ? $_POST['BusinessLandlineNumber'] : $Franchisee['ContactLandline']);?>">
							    <span class="errorstring" id="ErrBusinessLandlineNumber"><?php echo isset($ErrBusinessLandlineNumber)? $ErrBusinessLandlineNumber : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
						    <div class="col-sm-9">
							    <input type="text" class="form-control" id="BusinessAddress1" name="BusinessAddress1" Placeholder="Address Line 1" value="<?php echo (isset($_POST['BusinessAddress1']) ? $_POST['BusinessAddress1'] : $Franchisee['BusinessAddressLine1']);?>">
							    <span class="errorstring" id="ErrBusinessAddress1"><?php echo isset($ErrBusinessAddress1)? $ErrBusinessAddress1 : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-9">
							    <input type="text" class="form-control" id="BusinessAddress2" name="BusinessAddress2" Placeholder="Address Line 2" value="<?php echo (isset($_POST['BusinessAddress2']) ? $_POST['BusinessAddress2'] : $Franchisee['BusinessAddressLine2']);?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-9">
							    <input type="text" class="form-control" id="BusinessAddress3" name="BusinessAddress3" Placeholder="Address Line 3" value="<?php echo (isset($_POST['BusinessAddress3']) ? $_POST['BusinessAddress3'] : $Franchisee['BusinessAddressLine3']);?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">City Name<span id="star">*</span></label>
						    <div class="col-sm-3">
							    <input type="text" class="form-control" id="CityName" name="CityName" Placeholder="City Name" value="<?php echo (isset($_POST['CityName']) ? $_POST['CityName'] : $Franchisee['CityName']);?>">
							    <span class="errorstring" id="ErrCityName"><?php echo isset($ErrCityName)? $ErrCityName : "";?></span></div>
						    <label class="col-sm-2 col-form-label">Landmark<span id="star">*</span></label>
						    <div class="col-sm-4">
							    <input type="text" class="form-control" id="Landmark" name="Landmark" Placeholder="Land Mark" value="<?php echo (isset($_POST['Landmark']) ? $_POST['Landmark'] : $Franchisee['Landmark']);?>">
							    <span class="errorstring" id="ErrLandmark"><?php echo isset($ErrLandmark)? $ErrLandmark : "";?></span></div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Country Name <span id="star">*</span></label>
						    <div class="col-sm-9">
							    <select  onchange="Franchisee.getStateNames($(this).val())" class="selectpicker form-control" data-live-search="true" id="CountryName" name="CountryName">
								    <?php foreach($response['data']['CountryNames'] as $CountryName) { ?>
									    <option value="<?php echo $CountryName['SoftCode'];?>" <?php echo (isset($_POST[ 'CountryName'])) ? (($_POST[ 'CountryName']==$CountryName[ 'CodeValue']) ? " selected='selected' " : "") : (($Franchisee[ 'CountryName']==$CountryName[ 'CodeValue']) ? " selected='selected' " : "");?> >
										    <?php echo $CountryName['CodeValue'];?>
									    </option>
									    <?php } ?>
							    </select>
								<span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrLCountryName : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">State Name<span id="star">*</span></label>
						    <div class="col-sm-3">
							    <select onchange="Franchisee.getDistrictNames($(this).val())" class="selectpicker form-control" data-live-search="true" id="StateName" name="StateName">
                                        <option value="<?php echo $Franchisee[ 'StateNameCode'];?>"><?php echo ($Franchisee[ 'StateName']);?></option>
							    </select>
								<span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
						    </div>                                                  
						    <label class="col-sm-2 col-form-label">District Name<span id="star">*</span></label>
						    <div class="col-sm-4">
							    <select class="selectpicker form-control" data-live-search="true" id="DistrictName" name="DistrictName">
                                    <option value="<?php echo $Franchisee[ 'DistrictNameCode'];?>"><?php echo ($Franchisee[ 'DistrictName']);?></option>
							    </select>
								<span class="errorstring" id="ErrDistrictName"><?php echo isset($ErrDistrictName)? $ErrDistrictName : "";?></span>
						    </div>
					    </div>
					    <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Pin/Zip Code<span id="star">*</span></label>
						    <div class="col-sm-3">
							    <input type="text" maxlength="10" class="form-control" id="PinCode" name="PinCode" Placeholder="Pin Code" value="<?php echo (isset($_POST['PinCode']) ? $_POST['PinCode'] : $Franchisee['PinCode']);?>">
							    <span class="errorstring" id="ErrPinCode"><?php echo isset($ErrPinCode)? $ErrPinCode : "";?></span></div>
						    <label class="col-sm-2 col-form-label">Plan<span id="star">*</span></label>
						    <div class="col-sm-4">
							    <input type="text" disabled="disabled" class="form-control" id="Plan" name="Plan" value="<?php echo $Franchisee['Plan'];?>"><br>
							    <a href="javascript:void(0)" onclick="ViewFranchiseePlanDetails()">view plan</a>
						    </div>
					    </div>
					    
				    </div>
					    </div>
					    
				    </div>
		        </div>
            <br><br>     
            <div class="card">
                <div class="card-body">
                <div style="padding:15px !important;max-width:770px !important;">
					<div class="form-group row">
						<div class="col-sm-7"><h4 class="card-title">Bank Account Details</h4></div>
						<div class="col-sm-5" style="text-align:right"><a href="javascript:void(0)" onclick="AddBankDetails()" class="btn btn-primary" name="BtnSaveBankDetails">Add Bank</a></div>
					</div>
					<div id="grid_accountdetails">
					<table class="table table-bordered">
						<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
							<tr>
								<th>Bank Name</th>
								<th>A/C Name</th>
								<th>A/C Number</th>
								<th>IFS Code</th>
								<th>Type</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($FranchiseeBanks as $FranchiseeBank) { ?>
							<tr id="Bankview_<?php echo $FranchiseeBank['BankID'];?>">    
								<td><?php echo $FranchiseeBank['BankName'];?></td>
								<td><?php echo $FranchiseeBank['AccountName'];?></td>
								<td><?php echo $FranchiseeBank['AccountNumber'];?></td>
								<td><?php echo $FranchiseeBank['IFSCode'];?></td>
								<td><?php echo $FranchiseeBank['AccountType'];?></td>
								<td><a href="javascript:void(0)" onclick="showConfirmDeleteBankDetails('<?php  echo $FranchiseeBank['BankID'];?>','<?php echo $_GET['Code'];?>','<?php echo $FranchiseeBank['BankName'];?>','<?php echo $FranchiseeBank['AccountName'];?>','<?php echo $FranchiseeBank['AccountNumber'];?>','<?php echo $FranchiseeBank['IFSCode'];?>','<?php echo $FranchiseeBank['AccountType'];?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					</div>
				</div>
            </div>
            </div>  
			
            <br><Br>
            <div class="card">
            <div class="card-body">
            <div style="padding:15px !important;max-width:770px !important;">
                <h4 class="card-title">Primary Staff Information</h4>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Person Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="PersonName" name="PersonName" Placeholder="Person Name" value="<?php echo (isset($_POST['PersonName']) ? $_POST['PersonName'] : $FranchiseeStaff['PersonName']);?>">
                        <span class="errorstring" id="ErrPersonName"><?php echo isset($ErrPersonName)? $ErrPersonName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Father's Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="FatherName" name="FatherName" Placeholder="Father's Name" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : $FranchiseeStaff['FatherName']);?>">
                        <span class="errorstring" id="ErrFatherName"><?php echo isset($ErrFatherName)? $ErrFatherName : "";?> </span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date of birth<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <div class="col-sm-3" style="padding:0px !important;">
                            <?php $dob=strtotime($FranchiseeStaff['DateofBirth'])  ; ?>
                            <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                <option value="0">Day</option>
                                <?php for($i=1;$i<=31;$i++) {?>
                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </div>            
                        <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                            <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                <option value="0">Month</option>
                                <?php foreach($_Month as $key=>$value) {?>
                                <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                            <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                <option value="0">Year</option>
                                <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                <?php } ?>
                            </select>      
                        </div>
                    </div>
                    <label class="col-sm-2 col-form-label">Gender<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                            <?php foreach($response['data']['Gender'] as $Sex) { ?>
								<option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($FranchiseeStaff[ 'SexCode']==$Sex[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                    <?php echo $Sex['CodeValue'];?>
                                </option>
                            <?php } ?>
                        </select>
						<span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email Id<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="EmailID" name="EmailID" Placeholder="Email ID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $FranchiseeStaff['EmailID']);?>">
                        <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
                            <?php foreach($response['data']['CountryCode'] as $CountryCode) { ?>
                                <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "") : (($Franchisee[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "");?> >
                                    <?php echo $CountryCode['str'];?>
                                </option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" Placeholder="Mobile Number" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $FranchiseeStaff['MobileNumber']);?>">
                        <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="WhatsappNumberCountryCode" id="WhatsappNumberCountryCode" style="width: 61px;">
                            <?php foreach($response['data']['CountryCode'] as $CountryCode) { ?>
                                <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappNumberCountryCode'])) ? (($_POST[ 'WhatsappNumberCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "") : (($Franchisee[ 'WhatsappNumberCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "");?> >
                                    <?php echo $CountryCode['str'];?>
                                </option>
                            <?php } ?>                       
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" Placeholder="Whatsapp Number" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $FranchiseeStaff['WhatsappNumber']);?>">
                        <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Address1" name="Address1" Placeholder="Address Line 1" value="<?php echo (isset($_POST['Address1']) ? $_POST['Address1'] : $FranchiseeStaff['AddressLine1']);?>">
                        <span class="errorstring" id="ErrAddress1"><?php echo isset($ErrAddress1)? $ErrAddress1 : "";?></span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Address2" name="Address2" Placeholder="Address Line 2" value="<?php echo (isset($_POST['Address2']) ? $_POST['Address2'] : $FranchiseeStaff['AddressLine2']);?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="Address3" name="Address3" Placeholder="Address Line 3" value="<?php echo (isset($_POST['Address3']) ? $_POST['Address3'] : $FranchiseeStaff['AddressLine3']);?>">
                    </div>
                </div>
                <div class="form-group row">
					<label class="col-sm-3 col-form-label">ID Proof<span id="star">*</span></label>
					<div class="col-sm-4">
						<select class="selectpicker form-control" data-live-search="true" id="IDProof" name="IDProof">
							<?php foreach($response['data']['IDProof'] as $IDProof) { ?>
                                <option value="<?php echo $IDProof['SoftCode'];?>" <?php echo (isset($_POST[ 'IDProof'])) ? (($_POST[ 'IDProof']==$IDProof[ 'SoftCode']) ? " selected='selected' " : "") : (($FranchiseeStaff[ 'IDProofCode']==$IDProof[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                    <?php echo $IDProof['CodeValue'];?>
                                </option>
                                <?php } ?>
						</select>
						<span class="errorstring" id="ErrIDProof"><?php echo isset($ErrIDProof)? $ErrIDProof : "";?></span>
					</div>
					<label class="col-sm-2 col-form-label">ID Number<span id="star">*</span></label> 
					<div class="col-sm-3">
						<input type="text" class="form-control" id="IDProofNumber" name="IDProofNumber" Placeholder="ID Proof No" value="<?php echo (isset($_POST['IDProofNumber']) ? $_POST['IDProofNumber'] : $FranchiseeStaff['IDProofNumber']);?>">
						<span class="errorstring" id="ErrIDProofNumber"><?php echo isset($ErrIDProofNumber)? $ErrIDProofNumber : "";?> </span>
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Login Name</label>
                    <div class="col-sm-4">
                        <input type="text" minlength="6" disabled="disabled" class="form-control" id="UserName" name="UserName" Placeholder="Login Name" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : $FranchiseeStaff['LoginName']);?>">
                        <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?> </span></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Login Password</label>
                    <div class="col-sm-4">
                    
                    <div class="input-group">
                                <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="Password" name="Password" Placeholder="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : $FranchiseeStaff['LoginPassword']);?>">
                                <span class="input-group-btn">
                                    <button  onclick="showHidePwd('Password',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                </span>          
                           </div>
                        <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?> </span>
                </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Txn Password</label>
                    <div class="col-sm-4">
                    
                    <div class="input-group">
                                <input type="password" disabled="disabled" class="form-control pwd"  maxlength="8" id="TxnPassword" name="Password" Placeholder="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : $FranchiseeStaff['TransactionPassword']);?>">
                                <span class="input-group-btn">
                                    <button  onclick="showHidePwd('TxnPassword',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                </span>          
                           </div>
                        <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?> </span>
                </div>
                </div>
               
                                                                                                    
        </div>
        </div>
    </div>
            <br>
            
        <div class="form-group row">
          <div class="col-sm-12" style="text-align:right;">
          <!--&nbsp;<a href="../MangeFranchisees"><small style="font-weight:bold;text-decoration:underline">List of Franchisee</small></a>-->
          &nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="Franchisee.ConfirmGotoBackFromEditFranchisee()">Cancel</a>&nbsp;
          <a href="javascript:void(0)" onclick="Franchisee.ConfirmEditFranchisee()" class="btn btn-primary" name="BtnSaveCreate">Update Franchisee</a>
          </div>
        </div>
 
	    </div>
        <div class="col-sm-3">
                       
                        <div class="form-group row">
                        <div class="col-sm-12 col-form-label">
                            Created On <br>
                            <?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?><br><br> 
                        </div>
                        <div class="col-sm-12 col-form-label">
                            Last Updated On<br>
                            <?php echo (isset($_POST['CreatedOn']) ? $_POST['CreatedOn'] : putDateTime($Franchisee['CreatedOn']));?><br><Br>
                        </div>
                        <div class="col-sm-12 col-form-label">
                           
                             <span class="<?php echo ($Franchisee['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                             &nbsp;&nbsp;&nbsp;
                             <small style="color:#737373;">
                                      <?php if($Franchisee['IsActive']==1){
                                          echo "Active";
                                      }                                  
                                      else{
                                          echo "Deactive";
                                      }
                                      ?>
                                      </small>
                             </div>
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/View/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">View Franchisee</small></a></div>
                            <div class="col-sm-12 col-form-label"><?php if($Franchisee['IsActive']==1) { ?>
                                <a href="<?php echo GetUrl("Franchisees/BlockFranchisee/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Franchisee</small></a>                                   
                                 <?php } else {    ?>
                                    <a href="<?php echo GetUrl("Franchisees/BlockFranchisee/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">UnBlock Franchisee</small></a>
                                <?php } ?></div>
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a></div>  
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/FranchiseeStaffs/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">View Staffs</small></a></div>  
                            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Franchisees/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">View Transactions</small></a></div>  
                        </div>
                    </div>
	</div>
    </div>
</form>
    
    <div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
		
			</div>
		</div>
	</div>
	<div class="modal" id="AddBankNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="AddBank_body"  style="max-height: 432px;min-height: 432px;" >
				
			</div>
		</div>
	</div>
	
	<div id="AddBankDesign" style="display:none">
		<input type="hidden" value="<?php echo $Franchisee['FranchiseeID'];?>" name="FranchiseeID" id="FranchiseeID">
		<div class="modal-header">
					<h4 class="modal-title">Add Bank Details</h4>
					<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
				</div>
				<div class="modal-body" style="min-height: 308px;max-height: 308px;max-width: 504px;min-width: 504px;">
					<div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="BankName" name="BankName" list="5">
                                <?php foreach($response['data']['BankNames'] as $BankName) { ?>
                                    <option value="<?php echo $BankName['SoftCode'];?>" <?php echo ($BankName[ 'SoftCode']==$_POST[ 'BankName']) ? ' selected="selected" ' : '';?>>
										<?php echo $BankName['CodeValue'];?>
									</option>
                                <?php } ?>
                            </select>
							<span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Account Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="<?php echo (isset($_POST['AccountName']) ? $_POST['AccountName'] : "");?>">
                            <span class="errorstring" id="ErrAccountName"><?php echo isset($ErrAccountName)? $ErrAccountName : "";?></span></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="<?php echo (isset($_POST['AccountNumber']) ? $_POST['AccountNumber'] : "");?>">
                            <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : "");?>">
                            <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span></div>
                    </div>
                    <div class="form-group row">
						<label class="col-sm-3 col-form-label">Account Type<span id="star">*</span></label>
						<div class="col-sm-4">
                            <select class="form-control" id="AccountType" name="AccountType">
                                <?php foreach($response['data']['AccountType'] as $AccountType) { ?>
                                    <option value="<?php echo $AccountType['SoftCode'];?>" <?php echo ($AccountType[ 'SoftCode']==$_POST[ 'AccountType']) ? ' selected="selected" ' : '';?>>
										<?php echo $AccountType['CodeValue'];?>
									</option>
                                    <?php } ?>
                            </select>
							<span class="errorstring" id="ErrAccountType"><?php echo isset($ErrAccountType)? $ErrAccountType : "";?></span>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="AddFranchiseeBankDetails()" style="font-family:roboto">Add Bank</button>
                </div>
	</div>
    <script>

function ViewFranchiseePlanDetails() {
	 var param = $("#frmfrn").serialize();
	$('#Publish_body').html(preloading_withText("View Plan ...","95"));
	 $('#PubplishNow').modal('show'); 
        $.post(API_URL + "m=Admin&a=ViewFranchiseePlanDetails",param,function(result) {
      $('#Publish_body').html(result);  
        });
    }

function AddBankDetails() {
	$('#AddBankNow').modal('show');
	var formrnd_id = "formid_"+Math.floor(Math.random() * 1000);
	$('#AddBank_body').html("<form id='"+formrnd_id+"' method='post'><input type='hidden' name='formid' id='formid' value='"+formrnd_id+"'>"+$("#AddBankDesign").html()+"</form>");
}

function AddFranchiseeBankDetails() {
		$("#ErrAccountName").html("");
		 if ($("#AccountName").val().trim()=="") {
			 $("#ErrAccountName").html("Please Enter Account Name");
			 return false;
		 }
		$("#ErrAccountNumber").html("");
		 if ($("#AccountNumber").val().trim()=="") {
			 $("#ErrAccountNumber").html("Please Enter Account Name");
			 return false;
		 }
		 $("#ErrIFSCode").html("");
		 if ($("#IFSCode").val().trim()=="") {
			 $("#ErrIFSCode").html("Please Enter IFSCode");
			 return false;
		 }
       var param = $("#"+$('#formid').val()).serialize();
        $('#AddBank_body').html(preloading_withText("Add Bank details ...","154"));
		$.post(API_URL + "m=Admin&a=AddFranchiseeBankDetails",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#AddBank_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 90px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Bank details update</h3>'
                                    + '<p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color: #00b7ff;">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
							
                var tblData = '<table class="table table-bordered">'
						+ '<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">'
							+ '<tr>'
								+ '<th>Bank Name</th>'
								+ '<th>A/C Name</th>'
								+ '<th>A/C Number</th>'
								+ '<th>IFS Code</th>'
								+ '<th>Type</th>'
								+ '<th></th>'
							+ '</tr>'
						+ '</thead>'
						+ '<tbody>';
						 $.each(data, function(i, item) {
							tblData += '<tr id="Bankview_'+item.BankID+'">'
								+ '<td>'+item.BankName+'</td>'
								+ '<td>'+item.AccountName+'</td>'
								+ '<td>'+item.AccountNumber+'</td>'
								+ '<td>'+item.IFSCode+'</td>'
								+ '<td>'+item.AccountType+'</td>'
								+ '<td><a href="javascript:void(0)" onclick="showConfirmDeleteBankDetails(\''+item.BankID+'\',\''+item.FranchiseeID+'\',\''+item.BankName+'\',\''+item.AccountName+'\',\''+item.AccountNumber+'\',\''+item.IFSCode+'\',\''+item.AccountType+'\')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a></td>'
							+ '</tr>';
						}); 
						tblData += '</tbody>'
					+ '</table>   ';
                $('#AddBank_body').html(content);
				  $('#grid_accountdetails').html(tblData);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Add Bank Details</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" href="javascript:void(0)" onclick="AddBankDetails()" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#AddBank_body').html(content);
            }
        });
    }
// var param = $("#"+$('#formid').val()).serialize();
$( document ).ready(function() {
    Franchisee.getStateNames('<?php echo $Franchisee[ 'CountryNameCode'];?>','<?php echo $Franchisee[ 'StateNameCode'];?>');
    Franchisee.getDistrictNames('<?php echo $Franchisee[ 'StateNameCode'];?>','<?php echo $Franchisee[ 'DistrictNameCode'];?>');
});
function showConfirmDeleteBankDetails(BankID,FranchiseeID,BankName,AccountName,AccountNumber,IFSCode,AccountType) {
       $('#PubplishNow').modal('show'); 
	   var content= '<div class="modal-header">'
						+ '<h4 class="modal-title">Confirmation for delete bank details</h4>'
						+ '<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
					+ '</div>'
					+ '<form method="post" id="form_'+BankID+'" name="form_'+BankID+'" > '
                        + '<input type="hidden" value="'+BankID+'" name="BankID">'
                        + '<input type="hidden" value="'+FranchiseeID+'" name="FranchiseeID">'
						+'<div class="modal-body" style="max-height: 190px;min-height: 190px;">'
							+'<div>Are you sure want to remove below records?  <br><br>'
								+'<table class="table table-bordered">'
									+'<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;"> '
										+'<tr>'
											+'<th>Bank Name</th>'
											+'<th>A/C Name</th>'
											+'<th>A/C No</th>'
											+'<th>IFSCode</th>'
											+'<th>AccountType</th>'
										+'</tr>'
									+'</thead>'
									+ '<tbody> '
										+'<tr>'                                                  
											+'<td>'+BankName+'</td>'
											+'<td>'+AccountName +'</td>'
											+'<td>'+AccountNumber +'</td>'
											+'<td>'+IFSCode +'</td>'
											+'<td>'+AccountType +'</td>'
											
										+'</tr>'
									+'</tbody>'
								+'</table>'
							+'</div>'
						+'</div>' 
						+'<div class="modal-footer">'
							+'<button type="button" class="btn btn-default" data-dismiss="modal">No</button>&nbsp;&nbsp;'
							+'<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="DeleteBankDetails(\''+BankID+'\')" style="font-family:roboto">Yes, remove</button>'
						+'</div>'
					+'</form>';
                                                                                                     
            $('#Publish_body').html(content);
}
 function DeleteBankDetails(BankID) {
        var param = $("#form_"+BankID).serialize();
        $('#Publish_body').html(preloading_withText("Deleting ...","101"));
		$.post(API_URL + "m=Admin&a=DeleteFrBankDetails", param, function(result) {
          if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Bank details removed</h3>'
                                    + '<p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color: #00b7ff;">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
							
                var tblData = '<table class="table table-bordered">'
						+ '<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">'
							+ '<tr>'
								+ '<th>Bank Name</th>'
								+ '<th>A/C Name</th>'
								+ '<th>A/C Number</th>'
								+ '<th>IFS Code</th>'
								+ '<th>Type</th>'
								+ '<th></th>'
							+ '</tr>'
						+ '</thead>'
						+ '<tbody>';
						 $.each(data, function(i, item) {
							tblData += '<tr id="Bankview_'+item.BankID+'">'
								+ '<td>'+item.BankName+'</td>'
								+ '<td>'+item.AccountName+'</td>'
								+ '<td>'+item.AccountNumber+'</td>'
								+ '<td>'+item.IFSCode+'</td>'
								+ '<td>'+item.AccountType+'</td>'
								+ '<td><a href="javascript:void(0)" onclick="showConfirmDeleteBankDetails(\''+item.BankID+'\',\''+item.FranchiseeID+'\',\''+item.BankName+'\',\''+item.AccountName+'\',\''+item.AccountNumber+'\',\''+item.IFSCode+'\',\''+item.AccountType+'\')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a></td>'
							+ '</tr>';
						}); 
						tblData += '</tbody>'
					+ '</table>   ';
                $('#Publish_body').html(content);
				  $('#grid_accountdetails').html(tblData);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Delete Bank Details</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" class="close" data-dismiss="modal" style="padding-top:5px;text-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $(Publish_body).html(content);
            }
        }
    );
}
</script>
                    