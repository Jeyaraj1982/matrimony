<?php   
    if (isset($_POST['BtnUpdateBloodGroup'])) {
        
        $response = $webservice->getData("Admin","EditBloodGroupName",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $BloodGroup = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewBloodGroup() {
                        $('#ErrBloodGroup').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BloodGroup","ErrBloodGroup","Please Enter Valid Blood Group");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewBloodGroup();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Blood Group</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="BloodGroupCode" class="col-sm-3 col-form-label">Blood Group Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="BloodGroupCode" name="BloodGroupCode" value="<?php echo $BloodGroup['SoftCode'];?>" placeholder="Blood Group Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="BloodGroup" class="col-sm-3 col-form-label">BloodGroup<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BloodGroup" name="BloodGroup" maxlength="100" value="<?php echo (isset($_POST['BloodGroup']) ? $_POST['BloodGroup'] : $BloodGroup['CodeValue']);?>" placeholder="BloodGroup">
                            <span class="errorstring" id="ErrBloodGroup"><?php echo isset($ErrBloodGroup)? $ErrBloodGroup : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($BloodGroup['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($BloodGroup['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateBloodGroup" class="btn btn-primary mr-2">Update Blood Group</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBloodGroups"><small>List of Blood Groups</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>