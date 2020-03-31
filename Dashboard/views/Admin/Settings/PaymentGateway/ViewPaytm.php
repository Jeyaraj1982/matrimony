<?php $page="paytm";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $Paytm = $res['data']['Paytm'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <h4 class="card-title">Create Paytm</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9"><?php echo $Paytm['VenderName'];?></div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo</label>
                          <div class="col-sm-9"><img src="<?php echo AppUrl;?>uploads/Paytm/<?php echo $Paytm['VendorLogo'];?>" style="height:200px;width:150px"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID</label>
                            <div class="col-sm-9"><?php echo $Paytm['MarchantID'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Website</label>
                            <div class="col-sm-9"><?php echo $Paytm['WebsiteName'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Identity</label>
                            <div class="col-sm-9"><?php echo $Paytm['Identity'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Channel</label>
                            <div class="col-sm-9"><?php echo $Paytm['Channel'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key</label>
                            <div class="col-sm-9"><?php echo $Paytm['Secretky'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode</label>
                            <div class="col-sm-4"><?php echo $Paytm[ 'VendorMode'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-3"><?php
                              if($Paytm['VendorStatus']=="1"){
                                  echo "Active";
                              } else{ echo "Deactive"; }?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url</label>
                            <div class="col-sm-9"><?php echo $Paytm['SuccessUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url</label>
                            <div class="col-sm-9"><?php echo $Paytm['FailureUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9"><?php echo $Paytm['Remarks'];?></div>
                        </div>
		                <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayTm?Filter=Paytm&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                            </div>
                        </div>
</form>
</div>

<?php include_once("settings_footer.php");?>                    