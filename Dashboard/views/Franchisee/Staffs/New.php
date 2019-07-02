<?php
   /* if (isset($_POST['BtnSaveStaff'])) {
    
       $ErrorCount =0;
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where FrCode='".trim($_POST['staffCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrstaffCode="staff Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where EmailId='".trim($_POST['EmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['LoginName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLoginName="Login Name Already Exists";    
             $ErrorCount++;
        }
               
               
           if ($ErrorCount==0) { 
       $StaffID = $mysql->insert("_tbl_franchisees_staffs",array("FrCode"          => $_FranchiseeInfo['FranchiseeCode'],
                                                                 "StaffCode"       => $_POST['staffCode'],   
                                                                 "PersonName"      => $_POST['staffName'], 
                                                                 "Sex"             => $_POST['Sex'], 
                                                                 "DateofBirth"     => $_POST['DateofBirth'],
                                                                 "CountryCode"    => $_POST['CountryCode'],
                                                                 "MobileNumber"    => $_POST['MobileNumber'],
                                                                 "EmailID"         => $_POST['EmailID'],
                                                                 "IsActive"        => "1",
                                                                 "UserRole"        => "Admin",
                                                                 "LoginName"       => $_POST['LoginName'],
                                                                 "FranchiseeID"    => $_Franchisee['FranchiseeID'],
                                                                 "ReferedBy"       => "0",
                                                                 "CreatedOn"       => date("Y-m-d H:i:s"), 
                                                                 "LoginPassword"   => $_POST['LoginPassword']));
                                                                       
          
                                                                 
                                                                  
        if ($StaffID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Staff  Name";
        }
    
    }  
   } */
?>
<?php                   
  if (isset($_POST['BtnSaveStaff'])) {         
    $response = $webservice->CreateFranchiseeStaff($_POST);
    if ($response['status']=="success") {
        ?>
        <script>location.href='http://nahami.online/sl/Dashboard/Staffs/Created';</script>
        <?php
    } else {
        $errormessage = $response['message']; 
    }
    }
?> 
<script>

$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#staffCode").blur(function () {
    
        IsNonEmpty("staffCode","ErrstaffCode","Please Enter staff Code");
                        
   });
   $("#staffName").blur(function () {
    
        IsNonEmpty("staffName","ErrstaffName","Please Enter staff Name");
                        
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
                         $('#ErrstaffCode').html("");
                         $('#ErrstaffName').html("");
                         $('#ErrSex').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrUserRole').html("");
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("staffCode","ErrstaffCode","Please Enter Valid Staff Code")) {
                        IsAlphaNumeric("staffCode","ErrstaffCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("staffName","ErrstaffName","Please Enter staff Name")) {
                        IsAlphabet("staffName","ErrstaffName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Valid Date of Birth");
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
</script>
<?php 
     $fInfo = $webservice->GetFranchiseeStaffCodeCode(); 

     $StaffCode="";
        if ($fInfo['status']=="success") {
            $StaffCode  =$fInfo['data']['staffCode'];
        }
        
        {
?>
<form method="post" action="<?php $_SERVER['PHP_SELF']?>" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Staffs</h4>                    
                  <h5 class="card-title">Create Staffs</h5>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" value="<?php echo isset($_POST['staffCode']) ? $_POST['staffCode'] : $StaffCode;?>" class="form-control" id="staffCode" name="staffCode" maxlength="6">
                            <span class="errorstring" id="ErrstaffCode"><?php echo isset($ErrstaffCode)? $ErrstaffCode : "";?></span>
                          </div>
                        </div>
                      </div>                                  
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="staffName" name="staffName" value="<?php echo isset($_POST['staffName']) ? $_POST['staffName'] : $staffName;?>">
                            <span class="errorstring" id="ErrstaffName"><?php echo isset($ErrstaffName)? $ErrstaffName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <select class="form-control" id="Sex"  name="Sex" >
                            <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                            <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                            <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                          <div class="col-sm-1"></div>
                          <label class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" style="line-height:15px !important" value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>">
                             <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-1">
                            <select name="CountryCode" id="CountryCode" style="padding-top: 9px;padding-bottom: 6px;">
                                <option value="+91">+91</option>
                                <option value="+44">+44</option>
                            </select>
                            <span class="errorstring" id="ErrCountryCode"><?php echo isset($ErrCountryCode)? $ErrCountryCode: "";?></span>
                          </div>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" style="margin-left: -20px;">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <select class="form-control" id="UserRole"  name="UserRole">
                            <option value="Admin">Admin</option>
                            <option value="View">View</option>
                          </select>
                          <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                  <div class="row">
                      <div class="col-md-12">
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
                        </div>
                      </div>
                   <br>
                     
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSaveStaff" class="btn btn-success mr-2">Create staff</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageStaffs "><small>List of Staffs</small> </a></div>
                   </div>
                   <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>    
                </form>
             </div>
          </div>
</div>
</form>  <?php }?>