<script>
$(document).ready(function () {
   $("#Name").blur(function () {
        IsNonEmpty("Name","ErrName","Please Enter Name");
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
   $("#CCAvenueRemarks").blur(function () {
        IsNonEmpty("CCAvenueRemarks","ErrCCAvenueRemarks","Please Enter Remarks");
   });
});       
function SubmitCCavenue() {
                         $('#ErrName').html("");
                         $('#ErrMatchantID').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         $('#ErrCCAvenueRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Name","ErrName","Please Enter Name");
                        IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID");
                        IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key");
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                        IsNonEmpty("CCAvenueRemarks","ErrCCAvenueRemarks","Please Enter Remarks");
                       
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<form method="post" id="frmfrn" onsubmit="return SubmitCCavenue();">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Create CCavenue</h4>                    
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
                                <textarea class="form-control" id="CCAvenueRemarks" name="CCAvenueRemarks"><?php echo isset($_POST['CCAvenueRemarks']) ? $_POST['CCAvenueRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrCCAvenueRemarks"><?php echo isset($ErrCCAvenueRemarks)? $ErrCCAvenueRemarks : "";?></span>
                            </div>
                        </div> 
		            </div>
	            </div>
            </div>
	<br>
	<div class="form-group row" >
						<div class="col-sm-12" style="text-align:right">
							&nbsp;<a href="" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
							<button type="submit" name="CreateCcavenue" id="CreateCcavenue" class="btn btn-primary">Update</a>
						</div>
					</div>
	</div>
		<div class="col-sm-3">
          
        </div>
           
</div>
</form>