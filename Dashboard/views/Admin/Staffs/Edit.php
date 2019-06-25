<?php
    if (isset($_POST['BtnupdateStaff'])) {
       
         
       $ErrorCount =0;
        
        $duplicate = $mysql->select("select * from  _tbl_admin_staffs where MobileNumber='".trim($_POST['MobileNumber'])."' and StaffID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_admin_staffs where EmailID='".trim($_POST['EmailID'])."' and StaffID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_admin_staffs where LoginName='".trim($_POST['LoginName'])."' and StaffID<>'".$_GET['Code']."' ");
        if (sizeof($duplicate)>0) {
             $ErrLoginName="Login Name Already Exists";    
             $ErrorCount++;
        }
        $Staffs = $mysql->select("select * from _tbl_admin_staffs where StaffID='".$_REQUEST['Code']."'");
        
         if (sizeof($Staffs)==0) {
             $ErrorCount++;
            echo "Error: Access denied. Please contact administrator";
             } 
           if ($ErrorCount==0) { 
               $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
     $mysql->execute("update _tbl_admin_staffs set StaffName='".$_POST['StaffName']."', 
                                                   DateofBirth='".$dob."',
                                                   Sex='".$_POST['Sex']."',
                                                   MobileNumber='".$_POST['MobileNumber']."',
                                                   EmailID='".$_POST['EmailID']."',
                                                   StaffRole='".$_POST['UserRole']."',
                                                   LoginPassword='".$_POST['LoginPassword']."'
                                                   where  StaffID='".$_REQUEST['Code']."'");
                                                                       
           /*$mail2 = new MailController();
           $mail2->NewFranchiseeStaff(array("mailTo"         => $_POST['EmailID'] ,
                                             "StaffName"      => $_POST['staffName'],
                                             "StaffCode"      => $_POST['staffCode'],
                                             "FranchiseeName" => $_FranchiseeInfo['FranchiseeName'],
                                             "LoginName"      => $_POST['LoginName'],
                                             "LoginPassword"  => $_POST['LoginPassword']));    */
                                                                 
                                                                  
        
            unset($_POST);
            echo "Updated Successfully";
        } else {
            echo "Error occured. Couldn't save Staff  Name";
        }
        
    }  
  
    
  $Staffs = $mysql->select("select * from _tbl_admin_staffs where StaffID='".$_REQUEST['Code']."'");     
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
                         $('#ErrLoginName').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("StaffName","ErrStaffName","Please Enter Staff Name")) {
                        IsAlphabet("StaffName","ErrStaffName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Valid Date of Birth");
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
</script>




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
                            <input type="text" class="form-control" id="StaffName" name="StaffName" value="<?php echo (isset($_POST['StaffName']) ? $_POST['StaffName'] : $Staffs[0]['StaffName']);?>">
                            <span class="errorstring" id="ErrStaffName"><?php echo isset($ErrStaffName)? $ErrStaffName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
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
                          <label class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                          <?php $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'"); ?>
                          <div class="col-sm-3">
                          <select class="form-control" id="Sex"  name="Sex" >
                            <?php foreach($Sexs as $Sex) { ?>
                                <option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($Sex['CodeValue']==$Staffs[0]['Sex']) ? " selected='selected'" :""; ?>><?php echo $Sex['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Staffs[0]['MobileNumber']);?>">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-3">
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
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span>
                            <input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
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
                   <br>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnupdateStaff" class="btn btn-primary mr-2">Update staff Information</button></div>
                   </div>
                </form>
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
