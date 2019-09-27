<?php
    $page="CommunicationDetails";
    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Member","EditDraftCommunicationDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Member","GetPublishedProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $CountryCodes =$response['data']['ContactCountrycode'];
   ?>
<?php include_once("settings_header.php");?>
<script>
$(document).ready(function () {
     $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn("fast");
               return false;
    }
   });
   $("#WhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWhatsappNumber").html("Digits Only").fadeIn("fast");
               return false;
    }
   });
   $("#Pincode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrPincode").html("Digits Only").fadeIn("fast");                   
               return false;
    }
   });
   });
  
function submitprofile() {
                         $('#ErrEmailID').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrAddressLine1').html("");
                         $('#ErrCity').html("");
                         $('#ErrStateName').html("");
                         $('#ErrCountry').html("");
                         
                         ErrorCount=0;
                         
                         if (IsNonEmpty("EmailID","ErrEmailID","Please enter your Email ID")) {
                            IsEmail("EmailID","ErrEmailID","Please enter valid EmailID"); 
                         }
                         if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your Mobile Number")) {
                            IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number"); 
                         }
                         IsNonEmpty("AddressLine1","ErrAddressLine1","Please enter your Address Line1");
                         IsNonEmpty("City","ErrCity","Please enter your City");
                         
                         if($("#StateName").val()=="0"){
                            document.getElementById("ErrStateName").innerHTML="Please select your State Name"; 
                             ErrorCount++;
                         }
                         if($("#Country").val()=="0"){
                            document.getElementById("ErrCountry").innerHTML="Please select your Country"; 
                             ErrorCount++;
                         }
                        
                              
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                        
    
    
}
</script>   
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="return submitprofile();">
        <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label for="Email ID" class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $ProfileInfo['EmailID']);?>" placeholder="Email ID">
                <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Mobile Number" class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
             <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                <select class="selectpicker form-control" data-live-search="true" name="MobileNumberCountryCode" id="MobileNumberCountryCode" style="width: 61px;">
                   <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'MobileNumberCountryCode'])) ? (($_POST[ 'MobileNumberCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MobileNumberCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?>
                </select>
            </div>                                                                                     
            <div class="col-sm-3">
                <input type="text" class="form-control" id="MobileNumber" maxlength="10" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $ProfileInfo['MobileNumber']);?>" placeholder="Mobile Number">
                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
            </div>
           <label for="WhatsappNumber" class="col-sm-2 col-form-label" style="margin-right: -24px;" >Whatsapp</label>
            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                     <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?>
                </select>
            </div>  
            <div class="col-sm-2">
                <input type="text" class="form-control" id="WhatsappNumber" maxlength="10" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $ProfileInfo['WhatsappNumber']);?>" placeholder="Whatsapp Number">
                <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine1" class="col-sm-2 col-form-label">Address<span id="star">*</span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $ProfileInfo['AddressLine1']);?>" placeholder="AddressLine1">
                <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine2" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $ProfileInfo['AddressLine2']);?>" placeholder="AddressLine2">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $ProfileInfo['AddressLine3']);?>" placeholder="AddressLine3">
            </div>
        </div>
        <div class="form-group row">
            <label for="Pincode" class="col-sm-2 col-form-label">Pincode</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Pincode" name="Pincode" maxlength="10" value="<?php echo (isset($_POST['Pincode']) ? $_POST['Pincode'] : $ProfileInfo['Pincode']);?>" placeholder="Pincode">
                <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 col-form-label">City<span id="star">*</span></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="City" name="City" Placeholder="City" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : $ProfileInfo['City']);?>">
                <span class="errorstring" id="ErrCity"><?php echo isset($ErrCity)? $ErrCity : "";?></span>
            </div>
            <label for="OtherLocation" class="col-sm-3 col-form-label">Landmark</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="OtherLocation" name="OtherLocation" Placeholder="Other Location" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : $ProfileInfo['OtherLocation']);?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="State" class="col-sm-2 col-form-label">State<span id="star">*</span></label>
            <div class="col-sm-3">
                <select class="selectpicker form-control" data-live-search="true" id="StateName" name="StateName">
                    <option value="0">Choose State</option>
                    <?php foreach($response['data']['StateName'] as $StateName) { ?>
                        <option value="<?php echo $StateName['SoftCode'];?>" <?php echo (isset($_POST[ 'StateName'])) ? (($_POST[ 'StateName']==$StateName[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'State']==$StateName['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $StateName['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
            </div>
            <label for="Country" class="col-sm-3 col-form-label">Country<span id="star">*</span></label>
            <div class="col-sm-3">
                <select class="selectpicker form-control" data-live-search="true" id="Country" name="Country">
                    <option value="0">Choose Country</option>
                    <?php foreach($response['data']['CountryName'] as $Country) { ?>
                        <option value="<?php echo $Country['SoftCode'];?>" <?php echo (isset($_POST[ 'Country'])) ? (($_POST[ 'Country']==$Country[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Country']==$Country['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $Country['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrCountry"><?php echo isset($ErrCountry)? $ErrCountry : "";?></span>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12"><?php echo $errormessage ;?><?php echo $successmessage;?></div>
                        </div>
       <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
        <div class="col-sm-3"><a href="../ProfilePhoto/<?php echo $_GET['Code'].".htm";?>">Next</a></div>
    </div>
</form>
</div>
<?php include_once("settings_footer.php");?>      
             