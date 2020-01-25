<?php 
$page="Nationality";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $NationalityName = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewNationalityName();">   
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">View Nationality Name</h4>                   
        <div class="form-group row">
                          <label for="NationalityCode" class="col-sm-3 col-form-label">Nationality Code</label>
                          <label for="NationalityCode" class="col-sm-3 col-form-label"><?php echo $NationalityName['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="NationalityName" class="col-sm-3 col-form-label">Nationality Name</label>
                          <label for="NationalityName" class="col-sm-3 col-form-label"><?php echo  $NationalityName['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                            <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                            <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($NationalityName['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageNationalityName"><small>List of Nationality Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Nationality Name</a> </div>
                       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    