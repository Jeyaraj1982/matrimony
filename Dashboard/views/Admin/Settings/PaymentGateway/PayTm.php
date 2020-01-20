<?php $page="paytm";?>
<?php include_once("settings_header.php");?>

<script>
$(document).ready(function () {
   $("#Name").blur(function () {
        IsNonEmpty("Name","ErrName","Please Enter Name");
   });
   $("#MarchantID").blur(function () {
        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
   }); 
   $("#Website").blur(function () {
        IsNonEmpty("Website","ErrWebsite","Please Enter Website");
   });
   $("#Identity").blur(function () {
        IsNonEmpty("Identity","ErrIdentity","Please Enter Identity");
   }); 
   $("#Channel").blur(function () {
        IsNonEmpty("Channel","ErrChannel","Please Enter Channel");
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
function SubmitPaytm() {
                         $('#ErrName').html("");
                         $('#ErrMatchantID').html("");
                         $('#ErrWebsite').html("");
                         $('#ErrIdentity').html("");
                         $('#ErrChannel').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Name","ErrName","Please Enter Name");
                        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
                        IsNonEmpty("Website","ErrWebsite","Please Enter Website");
                        IsNonEmpty("Identity","ErrIdentity","Please Enter Identity");
                        IsNonEmpty("Channel","ErrChannel","Please Enter Channel");
                        IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key");
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                        
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
    <input type="hidden" value="VT0004" name="PaytmSoftCode" id="PaytmSoftCode">
    <input type="hidden" value="paytm" name="PaytmCodeValue" id="PaytmCodeValue">
    <h4 class="card-title">Create Paytm</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : "";?>">
                                <span class="errorstring" id="ErrName"><?php echo isset($ErrName)? $ErrName : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="file" id="PaytmLogo" name="PaytmLogo">
                            <span class="errorstring" id="ErrPaytmLogo"><?php echo isset($ErrPaytmLogo)? $ErrPaytmLogo : "";?></span>
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
                            <label class="col-sm-3 col-form-label">Website<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Website" name="Website" value="<?php echo isset($_POST['Website']) ? $_POST['Website'] : "";?>">
                                <span class="errorstring" id="ErrWebsite"><?php echo isset($ErrWebsite)? $ErrWebsite : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Identity<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Identity" name="Identity" value="<?php echo isset($_POST['Identity']) ? $_POST['Identity'] : "";?>">
                                <span class="errorstring" id="ErrIdentity"><?php echo isset($ErrIdentity)? $ErrIdentity : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Channel<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Channel" name="Channel" value="<?php echo isset($_POST['Channel']) ? $_POST['Channel'] : "";?>">
                                <span class="errorstring" id="ErrChannel"><?php echo isset($ErrChannel)? $ErrChannel : "";?></span>
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
                            <label class="col-sm-3 col-form-label">Mode<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="Mode"  name="Mode" >
                                    <option value="Live" <?php echo ($_POST['Mode']=="Live") ? " selected='selected' " : "";?>>Live</option>
                                    <option value="Test" <?php echo ($_POST['Mode']=="Test") ? " selected='selected' " : "";?>>Test</option>
                                </select>
                              <span class="errorstring" id="ErrMode"><?php echo isset($ErrMode)? $ErrMode : "";?></span>
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
                                <textarea class="form-control" id="PaytmRemarks" name="PaytmRemarks"><?php echo isset($_POST['PaytmRemarks']) ? $_POST['PaytmRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrPaytmRemarks"><?php echo isset($ErrPaytmRemarks)? $ErrPaytmRemarks : "";?></span>
                            </div>
                        </div>
		           
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AppSettings.ConfirmGotoBackFromCreatePaytm()">Cancel</a>&nbsp;
				<a href="javascript:void(0)" onclick="PaymentGateway.ConfirmCreatePaytm()" class="btn btn-primary">Create</a>
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
</div>

<?php include_once("settings_footer.php");?>                    