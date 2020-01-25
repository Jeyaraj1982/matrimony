<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $FamilyAffluence = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Family Affluence  Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="FamilyAffluenceCode" class="col-sm-3 col-form-label">Family Affluence Code</label>
                          <label for="FamilyAffluenceCode" class="col-sm-3 col-form-label"><?php echo $FamilyAffluence['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyAffluence " class="col-sm-3 col-form-label">Family Affluence </label>
                          <label for="FamilyAffluence " class="col-sm-3 col-form-label"><?php echo  $FamilyAffluence['CodeValue'];?></label>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($FamilyAffluence['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                      <div class="form-group row">
                        <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageAffluence">List of Family Affluence</a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2" style="font-family:roboto"><i class="mdi mdi-plus"></i>Add Family Value </a> </div>
                       </div>
                    </div>
                  </div>
                </div>
</form>