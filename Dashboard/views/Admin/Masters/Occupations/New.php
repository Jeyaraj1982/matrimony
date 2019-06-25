<?php
    if (isset($_POST['BtnSaveOccupation'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONS' and CodeValue='".trim($_POST['OccupationName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrOccupationName="Occupation Name Alreay Exists";    
             echo $ErrOccupationName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONS' and SoftCode='".trim($_POST['OccupationCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrOccupationCode="Occupation Code Alreay Exists";    
             echo $ErrOccupationCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $OccupationID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "OCCUPATIONS",
                                                                  "SoftCode"   => trim($_POST['OccupationCode']),
                                                                  "CodeValue"  => trim($_POST['OccupationName'])));
                                                                  
        if ($OccupationID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Occupation";
        }
    
    }
    
    }  
    
    
?>
<script>
 function SubmitOccupation() {
                         $('#ErrOccupationCode').html("");
                         $('#ErrOccupationName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("OccupationCode","ErrOccupationCode","Please Enter Valid Occupation Code");
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
                      <h4 class="card-title">Create Occupation</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Occupation Code" class="col-sm-3 col-form-label"><small>Occupation Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationCode" name="OccupationCode" maxlength="10" value="<?php echo isset($_POST['OccupationCode']) ? $_POST['OccupationCode'] : GetNextNumber('OCCUPATIONS');?>" placeholder=" OccupationCode Code">
                            <span class="errorstring" id="ErrOccupationCode"><?php echo isset($ErrOccupationCode)? $ErrOccupationCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Occupation Name" class="col-sm-3 col-form-label"><small>Occupation Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="OccupationName" name="OccupationName" maxlength="100" value="<?php echo (isset($_POST['OccupationName']) ? $_POST['OccupationName'] : "");?>" placeholder="Occupation Name">
                            <span class="errorstring" id="ErrOccupationName"><?php echo isset($ErrOccupationName)? $ErrOccupationName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" name="BtnSaveOccupation" id="BtnSaveOccupation"  class="btn btn-success mr-2">Save Occupation</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageOccupations"><small>List of Occupations</small> </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>