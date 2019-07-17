<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $Lakanam = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Lakanam Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="LakanamCode" class="col-sm-3 col-form-label">Lakanam Code</label>
                          <label for="LakanamCode" class="col-sm-3 col-form-label"><?php echo $Lakanam['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Lakanam" class="col-sm-3 col-form-label">Lakanam</label>
                          <label for="Lakanam" class="col-sm-3 col-form-label"><?php echo  $Lakanam['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                           <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($Lakanam['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLakanam">List of Lakanam</a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family: roboto;"><i class="mdi mdi-plus"></i>Add Lakanam</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>