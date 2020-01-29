<?php 
$page="ManageComplexions";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitComplexions() {
                         $('#ErrComplexionCode').html("");
                         $('#ErrBloodGroupName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("ComplexionCode","ErrComplexionCode","Please Enter Valid Complexion Code");
                        if(IsNonEmpty("ComplexionName","ErrComplexionName","Please Enter Valid Complexion Name")) {
                            IsAlphaNumeric("ComplexionName","ErrComplexionName","Please Enter Alphanumeric Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveComplexions'])) {   
    $response = $webservice->getData("Admin","CreateComplexion",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $ComplexionCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextComplexionCode="";
        if ($ComplexionCode['status']=="success") {
            $GetNextComplexionCode  =$ComplexionCode['data']['ComplexionCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitComplexions();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Masters</h4>
               <h4 class="card-title">Create Complexions</h4>
               <div class="form-group row">
                        <label for="Complexion Code" class="col-sm-3 col-form-label">Complexion Code<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ComplexionCode" name="ComplexionCode" maxlength="10" value="<?php echo (isset($_POST['ComplexionCode']) ? $_POST['ComplexionCode'] : $GetNextComplexionCode);?>" placeholder="Complexion Code">
                        <span class="errorstring" id="ErrComplexionCode"><?php echo isset($ErrComplexionCode)? $ErrComplexionCode : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                        <label for="Complexion Name" class="col-sm-3 col-form-label">Complexion Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ComplexionName" name="ComplexionName" maxlength="100" value="<?php echo (isset($_POST['ComplexionName']) ? $_POST['ComplexionName'] : "");?>" placeholder="Complexion Name">
                        <span class="errorstring" id="ErrComplexionName"><?php echo isset($ErrComplexionName)? $ErrComplexionName : "";?></span>
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-3">
                        <button type="submit" name="BtnSaveComplexions" id="BtnSaveComplexions"  class="btn btn-primary mr-2">Save Complexion</button> </div>
                   <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageComplexions"><small>List of Complexions</small> </a>  </div>
                </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    