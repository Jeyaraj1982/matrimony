<?php
    $page="CommunicationDetails";
    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Franchisee","EditDraftCommunicationDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
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
                         $('#ErrContactPersonName').html("");
                         $('#ErrRelation').html("");
                         $('#ErrPrimaryPriority').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
                         $('#ErrAddressLine1').html("");
                         $('#ErrCity').html("");
                         $('#ErrStateName').html("");
                         $('#ErrCountry').html("");
                         
                         ErrorCount=0;
                         
                         if (IsNonEmpty("ContactPersonName","ErrContactPersonName","Please enter your contact person name")) {
                            IsAlphaNumeric("ContactPersonName","ErrContactPersonName","Please enter alphabet charchters only"); 
                         }
                         if (IsNonEmpty("EmailID","ErrEmailID","Please enter your Email ID")) {
                            IsEmail("EmailID","ErrEmailID","Please enter valid EmailID"); 
                         }
                         if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your Mobile Number")) {
                            IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number"); 
                         }
                         if ($('#WhatsappNumber').val().trim().length>0) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                         }
                         IsNonEmpty("AddressLine1","ErrAddressLine1","Please enter your Address Line1");
                         IsNonEmpty("City","ErrCity","Please enter your City");
                         
                         if($("#Relation").val()=="0"){
                            document.getElementById("ErrRelation").innerHTML="Please select your Relation"; 
                             ErrorCount++;
                         }
                         if($("#PrimaryPriority").val()=="0"){
                            document.getElementById("ErrPrimaryPriority").innerHTML="Please select Primary Priority"; 
                             ErrorCount++;
                         }
                         
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
$(document).ready(function() {
    var text_max = 250;
    var text_length = $('#CommunicationDescription').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#CommunicationDescription').keyup(function() {
        var text_length = $('#CommunicationDescription').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script>  
<div class="col-sm-10 rightwidget">
<form method="post" onsubmit="return submitprofile();">
        <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label for="Email ID" class="col-sm-2 col-form-label">Contact person<span id="star">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ContactPersonName" name="ContactPersonName" placeholder="Contact Person Name" value="<?php echo (isset($_POST['ContactPersonName']) ? $_POST['ContactPersonName'] : $ProfileInfo['ContactPersonName']);?>" placeholder="Contact Person Name">
                <span class="errorstring" id="ErrContactPersonName"><?php echo isset($ErrContactPersonName)? $ErrContactPersonName : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Relation" class="col-sm-2 col-form-label">Relation<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="Relation" name="Relation">
                    <option value="0">Choose Relation</option>
                    <?php foreach($response['data']['ProfileSignInFor'] as $Relation) { ?>
                        <option value="<?php echo $Relation['CodeValue'];?>" <?php echo (isset($_POST[ 'Relation'])) ? (($_POST[ 'Relation']==$Relation[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Relation']==$Relation[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $Relation['CodeValue'];?></option>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrRelation"><?php echo isset($ErrRelation)? $ErrRelation : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Relation" class="col-sm-2 col-form-label">Primary priority<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="PrimaryPriority" name="PrimaryPriority">
                    <option value="0">Choose Primary Priority</option>
                    <?php foreach($response['data']['PrimaryPriority'] as $PrimaryPriority) { ?>
                        <option value="<?php echo $PrimaryPriority['CodeValue'];?>" <?php echo (isset($_POST[ 'PrimaryPriority'])) ? (($_POST[ 'PrimaryPriority']==$PrimaryPriority[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'PrimaryPriority']==$PrimaryPriority[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $PrimaryPriority['CodeValue'];?></option>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrPrimaryPriority"><?php echo isset($ErrPrimaryPriority)? $ErrPrimaryPriority : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Email ID" class="col-sm-2 col-form-label">Email id<span id="star">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $ProfileInfo['EmailID']);?>" placeholder="Email ID">
                <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Mobile Number" class="col-sm-2 col-form-label">Mobile number<span id="star">*</span></label>
            
            <div class="col-sm-2" style="padding-right:0px">
                <select class="selectpicker form-control" data-live-search="true" name="MobileNumberCountryCode" id="MobileNumberCountryCode">
                   <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'MobileNumberCountryCode'])) ? (($_POST[ 'MobileNumberCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MobileNumberCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?>
                </select>
            </div>                                                                                     
            <div class="col-sm-2" style="padding-left:5px;padding-right:10px">
                <input type="text" class="form-control" id="MobileNumber" maxlength="10" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $ProfileInfo['MobileNumber']);?>" placeholder="Mobile Number" >
                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
            </div>
            
            <label for="WhatsappNumber" class="col-sm-1 col-form-label" style="margin-left:48px;padding-left:0px;padding-right:0px" >Whatsapp</label>
            <div class="col-sm-2"  style="padding-right:0px">
                <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                     <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?>
                </select>
            </div>  
            <div class="col-sm-2"  style="padding-left:5px;padding-right:0px">
                <input type="text" class="form-control" id="WhatsappNumber" maxlength="10" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $ProfileInfo['WhatsappNumber']);?>" placeholder="Whatsapp Number">
                <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
            </div>     
        </div>
        <div class="form-group row">
            <label for="AddressLine1" class="col-sm-2 col-form-label">Address<span id="star">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $ProfileInfo['AddressLine1']);?>" placeholder="AddressLine1">
                <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine2" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $ProfileInfo['AddressLine2']);?>" placeholder="AddressLine2">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $ProfileInfo['AddressLine3']);?>" placeholder="AddressLine3">
            </div>
        </div>
        <div class="form-group row">
            <label for="Pincode" class="col-sm-2 col-form-label">Pin/Zip code<span id="star">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Pincode" name="Pincode" maxlength="10" value="<?php echo (isset($_POST['Pincode']) ? $_POST['Pincode'] : $ProfileInfo['Pincode']);?>" placeholder="Pincode">
                <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 col-form-label">City name<span id="star">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="City" name="City" Placeholder="City Name" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : $ProfileInfo['City']);?>">
                <span class="errorstring" id="ErrCity"><?php echo isset($ErrCity)? $ErrCity : "";?></span>
            </div>
            <label for="OtherLocation" class="col-sm-2 col-form-label">Landmark</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="OtherLocation" name="OtherLocation" Placeholder="Landmark" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : $ProfileInfo['OtherLocation']);?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Country" class="col-sm-2 col-form-label">Country<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="Country" name="Country">
                    <option value="0">Choose Country</option>
                    <?php foreach($response['data']['CountryName'] as $Country) { ?>
                        <option value="<?php echo $Country['SoftCode'];?>" <?php echo (isset($_POST[ 'Country'])) ? (($_POST[ 'Country']==$Country[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Country']==$Country['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $Country['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrCountry"><?php echo isset($ErrCountry)? $ErrCountry : "";?></span>
            </div>
            <label for="State" class="col-sm-2 col-form-label">State name<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="StateName" name="StateName">
                    <option value="0">Choose State</option>
                    <?php foreach($response['data']['StateName'] as $StateName) { ?>
                        <option value="<?php echo $StateName['SoftCode'];?>" <?php echo (isset($_POST[ 'StateName'])) ? (($_POST[ 'StateName']==$StateName[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'State']==$StateName['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $StateName['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom:0px">
            <label for="CommunicationDescription" class="col-sm-12 col-form-label">Additional information</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">                                                        
                <textarea class="form-control" maxlength="250" name="CommunicationDescription" id="CommunicationDescription" style="margin-bottom:5px;"><?php echo (isset($_POST['CommunicationDescription']) ? $_POST['CommunicationDescription'] : $ProfileInfo['CommunicationDescription']);?></textarea>
                <label class="col-form-label" style="padding-top:0px;">Max 250 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></label>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-12"><span id="server_message_error"><?php echo $errormessage ;?></span><span id="server_message_success"><?php echo $successmessage;?></span></div>
        </div>
       <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
        <div class="col-sm-6" style="text-align:right">
             <ul class="pager" style="float:right;">
                  <li><a href="../DocumentAttachment/<?php echo $_GET['Code'].".htm";?>">&#8249; Previous</a></li>
                    <li>&nbsp;</li>
                  <li><a href="../ProfilePhoto/<?php echo $_GET['Code'].".htm";?>">Next &#8250;</a></li>
            </ul>
        </div>
    </div>
    
    
</form>
</div>
<?php include_once("settings_footer.php");?>      
             