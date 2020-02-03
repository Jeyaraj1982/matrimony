<?php 
$page="ManageIDProof";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#IDProofCode").blur(function () {  
    IsNonEmpty("IDProofCode","ErrIDProofCode","Please Enter Valid IDProof Code");
   });
   $("#IDProof").blur(function () {
        IsNonEmpty("IDProof","ErrIDProof","Please Enter Valid IDProof");
   });
});

 function SubmitNewIDProof() {
                         $('#ErrIDProofCode').html("");
                         $('#ErrIDProof').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("IDProofCode","ErrIDProofCode","Please Enter Valid IDProof Code")){
                        IsAlphaNumeric("IDProofCode","ErrIDProofCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("IDProof","ErrIDProof","Please Enter Valid IDProof ");
         
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
            <h4 class="card-title">Create ID Proof</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnIDProof'])) {   
    $response = $webservice->getData("Admin","CreateIDProof",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $IDProofCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextIDProofCode="";
        if ($IDProofCode['status']=="success") {
            $GetNextIDProofCode  =$IDProofCode['data']['IDProofCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewIDProof();">
    
        <div class="form-group row">
          <label for="IDProof" class="col-sm-3 col-form-label">ID Proof Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="IDProofCode" name="IDProofCode" maxlength="10" value="<?php echo isset($_POST['IDProofCode']) ? $_POST['IDProofCode'] : $GetNextIDProofCode ; ?>" placeholder="ID Proof Code">
            <span class="errorstring" id="ErrIDProofCode"><?php echo isset($ErrIDProofCode)? $ErrIDProofCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="IDProof" class="col-sm-3 col-form-label">ID Proof<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="IDProof" name="IDProof" maxlength="100" value="<?php echo (isset($_POST['IDProof']) ? $_POST['IDProof'] : "");?>" placeholder="ID Proof Type">
            <span class="errorstring" id="ErrIDProof"><?php echo isset($ErrIDProof)? $ErrIDProof : "";?></span>
          </div>                                                                                                                  
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnIDProof" id="BtnIDProof"  class="btn btn-primary mr-2">Save ID Proof</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageIDProof"><small>List of ID Proof</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    