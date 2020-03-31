<?php $page="instamajo";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $InstaMajo = $res['data']['InstaMajo'];  
?>
<div class="col-sm-10 rightwidget" >
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <h4 class="card-title">View Instamajo</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instamajo Name</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['VenderName'];?></div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo</label>
                          <div class="col-sm-9"><img src="<?php echo AppUrl;?>uploads/Instamajo/<?php echo $InstaMajo['VendorLogo'];?>" style="height:200px;width:150px"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Action Url</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['ActionUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client ID</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['ClientID'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['Secretky'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode</label>
                            <div class="col-sm-4"><?php echo $InstaMajo['VendorMode'];?></div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-3"><?php
                              if($InstaMajo['VendorStatus']=="1"){
                                  echo "Active";
                              } else{ echo "Deactive"; }?></div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['SuccessUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['FailureUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9"><?php echo $InstaMajo['Remarks'];?></div>
                        </div>                                                                                                                                                                                                                            
		                <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                            </div>
                        </div>
</form>
</div>

<?php include_once("settings_footer.php");?>                    