<script>
$(document).ready(function () {
   $("#PayBi2Name").blur(function () {
        IsNonEmpty("PayBi2Name","ErrPayBi2Name","Please Enter Pay Bi2 Name");
   });
   $("#MarchantID").blur(function () {
        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
   });
   $("#PayuKey").blur(function () {
        IsNonEmpty("PayuKey","ErrPayuKey","Please Enter Key");
   }); 
   $("#SaltID").blur(function () {
        IsNonEmpty("SaltID","ErrSaltID","Please Enter Salt ID");
   });
   $("#SuccessUrl").blur(function () {
        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
   });
   $("#FailureUrl").blur(function () {
        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
   });
   $("#PayuRemarks").blur(function () {
        IsNonEmpty("PayuRemarks","ErrPayuRemarks","Please Enter Remarks");
   });
});       
function SubmitPayu() {
                         $('#ErrPayBi2Name').html("");
                         $('#ErrMarchantID').html("");
                         $('#ErrPayuKey').html("");
                         $('#ErrSaltID').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         $('#ErrPayuRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("PayBi2Name","ErrPayBi2Name","Please Enter Pay Bi2 Name");
                        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
                        IsNonEmpty("PayuKey","ErrPayuKey","Please Enter Key");
                        IsNonEmpty("SaltID","ErrSaltID","Please Enter Salt ID");
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                        IsNonEmpty("PayuRemarks","ErrPayuRemarks","Please Enter Remarks");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<form method="post" id="frmfrn" onsubmit="return SubmitPayu();">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Create Payu</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payu Bi2 Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PayBi2Name" name="PayBi2Name" value="<?php echo isset($_POST['PayBi2Name']) ? $_POST['PayBi2Name'] : "";?>">
                                <span class="errorstring" id="ErrPayBi2Name"><?php echo isset($ErrPayBi2Name)? $ErrPayBi2Name : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payu Bi2 Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="file" id="PayBi2Logo" name="PayBi2Logo">
                            <span class="errorstring" id="ErrPayBi2Logo"><?php echo isset($ErrPayBi2Logo)? $ErrPayBi2Logo : "";?></span>
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
                            <label class="col-sm-3 col-form-label">Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PayuKey" name="PayuKey" value="<?php echo isset($_POST['PayuKey']) ? $_POST['PayuKey'] : "";?>">
                                <span class="errorstring" id="ErrPayuKey"><?php echo isset($ErrPayuKey)? $ErrPayuKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salt ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SaltID" name="SaltID" value="<?php echo isset($_POST['SaltID']) ? $_POST['SaltID'] : "";?>">
                                <span class="errorstring" id="ErrSaltID"><?php echo isset($ErrSaltID)? $ErrSaltID : "";?></span>
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
                                <textarea class="form-control" id="PayuRemarks" name="PayuRemarks"><?php echo isset($_POST['PayuRemarks']) ? $_POST['PayuRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrPayuRemarks"><?php echo isset($ErrPayuRemarks)? $ErrPayuRemarks : "";?></span>
                            </div>
                        </div> 
		            </div>
	            </div>
            </div>
	<br>
	<div class="form-group row" >
						<div class="col-sm-12" style="text-align:right">
							&nbsp;<a href="" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
							<button type="submit" name="CreatePayu" id="CreatePayu" class="btn btn-primary">Update</a>
						</div>
					</div>
	</div>
		<div class="col-sm-3">
          
        </div>
           
</div>
</form>