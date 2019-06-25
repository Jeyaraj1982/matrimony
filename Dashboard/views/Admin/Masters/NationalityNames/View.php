<?php
    $NationalityName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Nationality Name Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="NationalityCode" class="col-sm-3 col-form-label">Nationality Code</label>
                          <label for="NationalityCode" class="col-sm-3 col-form-label"><?php echo $NationalityName[0]['SoftCode'];?></label>
                        </div>
                        <div class="form-group row">
                          <label for="NationalityName" class="col-sm-3 col-form-label">Nationality Name</label>
                          <label for="NationalityName" class="col-sm-3 col-form-label"><?php echo  $NationalityName[0]['CodeValue'];?></label>
                        </div>
                        <div class="form-group row">
                            <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                            <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($NationalityName[0]['IsActive']) ? "Active" : "DeActive";?></label>
                        </div>
                        <div class="form-group row">
                       <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageNationalityName"><small>List of Nationality Names</small> </a>  </div>
                       <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Nationality Name</a> </div>
                       </div>
                    </div>
                  </div>
                </div>
</form>