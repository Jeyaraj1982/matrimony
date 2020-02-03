<?php 
$page="ManageTimeZone";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#TimeZoneCode").blur(function () {  
    IsNonEmpty("TimeZoneCode","ErrTimeZoneCode","Please Enter Valid TimeZone Code");
   });
   $("#TimeZoneName").blur(function () {
        IsNonEmpty("TimeZoneName","ErrTimeZoneName","Please Enter Valid TimeZone");
   });
});

 function SubmitNewTimeZoneName() {
                         $('#ErrTimeZoneCode').html("");
                         $('#ErrTimeZoneName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("TimeZoneCode","ErrTimeZoneCode","Please Enter Valid TimeZone Code")){
                        IsAlphaNumeric("TimeZoneCode","ErrTimeZoneCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("TimeZoneName","ErrTimeZoneName","Please Enter Valid TimeZone ");
         
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
            <h4 class="card-title">Create TimeZone</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnTimeZoneName'])) {   
    $response = $webservice->getData("Admin","CreateTimeZone",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $TimeZoneCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextTimeZoneCode="";
        if ($TimeZoneCode['status']=="success") {
            $GetNextTimeZoneCode  =$TimeZoneCode['data']['TimeZoneCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewTimeZoneName();">
    
        <div class="form-group row">
          <label for="TimeZone Name" class="col-sm-3 col-form-label">TimeZone Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="TimeZoneCode" name="TimeZoneCode" maxlength="10" value="<?php echo isset($_POST['TimeZoneCode']) ? $_POST['TimeZoneCode'] : $GetNextTimeZoneCode ; ?>" placeholder="TimeZone Code">
            <span class="errorstring" id="ErrTimeZoneCode"><?php echo isset($ErrTimeZoneCode)? $ErrTimeZoneCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="TimeZone Name" class="col-sm-3 col-form-label">TimeZone<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="TimeZoneName" name="TimeZoneName" maxlength="100" value="<?php echo (isset($_POST['TimeZoneName']) ? $_POST['TimeZoneName'] : "");?>" placeholder="TimeZone Name">
            <span class="errorstring" id="ErrTimeZoneName"><?php echo isset($ErrTimeZoneName)? $ErrTimeZoneName : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnTimeZoneName" id="BtnTimeZoneName"  class="btn btn-primary mr-2">Save TimeZone</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageTimeZone"><small>List of TimeZone</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    