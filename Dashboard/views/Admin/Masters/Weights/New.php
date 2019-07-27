
<script>
 function SubmitWeight() {
                         $('#ErrWeightCode').html("");
                         $('#ErrWeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("WeightCode","ErrWeightCode","Please Enter Valid Weight Code");
                        IsNonEmpty("Weight","ErrWeight","Please Enter Valid Weight");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveWeight'])) {   
    $response = $webservice->getData("Admin","CreateWeight",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $WeightCode = $webservice->GetMastersManageDetails(); 
     $GetNextWeightCode="";
        if ($WeightCode['status']=="success") {
            $GetNextWeightCode  =$WeightCode['data']['WeightCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitWeight();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Add Weight</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Weight Code" class="col-sm-3 col-form-label">Weight Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="WeightCode" name="WeightCode" maxlength="10" value="<?php echo isset($_POST['WeightCode']) ? $_POST['WeightCode'] : $GetNextWeightCode;?>" placeholder="Weight Code">
                            <span class="errorstring" id="ErrWeightCode"><?php echo isset($ErrWeightCode)? $ErrWeightCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Weight" maxlength="100" name="Weight" value="<?php echo (isset($_POST['Weight']) ? $_POST['Weight'] : "");?>" placeholder="Weight">
                            <span class="errorstring" id="ErrWeight"><?php echo isset($ErrWeight)? $ErrWeight : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveWeight" id="BtnSaveWeight"  class="btn btn-primary mr-2" style="font-family: roboto;">Save Weight</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageWeights">List of Weights </a>  </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
</form>
<?php }?>