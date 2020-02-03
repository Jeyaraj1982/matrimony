<?php 
$page="ManageCurrency";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#CurrencyCode").blur(function () {  
    IsNonEmpty("CurrencyCode","ErrCurrencyCode","Please Enter Valid Currency Code");
   });
   $("#Currency").blur(function () {
        IsNonEmpty("Currency","ErrCurrency","Please Enter Valid Currency");
   });
});

 function SubmitNewCurrency() {
                         $('#ErrCurrencyCode').html("");
                         $('#ErrCurrency').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("CurrencyCode","ErrCurrencyCode","Please Enter Valid Currency Code")){
                        IsAlphaNumeric("CurrencyCode","ErrCurrencyCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("Currency","ErrCurrency","Please Enter Valid Currency ");
         
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
            <h4 class="card-title">Create Currency</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnCurrency'])) {   
    $response = $webservice->getData("Admin","CreateCurrency",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $CurrencyCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextCurrencyCode="";
        if ($CurrencyCode['status']=="success") {
            $GetNextCurrencyCode  =$CurrencyCode['data']['CurrencyCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewCurrency();">
    
        <div class="form-group row">
          <label for="Currency" class="col-sm-3 col-form-label">Currency Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="CurrencyCode" name="CurrencyCode" maxlength="10" value="<?php echo isset($_POST['CurrencyCode']) ? $_POST['CurrencyCode'] : $GetNextCurrencyCode ; ?>" placeholder="Currency Code">
            <span class="errorstring" id="ErrCurrencyCode"><?php echo isset($ErrCurrencyCode)? $ErrCurrencyCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="CurrencyName" class="col-sm-3 col-form-label">Currency<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Currency" name="Currency" maxlength="100" value="<?php echo (isset($_POST['Currency']) ? $_POST['Currency'] : "");?>" placeholder="Currency">
            <span class="errorstring" id="ErrCurrency"><?php echo isset($ErrCurrency)? $ErrCurrency : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnCurrency" id="BtnCurrency"  class="btn btn-primary mr-2">Save Currency</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageCurrency"><small>List of Currency</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    