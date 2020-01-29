<?php 
$page="ManageOccupationTypes";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitOccupation() {
                         $('#ErrOccupationTypeCode').html("");
                         $('#ErrOccupationName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("OccupationTypeCode","ErrOccupationTypeCode","Please Enter Valid Occupation Code");
                        IsNonEmpty("OccupationName","ErrOccupationName","Please Enter Valid Occupation Name");
                        IsAlphaNumeric("OccupationName","ErrOccupationName","Please Enter Alphanumeric Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveOccupationType'])) {   
    $response = $webservice->getData("Admin","CreateOccupationType",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $OccupationTypeCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextOccupationTypeCode="";
        if ($OccupationTypeCode['status']=="success") {
            $GetNextOccupationTypeCode  =$OccupationTypeCode['data']['OccupationTypesCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitOccupation();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
          <h4 class="card-title">Masters</h4>
          <h4 class="card-title">Create Occupation Type</h4>
           <div class="form-group row">
                          <label for="Occupation Type Code" class="col-sm-3 col-form-label">Occupation Type Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationTypeCode" name="OccupationTypeCode" maxlength="10" value="<?php echo isset($_POST['OccupationTypeCode']) ? $_POST['OccupationTypeCode'] :$GetNextOccupationTypeCode;?>" placeholder="Occupation Type Code">
                            <span class="errorstring" id="ErrOccupationTypeCode"><?php echo isset($ErrOccupationTypeCode)? $ErrOccupationTypeCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation Type" class="col-sm-3 col-form-label">Occupation Type<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationType" name="OccupationType" maxlength="100" value="<?php echo (isset($_POST['OccupationType']) ? $_POST['OccupationType'] : "");?>" placeholder="Occupation Type">
                            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveOccupationType" id="BtnSaveOccupationType"  class="btn btn-primary mr-2" style="font-family: roboto;">Save Occupation Type</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageOccupationTypes">List of Occupation Types </a>  </div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    