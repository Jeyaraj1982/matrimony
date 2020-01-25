<?php 
$page="IncomeRange";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php   
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $IncomeRange = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="">
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">IncomeRange Details</h4>                  
        <div class="form-group row">
                          <label for="IncomeRangeCode" class="col-sm-3 col-form-label">Income Range Code</label>
                          <label for="IncomeRangeCode" class="col-sm-3 col-form-label"><?php echo $IncomeRange['SoftCode'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for="IncomeRange" class="col-sm-3 col-form-label">IncomeRange</label>
                          <label for="IncomeRange" class="col-sm-3 col-form-label"><?php echo  $IncomeRange['CodeValue'];?></label>
                      </div>
                      <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($IncomeRange['IsActive']) ? "Active" : "DeActive";?></label>
                      </div>
                      <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageIncomeRanges"><small>List of Income Ranges</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Income Range</a> </div>
                      </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    