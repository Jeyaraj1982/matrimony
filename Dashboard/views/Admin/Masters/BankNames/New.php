<?php
    if (isset($_POST['BtnBankName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BANKNAMES' and CodeValue='".trim($_POST['BankName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBankName="Ban kName Already Exists";    
             echo $ErrBankName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BANKNAMES' and SoftCode='".trim($_POST['BankCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBankCode="BankCode Already Exists";    
             echo $ErrBankCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $BankNamesID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "BANKNAMES",
                                                                      "SoftCode"  => trim($_POST['BankCode']),
                                                                      "CodeValue" => trim($_POST['BankName'])));
                                                                  
        if ($BankNamesID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Bank  Name";
        }
    
    }
    
    
    }  
    
?>
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
                          <label for="Bank Code" class="col-sm-3 col-form-label"><small>Bank Name Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankCode" name="BankCode" maxlength="10" value="<?php echo isset($_POST['BankCode']) ? $_POST['BankCode'] : GetNextNumber('BANKNAMES');?>" placeholder="Bank Code">
                            <span class="errorstring" id="ErrBankCode"><?php echo isset($ErrBankCode)? $ErrBankCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Bank Name" class="col-sm-3 col-form-label"><small>Bank Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="BankName" name="BankName" maxlength="100" value="<?php echo (isset($_POST['BankName']) ? $_POST['BankName'] : "");?>" placeholder="Bank Name">
                            <span class="errorstring" id="ErrEducationTitleCode"><?php echo isset($ErrEducationTitleCode)? $ErrEducationTitleCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4">
                       <button type="submit" name="BtnBankName" class="btn btn-success mr-2">Save Bank Name</button></div>
                      <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageBank"><small>List of Bank Names</small> </a></div>
                         </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>