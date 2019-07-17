<?php
    if (isset($_POST['BtnRefillWallet'])) {
    $response =$webservice->getData("Franchisee","RefillWallet",$_POST);
    if ($response['status']=="success") {
          $Successmessage = $response['message']; 
    } else {
        $errormessage = $response['message']; 
    }
    }
    $res =$webservice->getData("Franchisee","GetRefillWalletBankNameAndMode");
    $BankNames=$res['data']['BankName'];
?>
<script>

$(document).ready(function () {
    $("#RefillAmount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrRefillAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    $("#RefillAmount").blur(function () {
    
        IsNonEmpty("RefillAmount","ErrRefillAmount","Please Enter Refill Amount");
                        
   });
   $("#BankName").blur(function () {
    
        IsNonEmpty("BankName","ErrBankName","Please Enter Bank Name");
                        
   });
   $("#DateofBirth").blur(function () {
    
        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        
   });
   $("#TransferedOn").blur(function () {
    
        IsNonEmpty("TransferedOn","ErrTransferedOn","Please Enter Transfered On");
                        
   });
   $("#DateofBirth").blur(function () {
    
        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        
   });
   $("#TransactionID").blur(function () {
    
        IsNonEmpty("TransactionID","ErrTransactionID","Please Enter Transaction ID");
                        
   });
   $("#TransferMode").blur(function () {
    
        IsNonEmpty("TransferMode","ErrTransferMode","Please Enter Transfer Mode");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
});
function SubmitRefillWallet() {
                         $('#ErrRefillAmount').html("");
                         $('#ErrBankName').html("");
                         $('#ErrDateofBirth').html("");
                         $('#ErrTransferedOn').html("");
                         $('#ErrTransactionID').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("RefillAmount","ErrRefillAmount","Please Enter Refill Amount");
                        IsNonEmpty("BankName","ErrBankName","Please Enter Bank Name");
                        IsNonEmpty("DateofBirth","ErrDateofBirth","Please Enter Date of Birth");
                        IsNonEmpty("TransferedOn","ErrTransferedOn","Please Enter Transfered On");
                        if(IsNonEmpty("TransactionID","ErrTransactionID","Please Enter Transaction ID")) {
                        IsAlphaNumeric("TransactionID","ErrTransactionID","Please Enter Alpha Numerics Character only");
                        }
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
                        
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 
  }
</script>

<form method="post" action="" onsubmit="return SubmitRefillWallet();">
        <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Refill Wallet</h4>
                      <h5 class="card-title" style="color: #999999;">Refill Wallet Request Form</h5>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3">Refill Amount </div>
                          <div class="col-sm-3">
                          <div class="input-group">
                          <div class="input-group-addon">Rs</div>
                            <input type="text" class="form-control" id="RefillAmount" name="RefillAmount" value="<?php echo (isset($_POST['RefillAmount']) ? $_POST['RefillAmount'] : "");?>"  placeholder="Refill Amount">
                            </div>
                            <span class="errorstring" id="ErrRefillAmount"><?php echo isset($ErrRefillAmount)? $ErrRefillAmount : "";?></span>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">Transfer to</div>
                          <div class="col-sm-3">
                          <select class="form-control" id="BankName"  name="BankName" >
                          <?php foreach($BankNames as $BankName) { ?>
                                <option value="<?php echo $BankName['BankName'];?>" <?php echo ($BankName[ 'BankName']==$_POST[ 'BankName']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $BankName['BankName'];?>
                                </option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                          </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-sm-3">Transfered On</div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="TransferedOn" name="TransferedOn" value="<?php echo (isset($_POST['TransferedOn']) ? $_POST['TransferedOn'] : "");?>"  placeholder="Transfered On">
                            <span class="errorstring" id="ErrTransferedOn"><?php echo isset($ErrTransferedOn)? $ErrTransferedOn : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <div class="col-sm-3">Date of Birth</div>
                          <div class="col-sm-3">
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>"  placeholder="Date of Birth"  style="line-height:15px !important">
                            <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3">Transaction ID</div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="TransactionID" name="TransactionID" value="<?php echo (isset($_POST['TransactionID']) ? $_POST['TransactionID'] : "");?>"  placeholder="Transaction ID">
                            <span class="errorstring" id="ErrTransactionID"><?php echo isset($ErrTransactionID)? $ErrTransactionID : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                        <div class="col-sm-3">Mode of Transfer</div>
                          <div class="col-sm-3">
                          <select class="form-control" id="TransferMode"  name="TransferMode" >
                          <?php foreach($response['data']['ModeOfTransfer'] as $Transfer) { ?>
                                <option value="<?php echo $Transfer['SoftCode'];?>" <?php echo ($Transfer[ 'SoftCode']==$_POST[ 'TransferMode']) ? ' selected="selected" ' : '';?>>
                                    <?php echo $Transfer['CodeValue'];?>
                                </option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                          </div>
                          </div>
                       <div class="form-group row">
                          <div class="col-sm-3">Remarks</div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="Remarks" name="Remarks" value="<?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : "");?>"  placeholder="Remarks">
                            <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                          </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check form-check-flat mt-0">
                              <label class="form-check-label">
                              <input type="checkbox" class="form-check-input"> I agree Refill Wallet Terms 
                              </label>
                            </div>
                        </div>
                       <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnRefillWallet" class="btn btn-success mr-2">Submit Request</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="WalletRequests"><small>View Requests</small> </a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>