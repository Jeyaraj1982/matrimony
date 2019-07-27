<script>
 function SubmitEducationTitle() {
                         $('#ErrEducationTitleCode').html("");
                         $('#ErrEducationTitle').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("EducationTitleCode","ErrEducationTitleCode","Please Enter Valid Education Title Code");
                        IsAlphaNumeric("EducationTitleCode","ErrEducationTitleCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("EducationTitle","ErrEducationTitle","Please Enter Valid Education Title");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
  <?php                   
  if (isset($_POST['BtnSaveEducationTitle'])) {   
    $response = $webservice->getData("Admin","CreateEducationTitle",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
    
  $EducationCode = $webservice->GetMastersManageDetails(); 
     $GetNextEducationDegreeCode="";
        if ($EducationCode['status']=="success") {
            $GetNextEducationDegreeCode  =$EducationCode['data']['EducationTitleCode'];
        }
        {     
?>
<form method="post" action="" onsubmit="return SubmitEducationTitle();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create EducationTitle</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Education Title Code" class="col-sm-3 col-form-label">Education Title Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="EducationTitleCode" maxlength="10" name="EducationTitleCode" value="<?php echo isset($_POST['EducationTitleCode']) ? $_POST['EducationTitleCode'] : $GetNextEducationDegreeCode;?>" placeholder="Education Title Code">
                            <span class="errorstring" id="ErrEducationTitleCode"><?php echo isset($ErrEducationTitleCode)? $ErrEducationTitleCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Education Title Name" class="col-sm-3 col-form-label">Education Title <span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationTitle" maxlength="100" name="EducationTitle" value="<?php echo (isset($_POST['EducationTitle']) ? $_POST['EducationTitle'] : "");?>" placeholder="Education Title">
                            <span class="errorstring" id="ErrEducationTitle"><?php echo isset($ErrEducationTitle)? $ErrEducationTitle : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button type="submit" name="BtnSaveEducationTitle" id="BtnSaveEducationTitle"  class="btn btn-primary mr-2">Save Education Title</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageEducationTitles">List of Education Titles </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php } ?>