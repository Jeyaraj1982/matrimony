<script>
$(document).ready(function () {
$("#PaypalCode").blur(function () {
    
        IsNonEmpty("PaypalCode","ErrPaypalCode","Please Enter Paypal Code");
                        
   });
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
                         $('#ErrPaypalCode').html("");
                         $('#ErrPaypalName').html("");
                         $('#ErrPaypalEmailID').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("PaypalCode","ErrPaypalCode","Please Enter Paypal Code")) {
                        IsAlphaNumeric("PaypalCode","ErrPaypalCode","Please Enter Alpha Numeric characters only");
                        }
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
  if (isset($_POST['BtnSavePaypal'])) {   
    $response = $webservice->getData("Admin","CreatePaypal",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
  $PaypalCode =$webservice->getData("Admin","GetPaypalCode"); 
     $GetNextPaypalCode="";
        if ($PaypalCode['status']=="success") {
            $GetNextPaypalCode  =$PaypalCode['data']['PaypalCode'];
        }
        {
?>                                                      
<form method="post" action="" onsubmit="return SubmitNewPaypal();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Paypal</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Code<span id="star">*</span></label>
                          <div class="col-sm-2">                                                      
                            <input type="text" class="form-control" id="PaypalCode" name="PaypalCode" value="<?php echo (isset($_POST['PaypalCode']) ? $_POST['PaypalCode'] : $GetNextPaypalCode);?>">
                            <span class="errorstring" id="ErrPaypalCode"><?php echo isset($ErrPaypalCode)? $ErrPaypalCode : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="PaypalName" name="PaypalName" value="<?php echo (isset($_POST['PaypalName']) ? $_POST['PaypalName'] : "");?>">
                            <span class="errorstring" id="ErrPaypalName"><?php echo isset($ErrPaypalName)? $ErrPaypalName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypa Email ID<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="PaypalEmailID" name="PaypalEmailID" value="<?php echo (isset($_POST['PaypalEmailID']) ? $_POST['PaypalEmailID'] : "");?>">
                            <span class="errorstring" id="ErrPaypalEmailID"><?php echo isset($ErrPaypalEmailID)? $ErrPaypalEmailID : "";?></span>
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
                    <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                   <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" name="BtnSavePaypal" class="btn btn-primary mr-2">Create</button></div>
                        <div class="col-sm-2"><a href="Paypal" style="text-decoration: underline;">List of Paypal</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>    
<?php }?>                                              
