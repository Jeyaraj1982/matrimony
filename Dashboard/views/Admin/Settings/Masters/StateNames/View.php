<?php 
$page="ManageState";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $StateName = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">State Name Details</h4>
                   <div class="form-group row">
                          <label for="StateCode" class="col-sm-3 col-form-label">State Code</label>
                          <label for="StateCode" class="col-sm-3 col-form-label"><?php echo $StateName['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="StateName" class="col-sm-3 col-form-label">StateName</label>
                          <label for="StateName" class="col-sm-3 col-form-label"><?php echo  $StateName['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($StateName['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                         <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageState"><small>List of State Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add State Name</a> </div>
                       </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    