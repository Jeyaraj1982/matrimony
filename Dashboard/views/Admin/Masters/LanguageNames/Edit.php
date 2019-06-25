<?php
    if (isset($_POST['BtnUpdateLanguageName'])) {
        
         $duplicateLanguageName = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['LanguageName']."' and  HardCode='LANGUAGENAMES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateLanguageName)==0) {
        $LanguageNamesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['LanguageName']."',IsActive='".$_POST['IsActive']."' where HardCode='LANGUAGENAMES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorLanguageName = "Language Name already exists";
            echo "$errorLanguageName";
        }
    }
    $LanguageName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewLanguageName() {
                        $('#ErrLanguageName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("LanguageName","ErrLanguageName","Please Enter Valid Language Name");
                        IsAlphabet("LanguageName","ErrLanguageName","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewLanguageName();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Language Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="LanguageCode" class="col-sm-3 col-form-label"><small>Language Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="LanguageCode" name="LanguageCode" value="<?php echo $LanguageName[0]['SoftCode'];?>" placeholder="Language Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="LanguageName" class="col-sm-3 col-form-label"><small>Language Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" maxlength="100" name="LanguageName" value="<?php echo (isset($_POST['LanguageName']) ? $_POST['LanguageName'] : $LanguageName[0]['CodeValue']);?>" placeholder="Language Name">
                            <span class="errorstring" id="ErrLanguageName"><?php echo isset($ErrLanguageName)? $ErrLanguageName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($LanguageName[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($LanguageName[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateLanguageName" class="btn btn-success mr-2">Update Language Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLanguage"><small>List of Language Names</small></a> </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>