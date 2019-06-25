<?php  
   /* $ProfileInfo = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy='".$_Member['MemberID']."' and ProfileID='".$_GET['Code']."'");
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
       
       $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
       
        $mysql->execute("update _tbl_Profile_Draft set ProfileFor='".$_POST['ProfileFor']."',
                                                       ProfileName='".$_POST['ProfileName']."',
                                                       DateofBirth='".$dob."',
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
                                                       TypeofOccupation='".$_POST['TypeofOccupation']."',
                                                       AnnualIncome='".$_POST['IncomeRange']."',
                                                       FathersName='".$_POST['FatherName']."',
                                                       FathersOccupation='".$_POST['FathersOccupation']."',
                                                       MothersName='".$_POST['MotherName']."',
                                                       MothersOccupation='".$_POST['MothersOccupation']."',
                                                       NumberofBrothers='".$_POST['NumberofBrother']."',
                                                       Younger='".$_POST['younger']."',
                                                       Elder='".$_POST['elder']."',
                                                       Married='".$_POST['married']."',
                                                       NumberofSisters='".$_POST['NumberofSisters']."',
                                                       ElderSister='".$_POST['elderSister']."',
                                                       YoungerSister='".$_POST['youngerSister']."',
                                                       MarriedSister='".$_POST['marriedSister']."',
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
                                                       WhatsappNumber='".$_POST['WhatsappNumber']."',
                                                       AddressLine1='".$_POST['AddressLine1']."',
                                                       AddressLine2='".$_POST['AddressLine2']."',
                                                       AddressLine3='".$_POST['AddressLine3']."'
                                                        where  CreatedBy='".$_Member['MemberID']."' and ProfileID='".$_GET['Code']."'");
        
           
        
    
    }
     $ProfileInfo = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy='".$_Member['MemberID']."' and ProfileID='".$_GET['Code']."'");
   */
?>
<?php $response = $webservice->EditProfile();
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6">         
                            <h4 class="card-title">Profile Information</h4></div>
                        <div class="col-sm-3" align="right" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../Draft");?> <small>List of Profiles</small> </a></div>
                        <div class="col-sm-3" align="right" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../UploadMultiplefiles");?> <small>add</small> </a></div>
                        </div>
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label">Profile For<span id="star">*</span></label>
                        <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true"  id="ProfileFor"  name="ProfileFor">
                                <option>Choose Profile Sign In</option>
                               <?php foreach($response['data']['ProfileSignInFor'] as $ProfileFor) { ?>
                                <option value="<?php echo $ProfileFor['SoftCode'];?>" <?php echo ($ProfileInfo['ProfileFor']==$ProfileFor['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $ProfileFor['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Name" class="col-sm-3 col-form-label">Name<span id="star">*</span></label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="ProfileName" name="ProfileName" value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : $ProfileInfo['ProfileName']);?>" placeholder="Name"></div>
                    </div>
                    <div class="form-group row">
                         <label for="Name" class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                          <div class="col-sm-3">
                          <?php
                         
                          if (isset($_POST['DateofBirth'])) {
                            $dob=$_POST['DateofBirth']  ;
                          } else {
                              $dob=strtotime($ProfileInfo['DateofBirth'])  ;  
                               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
                          } 
      
                          ?>
                            <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" style="line-height:15px !important" value="<?php echo $dob;?>">
                             <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
                          </div>
                         <label for="Sex" class="col-sm-3 col-form-label">Sex<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Sex"  name="Sex">
                                <option>Choose Sex</option>
                                <?php foreach($response['data']['Gender'] as $Sex) { ?>
                                <option value="<?php echo $Sex['SoftCode'];?>"<?php echo ($ProfileInfo['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Sex['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="MaritalStatus" class="col-sm-3 col-form-label">Marital Status<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus"  name="MaritalStatus">
                                  <option>Choose Marital Status</option>
                                  <?php foreach($response['data']['MaritalStatus'] as $MaritalStatus) { ?>
                                  <option value="<?php echo $MaritalStatus['SoftCode'];?>"<?php echo ($ProfileInfo['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>><?php echo $MaritalStatus['CodeValue'];?></option>
                                  <?php } ?>
                            </select>
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label">Mother Tongue<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Language"  name="Language">
                                <option>Choose Mother Tongue</option>
                               <?php foreach($response['data']['Language'] as $Language) { ?>
                                <option value="<?php echo $Language['SoftCode'];?>"<?php echo ($ProfileInfo['MotherTongue']==$Language['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Language['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Religion" class="col-sm-3 col-form-label">Religion<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Religion"  name="Religion">
                                <option>Choose Religion</option>
                                <?php foreach($response['data']['Religion'] as $Religion) { ?>
                                <option value="<?php echo $Religion['SoftCode'];?>"<?php echo ($ProfileInfo['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Religion['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label">Caste<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Caste"  name="Caste">
                                <option value="0">Choose Caste</option>
                                <?php foreach($response['data']['Caste'] as $Caste) { ?>
                                <option value="<?php echo $Caste['SoftCode'];?>"<?php echo ($ProfileInfo['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Caste['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label">Community<span id="star">*</span></label>
                        <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Community"  name="Community">
                                <option>Choose Community</option>
                                <?php foreach($response['data']['Community'] as $Community) { ?>
                                <option value="<?php echo $Community['SoftCode'];?>"<?php echo ($ProfileInfo['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Community['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="Nationality" class="col-sm-3 col-form-label">Nationality<span id="star">*</span></label>
                        <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Nationality"  name="Nationality">
                                <option>Choose Nationality</option>
                                 <?php foreach($response['data']['Nationality'] as $Nationality) { ?>
                                <option value="<?php echo $Nationality['SoftCode'];?>" <?php echo ($ProfileInfo['Nationality']==$Nationality['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Nationality['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>  
                    <!-- <i class="fa fa-plus"></i> -->
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-3">         
                            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                        </div>
                    </div>
                    </div>
                </div>
              </div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Education Details</h4>             
                <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Document Type</th>
                          <th>Attach Menu File</th>
                          <th>Attached On</th>
                          <th>Viewed On</th>
                        </tr>    
                      </thead>
                      <tbody>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <div align="left">
                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#myModal">Attach</button></div>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <small>Attach Education Certificate</small>
                            </div>
                            <div class="modal-body">
                             <div class="form-group row">
                                <label for="Certificate" class="col-sm-3 col-form-label"><small>Education Certificate<span id="star">*</span></small></label>
                                <div class="col-sm-3">
                                <input type="File" class="form-control" id="File" name="File" Placeholder="File">
                                </div>
                             </div>
                             <div class="form-group row">
                                <div class="col-sm-3"><button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save </button></div>
                             </div>
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                            </div>
                            </div>
                    </div>
        </div>
</div>

 <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Occupation</h4>             
                <div class="form-group row">
                         <label for="Employed As" class="col-sm-3 col-form-label">Employed As<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs"  name="EmployedAs">
                                <option value="0">Choose Employed As</option>
                                <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                                <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo ($ProfileInfo['EmployedAs']==$EmployedAs['SoftCode']) ? " selected='selected' " : "";?>  ><?php echo $EmployedAs['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="OccupationType" class="col-sm-3 col-form-label">Occupation<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="OccupationType"  name="OccupationType">
                                <option value="0">Choose Occupatin Types</option>
                                <?php foreach($response['data']['Occupation'] as $OccupationType) { ?>
                                <option value="<?php echo $OccupationType['SoftCode'];?>" <?php echo ($ProfileInfo['OccupationType']==$OccupationType['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $OccupationType['CodeValue'];?></option>
                            <?php } ?>
                         </select>
                         </div>
                 </div>
                 <div class="form-group row">
                    <label for="TypeofOccupation" class="col-sm-3 col-form-label">Type of Occupation<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="TypeofOccupation"  name="TypeofOccupation">
                            <option value="0">Choose Type of Occupation</option>    
                            <?php foreach($response['data']['TypeofOccupation'] as $TypeofOccupation) { ?>
                            <option value="<?php echo $TypeofOccupation['SoftCode'];?>" <?php echo ($ProfileInfo['TypeofOccupation']==$TypeofOccupation['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $TypeofOccupation['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label for="IncomeRange" class="col-sm-3 col-form-label">Annual Income<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="IncomeRange"  name="IncomeRange">
                            <option value="0">Choose IncomeRange</option>  
                            <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                            <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo ($ProfileInfo['AnnualIncome']==$IncomeRange['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $IncomeRange['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                 </div>
                 <div class="form-group row" style="margin-bottom:0px;">
                 <div class="col-sm-3">         
                    <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                    <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                 </div>
                </div>
           </div>
     </div>
 </div>
<div class="col-12 grid-margin">
              <div class="card">                                                     
                <div class="card-body">
                <h4 class="card-title">Family Information</h4>
                <div class="form-group row">
                        <label for="FatherName" class="col-sm-2 col-form-label">Father's Name<span id="star">*</span></label>
                        <div class="col-sm-4"><input type="text" class="form-control" id="FatherName" name="FatherName" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : $ProfileInfo['FathersName']);?>" placeholder="Name"></div>
                        <label for="FathersOccupation" class="col-sm-3 col-form-label">Fathers Occupation<span id="star">*</span></label>
                        <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true"id="FathersOccupation"  name="FathersOccupation">
                                <option value="0">Choose Father Occupation</option>
                                <?php foreach($response['data']['Occupation'] as $FathersOccupation) { ?>
                                <option value="<?php echo $FathersOccupation['SoftCode'];?>" <?php echo ($ProfileInfo['FathersOccupation']==$FathersOccupation['SoftCode']) ? " selected='selected' " : "";?>><?php echo $FathersOccupation['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
                <div class="form-group row">
                         <label for="MotherName" class="col-sm-2 col-form-label">Mother's Name<span id="star">*</span></label>
                         <div class="col-sm-4">
                            <input type="text" class="form-control" id="MotherName" name="MotherName" Placeholder="Mother Name"   value="<?php echo (isset($_POST['MotherName']) ? $_POST['MotherName'] : $ProfileInfo['MothersName']);?>">
                         </div>
                         <label for="MothersOccupation" class="col-sm-3 col-form-label">Mothers Occupation<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="MothersOccupation"  name="MothersOccupation">
                                <option value="0">Choose Mother Occupation</option>
                                <?php foreach($response['data']['Occupation'] as $MothersOccupation) { ?>
                                <option value="<?php echo $MothersOccupation['SoftCode'];?>" <?php echo ($ProfileInfo['MothersOccupation']==$MothersOccupation['SoftCode']) ? " selected='selected' " : "";?>><?php echo $MothersOccupation['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                        <label for="No of Brothers" class="col-sm-2 col-form-label">No of Brothers<span id="star">*</span></label>
                        <div class="col-sm-1" align="left">         
                        <select class="selectpicker form-control" data-live-search="true" id="NumberofBrother"  name="NumberofBrother" size="width:60px">
                            <?php foreach($response['data']['NumberofBrother'] as $NumberofBrother) { ?>
                            <option value="<?php echo $NumberofBrother['SoftCode'];?>" <?php echo ($ProfileInfo['NumberofBrothers']==$NumberofBrother['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $NumberofBrother['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                        </div>
                         <label for="Elder" class="col-sm-1 col-form-label">Elder</label>
                         <div class="col-sm-1">
                            <select class="selectpicker form-control" data-live-search="true" id="elder"  name="elder" size="width:60px">
                                <?php foreach($response['data']['NumberofElderBrother'] as $elder) { ?>
                                <option value="<?php echo $elder['SoftCode'];?>" <?php echo ($ProfileInfo['Elder']==$elder['SoftCode']) ? " selected='selected' " : "";?>><?php echo $elder['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                        <label for="elder" class="col-sm-2 col-form-label">younger</label>
                        <div class="col-sm-1">
                            <select class="selectpicker form-control" data-live-search="true" id="younger"  name="younger" size="width:60px">
                                <?php foreach($response['data']['NumberofYoungerBrother'] as $younger) { ?>
                                <option value="<?php echo $younger['SoftCode'];?>" <?php echo ($ProfileInfo['Younger']==$younger['SoftCode']) ? " selected='selected' " : "";?>><?php echo $younger['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                        <label for="elder" class="col-sm-1 col-form-label">married</label>
                        <div class="col-sm-1">
                            <select class="selectpicker form-control" data-live-search="true" id="married"  name="married" size="width:60px">
                                <?php foreach($response['data']['NumberofMarriedBrother'] as $married) { ?>
                                <option value="<?php echo $married['SoftCode'];?>" <?php echo ($ProfileInfo['Married']==$younger['SoftCode']) ? " selected='selected' " : "";?>><?php echo $married['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div> 
                </div>
                <div class="form-group row">
                        <label for="No of Sisters" class="col-sm-2 col-form-label">No of Sisters<span id="star">*</span></label>
                        <div class="col-sm-1" align="left"> 
                            <select class="selectpicker form-control" data-live-search="true" id="NumberofSisters"  name="NumberofSisters" size="width:60px">
                                <?php foreach($response['data']['NumberofSisters'] as $NumberofSister) { ?>
                                <option value="<?php echo $NumberofSister['SoftCode'];?>" <?php echo ($ProfileInfo['NumberofSisters']==$NumberofSister['SoftCode']) ? " selected='selected' " : "";?>><?php echo $NumberofSister['CodeValue'];?></option>
                                <?php } ?>
                                </select>
                        </div>
                        <label for="elder" class="col-sm-1 col-form-label">elder</label>
                        <div class="col-sm-1" align="left">
                            <select class="selectpicker form-control" data-live-search="true" id="elderSister"  name="elderSister" size="width:60px">
                                <?php foreach($response['data']['NumberofElderSisters'] as $elderSister) { ?>
                                <option value="<?php echo $elderSister['SoftCode'];?>" <?php echo ($ProfileInfo['ElderSister']==$elderSister['SoftCode']) ? " selected='selected' " : "";?>><?php echo $elderSister['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="elder" class="col-sm-2 col-form-label">younger</label>
                        <div class="col-sm-1" align="left">
                            <select class="selectpicker form-control" data-live-search="true" id="youngerSister"  name="youngerSister" size="width:60px">
                                <?php foreach($response['data']['NumberofYoungerSisters'] as $youngerSister) { ?>
                                <option value="<?php echo $youngerSister['SoftCode'];?>" <?php echo ($ProfileInfo['YoungerSister']==$youngerSister['SoftCode']) ? " selected='selected' " : "";?>><?php echo $youngerSister['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="elder" class="col-sm-1 col-form-label">married</label>
                        <div class="col-sm-1" align="left">
                            <select class="selectpicker form-control" data-live-search="true" id="marriedSister"  name="marriedSister" size="width:60px">
                                <?php foreach($response['data']['NumberofMarriedSisters'] as $marriedSister) { ?>
                                <option value="<?php echo $marriedSister['SoftCode'];?>" <?php echo ($ProfileInfo['MarriedSister']==$marriedSister['SoftCode']) ? " selected='selected' " : "";?>><?php echo $marriedSister['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row" style="margin-bottom:0px;">
                <div class="col-sm-3">         
                    <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                    <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                </div>
              </div>
            </div>
       </div>
 </div>

 <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Physical Information</h4>
                <div class="form-group row">
                         <label for="PhysicallyImpaired" class="col-sm-3 col-form-label">Physically Impaired?<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="PhysicallyImpaired"  name="PhysicallyImpaired">
                                <option value="0">Choose Physically Impaired</option>
                                <?php foreach($response['data']['PhysicallyImpaired'] as $PhysicallyImpaired) { ?>
                                <option value="<?php echo $PhysicallyImpaired['SoftCode'];?>" <?php echo ($ProfileInfo['PhysicallyImpaired']==$PhysicallyImpaired['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $PhysicallyImpaired['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="VisuallyImpaired" class="col-sm-3 col-form-label">Visually Impaired?<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="VisuallyImpaired"  name="VisuallyImpaired">
                                <option value="0">Choose Visually Impaired</option>
                                <?php foreach($response['data']['VisuallyImpaired'] as $VisuallyImpaired) { ?>
                                <option value="<?php echo $VisuallyImpaired['SoftCode'];?>" <?php echo ($ProfileInfo['VisuallyImpaired']==$VisuallyImpaired['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $VisuallyImpaired['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="VissionImpaired" class="col-sm-3 col-form-label">Vission Impaired?<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="VissionImpaired"  name="VissionImpaired">
                                <option value="0"> Vission Impaired</option>
                                <?php foreach($response['data']['VissionImpaired'] as $VissionImpaired) { ?>
                                <option value="<?php echo $VissionImpaired['SoftCode'];?>" <?php echo ($ProfileInfo['VissionImpaired']==$VissionImpaired['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $VissionImpaired['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="SpeechImpaired" class="col-sm-3 col-form-label">Speech Impaired?<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="SpeechImpaired"  name="SpeechImpaired">
                                <option value="0">Choose Speech Impaired</option>
                                <?php foreach($response['data']['SpeechImpaired'] as $SpeechImpaired) { ?>
                                <option value="<?php echo $SpeechImpaired['SoftCode'];?>" <?php echo ($ProfileInfo['SpeechImpaired']==$SpeechImpaired['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $SpeechImpaired['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="Height" class="col-sm-3 col-form-label">Height<span id="star">*</span>  &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Height"  name="Height">
                                <option value="0">Choose Height</option>
                                <?php foreach($response['data']['Height'] as $Height) { ?>
                                <option value="<?php echo $Height['SoftCode'];?>" <?php echo ($ProfileInfo['Height']==$Height['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Height['CodeValue'];?></option>
                                 <?php } ?>
                            </select>
                         </div>
                         <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span>   &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Weight"  name="Weight">
                                <option value="0">Choose Weight</option>
                                <?php foreach($response['data']['Weight'] as $Weight) { ?>
                                <option value="<?php echo $Weight['SoftCode'];?>" <?php echo ($ProfileInfo['Weight']==$Weight['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Weight['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BloodGroup" class="col-sm-3 col-form-label">Blood Group<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="BloodGroup"  name="BloodGroup">
                                <option value="0">Choose Blood Group</option>
                                <?php foreach($response['data']['BloodGroup'] as $BloodGroup) { ?>
                                <option value="<?php echo $BloodGroup['SoftCode'];?>" <?php echo ($ProfileInfo['BloodGroup']==$BloodGroup['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $BloodGroup['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="Complexation" class="col-sm-3 col-form-label">Complexation<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Complexation"  name="Complexation">
                                <option value="0">Choose Complexation</option>
                                <?php foreach($response['data']['Complexation'] as $Complexation) { ?>
                                <option value="<?php echo $Complexation['SoftCode'];?>" <?php echo ($ProfileInfo['Complexation']==$Complexation['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Complexation['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BodyType" class="col-sm-3 col-form-label">Body Type<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="BodyType"  name="BodyType">
                                <option value="0">Choose Body Type</option>
                                <?php foreach($response['data']['BodyType'] as $BodyType) { ?>
                                <option value="<?php echo $BodyType['SoftCode'];?>" <?php echo ($ProfileInfo['BodyType']==$BodyType['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $BodyType['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="Diet" class="col-sm-3 col-form-label">Diet<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Diet"  name="Diet">
                                <option value="0">Choose Body Type</option>
                                <?php foreach($response['data']['Diet'] as $Diet) { ?>
                                <option value="<?php echo $Diet['SoftCode'];?>" <?php echo ($ProfileInfo['Diet']==$Diet['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $Diet['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="SmookingHabit" class="col-sm-3 col-form-label">Smooking Habit<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="SmookingHabit"  name="SmookingHabit">
                                <option value="0">Choose Smiking Habits</option>
                                <?php foreach($response['data']['SmookingHabit'] as $SmookingHabit) { ?>
                                <option value="<?php echo $SmookingHabit['SoftCode'];?>"<?php echo ($ProfileInfo['SmokingHabit']==$SmookingHabit['SoftCode']) ? " selected='selected' " : "";?> ><?php echo $SmookingHabit['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="DrinkingHabit" class="col-sm-3 col-form-label">Drinking Habit<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="DrinkingHabit"  name="DrinkingHabit">
                                <option value="0">Choose Drinking Habits</option>
                                <?php foreach($response['data']['DrinkingHabit'] as $DrinkingHabit) { ?>
                                <option value="<?php echo $DrinkingHabit['SoftCode'];?>" <?php echo ($ProfileInfo['DrinkingHabit']==$DrinkingHabit['SoftCode']) ? " selected='selected' " : "";?>><?php echo $DrinkingHabit['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
              <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-3">         
                            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                        </div>
                    </div>
              </div>
            </div> 
       </div>

<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Attachments</h4>
                <div class="form-group row">
                         <label for="Documents" class="col-sm-3 col-form-label">Document Type<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Documents"  name="Documents">
                                <option>Choose Documents</option>
                                <?php foreach($response['data']['DocumentType'] as $Document) { ?>
                                <option value="<?php echo $Document['SoftCode'];?>"><?php echo $Document['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                </div>
                <div class="form-group row">
                         <label for="Attachment" class="col-sm-3 col-form-label">Attachment<span id="star">*</span></label>
                         <div class="col-sm-3"><input type="File" class="form-control" id="File" name="File" Placeholder="File"></div>
                </div>
                <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-3">         
                            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                        </div>
                    </div>
           </div>
     </div>
 </div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Communication Details</h4>
                <div class="form-group row">
                    <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label"> 
                    <input type="checkbox" class="form-check-input" checked> Member Contact
                    </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email ID" class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $ProfileInfo['EmailID']);?>" placeholder="Email ID"></div>
                </div>
                <div class="form-group row">
                    <label for="Mobile Number" class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $ProfileInfo['MobileNumber']);?>" placeholder="Mobile Number"></div>
                    <label for="WhatsappNumber" class="col-sm-3 col-form-label">Whatsapp Number</label>
                    <div class="col-sm-3"><input type="text" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $ProfileInfo['WhatsappNumber']);?>" placeholder="Whatsapp Number"></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine1" class="col-sm-3 col-form-label">Address<span id="star">*</span></label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $ProfileInfo['AddressLine1']);?>" placeholder="AddressLine1"></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine2" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $ProfileInfo['AddressLine2']);?>" placeholder="AddressLine2"></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine3" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $ProfileInfo['AddressLine3']);?>" placeholder="AddressLine3"></div>
                </div>
                <div class="form-group row">
                         <label for="Country" class="col-sm-3 col-form-label">Country<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="Country"  name="Country">
                                <option value="0">Choose State</option>
                                <?php foreach($response['data']['CountryName'] as $Country) { ?>
                                <option value="<?php echo $Country['SoftCode'];?>"<?php echo ($ProfileInfo['Country']==$Country['SoftCode']) ? " selected='selected' " : "";?>><?php echo $Country['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                         <label for="State" class="col-sm-3 col-form-label">State<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <select class="selectpicker form-control" data-live-search="true" id="StateName"  name="StateName">
                                <option value="0">Choose State</option>
                                <?php foreach($response['data']['StateName'] as $StateName) { ?>
                                <option value="<?php echo $StateName['SoftCode'];?>"<?php echo ($ProfileInfo['State']==$StateName['SoftCode']) ? " selected='selected' " : "";?>><?php echo $StateName['CodeValue'];?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="City" class="col-sm-3 col-form-label">City<span id="star">*</span></label>
                         <div class="col-sm-3">
                            <input type="text" class="form-control" id="City" name="City" Placeholder="City" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : $ProfileInfo['City']);?>"></div>
                         <label for="OtherLocation" class="col-sm-3 col-form-label">Landmark</label>
                         <div class="col-sm-3">
                            <input type="text" class="form-control" id="OtherLocation" name="OtherLocation" Placeholder="Other Location" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : $ProfileInfo['OtherLocation']);?>">
                    </div>
                    </div>
                  <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-3">         
                            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                        </div>
                    </div>
                </div>
              </div>
</div>                                                                              
                        <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-12" align="center">
                            <a href="<?php echo GetUrl("Profile/View/".$_GET['Code'].".htm");?>" class="btn btn-success mr-2">Preview</a>
                        </div>
                    </div>

                 
 