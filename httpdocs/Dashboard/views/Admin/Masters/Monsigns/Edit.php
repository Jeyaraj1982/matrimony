<?php
    if (isset($_POST['BtnUpdateMonsign'])) {
        
        $duplicateMonsign = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['RelMonsignigionName']."' and  HardCode='MONSIGNS' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateMonsign)==0) {
        $MonsignsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Monsign']."',IsActive='".$_POST['IsActive']."' where HardCode='MONSIGNS' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorMonsign = "Monsign already exists";
            echo "$errorMonsign";
        }
    }
    $Monsign = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewMonsign() {
                        $('#ErrMonsign').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Monsign","ErrMonsign","Please Enter Valid Monsign");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewMonsign();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Monsign</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="MonsignCode" class="col-sm-3 col-form-label"><small>Monsign Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="MonsignCode" name="MonsignCode" value="<?php echo $Monsign[0]['SoftCode'];?>" placeholder="Monsign Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Monsign" class="col-sm-3 col-form-label"><small>Monsign<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Monsign" name="Monsign" maxlength="100" value="<?php echo (isset($_POST['Monsign']) ? $_POST['Monsign'] : $Monsign[0]['CodeValue']);?>" placeholder="Monsign">
                            <span class="errorstring" id="ErrMonsign"><?php echo isset($ErrMonsign)? $ErrMonsign : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Monsign[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Monsign[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateMonsign" class="btn btn-success mr-2">Update Monsign</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMonsigns"><small>List of Monsigns</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>