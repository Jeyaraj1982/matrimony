<?php 
$page="IncomeRange";
include_once("views/Admin/Settings/Masters/settings_header.php");
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
<?php                   
  if (isset($_POST['BtnSaveIncomeRange'])) {   
    $response = $webservice->getData("Admin","CreateIncomeRange",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $IncomeRangeCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextIncomeRangeCode="";
        if ($IncomeRangeCode['status']=="success") {
            $GetNextIncomeRangeCode  =$IncomeRangeCode['data']['IncomeRangeCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewIncomeRange();">
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">Create Income Range</h4>                  
        <div class="form-group row">
                          <label for="Income Range Code" class="col-sm-3 col-form-label">Income Range Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="IncomeRangeCode" name="IncomeRangeCode"  maxlength="10" value="<?php echo (isset($_POST['IncomeRangeCode']) ? $_POST['IncomeRangeCode'] : $GetNextIncomeRangeCode);?>" placeholder="IncomeRangeCode">
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
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveIncomeRange" id="BtnSaveIncomeRange"  class="btn btn-primary mr-2">Save Income</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageIncomeRanges"><small>List of Income Ranges</small> </a>  </div>
                       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    