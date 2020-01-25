<?php   
    if (isset($_POST['BtnUpdateOccupation'])) {
        
        $response = $webservice->getData("Admin","EditOccupation",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Occupation = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewOccupation() {
                        $('#ErrOccupation').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Occupation","ErrOccupation","Please Enter Valid Occupation");
                        IsAlphabet("Occupation","ErrOccupation","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewOccupation();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Occupation</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="OccupationCode" class="col-sm-3 col-form-label">Occupation Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="OccupationCode" name="OccupationCode" value="<?php echo $Occupation['SoftCode'];?>" placeholder="Occupation Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation" class="col-sm-3 col-form-label">Occupation<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Occupation" name="Occupation" maxlength="100" value="<?php echo (isset($_POST['Occupation']) ? $_POST['Occupation'] : $Occupation['CodeValue']);?>" placeholder="Occupation">
                            <span class="errorstring" id="ErrOccupation"><?php echo isset($ErrOccupation)? $ErrOccupation : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Occupation['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Occupation['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateOccupation" class="btn btn-primary mr-2" style="font-family: roboto;">Update Occupation</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageOccupations">List of Occupations</a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>