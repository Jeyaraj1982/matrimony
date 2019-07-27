<?php
  $response = $webservice->GetMasterAllViewInfo();
    $FamilyType          = $response['data']['ViewInfo'];
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
                          <label for="FamilyTypeCode" class="col-sm-3 col-form-label">Blood Group Code</label>
                          <label for="FamilyTypeCode" class="col-sm-3 col-form-label"><?php echo $FamilyType['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyType" class="col-sm-3 col-form-label">FamilyType</label>
                          <label for="FamilyType" class="col-sm-3 col-form-label"><?php echo  $FamilyType['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($FamilyType['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageFamilyType"><small>List of Family Type</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Blood Groups</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>