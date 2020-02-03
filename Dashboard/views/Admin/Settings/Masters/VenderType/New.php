<?php 
$page="ManageVenderType";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#VenderTypeCode").blur(function () {  
    IsNonEmpty("VenderTypeCode","ErrVenderTypeCode","Please Enter Valid Vender Type Code");
   });
   $("#VenderType").blur(function () {
        IsNonEmpty("VenderType","ErrVenderType","Please Enter Valid Vender Type");
   });
});

 function SubmitNewVenderType() {
                         $('#ErrVenderTypeCode').html("");
                         $('#ErrVenderType').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("VenderTypeCode","ErrVenderTypeCode","Please Enter Valid Vender Type Code")){
                        IsAlphaNumeric("VenderTypeCode","ErrVenderTypeCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("VenderType","ErrVenderType","Please Enter Valid Vender Type ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-sm-10 rightwidget">
 <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">Create VenderType</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnVenderType'])) {   
    $response = $webservice->getData("Admin","CreateVenderType",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $VenderTypeCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextVenderTypeCode="";
        if ($VenderTypeCode['status']=="success") {
            $GetNextVenderTypeCode  =$VenderTypeCode['data']['VenderTypeCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewVenderType();">
    
        <div class="form-group row">
          <label for="VenderType" class="col-sm-3 col-form-label">Vender Type Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="VenderTypeCode" name="VenderTypeCode" maxlength="10" value="<?php echo isset($_POST['VenderTypeCode']) ? $_POST['VenderTypeCode'] : $GetNextVenderTypeCode ; ?>" placeholder="Vender Type Code">
            <span class="errorstring" id="ErrVenderTypeCode"><?php echo isset($ErrVenderTypeCode)? $ErrVenderTypeCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="VenderType" class="col-sm-3 col-form-label">Vender Type<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="VenderType" name="VenderType" maxlength="100" value="<?php echo (isset($_POST['VenderType']) ? $_POST['VenderType'] : "");?>" placeholder="Vender Type">
            <span class="errorstring" id="ErrVenderType"><?php echo isset($ErrVenderType)? $ErrVenderType : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnVenderType" id="BtnVenderType"  class="btn btn-primary mr-2">Save Vender Type</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageVenderType"><small>List of Vender Type</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    