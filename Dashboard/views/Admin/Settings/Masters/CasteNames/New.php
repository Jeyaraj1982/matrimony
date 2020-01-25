<?php 
$page="Caste";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
$("#CasteCode").blur(function () {
    IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid CasteCode");
   });
   $("#CasteName").blur(function () {
        IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name");
   });
});
 function SubmitNewCasteName() {
                         $('#ErrCasteCode').html("");
                         $('#ErrCasteName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid Caste Code")){
                        IsAlphaNumeric("CasteCode","ErrCasteCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name")){
                        IsAlphabet("CasteName","ErrCasteName","Please Enter Alphabets Charactors only");
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
  if (isset($_POST['BtnSaveCasteName'])) {   
    $response = $webservice->getData("Admin","CreateCasteName",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    }
  $CasteCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextCasteCode="";
        if ($CasteCode['status']=="success") {
            $GetNextCasteCode  =$CasteCode['data']['CasteCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewCasteName();">   
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">Create Caste Name</h4>                  
        <div class="form-group row">
            <label for="Caste Code" class="col-sm-3 col-form-label">Caste Name Code<span id="star">*</span></label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="CasteCode" name="CasteCode"  maxlength="10" value="<?php echo (isset($_POST['CasteCode']) ? $_POST['CasteCode'] : $GetNextCasteCode);?>" placeholder="Caste Code">
            <span class="errorstring" id="ErrCasteCode"><?php echo isset($ErrCasteCode)? $ErrCasteCode : "";?></span>
        </div>
    </div>
    <div class="form-group row">
            <label for="Caste Name" class="col-sm-3 col-form-label">Caste Name<span id="star">*</span></label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="CasteName" name="CasteName"  maxlength="100" value="<?php echo (isset($_POST['CasteName']) ? $_POST['CasteName'] : "");?>" placeholder="Caste Name">
            <span class="errorstring" id="ErrCasteName"><?php echo isset($ErrCasteName)? $ErrCasteName : "";?></span>
        </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
    </div>
    <div class="form-group row">
         <div class="col-sm-3">
            <button type="submit" name="BtnSaveCasteName" id="BtnSaveCasteName"  class="btn btn-primary mr-2">Save Caste Name</button> </div>
            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageCaste"><small>List of Caste Names</small> </a>  </div>
    </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    