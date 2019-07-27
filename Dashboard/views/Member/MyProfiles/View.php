<?php
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
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
 </style>
<form method="post" action="" onsubmit="">

<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created On</label>
            <div class="col-sm-9"> <small style="color:#737373;"><?php echo PutDateTime($ProfileInfo['CreatedOn']);?></div>
             </div>
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last saved</label>
                    <label class="col-sm-3 col-form-label"  style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></label>
                   </div>
  </div>
</div>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile Information</h4>
              <div class="form-group row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Profile For</label>
                        <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['ProfileFor'];?></label>
                         </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <label class="col-sm-9 col-form-label"  style="color:#737373;"><?php echo $ProfileInfo['ProfileName'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Date of birth</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['DateofBirth'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Sex</label>
                         <label class="col-sm-3 col-form-label"  style="color:#737373;"><?php echo $ProfileInfo['Sex'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Marital Status</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MaritalStatus'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Mother Tongue</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MotherTongue'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Religion</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Religion'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Caste</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Caste'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Community</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Community'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label">Nationality</label>
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Nationality'];?></label>   
                    </div>
                    
              </div>
              <div class="col-sm-6">
              <?php
              ?>
                  <?php foreach($ProfilePhotos as $ProfileP) {?>
                   <div>
                    <img src="<?php echo AppUrl;?>uploads/<?php echo $ProfileP['ProfilePhoto'];?>" style="height:120px;">
                  </div> 
                  <?php }?>
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
            <label class="col-sm-2 col-form-label">Qualification</label>
            <label class="col-sm-2 col-form-label" style="color:#737373;"><?php echo $EducationAttachment['EducationDetails'];?> </label>
             </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education Degree</label>
            <label class="col-sm-2 col-form-label" style="color:#737373;"><?php echo $EducationAttachment['EducationDegree'];?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Document Attachment</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Document Type</label>
            <label class="col-sm-2 col-form-label" style="color:#737373;"></label>
             </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Attachment</label>
            <label class="col-sm-2 col-form-label"></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Occupation Details</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['EmployedAs'];?></label>
            <label class="col-sm-2 col-form-label">Annual Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['OccupationType'];?></label>
            <label  class="col-sm-2 col-form-label">Occupation Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['TypeofOccupation'];?>
             </label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['FathersName'];?></label>
             <label class="col-sm-2 col-form-label">Father's Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['FathersOccupation'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MothersName'];?>
             </label>
             <label class="col-sm-2 col-form-label">Mother's Occupation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MothersOccupation'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['FamilyType'];?>
             </label>
             <label class="col-sm-2 col-form-label">Family Affluence</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['FamilyAffluence'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Value</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['FamilyValue'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Brothers</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['NumberofBrothers'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Elder'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Younger'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Married'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Sisters</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['NumberofSisters'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['ElderSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['YoungerSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MarriedSister'];?>
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
            <label class="col-sm-2 col-form-label">Physically Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['PhysicallyImpaired'];?></label>
            <label class="col-sm-2 col-form-label">Visually Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['VisuallyImpaired'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Vission Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['VissionImpaired'];?>
             </label>
             <label class="col-sm-2 col-form-label">Speech Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['SpeechImpaired'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Height</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Height'];?>
             </label>
             <label class="col-sm-2 col-form-label">Weight</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Weight'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Blood Group</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['BloodGroup'];?>
             </label>
             <label class="col-sm-2 col-form-label">Complexation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Complexation'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Body Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['BodyType'];?>
             </label>
             <label class="col-sm-2 col-form-label">Diet</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Diet'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Smoking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['SmokingHabit'];?>
             </label>
             <label class="col-sm-2 col-form-label">Drinking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['DrinkingHabit'];?>   
             </label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email ID</label>
            <label class="col-sm-9 col-form-label"style="color:#737373;"><?php echo $ProfileInfo['EmailID'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mobile Number</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MobileNumber'];?></label>
            <label class="col-sm-2 col-form-label">Whatsapp Number</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['WhatsappNumber'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['AddressLine1'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ProfileInfo['AddressLine2'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ProfileInfo['AddressLine3'];?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Country'];?></label>
            <label class="col-sm-2 col-form-label">State</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['State'];?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['City'];?></label>
            <label class="col-sm-2 col-form-label">Other Location</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['OtherLocation'];?></label>
        </div>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star Name</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['StarName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['RasiName'];?></label>
            <label class="col-sm-2 col-form-label">Lakanam</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Lakanam'];?></label>
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
            <label class="col-sm-2 col-form-label">Age </label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['AgeFrom'];?> &nbsp;&nbsp;to&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeTo'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Religion</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['Religion'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Caste</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['Caste'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Marital Status</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['MaritalStatus'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Income Range</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['Education'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $PartnerExpectation['EmployedAs'];?></label>
        </div>
    </div>
  </div>
</div>
</form>

            
<?php include_once("settings_footer.php");?>                    