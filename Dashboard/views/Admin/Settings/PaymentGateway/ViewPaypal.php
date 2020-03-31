<?php $page="Paypal";?>
<?php include_once("settings_header.php");?>
<?php 
$res =$webservice->getData("Admin","GetPaymentGatewayDetails");
$Paypal = $res['data']['Paypal'];
?>
<?php $PaypalInfo = $webservice->getData("Admin","GetPaymentGatewayDatas");?>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway">
    <h4 class="card-title">View Paypal</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Paypal Name</label>
                            <div class="col-sm-9"><?php echo $Paypal['VenderName'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email ID</label>
                            <div class="col-sm-9"><?php echo $Paypal['EmailID'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID</label>
                            <div class="col-sm-9"><?php echo $Paypal['MarchantID'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key</label>
                            <div class="col-sm-9"><?php echo $Paypal['Secretky'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Currency</label>
                            <div class="col-sm-4"><?php echo $Paypal['PaypalCurrency'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-3"><?php
                              if($Payu['VendorStatus']=="1"){
                                  echo "Active";
                              } else{ echo "Deactive"; }?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url</label>
                            <div class="col-sm-9"><?php echo $Paypal['SuccessUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url</label>
                            <div class="col-sm-9"><?php echo $Paypal['FailureUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9"><?php echo $Paypal['Remarks'];?></div>
                        </div>
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePaypal?Filter=Paypal&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
				</div>
		</div>
    
</form> 
<

<?php include_once("settings_footer.php");?>                    