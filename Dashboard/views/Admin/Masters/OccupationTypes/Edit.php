<?php
    if (isset($_POST['BtnUpdateOccupationType'])) {
        
        $duplicateOccupationType = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['OccupationType']."' and  HardCode='OCCUPATIONTYPES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateOccupationType)==0) {
        $OccupationTypesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['OccupationType']."',IsActive='".$_POST['IsActive']."' where HardCode='OCCUPATIONTYPES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorOccupationType = "Occupation Type already exists";
            echo "$errorOccupationType";
        }
    }
    $OccupationType = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewOccupationType() {
                        $('#ErrOccupationType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("OccupationType","ErrOccupationType","Please Enter Valid Occupation Type");
                        IsAlphabet("OccupationType","ErrOccupationType","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewOccupationType();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit OccupationType</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="OccupationTypeCode" class="col-sm-3 col-form-label"><small>OccupationType Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="OccupationTypeCode" name="OccupationTypeCode" value="<?php echo $OccupationType[0]['SoftCode'];?>" placeholder="Occupation Type Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="OccupationType" class="col-sm-3 col-form-label"><small>OccupationType<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationType" maxlength="100" name="OccupationType" value="<?php echo (isset($_POST['OccupationType']) ? $_POST['OccupationType'] : $OccupationType[0]['CodeValue']);?>" placeholder="Occupation Type">
                            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($OccupationType[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($OccupationType[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateOccupationType" class="btn btn-success mr-2">Update OccupationType</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageOccupationTypes"><small>List of Occupation Types</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>