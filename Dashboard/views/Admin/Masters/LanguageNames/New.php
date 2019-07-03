<?php
   
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
 <?php                   
  if (isset($_POST['BtnSaveLanguageName'])) {   
    $response = $webservice->getData("Admin","CreateLanguageName",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $LanguageCode = $webservice->GetMastersManageDetails(); 
     $GetNextLanguageCode="";
        if ($LanguageCode['status']=="success") {
            $GetNextLanguageCode  =$LanguageCode['data']['LanguageNameCode'];
        }
        {     
?> 
<form method="post" action="" onsubmit="return SubmitLanguage();">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Create Language Name</h4>
                <form class="forms-sample">
                    <div class="form-group row">
                        <label for="Language Name Code" class="col-sm-3 col-form-label">Language Name Code<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageNameCode" name="LanguageNameCode" maxlength="10" value="<?php echo (isset($_POST['LanguageNameCode']) ? $_POST['LanguageNameCode'] :$GetNextLanguageCode);?>" placeholder="Language Name Code">
                            <span class="errorstring" id="ErrLanguageNameCode"><?php echo isset($ErrLanguageNameCode)? $ErrLanguageNameCode : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Language Name" class="col-sm-3 col-form-label">Language Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" name="LanguageName" maxlength="100" value="<?php echo (isset($_POST['LanguageName']) ? $_POST['LanguageName'] : " ");?>" placeholder="Language Name">
                            <span class="errorstring" id="ErrLanguageName"><?php echo isset($ErrLanguageName)? $ErrLanguageName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <button type="submit" name="BtnSaveLanguageName" id="BtnSaveLanguageName" class="btn btn-primary mr-2">Save Language Name</button>
                        </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageLanguage"><small>List of Language Names</small> </a> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
<?php }?>