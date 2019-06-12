<?php
    if (isset($_POST['BtnSaveEducationTitle'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATETITLES' and CodeValue='".trim($_POST['EducationTitle'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEducationTitle="Education Title Alreay Exists";    
             echo $ErrEducationTitle;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATETITLES' and SoftCode='".trim($_POST['EducationTitleCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEducationTitleCode="Education Title Code Alreay Exists";    
             echo $ErrEducationTitleCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $EducationTitleID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "EDUCATETITLES",
                                                                          "SoftCode"   => trim($_POST['EducationTitleCode']),
                                                                          "CodeValue"  => trim($_POST['EducationTitle'])));
                                                                  
        if ($EducationTitleID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save EducationTitle";
        }
    
    }
    
    }   
    
    
?>
<script>
 function SubmitEducationTitle() {
                         $('#ErrEducationTitleCode').html("");
                         $('#ErrEducationTitle').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("EducationTitleCode","ErrEducationTitleCode","Please Enter Valid Education Title Code");
                        IsAlphaNumeric("EducationTitleCode","ErrEducationTitleCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("EducationTitle","ErrEducationTitle","Please Enter Valid Education Title");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitEducationTitle();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create EducationTitle</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Education Title Code" class="col-sm-3 col-form-label"><small>Education Title Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationTitleCode" maxlength="10" name="EducationTitleCode" value="<?php echo isset($_POST['EducationTitleCode']) ? $_POST['EducationTitleCode'] : GetNextNumber('EDUCATETITLES');?>" placeholder="Education Title Code">
                            <span class="errorstring" id="ErrEducationTitleCode"><?php echo isset($ErrEducationTitleCode)? $ErrEducationTitleCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Education Title Name" class="col-sm-3 col-form-label"><small>Education Title <span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationTitle" maxlength="100" name="EducationTitle" value="<?php echo (isset($_POST['EducationTitle']) ? $_POST['EducationTitle'] : "");?>" placeholder="Education Title">
                            <span class="errorstring" id="ErrEducationTitle"><?php echo isset($ErrEducationTitle)? $ErrEducationTitle : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button type="submit" name="BtnSaveEducationTitle" id="BtnSaveEducationTitle"  class="btn btn-success mr-2">Save Education Title</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageEducationTitles"><small>List of Education Titles</small> </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>