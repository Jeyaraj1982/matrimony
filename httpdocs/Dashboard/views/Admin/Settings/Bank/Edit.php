<?php   
           /* $mail2 = new MailController();
            echo    $mail2->NewFranchisee(array("mailTo"         => "Jeyaraj_123@yahoo.com",
                                       "FranchiseeName" => "Jeyaraj",
                                       "LoginName"      => "Jeyaraj123",
                                       "LoginPassword"  => "welcome@82"));                                                 */
            
    if (isset($_POST['BtnSaveCreate'])) {
         
        $ErrorCount =0;
        
        if (isset($_POST['AccountName'])) {
            
            if (strlen(trim($_POST['AccountName']))>0) {
            
            } else {
                $ErrAccountName="Please enter Account Name";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAccountName="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['AccountNumber'])) {
            
            if (strlen(trim($_POST['AccountNumber']))>0) {
            
            } else {
                $ErrAccountNumber="Please enter Account Number";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrAccountNumber="Param Missing";    
            $ErrorCount++;  
        }
        
        if (isset($_POST['IFSCode'])) {
            
            if (strlen(trim($_POST['IFSCode']))>0) {
            
            } else {
                $ErrIFSCode="Please enter IFS Code";    
                $ErrorCount++;  
            }
            
        } else {
            $ErrIFSCode="Param Missing";    
            $ErrorCount++;  
        }
        
            
        
        $duplicate = $mysql->select("select * from  _tbl_settings_bankdetails where AccountName='".trim($_POST['AccountName'])."' and BankID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrAccountName="Account Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_settings_bankdetails where AccountNumber='".trim($_POST['AccountNumber'])."' and BankID<>'".$_GET['Code']."'");
        if (sizeof($duplicate)>0) {
             $ErrAccountNumber="Account Number Already Exists";    
             $ErrorCount++;
        }
     $Bank =$mysql->select("select * from _tbl_settings_bankdetails where BankID='".$_REQUEST['Code']."'");
         
            if (sizeof($Bank)==0) {
            echo "Error: Access denied. Please contact administrator";
             } else {
        

                 
  if ($ErrorCount==0) {
               
    $mysql->execute("update _tbl_settings_bankdetails set BankName='".$_POST['BankName']."',
                                                        AccountName='".$_POST['AccountName']."',
                                                        AccountNumber='".$_POST['AccountNumber']."',
                                                        IFSCode='".$_POST['IFSCode']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  BankID='".$_REQUEST['Code']."'"); 
                                                              
            unset($_POST);
               echo "Updated Successfully";
            
        } else {
            echo "Error occured. Couldn't save Bank Details";
        }
          
 
    
    }
    }
    $Bank =$mysql->select("select * from _tbl_settings_bankdetails where BankID='".$_REQUEST['Code']."'");
    
    
?>                                                                        
<script>

$(document).ready(function () {
    $("#AccountNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAccountNumber").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   
    $("#AccountName").blur(function () {
    
        IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name");
                        
   });
   $("#AccountNumber").blur(function () {
    
        IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
                        
   });
   $("#IFSCode").blur(function () {
    
        IsNonEmpty("IFSCode","ErrIFSCode","Please Enter IFS Code");
                        
   });

});

function SubmitNewBank() { 
                         $('#ErrAccountName').html("");
                         $('#ErrAccountNumber').html("");
                         $('#ErrIFSCode').html("");
                                                 
                         ErrorCount=0;
                         
                        if (IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name")) {
                        IsAlphabet("AccountName","ErrAccountName","Please Enter Alpha Numeric Characters only");
                        }
                        IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number");
                        if (IsNonEmpty("IFSCode","ErrIFSCode","Please Enter Valid IFSCode")) {
                        IsAlphaNumeric("IFSCode","ErrIFSCode","Please Enter Alpha Numeric Characters only");
                        }
                         if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 }
</script>   
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bank Account Details</h4>
                </div>
              </div>
</div>

<form method="post" action="" onsubmit="return SubmitNewBank();">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Bank Account Details</h4>
                   <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <?php $BankNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BANKNAMES'"); ?>
                          <select class="form-control" id="BankName"  name="BankName" >
                          <?php foreach($BankNames as $BankName) { ?>
                         <option value="<?php echo $BankName['CodeValue'];?>" <?php echo ($Bank[0]['BankName']==$BankName['CodeValue']) ? " selected='selected' " : "";?> ><?php echo $BankName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          </div>                                                                 
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountName" name="AccountName" Placeholder="Account Name" value="<?php echo (isset($_POST['AccountName']) ? $_POST['AccountName'] : $Bank[0]['AccountName']);?>">
                            <span class="errorstring" id="ErrAccountName"><?php echo isset($ErrAccountName)? $ErrAccountName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Number<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="AccountNumber" name="AccountNumber" Placeholder="Account Number" value="<?php echo (isset($_POST['AccountNumber']) ? $_POST['AccountNumber'] : $Bank[0]['AccountNumber']);?>">
                            <span class="errorstring" id="ErrAccountNumber"><?php echo isset($ErrAccountNumber)? $ErrAccountNumber : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">IFS Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" maxlength="15" class="form-control" id="IFSCode" name="IFSCode" Placeholder="IFS Code" value="<?php echo (isset($_POST['IFSCode']) ? $_POST['IFSCode'] : $Bank[0]['IFSCode']);?>">
                            <span class="errorstring" id="ErrIFSCode"><?php echo isset($ErrIFSCode)? $ErrIFSCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" style="width: 140px;" >
                                    <option value="1" <?php echo ($Bank[0]['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Bank[0]['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                        </div>
                      </div>
                     </div>
                     <div class="row">
                      <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-2"><button type="submit" class="btn btn-primary" name="BtnSaveCreate">Update Bank</button></div>
                        <div class="col-sm-2"><a href="../ListofBanks" style="text-decoration: underline;">List of Bank</a></div>
                      </div>
                      </div>
                   </div>
                  </form>
              </div>
       </div>
</div>
</form>