<?php 
$page="Star";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 
<div class="col-sm-10 rightwidget">
<?php   
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $StarName = $response['data']['ViewInfo'];
?> 
<form method="post" action="" onsubmit="return SubmitNewStarName();">   
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">Star Name Details</h4>                  
        <div class="form-group row">
                          <label for="StarCode" class="col-sm-3 col-form-label">Star Code</label>
                          <label for="StarCode" class="col-sm-3 col-form-label"><?php echo $StarName['SoftCode'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for="StarName" class="col-sm-3 col-form-label">StarName</label>
                          <label for="StarName" class="col-sm-3 col-form-label"><?php echo  $StarName['CodeValue'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($StarName['IsActive']) ? "Active" : "DeActive";?></label>
                      </div>
                      <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageStar"><small>List of Star Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Star Name</a> </div>
                       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    