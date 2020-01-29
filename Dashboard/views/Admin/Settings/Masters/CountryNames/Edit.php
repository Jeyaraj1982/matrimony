<?php 
$page="CountryNames";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<script>
$(document).ready(function () {
    $("#STDCode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrSTDCode").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#CountryCode").blur(function () {
    
        IsNonEmpty("CountryCode","ErrCountryCode","Please Enter Country Code");
                        
   });
   $("#CountryName").blur(function () {
    
        IsNonEmpty("CountryName","ErrCountryName","Please Enter Country Name");
                        
   });
   $("#STDCode").blur(function () {
    
        IsNonEmpty("STDCode","ErrSTDCode","Please Enter STD Code");
                        
   });
   $("#CurrencyString").blur(function () {
    
        IsNonEmpty("CurrencyString","ErrCurrencyString","Please Enter Currency String");
                        
   });
   $("#CurrencySubString").blur(function () {
    
        IsNonEmpty("CurrencySubString","ErrCurrencySubString","Please Enter Currency SubString");
                        
   });
   $("#CurrencyShortString").blur(function () {
    
        IsNonEmpty("CurrencyShortString","ErrCurrencyShortString","Please Enter Currency Short String");
                        
   });
   
});

 function SubmitNewCountryName() {
                         $('#ErrCountryCode').html("");
                         $('#ErrCountryName').html("");
                         $('#ErrSTDCode').html("");
                         $('#ErrCurrencyString').html("");
                         $('#ErrCurrencySubString').html("");
                         $('#ErrCurrencyShortString').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("CountryCode","ErrCountryCode","Please Enter Country Code")){
                        IsAlphaNumeric("CountryCode","ErrCountryCode","Please Enter Alphanumeric Charactors only");
                        }
                        if (IsNonEmpty("CountryName","ErrCountryName","Please Enter Country Name")){
                        IsAlphabet("CountryName","ErrCountryName","Please Enter Alphabet Charactors only");
                        }
                        IsNonEmpty("STDCode","ErrSTDCode","Please Enter STD Code");
                        
                        if ($('#CurrencyString').val().trim().length>0) {
                            IsNonEmpty("CurrencyString","ErrCurrencyString","Please Enter Currency String");
                            AlphaNumeric("CurrencyString","ErrCurrencyString","Please Enter Currency String");
                        }
                        
                        if ($('#CurrencySubString').val().trim().length>0) {
                        IsNonEmpty("CurrencySubString","ErrCurrencySubString","Please Enter Currency SubString");
                        IsAlphaNumeric("CurrencySubString","ErrCurrencySubString","Please Enter Alphanumeric Charactors only");
                        }
                        if ($('#CurrencyShortString').val().trim().length>0) {
                        IsNonEmpty("CurrencyShortString","ErrCurrencyShortString","Please Enter CurrencyShortString");
                        IsAlphaNumeric("CurrencyShortString","ErrCurrencyShortString","Please Enter Alphanumeric Charactors only");
                        }
                        
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php   
    if (isset($_POST['BtnUpdateCountryName'])) {
        
        $response = $webservice->getData("Admin","EditCountryName",$_POST); 
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $CountryName = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="return SubmitNewCountryName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Country Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="CountryCode" class="col-sm-3 col-form-label">Country Code</label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="CountryCode" name="CountryCode" value="<?php echo $CountryName['SoftCode'];?>" placeholder="Country Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="CountryName" class="col-sm-3 col-form-label">Country Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CountryName" name="CountryName" maxlength="100" value="<?php echo (isset($_POST['CountryName']) ? $_POST['CountryName'] : $CountryName['CodeValue']);?>" placeholder="Country Name">
                            <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
                          </div>
                        </div>
                        <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country Std Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">+</div>
                                <input type="text" class="form-control" id="STDCode" name="STDCode" value="<?php echo (isset($_POST['STDCode']) ? $_POST['STDCode'] : $CountryName['ParamA']);?>" Placeholder="STD Code"> </div>
                            <span class="errorstring" id="ErrSTDCode"><?php echo isset($ErrSTDCode)? $ErrSTDCode : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Currency String</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CurrencyString" name="CurrencyString" value="<?php echo (isset($_POST['CurrencyString']) ? $_POST['CurrencyString'] : $CountryName['ParamB']);?>" Placeholder="Currency String">
                            <span class="errorstring" id="ErrCurrencyString"><?php echo isset($ErrCurrencyString)? $ErrCurrencyString : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Currency Sub String</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CurrencySubString" name="CurrencySubString"  value="<?php echo (isset($_POST['CurrencySubString']) ? $_POST['CurrencySubString'] : $CountryName['ParamC']);?>" Placeholder="Currency SubString">
                            <span class="errorstring" id="ErrCurrencySubString"><?php echo isset($ErrCurrencySubString)? $ErrCurrencySubString : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Currency Short String</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CurrencyShortString" name="CurrencyShortString" value="<?php echo (isset($_POST['CurrencyShortString']) ? $_POST['CurrencyShortString'] : $CountryName['ParamD']);?>"  Placeholder="Curency Short String">
                            <span class="errorstring" id="ErrCurrencyShortString"><?php echo isset($ErrCurrencyShortString)? $ErrCurrencyShortString : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                      <div class="col-sm-9">
                      <select name="IsActive" class="form-control" style="width:80px">
                        <option value="1" <?php echo ($CountryName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                        <option value="0" <?php echo ($CountryName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                        </select> 
                      </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-3"><small>Allowed to Register<span id="star">*</span></small></div>
                            <div class="col-sm-3">
                                <select name="AllowToRegister" class="form-control" style="width: 140px;">
                                    <option value="1" <?php echo ($CountryName[ 'ParamE']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($CountryName[ 'ParamE']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group row">
                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                    </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateCountryName" class="btn btn-primary mr-2"><small>Update Country Name</small></button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCountry"><small>List of Country Names</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    