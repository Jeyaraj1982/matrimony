<?php
    if (isset($_POST['BtnUpdateLakanam'])) {
        
        $duplicateLakanam = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Lakanam']."' and  HardCode='LAKANAM' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateLakanam)==0) {
        $LakanamsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Lakanam']."',IsActive='".$_POST['IsActive']."' where HardCode='LAKANAM' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorLakanam = "Lakanam already exists";
            echo "$errorLakanam";
        }
    }
    $Lakanam = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewLakanam() {
                        $('#ErrLakanam').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Lakanam","ErrLakanam","Please Enter Valid Lakanam");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewLakanam();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Lakanam</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="LakanamCode" class="col-sm-3 col-form-label"><small>Lakanam Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="LakanamCode" name="LakanamCode" value="<?php echo $Lakanam[0]['SoftCode'];?>" placeholder="Lakanam Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Lakanam" class="col-sm-3 col-form-label"><small>Lakanam<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Lakanam" maxlength="100" name="Lakanam" value="<?php echo (isset($_POST['Lakanam']) ? $_POST['Lakanam'] : $Lakanam[0]['CodeValue']);?>" placeholder="Lakanam">
                            <span class="errorstring" id="ErrLakanam"><?php echo isset($ErrLakanam)? $ErrLakanam : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Lakanam[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Lakanam[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateLakanam" class="btn btn-success mr-2">Update Lakanam</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLakanam"><small>List of Lakanams</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>