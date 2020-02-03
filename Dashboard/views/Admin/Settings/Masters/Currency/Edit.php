<?php 
$page="ManageCurrency";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateCurrency'])) {
        
        $response = $webservice->getData("Admin","EditCurrency",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Currency = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#Currency").blur(function () {
        IsNonEmpty("Currency","ErrCurrency","Please Enter Valid Currency");
   });
});

 function SubmitNewCurrency() {
                         $('#ErrCurrency').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Currency","ErrCurrency","Please Enter Valid Currency ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewCurrency();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Currency</h4>  
                      <div class="form-group row">
                          <label for="CurrencyCode" class="col-sm-3 col-form-label">Currency Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="CurrencyCode" name="CurrencyCode" value="<?php echo $Currency['SoftCode'];?>" placeholder="Currency Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Currency" class="col-sm-3 col-form-label">Currency<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="Currency" name="Currency" maxlength="100" value="<?php echo (isset($_POST['Currency']) ? $_POST['Currency'] : $Currency['CodeValue']);?>" placeholder="Currency">
                            <span class="errorstring" id="ErrCurrency"><?php echo isset($ErrCurrency)? $ErrCurrency : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Currency['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Currency['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateCurrency" class="btn btn-primary mr-2">Update Currency</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCurrency"><small>List of Currency</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    