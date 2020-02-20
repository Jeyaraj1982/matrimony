<?php 
$page="WebsiteSettings";
include_once("views/Admin/Settings/ApplicationSettings/settings_header.php");
?>
<script>
 function SubmitSettings() {
                         $('#ErrString').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("String","ErrString","Please Enter String");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveSettings'])) {   
    $response = $webservice->getData("Admin","AddWebsiteSettings",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $WebSettingsCode = $webservice->getData("Admin","GetMastersSettingsCode"); 
     $GetNextWebSettingsCode="";
        if ($WebSettingsCode['status']=="success") {
            $GetNextWebSettingsCode  =$WebSettingsCode['data']['WebSettingsCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitSettings();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Website Settings</h4>
                    <div class="form-group row">
                      <label for="Weight Code" class="col-sm-3 col-form-label">Web Settings Code<span id="star">*</span></label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="WebSettingsCode" name="WebSettingsCode" maxlength="10" value="<?php echo isset($_POST['WebSettingsCode']) ? $_POST['WebSettingsCode'] : $GetNextWebSettingsCode;?>" placeholder="Web Settings Code">
                        <span class="errorstring" id="ErrWebSettingsCode"><?php echo isset($ErrWebSettingsCode)? $ErrWebSettingsCode : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">String<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="String" name="String" value="<?php echo (isset($_POST['String']) ? $_POST['String'] : "");?>" placeholder="String">
                        <span class="errorstring" id="ErrString"><?php echo isset($ErrString)? $ErrString : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">&nbsp;</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="DataType" id="DataType" onchange="addDataSet()">
                            <option value="string" <?php echo ($_POST[ 'DataType']=="string") ? " selected='selected' " : "";?>>String</option> 
                            <option value="boolean" <?php echo ($_POST[ 'DataType']=="boolean") ? " selected='selected' " : "";?>>Boolean</option> 
                            <option value="DataSet" <?php echo ($_POST[ 'DataType']=="DataSet") ? " selected='selected' " : "";?>>Data Set</option> 
                        </select>
                      </div>
                    </div>
                    <div id="DatasetAdd" class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">&nbsp;</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="DataTypes" id="DataTypes">
                            <?php foreach($WebSettingsCode['data']['CodeMasterDatas'] as $cm) { ?>
                                <option value="<?php echo $cm['SoftCode'];?>" <?php echo (isset($_POST[ 'DataTypes'])) ? (($_POST[ 'DataTypes']==$cm[ 'SoftCode']) ? " selected='selected' " : "") : "";?>><?php echo trim($cm['CodeValue']);?></option>
                            <?php } ?> 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">ParamA<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamA" name="ParamA" value="<?php echo (isset($_POST['ParamA']) ? $_POST['ParamA'] : "");?>" placeholder="ParamA">
                        <span class="errorstring" id="ErrParamA"><?php echo isset($ErrParamA)? $ErrParamA : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">ParamC<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamC" name="ParamC" value="<?php echo (isset($_POST['ParamC']) ? $_POST['ParamC'] : "");?>" placeholder="ParamC">
                        <span class="errorstring" id="ErrParamC"><?php echo isset($ErrParamC)? $ErrParamC : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">ParamD<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamD" name="ParamD" value="<?php echo (isset($_POST['ParamD']) ? $_POST['ParamD'] : "");?>" placeholder="ParamD">
                        <span class="errorstring" id="ErrParamD"><?php echo isset($ErrParamD)? $ErrParamD : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weight" class="col-sm-3 col-form-label">ParamE<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamE" name="ParamE" value="<?php echo (isset($_POST['ParamE']) ? $_POST['ParamE'] : "");?>" placeholder="ParamE">
                        <span class="errorstring" id="ErrParamE"><?php echo isset($ErrParamE)? $ErrParamE : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnSaveSettings" id="BtnSaveSettings"  class="btn btn-primary mr-2" style="font-family: roboto;">Save Settings</button> </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="WebsiteSettings">List of Settings </a>  </div>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<script>
function addDataSet() {
        if ($('#DataType').val()=="DataSet") {
            $('#DatasetAdd').show();
        } else {
            $('#DatasetAdd').hide();
        }
        }
        addDataSet();
</script>
<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    