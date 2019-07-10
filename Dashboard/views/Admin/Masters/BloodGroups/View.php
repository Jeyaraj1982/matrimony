<?php
  $response = $webservice->GetMasterAllViewInfo();
    $BloodGroup          = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Blood Group Details</h4>  
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="BloodGroupCode" class="col-sm-3 col-form-label">Blood Group Code</label>
                          <label for="BloodGroupCode" class="col-sm-3 col-form-label"><?php echo $BloodGroup['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="BloodGroup" class="col-sm-3 col-form-label">BloodGroup</label>
                          <label for="BloodGroup" class="col-sm-3 col-form-label"><?php echo  $BloodGroup['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($BloodGroup['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBloodGroups"><small>List of Blood Groups</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Blood Groups</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>