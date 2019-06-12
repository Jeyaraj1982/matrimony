<?php
    if (isset($_POST['BtnUpdateEducationTitle'])) {
        
        $duplicateEducationTitle = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ReligionName']."' and  HardCode='EDUCATETITLES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateEducationTitle)==0) {
        $EducationTitlesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['EducationTitle']."',IsActive='".$_POST['IsActive']."' where HardCode='EDUCATETITLES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorEducationTitle = "Education Title already exists";
            echo "$errorEducationTitle";
        }
    }
    $EducationTitle = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewEducationTitle() {
                        $('#ErrEducationTitle').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("EducationTitle","ErrEducationTitle","Please Enter Valid Education Title");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitNewEducationTitle();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Education Title</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="EducationTitleCode" class="col-sm-3 col-form-label"><small>Education Title Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="EducationTitleCode" name="EducationTitleCode" value="<?php echo $EducationTitle[0]['SoftCode'];?>" placeholder="Education Title Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="EducationTitle" class="col-sm-3 col-form-label"><small>Education Title<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationTitle" maxlength="100" name="EducationTitle" value="<?php echo (isset($_POST['EducationTitle']) ? $_POST['EducationTitle'] : $EducationTitle[0]['CodeValue']);?>" placeholder="EducationTitle">
                            <span class="errorstring" id="ErrEducationTitle"><?php echo isset($ErrEducationTitle)? $ErrEducationTitle : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label"><small>Is Active</small></label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($EducationTitle[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($EducationTitle[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnUpdateEducationTitle" class="btn btn-success mr-2">Update EducationTitle</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationTitles"><small>List of Education Titles</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>