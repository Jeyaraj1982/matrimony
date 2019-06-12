<?php
    if (isset($_POST['BtnUpdateDiet'])) {
        
         $duplicateDiet = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Diet']."' and  HardCode='DIETS' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateDiet)==0) {
        $DietID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Diet']."',IsActive='".$_POST['IsActive']."' where HardCode='DIETS' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorDiet = "Diet already exists";
            echo "$errorDiet";
        }
    }
    $Diet = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewDiet() {
                        $('#ErrDiet').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Diet","ErrDiet","Please Enter Valid Diet");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewDiet();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Diet</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="DietCode" class="col-sm-3 col-form-label"><small>Diet Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="DietCode" name="DietCode" value="<?php echo $Diet[0]['SoftCode'];?>" placeholder="Diet Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Diet" class="col-sm-3 col-form-label"><small>Diet<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Diet" name="Diet" maxlength="100" value="<?php echo (isset($_POST['Diet']) ? $_POST['Diet'] : $Diet[0]['CodeValue']);?>" placeholder="Diet">
                            <span class="errorstring" id="ErrDiet"><?php echo isset($ErrDiet)? $ErrDiet : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Diet[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Diet[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateDiet" class="btn btn-success mr-2">Update Diet</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDiets"><small>List of Diets</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>