<?php 
$page="ManageLakanam";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitLakanam() {
                         $('#ErrLakanamCode').html("");
                         $('#ErrLakanam').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("LakanamCode","ErrLakanamCode","Please Enter Valid Lakanam Code");
                        IsAlphaNumeric("LakanamCode","ErrLakanamCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("Lakanam","ErrLakanam","Please Enter Valid Lakanam");
                        
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveLakanam'])) {   
    $response = $webservice->getData("Admin","CreateLakanam",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $LakanamCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextLakanamCode="";
        if ($LakanamCode['status']=="success") {
            $GetNextLakanamCode  =$LakanamCode['data']['LakanamCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitLakanam();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Add Lakanam</h4>
                <div class="form-group row">
                          <label for="Lakanam Code" class="col-sm-3 col-form-label">Lakanam Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LakanamCode" name="LakanamCode" maxlength="10" value="<?php echo isset($_POST['LakanamCode']) ? $_POST['LakanamCode'] : $GetNextLakanamCode;?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrLakanamCode"><?php echo isset($ErrLakanamCode)? $ErrLakanamCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Lakanam" class="col-sm-3 col-form-label">Lakanam<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Lakanam" name="Lakanam" maxlength="100" value="<?php echo (isset($_POST['Lakanam']) ? $_POST['Lakanam'] : "");?>" placeholder="Lakanam">
                            <span class="errorstring" id="ErrLakanam"><?php echo isset($ErrLakanam)? $ErrLakanam : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                        <button type="submit" name="BtnSaveLakanam" class="btn btn-primary mr-2" style="font-family: roboto;">Save Lakanam</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageLakanam">List of Lakanam </a></div>
                         </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    