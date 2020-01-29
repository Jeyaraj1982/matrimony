<?php 
$page="ManageEducationTitles";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $EducationTitle = $response['data']['ViewInfo'];
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Masters</h4>
            <h4 class="card-title">Education Title Details</h4>
          <div class="form-group row">
                          <label for="EducationTitleCode" class="col-sm-3 col-form-label">Education Title Code</label>
                          <label for="EducationTitleCode" class="col-sm-3 col-form-label"><?php echo $EducationTitle['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="EducationTitle" class="col-sm-3 col-form-label">Education Title</label>
                          <label for="EducationTitle" class="col-sm-3 col-form-label"><?php echo  $EducationTitle['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($EducationTitle['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationTitles"><small>List of Education Titles</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family: roboto;"><i class="mdi mdi-plus"></i>Add Education Title</a> </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    