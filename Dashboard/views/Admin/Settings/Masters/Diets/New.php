<?php 
$page="ManageDiets";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitDiet() {
                         $('#ErrDietCode').html("");
                         $('#ErrDietName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("DietCode","ErrDietCode","Please Enter Valid Diet Code");
                        if(IsNonEmpty("DietName","ErrDietName","Please Enter Valid Diet Name")) {
                            IsAlphaNumeric("DietName","ErrDietName","Please Enter Alphanumeric Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
 <?php                   
  if (isset($_POST['BtnSaveDiet'])) {   
    $response = $webservice->getData("Admin","CreateDiet",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $DietCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextDietCode="";
        if ($DietCode['status']=="success") {
            $GetNextDietCode  =$DietCode['data']['DietCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitDiet();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Create Diet Name</h4>
                <div class="form-group row">
                          <label for="Diet Code" class="col-sm-3 col-form-label">Diet Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="DietCode" name="DietCode" maxlength="10" value="<?php echo isset($_POST['DietCode']) ? $_POST['DietCode'] : $GetNextDietCode;?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrDietCode"><?php echo isset($ErrDietCode)? $ErrDietCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Diet Name" class="col-sm-3 col-form-label">Diet Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="DietName" name="DietName" maxlength="100" value="<?php echo (isset($_POST['DietName']) ? $_POST['DietName'] : "");?>" placeholder="Diet Name">
                            <span class="errorstring" id="ErrDietName"><?php echo isset($ErrDietName)? $ErrDietName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveDiet" id="BtnSaveDiet"  class="btn btn-primary mr-2">Save Diet</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageDiets"><small>List of Diets</small> </a>  </div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    