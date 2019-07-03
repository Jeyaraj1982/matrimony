<script>
$(document).ready(function () {
   $("#ReligionCode").blur(function () {  
    IsNonEmpty("ReligionCode","ErrReligionCode","Please Enter Valid Religion Code");
   });
   $("#ReligionName").blur(function () {
        IsNonEmpty("ReligionName","ErrReligionName","Please Enter Valid Religion Name");
   });
});

 function SubmitNewReligionName() {
                         $('#ErrReligionCode').html("");
                         $('#ErrReligionName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("ReligionCode","ErrReligionCode","Please Enter Valid Religion Code")){
                        IsAlphaNumeric("ReligionCode","ErrReligionCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("ReligionName","ErrReligionName","Please Enter Valid Religion Name")){
                        IsAlphabet("ReligionName","ErrReligionName","Please Enter Alphabets Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnReligionName'])) {   
    $response = $webservice->getData("Admin","CreateReligionName",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $ReligionCode = $webservice->GetMastersManageDetails(); 
     $GetNextReligionCode="";
        if ($ReligionCode['status']=="success") {
            $GetNextReligionCode  =$ReligionCode['data']['ReligionCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitNewReligionName();">
        <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Masters</h4>
                  <h4 class="card-title">Create Religion Name</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Religion Name" class="col-sm-3 col-form-label">Religion Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text"   class="form-control" id="ReligionCode" name="ReligionCode" maxlength="10" value="<?php echo isset($_POST['ReligionCode']) ? $_POST['ReligionCode'] : $GetNextReligionCode ; ?>" placeholder="Religion Code">
                            <span class="errorstring" id="ErrReligionCode"><?php echo isset($ErrReligionCode)? $ErrReligionCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Religion Name" class="col-sm-3 col-form-label">Religion Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="ReligionName" name="ReligionName" maxlength="100" value="<?php echo (isset($_POST['ReligionName']) ? $_POST['ReligionName'] : "");?>" placeholder="Religion Name">
                            <span class="errorstring" id="ErrReligionName"><?php echo isset($ErrReligionName)? $ErrReligionName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnReligionName" id="BtnReligionName"  class="btn btn-primary mr-2">Save Religion Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageReligion"><small>List of Religion Names</small> </a>  </div>
                       </div>
                       <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php } ?>