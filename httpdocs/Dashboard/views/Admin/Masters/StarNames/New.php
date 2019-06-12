<?php
    if (isset($_POST['BtnSaveStarName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and CodeValue='".trim($_POST['StarName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrStarName="Star Name Already Exists";    
             echo $ErrStarName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and SoftCode='".trim($_POST['StarCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrStarCode="Star Code Already Exists";    
             echo $ErrStarCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $StarID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "STARNAMES",
                                                                "SoftCode"   => trim($_POST['StarCode']),
                                                                "CodeValue"  => trim($_POST['StarName'])));
        if ($StarID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Star Name";
        }
    
    }
    }
?>
<script>
$(document).ready(function () {
   $("#StarCode").blur(function () {  
    IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code");
   });
   $("#StarName").blur(function () {
        IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name");
   });
});

 function SubmitNewStarName() {
                         $('#ErrStarCode').html("");
                         $('#ErrStarName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code")){
                        IsAlphaNumeric("StarCode","ErrStarCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name")){
                        IsAlphabet("StarName","ErrStarName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewStarName();">
             <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Star Name</h4>
                       <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Star Code" class="col-sm-3 col-form-label">Star Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="StarCode" name="StarCode"  maxlength="10" value="<?php echo (isset($_POST['StarCode']) ? $_POST['StarCode'] :GetNextNumber('STARNAMES'));?>" placeholder="Star Code">
                            <span class="errorstring" id="ErrStarCode"><?php echo isset($ErrStarCode)? $ErrStarCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Star Name" class="col-sm-3 col-form-label">Star Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="StarName" name="StarName"  maxlength="100" value="<?php echo (isset($_POST['StarName']) ? $_POST['StarName'] : "");?>" placeholder="Star Name">
                            <span class="errorstring" id="ErrStarName"><?php echo isset($ErrStarName)? $ErrStarName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveStarName" id="BtnSaveStarName"  class="btn btn-primary mr-2">Save Star Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageStar"><small>List of Star Names</small> </a>  </div>
                       </div>
                        </form>
                    </div>
                  </div>
                </div>
             </form>