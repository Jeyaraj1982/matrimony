<?php 
$page="ManageMartialStatus";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <?php
  $response = $webservice->getData("Admin","GetMasterAllViewInfo");
    $MartialStatus          = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
   <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Marital Status Details</h4>
                <div class="form-group row">
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label">Marital Status Code</label>
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label"><?php echo $MartialStatus['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="MartialStatus" class="col-sm-3 col-form-label">Marital Status</label>
                          <label for="MartialStatus" class="col-sm-3 col-form-label"><?php echo  $MartialStatus['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($MartialStatus['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMartialStatus"><small>List of Marital Status</small> </a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Marital Status</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    