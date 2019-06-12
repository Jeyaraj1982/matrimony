<?php
    if (isset($_POST['BtnSaveLanguageName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and CodeValue='".trim($_POST['LanguageName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLanguageName="Language Name Alreay Exists";    
             echo $ErrLanguageName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and SoftCode='".trim($_POST['LanguageNameCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLanguageNameCode="Language Name Code Alreay Exists";    
             echo $ErrLanguageNameCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $LanguageNameID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "LANGUAGENAMES",
                                                                        "SoftCode"   => trim($_POST['LanguageNameCode']),
                                                                        "CodeValue"  => trim($_POST['LanguageName'])));
        if ($LanguageNameID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Language Name";
        }
    
    }
    }
?>
<script>
 function SubmitLanguage() {
                         $('#ErrLanguageNameCode').html("");
                         $('#ErrLanguageName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("LanguageNameCode","ErrLanguageNameCode","Please Enter Valid Language Name Code");
                        IsAlphaNumeric("LanguageNameCode","ErrLanguageNameCode","Please Enter Alpha Numeric only");
                        IsNonEmpty("LanguageName","ErrLanguageName","Please Enter Valid Language Name");
                        IsAlphabet("LanguageName","ErrLanguageName","Please Enter Alphabet Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitLanguage();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Language Name</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Language Name Code" class="col-sm-3 col-form-label"><small>Language Name Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageNameCode" name="LanguageNameCode" maxlength="10" value="<?php echo (isset($_POST['LanguageNameCode']) ? $_POST['LanguageNameCode'] : GetNextNumber('LANGUAGENAMES'));?>" placeholder="Language Name Code">
                            <span class="errorstring" id="ErrLanguageNameCode"><?php echo isset($ErrLanguageNameCode)? $ErrLanguageNameCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Language Name" class="col-sm-3 col-form-label"><small>Language Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" name="LanguageName" maxlength="100" value="<?php echo (isset($_POST['LanguageName']) ? $_POST['LanguageName'] : "");?>" placeholder="Language Name">
                            <span class="errorstring" id="ErrLanguageName"><?php echo isset($ErrLanguageName)? $ErrLanguageName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4">
                       <button type="submit" name="BtnSaveLanguageName" id="BtnSaveLanguageName"  class="btn btn-success mr-2">Save Language Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageLanguage"><small>List of Language Names</small> </a>  </div>
                       </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                </form>