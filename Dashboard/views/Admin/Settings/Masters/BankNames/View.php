<?php 
$page="ManageBank";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $BankName = $response['data']['ViewInfo'];
    ?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewBankName();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>  
                <h4 class="card-title">Bank Name Details</h4>
                    <div class="form-group row">
                          <label for="BankCode" class="col-sm-3 col-form-label">Bank Code</label>
                          <label for="BankCode" class="col-sm-3 col-form-label"><?php echo $BankName['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="BankName" class="col-sm-3 col-form-label">Bank Name</label>
                          <label for="BankName" class="col-sm-3 col-form-label"><?php echo  $BankName['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($BankName['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBank"><small>List of Bank Names</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family: roboto;"><i class="mdi mdi-plus"></i>Add Bank Name</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    