<?php 
$page="ManageEducationDegrees";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php   
    if (isset($_POST['BtnUpdateEducationDegree'])) {
        
        $response = $webservice->getData("Admin","EditEducationDegree",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $EducationDegree = $response['data']['ViewInfo'];
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
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewEducationDegree();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
         <h4 class="card-title">Masters</h4>
         <h4 class="card-title">Edit Education Degree</h4>
          <div class="form-group row">
                          <label for="EducationDegreeCode" class="col-sm-3 col-form-label">Education Degreee Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" class="form-control" maxlength="10" id="EducationDegreeCode" name="EducationDegreeCode" value="<?php echo $EducationDegree['SoftCode'];?>" placeholder="Education Degree Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="EducationDegree" class="col-sm-3 col-form-label">Education Degree<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationDegree" maxlength="100" name="EducationDegree" value="<?php echo (isset($_POST['EducationDegree']) ? $_POST['EducationDegree'] : $EducationDegree['CodeValue']);?>" placeholder="Education Degree">
                            <span class="errorstring" id="ErrEducationDegree"><?php echo isset($ErrEducationDegree)? $ErrEducationDegree : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($EducationDegree['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($EducationDegree['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateEducationDegree" class="btn btn-primary mr-2" style="font-family:roboto">Update EducationDegree</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationDegrees">List of Education Degrees</a></div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    