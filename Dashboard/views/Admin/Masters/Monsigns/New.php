<?php
    if (isset($_POST['BtnSaveMonsign'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MONSIGNS' and CodeValue='".trim($_POST['Monsign'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMonsign="Monsign Already Exists";    
             echo $ErrMonsign;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MONSIGNS' and SoftCode='".trim($_POST['MonsignCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMonsignCode="MonsignCode Code Already Exists";    
             echo $ErrMonsignCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $MonsignID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "MONSIGNS",
                                                                   "SoftCode"  => trim($_POST['MonsignCode']),
                                                                   "CodeValue" => trim($_POST['Monsign'])));
                                                                  
        if ($MonsignID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Monsign";
        }
    
    }
    
    
    } 
    
?>
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
                          <label for="Monsign Code" class="col-sm-3 col-form-label"><small>Monsign Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MonsignCode" name="MonsignCode" maxlength="10" value="<?php echo isset($_POST['MonsignCode']) ? $_POST['MonsignCode'] : GetNextNumber('MONSIGNS');?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrMonsignCode"><?php echo isset($ErrMonsignCode)? $ErrMonsignCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Monsign" class="col-sm-3 col-form-label"><small>Monsign<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Monsign" name="Monsign" maxlength="100" value="<?php echo (isset($_POST['Monsign']) ? $_POST['Monsign'] : "");?>" placeholder="Monsign">
                            <span class="errorstring" id="ErrMonsign"><?php echo isset($ErrMonsign)? $ErrMonsign: "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                        <button type="submit" name="BtnSaveMonsign" class="btn btn-success mr-2">Save Monsign</button></div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageMonsigns"><small>List of Monsigns</small> </a> </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>