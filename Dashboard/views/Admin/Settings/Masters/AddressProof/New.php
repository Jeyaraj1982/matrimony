<?php 
$page="ManageAddressProof";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#AddressProofCode").blur(function () {  
    IsNonEmpty("AddressProofCode","ErrAddressProofCode","Please Enter Valid AddressProof Code");
   });
   $("#AddressProof").blur(function () {
        IsNonEmpty("AddressProof","ErrAddressProof","Please Enter Valid AddressProof");
   });
});

 function SubmitNewAddressProof() {
                         $('#ErrAddressProofCode').html("");
                         $('#ErrAddressProof').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("AddressProofCode","ErrAddressProofCode","Please Enter Valid Address Proof Code")){
                        IsAlphaNumeric("AddressProofCode","ErrAddressProofCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("AddressProof","ErrAddressProof","Please Enter Valid AddressProof");
         
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
            <h4 class="card-title">Create Address Proof</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnAddressProof'])) {   
    $response = $webservice->getData("Admin","CreateAddressProof",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $AddressProofCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextAddressProofCode="";
        if ($AddressProofCode['status']=="success") {
            $GetNextAddressProofCode  =$AddressProofCode['data']['AddressProofCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewAddressProof();">
    
        <div class="form-group row">
          <label for="AddressProof" class="col-sm-3 col-form-label">Address Proof Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="AddressProofCode" name="AddressProofCode" maxlength="10" value="<?php echo isset($_POST['AddressProofCode']) ? $_POST['AddressProofCode'] : $GetNextAddressProofCode ; ?>" placeholder="Address Proof Code">
            <span class="errorstring" id="ErrAddressProofCode"><?php echo isset($ErrAddressProofCode)? $ErrAddressProofCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="AddressProof" class="col-sm-3 col-form-label">Address Proof<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="AddressProof" name="AddressProof" maxlength="100" value="<?php echo (isset($_POST['AddressProof']) ? $_POST['AddressProof'] : "");?>" placeholder="Address Proof">
            <span class="errorstring" id="ErrAddressProof"><?php echo isset($ErrAddressProof)? $ErrAddressProof : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnAddressProof" id="BtnAddressProof"  class="btn btn-primary mr-2">Save Address Proof</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageAddressProof"><small>List of Address Proof</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    