<?php 
$page="ManageMonsigns";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php   
    if (isset($_POST['BtnUpdateMonsign'])) {
        
        $response = $webservice->getData("Admin","EditMonsign",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];                     
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $Monsign = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewMonsign() {
                        $('#ErrMonsign').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Monsign","ErrMonsign","Please Enter Valid Monsign");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewMonsign();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Edit Monsign</h4>
                <div class="form-group row">
                          <label for="MonsignCode" class="col-sm-3 col-form-label">Monsign Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="MonsignCode" name="MonsignCode" value="<?php echo $Monsign['SoftCode'];?>" placeholder="Monsign Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Monsign" class="col-sm-3 col-form-label">Monsign<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Monsign" name="Monsign" maxlength="100" value="<?php echo (isset($_POST['Monsign']) ? $_POST['Monsign'] : $Monsign['CodeValue']);?>" placeholder="Monsign">
                            <span class="errorstring" id="ErrMonsign"><?php echo isset($ErrMonsign)? $ErrMonsign : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($Monsign['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($Monsign['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                         <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateMonsign" class="btn btn-primary mr-2" style="font-family:roboto">Update Monsign</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageMonsigns">List of Monsigns</a></div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    