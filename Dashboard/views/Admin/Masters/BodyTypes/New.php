<?php
    if (isset($_POST['BtnSaveBodyTypes'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BODYTYPES' and CodeValue='".trim($_POST['BodyType'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBodyType="Body Type Alreay Exists";    
             echo $ErrBodyType;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BODYTYPES' and SoftCode='".trim($_POST['BodyTypesCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBodyTypesCode="Body Types Code Alreay Exists";    
             echo $ErrBodyTypesCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $BodyTypesID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "BODYTYPES",
                                                                     "SoftCode"   => trim($_POST['BodyTypesCode']),
                                                                     "CodeValue"  => trim($_POST['BodyType'])));
       if ($BodyTypesID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Body Types";
        }
   }
    }
?>
<script>
 function SubmitBodyType() {
                         $('#ErrBodyTypesCode').html("");
                         $('#ErrBodyType').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BodyTypesCode","ErrBodyTypesCode","Please Enter Valid BodyTypes Code");
                        IsNonEmpty("BodyType","ErrBodyType","Please Enter Valid BodyType");
                        IsAlphaNumeric("BodyType","ErrBodyType","Please Enter Alphanumeric Charactors only");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitBodyType();">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Masters</h4>
                             <h4 class="card-title">Create Body Type</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Body Type Code" class="col-sm-3 col-form-label"><small>Body Type Code<span id="star">*</span></small></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="BodyTypesCode" name="BodyTypesCode" maxlength="10" value="<?php echo (isset($_POST['BodyTypesCode']) ? $_POST['BodyTypesCode'] : GetNextNumber('BODYTYPES'));?>" placeholder="Body Type Code">
                                                <span class="errorstring" id="ErrBodyTypesCode"><?php echo isset($ErrBodyTypesCode)? $ErrBodyTypesCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Body Type" class="col-sm-3 col-form-label">Body Type<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="BodyType" name="BodyType" maxlength="100" value="<?php echo (isset($_POST['BodyType']) ? $_POST['BodyType'] : "");?>" placeholder="Body Type">
                                                <span class="errorstring" id="ErrBodyType"><?php echo isset($ErrBodyType)? $ErrBodyType : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <button type="submit" name="BtnSaveBodyTypes" id="BtnSaveBodyTypes"  class="btn btn-success mr-2">Save Body Type</button> </div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageBodyTypes"><small>List of Body Types</small> </a>  </div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>