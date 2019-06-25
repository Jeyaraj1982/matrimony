<?php
    if (isset($_POST['BtnUpdateStateName'])) {
         
        $duplicateStateName = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['StateName']."' and  HardCode='STATNAMES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateStateName)==0) { 
        $StateNamesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['StateName']."',IsActive='".$_POST['IsActive']."' where HardCode='STATNAMES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $ErrStateName = "State name already exists";
	    echo "$ErrStateName ";

        }
    }
    $StateName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
$(document).ready(function () {
   $("#StateCode").blur(function () {  
    IsNonEmpty("StateCode","ErrStateCode","Please Enter Valid State Code");
   });
   $("#StateName").blur(function () {
        IsNonEmpty("StateName","ErrStateName","Please Enter Valid State Name");
   });
});


 function SubmitNewStateName() {
                         $('#ErrStateCode').html("");
                         $('#ErrStateName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("StateCode","ErrStateCode","Please Enter Valid State Code")){
                        IsAlphaNumeric("StateCode","ErrStateCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StateName","ErrStateName","Please Enter Valid State Name")){
                        IsAlphabet("StateName","ErrStateName","Please Enter Alphabet Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewStateName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit State Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="StateCode" class="col-sm-3 col-form-label">State Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" class="form-control" maxlength="10" id="StateCode" name="StatetCode" value="<?php echo $StateName[0]['SoftCode'];?>" placeholder="State Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="StateName" class="col-sm-3 col-form-label">State Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="StateName" name="StateName" maxlength="100" value="<?php echo (isset($_POST['StateName']) ? $_POST['StateName'] : $StateName[0]['CodeValue']);?>" placeholder="State Name">
                            <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($StateName[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($StateName[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateStateName" class="btn btn-primary mr-2">Update State Name</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageState"><small>List of State Names</small></a>
                        </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>