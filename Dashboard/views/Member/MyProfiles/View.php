<?php  
     $response = $webservice->EditProfile();
    $ProfileInfo          = $response['data']['ProfileInfo'];
    if (sizeof($ProfileInfo)==0) {
        echo "Error: Access denied. Please contact administrator";
    } else { ?>
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">         
                            <h4 class="card-title">Profile Information</h4></div>
                        <div class="col-sm-9" align="right" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../Draft");?> <small>List of Profiles</small> </a></div>
                        </div>
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label"><small>Profile For<span id="star">*</span></small></label>
                        <div class="col-sm-9">
                        <?php $ProfileFor = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN' and SoftCode='".$ProfileInfo[0]['ProfileFor']."'"); ?>
                        <small style="color:#737373;"><?php echo $ProfileFor[0]['CodeValue'];?></small></div>
                         </div>
                    <div class="form-group row">
                        <label for="Name" class="col-sm-3 col-form-label"><small>Name<span id="star">*</span></small></label>
                        <div class="col-sm-9"><small style="color:#737373;"><?php echo $ProfileInfo[0]['ProfileName'];?></small></div>
                    </div>
                    <div class="form-group row">
                         <label for="Date of birth" class="col-sm-3 col-form-label"><small>Date of birth<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <small style="color:#737373;"><?php echo $ProfileInfo[0]['DateofBirth'];?></small>
                         </div>
                         <label for="Sex" class="col-sm-3 col-form-label"><small>Sex<span id="star">*</span></small></label>
                         <div class="col-sm-3" >
                            <?php $Sex = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX' and SoftCode='".$ProfileInfo[0]['Sex']."'"); ?>
                            <small style="color:#737373;"><?php echo $Sex[0]['CodeValue'];?></small>   
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="MaritalStatus" class="col-sm-3 col-form-label"><small>Marital Status<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $MaritalStatus = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS' and SoftCode='".$ProfileInfo[0]['MaritalStatus']."'"); ?>
                            <small style="color:#737373;"><?php echo $MaritalStatus[0]['CodeValue'];?></small>   
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label"><small>Mother Tongue<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $MotherTongue = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES' and SoftCode='".$ProfileInfo[0]['MotherTongue']."'"); ?>
                            <small style="color:#737373;"><?php echo $MotherTongue[0]['CodeValue'];?></small>  
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Religion" class="col-sm-3 col-form-label"><small>Religion<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Religion = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and SoftCode='".$ProfileInfo[0]['Religion']."'"); ?>
                            <small style="color:#737373;"><?php echo $Religion[0]['CodeValue'];?></small>   
                         </div>
                         <label for="Caste" class="col-sm-3 col-form-label"><small>Caste<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Caste = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and SoftCode='".$ProfileInfo[0]['Caste']."'"); ?>
                            <small style="color:#737373;"><?php echo $Caste[0]['CodeValue'];?></small>   
                         </div>
                    </div>
                    <div class="form-group row">
                        <label for="Community" class="col-sm-3 col-form-label"><small>Community<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <?php $Community = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY' and SoftCode='".$ProfileInfo[0]['Community']."'"); ?>
                            <small style="color:#737373;"><?php echo $Community[0]['CodeValue'];?></small>    
                        </div>
                        <label for="Nationality" class="col-sm-3 col-form-label"><small>Nationality<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <?php $Nationality = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and SoftCode='".$ProfileInfo[0]['Nationality']."'"); ?>
                            <small style="color:#737373;"><?php echo $Nationality[0]['CodeValue'];?></small>    
                        </div>
                    </div>  
                    <!-- <i class="fa fa-plus"></i> -->
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
                         <label for="Employed As" class="col-sm-3 col-form-label"><small>Employed As<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $EmployedAs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONS' and SoftCode='".$ProfileInfo[0]['EmployedAs']."'"); ?>
                            <small style="color:#737373;"><?php echo $EmployedAs[0]['CodeValue'];?></small>    
                         </div>
                         <label for="OccupationType" class="col-sm-3 col-form-label"><small>Occupation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Occupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$ProfileInfo[0]['OccupationType']."'"); ?>
                            <small style="color:#737373;"><?php echo $Occupation[0]['CodeValue'];?></small>  
                         </div>
                 </div>
                 <div class="form-group row">
                    <label for="TypeofOccupation" class="col-sm-3 col-form-label"><small>Type of Occupation<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <?php $TypeofOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TYPEOFOCCUPATIONS' and SoftCode='".$ProfileInfo[0]['TypeofOccupation']."'"); ?>
                        <small style="color:#737373;"><?php echo $TypeofOccupation[0]['CodeValue'];?></small>    
                    </div>
                    <label for="IncomeRange" class="col-sm-3 col-form-label"><small>Annual Income<span id="star">*</span></small></label>
                    <div class="col-sm-3">
                        <?php $IncomeRange = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and SoftCode='".$ProfileInfo[0]['AnnualIncome']."'"); ?>
                        <small style="color:#737373;"><?php echo $IncomeRange[0]['CodeValue'];?></small>   
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
                        <label for="FatherName" class="col-sm-2 col-form-label"><small>Father's Name<span id="star">*</span></small></label>
                        <div class="col-sm-4"><small style="color:#737373;"><?php echo $ProfileInfo[0]['FathersName'];?></small></div>
                        <label for="FathersOccupation" class="col-sm-3 col-form-label"><small>Fathers Occupation<span id="star">*</span></small></label>
                        <div class="col-sm-3">
                            <?php $FathersOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$ProfileInfo[0]['FathersOccupation']."'"); ?>
                            <small style="color:#737373;"><?php echo $FathersOccupation[0]['CodeValue'];?></small>                                       
                        </div>
                </div>
                <div class="form-group row">
                         <label for="MotherName" class="col-sm-2 col-form-label"><small>Mother's Name<span id="star">*</span></small></label>
                         <div class="col-sm-4">
                            <small style="color:#737373;"><?php echo $ProfileInfo[0]['MothersName'];?></small>
                         </div>
                         <label for="MothersOccupation" class="col-sm-3 col-form-label"><small>Mothers Occupation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $MothersOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$ProfileInfo[0]['MothersOccupation']."'"); ?>
                            <small style="color:#737373;"><?php echo $MothersOccupation[0]['CodeValue'];?></small>   
                         </div>
                </div>
                <div class="form-group row">
                        <label for="No of Brothers" class="col-sm-2 col-form-label">No of Brothers<span id="star">*</span></label>
                        <div class="col-sm-1" align="left">
                            <?php $NumberofBrother = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NUMBEROFBROTHER' and SoftCode='".$ProfileInfo[0]['NumberofBrothers']."'"); ?>
                            <small style="color:#737373;"><?php echo $NumberofBrother[0]['CodeValue'];?></small>
                        </div>
                         <label for="Elder" class="col-sm-1 col-form-label">Elder</label>
                         <div class="col-sm-1">
                            <?php $elder = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDER' and SoftCode='".$ProfileInfo[0]['Elder']."'"); ?>
                            <small style="color:#737373;"><?php echo $elder[0]['CodeValue'];?></small>   
                         </div>
                        <label for="elder" class="col-sm-2 col-form-label"><small>younger</small></label>
                        <div class="col-sm-1">
                            <?php $younger = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGER' and SoftCode='".$ProfileInfo[0]['Younger']."'"); ?>
                            <small style="color:#737373;"><?php echo $younger[0]['CodeValue'];?></small>   
                         </div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>married</small></label>
                        <div class="col-sm-1">
                            <?php $married = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIED' and SoftCode='".$ProfileInfo[0]['Married']."'"); ?>
                            <small style="color:#737373;"><?php echo $married[0]['CodeValue'];?></small>   
                        </div> 
                </div>
                <div class="form-group row">
                        <label for="No of Sisters" class="col-sm-2 col-form-label">No of Sisters<span id="star">*</span></label>
                        <div class="col-sm-1" align="left">
                            <?php $NumberofSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NOOFSISTER' and SoftCode='".$ProfileInfo[0]['NumberofSisters']."'"); ?>
                            <small style="color:#737373;"><?php echo $NumberofSister[0]['CodeValue'];?></small>   
                        </div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>elder</small></label>
                        <div class="col-sm-1" align="left">
                            <?php $elderSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDERSIS' and SoftCode='".$ProfileInfo[0]['ElderSister']."'"); ?>
                            <small style="color:#737373;"><?php echo $elderSister[0]['CodeValue'];?></small>   
                        </div>
                        <label for="elder" class="col-sm-2 col-form-label"><small>younger</small></label>
                        <div class="col-sm-1" align="left">
                            <?php $youngerSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGERSIS' and SoftCode='".$ProfileInfo[0]['YoungerSister']."'"); ?>
                            <small style="color:#737373;"><?php echo $youngerSister[0]['CodeValue'];?></small>    
                        </div>
                        <label for="elder" class="col-sm-1 col-form-label"><small>married</small></label>
                        <div class="col-sm-1" align="left">
                            <?php $marriedSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIEDSIS' and SoftCode='".$ProfileInfo[0]['MarriedSister']."'"); ?>
                            <small style="color:#737373;"><?php echo $marriedSister[0]['CodeValue'];?></small>    
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
                         <label for="PhysicallyImpaired" class="col-sm-3 col-form-label"><small>Physically Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $PhysicallyImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PHYSICALLYIMPAIRED' and SoftCode='".$ProfileInfo[0]['PhysicallyImpaired']."'"); ?>
                            <small style="color:#737373;"><?php echo $PhysicallyImpaired[0]['CodeValue'];?></small>   
                         </div>
                         <label for="VisuallyImpaired" class="col-sm-3 col-form-label"><small>Visually Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $VisuallyImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISUALLYIMPAIRED' and SoftCode='".$ProfileInfo[0]['VisuallyImpaired']."'"); ?>
                            <small style="color:#737373;"><?php echo $VisuallyImpaired[0]['CodeValue'];?></small>   
                         </div>  
                </div>
                <div class="form-group row">
                         <label for="VissionImpaired" class="col-sm-3 col-form-label"><small>Vission Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $VissionImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISSIONIMPAIRED' and SoftCode='".$ProfileInfo[0]['VissionImpaired']."'"); ?>
                            <small style="color:#737373;"><?php echo $VissionImpaired[0]['CodeValue'];?></small>  
                         </div>
                         <label for="SpeechImpaired" class="col-sm-3 col-form-label"><small>Speech Impaired?<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $SpeechImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SPEECHIMPAIRED' and SoftCode='".$ProfileInfo[0]['SpeechImpaired']."'"); ?>
                            <small style="color:#737373;"><?php echo $SpeechImpaired[0]['CodeValue'];?></small>    
                         </div>
                </div>
                <div class="form-group row">
                         <label for="Height" class="col-sm-3 col-form-label"><small>Height<span id="star">*</span>  &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></small></label>
                         <div class="col-sm-3">
                            <?php $Height = $mysql->select("select * from _tbl_master_codemaster Where HardCode='HEIGHTS' and SoftCode='".$ProfileInfo[0]['Height']."'"); ?>
                            <small style="color:#737373;"><?php echo $Height[0]['CodeValue'];?></small>   
                         </div>
                         <label for="Weight" class="col-sm-3 col-form-label"><small>Weight<span id="star">*</span>   &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></small></label>
                         <div class="col-sm-3">
                            <?php $Weight = $mysql->select("select * from _tbl_master_codemaster Where HardCode='WEIGHTS' and SoftCode='".$ProfileInfo[0]['Weight']."'"); ?>
                            <small style="color:#737373;"><?php echo $Weight[0]['CodeValue'];?></small>  
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BloodGroup" class="col-sm-3 col-form-label"><small>Blood Group<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $BloodGroup = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BLOODGROUPS' and SoftCode='".$ProfileInfo[0]['BloodGroup']."'"); ?>
                            <small style="color:#737373;"><?php echo $BloodGroup[0]['CodeValue'];?></small>   
                         </div>
                         <label for="Complexation" class="col-sm-3 col-form-label"><small>Complexation<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Complexation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMPLEXIONS' and SoftCode='".$ProfileInfo[0]['Complexation']."'"); ?>
                            <small style="color:#737373;"><?php echo $Complexation[0]['CodeValue'];?></small>   
                         </div>
                </div>
                <div class="form-group row">
                         <label for="BodyType" class="col-sm-3 col-form-label"><small>Body Type<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $BodyType = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BODYTYPES' and SoftCode='".$ProfileInfo[0]['BodyType']."'"); ?>
                            <small style="color:#737373;"><?php echo $BodyType[0]['CodeValue'];?></small>   
                         </div>
                         <label for="Diet" class="col-sm-3 col-form-label"><small>Diet<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Diet = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DIETS' and SoftCode='".$ProfileInfo[0]['Diet']."'"); ?>
                            <small style="color:#737373;"><?php echo $Diet[0]['CodeValue'];?></small>   
                         </div>
                </div>
                <div class="form-group row">
                         <label for="SmookingHabit" class="col-sm-3 col-form-label"><small>Smooking Habit<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $SmookingHabit = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMOKINGHABITS' and SoftCode='".$ProfileInfo[0]['SmokingHabit']."'"); ?>
                            <small style="color:#737373;"><?php echo $SmookingHabit[0]['CodeValue'];?></small>       
                         </div>
                         <label for="DrinkingHabit" class="col-sm-3 col-form-label"><small>Drinking Habit<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $DrinkingHabit = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DRINKINGHABITS' and SoftCode='".$ProfileInfo[0]['DrinkingHabit']."'"); ?>
                            <small style="color:#737373;"><?php echo $DrinkingHabit[0]['CodeValue'];?></small>     
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
                <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-3">         
                            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button><br>
                            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo[0]['LastUpdatedOn']);?></small>
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
                    <label for="Email ID" class="col-sm-3 col-form-label"><small>Email ID<span id="star">*</span></small></label>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo[0]['EmailID'];?></small></div>
                </div>
                <div class="form-group row">
                    <label for="Mobile Number" class="col-sm-3 col-form-label"><small>Mobile Number<span id="star">*</span></small></label>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo[0]['MobileNumber'];?></small></div>
                    <label for="WhatsappNumber" class="col-sm-3 col-form-label"><small>Whatsapp Number</small></label>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo[0]['WhatsappNumber'];?></small></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine1" class="col-sm-3 col-form-label"><small>Address<span id="star">*</span></small></label>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $ProfileInfo[0]['AddressLine1'];?></small></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine2" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $ProfileInfo[0]['AddressLine2'];?></small></div>
                </div>
                <div class="form-group row">
                    <label for="AddressLine3" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $ProfileInfo[0]['AddressLine3'];?></small></div>
                </div>
                <div class="form-group row">
                         <label for="Country" class="col-sm-3 col-form-label"><small>Country<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $Country = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and SoftCode='".$ProfileInfo[0]['Country']."'"); ?>
                            <small style="color:#737373;"><?php echo $Country[0]['CodeValue'];?></small>   
                         </div>
                         <label for="State" class="col-sm-3 col-form-label"><small>State<span id="star">*</span></small></label>
                         <div class="col-sm-3">
                            <?php $State = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and SoftCode='".$ProfileInfo[0]['State']."'"); ?>
                            <small style="color:#737373;"><?php echo $State[0]['CodeValue'];?></small>   
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="City" class="col-sm-3 col-form-label"><small>City<span id="star">*</span></small></label>
                         <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo[0]['City'];?></small></div>
                         <label for="OtherLocation" class="col-sm-3 col-form-label"><small>Landmark</small></label>
                         <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo[0]['OtherLocation'];?></div>
                    </div>
                </div>
              </div>
</div>
 <?php } ?>                                    
