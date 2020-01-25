<?php 
$page="Star";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#StarCode").blur(function () {  
    IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code");
   });
   $("#StarName").blur(function () {
        IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name");
   });
});

 function SubmitNewStarName() {
                         $('#ErrStarCode').html("");
                         $('#ErrStarName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code")){
                        IsAlphaNumeric("StarCode","ErrStarCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name")){
                        IsAlphabet("StarName","ErrStarName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-sm-10 rightwidget">
 <?php                   
  if (isset($_POST['BtnSaveStarName'])) {   
    $response = $webservice->getData("Admin","CreateStarName",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $StarCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextStarCode="";
        if ($StarCode['status']=="success") {
            $GetNextStarCode  =$StarCode['data']['StarCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewStarName();">   
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">Create Star Name</h4>                  
        <div class="form-group row">
                          <label for="Star Code" class="col-sm-3 col-form-label">Star Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="StarCode" name="StarCode"  maxlength="10" value="<?php echo (isset($_POST['StarCode']) ? $_POST['StarCode'] : $GetNextStarCode);?>" placeholder="Star Code">
                            <span class="errorstring" id="ErrStarCode"><?php echo isset($ErrStarCode)? $ErrStarCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Star Name" class="col-sm-3 col-form-label">Star Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="StarName" name="StarName"  maxlength="100" value="<?php echo (isset($_POST['StarName']) ? $_POST['StarName'] : "");?>" placeholder="Star Name">
                            <span class="errorstring" id="ErrStarName"><?php echo isset($ErrStarName)? $ErrStarName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveStarName" id="BtnSaveStarName"  class="btn btn-primary mr-2">Save Star Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageStar"><small>List of Star Names</small> </a>  </div>
                       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    