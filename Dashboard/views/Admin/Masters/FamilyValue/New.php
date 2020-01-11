
<script>
 function SubmitFamilyValue() {
                         $('#ErrFamilyValueCode').html("");
                         $('#ErrFamilyValue').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyValueCode","ErrFamilyValueCode","Please Enter Valid FamilyValue Code");
                        IsNonEmpty("FamilyValue","ErrFamilyValue","Please Enter Valid FamilyValue");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveFamilyValue'])) {   
    $response = $webservice->getData("Admin","CreateFamilyValue",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $FamilyValueCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextFamilyValueCode="";
        if ($FamilyValueCode['status']=="success") {
            $GetNextFamilyValueCode  =$FamilyValueCode['data']['FamilyValueCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitFamilyValue();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Add FamilyValue</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="FamilyValue Code" class="col-sm-3 col-form-label">FamilyValue Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="FamilyValueCode" name="FamilyValueCode" maxlength="10" value="<?php echo isset($_POST['FamilyValueCode']) ? $_POST['FamilyValueCode'] : $GetNextFamilyValueCode;?>" placeholder="FamilyValue Code">
                            <span class="errorstring" id="ErrFamilyValueCode"><?php echo isset($ErrFamilyValueCode)? $ErrFamilyValueCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyValue" class="col-sm-3 col-form-label">FamilyValue<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FamilyValue" maxlength="100" name="FamilyValue" value="<?php echo (isset($_POST['FamilyValue']) ? $_POST['FamilyValue'] : "");?>" placeholder="FamilyValue">
                            <span class="errorstring" id="ErrFamilyValue"><?php echo isset($ErrFamilyValue)? $ErrFamilyValue : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveFamilyValue" id="BtnSaveFamilyValue"  class="btn btn-primary mr-2" style="font-family: roboto;">Save FamilyValue</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageFamilyValue">List of FamilyValues </a>  </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
</form>
<?php }?>