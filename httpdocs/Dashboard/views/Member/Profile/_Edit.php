<?php  
    $ProfileInfo = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy='".$_Member['MemberID']."' and ProfileID='".$_GET['Code']."'");
    if (sizeof($ProfileInfo)==0) {
        echo "Error: Access denied. Please contact administrator";
    } else { 
        
    if (isset($_POST['BtnPostProfile'])) {
        
      $ErrorCount =0;
              print_r($_POST);
      if ($_POST['Country']=="0") {
            $ErrorCount++;
            $ErrCountry = "Please select Country ";
        }
      if ($_POST['StateName']=="0") {
            $ErrorCount++;
            $ErrStateName = "Please select State";
        }
      if ($_POST['City']=="") {
            $ErrorCount++;
            $ErrCity = "Please Enter City ";
        }
      if ($_POST['OtherLocation']=="") {
            $ErrorCount++;
            $ErrOtherLocation = "Please Enter Landmark";
        }
      if ($_POST['Aadhaar']=="") {
            $ErrorCount++;
            $ErrAadhaar = "Please Enter Aadhaar Number";
        }
      if ($_POST['Occupation']=="0") {
            $ErrorCount++;
            $ErrOccupation = "Please select Occupation";
        }
      if ($_POST['TypeofOccupation']=="0") {
            $ErrorCount++;
            $ErrTypeofOccupation = "Please select Type of Occupation";
        }
      
    }    
   if (isset($_POST['BtnSaveProfile'])) {
        $mysql->execute("update _tbl_Profile_Draft set ProfileFor='".$_POST['ProfileFor']."',
                                                       ProfileName='".$_POST['ProfileName']."',
                                                       DateofBirth='".$_POST['DateofBirth']."',
                                                       Sex='".$_POST['Sex']."',
                                                       MaritalStatus='".$_POST['MaritalStatus']."',
                                                       MotherTongue='".$_POST['Language']."',
                                                       Religion='".$_POST['Religion']."',
                                                       Caste='".$_POST['Caste']."',
                                                       Country='".$_POST['Country']."',
                                                       State='".$_POST['StateName']."',
                                                       City='".$_POST['City']."',
                                                       OtherLocation='".$_POST['OtherLocation']."',
                                                       Community='".$_POST['Community']."',
                                                       Nationality='".$_POST['Nationality']."',
                                                       AadhaarNo='".$_POST['Aadhaar']."',
                                                       Education='".$_POST['EducationDegree']."',
                                                       EmployedAs='".$_POST['EmployedAs']."',
                                                       OccupationType='".$_POST['OccupationType']."',
                                                       FathersName='".$_POST['FatherName']."',
                                                       FathersOccupation='".$_POST['FathersOccupation']."',
                                                       MothersName='".$_POST['MotherName']."',
                                                       MothersOccupation='".$_POST['MothersOccupation']."',
                                                       NumberofBrothers='".$_POST['NumberofBrothers']."',
                                                       Elder='".$_POST['elder']."',
                                                       Younger='".$_POST['younger']."',
                                                       Married='".$_POST['married']."',
                                                       Unmarried='".$_POST['unmarried']."',
                                                       NumberofSisters='".$_POST['NumberofSisters']."',
                                                       ElderSister='".$_POST['elderSister']."',
                                                       YoungerSister='".$_POST['youngerSister']."',
                                                       MarriedSister='".$_POST['marriedSister']."',
                                                       UnmarriedSister='".$_POST['unmarriedSister']."',
                                                       PhysicallyImpaired='".$_POST['PhysicallyImpaired']."',
                                                       VisuallyImpaired='".$_POST['VisuallyImpaired']."',
                                                       VissionImpaired='".$_POST['VissionImpaired']."',
                                                       SpeechImpaired='".$_POST['SpeechImpaired']."',
                                                       Height='".$_POST['Height']."',
                                                       Weight='".$_POST['Weight']."',
                                                       BloodGroup='".$_POST['BloodGroup']."',
                                                       Complexation='".$_POST['Complexation']."',
                                                       BodyType='".$_POST['BodyType']."',
                                                       Diet='".$_POST['Diet']."',
                                                       SmokingHabit='".$_POST['SmookingHabit']."',
                                                       DrinkingHabit='".$_POST['DrinkingHabit']."',
                                                       EmailID='".$_POST['EmailID']."',
                                                       MobileNumber='".$_POST['MobileNumber']."',
                                                       WhatsappNumber='".$_POST['WhatsappNumber']."'
                                                        where  CreatedBy='".$_Member['MemberID']."' and ProfileID='".$_GET['Code']."'");
        
        
        
    
    }
?>
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Profile Information</h4>  
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label"><small>Profile For<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <select  class="form-control selectpicker" id="ProfileFor"  name="ProfileFor">
                                <option>Choose Profile Sign In</option>
                                <?php $ProfileFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN'"); ?> 
                                <?php foreach($ProfileFors as $ProfileFor) { ?>
                                <option value="<?php echo $ProfileFor['SoftCode'];?>" <?php echo ($ProfileInfo[0]['ProfileFor']==$ProfileFor['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $ProfileFor['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Name" class="col-sm-3 col-form-label"><small>Name<span id="star">*</span></small></label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="ProfileName" name="ProfileName" value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : $ProfileInfo[0]['ProfileName']);?>" placeholder="Name"></div>
                    </div>
                    <div class="form-group row">
                         <label for="Date of birth" class="col-sm-3 col-form-label"><small>Date of birth<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth"  value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : $ProfileInfo[0]['DateofBirth']);?>" placeholder="Date of Birth"><span class="glyphicon glyphicon-calendar"></span>
                         </div>
                         <label for="Sex" class="col-sm-3 col-form-label"><small>Sex<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="Sex"  name="Sex">
                                <option>Choose Sex</option>
                                <?php $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'"); ?> 
                                <?php foreach($Sexs as $Sex) { ?>
                                <option value="<?php echo $Sex['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Sex['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="MaritalStatus" class="col-sm-3 col-form-label"><small>Marital Status<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="MaritalStatus"  name="MaritalStatus">
                                  <option>Choose Marital Status</option>
                                  <?php $MaritalStatuss = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS'"); ?>
                                  <?php foreach($MaritalStatuss as $MaritalStatus) { ?>
                                  <option value="<?php echo $MaritalStatus['SoftCode'];?>"<?php echo ($ProfileInfo[0]['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>><?php echo $MaritalStatus['CodeValue'];?></option>
                                  <?php } ?>
                            </select>
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label"><small>Mother Tongue<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="Language"  name="Language">
                                <option>Choose Mother Tongue</option>
                                <?php $Languages = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES'"); ?>
                                <?php foreach($Languages as $Language) { ?>
                                <option value="<?php echo $Language['SoftCode'];?>"<?php echo ($ProfileInfo[0]['MotherTongue']==$Language['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Language['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Religion" class="col-sm-3 col-form-label"><small>Religion<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="Religion"  name="Religion">
                                <option>Choose Religion</option>
                                <?php $Religions = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES'"); ?>
                                <?php foreach($Religions as $Religion) { ?>
                                <option value="<?php echo $Religion['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Religion['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label"><small>Caste<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="Caste"  name="Caste">
                                <option value="0">Choose Caste</option>
                                <?php $Castes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES'"); ?>
                                <?php foreach($Castes as $Caste) { ?>
                                <option value="<?php echo $Caste['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Caste['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Country" class="col-sm-3 col-form-label"><small>Country<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="Country"  name="Country">
                                <option value="0">Choose Country</option>
                                <?php $Countries = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES'"); ?>
                                <?php foreach($Countries as $Country) { ?>
                                <?php if (isset($_POST['Country'])) { ?>
                                <option value="<?php echo $Country['SoftCode'];?>"<?php echo ($_POST['Country']==$Country['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Country['CodeValue'];?></option>
                                <?php } else {?>
                                <option value="<?php echo $Country['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Country']==$Country['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Country['CodeValue'];?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrCountry"><?php echo isset($ErrCountry)? $ErrCountry : "";?></span>
                         </div>
                         <label for="State" class="col-sm-3 col-form-label"><small>State<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="StateName"  name="StateName">
                                <option value="0">Choose State</option>
                                <?php $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'"); ?>
                                <?php foreach($StateNames as $StateName) { ?>
                                <option value="<?php echo $StateName['SoftCode'];?>"><?php echo $StateName['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="City" class="col-sm-3 col-form-label"><small>City<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <input type="text" class="form-control" id="City" name="City" Placeholder="City" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : "");?>">
                            <span class="errorstring" id="ErrCity"><?php echo isset($ErrCity)? $ErrCity : "";?></span></div>
                         <label for="OtherLocation" class="col-sm-3 col-form-label"><small>Landmark</small></label>
                         <div class="col-sm-3">
                            <input type="text" class="form-control" id="OtherLocation" name="OtherLocation" Placeholder="Other Location" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : "");?>">
                            <span class="errorstring" id="ErrOtherLocation"><?php echo isset($ErrOtherLocation)? $ErrOtherLocation : "";?></span></div>
                    </div>
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label"><small>Community<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <select class="form-control" id="Community"  name="Community">
                                <option>Choose Community</option>
                                <?php $Communitys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY'"); ?>
                                <?php foreach($Communitys as $Community) { ?>
                                <option value="<?php echo $Community['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Community['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="Nationality" class="col-sm-3 col-form-label"><small>Nationality<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <select class="form-control" id="Nationality"  name="Nationality">
                                <option>Choose Nationality</option>
                                <?php $Nationalitys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES'"); ?>
                                <?php foreach($Nationalitys as $Nationality) { ?>
                                <option value="<?php echo $Nationality['SoftCode'];?>"<?php echo ($ProfileInfo[0]['Nationality']==$Nationality['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Nationality['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="Aadhaar" class="col-sm-3 col-form-label"><small>Adhaar No<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="Aadhaar" name="Aadhaar" Placeholder="Aadhaar Number" value="<?php echo (isset($_POST['Aadhaar']) ? $_POST['Aadhaar'] : "");?>">
                            <span class="errorstring" id="ErrAadhaar"><?php echo isset($ErrAadhaar)? $ErrAadhaar : "";?></span></div>
                        <div class="col-sm-3" align="left"><input type="checkbox" value="" ><small>      is handicapped?</small></div>
                        <div class="col-sm-3" align="right"><input type="text" class="form-control" id="Handicapped" name="Handicapped" value="<?php echo (isset($_POST['Handicapped']) ? $_POST['Handicapped'] : "");?>"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">         
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2"><i class="fa fa-plus"></i>Save as draft</button></div>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo PrintDateTime($ProfileInfo[0]['SaveTime']);?></small></div>
                    </div>
                  </div>
                </div>
              </div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Education Details</h4><br>             
                <div class="form-group row">
                    <label for="EducationTitle" class="col-sm-3 col-form-label"><small>Education Degree<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="EducationTitle"  name="EducationTitle">
                            <option>Choose EducatioTitle</option>
                            <?php $EducationTitles = $mysql->select("select * from _tbl_master_codemaster Where HardCode='EDUCATETITLES'"); ?>
                            <?php foreach($EducationTitles as $EducationTitle) { ?>
                            <option value="<?php echo $EducationTitle['SoftCode'];?>"><?php echo $EducationTitle['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                <label for="EducationDegree" class="col-sm-3 col-form-label"><small>Education Quallification<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="EducationDegree"  name="EducationDegree">
                            <option>--Choose Education Ouallification--</option>
                            <?php $Educations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='EDUCATIONDEGREES'"); ?>
                            <?php foreach($Educations as $Education) { ?>
                            <option value="<?php echo $Education['SoftCode'];?>"><?php echo $Education['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                         <label for="Employed As" class="col-sm-3 col-form-label"><small>Employed As<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="EmployedAs"  name="EmployedAs">
                                <option>--Choose Employed As--</option>
                                <?php $EmployedAss = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONS'"); ?>
                                <?php foreach($EmployedAss as $EmployedAs) { ?>
                                <option value="<?php echo $EmployedAs['SoftCode'];?>"><?php echo $EmployedAs['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="OccupationType" class="col-sm-3 col-form-label"><small>Occupation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="OccupationType"  name="OccupationType">
                                <option>--Choose Occupatin Tyes--</option>
                                <?php $OccupationTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES'"); ?>
                                <?php foreach($OccupationTypes as $OccupationType) { ?>
                                <option value="<?php echo $OccupationType['SoftCode'];?>"><?php echo $OccupationType['CodeValue'];?></option>
                            <?php } ?>
                         </select>
                         </div>
                 </div>
                 <div class="form-group row">
                    <label for="TypeofOccupation" class="col-sm-3 col-form-label"><small>Type of Occupation<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="TypeofOccupation"  name="TypeofOccupation">
                            <option>Choose Type of Occupation</option>
                            <?php $TypeofOccupations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TYPEOFOCCUPATIONS'"); ?>
                            <?php foreach($TypeofOccupations as $TypeofOccupation) { ?>
                            <option value="<?php echo $TypeofOccupation['SoftCode'];?>"><?php echo $TypeofOccupation['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                 </div>
                         <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
           </div>
     </div>
 </div>
 <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Occupation</h4><br>             
                <div class="form-group row">
                         <label for="Employed As" class="col-sm-3 col-form-label"><small>Employed As<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="EmployedAs"  name="EmployedAs">
                                <option>--Choose Employed As--</option>
                                <?php $EmployedAss = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONS'"); ?>
                                <?php foreach($EmployedAss as $EmployedAs) { ?>
                                <option value="<?php echo $EmployedAs['SoftCode'];?>"><?php echo $EmployedAs['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="OccupationType" class="col-sm-3 col-form-label"><small>Occupation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <select class="form-control" id="OccupationType"  name="OccupationType">
                                <option>--Choose Occupatin Tyes--</option>
                                <?php $OccupationTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES'"); ?>
                                <?php foreach($OccupationTypes as $OccupationType) { ?>
                                <option value="<?php echo $OccupationType['SoftCode'];?>"><?php echo $OccupationType['CodeValue'];?></option>
                            <?php } ?>
                         </select>
                         </div>
                 </div>
                 <div class="form-group row">
                    <label for="TypeofOccupation" class="col-sm-3 col-form-label"><small>Type of Occupation<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="TypeofOccupation"  name="TypeofOccupation">
                            <option>Choose Type of Occupation</option>
                            <?php $TypeofOccupations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TYPEOFOCCUPATIONS'"); ?>
                            <?php foreach($TypeofOccupations as $TypeofOccupation) { ?>
                            <option value="<?php echo $TypeofOccupation['SoftCode'];?>"><?php echo $TypeofOccupation['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                 </div>
                         <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
           </div>
     </div>
 </div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Family Information</h4><br>
                <div class="form-group row">
                        <label for="FatherName" class="col-sm-2 col-form-label"><small>Fathers Name<span id="star">*</span></small></label>
                        <div class="col-sm-4"><input type="text" class="form-control" id="FatherName" name="FatherName" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : "");?>" placeholder="Name"></div>
                        <label for="FathersOccupation" class="col-sm-3 col-form-label"><small>Fathers Occupation<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                        <select  class="form-control selectpicker" id="FathersOccupation"  name="FathersOccupation">
                        <option>Choose Father Occupation</option>
                        <?php $FathersOccupations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES'"); ?> 
                        <?php foreach($FathersOccupations as $FathersOccupation) { ?>
                        <option value="<?php echo $FathersOccupation['SoftCode'];?>"><?php echo $FathersOccupation['CodeValue'];?></option>
                        <?php } ?>
                        </select>
                        </div>
                </div>
                <div class="form-group row">
                         <label for="MotherName" class="col-sm-2 col-form-label"><small>Mothers Name<span id="star">*</span></small></label>
                         <div class="col-sm-4">
                         <input type="text" class="form-control" id="MotherName" name="MotherName" Placeholder="Mother Name"   value="<?php echo (isset($_POST['MotherName']) ? $_POST['MotherName'] : "");?>">
                         </div>
                         <label for="MothersOccupation" class="col-sm-3 col-form-label"><small>Mothers Occupation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="MothersOccupation"  name="MothersOccupation">
                         <option>--Choose Mother Occupation--</option>
                         <?php $MothersOccupations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES'"); ?>
                         <?php foreach($MothersOccupations as $MothersOccupation) { ?>
                         <option value="<?php echo $MothersOccupation['SoftCode'];?>"><?php echo $MothersOccupation['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                        <label for="No of Brothers" class="col-sm-2 col-form-label">No of Brothers<span id="star">*</span></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="NumberofBrothers" name="NumberofBrothers" value="<?php echo (isset($_POST['NumberofBrothers']) ? $_POST['NumberofBrothers'] : "");?>" ></div>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="elder" name="elder" value="<?php echo (isset($_POST['elder']) ? $_POST['elder'] : "");?>" ></div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>elder</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="younger" name="younger" value="<?php echo (isset($_POST['younger']) ? $_POST['younger'] : "");?>"> </div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>younger</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="married" name="married" value="<?php echo (isset($_POST['married']) ? $_POST['married'] : "");?>"></div> 
                        <label for="elder" class="col-sm-1 col-form-label"><small>married</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="unmarried" name="unmarried" value="<?php echo (isset($_POST['unmarried']) ? $_POST['unmarried'] : "");?>"> </div>
                        <label for="elder" class="col-sm-2 col-form-label"><small>unmarried</small></label> 
                </div>
                <div class="form-group row">
                        <label for="No of Sisters" class="col-sm-2 col-form-label">No of Sisters<span id="star">*</span></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="NumberofSisters" name="NumberofSisters" value="<?php echo (isset($_POST['NumberofSisters']) ? $_POST['NumberofSisters'] : "");?>" ></div>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="elderSister" name="elderSister" value="<?php echo (isset($_POST['elderSister']) ? $_POST['elderSister'] : "");?>"></div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>elder</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="youngerSister" name="youngerSister" value="<?php echo (isset($_POST['youngerSister']) ? $_POST['youngerSister'] : "");?>"> </div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>younger</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="marriedSister" name="marriedSister" value="<?php echo (isset($_POST['marriedSister']) ? $_POST['marriedSister'] : "");?>"></div> 
                        <label for="elder" class="col-sm-1 col-form-label"><small>married</small></label>
                        <div class="col-sm-1" align="left"><input type="text" class="form-control" id="unmarriedSister" name="unmarriedSister" value="<?php echo (isset($_POST['unmarriedSister']) ? $_POST['unmarriedSister'] : "");?>"> </div>
                        <label for="elder" class="col-sm-2 col-form-label"><small>unmarried</small></label> 
                </div>
                <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
                </div>
              </div>
 </div>
 <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Physical Information</h4><br>
                <div class="form-group row">
                         <label for="PhysicallyImpaired" class="col-sm-3 col-form-label"><small>Physically Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="PhysicallyImpaired"  name="PhysicallyImpaired">
                         <option>--Choose Physically Impaired --</option>
                         <?php $PhysicallyImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PHYSICALLYIMPAIRED'"); ?>
                         <?php foreach($PhysicallyImpaireds as $PhysicallyImpaired) { ?>
                         <option value="<?php echo $PhysicallyImpaired['SoftCode'];?>"><?php echo $PhysicallyImpaired['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="VisuallyImpaired" class="col-sm-3 col-form-label"><small>Visually Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="VisuallyImpaired"  name="VisuallyImpaired">
                         <option>--Choose Visually Impaired --</option>
                         <?php $VisuallyImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISUALLYIMPAIRED'"); ?>
                         <?php foreach($VisuallyImpaireds as $VisuallyImpaired) { ?>
                         <option value="<?php echo $VisuallyImpaired['SoftCode'];?>"><?php echo $VisuallyImpaired['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="VissionImpaired" class="col-sm-3 col-form-label"><small>Vission Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="VissionImpaired"  name="VissionImpaired">
                         <option>--Choose Vission Impaired --</option>
                         <?php $VissionImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISSIONIMPAIRED'"); ?>
                         <?php foreach($VissionImpaireds as $VissionImpaired) { ?>
                         <option value="<?php echo $VissionImpaired['SoftCode'];?>"><?php echo $VissionImpaired['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="SpeechImpaired" class="col-sm-3 col-form-label"><small>Speech Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="SpeechImpaired"  name="SpeechImpaired">
                         <option>--Choose Speech Impaired --</option>
                         <?php $SpeechImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SPEECHIMPAIRED'"); ?>
                         <?php foreach($SpeechImpaireds as $SpeechImpaired) { ?>
                         <option value="<?php echo $SpeechImpaired['SoftCode'];?>"><?php echo $SpeechImpaired['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="Height" class="col-sm-3 col-form-label"><small>Height<span id="star">*</span>  &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="Height"  name="Height">
                         <option>--Choose Height --</option>
                         <?php $Heights = $mysql->select("select * from _tbl_master_codemaster Where HardCode='HEIGHTS'"); ?>
                         <?php foreach($Heights as $Height) { ?>
                         <option value="<?php echo $Height['SoftCode'];?>"><?php echo $Height['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="Weight" class="col-sm-3 col-form-label"><small>Weight<span id="star">*</span>   &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="Weight"  name="Weight">
                         <option>--Choose Weight --</option>
                         <?php $Weights = $mysql->select("select * from _tbl_master_codemaster Where HardCode='WEIGHTs'"); ?>
                         <?php foreach($Weights as $Weight) { ?>
                         <option value="<?php echo $Weight['SoftCode'];?>"><?php echo $Weight['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BloodGroup" class="col-sm-3 col-form-label"><small>Blood Group<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="BloodGroup"  name="BloodGroup">
                         <option>--Choose Blood Group--</option>
                         <?php $BloodGroups = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BLOODGROUPS'"); ?>
                         <?php foreach($BloodGroups as $BloodGroup) { ?>
                         <option value="<?php echo $BloodGroup['SoftCode'];?>"><?php echo $BloodGroup['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="Complexation" class="col-sm-3 col-form-label"><small>Complexation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="Complexation"  name="Complexation">
                         <option>--Choose Complexation--</option>
                         <?php $Complexations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMPLEXIONS'"); ?>
                         <?php foreach($Complexations as $Complexation) { ?>
                         <option value="<?php echo $Complexation['SoftCode'];?>"><?php echo $Complexation['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BodyType" class="col-sm-3 col-form-label"><small>Body Type<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="BodyType"  name="BodyType">
                         <?php $BodyTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BODYTYPES'"); ?>
                         <option>--Choose Body Type--</option>
                         <?php foreach($BodyTypes as $BodyType) { ?>
                         <option value="<?php echo $BodyType['SoftCode'];?>"><?php echo $BodyType['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="Diet" class="col-sm-3 col-form-label"><small>Diet<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="Diet"  name="Diet">
                         <option>--Choose Body Type--</option>
                         <?php $Diets = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DIETS'"); ?>
                         <?php foreach($Diets as $Diet) { ?>
                         <option value="<?php echo $Diet['SoftCode'];?>"><?php echo $Diet['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="SmookingHabit" class="col-sm-3 col-form-label"><small>Smooking Habit<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="SmookingHabit"  name="SmookingHabit">
                         <option>--Choose Smiking Habits--</option>
                         <?php $SmookingHabits = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMOKINGHABITS'"); ?>
                         <?php foreach($SmookingHabits as $SmookingHabit) { ?>
                         <option value="<?php echo $SmookingHabit['SoftCode'];?>"><?php echo $SmookingHabit['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                         <label for="DrinkingHabit" class="col-sm-3 col-form-label"><small>Drinking Habit<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="DrinkingHabit"  name="DrinkingHabit">
                         <option>--Choose Drinking Habits--</option>
                         <?php $DrinkingHabits = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DRINKINGHABITS'"); ?>
                         <?php foreach($DrinkingHabits as $DrinkingHabit) { ?>
                         <option value="<?php echo $DrinkingHabit['SoftCode'];?>"><?php echo $DrinkingHabit['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
              <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
              </div>
            </div> 
       </div>

<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Attachments</h4><br>
                <div class="form-group row">
                         <label for="Documents" class="col-sm-3 col-form-label"><small>Document Type<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <select class="form-control" id="Documents"  name="Documents">
                         <option>Choose Documents</option>
                         <?php $Documents = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DOCTYPES'"); ?>
                         <?php foreach($Documents as $Document) { ?>
                         <option value="<?php echo $Document['SoftCode'];?>"><?php echo $Document['CodeValue'];?></option>
                         <?php } ?>
                         </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="Attachment" class="col-sm-3 col-form-label"><small>Attachment<span id="star">*</span></small></label>
                         <div class="col-sm-3"><input type="File" class="form-control" id="File" name="File" Placeholder="File"></div>
                </div>
                <div class="form-group row">
                         <div class="col-sm-3"><button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save </button></div>
                </div>
                <hr>
                <div class="form-group row">
                         <label for="Certificate" class="col-sm-3 col-form-label"><small>Education Certificate<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                         <input type="File" class="form-control" id="File" name="File" Placeholder="File">
                         </div>
                </div>
                <div class="form-group row">
                         <div class="col-sm-3"><button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save </button></div>
                </div>
                         <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
           </div>
     </div>
 </div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Contact Details</h4><br>
                <div class="form-group row">
                    <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label"> 
                    <input type="checkbox" class="form-check-input" checked> Member Contact
                    </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email ID" class="col-sm-3 col-form-label"><small>Email ID<span id="star">*</span></small></label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php // echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>" placeholder="Email ID"></div>
                </div>
                <div class="form-group row">
                    <label for="Mobile Number" class="col-sm-3 col-form-label"><small>Mobile Number<span id="star">*</span></small></label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php // echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" placeholder="Email ID"></div>
                </div>
                <div class="form-group row">
                    <label for="WhatsappNumber" class="col-sm-3 col-form-label"><small>Whatsapp Number</small></label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php //echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>" placeholder="Whatsapp Number"></div>
                </div>
                <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button></div>
                        <?php $Times = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <div class="col-sm-3" align="left"><small> Last Save time:</small></div>
                        <div class="col-sm-3" align="left"><small> <?php echo $Times['SaveTime'];?></small></div>
                    </div>
                </div>
              </div>
</div>
<?php } ?>                