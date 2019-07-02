<?php 
 if (isset($_POST['Btnupdate'])) {
       $ErrorCount =0;
       $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiCode='".trim($_POST['ApiCode'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrApiCode="Api Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiName='".trim($_POST['ApiName'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrApiName="Api Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where ApiUrl='".trim($_POST['ApiUrl'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrApiUrl="Api Url Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_mobilesms where MobileNumber='".trim($_POST['MobileNumber'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
       $Api =$mysql->select("select * from _tbl_settings_mobilesms where ApiID='".$_REQUEST['Code']."'");
         
            if (sizeof($Api)==0) {
            echo "Error: Access denied. Please contact administrator";
             } else {
        

                 
  if ($ErrorCount==0) {
               
    $mysql->execute("update _tbl_settings_mobilesms set ApiName='".$_POST['ApiName']."',
                                                        ApiUrl='".$_POST['ApiUrl']."',
                                                        MobileNumber='".$_POST['MobileNumber']."',
                                                        MessageText='".$_POST['MessageText']."',
                                                        Method='".$_POST['Method']."',
                                                        TimedOut='".$_POST['TimedOut']."',
                                                        Remarks='".$_POST['Remarks']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  ApiID='".$_REQUEST['Code']."'"); 
                                                        
                                                             
            unset($_POST);
               echo "Updated Successfully";
            
        } else {
            echo "Error occured. Couldn't save Franchise Details";
        }
          
 
    
    }
    }
    $Api =$mysql->select("select * from _tbl_settings_mobilesms where ApiID='".$_REQUEST['Code']."'");

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
    
        IsNonEmpty("ApiUrl","ErrApiUrl","Please Select a Api Url");
                        
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

<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mail Api</h4>
                </div>
              </div>
</div>


<form method="post" action="" onsubmit="return SubmitNewApi();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Api</h4>                           
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" value="<?php echo (isset($_POST['ApiCode']) ? $_POST['ApiCode'] : $Api[0]['ApiCode']);?>" class="form-control" id="ApiCode" name="ApiCode" maxlength="6">
                            <span class="errorstring"  id="ErrApiCode"><?php echo isset($ErrApiCode)? $ErrApiCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="ApiName" name="ApiName" value="<?php echo (isset($_POST['ApiName']) ? $_POST['ApiName'] : $Api[0]['ApiName']);?>">
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
                            <input type="text" class="form-control" id="ApiUrl" name="ApiUrl" value="<?php echo (isset($_POST['ApiUrl']) ? $_POST['ApiUrl'] : $Api[0]['ApiUrl']);?>">
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
                            <input type="text" class="form-control" id="MobileNumber" maxlength="10" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Api[0]['MobileNumber']);?>">
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
                            <input type="text" class="form-control" id="MessageText" name="MessageText" value="<?php echo (isset($_POST['MessageText']) ? $_POST['MessageText'] : $Api[0]['MessageText']);?>">
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
                           <select class="form-control" id="Method"  name="Method" >
                           <?php $Methods = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMSMETHOD'");  ?>
                              <?php foreach($Methods as $Method) { ?>
                              <option value="<?php echo $Method['CodeValue'];?>" <?php echo ($Api[0]['Method']==$Method['CodeValue']) ? " selected='selected' " : "";?> ><?php echo $Method['CodeValue'];?></option>
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
                             <select class="form-control" id="TimedOut"  name="TimedOut" >
                             <?php $TimedOuts = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TIMEDOUT'");  ?>
                              <?php foreach($TimedOuts as $TimedOut) { ?>
                               <option value="<?php echo $TimedOut['CodeValue'];?>" <?php echo ($Api[0]['TimedOut']==$TimedOut['CodeValue']) ? " selected='selected' " : "";?> ><?php echo $TimedOut['CodeValue'];?></option>
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
                            <textarea  rows="2" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Api[0]['Remarks']);?></textarea>
                            <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;" >
                                    <option value="1" <?php echo ($Api[0]['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Api[0]['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Created On<span id="star">*</span></label>
                          <div class="col-sm-3"><?php echo putDateTime($Api['CreatedOn']);?></div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="Btnupdate" class="btn btn-primary mr-2">Update</button></div>
                        <div class="col-sm-2"><a href="../MobileSms" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>                                                  