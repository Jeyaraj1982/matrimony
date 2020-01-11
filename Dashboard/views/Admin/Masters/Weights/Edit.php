
<script>
<?php   
    if (isset($_POST['BtnUpdateWeight'])) {
        
        $response = $webservice->getData("Admin","EditWeight",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Weight = $response['data']['ViewInfo'];
?>
 function SubmitNewWeight() {
                        $('#ErrWeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Weight","ErrWeight","Please Enter Valid Weight");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewWeight();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Weight</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="WeightCode" class="col-sm-3 col-form-label">Weight Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="WeightCode" name="WeightCode" value="<?php echo $Weight['SoftCode'];?>" placeholder="Weight Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Weight" name="Weight" maxlength="100" value="<?php echo (isset($_POST['Weight']) ? $_POST['Weight'] : $Weight['CodeValue']);?>" placeholder="Weight">
                             <span class="errorstring" id="ErrWeight"><?php echo isset($ErrWeight)? $ErrWeight : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Weight['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Weight['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateWeight" class="btn btn-primary mr-2" style="font-family: roboto;">Update Weight</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageWeights">List of Weights</a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>