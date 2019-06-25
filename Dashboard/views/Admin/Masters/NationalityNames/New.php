<script>
$(document).ready(function () {
   $("#NationalityCode").blur(function () {  
    IsNonEmpty("NationalityCode","ErrNationalityCode","Please Enter Valid Nationality Code");
   });
   $("#NationalityName").blur(function () {
        IsNonEmpty("NationalityName","ErrNationalityName","Please Enter Valid Nationality Name");
   });
});

 function SubmitNewNationalityName() {
                         $('#ErrNationalityCode').html("");
                         $('#ErrNationalityName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("NationalityCode","ErrNationalityCode","Please Enter Valid Nationality Code")){
                        IsAlphaNumeric("NationalityCode","ErrNationalityCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("NationalityName","ErrNationalityName","Please Enter Valid Nationality Name")){  
                        IsAlphabet("NationalityName","ErrNationalityName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveNationalityName'])) {   
    $response = $webservice->CreateNationalityName($_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $NationalityCode = $webservice->GetMastersManageDetails(); 
     $GetNextNationalityCode="";
        if ($NationalityCode['status']=="success") {
            $GetNextNationalityCode  =$NationalityCode['data']['NationalityNameCode'];
        }
        {     
?>
<form method="post" action="" onsubmit="return SubmitNewNationalityName();">
          <div class="col-12 stretch-card">
                  <div class="card">                                                   
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Nationality Name</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Nationality Code" class="col-sm-3 col-form-label">Nationality Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="NationalityCode" name="NationalityCode"  maxlength="10" value="<?php echo (isset($_POST['NationalityCode']) ? $_POST['NationalityCode'] : $GetNextNationalityCode);?>" placeholder="Nationality Code">
                            <span class="errorstring" id="ErrNationalityCode"><?php echo isset($ErrNationalityCode)? $ErrNationalityCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Nationality Name" class="col-sm-3 col-form-label">Nationality Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="NationalityName" name="NationalityName"  maxlength="100" value="<?php echo (isset($_POST['NationalityName']) ? $_POST['NationalityName'] : "");?>" placeholder="Nationality Name">
                            <span class="errorstring" id="ErrNationalityName"><?php echo isset($ErrNationalityName)? $ErrNationalityName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveNationalityName" id="BtnSaveNationalityName"  class="btn btn-primary mr-2"><small>Save Nationality Name</small></button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageNationalityName"><small>List of Nationality Names</small> </a>  </div>
                       </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php } ?>