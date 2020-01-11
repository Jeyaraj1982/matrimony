<script>
 function SubmitFamilyType() {
                         $('#ErrFamilyTypeCode').html("");
                         $('#ErrFamilyType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyTypeCode","ErrFamilyTypeCode","Please Enter Valid Family Type Code");
                        IsNonEmpty("FamilyType","ErrFamilyType","Please Enter Valid FamilyType");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveFamilyType'])) {   
    $response = $webservice->getData("Admin","CreateFamilyType",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $FamilyTypeCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextFamilyTypeCode="";
        if ($FamilyTypeCode['status']=="success") {
            $GetNextFamilyTypeCode =$FamilyTypeCode['data']['FamilyTypeCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitFamilyType();">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Masters</h4>
                             <h4 class="card-title">Create Family Type</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Blood Group Code" class="col-sm-3 col-form-label">Family  Type Code<span id="star">*</span></label>
                                            <div class="col-sm-9">                                                                                      
                                                <input type="text" class="form-control" id="FamilyTypeCode" name="FamilyTypeCode" maxlength="10"  value="<?php echo (isset($_POST['FamilyTypeCode']) ? $_POST['FamilyTypeCode'] : $GetNextFamilyTypeCode);?>" placeholder="Family Type Code">
                                                <span class="errorstring" id="ErrFamilyTypeCode"><?php echo isset($ErrBloodGroupCode)? $ErrBloodGroupCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Blood Group Name" class="col-sm-3 col-form-label">Family Type<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="FamilyType" name="FamilyType" maxlength="100" value="<?php echo (isset($_POST['FamilyType']) ? $_POST['FamilyType'] : "");?>" placeholder="Family Type">
                                                <span class="errorstring" id="ErrFamilyTypeName"><?php echo isset($ErrBloodGroupName)? $ErrBloodGroupName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" name="BtnSaveFamilyType" id="BtnSaveFamilyType"  class="btn btn-primary mr-2">Save Blood Group</button> </div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageFamilyType"><small>List of Family Type</small> </a>  </div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>
<?php }?>