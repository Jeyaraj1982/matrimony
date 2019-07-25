<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $EducationDegree = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Education Degree Details</h4>  
                      <form class="forms-sample">
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
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationDegrees"><small>List of Education Degrees</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Education Degree</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>