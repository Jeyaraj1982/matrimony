<script>
 function SubmitBankName() {
                         $('#ErrBankCode').html("");
                         $('#ErrBankName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BankCode","ErrBankCode","Please Enter Valid Bank Code");
                        IsAlphaNumeric("BankCode","ErrBankCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("BankName","ErrBankName","Please Enter Valid Bank Name");
                        IsAlphabet("BankName","ErrBankName","Please Enter Alphabet Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnBankName'])) {   
    $response = $webservice->getData("Admin","CreateBankName",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $BankCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextBankCode="";
        if ($BankCode['status']=="success") {
            $GetNextBankCode  =$BankCode['data']['BankCode'];
        }
        {     
?>
<form method="post" action="" onsubmit="return SubmitBankName();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Bank Name</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Bank Code" class="col-sm-3 col-form-label">Bank Name Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankCode" name="BankCode" maxlength="10" value="<?php echo isset($_POST['BankCode']) ? $_POST['BankCode'] : $GetNextBankCode;?>" placeholder="Bank Code">
                            <span class="errorstring" id="ErrBankCode"><?php echo isset($ErrBankCode)? $ErrBankCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Bank Name" class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankName" name="BankName" maxlength="100" value="<?php echo (isset($_POST['BankName']) ? $_POST['BankName'] : "");?>" placeholder="Bank Name">
                            <span class="errorstring" id="ErrEducationTitleCode"><?php echo isset($ErrEducationTitleCode)? $ErrEducationTitleCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4">
                       <button type="submit" name="BtnBankName" class="btn btn-primary mr-2" style="font-family:roboto">Save Bank Name</button></div>
                      <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageBank">List of Bank Names </a></div>
                         </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>
<?php }?>