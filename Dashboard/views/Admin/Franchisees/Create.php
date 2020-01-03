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
		$("#FranchiseeCode").blur(function () {
			IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code");
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
		$("#Plan").change(function() {
			if ($("#Plan").val()=="0") {
				$("#ErrPlan").html("Please select Plan");  
			}else{
				$("#ErrPlan").html("");  
			}
		});
		$("#Validupto").blur(function () {
			IsNonEmpty("Validupto","ErrValidupto","Please Enter Valid upto");
		});
		$("#BankName").change(function() {
			if ($("#BankName").val()=="0") {
				$("#ErrBankName").html("Please select Bank Name");  
			}else{
				$("#ErrBankName").html("");  
			}
		});
		$("#AccountName").blur(function () {
			IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name");
		});
		$("#AccountNumber").blur(function () {
			IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
		});
		$("#IFSCode").blur(function () {
			IsNonEmpty("IFSCode","ErrIFSCode","Please Enter IFS Code");
        });
		$("#AccountType").change(function() {
			if ($("#AccountType").val()=="0") {
				$("#ErrAccountType").html("Please select Account Type");  
			}else{
				$("#ErrAccountType").html("");  
			}
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
</script>
<?php                   
 
  $fInfo = $webservice->getData("Admin","GetFranchiseeCode");
     $FranchiseeCode="";
        if ($fInfo['status']=="success") {
            $FranchiseeCode  =$fInfo['data']['FranchiseeCode'];
        }
        {
?>
    <form method="post" id="frmfrn">
	<input type="hidden" value="" name="txnPassword" id="txnPassword">
     <div class="form-group row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
				<div>
					<h4 class="card-title">Create Franchisee</h4> Franchising your matrimony business is a proven route to rapid growth. Follow simple bellow steps, you will create a Franchisee.
				</div>
			</div>
        </div>
    </div>
    </div>
    
     <div class="form-group row">
     <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
			<div style="max-width:770px !important;">
                <h4 class="card-title">Business Information</h4>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" maxlength="6" id="FranchiseeCode" name="FranchiseeCode" Placeholder="Franchisee Code" value="<?php echo $FranchiseeCode;?>">
                        <span class="errorstring" id="ErrFranchiseeCode"><?php echo isset($ErrFranchiseeCode)? $ErrFranchiseeCode : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Franchisee Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="FranchiseeName" name="FranchiseeName" Placeholder="Franchisee Name" value="">
                        <span class="errorstring" id="ErrFranchiseeName"><?php echo isset($ErrFranchiseeName)? $ErrFranchiseeName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Email Id<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="type" class="form-control" id="FranchiseeEmailID" name="FranchiseeEmailID" Placeholder="Email ID" value="">
                        <span class="errorstring" id="ErrFranchiseeEmailID"><?php echo isset($ErrFranchiseeEmailID)? $ErrFranchiseeEmailID : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="ContactNumberCountryCode" id="ContactNumberCountryCode" style="width: 61px;">
                                    <?php foreach($fInfo['data']['CountryCode'] as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>"<?php echo ($_POST['ContactNumberCountryCode']==$CountryCode['SoftCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?>
                                        </option>
                                        <?php } ?>                       
                                </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" maxlength="10" class="form-control" id="BusinessMobileNumber" name="BusinessMobileNumber" Placeholder="Mobile Number" value="">
                        <span class="errorstring" id="ErrBusinessMobileNumber"><?php echo isset($ErrBusinessMobileNumber)? $ErrBusinessMobileNumber : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Whatsapp Number</label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="ContactWhatsappCountryCode" id="ContactWhatsappCountryCodev" style="width: 61px;">
                                    <?php foreach($fInfo['data']['CountryCode'] as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>"<?php echo ($_POST['ContactWhatsappCountryCode']==$CountryCode['SoftCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?>
                                        </option>
                                        <?php } ?>                       
                                </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" maxlength="10" class="form-control" id="BusinessWhatsappNumber" name="BusinessWhatsappNumber" Placeholder="Whatsapp Number" value="">
                        <span class="errorstring" id="ErrBusinessWhatsappNumber"><?php echo isset($ErrBusinessWhatsappNumber)? $ErrBusinessWhatsappNumber : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Landline Number </label>
					<div class="col-sm-3">                                                      
						<select class="selectpicker form-control" data-live-search="true" name="LandlineCountryCode" id="LandlineCountryCode" style="width: 61px;">
							<?php foreach($fInfo['data']['CountryCode'] as $CountryCode) { ?>
								<option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST['LandlineCountryCode']==$CountryCode['SoftCode']) ? " selected='selected' " : "";?>>
									<?php echo $CountryCode['str'];?>
								</option>
								<?php } ?>                       
						</select>
					</div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="LandlineStdCode" name="LandlineStdCode" Placeholder="STD" value="">
                        <span class="errorstring" id="ErrLandlineStdCode"><?php echo isset($ErrLandlineStdCode)? $ErrLandlineStdCode : "";?></span>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="BusinessLandlineNumber" name="BusinessLandlineNumber" Placeholder="Landline Number" value="">
                        <span class="errorstring" id="ErrBusinessLandlineNumber"><?php echo isset($ErrBusinessLandlineNumber)? $ErrBusinessLandlineNumber : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="BusinessAddress1" name="BusinessAddress1" Placeholder="Address Line 1" value="">
                        <span class="errorstring" id="ErrBusinessAddress1"><?php echo isset($ErrBusinessAddress1)? $ErrBusinessAddress1 : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="BusinessAddress2" name="BusinessAddress2" Placeholder="Address Line 2" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="BusinessAddress3" name="BusinessAddress3" Placeholder="Address Line 3" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">City Name<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="CityName" name="CityName" Placeholder="City Name" value="">
                        <span class="errorstring" id="ErrCityName"><?php echo isset($ErrCityName)? $ErrCityName : "";?></span>
                    </div>
                    <label class="col-sm-2 col-form-label">Landmark<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Landmark" name="Landmark" Placeholder="Landmark" value="">
                        <span class="errorstring" id="ErrLandmark"><?php echo isset($ErrLandmark)? $ErrLandmark : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Country Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <select onchange="Franchisee.getStateNames($(this).val())" class="selectpicker form-control" data-live-search="true" id="CountryName" name="CountryName">
                            <option value="0">--Choose Country Name--</option>
                            <?php foreach($fInfo['data']['CountryName'] as $CountryName) { ?>
                                <option value="<?php echo $CountryName['SoftCode'];?>" <?php echo ($CountryName[ 'SoftCode']==$_POST[ 'CountryName']) ? ' selected="selected" ' : '';?>>
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
                            <option value="0">--Choose State Name--</option>
                        </select>
						<span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                    </div>
                    <label class="col-sm-2 col-form-label">District Name<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <select class="selectpicker form-control" data-live-search="true" id="DistrictName" name="DistrictName">
                            <option value="0">--Choose District Name--</option>
                        </select>
						<span class="errorstring" id="ErrDistrictName"><?php echo isset($ErrDistrictName)? $ErrDistrictName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pin/Zip Code<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" maxlength="10" class="form-control" id="PinCode" name="PinCode" Placeholder="Pin Code" value="">
                        <span class="errorstring" id="ErrPinCode"><?php echo isset($ErrPinCode)? $ErrPinCode : "";?></span>
                    </div>
                    <label class="col-sm-2 col-form-label">Plan<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <select class="selectpicker form-control" data-live-search="true" id="Plan" name="Plan">
                            <option value="0">--Choose Plan--</option>
                            <?php foreach($fInfo['data']['Plans'] as $Plan) { ?>
                                <option value="<?php echo $Plan['PlanID'];?>" <?php echo ($Plan[ 'PlanName']==$_POST[ 'Plan']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $Plan['PlanName'];?>
                                </option>
                                <?php } ?>
                        </select>
						<span class="errorstring" id="ErrPlan"><?php echo isset($ErrPlan)? $ErrPlan : "";?></span>
						<br>
						<a href="javascript:void(0)" onclick="ViewPlan()">View Plan</a>
                    </div>
                </div>
            </div>
        </div>
		</div>
        <br> 
        <div class="card">
            <div class="card-body">
                <div style="max-width:770px !important;">
                <h4 class="card-title">Bank Account Details</h4>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <select class="selectpicker form-control" data-live-search="true" id="BankName" name="BankName">
                            <option value="0">--Choose Bank Name--</option>
                            <?php foreach($fInfo['data']['BankName'] as $BankName) { ?>
                                <option value="<?php echo $BankName['SoftCode'];?>" <?php echo ($BankName[ 'SoftCode']==$_POST[ 'BankName']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $BankName['CodeValue'];?>
                                </option>
                                <?php } ?>
                        </select>
						<span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Account Holder Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="">
                        <span class="errorstring" id="ErrAccountName"><?php echo isset($ErrAccountName)? $ErrAccountName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="">
                        <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="">
                        <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
                    </div>
                    <label class="col-sm-2 col-form-label">Account Type<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <select class="selectpicker form-control" data-live-search="true" id="AccountType" name="AccountType">
                            <option value="0">--Choose Account Type--</option>
                            <?php foreach($fInfo['data']['AccountType'] as $AccountType) { ?>
                                <option value="<?php echo $AccountType['SoftCode'];?>" <?php echo ($AccountType[ 'SoftCode']==$_POST[ 'AccountType']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $AccountType['CodeValue'];?>
                                </option>
                                <?php } ?>
                        </select>
						<span class="errorstring" id="ErrAccountType"><?php echo isset($ErrAccountType)? $ErrAccountType : "";?></span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <br> 
        <div class="card">
                <div class="card-body">
                    <div style="max-width:770px !important;">
                    <h4 class="card-title">Primary Staff Information</h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Person Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="PersonName" name="PersonName" Placeholder="Person Name" value="">
                            <span class="errorstring" id="ErrPersonName"><?php echo isset($ErrPersonName)? $ErrPersonName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Father's Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="FatherName" name="FatherName" Placeholder="Father's Name" value="">
                            <span class="errorstring" id="ErrFatherName"><?php echo isset($ErrFatherName)? $ErrFatherName : "";?> </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of birth<span id="star">*</span></label>
                        <div class="col-sm-4" style="padding-right:0px">
                            <div class="col-sm-4" style="max-width:50px !important;padding:0px !important;">
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
                       <label class="col-sm-2 col-form-label">Gender<span id="star">*</span></label>
                        <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                                <option value="0">--Choose Gender--</option>
                                <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                                    <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($Sex[ 'SoftCode']==$_POST[ 'Sex']) ? ' selected="selected" ' : '';?>>
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
                            <input type="text" class="form-control" id="EmailID" name="EmailID" Placeholder="Email ID" value="">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                        <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="MobileNumberCountryCode" id="MobileNumberCountryCode" style="width: 61px;">
                                    <?php foreach($fInfo['data']['CountryCode'] as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>"<?php echo ($_POST['MobileNumberCountryCode']==$CountryCode['SoftCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?>
                                        </option>
                                        <?php } ?>                       
                                </select>
                    </div>
                        <div class="col-sm-6">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" Placeholder="Mobile Number" value="">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                        <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" name="WhatsappNumberCountryCode" id="WhatsappNumberCountryCode" style="width: 61px;">
                                    <?php foreach($fInfo['data']['CountryCode'] as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>"<?php echo ($_POST['WhatsappNumberCountryCode']==$CountryCode['SoftCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?>
                                        </option>
                                        <?php } ?>                       
                                </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" Placeholder="Whatsapp Number" value="">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address1" name="Address1" Placeholder="Address Line 1" value="">
                            <span class="errorstring" id="ErrAddress1"><?php echo isset($ErrAddress1)? $ErrAddress1 : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address2" name="Address2" Placeholder="Address Line 2" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address3" name="Address3" Placeholder="Address Line 3" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ID Proof<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <select class="selectpicker form-control" data-live-search="true" id="IDProof" name="IDProof">
                                <option value="0">--Choose ID Proof--</option>
                                <?php foreach($fInfo['data']['IDProof'] as $IDProof) { ?>
                                    <option value="<?php echo $IDProof['SoftCode'];?>" <?php echo ($IDProof[ 'SoftCode']==$_POST[ 'IDProof']) ? ' selected="selected" ' : '';?>>
                                        <?php echo $IDProof['CodeValue'];?>
                                    </option>
                                    <?php } ?>
                            </select>
							<span class="errorstring" id="ErrIDProof"><?php echo isset($ErrIDProof)? $ErrIDProof : "";?></span>
                        </div>
						<label class="col-sm-2 col-form-label">ID Number<span id="star">*</span></label>
						<div class="col-sm-3">
                            <input type="text" class="form-control" id="IDProofNumber" name="IDProofNumber" Placeholder="ID Proof No" value="">
                            <span class="errorstring" id="ErrIDProofNumber"><?php echo isset($ErrIDProofNumber)? $ErrIDProofNumber : "";?> </span>
                        </div>
                    </div>
					<div class="form-group row">
                        <label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" minlength="6" class="form-control" id="UserName" name="UserName" Placeholder="Login Name" value="">
                            <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?> </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                        <div class="col-sm-4">
                           <div class="input-group">
                                <input type="password" class="form-control pwd"  maxlength="8" id="Password" name="Password" Placeholder="Password" value="">
                                <span class="input-group-btn">
                                <button  onclick="showHidePwd('Password',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
                                </span>          
                           </div>
                           <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?> </span>
                        </div>
						<div class="col-sm-5" style="padding-top: 5px;">
							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" id="PasswordFstLogin" name="PasswordFstLogin">
								<label class="custom-control-label" for="PasswordFstLogin" style="margin-top: 7px;">&nbsp;Change password on first login</label>
							</div>
						</div>
                    </div>
                    <div class="col-sm-12" style="text-align:center;color:red">
                        <?php echo $errormessage;?>
                    </div>
                    </div>
                </div>
            </div>
        <br> 
        <div class="col-12 grid-margin" style="padding-right:0px;">
            <div style="max-width:770px !important;text-align:right;">
                &nbsp;<a href="javascript:void(0)" onclick="Franchisee.ConfirmGotoBackFromCreateFranchisee()" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                <a href="javascript:void(0)" onclick="Franchisee.ConfirmCreateFranchisee()" class="btn btn-primary" name="BtnSaveCreate">Create Franchisee</a>
            </div>
        </div>
    
  
    </div>
    <div class="col-sm-3">
                       
                               
                    </div>
    </div>
    
 </form>   
<?php }?>
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 340px;min-height: 340px;" >
            
                </div>
            </div>
        </div>
<script>
                                              

   
function ViewPlan() {
	$('#Publish_body').html(preloading_withText("Loading ...","95"));
        $('#PubplishNow').modal('show');
        $.ajax({
            url: API_URL + "m=Admin&a=ViewPlanForCreateFranchisee", 
            success: function(result){
               $('#Publish_body').html(result); 
            }});
}

//$(window).unload(function(){
  //alert("Goodbye!");
//});
</script>
    