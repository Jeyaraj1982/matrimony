<?php
    if (isset($_POST['BtnMember'])) {
        
              
        $ErrorCount =0;
        $duplicate = $mysql->select("select * from  _tbl_members where MemberCode='".trim($_POST['MemberCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMemberCode="Member Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_members where EmailId='".trim($_POST['EmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_members where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        if (strlen(trim($_POST['WhatsappNumber']))>0) {
        $duplicate = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWhatsappNumber="Whatsapp Number Already Exists";    
             $ErrorCount++;
        } 
        }
        
        $duplicate = $mysql->select("select * from  _tbl_members where AadhaarNumber='".trim($_POST['AadhaarNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrAadhaarNumber="Aadhaar Number Already Exists";    
             $ErrorCount++;
        }
        
         $duplicate = $mysql->select("select * from  _tbl_members where MemberLogin='".trim($_POST['LoginName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLoginName="Login Name Already Exists";    
             $ErrorCount++;
        }
                                                        
           if ($ErrorCount==0) {
           $MemberID = $mysql->insert("_tbl_members",array("MemberCode"              => $_POST['MemberCode'],
                                                           "MemberName"               => $_POST['MemberName'],  
                                                           "DateofBirth"              => $_POST['DateofBirth'],
                                                           "Sex"                      => $_POST['Sex'],
                                                           "MobileNumber"             => $_POST['MobileNumber'],
                                                           "WhatsappNumber"           => $_POST['WhatsappNumber'],
                                                           "EmailID"                  => $_POST['EmailID'],
                                                           "AadhaarNumber"            => $_POST['AadhaarNumber'],
                                                           "MemberLogin"              => $_POST['LoginName'],
                                                           "CreatedOn"                => date("Y-m-d H:i:s"),
                                                           "ReferedBy"                => $_Franchisee['FranchiseeID'],
                                                           "MemberPassword"           => $_POST['LoginPassword']));
                                                                                           
          /*$mail2 = new MailController();
            $mail2->NewMember(array("mailTo"         => $_POST['EmailID'] ,
                                    "FranchiseeName" => $_POST['MemberName'],
                                    "LoginName"      => $_POST['LoginName'],
                                    "LoginPassword"  => $_POST['LoginPassword']));*/
                                                                 
                                                                  
        if ($MemberID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Member  Name";
        }
    
    }
    }
?>
<script>

$(document).ready(function () {
  $("#AadhaarNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAadhaarNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#WhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWhatsappNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#MemberName").blur(function () {
    
        IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name");
                        
   });
   $("#MemberCode").blur(function () {
    
        IsNonEmpty("MemberCode","ErrMemberCode","Please Enter Member Code");
                        
   });
   $("#DateofBirth").blur(function () {
    
        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });
   $("#WhatsappNumber").blur(function () {
    
    //    IsNonEmpty("WhatsappNumber","ErrWhatsappNumber","Please Enter Whatsapp Number");
        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
   });
   $("#EmailID").blur(function () {
    
        IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
                        
   }); 
   $("#AadhaarNumber").blur(function () {
    
        IsNonEmpty("AadhaarNumber","ErrAadhaarNumber","Please Enter Aadhaar Number");
                        
   });
   $("#LoginName").blur(function () {
    
        IsNonEmpty("LoginName","ErrLoginName","Please Enter Login Name");
                        
   });
   $("#LoginPassword").blur(function () {
                  
       if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
       IsPassword("LoginPassword","ErrLoginPassword","Please Enter Alpha Numeric Characters and More than 8 characters");  
                  
                        } 
   });
});

function myFunction() {
  var x = document.getElementById("LoginPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function SubmitNewMember() {
                         $('#ErrMemberCode').html("");
                         $('#ErrMemberName').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrSex').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrAadhaarNumber').html("");
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
                        
                        if (IsNonEmpty("MemberCode","ErrMemberCode","Please Enter Member Code")) {
                        IsAlphaNumeric("MemberCode","ErrMemberCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name")) {
                        IsAlphabet("MemberName","ErrMemberName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Valid Date of Birth");
                        IsNonEmpty("Sex","ErrSex","Please Enter Valid Sex");
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsNonEmpty("AadhaarNumber","ErrAadhaarNumber","Please Enter Aadhaar Number")) {
                        IsNumeric("AadhaarNumber","ErrAadhaarNumber","Please Enter Numeric Charactors only");
                        }
                        if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
                        IsAlphaNumeric("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
                            IsPassword("LoginPassword","ErrLoginPassword","Please Enter Alpha Numeric Characters and More than 8 characters");  
                        } 
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}                                                
</script>
<form method="post" action="" onsubmit="return SubmitNewMember();">
        <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Create Member</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Member Name" class="col-sm-2 col-form-label">Member Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" maxlength="7" id="MemberCode" name="MemberCode" value="<?php echo isset($_POST['MemberCode']) ? $_POST['MemberCode'] : Member::GetNextMemberNumber();?>">
                            <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Member Name" class="col-sm-2 col-form-label">Member Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : "");?>" placeholder="Member Name">
                            <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="Date of Birth" class="col-sm-2 col-form-label" >Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>" placeholder="Date of Birth" style="line-height:15px !important">        
                            <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?></span>
                          </div>
                          <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                         
                          <div class="col-sm-3">
                          <select class="form-control" id="Sex"  name="Sex">
                            <?php $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'");  ?>
                            <?php foreach($Sexs as $Sex) { ?>
                            <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                       <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                     </div>
                        </div>
                        <div class="form-group row">
                          <label for="MobileNumber" class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" placeholder="Mobile Number">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                          </div>
                          <label for="WhatsappNumber" class="col-sm-2 col-form-label">Whatsapp Number</label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>" placeholder="Whatsapp Number">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="EmailID" class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>" placeholder="Email ID">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="AadhaarNumber" class="col-sm-2 col-form-label">Aadhaar Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="AadhaarNumber" name="AadhaarNumber" value="<?php echo (isset($_POST['AadhaarNumber']) ? $_POST['AadhaarNumber'] : "");?>" placeholder="Aadhaar Number">
                            <span class="errorstring" id="ErrAadhaarNumber"><?php echo isset($ErrAadhaarNumber)? $ErrAadhaarNumber : "";?></span>
                          </div>
                          <label for="AadhaarFile" class="col-sm-2 col-form-label">Aadhaar File<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="file"  id="AadhaarFile" name="AadhaarFile">
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="LoginName" class="col-sm-2 col-form-label">Login Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : "");?>" placeholder="Login Name">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName : "";?></span>
                          </div>
                          <label for="LoginPassword" class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>" placeholder="Login Password">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span></div>
                            <div class="col-sm-2" style="padding-top:5px;"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                          </div>
                       <div class="form-group row">
                        <div class="col-sm-2">
                        <button type="submit" name="BtnMember" class="btn btn-success mr-2">Create Member</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageMembers">List of Members </a></div>
                        </div>
                        </form>                   
                    </div>
                  </div>                              
                </div>
</form>  