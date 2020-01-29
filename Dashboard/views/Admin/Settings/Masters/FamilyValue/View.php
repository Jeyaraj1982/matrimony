<?php 
$page="ManageFamilyValue";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $FamilyValue = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">FamilyValue  Details</h4>
                 <div class="form-group row">
                          <label for="FamilyValueCode" class="col-sm-3 col-form-label">Family Value  Code</label>
                          <label for="FamilyValueCode" class="col-sm-3 col-form-label"><?php echo $FamilyValue['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyValue " class="col-sm-3 col-form-label">FamilyValue </label>
                          <label for="FamilyValue " class="col-sm-3 col-form-label"><?php echo  $FamilyValue['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($FamilyValue['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                      <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageFamilyValue">List of Family Values</a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2" style="font-family:roboto"><i class="mdi mdi-plus"></i>Add Family Value </a> </div>
                       </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    