<?php   
    if (isset($_POST['BtnUpdateLakanam'])) {
        
        $response = $webservice->getData("Admin","EditLakanam",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $Lakanam = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewLakanam() {
                        $('#ErrLakanam').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Lakanam","ErrLakanam","Please Enter Valid Lakanam");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewLakanam();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Lakanam</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="LakanamCode" class="col-sm-3 col-form-label">Lakanam Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="LakanamCode" name="LakanamCode" value="<?php echo $Lakanam['SoftCode'];?>" placeholder="Lakanam Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Lakanam" class="col-sm-3 col-form-label">Lakanam<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Lakanam" maxlength="100" name="Lakanam" value="<?php echo (isset($_POST['Lakanam']) ? $_POST['Lakanam'] : $Lakanam['CodeValue']);?>" placeholder="Lakanam">
                            <span class="errorstring" id="ErrLakanam"><?php echo isset($ErrLakanam)? $ErrLakanam : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Lakanam['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Lakanam['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                         <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateLakanam" class="btn btn-primary mr-2" style="font-family:roboto">Update Lakanam</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLakanam">List of Lakanams</a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>