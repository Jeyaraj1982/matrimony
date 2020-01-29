<?php 
$page="ManageHeights";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitHeight() {
                         $('#ErrHeightCode').html("");
                         $('#ErrHeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("HeightCode","ErrHeightCode","Please Enter Valid Height Code");
                        IsNonEmpty("Height","ErrHeight","Please Enter Valid Height");
                        
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveHeight'])) {   
    $response = $webservice->getData("Admin","CreateHeight",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $HeightCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextHeightCode="";
        if ($HeightCode['status']=="success") {
            $GetNextHeightCode  =$HeightCode['data']['HeightCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitHeight();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Create Height</h4>
                <div class="form-group row">
                          <label for="Height Code" class="col-sm-3 col-form-label">Height Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="HeightCode" name="HeightCode" maxlength="10" value="<?php echo isset($_POST['HeightCode']) ? $_POST['HeightCode'] : $GetNextHeightCode;?>" placeholder="Height Code">
                            <span class="errorstring" id="ErrHeightCode"><?php echo isset($ErrHeightCode)? $ErrHeightCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Height" class="col-sm-3 col-form-label">Height<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Height" name="Height" maxlength="100" value="<?php echo (isset($_POST['Height']) ? $_POST['Height'] : "");?>" placeholder="Height">
                            <span class="errorstring" id="ErrHeight"><?php echo isset($ErrHeight)? $ErrHeight : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                         <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveHeight" id="BtnSaveHeight"  class="btn btn-primary mr-2">Save Height</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageHeights"><small>List of Heights</small> </a>  </div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>
 
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    