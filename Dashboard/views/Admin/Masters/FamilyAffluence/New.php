<script>
 function SubmitFamilyAffluence() {
                         $('#ErrFamilyAffluenceCode').html("");
                         $('#ErrFamilyAffluenceName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("FamilyAffluenceCode","ErrFamilyAffluenceCode","Please Enter Valid Family Affluence Code");
                        IsNonEmpty("FamilyAffluenceName","ErrFamilyAffluenceName","Please Enter Valid Family Affluence Name");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveFamilyAffluence'])) {   
    $response = $webservice->getData("Admin","CreateFamilyAffluence",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $FamilyAffluenceCode = $webservice->GetMastersManageDetails(); 
     $GetNextFamilyAffluenceCode="";
        if ($FamilyAffluenceCode['status']=="success") {
            $GetNextFamilyAffluenceCode  =$FamilyAffluenceCode['data']['FamilyAffluenceCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitFamilyAffluence();">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Masters</h4>
                             <h4 class="card-title">Create Family Affluence</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Blood Group Code" class="col-sm-3 col-form-label">Family Affluence Code<span id="star">*</span></label>
                                            <div class="col-sm-9">                                                                                      
                                                <input type="text" class="form-control" id="FamilyAffluenceCode" name="FamilyAffluenceCode" maxlength="10"  value="<?php echo (isset($_POST['FamilyAffluenceCode']) ? $_POST['FamilyAffluenceCode'] : $GetNextFamilyAffluenceCode);?>" placeholder="Family Affluence Code">
                                                <span class="errorstring" id="ErrFamilyAffluenceCode"><?php echo isset($ErrFamilyAffluenceCode)? $ErrFamilyAffluenceCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Blood Group Name" class="col-sm-3 col-form-label">Family Affluence<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="FamilyAffluenceName" name="FamilyAffluenceName" maxlength="100" value="<?php echo (isset($_POST['FamilyAffluenceName']) ? $_POST['FamilyAffluenceName'] : "");?>" placeholder="Family Affluence Name">
                                                <span class="errorstring" id="ErrFamilyAffluenceName"><?php echo isset($ErrFamilyAffluenceName)? $ErrFamilyAffluenceName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" name="BtnSaveFamilyAffluence" id="BtnSaveFamilyAffluence"  class="btn btn-primary mr-2">Save Blood Group</button> </div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageAffluence"><small>List of Family Affluence</small> </a>  </div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>
<?php }?>