<?php
    $response = $webservice->GetMyDraftProfiles(); 
    if (sizeof($response['data'])==0) {
?>
<?php                   
  if (isset($_POST['BtnSaveProfile'])) {   
    $response = $webservice->CreateProfile($_POST);
    if ($response['status']=="success") {
        echo "<script>location.href='Draft/Edit/GeneralInformation/".$response['data']['Code'].".htm?msg=1';</script>";
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
<script>

function submitprofile() {
                         $('#ErrProfileFor').html("");
                         $('#ErrProfileName').html("");
                         $('#ErrMaritalStatus').html("");
                         $('#ErrLanguage').html("");
                         $('#ErrReligion').html("");
                         $('#ErrCaste').html("");
                         $('#ErrCommunity').html("");
                         $('#ErrNationality').html("");
                         
                         ErrorCount=0;
                         
                         if($("#ProfileFor").val()=="0"){
                            document.getElementById("ErrProfileFor").innerHTML="Please select profile for"; 
                         }
                         
                         if (IsNonEmpty("ProfileName","ErrProfileName","Please enter your profile name")) {
                            IsAlphabet("ProfileName","ErrProfileName","Please enter alpha numeric characters only");
                         }
                         
                         
                         if($("#Sex").val()=="0"){
                            document.getElementById("ErrSex").innerHTML="Please select sex"; 
                         }
                         
                         if($("#MaritalStatus").val()=="0"){
                            document.getElementById("ErrMaritalStatus").innerHTML="Please select marital status"; 
                         }
                         
                         
                         if($("#Language").val()=="0"){
                            document.getElementById("ErrLanguage").innerHTML="Please select your maother tongue"; 
                         }
                         
                         if($("#Religion").val()=="0"){
                            document.getElementById("ErrReligion").innerHTML="Please select your religion";
                         }
                         
                         if($("#Caste").val()=="0"){
                            document.getElementById("ErrCaste").innerHTML="Please select your caste";
                         }
                                                                                                                             
                         if($("#Community").val()=="0"){
                            document.getElementById("ErrCommunity").innerHTML="Please select your community"; 
                         }
                         
                         if($("#Community").val()=="0"){
                            document.getElementById("ErrCommunity").innerHTML="Please select your community";
                         }
                         
                         if($("#Nationality").val()=="0"){
                            document.getElementById("ErrNationality").innerHTML="Please select your nationality"; 
                         }
                         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                        
    
    
}




</script>
 
<form method="post" action="" name="form" onsubmit="return submitprofile();">
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
                     <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                                <?php $dob=strtotime($ProfileInfo['DateofBirth'])  ; ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>>
                                            <?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-2">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                     </div>
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
                     <div class="col-sm-4">
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
                     <div class="col-sm-4">
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
                    <div class="col-sm-4">
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
                    <button type="submit" name="BtnSaveProfile" class="btn btn-primary" style="font-family:roboto">Save &amp; Continue</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php } if (sizeof($response['data'])>0){ ?>

 <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Information</h4>  
                      <p class="card-description">
                       Profile Already Created
                      </p>
                      <div class="form-group row">
                            <div class="col-sm-6" style="text-align:center"><a href="ManageProfile">Manage Profile</a> </div>
                      </div>
              </div>
        </div>
 </div>
<?php }?> 




