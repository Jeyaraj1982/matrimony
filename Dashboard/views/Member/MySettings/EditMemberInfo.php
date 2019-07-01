<?php
$page="MyMemberInfo";
    if (isset($_POST['Btnupdate'])) {
        $response = $webservice->EditMemberInfo($_POST);
        if ($response['status']=="success") {   ?>
           <script>location.href='<?php echo AppUrl;?>MySettings/MemberInfoUpdated';</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->GetMemberInfo();
    $Member=$response['data'];
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
            $('#ErrMobileNumber').html("");
            $('#ErrEmailID').html("");

            ErrorCount = 0;
            if (IsNonEmpty("MemberName", "ErrMemberName", "Please Enter Member Name")) {
                IsAlphabet("MemberName", "ErrMemberName", "Please Enter Alpha Numeric characters only");
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
        <form method="post" action="" onsubmit="return SubmitNewMember();">

            <div class="col-sm-9" style="margin-top: -8px;">
                <h4 class="card-title">Edit Member Information</h4>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Member Code</small> </div>
                    <div class="col-sm-3">
                        <input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member['MemberCode']);?>" placeholder="Member Code">
                        <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Member Name<span id="star">*</span></small> </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
                        <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Mobile Number<span id="star">*</span></small></div>
                    <div class="col-sm-9">
                        <?php if($Member['IsMobileVerified']==0){ ?>
                            <div class="col-sm-6" style="margin-left: -15px;width: 31%;">
                                <input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                            <div class="col-sm-6" style="padding-top: 7px;padding-left: 0px;"><a href="javascript:void(0)" onclick="MobileNumberVerification()">Verfiy now</a></div>
                            <?php } else{ ?>
                                <div class="col-sm-6" style="margin-left: -15px;width: 31%;">
                                <input type="text" class="form-control" disabled="disabled" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number"></div>
                                <div class="col-sm-6" style="color:#5dce37"><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="7%">&nbsp;Verified</div>
                            <?php }?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Email ID<span id="star">*</span></small></div>
                    <div class="col-sm-9">
                        <?php if($Member['IsEmailVerified']==0){ ?>
                        <div class="col-sm-8" style="margin-left: -15px;">
                            <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                            <div class="col-sm-4" style="padding-top: 7px;padding-left: 0px;"><a href="javascript:void(0)" onclick="MobileNumberVerification()">Verfiy now</a> </div>
                            <?php } else{ ?>
                            <div class="col-sm-8" style="margin-left: -15px;">
                                <input type="text" disabled="disabled" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID"> </div>
                                <div class="col-sm-3" style="color:#5dce37"><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="15%">&nbsp;Verified</div>
                        <?php }?>
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
                    <div class="col-sm-3" style="margin-left: -53px;margin-top: 6px;"><a href="../MyMemberInfo" style="color: #424141">cancel</a></div>
                </div>
            </div>

        </form>
        <?php include_once("settings_footer.php");?>  