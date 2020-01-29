<?php 
$page="ManageEducationTitles";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<?php   
    if (isset($_POST['BtnUpdateEducationTitle'])) {
        
        $response = $webservice->getData("Admin","EditEducationTitle",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $EducationTitle = $response['data']['ViewInfo'];
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
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitNewEducationTitle();">
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Masters</h4>
            <h4 class="card-title">Edit Education Title</h4>
          <div class="form-group row">
                          <label for="EducationTitleCode" class="col-sm-3 col-form-label">Education Title Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="EducationTitleCode" name="EducationTitleCode" value="<?php echo $EducationTitle['SoftCode'];?>" placeholder="Education Title Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="EducationTitle" class="col-sm-3 col-form-label">Education Title<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="EducationTitle" maxlength="100" name="EducationTitle" value="<?php echo (isset($_POST['EducationTitle']) ? $_POST['EducationTitle'] : $EducationTitle['CodeValue']);?>" placeholder="EducationTitle">
                            <span class="errorstring" id="ErrEducationTitle"><?php echo isset($ErrEducationTitle)? $ErrEducationTitle : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($EducationTitle['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($EducationTitle['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateEducationTitle" class="btn btn-primary mr-2" style="font-family: roboto;">Update EducationTitle</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageEducationTitles"><small>List of Education Titles</small></a></div>
                        </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    