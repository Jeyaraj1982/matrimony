<?php   
    if (isset($_POST['BtnUpdateBankName'])) {
        
        $response = $webservice->getData("Admin","EditBankName",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $BankName = $response['data']['ViewInfo'];
?>
<script>
 function SubmitNewBankName() {
                        $('#ErrBankName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BankName","ErrBankName","Please Enter Valid Bank Name");
                        IsAlphabet("BankName","ErrBankName","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewBankName();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Bank Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="BankCode" class="col-sm-3 col-form-label">Bank Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="BankCode" name="BankCode" value="<?php echo $BankName['SoftCode'];?>" placeholder="Bank Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="BankName" class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankName" name="BankName" maxlength="100" value="<?php echo (isset($_POST['BankName']) ? $_POST['BankName'] : $BankName['CodeValue']);?>" placeholder="Bank Name">
                            <span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($BankName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($BankName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                         <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateBankName" class="btn btn-primary mr-2" style="font-family:roboto">Update Bank Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBank">List of Bank Names</a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>