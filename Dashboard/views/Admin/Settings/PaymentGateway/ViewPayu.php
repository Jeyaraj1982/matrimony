<?php $page="Payu";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $Payu = $res['data']['Payu'];  
?>

<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
   <h4 class="card-title">View Payu</h4>                    
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Payu Biz Name</label>
            <div class="col-sm-9"><?php echo $Payu['VenderName'];?></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Payu Biz Logo</label>
            <div class="col-sm-9"><img src="<?php echo AppUrl;?>uploads/Payu/<?php echo $Payu['VendorLogo'];?>" style="height:200px;width:150px"></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Marchant ID</label>
            <div class="col-sm-9"><?php echo $Payu['MarchantID'];?></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Key</label>
            <div class="col-sm-9"><?php echo $Payu['Secretky'];?></div>
        </div> 
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Salt ID</label>
            <div class="col-sm-9"><?php echo $Payu['SaltID'];?></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mode</label>
            <div class="col-sm-4"><?php echo $Payu[ 'VendorMode'];?></div>
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
            <div class="col-sm-9"><?php echo $Payu['SuccessUrl'];?></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Failure Url</label>
            <div class="col-sm-9"><?php echo $Payu['FailureUrl'];?></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Remarks</label>
            <div class="col-sm-9"><?php echo $Payu['Remarks'];?></div>
        </div> 
        <div class="form-group row" >
            <div class="col-sm-12" style="text-align:right">
                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=All");?>" class="btn btn-default" style="padding:7px 20px" >Cancel</a>&nbsp;
            </div>
        </div>
</form>
</div>

<?php include_once("settings_footer.php");?>
                    