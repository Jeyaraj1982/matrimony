<?php 
$page="ManageTimeZone";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php
  $response = $webservice->getData("Admin","GetMasterAllViewInfo");
    $TimeZone          = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card"> 
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">TimeZone Details</h4>  
                      <div class="form-group row">
                          <label for="ReligionCode" class="col-sm-3 col-form-label">TimeZone Code</label>
                          <label for="ReligionCode" class="col-sm-3 col-form-label"><?php echo $TimeZone ['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="ReligionName" class="col-sm-3 col-form-label">TimeZone </label>
                          <label for="ReligionName" class="col-sm-3 col-form-label"><?php echo  $TimeZone ['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($TimeZone ['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageTimeZone "><small>List of TimeZone </small> </a>  </div>
                            <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add TimeZone </a> </div>
                       </div>
          </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    