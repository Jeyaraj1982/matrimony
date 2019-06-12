<?php
    if (isset($_POST['BtnSaveWeight'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEIGHTS' and CodeValue='".trim($_POST['Weight'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWeight="Weight Alreay Exists";    
             echo $ErrWeight;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEIGHTS' and SoftCode='".trim($_POST['WeightCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWeightCode="Weight Code Alreay Exists";    
             echo $ErrWeightCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $WeightID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "WEIGHTS",
                                                                  "SoftCode"   => trim($_POST['WeightCode']),
                                                                  "CodeValue"  => trim($_POST['Weight'])));
                                                                  
        if ($WeightID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Weight";
        }
    
    }
    
    }  
    
    
?>
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
<form method="post" action="" onsubmit="return SubmitWeight();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Add Weight</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Weight Code" class="col-sm-3 col-form-label"><small>Weight Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="WeightCode" name="WeightCode" maxlength="10" value="<?php echo isset($_POST['WeightCode']) ? $_POST['WeightCode'] : GetNextNumber('WEIGHTS');?>" placeholder="Weight Code">
                            <span class="errorstring" id="ErrWeightCode"><?php echo isset($ErrWeightCode)? $ErrWeightCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Weight" class="col-sm-3 col-form-label"><small>Weight<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Weight" maxlength="100" name="Weight" value="<?php echo (isset($_POST['Weight']) ? $_POST['Weight'] : "");?>" placeholder="Weight">
                            <span class="errorstring" id="ErrWeight"><?php echo isset($ErrWeight)? $ErrWeight : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" name="BtnSaveWeight" id="BtnSaveWeight"  class="btn btn-success mr-2">Save Weight</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageWeights"><small>List of Weights</small> </a>  </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>