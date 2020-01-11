<?php   
    if (isset($_POST['BtnUpdateFamilyType'])) {
        
        $response = $webservice->getData("Admin","EditFamilyType",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }                                                      
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $FamilyType = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewFamilyType() {
                        $('#ErrFamilyType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyType","ErrFamilyType","Please Enter Valid Family Type");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewFamilyType();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Family Type</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="FamilyTypeCode" class="col-sm-3 col-form-label">Family Type Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="FamilyTypeCode" name="FamilyTypeCode" value="<?php echo $FamilyType['SoftCode'];?>" placeholder="Blood Group Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="FamilyType" class="col-sm-3 col-form-label">FamilyType<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="FamilyType" name="FamilyType" maxlength="100" value="<?php echo (isset($_POST['FamilyType']) ? $_POST['FamilyType'] : $FamilyType['CodeValue']);?>" placeholder="FamilyType">
                            <span class="errorstring" id="ErrFamilyType"><?php echo isset($ErrFamilyType)? $ErrFamilyType : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($FamilyType['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($FamilyType['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateFamilyType" class="btn btn-primary mr-2">Update Family Type</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageFamilyType"><small>List of Family Type</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>