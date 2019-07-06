<?php
   // $Members = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_POST['FranchiseeCode']."'");
?>


<script>

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
        url: API_URL + "m=Franchisee&a=GetDetails&Code="+$('#FranchiseeCode').val(), 
        success: function(result){
            
            var obj = jQuery.parseJSON(result);
            
            
                $('#FranchiseeName').html(obj.FranchiseName);
                $('#MobileNumber').html(obj.ContactNumber);
                $('#CreatedOn').html(obj.CreatedOn); 
                $('#EmailID').html(obj.ContactEmail);
                $('#myModal').modal('show');
           
        }});
}

    
</script> 



<form method="post" action="<?php //echo GetUrl("Franchisees/Wallet/ConfirmationPage");?>" onsubmit="return SubmitRefillWallet();">
<div class="col-12 stretch-card">
   <div class="card">
    <div class="card-body">
    <h4 class="card-title" >Franchisees</h4>  
    <h4 class="card-title">Refill Wallet</h4>  
        
            <div class="form-group row">
                <label for="Franchisee Code" class="col-sm-3 col-form-label">Franchisee Code<span id="star">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="FranchiseeCode" name="FranchiseeCode"  placeholder="Franchisee Code">
                    <span class="errorstring" id="ErrFranchiseeCode"><?php echo isset($ErrFranchiseeCode) ? $ErrFranchiseeCode : "";?></span>
                </div>
                <div class="col-sm-3">
                <!--  data-target="#myModal"-->
                <button type="button" onclick="GetFranchiseeDetails()" data-toggle="modal" class="btn btn-primary mr-2">View</button>
                
    </div>
   </div>
            <div class="form-group row">
                    <label for="Amount" class="col-sm-3 col-form-label">Amount<span id="star">*</span></label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon">Rs</div>
                            <input type="text" class="form-control" id="Amount" name="Amount"  placeholder="Amount">
                        </div>
                        <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                    </div>
            </div>
            <div class="form-group row">
                    <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks" name="Remarks"  placeholder="Remarks">
                    <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
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