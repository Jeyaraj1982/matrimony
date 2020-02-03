<?php 
$page="ManageVenderType";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateVenderType'])) {
        
        $response = $webservice->getData("Admin","EditVenderType",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $VenderType = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#VenderType").blur(function () {
        IsNonEmpty("VenderType","ErrVenderType","Please Enter Valid Vender Type");
   });
});

 function SubmitNewVenderType() {
                         $('#ErrVenderType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("VenderType","ErrVenderType","Please Enter Valid Vender Type ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewVenderType();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Vender Type</h4>  
                      <div class="form-group row">
                          <label for="VenderTypeCode" class="col-sm-3 col-form-label">Vender Type Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="VenderTypeCode" name="VenderTypeCode" value="<?php echo $VenderType['SoftCode'];?>" placeholder="VenderType Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="VenderType" class="col-sm-3 col-form-label">VenderType<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="VenderType" name="VenderType" maxlength="100" value="<?php echo (isset($_POST['VenderType']) ? $_POST['VenderType'] : $VenderType['CodeValue']);?>" placeholder="Document Type">
                            <span class="errorstring" id="ErrVenderType"><?php echo isset($ErrVenderType)? $ErrVenderType : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($VenderType['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($VenderType['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateVenderType" class="btn btn-primary mr-2">Update Vender Type</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageVenderType"><small>List of Vender Type</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    