<?php 
$page="CountryNames";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $CountryName = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Country Name Details</h4>  
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="CountryCode" class="col-sm-3 col-form-label">Country Code</label>
                          <label for="CountryCode" class="col-sm-3 col-form-label"><?php echo $CountryName['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CountryName" class="col-sm-3 col-form-label">Country Name</label>
                          <label for="CountryName" class="col-sm-3 col-form-label"><?php echo  $CountryName['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CountryStdCode" class="col-sm-3 col-form-label">Country Std Code</label>
                          <label for="CountryStdCode" class="col-sm-3 col-form-label"><?php echo  $CountryName['ParamA'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CountryStdCode" class="col-sm-3 col-form-label">Currency String</label>
                          <label for="CountryStdCode" class="col-sm-3 col-form-label"><?php echo  $CountryName['ParamB'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CountryStdCode" class="col-sm-3 col-form-label">Currency Sub String</label>
                          <label for="CountryStdCode" class="col-sm-3 col-form-label"><?php echo  $CountryName['ParamC'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CountryStdCode" class="col-sm-3 col-form-label">Currency Short String</label>
                          <label for="CountryStdCode" class="col-sm-3 col-form-label"><?php echo  $CountryName['ParamD'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($CountryName['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCountry"><small>List of Country Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Country Name</a> </div>
                       </div>
                    </div>
                  </div>
                </div>
</form>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    