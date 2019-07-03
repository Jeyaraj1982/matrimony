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
<?php   
    if (isset($_POST['BtnUpdateIncomeRange'])) {
        
        $response = $webservice->getData("Admin","EditIncomeRange",$_POST) ;
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $IncomeRange = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="return SubmitNewIncomeRange();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Income Range</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="IncomeRangeCode" class="col-sm-3 col-form-label">Income Code</label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" class="form-control" maxlength="10" id="IncomeRangeCode" name="IncomeRangeCode" value="<?php echo $IncomeRange['SoftCode'];?>" placeholder="IncomeRange Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="IncomeRange" class="col-sm-3 col-form-label">IncomeRange<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="IncomeRange" name="IncomeRange" maxlength="100" value="<?php echo (isset($_POST['IncomeRange']) ? $_POST['IncomeRange'] : $IncomeRange['CodeValue']);?>" placeholder="IncomeRange">
                            <span class="errorstring" id="ErrIncomeRange"><?php echo isset($ErrIncomeRange)? $ErrIncomeRange : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($IncomeRange['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($IncomeRange['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                       <div class="form-group row">
                        <div class="col-sm-3"><button type="submit" name="BtnUpdateIncomeRange" class="btn btn-primary mr-2">Update Income Range</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageIncomeRanges"><small>List of Income Ranges</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>