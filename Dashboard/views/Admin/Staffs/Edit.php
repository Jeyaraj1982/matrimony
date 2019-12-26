<?php   
    if (isset($_POST['BtnupdateStaff'])) {
        
        $response = $webservice->getData("Admin","EditAdminStaff",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","GetAdminStaffInfo");
    $Staffs          = $response['data']['Staffs'];
    
?>
<script>
$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#StaffName").blur(function () {
    
        IsNonEmpty("StaffName","ErrStaffName","Please Enter Staff Name");
                        
   });
   $("#Sex").blur(function () {
    
        IsNonEmpty("Sex","ErrSex","Please Select a Sex");
                        
   });
   $("#DateofBirth").blur(function () {
    
        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });
   $("#EmailID").blur(function () {
    
        IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
                        
   }); 
   $("#UserRole").blur(function () {
    
        IsNonEmpty("UserRole","ErrUserRole","Please Enter User Role");
                        
   });
   $("#LoginPassword").blur(function () {
    
        IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password");
                        
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

function SubmitNewStaff() {
                         $('#ErrStaffName').html("");
                         $('#ErrSex').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("StaffName","ErrStaffName","Please Enter Staff Name")) {
                        IsAlphabet("StaffName","ErrStaffName","Please Enter Alpha Numeric characters only");
                        }
                        if($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0"){
                        document.getElementById("ErrDateofBirth").innerHTML="Please select date of birth"; 
                        ErrorCount++;
                        }
                        if($("#Sex").val()=="0"){
                        document.getElementById("ErrSex").innerHTML="Please select your gender"; 
                        ErrorCount++;
                        }
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsPassword("LoginPassword","ErrLoginPassword","Please Enter More than 8 characters")) {
                        IsAlphaNumeric("LoginPassword","ErrLoginPassword","Alpha Numeric Characters only");
                        }
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 
}
function DateofBirthValidation() {
        
        if ($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0") {
            $('#ErrDateofBirth').html("Please select Date of Birth");
        } else {
            $('#ErrDateofBirth').html("");
        }
    }
</script>
<form method="post" action="" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <div style="padding:15px !important;max-width:770px !important;">
                  <h4 class="card-title">Manage Staffs</h4>
                  <h4 class="card-title">Edit Staff</h4>
                  <form class="form-sample">
                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Code</label>
                          <div class="col-sm-3"><input type="text" class="form-control" disabled="disabled" id="StaffCode" name="StaffCode" value="<?php echo (isset($_POST['StaffCode']) ? $_POST['StaffCode'] : $Staffs['AdminCode']);?>"> </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Staff Name<span id="star">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="StaffName" name="StaffName" value="<?php echo (isset($_POST['StaffName']) ? $_POST['StaffName'] : $Staffs['AdminName']);?>">
                            <span class="errorstring" id="ErrStaffName"><?php echo isset($ErrStaffName)? $ErrStaffName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-4">
                            <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                                <?php $dob=strtotime($Staffs['DateofBirth'])  ; ?>
                                <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                    <option value="0">Day</option>
                                    <?php for($i=1;$i<=31;$i++) {?>
                                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:4px;">        
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
                         <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Gender<span id="star">*</span></label>
                          <div class="col-sm-4">
                          <select class="form-control" id="Sex"  name="Sex" >
                            <?php foreach($response['data']['Gender'] as $Sex) { ?>
                                <option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($Sex['CodeValue']==$Staffs['Sex']) ? " selected='selected'" :""; ?>><?php echo $Sex['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-2" style="padding-right:0px">
                            <select class="selectpicker form-control" data-live-search="true" name="MobileNumberCountryCode" id="MobileNumberCountryCode">
                               <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                              <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'MobileNumberCountryCode'])) ? (($_POST[ 'MobileNumberCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Staffs[ 'MobileNumberCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                        <?php echo $CountryCode['str'];?>
                               <?php } ?>
                            </select>
                          </div>                                                                                     
                          <div class="col-sm-2" style="padding-left:5px;padding-right:10px">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Staffs['MobileNumber']);?>">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-4">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Staffs['EmailID']);?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Login Name</label>
                          <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : $Staffs['AdminLogin']);?>">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-4">
                            <input type="Password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Staffs['AdminPassword']);?>">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span>
                            <input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                          </div>
                      <div class="form-group row">
                         <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                          <div class="col-sm-4">
                              <select class="form-control" id="UserRole"  name="UserRole">
                                <option value="Admin" <?php echo ($Staffs['StaffRole']=="Admin") ? " selected='selected'" :""; ?>>Admin</option>
                                <option value="View" <?php echo ($Staffs['StaffRole']=="View") ? " selected='selected'" :""; ?>>View</option>
                              </select>
                          <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">IsActive<span id="star">*</span></label>
                          <div class="col-sm-4">
                              <select class="form-control" id="IsActive"  name="IsActive">
                                <option value="1" <?php echo ($Staffs['IsActive']=="1") ? " selected='selected'" :""; ?>>Yes</option>
                                <option value="0" <?php echo ($Staffs['IsActive']=="0") ? " selected='selected'" :""; ?>>No</option>
                              </select>
                          <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                          </div>  
                        </div>
                      
                   <br>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnupdateStaff" class="btn btn-primary mr-2">Update staff Information</button></div>
                   </div>
                </form>
                </div>
                </div>
              </div>
</div>
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageStaffs "><small style="font-weight:bold;text-decoration:underline">List of Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/View/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">View Staff</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/BlockStaffs/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Staff</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>&nbsp;|&nbsp;
</div> 
</form>   
