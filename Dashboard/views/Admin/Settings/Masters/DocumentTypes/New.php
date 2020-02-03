<?php 
$page="ManageDocumentType";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#DocumentTypeCode").blur(function () {  
    IsNonEmpty("DocumentTypeCode","ErrDocumentTypeCode","Please Enter Valid DocumentType Code");
   });
   $("#DocumentType").blur(function () {
        IsNonEmpty("DocumentType","ErrDocumentType","Please Enter Valid DocumentType");
   });
});

 function SubmitNewDocumentType() {
                         $('#ErrDocumentTypeCode').html("");
                         $('#ErrDocumentType').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("DocumentTypeCode","ErrDocumentTypeCode","Please Enter Valid DocumentType Code")){
                        IsAlphaNumeric("DocumentTypeCode","ErrDocumentTypeCode","Please Enter Alphanumeric Charactors only");
                        }
                        IsNonEmpty("DocumentType","ErrDocumentType","Please Enter Valid DocumentType ");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-sm-10 rightwidget">
 <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">Create DocumentType</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnDocumentType'])) {   
    $response = $webservice->getData("Admin","CreateDocumentType",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else { 
        $errormessage = $response['message']; 
    }
    } 
  $DocumentTypeCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextDocumentTypeCode="";
        if ($DocumentTypeCode['status']=="success") {
            $GetNextDocumentTypeCode  =$DocumentTypeCode['data']['DocumentTypeCode'];
        }
?>
<form method="post" action="" onsubmit="return SubmitNewDocumentType();">
    
        <div class="form-group row">
          <label for="DocumentType" class="col-sm-3 col-form-label">DocumentType Code<span id="star">*</span></label>
          <div class="col-sm-2">
            <input type="text"   class="form-control" id="DocumentTypeCode" name="DocumentTypeCode" maxlength="10" value="<?php echo isset($_POST['DocumentTypeCode']) ? $_POST['DocumentTypeCode'] : $GetNextDocumentTypeCode ; ?>" placeholder="Document Type Code">
            <span class="errorstring" id="ErrDocumentTypeCode"><?php echo isset($ErrDocumentTypeCode)? $ErrDocumentTypeCode : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="DocumentType" class="col-sm-3 col-form-label">DocumentType<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="DocumentType" name="DocumentType" maxlength="100" value="<?php echo (isset($_POST['DocumentType']) ? $_POST['DocumentType'] : "");?>" placeholder="Document Type">
            <span class="errorstring" id="ErrDocumentType"><?php echo isset($ErrDocumentType)? $ErrDocumentType : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnDocumentType" id="BtnDocumentType"  class="btn btn-primary mr-2">Save Document Type</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageDocumentType"><small>List of Document Type</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    