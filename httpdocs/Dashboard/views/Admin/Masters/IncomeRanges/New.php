<?php
    if (isset($_POST['BtnSaveIncomeRange'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and CodeValue='".trim($_POST['IncomeRange'])."'");
        if (sizeof($duplicate)>0) {
             $ErrIncomeRange="Income Range Alreay Exists";    
             echo $ErrIncomeRange;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and SoftCode='".trim($_POST['IncomeRangeCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrIncomeRangeCode="Income Range Code Alreay Exists";    
             echo $ErrIncomeRangeCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $IncomeRangeID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "INCOMERANGE",
                                                                       "SoftCode"   => trim($_POST['IncomeRangeCode']),
                                                                       "CodeValue"  => trim($_POST['IncomeRange'])));
        if ($IncomeRangeID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Income";
        }
    
    }
    }
?>
<script>

$(document).ready(function () {
   $("#IncomeRangeCode").blur(function () {  
    IsNonEmpty("IncomeRangeCode","ErrIncomeRangeCode","Please Enter Valid IncomeRange Code");
   });
   $("#IncomeRange").blur(function () {
        IsNonEmpty("IncomeRange","ErrIncomeRange","Please Enter Valid IncomeRange");
   });
});

 function SubmitNewIncomeRange() {
                         $('#ErrIncomeRangeCode').html("");
                         $('#ErrIncomeRange').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("IncomeRangeCode","ErrIncomeRangeCode","Please Enter Valid Income Code")){
                        IsAlphaNumeric("IncomeRangeCode","ErrIncomeRangeCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("IncomeRange","ErrIncomeRange","Please Enter Valid IncomeRange");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewIncomeRange();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Income Range</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Income Range Code" class="col-sm-3 col-form-label">Income Range Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="IncomeRangeCode" name="IncomeRangeCode"  maxlength="10" value="<?php echo (isset($_POST['IncomeRangeCode']) ? $_POST['IncomeRangeCode'] : GetNextNumber('INCOMERANGE'));?>" placeholder="IncomeRangeCode">
                            <span class="errorstring" id="ErrIncomeRangeCode"><?php echo isset($ErrIncomeRangeCode)? $ErrIncomeRangeCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Income Range" class="col-sm-3 col-form-label">Income Range<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="IncomeRange" name="IncomeRange"  maxlength="100" value="<?php echo (isset($_POST['IncomeRange']) ? $_POST['IncomeRange'] : "");?>" placeholder="Income Range">
                            <span class="errorstring" id="ErrIncomeRange"><?php echo isset($ErrIncomeRange)? $ErrIncomeRange : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveIncomeRange" id="BtnSaveIncomeRange"  class="btn btn-primary mr-2">Save Income</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageIncomeRanges"><small>List of Income Ranges</small> </a>  </div>
                       </div>
                        </form>
                    </div>
                  </div>
                </div>
                </form>