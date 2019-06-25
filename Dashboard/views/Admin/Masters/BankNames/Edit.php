<?php
    if (isset($_POST['BtnUpdateBankName'])) {
        
        $duplicateBankName = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['BankName']."' and  HardCode='BANKNAMES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateBankName)==0) {
        $BankNamesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['BankName']."',IsActive='".$_POST['IsActive']."' where HardCode='BANKNAMES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorBankName = "Bank Name already exists";
            echo "$errorBankName";
        }
    }
    $BankName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
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
                          <label for="BankCode" class="col-sm-3 col-form-label"><small>Bank Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="BankCode" name="BankCode" value="<?php echo $BankName[0]['SoftCode'];?>" placeholder="Bank Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="BankName" class="col-sm-3 col-form-label"><small>Bank Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankName" name="BankName" maxlength="100" value="<?php echo (isset($_POST['BankName']) ? $_POST['BankName'] : $BankName[0]['CodeValue']);?>" placeholder="Bank Name">
                            <span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($BankName[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($BankName[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateBankName" class="btn btn-success mr-2">Update Bank Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBank"><small>List of Bank Names</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>