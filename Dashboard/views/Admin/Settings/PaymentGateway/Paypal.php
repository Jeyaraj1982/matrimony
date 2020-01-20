<?php $page="Paypal";?>
<?php include_once("settings_header.php");?>
<script>
$(document).ready(function () {
   $("#PaypalName").blur(function () {
    
        IsNonEmpty("PaypalName","ErrPaypalName","Please Enter Paypal Name");
                        
   });
   $("#PaypalEmailID").blur(function () {
    
        IsNonEmpty("PaypalEmailID","ErrPaypalEmailID","Please Enter Paypal EmailID");
                        
   });
   $("#MarchantID").blur(function () {
        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
   });
   $("#SecretKey").blur(function () {
        IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key");
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
                        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
                        IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key");
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
    <h4 class="card-title">Create Paypal</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Paypal Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PaypalName" name="PaypalName" value="<?php echo isset($_POST['PaypalName']) ? $_POST['PaypalName'] : "";?>">
                                <span class="errorstring" id="ErrPaypalName"><?php echo isset($ErrPaypalName)? $ErrPaypalName : "";?></span>
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PaypalEmailID" name="PaypalEmailID" value="<?php echo isset($_POST['PaypalEmailID']) ? $_POST['PaypalEmailID'] : "";?>">
                                <span class="errorstring" id="ErrPaypalEmailID"><?php echo isset($ErrPaypalEmailID)? $ErrPaypalEmailID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="MarchantID" name="MarchantID" value="<?php echo isset($_POST['MarchantID']) ? $_POST['MarchantID'] : "";?>">
                                <span class="errorstring" id="ErrMarchantID"><?php echo isset($ErrMarchantID)? $ErrMarchantID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SecretKey" name="SecretKey" value="<?php echo isset($_POST['SecretKey']) ? $_POST['SecretKey'] : "";?>">
                                <span class="errorstring" id="ErrSecretKey"><?php echo isset($ErrSecretKey)? $ErrSecretKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-3 col-form-label">Currency<span id="star">*</span></label>
							<div class="col-sm-4">
								<select class="form-control" id="Currency" name="Currency">
									<?php foreach($PaypalInfo['data']['Currency'] as $Currency) { ?>
									<option value="<?php echo $Currency['SoftCode'];?>" <?php echo ($Currency[ 'SoftCode']==$_POST[ 'Currency']) ? ' selected="selected" ' : '';?>>
										<?php echo $Currency['CodeValue'];?>
									</option>
									<?php } ?>
								</select>
							</div>
                            <label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
							<div class="col-sm-3">
							    <select class="form-control" id="Status"  name="Status" >
                                    <option value="1" <?php echo ($_POST['Status']=="1") ? " selected='selected' " : "";?>>Active</option>
							        <option value="0" <?php echo ($_POST['Status']=="0") ? " selected='selected' " : "";?>>Deactive</option>
						        </select>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] : "";?>">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] : "";?>">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="Remarks" name="Remarks"><?php echo isset($_POST['Remarks']) ? $_POST['Remarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                            </div>
                        </div> 
		           
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AppSettings.ConfirmGotoBackFromCreatePaypal()">Cancel</a>&nbsp;
				<a href="javascript:void(0)" onclick="PaymentGateway.ConfirmCreatePaypal()" class="btn btn-primary">Create</a>
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