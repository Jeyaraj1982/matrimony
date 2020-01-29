<?php 
$page="ManageLanguage";
include_once("views/Admin/Settings/Masters/settings_header.php");
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
<?php   
    if (isset($_POST['BtnUpdateLanguageName'])) {
        
        $response = $webservice->getData("Admin","EditLanguageName",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $LanguageName = $response['data']['ViewInfo'];
?> 
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewLanguageName();">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Edit Language Name</h4>
                    <div class="form-group row">
                          <label for="LanguageCode" class="col-sm-3 col-form-label">Language Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="LanguageCode" name="LanguageCode" value="<?php echo $LanguageName['SoftCode'];?>" placeholder="Language Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="LanguageName" class="col-sm-3 col-form-label">Language Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" maxlength="100" name="LanguageName" value="<?php echo (isset($_POST['LanguageName']) ? $_POST['LanguageName'] : $LanguageName['CodeValue']);?>" placeholder="Language Name">
                            <span class="errorstring" id="ErrLanguageName"><?php echo isset($ErrLanguageName)? $ErrLanguageName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($LanguageName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($LanguageName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                        </div>
                    </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateLanguageName" class="btn btn-primary mr-2">Update Language Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLanguage"><small>List of Language Names</small></a> </div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>
 
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    