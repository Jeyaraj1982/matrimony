<?php
    if (isset($_POST['BtnUpdateWeight'])) {
        
        $duplicateWeight = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Weight']."' and  HardCode='WEIGHTS' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateWeight)==0) {
        $WeightsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Weight']."',IsActive='".$_POST['IsActive']."' where HardCode='WEIGHTS' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorWeight = "Weight already exists";
            echo "$errorWeight";
        }
    }
    $Weight = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewWeight() {
                        $('#ErrWeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Weight","ErrWeight","Please Enter Valid Weight");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewWeight();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Weight</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="WeightCode" class="col-sm-3 col-form-label"><small>Weight Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="WeightCode" name="WeightCode" value="<?php echo $Weight[0]['SoftCode'];?>" placeholder="Weight Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Weight" class="col-sm-3 col-form-label"><small>Weight<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Weight" name="Weight" maxlength="100" value="<?php echo (isset($_POST['Weight']) ? $_POST['Weight'] : $Weight[0]['CodeValue']);?>" placeholder="Weight">
                             <span class="errorstring" id="ErrWeight"><?php echo isset($ErrWeight)? $ErrWeight : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Weight[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Weight[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateWeight" class="btn btn-success mr-2">Update Weight</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageWeights"><small>List of Weights</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>