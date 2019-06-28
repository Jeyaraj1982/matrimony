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
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter the character greater than 6 character and less than 9 character")) {
                        //IsAlphabet("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsPassword("Password","ErrPassword","Please Enter More than 8 characters")) {
                        //IsAlphaNumeric("Password","ErrPassword","Alpha Numeric Characters only");
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
    if (isset($_POST['Btnupdate'])) {
        
        $response = $webservice->EditEmailApi($_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->GetEmailApiInfo();
    $Api          = $response['data']['Api'];

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
                  <h4 class="card-title">Edit Api</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Api Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" disabled="disabled" id="ApiCode" name="ApiCode" maxlength="6" value="<?php echo (isset($_POST['ApiCode']) ? $_POST['ApiCode'] : $Api['ApiCode']);?>">
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
                            <input type="text" class="form-control" id="ApiName" name="ApiName" value="<?php echo (isset($_POST['ApiName']) ? $_POST['ApiName'] : $Api['ApiName']);?>">
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
                            <input type="text" class="form-control" id="HostName" name="HostName" value="<?php echo (isset($_POST['HostName']) ? $_POST['HostName'] : $Api['HostName']);?>">
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
                            <input type="text" class="form-control" id="PortNo" name="PortNo" value="<?php echo (isset($_POST['PortNo']) ? $_POST['PortNo'] : $Api['PortNumber']);?>">
                            <span class="errorstring" id="ErrPortNo"><?php echo isset($ErrPortNo)? $ErrPortNo : "";?></span>
                          </div>
                          <label class="col-sm-2 col-form-label">Secure<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <select class="form-control" id="Secure"  name="Secure">
                             <?php foreach($response['data']['Secure'] as $Secure) { ?>
                                <option value="<?php echo $Secure['CodeValue'];?>" <?php echo (isset($_POST[ 'Secure'])) ? (($_POST[ 'Secure']==$Secure[ 'CodeValue']) ? " selected='selected' " : "") : (($Api[ 'Secure']==$Secure[ 'CodeValue']) ? " selected='selected' " : "");?> >
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
                            <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo (isset($_POST['UserName']) ? $_POST['UserName'] : $Api['SMTPUserName']);?>">
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
                            <input type="text" class="form-control" id="Password" name="Password" value="<?php echo (isset($_POST['Password']) ? $_POST['Password'] : $Api['SMTPPassword']);?>">
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
                            <input type="text" class="form-control" id="SendersName" name="SendersName" value="<?php echo (isset($_POST['SendersName']) ? $_POST['SendersName'] : $Api['SendersName']);?>">
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
                            <textarea  rows="2" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Api['Remarks']);?></textarea>
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
                                    <option value="1" <?php echo ($Api['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Api['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                          <label class="col-sm-2 col-form-label">Created On<span id="star">*</span></label>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Api['CreatedOn']);?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12"><?php echo $errormessage;?><?php echo $successmessage;?></div>
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
