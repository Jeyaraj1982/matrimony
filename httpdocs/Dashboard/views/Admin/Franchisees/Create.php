<?php   
    if (isset($_POST['BtnSaveCreate'])) {
        
       $ErrorCount =0;
        
        if (isset($_POST['FranchiseeName'])) {
            if (!(strlen(trim($_POST['FranchiseeName']))>0)) {
                $ErrFranchiseeName="Please enter Franchisee Name";    
                $ErrorCount++;  
            }
        } else {
            $ErrFranchiseeName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['FranchiseeEmailID'])) {
            if (!(strlen(trim($_POST['FranchiseeEmailID']))>0)) {
                $ErrFranchiseeEmailID="Please enter Franchisee Email ID";    
                $ErrorCount++;  
            }
        } else {
            $ErrFranchiseeEmailID="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['BusinessMobileNumber'])) {
            
            if (!(strlen(trim($_POST['BusinessMobileNumber']))>0)) {
                $ErrBusinessMobileNumber="Please enter Mobile Number";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrBusinessMobileNumber="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['BusinessAddress1'])) {
            
            if (!(strlen(trim($_POST['BusinessAddress1']))>0)) {
                $ErrBusinessAddress1="Please enter Address";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrBusinessAddress1="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['CityName'])) {
            
            if (strlen(trim($_POST['CityName']))>0) {
            
            } else {
                $ErrCityName="Please enter City Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrCityName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['PinCode'])) {
            
            if (strlen(trim($_POST['PinCode']))>0) {
            
            } else {
                $ErrPinCode="Please enter Pin Code";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrPinCode="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['AccountName'])) {
            
            if (strlen(trim($_POST['AccountName']))>0) {
            
            } else {
                $ErrAccountName="Please enter Account Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAccountName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['AccountNumber'])) {
            
            if (strlen(trim($_POST['AccountNumber']))>0) {
            
            } else {
                $ErrAccountNumber="Please enter Account Number";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAccountNumber="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['IFSCode'])) {
            
            if (strlen(trim($_POST['IFSCode']))>0) {
            
            } else {
                $ErrIFSCode="Please enter IFS Code";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrIFSCode="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['AccountType'])) {
            
            if (strlen(trim($_POST['AccountType']))>0) {
            
            } else {
                $ErrAccountType="Please  select AccountType";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAccountType="Param Missing";    
            $ErrorCount++;  
        }
        if (isset($_POST['PersonName'])) {
            
            if (strlen(trim($_POST['PersonName']))>0) {
            
            } else {
                $ErrPersonName="Please enter Person Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrPersonName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['FatherName'])) {
            
            if (strlen(trim($_POST['FatherName']))>0) {
            
            } else {
                $ErrFatherName="Please enter Father Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrFatherName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['DateofBirth'])) {
            
            if (strlen(trim($_POST['DateofBirth']))>0) {
            
            } else {
                $ErrDateofBirth="Please enter Date of Birth";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrDateofBirth="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['EmailID'])) {
            
            if (strlen(trim($_POST['EmailID']))>0) {
            
            } else {
                $ErrEmailID="Please enter Email ID";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrEmailID="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['MobileNumber'])) {
            
            if (strlen(trim($_POST['MobileNumber']))>0) {
            
            } else {
                $ErrMobileNumber="Please enter Mobile Number";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrMobileNumber="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['Address1'])) {
            
            if (strlen(trim($_POST['Address1']))>0) {
            
            } else {
                $ErrAddress1="Please enter Address1";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAddress1="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['AadhaarCard'])) {
            
            if (strlen(trim($_POST['AadhaarCard']))>0) {
            
            } else {
                $ErrAadhaarCard="Please enter AadhaarCard";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAadhaarCard="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['UserName'])) {
            
            if (strlen(trim($_POST['UserName']))>0) {
            
            } else {
                $ErrUserName="Please enter UserName";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrUserName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['Password'])) {
            
            if (strlen(trim($_POST['Password']))>0) {
            
            } else {
                $ErrPassword="Please enter Password";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrPassword="Param Missing";    
            $ErrorCount++;  
        }
            
            
            
            
            
            
        $duplicate = $mysql->select("select * from  _tbl_franchisees where ContactEmail='".trim($_POST['FranchiseeEmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrFranchiseeEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_franchisees where FranchiseeCode='".trim($_POST['FranchiseeCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrFranchiseeCode="Franchisee Code Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_franchisees where ContactNumber='".trim($_POST['BusinessMobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBusinessMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        if(strlen(trim($_POST['BusinessWhatsappNumber']))>0){
            $duplicate = $mysql->select("select * from  _tbl_franchisees where ContactWhatsapp='".trim($_POST['BusinessWhatsappNumber'])."'");
            if (sizeof($duplicate)>0) {
                 $ErrBusinessWhatsappNumber="Whatsapp Number Already Exists";    
                 $ErrorCount++;
            }
        }
        
       if(strlen(trim($_POST['BusinessLandlineNumber']))>0){ 
        $duplicate = $mysql->select("select * from  _tbl_franchisees where ContactLandline='".trim($_POST['BusinessLandlineNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBusinessLandlineNumber="Landline Number Already Exists";    
             $ErrorCount++;
        }
       }  
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
          if(strlen(trim($_POST['WhatsappNumber']))>0){ 
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWhatsappNumber="Whatsapp Number Already Exists";    
             $ErrorCount++;
        }
          }
          if(strlen(trim($_POST['LandlineNumber']))>0){ 
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where LandlineNumber='".trim($_POST['LandlineNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLandlineNumber="Landline Number Already Exists";    
             $ErrorCount++;
        }
        
          }
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where AadhaarNumber='".trim($_POST['AadhaarCard'])."'");
        if (sizeof($duplicate)>0) {
             $ErrAadhaarCard="Aadhaar Number Already Exists";    
             $ErrorCount++;
        }
   
        $duplicate = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrUserName="User Name Already Exists";    
             $ErrorCount++;
        }
                   
        if ($ErrorCount==0) {
            
            $plan = $mysql->select("select * from _tbl_franchisees_plans where PlanID='".$_POST['Plan']."'");
            
            $FranchiseeID = $mysql->insert("_tbl_franchisees",array("FranchiseeCode"       => $_POST['FranchiseeCode'],
                                                                    "FranchiseName"        => $_POST['FranchiseeName'],
                                                                    "ContactEmail"         => $_POST['FranchiseeEmailID'],
                                                                    "ContactNumber"        => $_POST['BusinessMobileNumber'],
                                                                    "ContactWhatsapp"      => $_POST['BusinessWhatsappNumber'],
                                                                    "ContactLandline"      => $_POST['BusinessLandlineNumber'],
                                                                    "BusinessAddressLine1" => $_POST['BusinessAddress1'],
                                                                    "BusinessAddressLine2" => $_POST['BusinessAddress2'],
                                                                    "BusinessAddressLine3" => $_POST['BusinessAddress3'],
                                                                    "Landmark"             => $_POST['Landmark'],
                                                                    "DistrictName"         => $_POST['DistrictName'],
                                                                    "StateName"            => $_POST['StateName'],
                                                                    "CountryName"          => $_POST['CountryName'],
                                                                    "CityName"             => $_POST['CityName'],
                                                                    "PinCode"              => $_POST['PinCode'],
                                                                    "ValidUpto"            => $_POST['Validupto'],
                                                                    "MondayF"              => $_POST['MonFH']." ". $_POST['MonFM']." ". $_POST['MonFN'],
                                                                    "TuesdayF"             => $_POST['TueFH']." ". $_POST['TueFM']." ". $_POST['TueFN'],
                                                                    "WednessdayF"          => $_POST['WedFH']." ". $_POST['WedFM']." ". $_POST['WedFN'],
                                                                    "ThursdayF"            => $_POST['ThuFH']." ". $_POST['ThuFM']." ". $_POST['ThuFN'],
                                                                    "FridayF"              => $_POST['FriFH']." ". $_POST['FriFM']." ". $_POST['FriFN'],
                                                                    "SaturdayF"            => $_POST['SatFH']." ". $_POST['SatFM']." ". $_POST['SatFN'],
                                                                    "SundayF"              => $_POST['SunFH']." ". $_POST['SunFM']." ". $_POST['SunFN'],
                                                                    "MondayT"              => $_POST['MonTH']." ".$_POST['MonTM']." ".$_POST['MonTN'],
                                                                    "TuesdayT"             => $_POST['TueTH']." ".$_POST['TueTM']." ".$_POST['TueTN'],
                                                                    "WednessdayT"          => $_POST['WedTH']." ".$_POST['WedTM']." ".$_POST['WedTN'],
                                                                    "ThursdayT"            => $_POST['ThuTH']." ".$_POST['ThuTM']." ".$_POST['ThuTN'],
                                                                    "FridayT"              => $_POST['FriTH']." ".$_POST['FriTM']." ".$_POST['FriTN'],
                                                                    "SaturdayT"            => $_POST['SatTH']." ".$_POST['SatTM']." ".$_POST['SatTN'],
                                                                    "SundayT"              => $_POST['SunTH']." ".$_POST['SunTM']." ".$_POST['SunTN'],
                                                                    "CreatedOn"            => date("Y-m-d H:i:s"),
                                                                    "PlanID"               => $plan[0]['PlanID'],
                                                                    "Plan"                 => $plan[0]['PlanName'] )); 
                                                             
            $mysql->insert("_tbl_bank_details",array("BankName"      => $_POST['BankName'],
                                                     "FranchiseeID"  => $FranchiseeID,
                                                     "AccountName"   => $_POST['AccountName'],
                                                     "AccountNumber" => $_POST['AccountNumber'],  
                                                     "IFSCode"       => $_POST['IFSCode'],
                                                     "AccountType"   => $_POST['AccountType']));
                                                              
            $mysql->insert("_tbl_franchisees_staffs",array("PersonName"     => $_POST['PersonName'],
                                                           "FatherName"     => $_POST['FatherName'],
                                                           "FranchiseeID"   => $FranchiseeID,
                                                           "DateofBirth"    => $_POST['DateofBirth'],
                                                           "Sex"            => $_POST['Sex'],
                                                           "FrCode"         => $_POST['FranchiseeCode'],
                                                           "EmailID"        => $_POST['EmailID'],
                                                           "MobileNumber"   => $_POST['MobileNumber'],
                                                           "WhatsappNumber" => $_POST['WhatsappNumber'],
                                                           "LandlineNumber" => $_POST['LandlineNumber'],
                                                           "AddressLine1"   => $_POST['Address1'],
                                                           "AddressLine2"   => $_POST['Address2'],
                                                           "CreatedOn"      => date("Y-m-d H:i:s"),
                                                           "AddressLine3"   => $_POST['Address3'],
                                                           "AadhaarNumber"  => $_POST['AadhaarCard'],
                                                           "IsActive"       => "1",
                                                           "LoginName"      => $_POST['UserName'],
                                                           "ReferedBy"      => $_Admin['AdminID'],
                                                           "LoginPassword"  => $_POST['Password']));

            $mail2 = new MailController();
            
            $mail2->NewFranchisee(array("mailTo"         => $_POST['FranchiseeEmailID'] ,
                                        "FranchiseeName" => $_POST['FranchiseeName'],
                                        "FranchiseeCode" => $_POST['FranchiseeCode'],
                                        "LoginName"      => $_POST['UserName'],
                                        "LoginPassword"  => $_POST['Password']));                                   ;
            if ($FranchiseeID>0) {
                unset($_POST);
                echo "Created Successfully";
            } else {
                echo "Error occured. Couldn't save Franchise Details";
            }
    }
    }
?>                                                    
<style>
#star{
    color:red;
}
</style>
<script>

$(document).ready(function () {
  $("#BusinessMobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrBusinessMobileNumber").html("Digits Only").fadeIn().fadeIn("slow");
               return false;
    }
   });
   
    $("#BusinessWhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrBusinessWhatsappNumber").html("Digits Only").fadeIn().fadeOut("fast");
               return false;
    }
   });
                                                                       
    $("#BusinessLandlineNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrBusinessLandlineNumber").html("Digits Only").fadeIn().fadeOut("fast");
               return false;
    }
   });
   
    $("#AccountNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAccountNumber").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").show().fadeIn("slow");
               return false;
    }
   });
   
     $("#WhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWhatsappNumber").html("Digits Only").show().fadeIn("slow");
               return false;
    }
   });
   $("#LandlineNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrLandlineNumber").html("Digits Only").show().fadeIn("slow");
               return false;
    }
   });
    $("#AadhaarCard").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAadhaarCard").html("Digits Only").show().fadeIn("slow");
               return false;
    }
   });
     
  
   $("#FranchiseeName").blur(function () {
    
        IsNonEmpty("FranchiseeName","ErrFranchiseeName","Please Enter Franchisee Name");
                        
   });
   $("#FranchiseeCode").blur(function () {
    
        IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code");
                        
   });
   
   $("#FranchiseeEmailID").blur(function () {
    
        IsNonEmpty("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter Franchisee EmailID");
                        
   });
   $("#BusinessMobileNumber").blur(function () {
    
        IsNonEmpty("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter MobileNumber");
                        
   });
   
   
   $("#BusinessAddress1").blur(function () {
    
        IsNonEmpty("BusinessAddress1","ErrBusinessAddress1","Please Enter Valid Address Line1");
                        
   });
   $("#Landmark").blur(function () {
    
        IsNonEmpty("Landmark","ErrLandmark","Please Enter Landmark");
                        
   });
   $("#CityName").blur(function () {
    
        IsNonEmpty("CityName","ErrCityName","Please Enter City Name");
                        
   });
   $("#PinCode").blur(function () {
    
        IsNonEmpty("PinCode","ErrPinCode","Please Enter PinCode");
                        
   });
   $("#Validupto").blur(function () {
    
        IsNonEmpty("Validupto","ErrValidupto","Please Enter Valid upto");
                        
   });
   $("#AccountName").blur(function () {
    
        IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name");
                        
   });
   $("#AccountNumber").blur(function () {
    
        IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
                        
   });
   $("#IFSCode").blur(function () {
    
        IsNonEmpty("IFSCode","ErrIFSCode","Please Enter IFS Code");
                        
   });
   $("#PersonName").blur(function () {
    
        IsNonEmpty("PersonName","ErrPersonName","Please Enter Person Name");
                        
   });
   $("#FatherName").blur(function () {
                                                                                         
        IsNonEmpty("FatherName","ErrFatherName","Please Enter Father's Name");
                        
   });
   $("#DateofBirth").blur(function () {
    
        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        
   });
   $("#EmailID").blur(function () {
    
        IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });
   $("#Address1").blur(function () {
    
        IsNonEmpty("Address1","ErrAddress1","Please Enter Address Line1");
                        
   });
   $("#AadhaarCard").blur(function () {
    
        IsNonEmpty("AadhaarCard","ErrAadhaarCard","Please Enter Aadhaar Number");
                        
   });
   $("#UserName").blur(function () {
    
        IsNonEmpty("UserName","ErrUserName","Please Enter Login Name");
                        
   });
   $("#Password").blur(function () {
    
        IsNonEmpty("Password","ErrPassword","Please Enter Password");
                        
   });
   
});

function myFunction() {
  var x = document.getElementById("Password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

 function SubmitNewFranchisee() {
                         $('#ErrFranchiseeCode').html("");
                         $('#ErrFranchiseeName').html("");
                         $('#ErrFranchiseeEmailID').html("");
                         $('#ErrBusinessMobileNumber').html("");
                         $('#ErrBusinessWhatsappNumber').html("");
                         $('#ErrBusinessLandlineNumber').html("");
                         $('#ErrBusinessAddress1').html("");
                         $('#ErrBusinessAddress2').html("");
                         $('#ErrBusinessAddress3').html("");
                         $('#ErrLandmark').html("");
                         $('#ErrCityName').html("");
                         $('#ErrPinCode').html("");
                         $('#ErrAccountName').html("");
                         $('#ErrAccountNumber').html("");
                         $('#ErrIFSCode').html("");
                         $('#ErrPersonName').html("");
                         $('#ErrFatherName').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
                         $('#ErrLandlineNumber').html("");
                         $('#ErrAddress1').html("");
                         $('#ErrAddress2').html("");
                         $('#ErrAddress3').html("");
                         $('#ErrAadhaarCard').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         
                         ErrorCount=0;
                        if (IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code")) {
                        IsAlphaNumeric("FranchiseeCode","ErrFranchiseeCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("FranchiseeName","ErrFranchiseeName","Please Enter Franchisee Name")) {
                        IsAlphabet("FranchiseeName","ErrFranchiseeName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter EmailID")) {
                            IsEmail("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter Valid EmailID");    
                        }
                        
                        if (IsNonEmpty("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter Valid MobileNumber");
                        }
                        
                        if ($('#BusinessWhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("BusinessWhatsappNumber","ErrBusinessWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
                        if ($('#BusinessLandlineNumber').val().trim().length>0) {
                            IsNumeric("BusinessLandlineNumber","ErrBusinessLandlineNumber","Please Enter Valid Landline Number");
                        }
                        
                        IsNonEmpty("BusinessAddress1","ErrBusinessAddress1","Please Enter Valid Address Line1");
                                                                                                                                       
                        
                        if (IsNonEmpty("CityName","ErrCityName","Please Enter Valid City Name")) {
                        IsAlphabet("CityName","ErrCityName","Please Enter Alphabet Charactors only");
                        }
                        if (IsNonEmpty("PinCode","ErrPinCode","Please Enter Valid PinCode")) {
                        IsNumeric("PinCode","ErrPinCode","Please Enter Numeric Charactors only");
                        }
                        if (IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name")) {
                        IsAlphabet("AccountName","ErrAccountName","Please Enter Alpha Numeric Characters only");
                        }
                        IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
                        if (IsNonEmpty("IFSCode","ErrIFSCode","Please Enter Valid IFSCode")) {
                        IsAlphaNumeric("IFSCode","ErrIFSCode","Please Enter Alpha Numeric Characters only");
                        }
                        if (IsNonEmpty("PersonName","ErrPersonName","Please Enter Person Name")) {
                        IsAlphabet("PersonName","ErrPersonName","Please Enter Alphanumeric Charactors only");
                        }
                        if (IsNonEmpty("FatherName","ErrFatherName","Please Enter Father's Name")) {
                        IsAlphabet("FatherName","ErrFatherName","Please Enter Alphabet Charactors only");
                        }
                        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Valid Date of Birth");
                        
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        
                        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
                        if ($('#LandlineNumber').val().trim().length>0) {
                            IsNumeric("LandlineNumber","ErrLandlineNumber","Please Enter Valid Landline");
                        }
                        
                        IsNonEmpty("Address1","ErrAddress1","Please Enter Valid Address Line1");
                        if (IsNonEmpty("AadhaarCard","ErrAadhaarCard","Please Enter Aadhaar Number")) {
                        IsNumeric("AadhaarCard","ErrAadhaarCard","Please Enter Numeric Charactors only");
                        }
                        //IsNonEmpty("UserName","ErrUserName","Please Enter User Name");
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter Login Name")) {
                        IsAlphabet("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsNonEmpty("Password","ErrPassword","Please Enter Login Password")) {
                        IsAlphaNumeric("Password","ErrPassword","Alpha Numeric Characters only");
                        }
                         //alert(ErrorCount);
                        
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
    <form method="post" action="" id="frmfrn" onsubmit="return SubmitNewFranchisee();">  
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Franchisees</h4>
                  <h4 class="card-title">Create Franchisee</h4>
                   Franchising your matrimony business is a proven route to rapid growth. 
                   Follow simple bellow steps, you will create a Franchisee.
                </div>
              </div>
        </div>          
<div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Business Information</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" maxlength="6" id="FranchiseeCode" name="FranchiseeCode" Placeholder="Franchisee Code" value="<?php echo (isset($_POST['FranchiseeCode']) ? $_POST['FranchiseeCode'] : FranchiseeCode::GetNextFranchiseeNumber() );?>">
                            <span class="errorstring" id="ErrFranchiseeCode"><?php echo isset($ErrFranchiseeCode)? $ErrFranchiseeCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Franchisee Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FranchiseeName" name="FranchiseeName" Placeholder="Franchisee Name" value="<?php echo (isset($_POST['FranchiseeName']) ? $_POST['FranchiseeName'] : "");?>">
                            <span class="errorstring" id="ErrFranchiseeName"><?php echo isset($ErrFranchiseeName)? $ErrFranchiseeName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> Email Id<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="type" class="form-control" id="FranchiseeEmailID" name="FranchiseeEmailID" Placeholder="Email ID" value="<?php echo (isset($_POST['FranchiseeEmailID']) ? $_POST['FranchiseeEmailID'] : "");?>">
                            <span class="errorstring" id="ErrFranchiseeEmailID"><?php echo isset($ErrFranchiseeEmailID)? $ErrFranchiseeEmailID : "";?></span>
                           </div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" maxlength="10" class="form-control" id="BusinessMobileNumber" name="BusinessMobileNumber" Placeholder="Mobile Number" value="<?php echo (isset($_POST['BusinessMobileNumber']) ? $_POST['BusinessMobileNumber'] : "");?>">
                            <span class="errorstring" id="ErrBusinessMobileNumber"><?php echo isset($ErrBusinessMobileNumber)? $ErrBusinessMobileNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="BusinessWhatsappNumber" name="BusinessWhatsappNumber" Placeholder="Whatsapp Number" value="<?php echo (isset($_POST['BusinessWhatsappNumber']) ? $_POST['BusinessWhatsappNumber'] : "");?>">
                            <span class="errorstring" id="ErrBusinessWhatsappNumber"><?php echo isset($ErrBusinessWhatsappNumber)? $ErrBusinessWhatsappNumber : "";?></span>
                          </div>
                          <label class="col-sm-3 col-form-label">Landline Number </label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="BusinessLandlineNumber" name="BusinessLandlineNumber" Placeholder="Landline Number"value="<?php echo (isset($_POST['BusinessLandlineNumber']) ? $_POST['BusinessLandlineNumber'] : "");?>">
                            <span class="errorstring" id="ErrBusinessLandlineNumber"><?php echo isset($ErrBusinessLandlineNumber)? $ErrBusinessLandlineNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BusinessAddress1" name="BusinessAddress1" Placeholder="Address Line 1" value="<?php echo (isset($_POST['BusinessAddress1']) ? $_POST['BusinessAddress1'] : "");?>">
                            <span class="errorstring" id="ErrBusinessAddress1"><?php echo isset($ErrBusinessAddress1)? $ErrBusinessAddress1 : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BusinessAddress2" name="BusinessAddress2" Placeholder="Address Line 2" value="<?php echo (isset($_POST['BusinessAddress2']) ? $_POST['BusinessAddress2'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BusinessAddress3" name="BusinessAddress3" Placeholder="Address Line 3" value="<?php echo (isset($_POST['BusinessAddress3']) ? $_POST['BusinessAddress3'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">City Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="CityName" name="CityName" Placeholder="City Name" value="<?php echo (isset($_POST['CityName']) ? $_POST['CityName'] : "");?>">
                          <span class="errorstring" id="ErrCityName"><?php echo isset($ErrCityName)? $ErrCityName : "";?></span>
                          </div>
                          <label class="col-sm-3 col-form-label">Landmark<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="Landmark" name="Landmark" Placeholder="Landmark" value="<?php echo (isset($_POST['Landmark']) ? $_POST['Landmark'] : "");?>">
                            <span class="errorstring" id="ErrLandmark"><?php echo isset($ErrLandmark)? $ErrLandmark : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <?php $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES'"); ?>
                          <select class="form-control" id="CountryName"  name="CountryName" >
                          <?php foreach($CountryNames as $CountryName) { ?>
                         <option value="<?php echo $CountryName['CodeValue'];?>">
                         <?php echo $CountryName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <?php $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'"); ?>
                          <select class="form-control" id="StateName"  name="StateName" >
                          <?php foreach($StateNames as $StateName) { ?>
                         <option value="<?php echo $StateName['CodeValue'];?>">
                         <?php echo $StateName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                          <label class="col-sm-3 col-form-label">District Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <?php $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES'"); ?>
                          <select class="form-control" id="DistrictName"  name="DistrictName" >
                          <?php foreach($DistrictNames as $DistrictName) { ?>
                         <option value="<?php echo $DistrictName['CodeValue'];?>">
                         <?php echo $DistrictName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>                                                                                                                                                                                                    
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pin Code<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="PinCode" name="PinCode" Placeholder="Pin Code" value="<?php echo (isset($_POST['PinCode']) ? $_POST['PinCode'] : "");?>">
                            <span class="errorstring" id="ErrPinCode"><?php echo isset($ErrPinCode)? $ErrPinCode : "";?></span>
                          </div>
                        <label class="col-sm-3 col-form-label">Plan<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <?php $Plans = $mysql->select("select * from _tbl_franchisees_plans where IsActive='1'"); ?>
                          <select class="form-control" id="Plan"  name="Plan" >
                          <?php foreach($Plans as $Plan) { ?>
                         <option value="<?php echo $Plan['PlanID'];?>">
                         <?php echo $Plan['PlanName'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                      </div>                             
                   </div>
                </div>                                       
              </div>
<div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bank Account Details</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <?php $BankNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BANKNAMES'"); ?>
                          <select class="form-control" id="BankName"  name="BankName" >
                          <?php foreach($BankNames as $BankName) { ?>
                         <option value="<?php echo $BankName['CodeValue'];?>">
                         <?php echo $BankName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="<?php echo (isset($_POST['AccountName']) ? $_POST['AccountName'] : "");?>">
                            <span class="errorstring" id="ErrAccountName"><?php echo isset($ErrAccountName)? $ErrAccountName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="<?php echo (isset($_POST['AccountNumber']) ? $_POST['AccountNumber'] : "");?>">
                            <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span>
                          </div>
                        </div>
                      </div>                             
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : "");?>">
                            <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
                          </div>
                          <label class="col-sm-3 col-form-label">Account Type<span id="star">*</span></label>
                           <div class="col-sm-3">
                          <?php $AccountTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ACCOUNTTYPE'"); ?>
                          <select class="form-control" id="AccountType"  name="AccountType" >
                          <?php foreach($AccountTypes as $AccountType) { ?>
                         <option value="<?php echo $AccountType['CodeValue'];?>">
                         <?php echo $AccountType['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                      </div>
                   </div>
              </div>
</div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profile Information</h4>
                   <form class="form-sample">
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Person Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="PersonName" name="PersonName" Placeholder="Person Name" value="<?php echo (isset($_POST['PersonName']) ? $_POST['PersonName'] : "");?>">
                            <span class="errorstring" id="ErrPersonName"><?php echo isset($ErrPersonName)? $ErrPersonName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Father's Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FatherName" name="FatherName" Placeholder="Father's Name" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : "");?>">
                            <span class="errorstring" id="ErrFatherName"><?php echo isset($ErrFatherName)? $ErrFatherName : "";?> </span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of birth<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="Date" class="form-control" id="DateofBirth" name="DateofBirth" value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>" style="line-height:15px !important">
                            <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?> </span>
                          </div>
                          <label class="col-sm-3 col-form-label">Sex<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <?php $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'"); ?>
                          <select class="form-control" id="Sex"  name="Sex" >
                          <?php foreach($Sexs as $Sex) { ?>
                         <option value="<?php echo $Sex['CodeValue'];?>">
                         <?php echo $Sex['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email Id<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EmailID" name="EmailID" Placeholder="Email ID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" Placeholder="Mobile Number" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Whatsapp Number </label>
                          <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" Placeholder="Whatsapp Number" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                          </div>
                          <label class="col-sm-3 col-form-label">Landline Number </label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="LandlineNumber" name="LandlineNumber" Placeholder="Landline Number"value="<?php echo (isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : "");?>">
                            <span class="errorstring" id="ErrLandlineNumber"><?php echo isset($ErrLandlineNumber)? $ErrLandlineNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address1" name="Address1" Placeholder="Address Line 1" value="<?php echo (isset($_POST['Address1']) ? $_POST['Address1'] : "");?>">
                            <span class="errorstring" id="ErrAddress1"><?php echo isset($ErrAddress1)? $ErrAddress1 : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address2" name="Address2" Placeholder="Address Line 2" value="<?php echo (isset($_POST['Address2']) ? $_POST['Address2'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Address3" name="Address3" Placeholder="Address Line 3" value="<?php echo (isset($_POST['Address3']) ? $_POST['Address3'] : "");?>">
                          </div>
                        </div>
                      </div>
                      </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Adhaar Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="AadhaarCard" name="AadhaarCard" Placeholder="Aadhaar Number" value="<?php echo (isset($_POST['AadhaarCard']) ? $_POST['AadhaarCard'] : "");?>">
                            <span class="errorstring" id="ErrAadhaarCard"><?php echo isset($ErrAadhaarCard)? $ErrAadhaarCard : "";?> </span></div>
                            <div class="col-sm-3"></div>
                        </div>
                      </div> 
                   </div>
                   <div class="row">                                            
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Login Name<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" minlength="6"  class="form-control" id="UserName" name="UserName" Placeholder="Login Name" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : "");?>">
                            <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?> </span>
                          </div>
                         <label class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="Password" maxlength="8" class="form-control" id="Password" name="Password" Placeholder="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : "");?>">
                            <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?> </span></div>
                            <div class="col-sm-2"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
                        </div>
                      </div>
                      </div>                                                       
      </div>
  </div>
</div>         
<div class="col-12 grid-margin">
                  <div class="card">                                                             
                    <div class="card-body">                                                                            
                      <h4 class="card-title">Office Timing</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Days Name</label>
                          <label class="col-sm-6 col-form-label" style="text-align: center;">Working Hours</label>
                          <label class="col-sm-3 col-form-label">Is Holiday?</label>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Monday</label>
                          <div class="col-sm-6">
                          <select name="MonFH">
                            <option value="01" <?php echo ($MonFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($MonFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($MonFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($MonFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($MonFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($MonFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($MonFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($MonFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($MonFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($MonFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($MonFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($MonFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="MonFM">
                            <option value="00" <?php echo ($MonFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($MonFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($MonFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($MonFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($MonFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($MonFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($MonFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($MonFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($MonFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($MonFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($MonFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($MonFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($MonFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="MonFN">
                            <option value="AM" <?php echo ($MonFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($MonFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="MonTH">
                            <option value="01" <?php echo ($MonTH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($MonTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($MonTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($MonTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($MonTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($MonTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($MonTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($MonTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($MonTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($MonTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($MonTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($MonTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="MonTM">
                            <option value="00" <?php echo ($MonTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($MonTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($MonTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($MonTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($MonTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($MonTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($MonTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($MonTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($MonTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($MonTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($MonTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($MonTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($MonTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="MonTN">
                            <option value="AM" <?php echo ($MonTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($MonTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" style="padding-top: 2px;" class="form-control" id="Monday" name="Monday" value=""></div>
                      </div>
                                            <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tuesday</label>
                          <div class="col-sm-6">
                          <select name="TueFH">
                            <option value="01" <?php echo ($TueFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($TueFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($TueFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($TueFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($TueFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($TueFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($TueFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($TueFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($TueFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($TueFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($TueFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($TueFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="TueFM">
                            <option value="00" <?php echo ($TueFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($TueFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($TueFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($TueFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($TueFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($TueFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($TueFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($TueFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($TueFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($TueFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($TueFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($TueFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($TueFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="TueFN">
                            <option value="AM" <?php echo ($TueFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($TueFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="TueTH">
                            <option value="01" <?php echo ($TueTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($TueTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($TueTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($TueTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($TueTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($TueTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($TueTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($TueTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($TueTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($TueTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($TueTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($TueTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="TueTM">
                            <option value="00" <?php echo ($TueTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($TueTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($TueTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($TueTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($TueTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($TueTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($TueTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($TueTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($TueTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($TueTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($TueTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($TueTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($TueTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="TueTN">
                            <option value="AM" <?php echo ($TueTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($TueTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Tuesday" name="Tuesday" value=""></div>
                      </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Wednessday</label>
                          <div class="col-sm-6">
                          <select name="WedFH">
                            <option value="01" <?php echo ($WedFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($WedFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($WedFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($WedFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($WedFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($WedFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($WedFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($WedFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($WedFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($WedFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($WedFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($WedFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="WedFM">
                            <option value="00" <?php echo ($WedFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($WedFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($WedFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($WedFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($WedFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($WedFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($WedFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($WedFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($WedFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($WedFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($WedFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($WedFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($WedFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="WedFN">
                            <option value="AM" <?php echo ($WedFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($WedFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="WedTH">
                            <option value="01" <?php echo ($WedTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($WedTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($WedTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($WedTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($WedTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($WedTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($WedTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($WedTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($WedTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($WedTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($WedTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($WedTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="WedTM">
                            <option value="00" <?php echo ($WedTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($WedTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($WedTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($WedTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($WedTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($WedTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($WedTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($WedTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($WedTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($WedTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($WedTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($WedTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($WedTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="WedTN">
                            <option value="AM" <?php echo ($WedTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($WedTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Wednessday" name="Wednessday" value=""></div>
                      </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Thursday</label>
                          <div class="col-sm-6">
                          <select name="ThuFH">
                            <option value="01" <?php echo ($ThuFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($ThuFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($ThuFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($ThuFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($ThuFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($ThuFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($ThuFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($ThuFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($ThuFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($ThuFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($ThuFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($ThuFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="ThuFM">
                            <option value="00" <?php echo ($ThuFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($ThuFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($ThuFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($ThuFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($ThuFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($ThuFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($ThuFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($ThuFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($ThuFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($ThuFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($ThuFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($ThuFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($ThuFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="ThuFN">
                            <option value="AM" <?php echo ($ThuFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($ThuFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="ThuTH">
                            <option value="01" <?php echo ($ThuTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($ThuTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($ThuTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($ThuTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($ThuTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($ThuTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($ThuTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($ThuTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($ThuTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($ThuTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($ThuTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($ThuTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="ThuTM">
                            <option value="00" <?php echo ($ThuTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($ThuTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($ThuTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($ThuTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($ThuTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($ThuTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($ThuTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($ThuTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($ThuTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($ThuTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($ThuTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($ThuTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($ThuTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="ThuTN">
                            <option value="AM" <?php echo ($ThuTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($ThuTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Thursday" name="Thursday" value=""></div>
                      </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Friday</label>
                          <div class="col-sm-6">
                          <select name="FriFH">
                            <option value="01" <?php echo ($FriFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($FriFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($FriFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($FriFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($FriFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($FriFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($FriFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($FriFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($FriFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($FriFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($FriFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($FriFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="FriFM">
                            <option value="00" <?php echo ($FriFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($FriFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($FriFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($FriFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($FriFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($FriFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($FriFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($FriFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($FriFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($FriFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($FriFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($FriFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($FriFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="FriFN">
                            <option value="AM" <?php echo ($FriFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($FriFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="FriTH">
                            <option value="01" <?php echo ($FriTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($FriTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($FriTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($FriTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($FriTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($FriTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($FriTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($FriTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($FriTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($FriTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($FriTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($FriTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="FriTM">
                            <option value="00" <?php echo ($FriTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($FriTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($FriTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($FriTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($FriTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($FriTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($FriTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($FriTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($FriTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($FriTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($FriTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($FriTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($FriTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="FriTN">
                            <option value="AM" <?php echo ($FriTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($FriTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Friday" name="Friday" value=""></div>
                      </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Saturday</label>
                          <div class="col-sm-6">
                          <select name="SatFH">
                            <option value="01" <?php echo ($SatFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($SatFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($SatFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($SatFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($SatFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($SatFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($SatFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($SatFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($SatFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($SatFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($SatFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($SatFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="SatFM">
                            <option value="00" <?php echo ($SatFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($SatFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($SatFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($SatFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($SatFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($SatFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($SatFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($SatFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($SatFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($SatFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($SatFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($SatFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($SatFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="SatFN">
                            <option value="AM" <?php echo ($SatFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($SatFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="SatTH">
                            <option value="01" <?php echo ($SatTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($SatTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($SatTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($SatTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($SatTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($SatTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($SatTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($SatTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($SatTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($SatTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($SatTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($SatTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="SatTM">
                            <option value="00" <?php echo ($SatTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($SatTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($SatTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($SatTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($SatTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($SatTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($SatTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($SatTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($SatTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($SatTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($SatTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($SatTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($SatTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="SatTN">
                            <option value="AM" <?php echo ($SatTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($SatTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Saturday" name="Saturday" value=""></div>
                      </div>
                      
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sunday</label>
                          <div class="col-sm-6">
                          <select name="SunFH">
                            <option value="01" <?php echo ($SunFH=="01") ? ' selected="selected"' : '';?>>01</option>
                            <option value="02" <?php echo ($SunFH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($SunFH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($SunFH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($SunFH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($SunFH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($SunFH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($SunFH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($SunFH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($SunFH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($SunFH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($SunFH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="SunFM">
                            <option value="00" <?php echo ($SunFM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($SunFM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($SunFM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($SunFM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($SunFM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($SunFM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($SunFM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($SunFM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($SunFM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($SunFM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($SunFM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($SunFM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($SunFM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="SunFN">
                            <option value="AM" <?php echo ($SunFN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($SunFN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                          &nbsp;&nbsp;&nbsp;&nbsp;   <small>to</small> &nbsp;&nbsp;&nbsp;&nbsp; 
                          <select name="SunTH">
                            <option value="01" <?php echo ($SunTH=="01") ? ' selected="selected"' : '';?> >01</option>
                            <option value="02" <?php echo ($SunTH=="02") ? ' selected="selected"' : '';?>>02</option>
                            <option value="03" <?php echo ($SunTH=="03") ? ' selected="selected"' : '';?>>03</option>
                            <option value="04" <?php echo ($SunTH=="04") ? ' selected="selected"' : '';?>>04</option>
                            <option value="05" <?php echo ($SunTH=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="06" <?php echo ($SunTH=="06") ? ' selected="selected"' : '';?>>06</option>
                            <option value="07" <?php echo ($SunTH=="07") ? ' selected="selected"' : '';?>>07</option>
                            <option value="08" <?php echo ($SunTH=="08") ? ' selected="selected"' : '';?>>08</option>
                            <option value="09" <?php echo ($SunTH=="09") ? ' selected="selected"' : '';?>>09</option>
                            <option value="10" <?php echo ($SunTH=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="11" <?php echo ($SunTH=="11") ? ' selected="selected"' : '';?>>11</option>
                            <option value="12" <?php echo ($SunTH=="12") ? ' selected="selected"' : '';?>>12</option>
                          </select> 
                          
                          <select name="SunTM">
                            <option value="00" <?php echo ($SunTM=="00") ? ' selected="selected"' : '';?>>00</option>
                            <option value="05" <?php echo ($SunTM=="05") ? ' selected="selected"' : '';?>>05</option>
                            <option value="10" <?php echo ($SunTM=="10") ? ' selected="selected"' : '';?>>10</option>
                            <option value="15" <?php echo ($SunTM=="15") ? ' selected="selected"' : '';?>>15</option>
                            <option value="20" <?php echo ($SunTM=="20") ? ' selected="selected"' : '';?>>20</option>
                            <option value="25" <?php echo ($SunTM=="25") ? ' selected="selected"' : '';?>>25</option>
                            <option value="30" <?php echo ($SunTM=="30") ? ' selected="selected"' : '';?>>30</option>
                            <option value="35" <?php echo ($SunTM=="35") ? ' selected="selected"' : '';?>>35</option>
                            <option value="40" <?php echo ($SunTM=="40") ? ' selected="selected"' : '';?>>40</option>
                            <option value="45" <?php echo ($SunTM=="45") ? ' selected="selected"' : '';?>>45</option>
                            <option value="50" <?php echo ($SunTM=="50") ? ' selected="selected"' : '';?>>50</option>
                            <option value="55" <?php echo ($SunTM=="55") ? ' selected="selected"' : '';?>>55</option>
                            <option value="60" <?php echo ($SunTM=="60") ? ' selected="selected"' : '';?>>60</option>
                          </select>
                          
                          <select name="SunTN">
                            <option value="AM" <?php echo ($SunTN=="AM") ? ' selected="selected"' : '';?>>AM</option>
                            <option value="PM" <?php echo ($SunTN=="PM") ? ' selected="selected"' : '';?>>PM</option>
                          </select>
                           </div>
                         <div class="col-sm-1"><input type="checkbox" class="form-control" id="Sunday" name="Sunday" value=""></div>
                      </div>
                    <div class="form-group row">
                        <div class="col-sm-3"><button type="submit" class="btn btn-primary" name="BtnSaveCreate">Create Franchisee</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="MangeFranchisees"><small>List of Franchisees</small> </a></div>
                      </div>
                    </div> 
               </div>
 </div>    
</form>