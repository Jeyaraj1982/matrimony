<?php
$page="MyMemberInfo";
    if (isset($_POST['Btnupdate'])) {
         $response =$webservice->getData("Member","EditMemberInfo",$_POST);
        if ($response['status']=="success") {   ?>
           <script>location.href='<?php echo AppUrl;?>MySettings/MemberInfoUpdated';</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Member","GetMemberInfo");
    $Member=$response['data'];
    $CountryCodes=$Member['Country'];
?>
    <script>
        $(document).ready(function() {
            $("#MobileNumber").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
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
        });

        function SubmitNewMember() {
            $('#ErrMemberName').html("");
        
            ErrorCount = 0;
            if (IsNonEmpty("MemberName", "ErrMemberName", "Please Enter Member Name")) {
                IsAlphabet("MemberName", "ErrMemberName", "Please Enter Alpha Numeric characters only");
            }
           
            return (ErrorCount == 0) ? true : false;
        }
    </script>
    <?php include_once("settings_header.php");?>
        <form method="post" action="" onsubmit="return SubmitNewMember();">
                 <?php
         $disbaled = ( $Member['IsActive']==0 || $Member['IsDeleted']==1 ) ? true : false;
         $stars = (!($disbaled)) ? '<span id="star">*</span>' : ""; 
     ?>
            <div class="col-sm-9" style="margin-top: -8px;">
                <h4 class="card-title">Edit Member Information</h4>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Member ID</small> </div>
                    <div class="col-sm-3">
                        <input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" style="width:84%" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member['MemberCode']);?>" placeholder="Member Code">
                        <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span>
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
                    <div class="col-sm-3"><small>Mobile Number<?php echo $stars; ?></small></div>
                    <div class="col-sm-3">
                    <?php if($Member['IsMobileVerified']==1){ ?>
                        <select class="form-control" disabled="disabled">
                            <?php foreach($CountryCodes as $CountryCode) { ?>
                                <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>><?php echo $CountryCode['str'];?></option>
                            <?php } ?>
                        </select>
                    <?php } else{ ?>
                        <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width:84%">
                           <?php foreach($CountryCodes as $CountryCode) { ?>
                                <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>><?php echo $CountryCode['str'];?></option>
                           <?php } ?>
                        </select>
                    <?php } ?>
                    </div>
                    <div class="col-sm-6">
                     <?php if($Member['IsMobileVerified']==1){ ?>
                        <div class="input-group">
                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $Member['MobileNumber'];?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button" style="background: #eeeeee;"><?php if($Member['IsMobileVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                            </span>          
                        </div>
                        <div style="float:right;font-size:12px;Padding-top:5px">
                            <a href="javascript:void(0)" onclick="ConfirmChangeMobileNumber()">Change</a>
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
                    <div class="col-sm-3"><small>Email ID<?php echo $stars; ?></small></div>
                    <div class="col-sm-9">
                   <?php if($Member['IsEmailVerified']==1){ ?>
                        <div class="input-group">
                            <input type="text" disabled="disabled" class="form-control"  value="<?php echo $Member['EmailID'];?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button" style="background: #eeeeee;"><?php if($Member['IsEmailVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?></button>
                            </span>          
                        </div>
                        <div style="float:right;font-size:12px;Padding-top:5px">
                            <a href="javascript:void(0)" onclick="ConfirmChangeEmailID()">Change</a>     
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
                    <div class="col-sm-12" style="text-align:center;color:red">
                        <?php echo $successmessage;?>
                            <?php echo $errormessage;?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <button type="submit" name="Btnupdate" class="btn btn-primary mr-2" style="font-family: roboto;">Update Information</button>
                    </div>
                    <div class="col-sm-3" style="margin-left: -60px;margin-top: 6px;"><a href="MyMemberInfo" style="color: #424141">Cancel</a></div>
                </div>
            </div>

        </form>
        <?php include_once("settings_footer.php");?>  
        
        <div class="modal" id="ChangeMobile" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="ChangeMobile_body"  style="max-height: 529px;min-height: 529px;" >
                    
                </div>
            </div>
    </div>
    
<div style="display: none;">
    <div id="primary_content">
    <form method="post" id="FrmChnMob" >  
                     <div class="modal-header">
                            <h4 class="modal-title">Confirmation for change mobile number</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body" style="max-height:400px;min-height:400px;">
                            <p style="text-align:center;"><img src="<?php echo AppUrl;?>assets/images/email_verification.png"></p>
                            <p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;"><b>Caution!</b> You are going to change your primary Mobile Number. All further communication from us ill be delivered on this new Number.</p>
                            <div class="form-group row" style="margin-bottom:0px">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-10" style="color:#ada9a9;font-size: 14px;">Mobile Number</label>
                            </div> 
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4">
                                  <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" >
                                       <?php foreach($CountryCodes as $CountryCode) { ?>
                                            <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'NewCountryCode'])) ? (($_POST[ 'NewCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>><?php echo $CountryCode['str'];?></option>
                                       <?php } ?>
                                  </select>
                                </div>
                                <div class="col-sm-4"><input type="text" class="form-control" id="NewMobileNumber" name="MobileNumber" maxlength="10"></div>
                                <div class="col-sm-12" id="NewMobileNumber_error" style="color:red;text-align:center"></div>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" name="Create" onclick="ChangeMemberMobileNumber()" style="font-family:roboto">Continue</button>
                        </div>
                     </form>
    </div>

</div>