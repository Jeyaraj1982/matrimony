<?php
   /* if (isset($_POST['BtnSaveEducationDegree'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATIONDEGREES' and CodeValue='".trim($_POST['EducationDegree'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEducationDegree="Education Degree Alreay Exists";    
             echo $ErrEducationDegree;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATIONDEGREES' and SoftCode='".trim($_POST['EducationDegreeCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEducationDegreeCode="Education Degree Code Alreay Exists";    
             echo $ErrEducationDegreeCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $EducationDegreeID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "EDUCATIONDEGREES",
                                                                          "SoftCode"   => trim($_POST['EducationDegreeCode']),
                                                                          "CodeValue"  =>trim($_POST['EducationDegree'])));
                                                                  
        if ($EducationDegreeID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Education Degree";
        }
    
    }
    
    }  */
    
    
?>
<script>
 function SubmitEducationDegree() {
                         $('#ErrEducationDegreeCode').html("");
                         $('#ErrEducationTitle').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("EducationDegreeCode","EducationDegreeCode","Please Enter Valid Education Degree Code");
                        IsAlphaNumeric("EducationDegreeCode","EducationDegreeCode","Please Enter Alphanumeric Charactors only");
                        IsNonEmpty("EducationDegree","ErrEducationDegree","Please Enter Valid Education Degree");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
 <?php                   
  if (isset($_POST['BtnSaveEducationDegree'])) {   
    $response = $webservice->getData("Admin","CreateEducationDegree",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $EducationCode = $webservice->GetMastersManageDetails(); 
     $GetNextEducationDegreeCode="";
        if ($EducationCode['status']=="success") {
            $GetNextEducationDegreeCode  =$EducationCode['data']['EducationDegreeCode'];
        }
        {     
?>
<form method="post" action="" onsubmit="return SubmitEducationDegree();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Education Degree</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Education Degree Code" class="col-sm-3 col-form-label">Education Degree Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="EducationDegreeCode" maxlength="10" name="EducationDegreeCode" value="<?php echo isset($_POST['EducationDegreeCode']) ? $_POST['EducationDegreeCode'] : $GetNextEducationDegreeCode;?>" placeholder="Education Degree Code">
                            <span class="errorstring" id="ErrEducationDegreeCode"><?php echo isset($ErrEducationDegreeCode)? $ErrEducationDegreeCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Education Degree" class="col-sm-3 col-form-label">Education Degree<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationDegree" maxlength="100" name="EducationDegree" value="<?php echo (isset($_POST['EducationDegree']) ? $_POST['EducationDegree'] : "");?>" placeholder= "EducationDegree">
                            <span class="errorstring" id="ErrEducationDegree"><?php echo isset($ErrEducationDegree)? $ErrEducationDegree : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                        <div class="form-group row">
                        <div class="col-sm-5">
                        <button type="submit" name="BtnSaveEducationDegree" class="btn btn-primary mr-2" style="font-family: roboto;">Save Education Degree</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageEducationDegrees"><small>List of Education Degrees</small> </a></div>
                         </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>
<?php }?>