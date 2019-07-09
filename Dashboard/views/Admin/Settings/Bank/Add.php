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
  if (isset($_POST['BtnSaveCreate'])) {
    $response = $webservice->getData("Admin","CreateBank",$_POST);   
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
   $Bank = $webservice->getData("Admin","GetBank");
?>
<form method="post" action="" onsubmit="return SubmitNewBank();">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bank Account Details</h4>
                   <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <select class="form-control" id="BankName"  name="BankName" >
                          <?php foreach($Bank['data']['BankName'] as $BankName) { ?>
                                <option value="<?php echo $BankName['SoftCode'];?>" <?php echo ($BankName[ 'SoftCode']==$_POST[ 'BankName']) ? ' selected="selected" ' : '';?>>
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
                          <div class="col-sm-9">
                            <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : "");?>">
                            <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12"><?php echo $errormessage ;?><?php echo $successmessage;?></div>
                        </div>
                      <div class="row">
                      <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" class="btn btn-success" name="BtnSaveCreate">Add Bank</button></div>
                        <div class="col-sm-2"><a href="ListofBanks" style="text-decoration: underline;">List of Bank</a></div>
                      </div>
                      </div>
                   </div>
                  </form>
              </div>
       </div>
</div>
</form>
