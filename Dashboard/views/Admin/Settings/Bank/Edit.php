
  <script>

$(document).ready(function () {
    $("#AccountNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAccountNumber").html("Digits Only").show().fadeIn("fast");
               return false;
    }
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

});

function SubmitNewBank() { 
                         $('#ErrAccountName').html("");
                         $('#ErrAccountNumber').html("");
                         $('#ErrIFSCode').html("");
                                                 
                         ErrorCount=0;
                         
                        if (IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name")) {
                        IsAlphabet("AccountName","ErrAccountName","Please Enter Alpha Numeric Characters only");
                        }
                        IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
                        if (IsNonEmpty("IFSCode","ErrIFSCode","Please Enter Valid IFSCode")) {
                        IsAlphaNumeric("IFSCode","ErrIFSCode","Please Enter Alpha Numeric Characters only");
                        }
                         if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 }
</script> 
<?php   
    if (isset($_POST['BtnUpdate'])) {
        
        $response = $webservice->getData("Admin","EditBankDetails",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->getData("Admin","BankDetailsForView");
    $BankName = $response['data']['BankName'];
     $Bank    = $response['data']['ViewBankDetails'];

 ?>  
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bank Account Details</h4>
                </div>
              </div>
</div>
                              
<form method="post" action="" onsubmit="return SubmitNewBank();">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Bank Account Details</h4>
                   <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <select class="form-control" id="BankName"  name="BankName" >
                           <?php foreach($BankName as $BankName) { ?>
                                <option value="<?php echo $BankName['CodeValue'];?>" <?php echo (isset($_POST[ 'BankName'])) ? (($_POST[ 'BankName']==$BankName[ 'CodeValue']) ? " selected='selected' " : "") : (($Bank[ 'BankName']==$BankName[ 'CodeValue']) ? " selected='selected' " : "");?> >
                                    <?php echo $BankName['CodeValue'];?>
                                </option>

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
                            <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="<?php echo (isset($_POST['AccountName']) ? $_POST['AccountName'] : $Bank['AccountName']);?>">
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
                            <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="<?php echo (isset($_POST['AccountNumber']) ? $_POST['AccountNumber'] : $Bank['AccountNumber']);?>">
                            <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : $Bank['IFSCode']);?>">
                            <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;" >
                                    <option value="1" <?php echo ($Bank['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Bank['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                        </div>
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                        <?php echo $errormessage;?><?php echo $successmessage;?>
                        </div>
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" class="btn btn-primary" name="BtnUpdate">Update Bank</button></div>
                        <div class="col-sm-2"><a href="../ListofBanks" style="text-decoration: underline;">List of Bank</a></div>
                      </div>
                      </div>
                   </div>
                  </form>
              </div>
       </div>
</div>
</form>

