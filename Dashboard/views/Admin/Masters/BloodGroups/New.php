<?php
    if (isset($_POST['BtnSaveBloodGroup'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BLOODGROUPS' and CodeValue='".trim($_POST['BloodGroupName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBloodGroupName="Blood Group Name Alreay Exists";    
             echo $ErrBloodGroupName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BLOODGROUPS' and SoftCode='".trim($_POST['BloodGroupCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBloodGroupCode="BloodGroup Code Alreay Exists";    
             echo $ErrBloodGroupCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $BloodGroupID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "BLOODGROUPS",
                                                                      "SoftCode"   => trim($_POST['BloodGroupCode']),
                                                                      "CodeValue"  => trim($_POST['BloodGroupName'])));
       if ($BloodGroupID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Blood Group";
        }
   }
    }
?>
<script>
 function SubmitBloodGroup() {
                         $('#ErrBloodGroupCode').html("");
                         $('#ErrBloodGroupName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BloodGroupCode","ErrBloodGroupCode","Please Enter Valid Blood Group Code");
                        IsNonEmpty("BloodGroupName","ErrBloodGroupName","Please Enter Valid BloodGroupName");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitBloodGroup();">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Masters</h4>
                             <h4 class="card-title">Create Blood Group</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Blood Group Code" class="col-sm-3 col-form-label"><small>Blood Group Code<span id="star">*</span></small></label>
                                            <div class="col-sm-9">                                                                                      
                                                <input type="text" class="form-control" id="BloodGroupCode" name="BloodGroupCode" maxlength="10"  value="<?php echo (isset($_POST['BloodGroupCode']) ? $_POST['BloodGroupCode'] : GetNextNumber('BLOODGROUPS'));?>" placeholder="Blood Group Code">
                                                <span class="errorstring" id="ErrBloodGroupCode"><?php echo isset($ErrBloodGroupCode)? $ErrBloodGroupCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Blood Group Name" class="col-sm-3 col-form-label">Blood Group Name<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="BloodGroupName" name="BloodGroupName" maxlength="100" value="<?php echo (isset($_POST['BloodGroupName']) ? $_POST['BloodGroupName'] : "");?>" placeholder="Blood Group Name">
                                                <span class="errorstring" id="ErrBloodGroupName"><?php echo isset($ErrBloodGroupName)? $ErrBloodGroupName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <button type="submit" name="BtnSaveBloodGroup" id="BtnSaveBloodGroup"  class="btn btn-success mr-2">Save Blood Group<</button> </div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageBloodGroups"><small>List of Blood Groups</small> </a>  </div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>