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
   $("#Industry").blur(function () {
        IsNonEmpty("Industry","ErrIndustry","Please Enter Industry");
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
   $("#PaytmRemarks").blur(function () {
        IsNonEmpty("PaytmRemarks","ErrPaytmRemarks","Please Enter Remarks");
   });
});       
function SubmitPaytm() {
                         $('#ErrName').html("");
                         $('#ErrMatchantID').html("");
                         $('#ErrWebsite').html("");
                         $('#ErrIndustry').html("");
                         $('#ErrChannel').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         $('#ErrPaytmRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Name","ErrName","Please Enter Name");
                        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
                        IsNonEmpty("Website","ErrWebsite","Please Enter Website");
                        IsNonEmpty("Industry","ErrIndustry","Please Enter Industry");
                        IsNonEmpty("Channel","ErrChannel","Please Enter Channel");
                        IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key");
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                        IsNonEmpty("PaytmRemarks","ErrPaytmRemarks","Please Enter Remarks");
                       
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<form method="post" id="frmfrn" onsubmit="return SubmitPaytm();">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
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
                            <input type="file" id="CCavenueLogo" name="CCavenueLogo">
                            <span class="errorstring" id="ErrCCavenueLogo"><?php echo isset($ErrCCavenueLogo)? $ErrCCavenueLogo : "";?></span>
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
                            <label class="col-sm-3 col-form-label">Industry<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Industry" name="Industry" value="<?php echo isset($_POST['Industry']) ? $_POST['Industry'] : "";?>">
                                <span class="errorstring" id="ErrIndustry"><?php echo isset($ErrIndustry)? $ErrIndustry : "";?></span>
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
                        </div>
                        <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
							<div class="col-sm-4">
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
                            <label class="col-sm-3 col-form-label">Remarks<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="PaytmRemarks" name="PaytmRemarks"><?php echo isset($_POST['PaytmRemarks']) ? $_POST['PaytmRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrPaytmRemarks"><?php echo isset($ErrPaytmRemarks)? $ErrPaytmRemarks : "";?></span>
                            </div>
                        </div> 
		            </div>
	            </div>
            </div>
	<br>
	<div class="form-group row" >
						<div class="col-sm-12" style="text-align:right">
							&nbsp;<a href="" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
							<button type="submit" name="CreatePaytm" id="CreatePaytm" class="btn btn-primary">Update</a>
						</div>
					</div>
	</div>
		<div class="col-sm-3">
          
        </div>
           
</div>
</form>