<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $Occupation = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Occupation Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="OccupationCode" class="col-sm-3 col-form-label">Occupation Code</label>
                          <label for="OccupationCode" class="col-sm-3 col-form-label"><?php echo $Occupation['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation" class="col-sm-3 col-form-label">Occupation</label>
                          <label for="Occupation" class="col-sm-3 col-form-label"><?php echo  $Occupation['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($Occupation['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageOccupations">List of Occupations</a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2" style="font-family:roboto"><i class="mdi mdi-plus"></i>Add Occupation</a> </div>
                    </div>
                  </div>
                </div>
              </div>
</form>