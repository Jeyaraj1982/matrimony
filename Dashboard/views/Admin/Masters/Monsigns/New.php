<script>
 function SubmitMonsign() {
                         $('#ErrMonsignCode').html("");
                         $('#ErrMonsign').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("MonsignCode","ErrMonsignCode","Please Enter Valid Monsign Code");
                        IsAlphaNumeric("MonsignCode","ErrMonsignCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("Monsign","ErrMonsign","Please Enter Valid Monsign");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveMonsign'])) {   
    $response = $webservice->getData("Admin","CreateMonsign",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {                                                                                                    
        $errormessage = $response['message']; 
    }
    } 
  $MonsignCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextMonsignCode="";
        if ($MonsignCode['status']=="success") {
            $GetNextMonsignCode  =$MonsignCode['data']['MonsignCode'];
        }
        {     
?>
<form method="post" action="" onsubmit="return SubmitMonsign();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Monsign</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Monsign Code" class="col-sm-3 col-form-label">Monsign Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MonsignCode" name="MonsignCode" maxlength="10" value="<?php echo isset($_POST['MonsignCode']) ? $_POST['MonsignCode'] : $GetNextMonsignCode;?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrMonsignCode"><?php echo isset($ErrMonsignCode)? $ErrMonsignCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Monsign" class="col-sm-3 col-form-label">Monsign<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Monsign" name="Monsign" maxlength="100" value="<?php echo (isset($_POST['Monsign']) ? $_POST['Monsign'] : "");?>" placeholder="Monsign">
                            <span class="errorstring" id="ErrMonsign"><?php echo isset($ErrMonsign)? $ErrMonsign: "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                        <button type="submit" name="BtnSaveMonsign" class="btn btn-primary mr-2" style="font-family: roboto;">Save Monsign</button></div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageMonsigns">List of Monsigns </a> </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>
<?php }?>