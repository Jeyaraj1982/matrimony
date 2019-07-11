<?php
if (isset($_POST['BtnSaveSms'])) {
         
        $ErrorCount =0;
        
        if (isset($_POST['ApiCode'])) {
            
            if (strlen(trim($_POST['ApiCode']))>0) {
            
            } else {
                $ErrApiCode="Please enter Api Code";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrApiCode="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['ApiName'])) {
            
            if (strlen(trim($_POST['ApiName']))>0) {
            
            } else {
                $ErrApiName="Please enter Api Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrApiName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['ApiUrl'])) {
            
            if (strlen(trim($_POST['ApiUrl']))>0) {
            
            } else {
                $ErrApiUrl="Please enter Api Url";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrApiUrl="Param Missing";    
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
        
        if (isset($_POST['MessageText'])) {
            
            if (strlen(trim($_POST['MessageText']))>0) {
            
            } else {
                $ErrMessageText="Please enter Message Text";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrMessageText="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['Method'])) {
            
            if (strlen(trim($_POST['Method']))>0) {
            
            } else {
                $ErrMethod="Please enter Method";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrMethod="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['TimedOut'])) {
            
            if (strlen(trim($_POST['TimedOut']))>0) {
            
            } else {
                $ErrTimedOut="Please enter Timed Out";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrTimedOut="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['Remarks'])) {
            
            if (strlen(trim($_POST['Remarks']))>0) {
            
            } else {
                $ErrRemarks="Please enter Remarks";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrRemarks="Param Missing";    
            $ErrorCount++;  
        }
        
            
        
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiCode='".trim($_POST['ApiCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrApiCode="Api Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiName='".trim($_POST['ApiName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrApiName="Api Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiUrl='".trim($_POST['ApiUrl'])."'");
        if (sizeof($duplicate)>0) {
             $ErrApiUrl="Api Url Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
               
        
  if ($ErrorCount==0) {

$MobileSms = $mysql->insert("_tbl_settings_mobilesms",array("ApiCode"      => $_POST['ApiCode'],
                                                          "ApiName"      => $_POST['ApiName'],
                                                          "ApiUrl"       => $_POST['ApiUrl'],
                                                          "MobileNumber" => $_POST['MobileNumber'],
                                                          "MessageText"  => $_POST['MessageText'],
                                                          "Method"       => $_POST['Method'],
                                                          "TimedOut"     => $_POST['TimedOut'],
                                                          "CreatedOn"   => date("Y-m-d H:i:s"),
                                                          "Remarks"      => $_POST['Remarks']));
                                                              
        if ($MobileSms>0) {
            echo "Successfully Created ";
            unset($_POST);                                              
        } else {
            echo "Error occured. Couldn't save Bank Details";
        }
          
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
   $("#ApiCode").blur(function () {
    
        IsNonEmpty("ApiCode","ErrApiCode","Please Enter Api Code");
                        
   });
   $("#ApiName").blur(function () {
    
        IsNonEmpty("ApiName","ErrApiName","Please Enter Api Name");
                        
   });
   $("#ApiUrl").blur(function () {
    
        IsNonEmpty("ApiUrl","ErrApiUrl","Please Enter a Api Url");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber");
                        
   });
   $("#MessageText").blur(function () {
    
        IsNonEmpty("MessageText","ErrMessageText","Please Enter Message Text");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
});       
function SubmitNewApi() {
                         $('#ErrApiCode').html("");
                         $('#ErrApiName').html("");
                         $('#ErrApiUrl').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrMessageText').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("ApiCode","ErrApiCode","Please Enter Api Code")) {
                        IsAlphaNumeric("ApiCode","ErrApiCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("ApiName","ErrApiName","Please Enter Api Name")) {
                        IsAlphabet("ApiName","ErrApiName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("ApiUrl","ErrApiUrl","Please Enter Api Url");
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        IsNonEmpty("MessageText","ErrMessageText","Please Enter Message Text");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>                                                         



<?php                   
  if (isset($_POST['BtnSaveSms'])) {   
    $response = $webservice->getData("Admin","CreateSettingsMobileSms",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
  $MobileSmsCode =$webservice->getData("Admin","GetMobileSmsCode"); 
     $GetNextMobileSMSNumber="";
        if ($MobileSmsCode['status']=="success") {
            $GetNextMobileSMSNumber  =$MobileSmsCode['data']['MobileCode'];
        }
        {
?>   
<form method="post" action="" onsubmit="return SubmitNewApi();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Api</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" value="<?php echo isset($_POST['ApiCode']) ? $_POST['ApiCode'] : $GetNextMobileSMSNumber;?>" class="form-control" id="ApiCode" name="ApiCode" maxlength="7">
                            <span class="errorstring" id="ErrApiCode"><?php echo isset($ErrApiCode)? $ErrApiCode : "";?></span>
                          </div>
                        </div>                                                                                                                        
                      </div>
                      </div>
                    <div class="row">                                                                                                                                
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="ApiName" name="ApiName" value="<?php echo (isset($_POST['ApiName']) ? $_POST['ApiName'] : "");?>">
                            <span class="errorstring" id="ErrApiName"><?php echo isset($ErrApiName)? $ErrApiName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Url<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="ApiUrl" name="ApiUrl" value="<?php echo (isset($_POST['ApiUrl']) ? $_POST['ApiUrl'] : "");?>">
                            <span class="errorstring" id="ErrApiUrl"><?php echo isset($ErrApiUrl)? $ErrApiUrl : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h4 class="card-title">Manage param</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Description</label>
                          <label class="col-sm-2 col-form-label">Param Name</label>
                         
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="MobileNumber" maxlength="10" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
                            <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Message Text<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="MessageText" name="MessageText" value="<?php echo (isset($_POST['MessageText']) ? $_POST['MessageText'] : "");?>">
                            <span class="errorstring" id="ErrMessageText"><?php echo isset($ErrMessageText)? $ErrMessageText : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Method<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <select name="Method" id="Method" class="form-control">
                              <?php $Methods = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMSMETHOD'");  ?>
                              <?php foreach($Methods as $Method) { ?>
                              <option value="<?php echo $Method['CodeValue'];?>" <?php echo ($_POST['Method']==$Method['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Method['CodeValue'];?></option>
                             <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrMethod"><?php echo isset($ErrMethod)? $ErrMethod : "";?></span>
                          </div>
                        </div>
                      </div>                                          
                    </div> 
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Time out<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <select name="TimedOut" id="TimedOut" class="form-control">
                                    <?php $TimedOuts = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TIMEDOUT'");  ?>
                              <?php foreach($TimedOuts as $TimedOut) { ?>
                              <option value="<?php echo $TimedOut['CodeValue'];?>" <?php echo ($_POST['TimedOut']==$TimedOut['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $TimedOut['CodeValue'];?></option>
                             <?php } ?>
                            </select>  
                            <span class="errorstring" id="ErrTimedOut"><?php echo isset($ErrTimedOut)? $ErrTimedOut : "";?></span>
                           </div>
                        </div>
                      </div>                                          
                    </div> 
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Remarks<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <textarea  rows="2" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : "");?></textarea>
                            <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSaveSms" class="btn btn-primary mr-2">Save</button></div>
                        <div class="col-sm-2"><a href="MobileSms" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>                                                  
 