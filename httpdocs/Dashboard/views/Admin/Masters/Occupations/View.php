<?php
    $Occupation = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Occupation Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="OccupationCode" class="col-sm-3 col-form-label"><small>Occupation Code</small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#fff;border:1px solid #fff" class="form-control" id="OccupationCode" name="OccupationCode" value="<?php echo $Occupation[0]['SoftCode'];?>" placeholder="Occupation Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation" class="col-sm-3 col-form-label"><small>Occupation</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Occupation" readonly="readonly" name="Occupation" value="<?php echo  $Occupation[0]['CodeValue'];?>" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Occupation" name="Occupation" value="<?php echo  ($Occupation[0]['IsActive']) ? "Active" : "DeActive";?>" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageOccupations"><small>List of Occupations</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-success mr-2"><i class="mdi mdi-plus"></i>Add Occupation</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>