<?php
    $page="CommunicationDetails";
  
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
                         $('#ErrDistrict').html("");
                         $('#ErrPincode').html("");
                         
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
                         if (IsNonEmpty("WhatsappNumber","ErrWhatsappNumber","Please enter your Whatsapp Number")) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                         }
                         IsNonEmpty("AddressLine1","ErrAddressLine1","Please enter your Address Line1");
                         IsNonEmpty("City","ErrCity","Please enter your City");
                         IsNonEmpty("Pincode","ErrPincode","Please enter your Pincode");
                         
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
                         if($("#District").val()=="0"){
                            document.getElementById("ErrDistrict").innerHTML="Please select your District"; 
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
<form method="post" action="" id="frmCD">
            <input type="hidden" value="" name="txnPassword" id="txnPassword">
            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ProfileCode" id="ProfileCode">
        <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label for="Email ID" class="col-sm-2 col-form-label">Contact person<span id="star">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ContactPersonName" maxlength="50" name="ContactPersonName" placeholder="Contact Person Name" value="<?php echo (isset($_POST['ContactPersonName']) ? $_POST['ContactPersonName'] : $ProfileInfo['ContactPersonName']);?>" placeholder="Contact Person Name">
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
                <input type="text" class="form-control" id="EmailID" name="EmailID" maxlength="50" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $ProfileInfo['EmailID']);?>" placeholder="Email ID">
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
            
            <label for="WhatsappNumber" class="col-sm-1 col-form-label" style="margin-left:63px;padding-left:0px;padding-right:0px" >Whatsapp</label>
            <div class="col-sm-4">
            <div class="col-sm-5"  style="padding-right:0px">
                <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                     <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?>
                </select>
            </div>  
            <div class="col-sm-7"  style="padding-left:5px;padding-right:0px">
                <input type="text" class="form-control" id="WhatsappNumber" maxlength="10" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $ProfileInfo['WhatsappNumber']);?>" placeholder="Whatsapp Number">
                <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
            </div>    
            <div class="col-sm-12">
                <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>   
            </div> 
            </div> 
        </div>
        <div class="form-group row">
            <label for="AddressLine1" class="col-sm-2 col-form-label">Address<span id="star">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" maxlength="50" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $ProfileInfo['AddressLine1']);?>" placeholder="AddressLine1">
                <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine2" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" maxlength="50" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $ProfileInfo['AddressLine2']);?>" placeholder="AddressLine2">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" maxlength="50" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $ProfileInfo['AddressLine3']);?>" placeholder="AddressLine3">
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 col-form-label">City name<span id="star">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="City" name="City" maxlength="50" Placeholder="City Name" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : $ProfileInfo['City']);?>">
                <span class="errorstring" id="ErrCity"><?php echo isset($ErrCity)? $ErrCity : "";?></span>
            </div>
            <label for="OtherLocation" class="col-sm-2 col-form-label">Landmark</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="OtherLocation" maxlength="50" name="OtherLocation" Placeholder="Landmark" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : $ProfileInfo['OtherLocation']);?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Pincode" class="col-sm-2 col-form-label">Pin/Zip code<span id="star">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Pincode" name="Pincode" maxlength="10" value="<?php echo (isset($_POST['Pincode']) ? $_POST['Pincode'] : $ProfileInfo['Pincode']);?>" placeholder="Pincode">
                <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
            </div>
            <label for="Country" class="col-sm-2 col-form-label">District<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="District" name="District">
                    <option value="0">Choose District</option>
                    <?php foreach($response['data']['DistrictName'] as $District) { ?>
                        <option value="<?php echo $District['SoftCode'];?>" <?php echo (isset($_POST[ 'District'])) ? (($_POST[ 'District']==$District[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'District']==$District['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $District['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrDistrict"><?php echo isset($ErrDistrict)? $ErrDistrict : "";?></span>
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
            <a href="javascript:void(0)" onclick="ConfirmUpdateCDnfo()" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</a>
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
<div class="modal" id="PubplishNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="Publish_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>
<script>
    function ConfirmUpdateCDnfo() {
    if(submitprofile()) {
      $('#PubplishNow').modal('show'); 
      var content = ''
                    +''
                    +'<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit communication details</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit communication details</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="GetTxnPswd()" style="font-family:roboto">Update</button>'
                    + '</div>';
            $('#Publish_body').html(content);
    } else {
         return false;
    }
}
function GetTxnPswd() {
             var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit communication details</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                        + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                      + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="EditDraftCommunicationDetails()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);              
}
function EditDraftCommunicationDetails() {
     if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmCD").serialize();
    $('#Publish_body').html(preloading_withText("Updating communication details ...","95"));
        $.post(API_URL + "m=Franchisee&a=EditDraftCommunicationDetails",param,function(result) {
            
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Updated</h3>'             
                                    + '<h4 style="text-align:center;">Communication Details</h4>'             
                                    + '<p style="text-align:center;"><a href="../ProfilePhoto/'+data.Code+'.htm" style="cursor:pointer;color:#489bae">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit communication details</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
}
</script>
<?php include_once("settings_footer.php");?>      
             