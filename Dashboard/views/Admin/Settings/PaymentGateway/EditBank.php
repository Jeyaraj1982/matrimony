<?php $page="Bank Details";?>
<?php include_once("settings_header.php");?>
<?php 
 $response = $webservice->getData("Admin","BankDetailsForView");
    $BankName = $response['data']['BankName'];
     $Bank    = $response['data']['ViewBankDetails'];
?>
<script>
$(document).ready(function () {
    $("#AccountName").blur(function () {
    
        IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name");
                        
   });
   $("#AccountNumber").blur(function () {
        if(IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number")){
            IsAlphaNumeric("AccountNumber","ErrAccountNumber","Please Enter Alpha Numeric Characters Only");
        }
   });
   $("#IFSCode").blur(function () {
        if(IsNonEmpty("IFSCode","ErrIFSCode","Please Enter IFS Code")){
            IsAlphaNumeric("IFSCode","ErrIFSCode","Please Enter Alpha Numeric Characters Only");
        }
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
                        if(IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number")){
                            IsAlphaNumeric("AccountNumber","ErrAccountNumber","Please Enter Alpha Numeric Characters Only");
                        }
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
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $Bank['BankID'];?>" name="Code" id="Code">
    <h4 class="card-title">Bank Account Details</h4>
    <h4 class="card-title">Edit Bank Account Details</h4>                   
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
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Account Name<span id="star">*</span></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="<?php echo (isset($_POST['AccountName']) ? $_POST['AccountName'] : $Bank['AccountName']);?>">
        <span class="errorstring" id="ErrAccountName"><?php echo isset($ErrAccountName)? $ErrAccountName : "";?></span>
      </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="<?php echo (isset($_POST['AccountNumber']) ? $_POST['AccountNumber'] : $Bank['AccountNumber']);?>">
            <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span>
        </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
      <div class="col-sm-9">
        <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : $Bank['IFSCode']);?>">
        <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
      <div class="col-sm-3">
            <select name="Status" class="form-control" style="width: 140px;" >
                <option value="1" <?php echo ($Bank['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                <option value="0" <?php echo ($Bank['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
            </select>
      </div>
    </div>
        <div class="form-group row" >
            <div class="col-sm-12" style="text-align:right">
                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                <a href="javascript:void(0)" onclick="ConfirmEditBankDetails()" class="btn btn-primary">Update</a>
            </div>
        </div>
    
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>
</div>
<script>
function ConfirmEditBankDetails() {
    if(SubmitNewBank()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit bank details</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to edit bank details<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrEditBankDetails()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } 
     function GetTxnPasswordFrEditBankDetails () {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit bank details</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="EditBankDetails()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
    function EditBankDetails() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=EditBankDetails",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Bank details Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=All" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit bank details</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
    }
</script>
<?php include_once("settings_footer.php");?>                    