<?php   
    if (isset($_POST['BtnUpdateMartialStatus'])) {
        
        $response = $webservice->getData("Admin","EditMaritalStatus",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $MartialStatus = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewMartialStatus() {
                        $('#ErrMartialStatus').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("MartialStatus","ErrMartialStatus","Please Enter Valid Martial Status");
                        IsAlphabet("MartialStatus","ErrMartialStatus","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewMartialStatus();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Marital Status</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label">Marital Status Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="MartialStatusCode" name="MartialStatusCode" value="<?php echo $MartialStatus['SoftCode'];?>" placeholder="Martial Status Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="MartialStatus" class="col-sm-3 col-form-label">Marital Status<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MartialStatus" name="MartialStatus" maxlength="100" value="<?php echo (isset($_POST['MartialStatus']) ? $_POST['MartialStatus'] : $MartialStatus['CodeValue']);?>" placeholder="Martial Status">
                            <span class="errorstring" id="ErrMartialStatus"><?php echo isset($ErrMartialStatus)? $ErrMartialStatus : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($MartialStatus['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($MartialStatus['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateMartialStatus" class="btn btn-primary mr-2">Update Marital Status</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMartialStatus"><small>List of Marital Status</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>