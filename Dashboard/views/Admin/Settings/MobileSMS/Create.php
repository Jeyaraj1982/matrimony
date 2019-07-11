
<script>
$(document).ready(function () {
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
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber Param");
                        
   });
   $("#MessageText").blur(function () {
    
        IsNonEmpty("MessageText","ErrMessageText","Please Enter Message Text Param");
                        
   });
});       
function SubmitNewApi() {
                         $('#ErrApiCode').html("");
                         $('#ErrApiName').html("");
                         $('#ErrApiUrl').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrMessageText').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("ApiCode","ErrApiCode","Please Enter Api Code")) {
                        IsAlphaNumeric("ApiCode","ErrApiCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("ApiName","ErrApiName","Please Enter Api Name")) {
                        IsAlphabet("ApiName","ErrApiName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("ApiUrl","ErrApiUrl","Please Enter Api Url");
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number Param")) {
                        IsAlphaNumerics("MobileNumber","ErrMobileNumber","Please Enter Alpha Numeric Characters");
                        }
                        if (IsNonEmpty("MessageText","ErrMessageText","Please Enter Message Text Param")){
                        IsAlphaNumerics("MessageText","ErrMessageText","Please Enter Alpha Numeric Characters");
                        }
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
  $MobileSmsCode =$webservice->getData("Admin","GetSettingsMobileApiCode"); 
     $GetNextMobileSMSNumber="";
        if ($MobileSmsCode['status']=="success") {
            $GetNextMobileSMSNumber  =$MobileSmsCode['data']['MobileApiCode'];
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
                            <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>">
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
                              <?php foreach($MobileSmsCode['data']['SMSMethod'] as $Method) { ?>
                              <option value="<?php echo $Method['CodeValue'];?>" <?php echo ($_POST['Method']==$Method['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $Method['CodeValue'];?></option>
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
                             <?php foreach($MobileSmsCode['data']['Timedout'] as $TimedOut) { ?>
                              <option value="<?php echo $TimedOut['CodeValue'];?>" <?php echo ($_POST['TimedOut']==$TimedOut['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $TimedOut['CodeValue'];?></option>
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
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSaveSms" class="btn btn-primary mr-2">Save</button></div>
                        <div class="col-sm-2"><a href="MobileSms" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>
<?Php }?>                                                  
 