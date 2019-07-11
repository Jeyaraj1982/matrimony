<script>
$(document).ready(function () {
$("#PaypalName").blur(function () {
    
        IsNonEmpty("PaypalName","ErrPaypalName","Please Enter Paypal Name");
                        
   });
   $("#PaypalEmailID").blur(function () {
    
        IsNonEmpty("PaypalEmailID","ErrPaypalEmailID","Please Enter Paypal EmailID");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
});       

function SubmitNewPaypal() {
                         $('#ErrPaypalName').html("");
                         $('#ErrPaypalEmailID').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("PaypalName","ErrPaypalName","Please Enter Paypal Name")) {
                        IsAlphabet("PaypalName","ErrPaypalName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("PaypalEmailID","ErrPaypalEmailID","Please Enter Paypal Email ID")) {
                        IsEmail("PaypalEmailID","ErrPaypalEmailID","Please Enter valid Paypal Email ID ");
                        }
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script> 
<?php   
    if (isset($_POST['BtnUpdatePaypal'])) {
        
        $response = $webservice->getData("Admin","EditPaypal",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Admin","PaypalDetailsForView");
    $Paypal= $response['data']['ViewPaypalDetails'];
?>                                                        
<form method="post" action="" onsubmit="return SubmitNewPaypal();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Paypal</h4>
                  <form class="form-sample">
                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" class="form-control" id="PaypalCode" name="PaypalCode" value="<?php echo (isset($_POST['PaypalCode']) ? $_POST['PaypalCode'] : $Paypal['PaypalCode']);?>">
                            <span class="errorstring" id="ErrPaypalName"><?php echo isset($ErrPaypalCode)? $ErrPaypalCode : "";?></span>
                          </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="disabled" id="PaypalName" name="PaypalName" value="<?php echo (isset($_POST['PaypalName']) ? $_POST['PaypalName'] : $Paypal['PaypalName']);?>">
                            <span class="errorstring" id="ErrPaypalName"><?php echo isset($ErrPaypalName)? $ErrPaypalName : "";?></span>
                          </div>
                        </div>
                    <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Email ID<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="disabled" id="PaypalEmailID" name="PaypalEmailID" value="<?php echo (isset($_POST['PaypalEmailID']) ? $_POST['PaypalEmailID'] : $Paypal['PaypalEmailID']);?>">
                            <span class="errorstring" id="ErrPaypalEmailID"><?php echo isset($ErrPaypalEmailID)? $ErrPaypalEmailID : "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Remarks<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <textarea  rows="2" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Paypal['Remarks']);?></textarea>
                            <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;" >
                                    <option value="1" <?php echo ($Paypal['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Paypal['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                        </div>
                    <div class="form-group row">
                        <?php echo $errormessage;?><?php echo $successmessage;?>
                        </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnUpdatePaypal" class="btn btn-primary mr-2">Create</button></div>
                        <div class="col-sm-2"><a href="../Paypal" style="text-decoration: underline;">List of Paypal</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>                                                  
