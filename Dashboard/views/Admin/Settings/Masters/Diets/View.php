<?php 
$page="ManageDiets";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Diet = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Diet Details</h4>
                    <div class="form-group row">
                          <label for="DietCode" class="col-sm-2 col-form-label">Diet Code</label>
                          <label for="DietCode" class="col-sm-2 col-form-label"><?php echo $Diet['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Diet" class="col-sm-2 col-form-label">Diet</label>
                          <label for="Diet" class="col-sm-2 col-form-label"><?php echo  $Diet['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="IsActive" class="col-sm-2 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-2 col-form-label"><?php echo  ($Diet['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-2" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDiets"><small>List of Diets</small></a></div>
                        <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Diet</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    