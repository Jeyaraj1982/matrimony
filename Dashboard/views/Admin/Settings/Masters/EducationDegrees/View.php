<?php 
$page="ManageEducationDegrees";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $EducationDegree = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" >
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
         <h4 class="card-title">Masters</h4>
         <h4 class="card-title">Education Degree Details</h4>
          <div class="form-group row">
                          <label for="EducationDegreeCode" class="col-sm-3 col-form-label">Education Degree Code</label>
                          <label for="EducationDegreeCode" class="col-sm-9 col-form-label"><?php echo $EducationDegree['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="EducationDegree" class="col-sm-3 col-form-label">Education Degree</label>
                          <label for="EducationDegree" class="col-sm-9 col-form-label"><?php echo  $EducationDegree['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($EducationDegree[0]['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationDegrees"><small>List of Education Degrees</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Education Degree</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    