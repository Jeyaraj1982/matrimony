<?php 
$page="Religion";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateReligionName'])) {
        
        $response = $webservice->getData("Admin","EditReligionName",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $ReligionName = $response['data']['ViewInfo'];
?>
<script>                                          
$(document).ready(function () {
   $("#ReligionCode").blur(function () {  
    IsNonEmpty("ReligionCode","ErrReligionCode","Please Enter Valid Religion Code");
   });
   $("#ReligionName").blur(function () {
        IsNonEmpty("ReligionName","ErrReligionName","Please Enter Valid Religion Name");
   });
});

 function SubmitNewReligionName() {
                         $('#ErrReligionCode').html("");
                         $('#ErrReligionName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("ReligionCode","ErrReligionCode","Please Enter Valid Religion Code")){
                        IsAlphaNumeric("ReligionCode","ErrReligionCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("ReligionName","ErrReligionName","Please Enter Valid Religion Name")){
                        IsAlphabet("ReligionName","ErrReligionName","Please Enter Alphabets Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }                                          
    
</script>
<form method="post" action="" onsubmit="return SubmitNewReligionName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Religion Name</h4>  
                      <div class="form-group row">
                          <label for="ReligionCode" class="col-sm-3 col-form-label">Religion Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="ReligionCode" name="ReligionCode" value="<?php echo $ReligionName['SoftCode'];?>" placeholder="Religion Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="ReligionName" class="col-sm-3 col-form-label">Religion Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="ReligionName" name="ReligionName" maxlength="100" value="<?php echo (isset($_POST['ReligionName']) ? $_POST['ReligionName'] : $ReligionName['CodeValue']);?>" placeholder="Religion Name">
                            <span class="errorstring" id="ErrReligionName"><?php echo isset($ErrReligionName)? $ErrReligionName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($ReligionName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($ReligionName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateReligionName" class="btn btn-primary mr-2">Update Religion Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageReligion"><small>List of Religion Names</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    