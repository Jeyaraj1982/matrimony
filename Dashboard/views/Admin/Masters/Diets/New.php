<?php
    if (isset($_POST['BtnSaveDiet'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DIETS' and CodeValue='".trim($_POST['DietName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrDietName="Diet Name Alreay Exists";    
             echo $ErrDietName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DIETS' and SoftCode='".trim($_POST['DietCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrDietCode="Diet Code Alreay Exists";    
             echo $ErrDietCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $DietID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "DIETS",
                                                                "SoftCode"  => trim($_POST['DietCode']),
                                                                "CodeValue" => trim($_POST['DietName'])));
                                                                  
        if ($DietID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Diet  Name";
        }
    
    }
    
    
    }    
    
?>
<script>
 function SubmitDiet() {
                         $('#ErrDietCode').html("");
                         $('#ErrDietName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("DietCode","ErrDietCode","Please Enter Valid Diet Code");
                        IsNonEmpty("DietName","ErrDietName","Please Enter Valid Diet Name");
                        IsAlphaNumeric("DietName","ErrDietName","Please Enter Alphanumeric Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitDiet();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Diet Name</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Diet Code" class="col-sm-3 col-form-label"><small>Diet Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="DietCode" name="DietCode" maxlength="10" value="<?php echo isset($_POST['DietCode']) ? $_POST['DietCode'] : GetNextNumber('DIETS');?>" placeholder="Diet Code">
                            <span class="errorstring" id="ErrDietCode"><?php echo isset($ErrDietCode)? $ErrDietCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Diet Name" class="col-sm-3 col-form-label"><small>Diet Name<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="DietName" name="DietName" maxlength="100" value="<?php echo (isset($_POST['DietName']) ? $_POST['DietName'] : "");?>" placeholder="Diet Name">
                            <span class="errorstring" id="ErrDietName"><?php echo isset($ErrDietName)? $ErrDietName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" name="BtnSaveDiet" id="BtnSaveDiet"  class="btn btn-success mr-2">Save Diet</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageDiets"><small>List of Diets</small> </a>  </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>