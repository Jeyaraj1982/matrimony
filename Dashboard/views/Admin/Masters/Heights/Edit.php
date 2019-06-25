<?php
    if (isset($_POST['BtnUpdateHeight'])) {
        
        $duplicateHeight = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Height']."' and  HardCode='SoftCode' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateHeight)==0) {
        $HeightsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Height']."',IsActive='".$_POST['IsActive']."' where HardCode='HEIGHTS' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorHeight = "Height already exists";
            echo "$errorHeight";
        }
    }
    $Height = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewHeight() {
                        $('#ErrHeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Height","ErrHeight","Please Enter Valid Height");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewHeight();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Height</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="HeightCode" class="col-sm-3 col-form-label"><small>Height Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="HeightCode" name="HeightCode" value="<?php echo $Height[0]['SoftCode'];?>" placeholder="Height Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Height" class="col-sm-3 col-form-label"><small>Height<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Height" name="Height" maxlength="100" value="<?php echo (isset($_POST['Height']) ? $_POST['Height'] : $Height[0]['CodeValue']);?>" placeholder="Height">
                            <span class="errorstring" id="ErrHeight"><?php echo isset($ErrHeight)? $ErrHeight : "";?></span>
                         </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Height[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Height[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateHeight" class="btn btn-success mr-2">Update Height</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageHeights"><small>List of Heights</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>