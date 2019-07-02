<?php
  /*  $ProfileFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN'");
    $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'"); 
    $MaritalStatuss = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS'");
    $Languages = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES'");
    $Religions = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES'");
    $Castes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES'");
    $Communitys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY'");
    $Nationalitys = $mysql->select("");
    
    if (isset($_POST['BtnSaveProfile'])) {
        
      $ErrorCount =0;
              print_r($_POST);
      if ($_POST['ProfileFor']=="0") {
            $ErrorCount++;
            $ErrProfileFor = "Please select Profile for ";
        }
      if ($_POST['ProfileName']=="") {
            $ErrorCount++;
            $ErrProfileName = "Please Enter your Name ";
        }
      if ($_POST['DateofBirth']=="") {
            $ErrorCount++;
            $ErrDateofBirth = "Please Enter Date of Birth ";
        }
      if ($_POST['Sex']=="0") {
            $ErrorCount++;
            $ErrSex = "Please select Sex ";         
        }
      if ($_POST['MaritalStatus']=="0") {                                
            $ErrorCount++;
            $ErrMaritalStatus = "Please select Marital Status ";
        }
      if ($_POST['Language']=="0") {                                        
            $ErrorCount++;
            $ErrLanguage = "Please select Mother Tongue ";
        }
      if ($_POST['Religion']=="0") {                                
            $ErrorCount++;
            $ErrReligion = "Please select Religion";
        }
      if ($_POST['Caste']=="0") {                                
            $ErrorCount++;
            $ErrCaste = "Please select Caste";
        }  
        if ($_POST['Community']=="0") {                                
            $ErrorCount++;
            $ErrCommunity = "Please select Community";
        }  
        if ($_POST['Nationality']=="0") {                                
            $ErrorCount++;
            $ErrNationality = "Please select Nationality";
        }  
          
        if ($ErrorCount==0) {
        
            $ProfileID = $mysql->insert("_tbl_Profile_Draft",array("ProfileFor"    => $_POST['ProfileFor'],
                                                                   "ProfileName"   => $_POST['ProfileName'],
                                                                   "DateofBirth"   => $_POST['DateofBirth'],        
                                                                   "Sex"           => $_POST['Sex'],      
                                                                   "MaritalStatus" => $_POST['MaritalStatus'],      
                                                                   "MotherTongue"  => $_POST['Language'], 
                                                                   "Religion"      => $_POST['Religion'],
                                                                   "Caste"         => $_POST['Caste'],
                                                                   "Community"     => $_POST['Community'],        
                                                                   "CreatedOn"     => date("Y-m-d H:i:s"),        
                                                                   "CreatedBy"     => $_Member['MemberID'],        
                                                                   "Nationality"   => $_POST['Nationality']));
            if ($ProfileID>0) {
                echo "Successfully Added";
                unset($_POST);
                echo "<script>location.href='Edit/".$ProfileID.".htm?msg=1';</script>";
            } else {
                echo "Error occured. Couldn't save Franchise Details";
            }
        }
    } */
?>
<?php                   
  if (isset($_POST['BtnSaveProfile'])) {   
    $response = $webservice->CreateProfile($_POST);
    if ($response['status']=="success") {
        echo "<script>location.href='Edit/".$ProfileID.".htm?msg=1';</script>";
        ?>
        <?php
    } else {
        $errormessage = $response['message']; 
    }
    }
?>  
<?php 
     $fInfo = $webservice->GetCodeMasterDatas(); 
     
?>
<form method="post" action="" onsubmit="">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Information</h4>  
                <div class="form-group row">
                    <label for="Community" class="col-sm-2 col-form-label">Profile For<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="ProfileFor" name="ProfileFor">
                            <option value="0">Choose Profile Sign In</option>
                            <?php foreach($fInfo['data']['ProfileFor'] as $ProfileFor) { ?>
                            <option value="<?php echo $ProfileFor['SoftCode'];?>" <?php echo ($_POST['ProfileFor']==$ProfileFor['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $ProfileFor['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrProfileFor"><?php echo isset($ErrProfileFor)? $ErrProfileFor : "";?></span>
                    </div>
                    </div>
                <div class="form-group row">
                    <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="ProfileName" name="ProfileName"  value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : "");?>" placeholder="Name">
                    <span class="errorstring" id="ErrProfileName"><?php echo isset($ErrProfileName)? $ErrProfileName : "";?></span></div>
                </div>
                <div class="form-group row">
                     <label for="Date of birth" class="col-sm-2 col-form-label">Date of birth<span id="star">*</span></label>
                     <div class="col-sm-3">
                          <input type="date" class="form-control" id="DateofBirth" name="DateofBirth"  value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>" style="line-height:15px !important" placeholder="Date of Birth">
                          <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?></span></div>
                     <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Sex"  name="Sex">
                            <option value="0">Choose Sex</option>
                            <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                            <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                       <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                     </div>
                </div>
                <div class="form-group row">
                     <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus"  name="MaritalStatus">
                            <option value="0">Choose Marital Status</option>
                            <?php foreach($fInfo['data']['MaritalStatus'] as $MaritalStatus) { ?>
                            <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>
                     </div>
                     <label for="Caste" class="col-sm-2 col-form-label">Mother Tongue<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Language"  name="Language">
                            <option value="0">Choose Mother Tongue</option>
                            <?php foreach($fInfo['data']['Language'] as $Language) { ?>
                            <option value="<?php echo $Language['SoftCode'];?>" <?php echo ($_POST['Language']==$Language['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Language['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrLanguage"><?php echo isset($ErrLanguage)? $ErrLanguage : "";?></span>
                     </div>
                </div>
                <div class="form-group row">
                     <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Religion"  name="Religion">
                            <option value="0">Choose Religion</option>
                            <?php foreach($fInfo['data']['Religion'] as $Religion) { ?>
                            <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>
                     </div>
                     <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Caste"  name="Caste">
                            <option value="0">Choose Caste</option>
                            <?php foreach($fInfo['data']['Caste'] as $Caste) { ?>
                            <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>
                     </div>
                </div>
                <div class="form-group row">
                    <label for="Community" class="col-sm-2 col-form-label">Community<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Community"  name="Community"> 
                            <option value="0">Choose Community</option>
                            <?php foreach($fInfo['data']['Community'] as $Community) { ?>
                            <option value="<?php echo $Community['SoftCode'];?>" <?php echo ($_POST['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Community['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrCommunity"><?php echo isset($ErrCommunity)? $ErrCommunity : "";?></span>
                    </div>
                    <label for="Nationality" class="col-sm-2 col-form-label">Nationality<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Nationality"  name="Nationality"> 
                            <option value="0">Choose Nationality</option>
                            <?php foreach($fInfo['data']['Nationality'] as $Nationality) { ?>
                            <option value="<?php echo $Nationality['SoftCode'];?>" <?php echo ($_POST['Nationality']==$Nationality['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Nationality['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        <span class="errorstring" id="ErrNationality"><?php echo isset($ErrNationality)? $ErrNationality : "";?></span>
                    </div>
                </div>  
                <div class="form-group row">
                    <div class="col-sm-12"><?php echo $errormessage;?> <?php echo $successmessage;?></div>
                </div>
                   <div class="form-group row">
                    <div class="col-sm-3">
                    <button type="submit" name="BtnSaveProfile" class="btn btn-primary" style="font-family:roboto">Save as draft</button></div>
                </div>
            </div>
        </div>
    </div>
</form>




