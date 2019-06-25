<?php
    if (isset($_POST['BtnUpdateEducationDegree'])) {
        
        $duplicateEducationDegree = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['EducationDegree']."' and  HardCode='EDUCATIONDEGREES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateEducationDegree)==0) {
        $EducationDegreesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['EducationDegree']."',IsActive='".$_POST['IsActive']."' where HardCode='EDUCATIONDEGREES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorEducationDegree = "Education Degree already exists";
            echo "$errorEducationDegree";
        }
    }
    $EducationDegree = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewEducationDegree() {
                        $('#ErrEducationDegree').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("EducationDegree","ErrEducationDegree","Please Enter Valid Education Degree");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewEducationDegree();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Education Degree</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="EducationDegreeCode" class="col-sm-3 col-form-label"><small>Education Degreee Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" class="form-control" maxlength="10" id="EducationDegreeCode" name="EducationDegreeCode" value="<?php echo $EducationDegree[0]['SoftCode'];?>" placeholder="Education Degree Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="EducationDegree" class="col-sm-3 col-form-label"><small>Education Degree<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationDegree" maxlength="100" name="EducationDegree" value="<?php echo (isset($_POST['EducationDegree']) ? $_POST['EducationDegree'] : $EducationDegree[0]['CodeValue']);?>" placeholder="Education Degree">
                            <span class="errorstring" id="ErrEducationDegree"><?php echo isset($ErrEducationDegree)? $ErrEducationDegree : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($EducationDegree[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($EducationDegree[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateEducationDegree" class="btn btn-success mr-2">Update EducationDegree</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationDegrees"><small>List of Education Degrees</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>