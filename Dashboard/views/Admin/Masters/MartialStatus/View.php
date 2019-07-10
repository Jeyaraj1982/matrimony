<?php
  $response = $webservice->GetMasterAllViewInfo();
    $MartialStatus          = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Marital Status Details</h4>  
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label">Marital Status Code</label>
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label"><?php echo $MartialStatus['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="MartialStatus" class="col-sm-3 col-form-label">Marital Status</label>
                          <label for="MartialStatus" class="col-sm-3 col-form-label"><?php echo  $MartialStatus['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($MartialStatus['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMartialStatus"><small>List of Marital Status</small> </a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Marital Status</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>