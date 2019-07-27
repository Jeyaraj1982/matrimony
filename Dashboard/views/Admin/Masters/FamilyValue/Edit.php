
<script>
<?php   
    if (isset($_POST['BtnUpdateFamilyValue'])) {
        
        $response = $webservice->getData("Admin","EditFamilyValue",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $FamilyValue = $response['data']['ViewInfo'];
?>
 function SubmitNewFamilyValue() {
                        $('#ErrFamilyValue').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyValue","ErrFamilyValue","Please Enter Valid Family Value");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewFamilyValue();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Family Value</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="FamilyValueCode" class="col-sm-3 col-form-label">Family Value Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="FamilyValueCode" name="FamilyValueCode" value="<?php echo $FamilyValue['SoftCode'];?>" placeholder="Family Value Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyValue" class="col-sm-3 col-form-label">Family Value<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FamilyValue" name="FamilyValue" maxlength="100" value="<?php echo (isset($_POST['FamilyValue']) ? $_POST['FamilyValue'] : $FamilyValue['CodeValue']);?>" placeholder="Family Value">
                             <span class="errorstring" id="ErrFamilyValue"><?php echo isset($ErrFamilyValue)? $ErrFamilyValue : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($FamilyValue['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($FamilyValue['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateFamilyValue" class="btn btn-primary mr-2" style="font-family: roboto;">Update FamilyValue</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageFamilyValue">List of FamilyValues</a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>