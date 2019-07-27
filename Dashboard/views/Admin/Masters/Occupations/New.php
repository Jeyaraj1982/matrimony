
<script>
 function SubmitOccupation() {
                         $('#ErrOccupationCode').html("");
                         $('#ErrOccupationName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("OccupationCode","ErrOccupationCode","Please Enter Valid Occupation Code");
                        IsNonEmpty("OccupationName","ErrOccupationName","Please Enter Valid Occupation Name");
                        IsAlphaNumeric("OccupationName","ErrOccupationName","Please Enter Alphanumeric Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
  <?php                   
  if (isset($_POST['BtnSaveOccupation'])) {   
    $response = $webservice->getData("Admin","CreateOccupation",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $OccupationCode = $webservice->GetMastersManageDetails(); 
     $GetNextOccupationCode="";
        if ($OccupationCode['status']=="success") {
            $GetNextOccupationCode  =$OccupationCode['data']['OccupationCode'];
        }
        {     
?>
 
<form method="post" action="" onsubmit="return SubmitOccupation();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Occupation</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Occupation Code" class="col-sm-3 col-form-label">Occupation Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="OccupationCode" name="OccupationCode" maxlength="10" value="<?php echo isset($_POST['OccupationCode']) ? $_POST['OccupationCode'] : $GetNextOccupationCode;?>" placeholder=" OccupationCode Code">
                            <span class="errorstring" id="ErrOccupationCode"><?php echo isset($ErrOccupationCode)? $ErrOccupationCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation Name" class="col-sm-3 col-form-label">Occupation Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationName" name="OccupationName" maxlength="100" value="<?php echo (isset($_POST['OccupationName']) ? $_POST['OccupationName'] : "");?>" placeholder="Occupation Name">
                            <span class="errorstring" id="ErrOccupationName"><?php echo isset($ErrOccupationName)? $ErrOccupationName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveOccupation" id="BtnSaveOccupation"  class="btn btn-primary mr-2" style="font-family: roboto;">Save Occupation</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageOccupations">List of Occupations </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php }?>