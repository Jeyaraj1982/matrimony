<?php
    if (isset($_POST['BtnSaveOccupationType'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONTYPES' and CodeValue='".trim($_POST['OccupationType'])."'");
        if (sizeof($duplicate)>0) {
             $ErrOccupationType="Occupation Type Alreay Exists";    
             echo $ErrOccupationType;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONTYPES' and SoftCode='".trim($_POST['OccupationTypeCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrOccupationTypeCode="Occupation Code Alreay Exists";    
             echo $ErrOccupationTypeCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $OccupationTypeID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "OCCUPATIONTYPES",
                                                                          "SoftCode"   => trim($_POST['OccupationTypeCode']),
                                                                          "CodeValue"  => trim($_POST['OccupationType'])));
                                                                  
        if ($OccupationTypeID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Occupation Type";
        }
    
    }
    
    }   
    
    
?>
<script>
 function SubmitOccupation() {
                         $('#ErrOccupationTypeCode').html("");
                         $('#ErrOccupationName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("OccupationTypeCode","ErrOccupationTypeCode","Please Enter Valid Occupation Code");
                        IsNonEmpty("OccupationName","ErrOccupationName","Please Enter Valid Occupation Name");
                        IsAlphaNumeric("OccupationName","ErrOccupationName","Please Enter Alphanumeric Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitOccupation();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Occupation Type</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Occupation Type Code" class="col-sm-3 col-form-label"><small>Occupation Type Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationTypeCode" name="OccupationTypeCode" maxlength="10" value="<?php echo isset($_POST['OccupationTypeCode']) ? $_POST['OccupationTypeCode'] : GetNextNumber('OCCUPATIONTYPES');?>" placeholder="Occupation Type Code">
                            <span class="errorstring" id="ErrOccupationTypeCode"><?php echo isset($ErrOccupationTypeCode)? $ErrOccupationTypeCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation Type" class="col-sm-3 col-form-label"><small>Occupation Type<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationType" name="OccupationType" maxlength="100" value="<?php echo (isset($_POST['OccupationType']) ? $_POST['OccupationType'] : "");?>" placeholder="Occupation Type">
                            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" name="BtnSaveOccupationType" id="BtnSaveOccupationType"  class="btn btn-success mr-2">Save Occupation Type</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageOccupationTypes"><small>List of Occupation Types</small> </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>