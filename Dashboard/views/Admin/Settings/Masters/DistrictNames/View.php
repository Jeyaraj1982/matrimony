<?php 
$page="ManageDistrict";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");            
    $DistrictName = $response['data']['ViewInfo'];
?>
<form method="post" action="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">District Name Details</h4>  
                      <div class="form-group row">
                          <label for="DistrictCode" class="col-sm-3 col-form-label">District Code</label>
                          <label for="DistrictCode" class="col-sm-3 col-form-label"><?php echo $DistrictName['SoftCode'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for=">DistrictName" class="col-sm-3 col-form-label">District Name</label>
                          <label for=">DistrictName" class="col-sm-3 col-form-label"><?php echo  $DistrictName['CodeValue'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($DistrictName['IsActive']) ? "Active" : "DeActive";?></label>
                      </div>
                      <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDistrict"><small>List of District Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add District Name</a> </div>
                       </div>
                    </div>
                  </div>
                </div>
</form>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    