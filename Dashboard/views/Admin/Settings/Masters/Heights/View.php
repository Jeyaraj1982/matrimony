<?php 
$page="ManageHeights";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Height = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Height Details</h4>
                <div class="form-group row">
                          <label for="HeightCode" class="col-sm-3 col-form-label">Height Code</label>
                          <label for="HeightCode" class="col-sm-3 col-form-label"><?php echo $Height['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Height" class="col-sm-3 col-form-label">Height</label>
                          <label for="Height" class="col-sm-3 col-form-label"><?php echo  $Height['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($Height['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageHeights"><small>List of Heights</small></a></div>
                        <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Height</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
 
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    