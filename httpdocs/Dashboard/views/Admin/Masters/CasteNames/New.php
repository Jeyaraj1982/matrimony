<?php
    if (isset($_POST['BtnSaveCasteName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and CodeValue='".trim($_POST['CasteName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCasteName="Caste Name Already Exists";    
             echo $ErrCasteName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and SoftCode='".trim($_POST['CasteCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCasteCode="Caste Code Already Exists";    
             echo $ErrCasteCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $CasteID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "CASTNAMES",
                                                                 "SoftCode"   => trim($_POST['CasteCode']),
                                                                 "CodeValue"  => trim($_POST['CasteName'])));
       if ($CasteID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Caste Name";
        }
   }
}
?>
<script>
$(document).ready(function () {
$("#CasteCode").blur(function () {
    IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid CasteCode");
   });
   $("#CasteName").blur(function () {
        IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name");
   });
});
 function SubmitNewCasteName() {
                         $('#ErrCasteCode').html("");
                         $('#ErrCasteName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid Caste Code")){
                        IsAlphaNumeric("CasteCode","ErrCasteCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name")){
                        IsAlphabet("CasteName","ErrCasteName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewCasteName();">
        <div class="col-12 grid-margin">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Masters</h4>
                             <h4 class="card-title">Create Caste Name</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Caste Code" class="col-sm-3 col-form-label">Caste Name Code<span id="star">*</span></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="CasteCode" name="CasteCode"  maxlength="10" value="<?php echo (isset($_POST['CasteCode']) ? $_POST['CasteCode'] : GetNextNumber('CASTNAMES'));?>" placeholder="Caste Code">
                                                <span class="errorstring" id="ErrCasteCode"><?php echo isset($ErrCasteCode)? $ErrCasteCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Caste Name" class="col-sm-3 col-form-label">Caste Name<span id="star">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="CasteName" name="CasteName"  maxlength="100" value="<?php echo (isset($_POST['CasteName']) ? $_POST['CasteName'] : "");?>" placeholder="Caste Name">
                                                <span class="errorstring" id="ErrCasteName"><?php echo isset($ErrCasteName)? $ErrCasteName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                             <div class="col-sm-3">
                                                <button type="submit" name="BtnSaveCasteName" id="BtnSaveCasteName"  class="btn btn-primary mr-2">Save Caste Name</button> </div>
                                                <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageCaste"><small>List of Caste Names</small> </a>  </div>
                                             </div>
                                 </form>
                       </div>
                  </div>
             </div>
</form>