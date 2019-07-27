<?php   
    if (isset($_POST['BtnUpdateFamilyAffluence'])) {
        
        $response = $webservice->getData("Admin","EditFamilyAffluence",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }                                                      
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $FamilyAffluence = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewFamilyAffluence() {
                        $('#ErrFamilyAffluence').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyAffluence","ErrFamilyAffluence","Please Enter Valid Family Type");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewFamilyAffluence();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Family Affluence</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="FamilyAffluenceCode" class="col-sm-3 col-form-label">Family Affluence Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="FamilyAffluenceCode" name="FamilyAffluenceCode" value="<?php echo $FamilyAffluence['SoftCode'];?>" placeholder="Blood Group Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyAffluence" class="col-sm-3 col-form-label">Family Affluence<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FamilyAffluence" name="FamilyAffluence" maxlength="100" value="<?php echo (isset($_POST['FamilyAffluence']) ? $_POST['FamilyAffluence'] : $FamilyAffluence['CodeValue']);?>" placeholder="FamilyAffluence">
                            <span class="errorstring" id="ErrFamilyAffluence"><?php echo isset($ErrFamilyAffluence)? $ErrFamilyAffluence : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($FamilyAffluence['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($FamilyAffluence['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateFamilyAffluence" class="btn btn-primary mr-2">Update Family Type</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageAffluence"><small>List of Family Affluence</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>