<?php           
    $response = $webservice->getData("Member","GetDownloadProfileInformation",array("ProfileID"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $ProfilePhotos = $response['data']['ProfilePhoto'];
?>
  
 <style>
 .table-bordered > tbody > tr > td{
     width: 75px;
height: 75px;
text-align:center;
 }
 .form-group {
    margin-bottom: 0px;
}
.photoview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    height: 211px;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
}
 </style>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile Information</h4>
              <div class="form-group row">
                <div class="col-sm-7">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Profile For</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ProfileFor'];?></label>
                         </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Name</label>
                        <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ProfileName'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Date of birth</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DateofBirth'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Sex</label>
                         <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Sex'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Marital Status</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MaritalStatus'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Mother Tongue</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MotherTongue'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Religion</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Religion'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Caste'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Sub Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SubCaste'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Community</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Community'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Nationality</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Nationality'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">About me</label>
                         <div class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AboutMe'];?></div> 
                    </div>
              </div>
              <div class="col-sm-5">                                                             
              <div class="form-group row">
             <div class="col-sm-12" style="text-align:right">
                   <div class="photoview">
                    <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 200px;width: 150px;">
                  </div>
              </div> 
             </div>
             <div style="text-align:right">
             <?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                   <div class="photoview">
                    <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 96px;width: 72px;">
                  </div>
                  <?php }?>
                  </div>
             </div>
              </div>
         </div>
</div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Education Details</h4>
        <div class="form-group row">
            <label for="Community" class="col-sm-2 col-form-label">Qualification</label>
            <div class="col-sm-9"> <small style="color:#737373;"><?php echo $EducationAttachment['EducationDetails'];?></small></div>
             </div>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Education Degree</label>
            <div class="col-sm-9"> <small style="color:#737373;"><?php echo $EducationAttachment['EducationDegree'];?></small></div>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Occupation Details</h4>
        <div class="form-group row">
            <label for="Community" class="col-sm-2 col-form-label">Employed As</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $ProfileInfo['EmployedAs'];?></small></div>
            <label for="Sex" class="col-sm-2 col-form-label">Annual Income</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['AnnualIncome'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Occupation</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['OccupationType'];?></small></div>
            <label for="Date of birth" class="col-sm-2 col-form-label">Occupation Type</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['TypeofOccupation'];?></small>
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
            <label class="col-sm-2 col-form-label">Father's Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersName'];?></label>
             <label class="col-sm-2 col-form-label">Father Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersAlive'];?></label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersOccupation'];?></label>
            <label class="col-sm-2 col-form-label">Father's Income</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersIncome'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersName'];?> </label>
             <label class="col-sm-2 col-form-label">Mother Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersAlive'];?></label>
         </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Occupation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersOccupation'];?></label>
             <label class="col-sm-2 col-form-label">Mother's Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersIncome'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Father's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersContact'];?></label>
             <label class="col-sm-2 col-form-label">Mother's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersContact'];?></label>
        </div>                                                              
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyType'];?>
             </label>
             <label class="col-sm-2 col-form-label">Family Affluence</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyAffluence'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Value</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyValue'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Brothers</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['NumberofBrothers'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Elder'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Younger'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Married'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Sisters</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['NumberofSisters'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ElderSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['YoungerSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MarriedSister'];?>
             </label>
        </div>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Physical Information</h4>
        <div class="form-group row">
            <label for="Community" class="col-sm-3 col-form-label">Physically Impaired?</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $ProfileInfo['PhysicallyImpaired'];?></small></div>
            <label for="Name" class="col-sm-3 col-form-label">Visually Impaired?</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['VisuallyImpaired'];?></small></div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-3 col-form-label">Vission Impaired?</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['VissionImpaired'];?></small>
             </div>
             <label for="Sex" class="col-sm-3 col-form-label">Speech Impaired?</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['SpeechImpaired'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-3 col-form-label">Height</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['Height'];?></small>
             </div>
             <label for="Sex" class="col-sm-3 col-form-label">Weight</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['Weight'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-3 col-form-label">Blood Group</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['BloodGroup'];?></small>
             </div>
             <label for="Sex" class="col-sm-3 col-form-label">Complexation</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['Complexation'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-3 col-form-label">Body Type</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['BodyType'];?></small>
             </div>
             <label for="Sex" class="col-sm-3 col-form-label">Diet</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['Diet'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-3 col-form-label">Smoking Habit</label>
             <div class="col-sm-3">
                <small style="color:#737373;"><?php echo $ProfileInfo['SmokingHabit'];?></small>
             </div>
             <label for="Sex" class="col-sm-3 col-form-label">Drinking Habit</label>
             <div class="col-sm-3" ><small style="color:#737373;"><?php echo $ProfileInfo['DrinkingHabit'];?></small>   
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
            <label for="EmailID" class="col-sm-2 col-form-label">Email ID</label>
            <div class="col-sm-9"> <small style="color:#737373;"><?php echo $ProfileInfo['EmailID'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="MobileNumber" class="col-sm-2 col-form-label">Mobile Number</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['MobileNumber'];?></small></div>
            <label for="WhatsappNumber" class="col-sm-2 col-form-label">Whatsapp Number</label>
             <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['WhatsappNumber'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-9"><small style="color:#737373;"><?php echo $ProfileInfo['AddressLine1'];?><?php echo $ProfileInfo['AddressLine2'];?><?php echo $ProfileInfo['AddressLine3'];?></small></div>
        </div> 
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['Country'];?></small></div>
            <label for="AddressLine2" class="col-sm-2 col-form-label">State</label>
             <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['State'];?></small></div>
        </div> 
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['City'];?></small></div>
            <label for="AddressLine2" class="col-sm-2 col-form-label">Other Location</label>
             <div class="col-sm-3"><small style="color:#737373;"><?php echo $ProfileInfo['OtherLocation'];?></small></div>
        </div>
        </div>
    </div>
  </div>
   <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Time Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['TimeOfBirth'];?></label>
            <label class="col-sm-2 col-form-label">Place Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PlaceOfBirth'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['StarName'];?></label>
            <label class="col-sm-2 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['RasiName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['RasiName'];?></label>
            <label class="col-sm-2 col-form-label">Chevvai Dhosham</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ChevvaiDhosham'];?></label>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
               <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['R1'];?></td>
                    <td><?php echo $ProfileInfo['R2'];?></td>
                    <td><?php echo $ProfileInfo['R3'];?></td>
                    <td><?php echo $ProfileInfo['R4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Rasi</td>
                    <td><?php echo $ProfileInfo['R8'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R9'];?></td>
                    <td><?php echo $ProfileInfo['R12'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R13'];?></td>
                    <td><?php echo $ProfileInfo['R14'];?></td>
                    <td><?php echo $ProfileInfo['R15'];?></td>
                    <td><?php echo $ProfileInfo['R16'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-6">
               <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['A1'];?></td>
                    <td><?php echo $ProfileInfo['A2'];?></td>
                    <td><?php echo $ProfileInfo['A3'];?></td>
                    <td><?php echo $ProfileInfo['A4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Amsam</td>
                    <td><?php echo $ProfileInfo['A8'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A9'];?></td>
                    <td><?php echo $ProfileInfo['A12'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A13'];?></td>
                    <td><?php echo $ProfileInfo['A14'];?></td>
                    <td><?php echo $ProfileInfo['A15'];?></td>
                    <td><?php echo $ProfileInfo['A16'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
  </div>
  
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Parners Expectation</h4>
        <div class="form-group row">
            <label for="AgeFrom" class="col-sm-2 col-form-label">Age From</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $PartnerExpectation['AgeFrom'];?></small></div>
            <label for="AgeTo" class="col-sm-2 col-form-label">Age To</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $PartnerExpectation['AgeTo'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Religion" class="col-sm-2 col-form-label">Religion</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $PartnerExpectation['Religion'];?></small></div>
            <label for="Caste" class="col-sm-2 col-form-label">Caste</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $PartnerExpectation['Caste'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $PartnerExpectation['MaritalStatus'];?></small></div>
            <label for="AnnualIncome" class="col-sm-2 col-form-label">Income Range</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $PartnerExpectation['AnnualIncome'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Education" class="col-sm-2 col-form-label">Education</label>
            <div class="col-sm-3"> <small style="color:#737373;"><?php echo $PartnerExpectation['Education'];?></small></div>
            <label for="EmployedAs" class="col-sm-2 col-form-label">Employed As</label>
            <div class="col-sm-3"><small style="color:#737373;"><?php echo $PartnerExpectation['EmployedAs'];?></small></div>
        </div>
    </div>
  </div>
</div>
 
            
<?php include_once("settings_footer.php");?>                    