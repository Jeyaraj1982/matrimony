<?php
   // $Members = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_POST['FranchiseeCode']."'");
?>


<script>
/*
$(document).ready(function () {
  $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    $("#FranchiseeCode").blur(function () {
    
        IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code");
                        
   });
   $("#Amount").blur(function () {
    
        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
   });

function SubmitRefillWallet() {
                         $('#ErrFranchiseeCode').html("");
                         $('#ErrAmount').html("");
                         $('#ErrRemarks').html("");
                         ErrorCount=0;
                         
                         
                        if (IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code")) {
                            IsAlphaNumerics("FranchiseeCode","ErrFranchiseeCode","Please Enter Alpha Numeric characters only");    
                        }
                        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        if ($('#Remarks').val().trim().length>0) {
                            IsMobileNumber("Remarks","ErrRemarks","Please Enter Remarks");
                        }
                        
                         if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
                 
function GetFranchiseeDetails() {
    $.ajax({
        url: "http://nahami.online/sl/Dashboard/webservice.php?m=Franchisee&a=GetDetails&Code="+$('#FranchiseeCode').val(), 
        success: function(result){
            
            var obj = jQuery.parseJSON(result);
            
            
                $('#FranchiseeName').html(obj.FranchiseName);
                $('#MobileNumber').html(obj.ContactNumber);
                $('#CreatedOn').html(obj.CreatedOn); 
                $('#EmailID').html(obj.ContactEmail);
                $('#myModal').modal('show');
           
        }});
}

  */  
</script> 



<!--<form method="post" action="<?php //echo GetUrl("Franchisees/Wallet/ConfirmationPage");?>" onsubmit="return SubmitRefillWallet();">
<div class="col-12 stretch-card">
   <div class="card">
    <div class="card-body">
    <h4 class="card-title" >Franchisees</h4>  
    <h4 class="card-title">Refill Wallet</h4>  
        
            <div class="form-group row">
                <label for="Franchisee Code" class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="FranchiseeCode" name="FranchiseeCode"  placeholder="Franchisee Code">
                    <span class="errorstring" id="ErrFranchiseeCode"><?php // echo isset($ErrFranchiseeCode) ? $ErrFranchiseeCode : "";?></span>
                </div>
                <div class="col-sm-3">
                <!--  data-target="#myModal"-->
             <!--   <button type="button" onclick="GetFranchiseeDetails()" data-toggle="modal" class="btn btn-primary mr-2">View</button>
                
    </div>
   </div>
            <div class="form-group row">
                    <label for="Amount" class="col-sm-3 col-form-label">Amount<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon">Rs</div>
                            <input type="text" class="form-control" id="Amount" name="Amount"  placeholder="Amount">
                        </div>
                        <span class="errorstring" id="ErrAmount"><?php // echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                    </div>
            </div>
            <div class="form-group row">
                    <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks" name="Remarks"  placeholder="Remarks">
                    <span class="errorstring" id="ErrRemarks"><?php // echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
                </div>
            </div>
            <button type="submit" name="BtnSaveRefillWallet" class="btn btn-primary mr-2">Transfer to Franchisee Wallet</button>
            <a href="RefillWallet "><small>List of Requests</small> </a>
 
   </div>
  </div>
</div>
</form>

<div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="" onsubmit="">
                                <div class="col-12 grid-margin">
                                      <div class="card">
                                        <div class="card-body">
                                          <h4 class="card-title" style="padding-top:20px;">Franchisee Information</h4>  
                                          <form class="forms-sample">
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Franchisee Name:</small> </div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="FranchiseeName"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Mobile Number:</small></div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="MobileNumber"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Created On:</small></div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="CreatedOn"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Email ID:</small></div>
                                              <div class="col-sm-9"><small style="color:#737373;" id="EmailID"></small></div>
                                          </div>
                                      </div>                                                                                                        
                                  </div>
                                </div>  
                                <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                   </div>
              </div>
           </div>
           -->
           
<?php
     $response =$webservice->getData("Admin","FranchiseeDetailsforRefillWallet");
     $Franchisee=$response['data'];
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
          /*  $("#check").blur(function() {
                IsNonEmpty("check", "Errcheck", "If yo agree terms and conditions please select");
            });  */
        });

        function SubmitDetails() {

            $('#ErrAmountToTransfer').html("");
            $('#ErrRemarks').html("");
          //  $('#Errcheck').html("");
            
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
           
           /* if (document.frmfrn.check.checked == false) {
                $("#Errcheck").html("Please agree terms and conditions");
                return false;
            }  */
           if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
        }
    </script>                                 
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
        <div class="content-wrapper">
          <div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Refill Wallet</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['FranchiseName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Email</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactEmail'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee MobileNo</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee[0]['ContactNumber'];?></small></div>
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
                       <a href="javascript:void(0)" onclick="ConfirmFrTransferAmountToFranchiseeFromAdmin();" name="Btnupdate" id="Btnupdate" class="btn btn-primary mr-2">Confirm</a></div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="../../ManageFranchisees"><small>back</small> </a></div>
                         </div>
                    </div>
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