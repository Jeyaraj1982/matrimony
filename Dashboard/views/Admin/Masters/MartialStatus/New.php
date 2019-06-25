<?php
    if (isset($_POST['BtnMartialStatus'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MARTIALSTATUS' and CodeValue='".trim($_POST['MartialStatus'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMartialStatus="Marital Status Alreay Exists";    
             echo $ErrMartialStatus;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MARTIALSTATUS' and SoftCode='".trim($_POST['MartialStatusCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMartialStatusCode="Marital Status Code Alreay Exists";    
             echo $ErrMartialStatusCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $MartialStatusID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "MARTIALSTATUS",
                                                                         "SoftCode"   => $_POST['MartialStatusCode'],
                                                                         "CodeValue"  => $_POST['MartialStatus']));
                                                                  
        if ($MartialStatusID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Martial Status";
        }
    
    }
    
}    
    
    
?>
<script>
 function SubmitMarital() {
                         $('#ErrMartialStatusCode').html("");
                         $('#ErrMartialStatus').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("MartialStatusCode","ErrMartialStatusCode","Please Enter Valid MaritalStatus Code");
                        IsAlphaNumeric("MartialStatusCode","ErrMartialStatusCode","Please Enter AlphaNumeric Charactors only");
                        IsNonEmpty("MartialStatus","ErrMartialStatus","Please Enter Valid MaritalStatus");
                        IsAlphabet("MartialStatus","ErrMartialStatus","Please Enter Alphabet Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitMarital();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Marital Status</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="MartialStatusCode" class="col-sm-3 col-form-label"><small>Marital Status Code<span id="star">*</span> </small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MartialStatusCode" name="MartialStatusCode" maxlength="10" value="<?php echo isset($_POST['MartialStatusCode']) ? $_POST['MartialStatusCode'] : GetNextNumber('MARTIALSTATUS');?>" placeholder="MartialStatusCode">
                            <span class="errorstring" id="ErrMartialStatusCode"><?php echo isset($ErrMartialStatusCode)? $ErrMartialStatusCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Martial Status" class="col-sm-3 col-form-label"><small>Marital Status<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MartialStatus" name="MartialStatus" maxlength="100" value="<?php echo (isset($_POST['MartialStatus']) ? $_POST['MartialStatus'] : "");?>" placeholder="Martial Status">
                            <span class="errorstring" id="ErrMartialStatus"><?php echo isset($ErrMartialStatus)? $ErrMartialStatus : "";?></span>
                          </div>
                        </div>      
                        <div class="form-group row">
                        <div class="col-sm-6">
                       <button type="submit" name="BtnMartialStatus" id="BtnMartialStatus"  class="btn btn-success mr-2">Save Marital Status</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageMartialStatus"><small>List of Marital Status</small> </a>  </div>
                       </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>