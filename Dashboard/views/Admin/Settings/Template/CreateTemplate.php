
<?php 
     $TempInfo = $webservice->getData("Admin","GetTemplateInfo");
     $TempCode="";
        if ($TempInfo['status']=="success") {
            $TempCode  =$TempInfo['data']['TempCode'];
        }
        {
?>
<form method="post" id="frmfrn" >
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Manage Templates</h4>                    
						<h5 class="card-title">Create Template</h5>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Template Code<span id="star">*</span></label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo isset($_POST['TempCode']) ? $_POST['TempCode'] : $TempCode;?>" class="form-control" id="TempCode" name="TempCode" maxlength="6">
								<span class="errorstring" id="ErrTempCode"><?php echo isset($ErrTempCode)? $ErrTempCode : "";?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Action<span id="star">*</span></label>
							<div class="col-sm-4">
								<select class="selectpicker form-control" data-live-search="true" id="TempAction" name="TempAction">
									<option value="0">--Choose Action--</option>
									<?php foreach($TempInfo['data']['TempAction'] as $ta) { ?>
										<option value="<?php echo $ta['SoftCode'];?>" <?php echo ($ta[ 'SoftCode']==$_POST[ 'TempAction']) ? ' selected="selected" ' : '';?>><?php echo $ta['CodeValue'];?>
										</option>
									<?php } ?>
								</select>
								<span class="errorstring" id="ErrTempAction"><?php echo isset($ErrTempAction)? $ErrTempAction : "";?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-10 col-form-label">Sms<span id="star">*</span></label>
							<div class="col-sm-2" style="text-align:right">
								<div class="custom-control custom-checkbox mb-3" style="float:right">
									<input type="checkbox" class="custom-control-input" id="SmsActive" name="SmsActive">
									<label class="custom-control-label" for="SmsActive" style="margin-top: 7px;">&nbsp;Active</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="text" value="<?php echo isset($_POST['Sms']) ? $_POST['Sms'] : '';?>" class="form-control" id="Sms" name="Sms">
								<span class="errorstring" id="ErrSms"><?php echo isset($ErrSms)? $ErrSms : "";?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-10 col-form-label">Email<span id="star">*</span></label>
							<div class="col-sm-2" style="text-align:right">
								<div class="custom-control custom-checkbox mb-3" style="float:right">
									<input type="checkbox" class="custom-control-input" id="EmailActive" name="EmailActive">
									<label class="custom-control-label" for="EmailActive" style="margin-top: 7px;">&nbsp;Active</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label">Subject</label>
							<input type="text" value="<?php echo isset($_POST['EmailSubject']) ? $_POST['EmailSubject'] : '';?>" class="form-control" id="EmailSubject" name="EmailSubject">
							<span class="errorstring" id="ErrEmailSubject"><?php echo isset($ErrEmailSubject)? $ErrEmailSubject : "";?></span>
						</div>
						<div class="form-group">
							<label class="col-form-label">Subject</label>
							<textarea class="form-control" id="EmailContent" name="EmailContent"><?php echo isset($_POST['EmailContent']) ? $_POST['EmailContent'] : '';?></textarea>
							<span class="errorstring" id="ErrEmailContent"><?php echo isset($ErrEmailContent)? $ErrEmailContent : "";?></span>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
				<div class="col-sm-12" style="text-align:right">
					&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AdminStaff.ConfirmGotoBackFromCreateAdminStaff()">Cancel</a>&nbsp;
					<a href="javascript:void(0)" onclick="AdminStaff.ConfirmCreateAdminStaff()" class="btn btn-primary" name="BtnupdateStaff">Create</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
		</div>
	</form>  <?php }?>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 344px;min-height: 344px;" >
		
			</div>
		</div>
	</div>
