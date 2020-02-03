<?php 
$page="ManageDocumentType";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<?php   
    if (isset($_POST['BtnUpdateDocumentType'])) {
        
        $response = $webservice->getData("Admin","EditDocumentType",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $DocumentType = $response['data']['ViewInfo'];
?>
 <script>
$(document).ready(function () {
   $("#DocumentType").blur(function () {
        IsNonEmpty("DocumentType","ErrDocumentType","Please Enter Valid DocumentType");
   });
});

 function SubmitNewDocumentType() {
                         $('#ErrDocumentType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("DocumentType","ErrDocumentType","Please Enter Valid DocumentType ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewDocumentType();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit DocumentType</h4>  
                      <div class="form-group row">
                          <label for="DocumentTypeCode" class="col-sm-3 col-form-label">DocumentType Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="DocumentTypeCode" name="DocumentTypeCode" value="<?php echo $DocumentType['SoftCode'];?>" placeholder="DocumentType Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="DocumentType" class="col-sm-3 col-form-label">DocumentType<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="DocumentType" name="DocumentType" maxlength="100" value="<?php echo (isset($_POST['DocumentType']) ? $_POST['DocumentType'] : $DocumentType['CodeValue']);?>" placeholder="Document Type">
                            <span class="errorstring" id="ErrDocumentType"><?php echo isset($ErrDocumentType)? $ErrDocumentType : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($DocumentType['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($DocumentType['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateDocumentType" class="btn btn-primary mr-2">Update Document Type</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDocumentType"><small>List of Document Type</small></a></div>
                        </div>
                        
                    </div>
                  </div>
                </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    