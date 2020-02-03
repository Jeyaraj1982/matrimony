<?php 
$page="ManageTimeZone";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateTimeZone'])) {
        
        $response = $webservice->getData("Admin","EditTimeZone",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $TimeZone = $response['data']['ViewInfo'];
?>
<script>                                          
$(document).ready(function () {
   $("#TimeZoneCode").blur(function () {  
    IsNonEmpty("ReligionCode","ErrReligionCode","Please Enter Valid TimeZone Code");
   });
   $("#TimeZone").blur(function () {
        IsNonEmpty("TimeZone","ErrTimeZone","Please Enter Valid TimeZone");
   });
});

 function SubmitNewTimeZone() {
                         $('#ErrReligionCode').html("");
                         $('#ErrTimeZone').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("TimeZoneCode","ErrTimeZoneCode","Please Enter Valid TimeZone Code")){
                        IsAlphaNumeric("TimeZoneCode","ErrTimeZoneCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("TimeZone","ErrTimeZone","Please Enter Valid TimeZone");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }                                          
    
</script>
<form method="post" action="" onsubmit="return SubmitNewTimeZone();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit TimeZone</h4>  
                      <div class="form-group row">
                          <label for="ReligionCode" class="col-sm-3 col-form-label">TimeZone Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="TimeZoneCode" name="TimeZoneCode" value="<?php echo $TimeZone['SoftCode'];?>" placeholder="TimeZone Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="TimeZone" class="col-sm-3 col-form-label">Time Zone<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="TimeZone" name="TimeZone" maxlength="100" value="<?php echo (isset($_POST['TimeZone']) ? $_POST['TimeZone'] : $TimeZone['CodeValue']);?>" placeholder="TimeZone Name">
                            <span class="errorstring" id="ErrTimeZone"><?php echo isset($ErrTimeZone)? $ErrTimeZone : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($TimeZone['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($TimeZone['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateTimeZone" class="btn btn-primary mr-2">Update TimeZone</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageTimeZone"><small>List of TimeZone</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    