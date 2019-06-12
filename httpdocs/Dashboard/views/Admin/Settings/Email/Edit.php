<?php 
 if (isset($_POST['Btnupdate'])) {
        
        $ErrorCount =0;
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where ApiCode='".trim($_POST['ApiCode'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrApiCode="Api Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where ApiName='".trim($_POST['ApiName'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrApiName="Api Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where HostName='".trim($_POST['HostName'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrHostName="Host Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where PortNumber='".trim($_POST['PortNo'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrPortNo="Port Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from _tbl_settings_emailapi where UserName='".trim($_POST['UserName'])."'and ApiID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrUserName="User Name Already Exists";    
             $ErrorCount++;
        }
        
         $Api =$mysql->select("select * from _tbl_settings_emailapi where ApiID='".$_REQUEST['Code']."'");
         
            if (sizeof($Api)==0) {
            echo "Error: Access denied. Please contact administrator";
             } else {
        

                 
  if ($ErrorCount==0) {
               
    $mysql->execute("update _tbl_settings_emailapi set ApiName='".$_POST['ApiName']."',
                                                        HostName='".$_POST['HostName']."',
                                                        PortNumber='".$_POST['PortNo']."',
                                                        Secure='".$_POST['Secure']."',
                                                        UserName='".$_POST['UserName']."',
                                                        Password='".$_POST['Password']."',
                                                        SendersName='".$_POST['SendersName']."',
                                                        Remarks='".$_POST['Remarks']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  ApiID='".$_REQUEST['Code']."'"); 
                                                              
            unset($_POST);
               echo "Updated Successfully";
            
        } else {
            echo "Error occured. Couldn't save";
        }
          
 
    
    }
    }
    $Api =$mysql->select("select * from _tbl_settings_emailapi where ApiID='".$_REQUEST['Code']."'");

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
    
        IsNonEmpty("UserName","ErrUserName","Please Enter User Name");
                        
   }); 
   $("#Password").blur(function () {
    
        IsNonEmpty("Password","ErrPassword","Please Enter Password");
                        
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
                        if (IsLogin("UserName","ErrUserName","Please Enter the character greater than 6 character and less than 9 character")) {
                        IsAlphabet("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
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
                  <h4 class="card-title">Edit Api</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" disabled="disabled" id="ApiCode" name="ApiCode" maxlength="6" value="<?php echo (isset($_POST['ApiCode']) ? $_POST['ApiCode'] : $Api[0]['ApiCode']);?>">
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
                            <input type="text" class="form-control" id="ApiName" name="ApiName" value="<?php echo (isset($_POST['ApiName']) ? $_POST['ApiName'] : $Api[0]['ApiName']);?>">
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
                            <input type="text" class="form-control" id="HostName" name="HostName" value="<?php echo (isset($_POST['HostName']) ? $_POST['HostName'] : $Api[0]['HostName']);?>">
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
                            <input type="text" class="form-control" id="PortNo" name="PortNo" value="<?php echo (isset($_POST['PortNo']) ? $_POST['PortNo'] : $Api[0]['PortNumber']);?>">
                            <span class="errorstring" id="ErrPortNo"><?php echo isset($ErrPortNo)? $ErrPortNo : "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Secure<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <select class="form-control" id="Secure"  name="Secure">
                             <?php $Secures = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SECURE'");  ?>
                              <?php foreach($Secures as $Secure) { ?>
                              <option value="<?php echo $Secure['CodeValue'];?>" <?php echo ($Api[0]['Secure']==$Secure['CodeValue']) ? " selected='selected' " : "";?> ><?php echo $Secure['CodeValue'];?></option>
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
                            <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : $Api[0]['UserName']);?>">
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
                            <input type="text" class="form-control" id="Password" name="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : $Api[0]['Password']);?>">
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
                            <input type="text" class="form-control" id="SendersName" name="SendersName" value="<?php echo (isset($_POST['SendersName']) ? $_POST['SendersName'] : $Api[0]['SendersName']);?>">
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
                          <label class="col-sm-2 col-form-label">Created On<span id="star">*</span></label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Api[0]['CreatedOn']);?></small></div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="Btnupdate" class="btn btn-primary mr-2">Update</button></div>
                        <div class="col-sm-2"><a href="../EmailApi" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>                                             
</div>
</form>                                                  
