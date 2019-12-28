
<?php

    if (isset($_POST['BtnupdateStaff'])) {
        $response = $webservice->getData("Franchisee","EditFranchiseeStaff",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Franchisee","GetStaffs");
    $Staffs=$response['data']['Staffs'];
   
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
     $fInfo = $webservice->getData("Franchisee","GetFranchiseeStaffCodeCode"); 

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
                <div style="padding:15px !important;max-width:770px !important;">
                  <h4 class="card-title">Manage Staffs</h4>
                  <h4 class="card-title">Edit Staff</h4>
                  <form class="form-sample">
                  <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Code</label>
                          <div class="col-sm-3"><input type="text" class="form-control" disabled="disabled" id="StaffCode" name="StaffCode" value="<?php echo (isset($_POST['StaffCode']) ? $_POST['StaffCode'] : $Staffs[0]['FrCode']);?>"> </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Staff Name<span id="star">*</span></label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="staffName" name="staffName" value="<?php echo (isset($_POST['staffName']) ? $_POST['staffName'] : $Staffs[0]['PersonName']);?>">
                            <span class="errorstring" id="ErrstaffName"><?php echo isset($ErrstaffName)? $ErrstaffName : "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                          <div class="col-sm-4">
                          <select class="form-control" id="Sex"  name="Sex" >
                          <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                          <option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($Staffs[0]['Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $Sex['CodeValue'];?>
                                                <?php } ?>      
                        </option>
                          </select>
                          <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-4">
                            <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                                <?php $dob=strtotime($Staffs[0]['DateofBirth'])  ; ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:4px;">       
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>>
                                            <?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                           </div> 
                        </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-2" style="padding-right:0px">
                            <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode">
                               <?php foreach($fInfo['data']['Country'] as $CountryCode) { ?>
                              <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Staffs[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                        <?php echo $CountryCode['str'];?>
                               <?php } ?>
                            </select>
                          </div>
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          <div class="col-sm-2">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Staffs[0]['MobileNumber']);?>" >
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Staff Role<span id="star">*</span></label>
                          <div class="col-sm-4">
                              <select class="form-control" id="UserRole"  name="UserRole">
                                <option value="Admin">Admin</option>
                                <option value="View">View</option>
                              </select>
                          <span class="errorstring" id="ErrUserRole"><?php echo isset($ErrUserRole)? $ErrUserRole: "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-10">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Staffs[0]['EmailID']);?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID: "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Login Name</label>
                          <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="LoginName" name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : $Staffs[0]['LoginName']);?>">
                            <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName: "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="Password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : $Staffs[0]['LoginPassword']);?>">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword: "";?></span></div>
                            <div class="col-sm-2"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
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
</div>

<div class="col-12 grid-margin">
                  <div class="card">                                                            
                    <div class="card-body">
                    <h4 class="card-title">KYC Process</h4>  
                        <span style="color:#999;">KYC stands for Know Your Customer process of identifying and verifying identity of members.</span>
                        <br><br>
                        <span style="color:#666;">In order to submit your KYC, your identification documents need to pass a verification process, done by our document authentication team.</span>
                        <br><br>
                      <div class="form-group row">
            <div class="col-sm-12">
            <?php
                if (isset($_POST['updateIDProof'])) {
                    
                    $target_dir = "uploads/";
                    $err=0;
                    $_POST['IDProofFileName']= "";
                    if (isset($_FILES["IDProofFileName"]["name"]) && strlen(trim($_FILES["IDProofFileName"]["name"]))>0 ) {
                        $idprooffilename = time().basename($_FILES["IDProofFileName"]["name"]);
                        if (!(move_uploaded_file($_FILES["IDProofFileName"]["tmp_name"], $target_dir . $idprooffilename))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['IDProofFileName']= $idprooffilename;
                        $res = $webservice->getData("Member","UpdateKYC",$_POST);
                        if ($res['status']=="success") {
                            echo  $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                    } else {
                        $res =$webservice->getData("Member","UpdateKYC");
                }
                }
                  else {
                     $res =$webservice->getData("Member","UpdateKYC");
                     
                }
               $Kyc =$webservice->getData("Member","GetKYC");
            ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">ID Proof</div>
              <?php 
              
              if ($Kyc['data']['isAllowToUploadIDproof']==1) { ?>
                <div class="col-sm-3" >
                    <select name="IDType" id="IDType"  class="selectpicker form-control" data-live-search="true">
                        <?php foreach($Kyc['data']['IDProof'] as $IDType) { ?>
                            <option value="<?php echo $IDType['SoftCode'];?>" <?php echo ($_POST['IDType']==$IDType['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $IDType['CodeValue'];?></option>
                        <?php } ?>
                    </select> <br><br>
                    <button type="submit" class="btn btn-primary" name="updateIDProof" style="font-family:roboto;margin-top: 10px;">Submit Document</button>
                </div>
                <div class="col-sm-3" style="padding-top: 5px;"><input type="file" name="IDProofFileName"></div>
                <br>
                <br>
                
                 
              <?php } 
              foreach($Kyc['data']['IdProofDocument'] as $idProof)  { ?>
              
              <div class="col-sm-7" style="padding-top: 5px;color: #888;margin-top:10px">  
                    <img src="<?php echo AppUrl;?>uploads/<?php echo $idProof['FileName'];?>" style="height:120px;"><br><br>
                    Document Type&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $idProof['FileType'];?>
                    <br><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;">&nbsp;Updated On&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo putDateTime($Kyc['data']['IdProofDocument'][0]['SubmittedOn']);?>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status &nbsp;&nbsp;:&nbsp;&nbsp;
                    <?php 
                        if($idProof['IsVerified']==0 && $idProof['IsRejected']==0){ 
                            echo "Verification pending";
                        } else if ($idProof['IsVerified']==1 && $idProof['IsRejected']==0) { 
                            echo "verified";
                        } else if($idProof['IsRejected']==1) { 
                            echo '<span style="color:red">Rejected</span><br>';    ?>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reason &nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $idProof['RejectedRemarks'];?>  
                       <br><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;">&nbsp;Rejected On&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo putDateTime($idProof['RejectedOn']);?>
                      <?php }  ?>                                                               
              </div>
              <?php  } ?>
              
              </div>
                                       
                    </div>
                  </div>
</div>

<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageStaffs"><small style="font-weight:bold;text-decoration:underline">View Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/BlockStaffs/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Staffs</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Staffs/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>&nbsp;|&nbsp;
</div> 
</form> <?php }?>  
