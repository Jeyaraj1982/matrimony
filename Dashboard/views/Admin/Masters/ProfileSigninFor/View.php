<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $ProfileSigninFor = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Profile Signin For Details</h4>  
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="ProfileSigninFor" class="col-sm-3 col-form-label">ProfileSigninFor Code</label>
                          <label for="ProfileSigninFor" class="col-sm-3 col-form-label"><?php echo $ProfileSigninFor['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="ReligionName" class="col-sm-3 col-form-label">Religion Name</label>
                          <label for="ReligionName" class="col-sm-3 col-form-label"><?php echo  $ProfileSigninFor['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($ProfileSigninFor['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageProfileSigninFor"><small>List of ProfileSigninFor</small> </a>  </div>
                            <div class="col-sm-6"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Profile SigninFor</a> </div>
                       </div>
                </div>
              </div>
            </div>
</form>