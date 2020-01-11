<?php   
    if (isset($_POST['BtnUpdateComplexion'])) {
        
        $response = $webservice->getData("Admin","EditComplexion",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Complexion = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewComplexion() {
                        $('#ErrComplexion').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Complexion","ErrComplexion","Please Enter Valid Complexion");
                        IsAlphabet("Complexion","ErrComplexion","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewComplexion();">   
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Complexion</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="ComplexionCode" class="col-sm-3 col-form-label">Complexion Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="ComplexionCode" name="ComplexionCode" value="<?php echo $Complexion['SoftCode'];?>" placeholder="Complexion Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Complexion" class="col-sm-3 col-form-label">Complexion<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Complexion" name="Complexion" maxlength="100" value="<?php echo (isset($_POST['Complexion']) ? $_POST['Complexion'] : $Complexion['CodeValue']);?>" placeholder="Complexion">
                            <span class="errorstring" id="ErrComplexion"><?php echo isset($ErrComplexion)? $ErrComplexion : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Complexion['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Complexion['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4">
                        <button type="submit" name="BtnUpdateComplexion" class="btn btn-primary mr-2">Update Complexion</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageComplexions"><small>List of Complexions</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>