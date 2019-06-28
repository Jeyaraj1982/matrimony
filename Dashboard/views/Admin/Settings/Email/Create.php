<?php
/*if (isset($_POST['BtnSaveApi'])) {
         
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
        
        if (isset($_POST['HostName'])) {
            
            if (strlen(trim($_POST['HostName']))>0) {
            
            } else {
                $ErrHostName="Please enter Host Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrHostName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['PortNo'])) {
            
            if (strlen(trim($_POST['PortNo']))>0) {
            
            } else {
                $ErrPortNo="Please enter Port No";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrPortNo="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['Secure'])) {
            
            if (strlen(trim($_POST['Secure']))>0) {
            
            } else {
                $ErrPortNo="Please enter Secure";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrSecure="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['UserName'])) {
            
            if (strlen(trim($_POST['UserName']))>0) {
            
            } else {
                $ErrUserName="Please enter User Name";    
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
        
        if (isset($_POST['SendersName'])) {
            
            if (strlen(trim($_POST['SendersName']))>0) {
            
            } else {
                $ErrSendersName="Please enter Senders Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrSendersName="Param Missing";    
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
        
            
        
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where ApiCode='".trim($_POST['ApiCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrApiCode="Api Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where ApiName='".trim($_POST['ApiName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrApiName="Api Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where HostName='".trim($_POST['HostName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrHostName="Host Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where PortNumber='".trim($_POST['PortNo'])."'");
        if (sizeof($duplicate)>0) {
             $ErrPortNumber="Port Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where UserName='".trim($_POST['UserName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrUserName="User Name Already Exists";    
             $ErrorCount++;
        }
                                       
        
  if ($ErrorCount==0) {

$EmailApi = $mysql->insert("_tbl_settings_emailapi",array("ApiCode"     => $_POST['ApiCode'],
                                                          "ApiName"     => $_POST['ApiName'],
                                                          "HostName"    => $_POST['HostName'],
                                                          "PortNumber"  => $_POST['PortNo'],
                                                          "Secure"      => $_POST['Secure'],
                                                          "SMTPUserName"    => $_POST['UserName'],
                                                          "SMTPPassword"    => $_POST['Password'],
                                                          "SendersName" => $_POST['SendersName'],
                                                          "CreatedOn"   => date("Y-m-d H:i:s"),
                                                          "Remarks"     => $_POST['Remarks']));
                                                              
        if ($EmailApi>0) {
            echo "Successfully Created ";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Bank Details";
        }
          
    }
    }*/
?>
<script>
$(document).ready(function () {
$("#ApiCode").blur(function () {
    
        IsNonEmpty("ApiCode","ErrApiCode","Please Enter Api Code");
                        
   });
   $("#ApiName").blur(function () {
    
        IsNonEmpty("ApiName","ErrApiName","Please Enter Api Name");
                        
   });
   $("#HostName").blur(function () {
    
        IsNonEmpty("HostName","ErrHostName","Please Enter Host Name");
                        
   });
   $("#PortNo").blur(function () {
    
        IsNonEmpty("PortNo","ErrPortNo","Please Enter Port No");
                        
   });
   $("#Secure").blur(function () {
    
        IsNonEmpty("Secure","ErrSecure","Please Select Secure");
                        
   });
   $("#UserName").blur(function () {
    
        IsLogin("UserName","ErrUserName","Please Enter UserName");
                        
   }); 
   $("#Password").blur(function () {
    
        IsPassword("Password","ErrPassword","Please Enter Password");
                        
   });
   $("#SendersName").blur(function () {
    
        IsNonEmpty("SendersName","ErrSendersName","Please Enter Sender's Name");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
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

function SubmitNewApi() {
                         $('#ErrApiCode').html("");
                         $('#ErrApiName').html("");
                         $('#ErrHostName').html("");
                         $('#ErrPortNo').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         $('#ErrSendersName').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("ApiCode","ErrApiCode","Please Enter Api Code")) {
                        IsAlphaNumeric("ApiCode","ErrApiCode","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("ApiName","ErrApiName","Please Enter Api Name")) {
                        IsAlphabet("ApiName","ErrApiName","Please Enter Alpha Numeric characters only");
                        }
                        IsNonEmpty("HostName","ErrHostName","Please Enter Host Name");
                        IsNonEmpty("PortNo","ErrPortNo","Please Enter Port No");
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter the user name")) {
                        //IsEmail("UserName","ErrUserName","Please Enter Valid ");
                        }
                        if (IsPassword("Password","ErrPassword","Please Enter More than 8 characters")) {
                        IsAlphaNumeric("Password","ErrPassword","Alpha Numeric Characters only");
                        }
                        IsNonEmpty("SendersName","ErrSendersName","Please Enter Senders Name");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>                                                         
<?php                   
  if (isset($_POST['BtnSaveApi'])) {   
    $response = $webservice->CreateEmailApi($_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
  $EInfo = $webservice->GetEmailApiCode(); 
     $EmailApiCode="";
        if ($EInfo['status']=="success") {
            $EmailApiCode  =$EInfo['data']['EmailApiCode'];
        }
        {
?>

<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Email Api</h4>
                </div>
              </div>
</div>

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
                            <input type="text" value="<?php echo isset($_POST['ApiCode']) ? $_POST['ApiCode'] : $EmailApiCode;?>" class="form-control" id="ApiCode" name="ApiCode" maxlength="7">
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
                          <label class="col-sm-2 col-form-label">Host Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="HostName" name="HostName" value="<?php echo (isset($_POST['HostName']) ? $_POST['HostName'] : "");?>">
                            <span class="errorstring" id="ErrHostName"><?php echo isset($ErrHostName)? $ErrHostName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Port No<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="PortNo" name="PortNo" value="<?php echo (isset($_POST['PortNo']) ? $_POST['PortNo'] : "");?>">
                            <span class="errorstring" id="ErrPortNo"><?php echo isset($ErrPortNo)? $ErrPortNo : "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Secure<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <select class="form-control" id="Secure"  name="Secure">
                             <?php foreach($EInfo['data']['Secure'] as $Secure) { ?>
                                <option value="<?php echo $Secure['CodeValue'];?>" <?php echo ($Secure[ 'CodeValue']==$_POST[ 'Secure']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $Secure['CodeValue'];?>
                                </option>
                                <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrSecure"><?php echo isset($ErrSecure)? $ErrSecure : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">User Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : "");?>">
                            <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Password<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="Password" name="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : "");?>">
                            <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Sender's Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="SendersName" name="SendersName" value="<?php echo (isset($_POST['SendersName']) ? $_POST['SendersName'] : "");?>">
                            <span class="errorstring" id="ErrSendersName"><?php echo isset($ErrSendersName)? $ErrSendersName : "";?></span>
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
                        <div class="col-sm-12"><?php echo $errormessage;?><?php echo $successmessage;?></div>
                   </div>
                    <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSaveApi" class="btn btn-primary mr-2">Save</button></div>
                        <div class="col-sm-2"><a href="EmailApi" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>                                                  
<?php }?>