<?php $page="ccavenue";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $Ccavenue = $res['data']['CCavenue']; 
?>
<div class="col-sm-10 rightwidget">
    <h4 class="card-title">View CCavenue</h4>                    
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['VenderName'];?></div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo</label>
                          <div class="col-sm-9"><img src="<?php echo AppUrl;?>uploads/CCavenue/<?php echo $Ccavenue['VendorLogo'];?>" style="height:200px;width:150px"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['MarchantID'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['Secretky'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode</label>
                            <div class="col-sm-4"><?php echo $Ccavenue[ 'VendorMode'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-3"><?php
                              if($Ccavenue['VendorStatus']=="1"){
                                  echo "Active";
                              } else{ echo "Deactive"; }?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['SuccessUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['FailureUrl'];?></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9"><?php echo $Ccavenue['Remarks'];?></div>
                        </div>
                       <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                            </div>
                        </div>

<?php include_once("settings_footer.php");?>                    