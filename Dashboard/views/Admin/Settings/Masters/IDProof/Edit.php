<?php 
$page="ManageIDProof";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateIDProof'])) {
        
        $response = $webservice->getData("Admin","EditIDProof",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $IDProof = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#IDProof").blur(function () {
        IsNonEmpty("IDProof","ErrIDProof","Please Enter Valid IDProof");
   });
});

 function SubmitNewIDProof() {
                         $('#ErrIDProof').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("IDProof","ErrIDProof","Please Enter Valid IDProof ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewIDProof();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit ID Proof</h4>  
                      <div class="form-group row">
                          <label for="IDProofCode" class="col-sm-3 col-form-label">ID Proof Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="IDProofCode" name="IDProofCode" value="<?php echo $IDProof['SoftCode'];?>" placeholder="ID Proof Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="IDProof" class="col-sm-3 col-form-label">ID Proof<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="IDProof" name="IDProof" maxlength="100" value="<?php echo (isset($_POST['IDProof']) ? $_POST['IDProof'] : $IDProof['CodeValue']);?>" placeholder="ID Proof">
                            <span class="errorstring" id="ErrIDProof"><?php echo isset($ErrIDProof)? $ErrIDProof : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($IDProof['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($IDProof['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateIDProof" class="btn btn-primary mr-2">Update ID Proof</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageIDProof"><small>List of ID Proof</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    