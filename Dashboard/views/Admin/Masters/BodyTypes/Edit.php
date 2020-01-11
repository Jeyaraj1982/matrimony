<?php   
    if (isset($_POST['BtnUpdateBodyType'])) {
        
        $response = $webservice->getData("Admin","EditBodyType",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $BodyType = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewBodyType() {
                        $('#ErrBodyType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BodyType","ErrBodyType","Please Enter Valid Body Type");
                        IsAlphabet("BodyType","ErrBodyType","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewBodyType();">
  <div class="col-12 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Masters</h4>  
              <h4 class="card-title">Edit BodyType</h4>  
              <form class="forms-sample">
              <div class="form-group row">
                  <label for="BodyTypeCode" class="col-sm-3 col-form-label">BodyType Code<span id="star">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="BodyTypeCode" name="BodyTypeCode" value="<?php echo $BodyType['SoftCode'];?>" placeholder="BodyType Code">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="BodyType" class="col-sm-3 col-form-label">BodyType<span id="star">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="BodyType" name="BodyType" maxlength="100" value="<?php echo (isset($_POST['BodyType']) ? $_POST['BodyType'] : $BodyType['CodeValue']);?>" placeholder="BodyType">
                    <span class="errorstring" id="ErrBodyType"><?php echo isset($ErrBodyType)? $ErrBodyType : "";?></span>
                  </div>
                </div>
                 <div class="form-group row">
                  <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                  <div class="col-sm-9">
                        <select name="IsActive" class="form-control" style="width:80px">
                            <option value="1" <?php echo ($BodyType['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                            <option value="0" <?php echo ($BodyType['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                        </select>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                </div>
                <div class="form-group row">
                <div class="col-sm-4">
                <button type="submit" name="BtnUpdateBodyType" class="btn btn-primary mr-2">Update BodyType</button></div>
                <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBodyTypes"><small>List of Body Types</small></a></div>
                </div>
                </form>
            </div>
          </div>
        </div>
</form>