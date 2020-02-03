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
          /*  $("#check").blur(function() {
                IsNonEmpty("check", "Errcheck", "If yo agree terms and conditions please select");
            });  */
        });

        function SubmitDetails() {

            $('#ErrAmountToTransfer').html("");
            $('#ErrRemarks').html("");
            
            ErrorCount==0
            
               if ($('#AmountToTransfer').val() == "")  {
                    $("#ErrAmountToTransfer").html("Please Enter Amount To Transfer");
                    return false;
                }
             
                if (!(parseInt($('#AmountToTransfer').val()) >= 500 && parseInt($('#AmountToTransfer').val()) <= 10000)) {       
                    $("#ErrAmountToTransfer").html("Please enter above 500 and below 10000");
                    return false;
                }

                if ( !( (parseInt($('#AmountToTransfer').val()) % 100) == 0) ) {
                    $("#ErrAmountToTransfer").html("Please enter only multiples of 100");
                    return false;
                }
                if ($('#Remarks').val() == "")  {
                    $("#ErrRemarks").html("Please Enter Remarks");
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
     $response =$webservice->getData("Admin","FranchiseeDetailsforRefillWallet");
     $Franchisee=$response['data'];
                    ?>
 <?php
        if (isset($_POST['BtnNext'])) {         
            $response =$webservice->getData("Admin","AdminTransferAmountToFranchiseeWallet",$_POST);
            if ($response['status']=="success") {
        ?>
            <script>location.href='<?php echo AppUrl;?>Franchisees/Wallet/TransferedSuccessfully';</script>
        <?php
            } else {
                $errormessage = $response['message']; 
            }
        }
        ?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $_GET['Code'];?>" name="FranchiseeCode" id="FranchiseeCode">
       <div class="form-group row">
            <div class="col-12 grid-margin">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <div style="padding:15px !important;max-width:770px !important;">
                                <h4 class="card-title">Refill Wallet</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Franchisee Name</label>
                                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee[0]['FranchiseName'];?></small></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Franchisee Email</label>
                                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactEmail'];?></small></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Franchisee MobileNo</label>
                                    <div class="col-sm-9"><small style="color:#737373;">+<?php echo $Franchisee[0]['ContactNumberCountryCode'];?>-<?php echo $Franchisee[0]['ContactNumber'];?></small></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Amount To Transfer</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-addon">Rs</div>
                                            <input type="text" class="form-control" name="AmountToTransfer" id="AmountToTransfer" >
                                        </div>
                                        <span class="errorstring" id="ErrAmountToTransfer"><?php echo isset($ErrAmountToTransfer)? $ErrAmountToTransfer : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Remarks</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Remarks" id="Remarks">
                                        <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group row">                           
                                    <div class="col-sm-12">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="check" name="check">
                                            <label class="custom-control-label" for="check" style="vertical-align: middle;">I accept transfer amount</label><br><span class="errorstring" id="Errcheck"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <br>
        <div class="form-group row">
          <div class="col-sm-12" style="text-align:right;">
          &nbsp;<a href="../FrRefillWallet" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
          <a href="javascript:void(0)" onclick="ConfirmFrTransferAmountToFranchiseeFromAdmin()" class="btn btn-primary" name="BtnSaveCreate">Confirm</a>
          </div>
        </div>
 
        </div>
        <div class="col-sm-3">
        </div>
    </div>
    </div>
</form>
   <div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>