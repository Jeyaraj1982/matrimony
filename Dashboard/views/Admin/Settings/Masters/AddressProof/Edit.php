<?php 
$page="ManageAddressProof";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateAddressProof'])) {
        
        $response = $webservice->getData("Admin","EditAddressProof",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $AddressProof = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#AddressProof").blur(function () {
        IsNonEmpty("AddressProof","ErrAddressProof","Please Enter Valid Address Proof");
   });
});

 function SubmitNewAddressProof() {
                         $('#ErrAddressProof').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("AddressProof","ErrAddressProof","Please Enter Valid Address Proof ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewAddressProof();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Address Proof</h4>  
                      <div class="form-group row">
                          <label for="AddressProofCode" class="col-sm-3 col-form-label">Address Proof Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="AddressProofCode" name="AddressProofCode" value="<?php echo $AddressProof['SoftCode'];?>" placeholder="Address Proof Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AddressProof" class="col-sm-3 col-form-label">Address Proof<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="AddressProof" name="AddressProof" maxlength="100" value="<?php echo (isset($_POST['AddressProof']) ? $_POST['AddressProof'] : $AddressProof['CodeValue']);?>" placeholder="Address Proof">
                            <span class="errorstring" id="ErrAddressProof"><?php echo isset($ErrAddressProof)? $ErrAddressProof : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($AddressProof['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($AddressProof['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateAddressProof" class="btn btn-primary mr-2">Update Address Proof</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageAddressProof"><small>List of Address Proof</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    