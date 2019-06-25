<?php
    if (isset($_POST['BtnSaveLakanam'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LAKANAM' and CodeValue='".trim($_POST['Lakanam'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLakanam="Lakanam Already Exists";    
             echo $ErrLakanam;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LAKANAM' and SoftCode='".trim($_POST['LakanamCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLakanamCode="Lakanam Code Already Exists";    
             echo $ErrLakanamCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $LakanamID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "LAKANAM",
                                                                   "SoftCode"  => trim($_POST['LakanamCode']),
                                                                   "CodeValue" => trim($_POST['Lakanam'])));
                                                                  
        if ($LakanamID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Lakanam";
        }
    
    }
    
    
    }
    
    
?>
<script>
 function SubmitLakanam() {
                         $('#ErrLakanamCode').html("");
                         $('#ErrLakanam').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("LakanamCode","ErrLakanamCode","Please Enter Valid Lakanam Code");
                        IsAlphaNumeric("LakanamCode","ErrLakanamCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("Lakanam","ErrLakanam","Please Enter Valid Lakanam");
                        
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitLakanam();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Add Lakanam</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Lakanam Code" class="col-sm-3 col-form-label"><small>Lakanam Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LakanamCode" name="LakanamCode" maxlength="10" value="<?php echo isset($_POST['LakanamCode']) ? $_POST['LakanamCode'] : GetNextNumber('LAKANAM');?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrLakanamCode"><?php echo isset($ErrLakanamCode)? $ErrLakanamCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Lakanam" class="col-sm-3 col-form-label"><small>Lakanam<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Lakanam" name="Lakanam" maxlength="100" value="<?php echo (isset($_POST['Lakanam']) ? $_POST['Lakanam'] : "");?>" placeholder="Lakanam">
                            <span class="errorstring" id="ErrLakanam"><?php echo isset($ErrLakanam)? $ErrLakanam : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                        <button type="submit" name="BtnSaveLakanam" class="btn btn-success mr-2">Save Lakanam</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageLakanam"><small>List of Lakanam</small> </a></div>
                         </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>