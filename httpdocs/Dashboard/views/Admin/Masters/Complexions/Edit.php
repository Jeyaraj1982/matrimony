<?php
    if (isset($_POST['BtnUpdateComplexion'])) {
        
         $duplicateComplexion = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Complexion']."' and  HardCode='COMPLEXIONS' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateComplexion)==0) {
        $ComplexionsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Complexion']."',IsActive='".$_POST['IsActive']."' where HardCode='COMPLEXIONS' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorComplexion = "Complexion already exists";
            echo "$errorComplexion";
        }
    }
    $Complexion = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewComplexion() {
                        $('#ErrComplexion').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Complexion","ErrComplexion","Please Enter Valid Complexion");
                        IsAlphabet("Complexion","ErrComplexion","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewComplexion();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Complexion</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="ComplexionCode" class="col-sm-3 col-form-label"><small>Complexion Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="ComplexionCode" name="ComplexionCode" value="<?php echo $Complexion[0]['SoftCode'];?>" placeholder="Complexion Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Complexion" class="col-sm-3 col-form-label"><small>Complexion<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Complexion" name="Complexion" maxlength="100" value="<?php echo (isset($_POST['Complexion']) ? $_POST['Complexion'] : $Complexion[0]['CodeValue']);?>" placeholder="Complexion">
                            <span class="errorstring" id="ErrComplexion"><?php echo isset($ErrComplexion)? $ErrComplexion : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Complexion[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Complexion[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateComplexion" class="btn btn-success mr-2">Update Complexion</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageComplexions"><small>List of Complexions</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>