<?php
    if (isset($_POST['BtnSaveCountryName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and CodeValue='".trim($_POST['CountryName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCountryName="Country Name Alreay Exists";    
             echo $ErrReligionName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and SoftCode='".trim($_POST['CountryCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCountryCode="Country Code Alreay Exists";    
             echo $ErrCountryCode;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['STDCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrSTDCode="Country STD Code Alreay Exists";    
             echo $ErrSTDCode;
             $ErrorCount++;
        }
        
       /* $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['CurrencyString'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCurrencyString="Country Currency String Alreay Exists";    
             echo $ErrCurrencyString;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['CurrencySubString'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCurrencySubString="Country Currency Sub String Alreay Exists";    
             echo $ErrCurrencySubString;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['CurrencyShortString'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCurrencyShortString="Country Currency Short String Alreay Exists";    
             echo $ErrCurrencyShortString;
             $ErrorCount++;
        }   */
        
        if ($ErrorCount==0) {
        $CountryID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "CONTNAMES",
                                                                   "SoftCode"   => trim($_POST['CountryCode']),
                                                                   "CodeValue"  => trim($_POST['CountryName']),
                                                                   "ParamA"     => trim($_POST['STDCode']),
                                                                   "ParamB"     => trim($_POST['CurrencyString']),
                                                                   "ParamC"     => trim($_POST['CurrencySubString']),
                                                                   "ParamD"     => trim($_POST['CurrencyShortString'])));
        if ($CountryID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Country Name";
        }
    
    }
    } 
?>
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
                            IsAlphaNumeric("CurrencyString","ErrCurrencyString","Please Enter Alphanumeric Charactors only");
                        }
                        
                        if ($('#CurrencySubString').val().trim().length>0) {
                        IsAlphaNumeric("CurrencySubString","ErrCurrencySubString","Please Enter Alphanumeric Charactors only");
                        }
                        if ($('#CurrencyShortString').val().trim().length>0) {
                        IsAlphaNumeric("CurrencyShortString","ErrCurrencyShortString","Please Enter Alphanumeric Charactors only");
                        }
                        
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
            
<form method="post" action="" onsubmit="return SubmitNewCountryName();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Masters</h4>
                  <h4 class="card-title">Create Country Name</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control"  id="CountryCode" name="CountryCode"  maxlength="5" value="<?php echo isset($_POST['CountryCode']) ? $_POST['CountryCode'] :  GetNextNumber('CONTNAMES');?>" Placeholder="Country Code">
                            <span class="errorstring" id="ErrCountryCode"><?php echo isset($ErrCountryCode)? $ErrCountryCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CountryName" name="CountryName"  maxlength="100"  value="<?php echo (isset($_POST['CountryName']) ? $_POST['CountryName'] : "");?>" Placeholder="Country Name">
                            <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country Std Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">+</div>
                                <input type="text" class="form-control" id="STDCode" name="STDCode" maxlength="10" value="<?php echo (isset($_POST['STDCode']) ? $_POST['STDCode'] : "");?>" Placeholder="STD Code"></div>
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
                            <input type="text" class="form-control" id="CurrencyString" name="CurrencyString" maxlength="10" value="<?php echo (isset($_POST['CurrencyString']) ? $_POST['CurrencyString'] : "");?>" Placeholder="Currency String">
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
                            <input type="text" class="form-control" id="CurrencySubString" name="CurrencySubString" maxlength="10"  value="<?php echo (isset($_POST['CurrencySubString']) ? $_POST['CurrencySubString'] : "");?>" Placeholder="Currency SubString">
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
                            <input type="text" class="form-control" id="CurrencyShortString" name="CurrencyShortString" maxlength="10" <?php echo (isset($_POST['CurrencyShortString']) ? $_POST['CurrencyShortString'] : "");?> Placeholder="Curency Short String">
                            <span class="errorstring" id="ErrCurrencyShortString"><?php echo isset($ErrCurrencyShortString)? $ErrCurrencyShortString : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveCountryName" id="BtnReligionName"  class="btn btn-primary mr-2">Save Country Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageCountry"><small>List of Country Names</small> </a>  </div>
                       </div>
                   </div>
                 </div>
              </div>
              
</form>