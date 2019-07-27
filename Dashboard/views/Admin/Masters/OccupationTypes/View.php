<?php
     $response     = $webservice->GetMasterAllViewInfo();
    $OccupationType = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Occupation Type Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="OccupationTypeCode" class="col-sm-3 col-form-label">Occupation Type Code</label>
                          <label for="OccupationTypeCode" class="col-sm-3 col-form-label"><?php echo $OccupationType['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="OccupationType" class="col-sm-3 col-form-label">OccupationType</label>
                          <label for="OccupationType" class="col-sm-3 col-form-label"><?php echo  $OccupationType['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($OccupationType['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageOccupationTypes"><small>List of Occupation Types</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family: roboto;"><i class="mdi mdi-plus"></i>Add Occupation Type</a> </div>
                    </div>
                  </div>
                </div>                                                             
              </div>
</form> 