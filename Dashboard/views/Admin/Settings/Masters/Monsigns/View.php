<?php 
$page="ManageMonsigns";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Monsign = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Monsign Details</h4>
                <div class="form-group row">
                          <label for="MonsignCode" class="col-sm-3 col-form-label">Monsign Code</label>
                          <label for="MonsignCode" class="col-sm-3 col-form-label"><?php echo $Monsign['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Monsign" class="col-sm-3 col-form-label">Monsign</label>
                          <label for="Monsign" class="col-sm-3 col-form-label"><?php echo  $Monsign['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($Monsign['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMonsigns"><small>List of Monsigns</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family:roboto"><i class="mdi mdi-plus"></i>Add Monsign</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    