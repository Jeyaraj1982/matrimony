<?php 
$page="ManageCommunity";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateCommunity'])) {
        
        $response = $webservice->getData("Admin","EditCommunity",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Community = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#Community").blur(function () {
        IsNonEmpty("Community","ErrCommunity","Please Enter Valid Community");
   });
});

 function SubmitNewCommunity() {
                         $('#ErrCommunity').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Community","ErrCommunity","Please Enter Valid Community ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewCommunity();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Community</h4>  
                      <div class="form-group row">
                          <label for="CommunityCode" class="col-sm-3 col-form-label">Community Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="CommunityCode" name="CommunityCode" value="<?php echo $Community['SoftCode'];?>" placeholder="Community Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Community" class="col-sm-3 col-form-label">Community<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="Community" name="Community" maxlength="100" value="<?php echo (isset($_POST['Community']) ? $_POST['Community'] : $Community['CodeValue']);?>" placeholder="Document Type">
                            <span class="errorstring" id="ErrCommunity"><?php echo isset($ErrCommunity)? $ErrCommunity : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Community['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Community['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateCommunity" class="btn btn-primary mr-2">Update Community</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCommunity"><small>List of Community</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    