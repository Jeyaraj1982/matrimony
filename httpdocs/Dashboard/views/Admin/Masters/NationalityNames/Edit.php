<?php
    if (isset($_POST['BtnUpdateNationalityName'])) {
         
        $duplicateNationalityName = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['NationalityName']."' and  HardCode='NATIONALNAMES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateNationalityName)==0) {  
        $NationalityNamesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['NationalityName']."',IsActive='".$_POST['IsActive']."' where HardCode='NATIONALNAMES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $ErrNationalityName = "Nationality Name already exists";
            echo "$ErrNationalityName"; 
        }
    }
    $NationalityName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
$(document).ready(function () {
   $("#NationalityCode").blur(function () {  
    IsNonEmpty("NationalityCode","ErrNationalityCode","Please Enter Valid Nationality Code");
   });
   $("#NationalityName").blur(function () {
        IsNonEmpty("NationalityName","ErrNationalityName","Please Enter Valid Nationality Name");
   });
});

 function SubmitNewNationalityName() {
                         $('#ErrNationalityCode').html("");
                         $('#ErrNationalityName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("NationalityCode","ErrNationalityCode","Please Enter Valid Nationality Code")){
                        IsAlphaNumeric("NationalityCode","ErrNationalityCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("NationalityName","ErrNationalityName","Please Enter Valid Nationality Name")){  
                        IsAlphabet("NationalityName","ErrNationalityName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewNationalityName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Nationality Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="NationalityCode" class="col-sm-3 col-form-label">Nationality Code</label>
                          <div class="col-sm-3">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" class="form-control" maxlength="10" id="NationalityCode" name="NationalityCode" value="<?php echo $NationalityName[0]['SoftCode'];?>" placeholder="Nationality Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="NationalityName" class="col-sm-3 col-form-label">Nationality Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="NationalityName" name="NationalityName" maxlength="100" value="<?php echo (isset($_POST['NationalityName']) ? $_POST['NationalityName'] : $NationalityName[0]['CodeValue']);?>" placeholder="Nationality Name">
                            <span class="errorstring" id="ErrNationalityName"><?php echo isset($ErrNationalityName)? $ErrNationalityName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($NationalityName[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($NationalityName[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateNationalityName" class="btn btn-primary mr-2"><small>Update Nationality Name</small></button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageNationalityName"><small>List of Nationality Names</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>