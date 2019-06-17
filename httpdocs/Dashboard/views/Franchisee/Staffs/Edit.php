<?php
 /*   if (isset($_POST['BtnupdateStaff'])) {
        
         
       $ErrorCount =0;
        
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."' and PersonID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where EmailId='".trim($_POST['EmailID'])."' and PersonID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['LoginName'])."' and PersonID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrLoginName="Login Name Already Exists";    
             $ErrorCount++;
        }
        $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_REQUEST['Code']."'");
        
         if (sizeof($Staffs)==0) {
             $ErrorCount++;
            echo "Error: Access denied. Please contact administrator";
             } 
          echo $ErrorCount;                                                                         
                                                                                         
           if ($ErrorCount==0) { 
               $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
       $mysql->execute("update _tbl_franchisees_staffs set PersonName='".$_POST['staffName']."', 
                                                           Sex='".$_POST['Sex']."', 
                                                           DateofBirth='".$dob."',
                                                           CountryCode='".$_POST['CountryCode']."',
                                                           MobileNumber='".$_POST['MobileNumber']."',
                                                           EmailID='".$_POST['EmailID']."',
                                                           UserRole='".$_POST['UserRole']."',
                                                           LoginPassword='".$_POST['LoginPassword']."'
                                                           where  PersonID='".$_REQUEST['Code']."'");
                                                                       
           /*$mail2 = new MailController();
           $mail2->NewFranchiseeStaff(array("mailTo"         => $_POST['EmailID'] ,
                                             "StaffName"      => $_POST['staffName'],
                                             "StaffCode"      => $_POST['staffCode'],
                                             "FranchiseeName" => $_FranchiseeInfo['FranchiseeName'],
                                             "LoginName"      => $_POST['LoginName'],
                                             "LoginPassword"  => $_POST['LoginPassword']));    */
                                                                 
                                                                  
        
            /*unset($_POST);
            echo "Updated Successfully";
        } else {
            echo "Error occured. Couldn't save Staff  Name";
        }
    
    }  
   
    
   $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_REQUEST['Code']."'");              */
?>
<?php

    if (isset($_POST['BtnupdateStaff'])) {
        $response = $webservice->EditFranchiseeStaff($_POST);
         print_r($response);
        if ($response['status']=="success") {
            echo "aa";
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->GetStaffs();
    $Staffs=$response['data'];
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
        
                        IsNonEmpty("staffCode","ErrstaffCode","Please Enter Valid Staff Code");
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

<form method="post" action="" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Staffs</h4>
                  <h4 class="card-title">Edit Staff</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Code</label>
                          <div class="col-sm-3"><input type="text" class="form-control" disabled="disabled" id="StaffCode" name="StaffCode" value="<?php echo (isset($_POST['StaffCode']) ? $_POST['StaffCode'] : $Staffs[0]['StaffCode']);?>"> </div>
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="staffName" name="staffName" value="<?php echo (isset($_POST['staffName']) ? $_POST['staffName'] : $Staffs[0]['PersonName']);?>">
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
                          <?php
                         
                          if (isset($_POST['DateofBirth'])) {
                            $dob=$_POST['DateofBirth']  ;
                          } else {
                              $dob=strtotime($Staffs[0]['DateofBirth'])  ;  
                               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
                          } 
      
                          ?>
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" style="line-height:15px !important" value="<?php echo $dob;?>">
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
                                <option value="+91" <?php echo ($CountryCode=="+91") ? ' selected="selected"' : '';?>>+91</option>
                                <option value="+44" <?php echo ($CountryCode=="+44") ? ' selected="selected"' : '';?>>+44</option>
                            </select>
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Staffs[0]['MobileNumber']);?>" style="margin-left: -20px;">
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
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Staffs[0]['EmailID']);?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Login Name</label>
                          <div class="col-sm-3">
                            <input type="text" disabled="disabled" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : $Staffs[0]['LoginName']);?>">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="Password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Staffs[0]['LoginPassword']);?>">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span></div>
                            <div class="col-sm-2"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                          </div>
                        </div>
                      </div>
                   <br>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnupdateStaff" class="btn btn-success mr-2">Update staff</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../ManageStaffs "><small>List of Staffs</small> </a></div>
                   </div>
                        <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>    
                </form>
             </div>
          </div>
</div>
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageStaffs"><small style="font-weight:bold;text-decoration:underline">View Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/BlockStaffs/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>&nbsp;|&nbsp;
</div> 
</form> <?php }?>  
