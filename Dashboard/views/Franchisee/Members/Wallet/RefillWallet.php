<?php
  $response = $webservice->RefillWallet($_POST); 
  $Member=$response['data'];
                    ?> 

<script>
        $(document).ready(function() {
            $("#AmountToTransfer").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $("#ErrAmountToTransfer").html("Digits Only").fadeIn().fadeIn("fast");
                    return false;
                }
            });
            $("#AmountToTransfer").blur(function() {
                IsNonEmpty("AmountToTransfer", "ErrAmountToTransfer", "Please Enter Amount");
            });
            $("#Remarks").blur(function() {
                IsNonEmpty("Remarks", "ErrRemarks", "Please Enter Remarks");
            });
            $("#check").blur(function() {
                IsNonEmpty("check", "Errcheck", "If yo agree terms and conditions please select");
            });
        });

        function SubmitDetails() {

            $('#ErrAmountToTransfer').html("");
            $('#ErrRemarks').html("");
            $('#Errcheck').html("");
            
            ErrorCount==0
            
            if (IsNonEmpty("AmountToTransfer", "ErrAmountToTransfer", "Please Enter Amount To Transfer")) {
                if (!(parseInt($('#AmountToTransfer').val()) >= 500 && parseInt($('#AmountToTransfer').val()) <= 10000)) {
                    $("#ErrAmountToTransfer").html("Please enter above 500 and below 10000");
                    return false;
                }

                if (!(parseInt($('#AmountToTransfer').val() % 100) == 0)) {
                    $("#ErrAmountToTransfer").html("Please enter only multiples of 100");
                    return false;
                }
            }
            IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
           
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please agree terms and conditions");
                return false;
            }
           if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
        }
    </script>                                 
    <?php
        if (isset($_POST['BtnNext'])) {         
            $response =$webservice->getData("Franchisee","FranchiseeTransferAmountToMemberWallet",$_POST);
            if ($response['status']=="success") {
        ?>
            <script>location.href='<?php echo AppUrl;?>Members/Wallet/TransferedSuccessfully';</script>
        <?php
            } else {
                $errormessage = $response['message']; 
            }
        }
        ?>
<form method="post" name="form1" id="form1" onsubmit="return SubmitDetails();">
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
                        <input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal">I accept transfer amount </label><Br><span class="errorstring" id="Errcheck"></span><br>
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
