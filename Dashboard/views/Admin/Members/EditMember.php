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
            $("#MemberCode").blur(function() {

                IsNonEmpty("MemberCode", "ErrMemberCode", "Please Enter Member Code");

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
            $("#FranchiseeCode").blur(function() {

                IsNonEmpty("FranchiseeCode", "ErrFranchiseeCode", "Please Enter Franchisee Code");

            });
        });

        function myFunction() {
            var x = document.getElementById("MemberPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function SubmitNewMember() {
            $('#ErrMemberCode').html("");
            $('#ErrMemberName').html("");
            $('#ErrMobileNumber').html("");
            $('#ErrEmailID').html("");
            $('#ErrMemberPassword').html("");
            $('#ErrFranchiseeCode').html("");

            ErrorCount = 0;

            if (IsNonEmpty("MemberCode", "ErrMemberCode", "Please Enter Member Code")) {
                IsAlphaNumeric("MemberCode", "ErrMemberCode", "Please Enter AlphaNumeric characters only");
            }
            if (IsNonEmpty("MemberName", "ErrMemberName", "Please Enter Member Name")) {
                IsAlphabet("MemberName", "ErrMemberName", "Please Enter Alphabets characters only");
            }

            if (IsNonEmpty("MobileNumber", "ErrMobileNumber", "Please Enter Mobile Number")) {
                IsMobileNumber("MobileNumber", "ErrMobileNumber", "Please Enter Valid Mobile Number");
            }

            if (IsNonEmpty("EmailID", "ErrEmailID", "Please Enter Email ID")) {
                IsEmail("EmailID", "ErrEmailID", "Please Enter Valid Email ID");
            }

            if (IsNonEmpty("MemberPassword", "ErrMemberPassword", "Please Enter Member Password")) {
                IsLogin("MemberPassword", "ErrMemberPassword", "Please Enter Valid Member Password");
            }
            if (IsNonEmpty("FranchiseeCode", "ErrFranchiseeCode", "Please Enter Franchisee Code")) {
                IsAlphaNumeric("FranchiseeCode", "ErrFranchiseeCode", "Please Enter AlphaNumeric characters only");
            }

            if (ErrorCount == 0) {
                return true;
            } else {
                return false;
            }

        }
    </script>
    <form method="post" action="" onsubmit="return SubmitNewMember();">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Members</h4>
                    <h4 class="card-title">Edit Member Information</h4>
                    <form class="forms-sample">
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Member Code</small> </div>
                            <div class="col-sm-3">
                                <input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member['MemberCode']);?>" placeholder="Member Code">
                                <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Member Name<span id="star">*</span></small> </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
                                <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span></div>'
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Mobile Number<span id="star">*</span></small></div>
                            <div class="col-sm-2">
                                <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
                                    <?php foreach($CountryCodes as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $CountryCode['str'];?>
                                        </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                            <div class="col-sm-1">
                                <?php if($Member['IsMobileVerified']=1){ ?> <img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg" style="width:60%">
                                    <?php } ?>
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2"><small>Email ID<span id="star">*</span></small></div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
                                <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                            <div class="col-sm-1">
                                <?php if($Member['IsEmailVerified']=1){ ?> <img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg" style="width:60%">
                                    <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Login Name<span id="star">*</span></small></div>
                            <div class="col-sm-3">
                                <input type="text" disabled="disabled" class="form-control" maxlength="10" id="MemberLogin" name="MemberLogin" value="<?php echo (isset($_POST['MemberLogin']) ? $_POST['MemberLogin'] : $Member['MemberLogin']);?>" placeholder="MemberLogin">
                                <span class="errorstring" id="ErrMemberLogin"><?php echo isset($ErrMemberLogin)? $ErrMemberLogin : "";?></span></div>
                            <div class="col-sm-2"><small>Login Password<span id="star">*</span></small></div>
                            <div class="col-sm-3">
                                <input type="password" class="form-control" id="MemberPassword" name="MemberPassword" value="<?php echo (isset($_POST['MemberPassword']) ? $_POST['MemberPassword'] : $Member['MemberPassword']);?>" placeholder="Member Password">
                                <span class="errorstring" id="ErrMemberPassword"><?php echo isset($ErrMemberPassword)? $ErrMemberPassword : "";?></span></div>
                            <div class="col-sm-2">
                                <input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Created On</small></div>
                            <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDate($Member['CreatedOn']);?></small></div>
                            <div class="col-sm-2"><small>Status<span id="star">*</span></small></div>
                            <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;">
                                    <option value="1" <?php echo ($Member[ 'IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Member[ 'IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Franchisee Name</small></div>
                            <div class="col-sm-3"><span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)</small></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                            </div>
                        </div>
                        <button type="submit" name="Btnupdate" class="btn btn-primary mr-2" style="font-family:roboto">Update Information</button>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profiles</h4>
                    <form class="forms-sample">
                        <div class="form-group row">
                            <div class="col-sm-2"><small>Draft</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
                            <div class="col-sm-2"><small>Posted</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
                            <div class="col-sm-2"><small>Published</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
                            <div class="col-sm-2"><small>Unpublished</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
                            <div class="col-sm-2"><small>Expired</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
                            <div class="col-sm-2"><small>Rejected</small>
                                <br><small style="color:#737373;"><?php echo  "0";?></small></div>
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