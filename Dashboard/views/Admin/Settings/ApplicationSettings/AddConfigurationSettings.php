<?php 
$page="ConfigurationSettings";
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
    $response = $webservice->getData("Admin","AddConfigurationSettings",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $AppSettingsCode = $webservice->getData("Admin","GetMastersSettingsCode"); 
     $GetNextAppSettingsCode="";
        if ($AppSettingsCode['status']=="success") {
            $GetNextAppSettingsCode  =$AppSettingsCode['data']['AppSettingsCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitSettings();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Configuration Settings</h4>
                    <div class="form-group row">
                      <label for="AppSettingsCode" class="col-sm-3 col-form-label">App Settings Code<span id="star">*</span></label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="AppSettingsCode" name="AppSettingsCode" maxlength="10" value="<?php echo isset($_POST['AppSettingsCode']) ? $_POST['AppSettingsCode'] : $GetNextAppSettingsCode;?>" placeholder="App Settings Code">
                        <span class="errorstring" id="ErrAppSettingsCode"><?php echo isset($ErrAppSettingsCode)? $ErrAppSettingsCode : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="String" class="col-sm-3 col-form-label">String<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="String" name="String" value="<?php echo (isset($_POST['String']) ? $_POST['String'] : "");?>" placeholder="String">
                        <span class="errorstring" id="ErrString"><?php echo isset($ErrString)? $ErrString : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="DataType" class="col-sm-3 col-form-label">&nbsp;</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="DataType" id="DataType" onchange="addDataSet()">
                            <option value="string" <?php echo ($_POST[ 'DataType']=="string") ? " selected='selected' " : "";?>>String</option> 
                            <option value="boolean" <?php echo ($_POST[ 'DataType']=="boolean") ? " selected='selected' " : "";?>>Boolean</option> 
                            <option value="DataSet" <?php echo ($_POST[ 'DataType']=="DataSet") ? " selected='selected' " : "";?>>Data Set</option> 
                        </select>
                         <span class="errorstring" id="ErrDataType"><?php echo isset($ErrDataType)? $ErrDataType : "";?></span>
                      </div>
                    </div>
                    <div id="DatasetAdd" class="form-group row">
                      <label for="DataTypes" class="col-sm-3 col-form-label">&nbsp;</label>
                      <div class="col-sm-5">
                        <select class="form-control" name="DataTypes" id="DataTypes" onchange="getDataTypeDatas($(this).val())">
                            <?php foreach($AppSettingsCode['data']['CodeMasterDatas'] as $cm) { ?>
                                <option value="<?php echo $cm['SoftCode'];?>" <?php echo (isset($_POST[ 'DataTypes'])) ? (($_POST[ 'DataTypes']==$cm[ 'SoftCode']) ? " selected='selected' " : "") : "";?>><?php echo trim($cm['CodeValue']);?></option>
                            <?php } ?> 
                        </select>
                        <span class="errorstring" id="ErrDataTypes"><?php echo isset($ErrDataTypes)? $ErrDataTypes : "";?></span>
                      </div>
                      <div class="col-sm-4">
                        <select class="form-control" name="Datas" id="Datas">
                            <option value="0">--Choose --</option>
                        </select>
                        <span class="errorstring" id="ErrDatas"><?php echo isset($ErrDatas)? $ErrDatas : "";?></span>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="CodeDescription" class="col-sm-3 col-form-label">Code Description<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="CodeDescription" name="CodeDescription" value="<?php echo (isset($_POST['CodeDescription']) ? $_POST['CodeDescription'] : "");?>" placeholder="CodeDescription">
                        <span class="errorstring" id="ErrCodeDescription"><?php echo isset($ErrCodeDescription)? $ErrCodeDescription : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ParamA" class="col-sm-3 col-form-label">Value<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamA" name="ParamA" value="<?php echo (isset($_POST['ParamA']) ? $_POST['ParamA'] : "");?>" placeholder="ParamA">
                        <span class="errorstring" id="ErrParamA"><?php echo isset($ErrParamA)? $ErrParamA : "";?></span>
                      </div>
                    </div>
                  <!--  <div class="form-group row">
                      <label for="ParamC" class="col-sm-3 col-form-label">ParamC<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamC" name="ParamC" value="<?php echo (isset($_POST['ParamC']) ? $_POST['ParamC'] : "");?>" placeholder="ParamC">
                        <span class="errorstring" id="ErrParamC"><?php echo isset($ErrParamC)? $ErrParamC : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="ParamD" class="col-sm-3 col-form-label">ParamD<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="ParamD" name="ParamD" value="<?php echo (isset($_POST['ParamD']) ? $_POST['ParamD'] : "");?>" placeholder="ParamD">
                        <span class="errorstring" id="ErrParamD"><?php echo isset($ErrParamD)? $ErrParamD : "";?></span>
                      </div>
                    </div> -->
                    <div class="form-group row">
                      <label for="ParamE" class="col-sm-3 col-form-label">Add To Class<span id="star">*</span></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="ParamE" id="ParamE">
                            <option value="1" <?php echo ($_POST['ParamE']=="1") ? " selected='selected' " : "";?>>Yes</option> 
                            <option value="0" <?php echo ($_POST['ParamE']=="0") ? " selected='selected' " : "";?>>No</option> 
                        </select>
                        <span class="errorstring" id="ErrParamE"><?php echo isset($ErrParamE)? $ErrParamE : "";?></span>
                      </div>
                    </div>
                    <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnSaveSettings" id="BtnSaveSettings"  class="btn btn-primary mr-2" style="font-family: roboto;">Save Settings</button> </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ConfigurationSettings">List of Settings </a>  </div>
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
function getDataTypeDatas(DataTypeCode,DataCode) {
        DataCode = (typeof DataCode !== 'undefined') ?  DataCode : "0";
        $('#Datas').empty().append('<option value="0">--Choose--</option>');
        $("#ErrDatas").html("Please select"); 
        if(DataTypeCode !="0"){
        $.ajax({url: getAppUrl() + "action=getMasterDatas&DataTypeCode="+DataTypeCode,success: function(result){
            var obj = JSON.parse(result.trim());
            $.when (
                $.each(obj, function () {
                    var opt = document.createElement('option');
                    opt.value = this.stcode;
                    opt.innerHTML = this.stname;
                    if (DataCode == opt.value) {
                        opt.setAttribute("Selected", "Selected");
                    }
                    document.getElementById('Datas').appendChild(opt);
                })
            ).then(function(){
                $('#Datas') .selectpicker('refresh');
            });
        }});
        } else {
        $("#ErrDataType").html("Please select Data Type");     
        }
    }
</script>
<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    