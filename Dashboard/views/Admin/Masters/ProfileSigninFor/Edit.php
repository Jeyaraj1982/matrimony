<?php
    if (isset($_POST['BtnUpdateProfileSigninFor'])) {
        
         $duplicateProfileSigninFor = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ProfileSigninFor']."' and  HardCode='PROFILESIGNIN' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateProfileSigninFor)==0) {
        $ProfileSigninForsID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['ProfileSigninFor']."',IsActive='".$_POST['IsActive']."' where HardCode='PROFILESIGNIN' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $errorProfileSigninFor= "Profile SigninFor already exists";
            echo "$errorProfileSigninFor";
        }
    }
    $ProfileSigninFor = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<script>
 function SubmitNewProfileSigninFor() {
                        $('#ErrReligionName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("ProfileSigninFor","ErrProfileSigninFor","Please Enter Valid Profile Signin For");
                        IsAlphabet("ProfileSigninFor","ErrProfileSigninFor","Please Enter Alphabet Charactors only");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewProfileSigninFor();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Profile SigninFor</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="ProfileSigninForCode" class="col-sm-3 col-form-label">ProfileSigninFor Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" class="form-control" id="ProfileSigninForCode" name="ProfileSigninForCode" value="<?php echo $ProfileSigninFor[0]['SoftCode'];?>" placeholder="Profile SigninFor Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="ProfileSigninFor" class="col-sm-3 col-form-label">Profile SigninFor<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="ProfileSigninFor" name="ProfileSigninFor" value="<?php echo (isset($_POST['ProfileSigninFor']) ? $_POST['ProfileSigninFor'] : $ProfileSigninFor[0]['CodeValue']);?>" placeholder="Profile SigninFor">
                            <span class="errorstring" id="ErrProfileSigninFor"><?php echo isset($ErrProfileSigninFor)? $ErrProfileSigninFor : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active<span id="star">*</span></label>
                          <div class="col-sm-6">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($ProfileSigninFor[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($ProfileSigninFor[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateProfileSigninFor" class="btn btn-primary mr-2">Update Profile SigninFor</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageProfileSigninFor"><small>List of Profile SigninFor</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>