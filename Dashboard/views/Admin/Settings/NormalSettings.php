<form method="post" action="" onsubmit="return SubmitSettings();">            
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Settings</h4>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Register Allow<span id="star">*</span></label>
                    <div class="col-sm-6">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="UniqueMobile" name="UniqueMobile">
                            <label class="custom-control-label" for="UniqueMobile" style="vertical-align: middle;">Unique Mobile</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="UniqueEmail" name="UniqueEmail">
                            <label class="custom-control-label" for="UniqueEmail" style="vertical-align: middle;">Unique Email</label>
                        </div>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Results Per Page<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <select class="selectpicker form-control" data-live-search="true" id="ResultsPerPage" name="ResultsPerPage">
                            <?php for($i=1;$i<=31;$i++) {?>
                            <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'ResultsPerPage']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Most Verify<span id="star">*</span></label>
                    <div class="col-sm-6">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="Email" name="Email">
                            <label class="custom-control-label" for="Email" style="vertical-align: middle;">Email</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="Mobile" name="Mobile">
                            <label class="custom-control-label" for="Mobile" style="vertical-align: middle;">Mobile</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="IDProofs" name="IDProofs">
                            <label class="custom-control-label" for="IDProofs" style="vertical-align: middle;">Proofs</label>
                        </div>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Currency<span id="star">*</span></label>
                    <div class="col-sm-2">
                         <select class="selectpicker form-control" data-live-search="true" id="Currency" name="Currency">
                            <option value="Rupees" <?php echo ($_POST['Currency']=="Rupees") ? " selected='selected' " : "";?>>Rupees</option>
                            <option value="Dolar" <?php echo ($_POST['Currency']=="Dolar") ? " selected='selected' " : "";?>>Dolar</option>
                         </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Time Zone<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="TimeZone" name="TimeZone"  value="<?php echo (isset($_POST['TimeZone']) ? $_POST['TimeZone'] : "");?>">
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Default Payment Gateway<span id="star">*</span></label>
                    <div class="col-sm-2">
                         <select class="selectpicker form-control" data-live-search="true" id="PaymentGateway" name="PaymentGateway">
                            <option value="Bank" <?php echo ($_POST['Bank']=="Bank") ? " selected='selected' " : "";?>>Bank</option>
                         </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Other</label>
                    <div class="col-sm-2">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="Paytm" name="Paytm">
                            <label class="custom-control-label" for="Paytm" style="vertical-align: middle;">Paytm</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="Strip" name="Strip">
                            <label class="custom-control-label" for="Strip" style="vertical-align: middle;">Strip</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="Paypal" name="Paypal">
                            <label class="custom-control-label" for="Paypal" style="vertical-align: middle;">Paypal</label>
                        </div>
                    </div>  
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Maintain Download Attachments</label>
                    <div class="col-sm-2">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="MaintainDownloadAttachments" name="MaintainDownloadAttachments">
                             <label class="custom-control-label" for="MaintainDownloadAttachments" style="vertical-align: middle;">        </label>
                       </div>
                    </div>
                 </div>
				 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Login Password Length<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="LoginPasswordLength" name="LoginPasswordLength"  value="<?php echo (isset($_POST['LoginPasswordLength']) ? $_POST['LoginPasswordLength'] : "");?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Login Password Expire<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="LoginPasswordExpire" name="LoginPasswordExpire"  value="<?php echo (isset($_POST['LoginPasswordExpire']) ? $_POST['LoginPasswordExpire'] : "");?>">days
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Txn Password Length<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="TxnPasswordLength" name="TxnPasswordLength"  value="<?php echo (isset($_POST['TxnPasswordLength']) ? $_POST['TxnPasswordLength'] : "");?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Txn Password Expire<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="TxnPasswordExpire" name="TxnPasswordExpire"  value="<?php echo (isset($_POST['TxnPasswordExpire']) ? $_POST['TxnPasswordExpire'] : "");?>">&nbsp;Days
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Minimum Bride Age<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="MinimumBrideAge" name="MinimumBrideAge"  value="<?php echo (isset($_POST['MinimumBrideAge']) ? $_POST['MinimumBrideAge'] : "");?>">&nbsp;Years
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Maximum Bride Age<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="MaximumBrideAge" name="MaximumBrideAge"  value="<?php echo (isset($_POST['MaximumBrideAge']) ? $_POST['MaximumBrideAge'] : "");?>">&nbsp;Years
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Minimum Groom Age<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="MinimumGroomAge" name="MinimumGroomAge"  value="<?php echo (isset($_POST['MinimumGroomAge']) ? $_POST['MinimumGroomAge'] : "");?>">&nbsp;Years
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Maximum Groom Age<span id="star">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="MaximumGroomAge" name="MaximumGroomAge"  value="<?php echo (isset($_POST['MaximumGroomAge']) ? $_POST['MaximumGroomAge'] : "");?>">&nbsp;Years
                    </div>
                </div>				
                 <div class="form-group row"> 
                    <div class="col-sm-3">
                        <button type="submit" name="SaveSettings" id="settings" class="btn btn-primary">Save</a>
                    </div>
                </div>                                                                                                                  
            </div>
        </div>                                                                                             
    </div>
</form>

                          
              