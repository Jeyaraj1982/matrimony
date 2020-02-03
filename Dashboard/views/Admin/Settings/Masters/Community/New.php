<?php 
$page="ManageCommunity";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#CommunityCode").blur(function () {  
    IsNonEmpty("CommunityCode","ErrCommunityCode","Please Enter Valid Community Code");
   });
   $("#Community").blur(function () {
        IsNonEmpty("Community","ErrCommunity","Please Enter Valid Community");
   });
});

 function SubmitNewCommunity() {
                         $('#ErrCommunityCode').html("");
                         $('#ErrCommunity').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("CommunityCode","ErrCommunityCode","Please Enter Valid Community Code")){
                        IsAlphaNumeric("CommunityCode","ErrCommunityCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("Community","ErrCommunity","Please Enter Valid Community ");
         
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
            <h4 class="card-title">Create Community</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnCommunity'])) {   
    $response = $webservice->getData("Admin","CreateCommunity",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $CommunityCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextCommunityCode="";
        if ($CommunityCode['status']=="success") {
            $GetNextCommunityCode  =$CommunityCode['data']['CommunityCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewCommunity();">
    
        <div class="form-group row">
          <label for="Community" class="col-sm-3 col-form-label">Community Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="CommunityCode" name="CommunityCode" maxlength="10" value="<?php echo isset($_POST['CommunityCode']) ? $_POST['CommunityCode'] : $GetNextCommunityCode ; ?>" placeholder="Community">
            <span class="errorstring" id="ErrCommunityCode"><?php echo isset($ErrCommunityCode)? $ErrCommunityCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="Community" class="col-sm-3 col-form-label">Community<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Community" name="Community" maxlength="100" value="<?php echo (isset($_POST['Community']) ? $_POST['Community'] : "");?>" placeholder="Community">
            <span class="errorstring" id="ErrCommunity"><?php echo isset($ErrCommunity)? $ErrCommunity : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnCommunity" id="BtnCommunity"  class="btn btn-primary mr-2">Save Community</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageCommunity"><small>List of Community</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    