<?php
  $response = $webservice->RefillWallet($_POST); 
  $Member=$response['data'];
                    ?> 
<script>
$(document).ready(function () {
  $("#AmountToTransfer").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmountToTransfer").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
$("#AmountToTransfer").blur(function () {
    
        IsNonEmpty("AmountToTransfer","ErrAmountToTransfer","Please Enter Amount To Transfer");
                        
   });
$("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
});
 function SubmitDetails() {
                         $('#ErrAmountToTransfer').html("");
                         $('#ErrRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("AmountToTransfer","ErrAmountToTransfer","Please Enter Valid Amount To Transfer");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Valid Remarks");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
                                                                
</script>
<form method="post" action="<?php echo GetUrl("Wallet/ConfirmPage");?>" onsubmit="return SubmitDetails();">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Refill Wallet</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MemberName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member Email</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['EmailID'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member MobileNo</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MobileNumber'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Amount To Transfer<span id="star">*</span></small></div>
                          <div class="col-sm-3">
                          <div class="input-group">
                          <div class="input-group-addon">Rs</div>
                          <input type="text" class="form-control" name="AmountToTransfer" id="AmountToTransfer" >
                          </div>
                          <span class="errorstring" id="ErrAmountToTransfer"><?php echo isset($ErrAmountToTransfer)? $ErrAmountToTransfer : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Remarks<span id="star">*</span></small></div>
                          <div class="col-sm-3">
                          <input type="text" class="form-control" name="Remarks" id="Remarks">
                          <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnNext" class="btn btn-success mr-2">Confirm</button></div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="../SearchMemberDetails"><small>back</small> </a></div>
                         </div>
                    </div>
                  </div>
                </div>
              </div>
</form> 
