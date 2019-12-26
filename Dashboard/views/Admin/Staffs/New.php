<script>
$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#StaffCode").blur(function () {
    
        IsNonEmpty("StaffCode","ErrStaffCode","Please Enter Staff Code");
                        
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
   $("#LoginName").blur(function () {
    
        IsNonEmpty("LoginName","ErrLoginName","Please Enter Login Name");
                        
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
                         $('#ErrStaffCode').html("");
                         $('#ErrStaffName').html("");
                         $('#ErrSex').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("StaffCode","ErrStaffCode","Please Enter Valid Staff Code")) {
                        IsAlphaNumeric("StaffCode","ErrStaffCode","Please Enter Alpha Numeric characters only");
                        }
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
                        if (IsLogin("LoginName","ErrLoginName","Please Enter the character greater than 6 character and less than 9 character")) {
                        IsAlphabet("LoginName","ErrLoginName","Please Enter Alpha Numeric Character only");
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
 <?php                   
  if (isset($_POST['BtnSaveStaff'])) {   
    $response = $webservice->getData("Admin","CreateAdminStaff",$_POST);
    if ($response['status']=="success") {  echo  $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    } 
    }
  $AInfo = $webservice->getData("Admin","GetAdminStaffInfo");
     $AdminCode="";
        if ($AInfo['status']=="success") {
            $AdminCode  =$AInfo['data']['AdminStaffCode'];
        }
        {
?>
<form method="post" action="" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">                                    
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Staff</h4>
                  <form class="form-sample">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Staff Code<span id="star">*</span></label>
                      <div class="col-sm-2">
                        <input type="text" value="<?php echo isset($_POST['StaffCode']) ? $_POST['StaffCode'] : $AdminCode;?>" class="form-control" id="StaffCode" name="StaffCode" maxlength="6">
                        <span class="errorstring" id="ErrStaffCode"><?php echo isset($ErrStaffCode)? $ErrStaffCode : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="StaffName" name="StaffName" value="<?php echo (isset($_POST['StaffName']) ? $_POST['StaffName'] : "");?>">
                            <span class="errorstring" id="ErrStaffName"><?php echo isset($ErrStaffName)? $ErrStaffName : "";?></span>
                          </div>
                       </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-3">
                           <div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
                                <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px" onchange="DateofBirthValidation()">
                                    <option value="0">Day</option>
                                    <?php for($i=1;$i<=31;$i++) {?>
                                    <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:4px;margin-left:6px;">        
                                <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px" onchange="DateofBirthValidation()">
                                    <option value="0">Month</option>
                                    <?php foreach($_Month as $key=>$value) {?>
                                    <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px" onchange="DateofBirthValidation()">
                                    <option value="0">Year</option>
                                    <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                    <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>                             
                                    <?php } ?>
                                </select>
                            </div>
                             <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                                <option value="0">--Choose Gender--</option>
                                <?php foreach($AInfo['data']['Gender'] as $Sex) { ?>
                                    <option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($Sex[ 'CodeValue']==$_POST[ 'Sex']) ? ' selected="selected" ' : '';?>>
                                        <?php echo $Sex['CodeValue'];?>
                                    </option>
                                    <?php } ?>
                            </select>
                          <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Login Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : "");?>">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="Password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>"> 
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span> </div>
                            <div class="col-sm-2"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                            <!--<span toggle="#Password" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->
                          </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <select class="form-control" id="UserRole"  name="UserRole" value="<?php echo (isset($_POST['UserRole']) ? $_POST['UserRole'] : "");?>">
                            <option value="Admin">Admin</option>
                            <option value="View">View</option>
                          </select>
                          <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12" style="text-align:center;color:red">
                                <?php echo $errormessage;?>
                            </div>
                        </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSaveStaff" class="btn btn-success mr-2">Create staff</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageStaffs "><small>List of Staffs</small> </a></div>
                   </div>
                </form>
             </div>
          </div>
</div>
</form>                                                  
<?php } ?>