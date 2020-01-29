<?php 
$page="ManageMartialStatus";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitMarital() {
                         $('#ErrMartialStatusCode').html("");
                         $('#ErrMartialStatus').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("MartialStatusCode","ErrMartialStatusCode","Please Enter Valid MaritalStatus Code")) { 
                            IsAlphaNumeric("MartialStatusCode","ErrMartialStatusCode","Please Enter AlphaNumeric Charactors only");
                        }
                        if(IsNonEmpty("MartialStatus","ErrMartialStatus","Please Enter Valid MaritalStatus")) {
                            IsAlphabet("MartialStatus","ErrMartialStatus","Please Enter Alphabet Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnMartialStatus'])) {   
    $response = $webservice->getData("Admin","CreateMaritalStatus",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $MaritalStatusCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextMaritalStatusCode="";
        if ($MaritalStatusCode['status']=="success") {
            $GetNextMaritalStatusCode  =$MaritalStatusCode['data']['MaritalStatusCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitMarital();">
   <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Create Marital Status</h4>
                <div class="form-group row">
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label">Marital Status Code<span id="star">*</span> </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MartialStatusCode" name="MartialStatusCode" maxlength="10" value="<?php echo isset($_POST['MartialStatusCode']) ? $_POST['MartialStatusCode'] : $GetNextMaritalStatusCode;?>" placeholder="MartialStatusCode">
                            <span class="errorstring" id="ErrMartialStatusCode"><?php echo isset($ErrMartialStatusCode)? $ErrMartialStatusCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Martial Status" class="col-sm-3 col-form-label">Marital Status<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MartialStatus" name="MartialStatus" maxlength="100" value="<?php echo (isset($_POST['MartialStatus']) ? $_POST['MartialStatus'] : "");?>" placeholder="Martial Status">
                            <span class="errorstring" id="ErrMartialStatus"><?php echo isset($ErrMartialStatus)? $ErrMartialStatus : "";?></span>
                          </div>
                        </div>      
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnMartialStatus" id="BtnMartialStatus"  class="btn btn-primary mr-2">Save Marital Status</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageMartialStatus">List of Marital Status</a>  </div>
                       </div>
                       <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    