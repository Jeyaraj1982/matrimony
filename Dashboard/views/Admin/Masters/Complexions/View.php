<?php
$response     = $webservice->GetMasterAllViewInfo();
    $Complexion = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Complexion Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="ComplexionCode" class="col-sm-3 col-form-label">Complexion Code</label>
                          <label for="ComplexionCode" class="col-sm-3 col-form-label"><?php echo $Complexion['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Complexion" class="col-sm-3 col-form-label">Complexion</label>
                          <label for="Complexion" class="col-sm-3 col-form-label"><?php echo  $Complexion['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($Complexion['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageComplexions"><small>List of Complexions</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Complexions</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>