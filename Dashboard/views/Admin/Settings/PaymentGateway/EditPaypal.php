<?php $page="Paypal";?>
<?php include_once("settings_header.php");?>
<?php 
$res =$webservice->getData("Admin","GetPaymentGatewayDetails");
$Paypal = $res['data']['Paypal'];
?>
<script>
$(document).ready(function () {
   $("#PaypalName").blur(function () {
    
        IsNonEmpty("PaypalName","ErrPaypalName","Please Enter Paypal Name");
                        
   });
   $("#PaypalEmailID").blur(function () {
    
        IsNonEmpty("PaypalEmailID","ErrPaypalEmailID","Please Enter Paypal EmailID");
                        
   });
   $("#MarchantID").blur(function () {
        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
           IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Alpha Numeric Characters Only");
        }
   });
   $("#SecretKey").blur(function () {
       if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){
           IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeric Characters Only");
        }
   }); 
    $("#SuccessUrl").blur(function () {
        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
   });
   $("#FailureUrl").blur(function () {
        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
   });
 
});       
function SubmitPaypal() {
                         $('#ErrPaypalName').html("");
                         $('#ErrPaypalEmailID').html("");
                         $('#ErrMarchantID').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         //$('#ErrPayuRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("PaypalName","ErrPaypalName","Please Enter Paypal Name");
                        IsNonEmpty("PaypalEmailID","ErrPaypalEmailID","Please Enter Paypal Email ID");
                        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
                            IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Alpha Numeric Characters Only");
                        }
                        if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){
                           IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeric Characters Only");
                        }
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                     //   IsNonEmpty("PayuRemarks","ErrPayuRemarks","Please Enter Remarks");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<?php $PaypalInfo = $webservice->getData("Admin","GetPaymentGatewayDatas");?>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="VT0005" name="PaypalSoftCode" id="PaypalSoftCode">
    <input type="hidden" value="Paypal" name="PaypalCodeValue" id="PaypalCodeValue">
    <input type="hidden" value="<?php echo $Paypal['PaymentGatewayVendorCode'];?>" name="PaymentGatewayVendorCode" id="PaymentGatewayVendorCode">
    <h4 class="card-title">Edit Paypal</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Paypal Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PaypalName" name="PaypalName" placeholder="Paypal Name" value="<?php echo isset($_POST['PaypalName']) ? $_POST['PaypalName'] : $Paypal['VenderName'];?>">
                                <span class="errorstring" id="ErrPaypalName"><?php echo isset($ErrPaypalName)? $ErrPaypalName : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PaypalEmailID" name="PaypalEmailID" Placeholder="Email ID" value="<?php echo isset($_POST['PaypalEmailID']) ? $_POST['PaypalEmailID'] : $Paypal['EmailID'];?>">
                                <span class="errorstring" id="ErrPaypalEmailID"><?php echo isset($ErrPaypalEmailID)? $ErrPaypalEmailID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="MarchantID" name="MarchantID" Placeholder="MarchantID" value="<?php echo isset($_POST['MarchantID']) ? $_POST['MarchantID'] : $Paypal['MarchantID'];?>">
                                <span class="errorstring" id="ErrMarchantID"><?php echo isset($ErrMarchantID)? $ErrMarchantID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SecretKey" name="SecretKey" Placeholder="Secret Key" value="<?php echo isset($_POST['SecretKey']) ? $_POST['SecretKey'] : $Paypal['Secretky'];?>">
                                <span class="errorstring" id="ErrSecretKey"><?php echo isset($ErrSecretKey)? $ErrSecretKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Currency<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="Currency" name="Currency">
                                    <?php foreach($PaypalInfo['data']['Currency'] as $Currency) { ?>
                                    <option value="<?php echo $Currency['SoftCode'];?>" <?php echo (isset($_POST[ 'Currency'])) ? (($_POST[ 'Currency']==$Currency[ 'SoftCode']) ? " selected='selected' " : "") : (($Currency[ 'PaypalCurrencyCode']==0) ? " selected='selected' " : "");?>><?php echo $Currency['CodeValue'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" id="Status"  name="Status" >
                                    <option value="1" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="1") ? " selected='selected' " : "") : (($Paypal[ 'VendorStatus']==1) ? " selected='selected' " : "");?>>Active</option>
                                    <option value="0" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="0") ? " selected='selected' " : "") : (($Paypal[ 'VendorStatus']==0) ? " selected='selected' " : "");?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" Placeholder="Success Url" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] : $Paypal['SuccessUrl'];?>">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" Placeholder="Failure Url" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] : $Paypal['FailureUrl'];?>">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="Remarks" name="Remarks" Placeholder="Remarks"><?php echo isset($_POST['Remarks']) ? $_POST['Remarks'] : $Paypal['Remarks'];?></textarea>
                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                            </div>
                        </div>
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePaypal?Filter=Paypal&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
				<a href="javascript:void(0)" onclick="PaymentGateway.ConfirmEditPaypal()" class="btn btn-primary">Update</a>
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

<?php include_once("settings_footer.php");?>                    