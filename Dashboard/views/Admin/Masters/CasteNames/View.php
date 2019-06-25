<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $CasteName = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Caste Name Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="CasteCode" class="col-sm-3 col-form-label">Caste Code</label>
                          <label for="CasteCode" class="col-sm-3 col-form-label"><?php echo $CasteName['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="CasteName" class="col-sm-3 col-form-label">Caste Name</label>
                          <label for="CasteName" class="col-sm-3 col-form-label"><?php echo  $CasteName['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($CasteName['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCaste"><small>List of Caste Names</small> </a>  </div>
                           <div class="col-sm-4" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Caste Name</a> </div>
                    </div>
                  </div>
                </div>
              </div>
</form>
                            