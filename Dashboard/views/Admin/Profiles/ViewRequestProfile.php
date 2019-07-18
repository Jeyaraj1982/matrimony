<?php  
$response = $webservice->getData("Admin","ViewRequestedProfile");
    $ProfileInfo          = $response['data'];
 ?>    
 <?php
    if (isset($_POST['Approve'])) {
        
        $response = $webservice->getData("Admin","ApproveProfile",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
   ?>
 <style>
 .table-bordered > tbody > tr > td{
     width: 75px;
height: 75px;
text-align:center;
 }
 </style>
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
    <div class="col-sm-6">
    <h4 class="card-title">Member Details</h4> <?php echo $successmessage;?><?php echo $errormessage;?></div>
    <div class="col-sm-6" align="right" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../Requested");?> <small>List of Profiles</small> </a></div>
    </div>
        <div class="form-group row">
            <label for="Community" class="col-sm-3 col-form-label" style="color:#222;">Member Name</label>
            <div class="col-sm-3"> <small style="color:#555;"><?php echo $ProfileInfo['MemberName'];?></small></div>
            <label for="Member Code" class="col-sm-3 col-form-label" style="color:#222;">Member Code</label>
            <div class="col-sm-3"> <small style="color:#555;"><span class="<?php echo ($ProfileInfo['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $ProfileInfo['MemberCode'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Community" class="col-sm-3 col-form-label" style="color:#222;">Email ID</label>
            <div class="col-sm-3"> <small style="color:#555;" ><?php echo $ProfileInfo['EmailID'];?></small></div>
            <label for="Member Code" class="col-sm-3 col-form-label" style="color:#222;">Mobile Number</label>
            <div class="col-sm-3"> <small style="color:#555;" style="color:#222;"><?php echo $ProfileInfo['MobileNumber'];?></small></div>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Created On</label>
            <div class="col-sm-9"> <small style="color:#555;"><?php echo PutDateTime($ProfileInfo['CreatedOn']);?></small></div>
             </div>
             <div class="form-group row">
                    <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Last saved</label>
                    <div class="col-sm-3"><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small></div>
                   </div>
  </div>
</div>
</div>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                            <h4 class="card-title">Profile Information</h4>
                    <div class="form-group row">
                        <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Profile For</label>
                        <div class="col-sm-9"> <small style="color:#555;"><?php echo $ProfileInfo['ProfileFor'];?></small></div>
                         </div>
                    <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label" style="color:#222;" style="color:#222;">Name</label>
                        <div class="col-sm-9"><small style="color:#555;"><?php echo $ProfileInfo['ProfileName'];?></small></div>
                    </div>
                    <div class="form-group row">
                         <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Date of birth</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['DateofBirth'];?></small>
                         </div>
                         <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Sex</label>
                         <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['Sex'];?></small>   
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="MaritalStatus" class="col-sm-2 col-form-label" style="color:#222;">Marital Status</label>
                         <div class="col-sm-3">
                         <small style="color:#555;"><?php echo $ProfileInfo['MaritalStatus'];?></small>   
                         </div>
                         <label for="Caste" class="col-sm-2 col-form-label" style="color:#222;" style="color:#222;">Mother Tongue</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['MotherTongue'];?></small>  
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Religion" class="col-sm-2 col-form-label" style="color:#222;">Religion</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['Religion'];?></small>   
                         </div>
                         <label for="Caste" class="col-sm-2 col-form-label" style="color:#222;">Caste</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['Caste'];?></small>   
                         </div>
                    </div>
                    <div class="form-group row">
                         <label for="Religion" class="col-sm-2 col-form-label" style="color:#222;">Community</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['Community'];?></small>   
                         </div>
                         <label for="Caste" class="col-sm-2 col-form-label" style="color:#222;">Nationality</label>
                         <div class="col-sm-3">
                            <small style="color:#555;"><?php echo $ProfileInfo['Nationality'];?></small>   
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
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Qualification</label>
            <div class="col-sm-9"> <small style="color:#555;"><?php echo $ProfileInfo['EducationDetails'];?></small></div>
             </div>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label" style="color:#222;">Attachment</label>
            <div class="col-sm-9"></div>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Document Attachment</h4>
        <div class="form-group row">
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Document Type</label>
            <div class="col-sm-9"> <small style="color:#555;" ></small></div>
             </div>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label" style="color:#222;">Attachment</label>
            <div class="col-sm-9"></div>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Occupation Details</h4>
        <div class="form-group row">
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Employed As</label>
            <div class="col-sm-3"> <small style="color:#555;"><?php echo $ProfileInfo['EmployedAs'];?></small></div>
            <label for="Sex" class="col-sm-3 col-form-label" style="color:#222;">Annual Income</label>
             <div class="col-sm-2" ><small style="color:#555;"><?php echo $ProfileInfo['AnnualIncome'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label" style="color:#222;">Occupation</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['OccupationType'];?></small></div>
            <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Occupation Type</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['TypeofOccupation'];?></small>
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
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Father's Name</label>
            <div class="col-sm-3"> <small style="color:#555;"><?php echo $ProfileInfo['FathersName'];?></small></div>
             <label for="Name" class="col-sm-2 col-form-label" style="color:#222;">Father's Occupation</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['FathersOccupation'];?></small></div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Mother's Name</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['MothersName'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Mother's Occupation</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['MothersOccupation'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="FamilyType" class="col-sm-2 col-form-label" style="color:#222;">Family Type</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['FamilyType'];?></small>
             </div>
             <label for="FamilyAffluence" class="col-sm-2 col-form-label" style="color:#222;">Family Affluence</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['FamilyAffluence'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="FamilyValue" class="col-sm-2 col-form-label" style="color:#222;">Family Value</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['FamilyValue'];?></small>
             </div>
        </div>
        <div class="form-group row">
             <label for="NumberOfbrothers" class="col-sm-2 col-form-label" style="color:#222;">Number Of Brothers</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['NumberofBrothers'];?></small>
             </div>
             <label for="NumberOfbrothers" class="col-sm-1 col-form-label" style="color:#222;">Elder</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['Elder'];?></small>
             </div>
             <label for="younger" class="col-sm-2 col-form-label" style="color:#222;">younger</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['Younger'];?></small>
             </div>
             <label for="younger" class="col-sm-2 col-form-label" style="color:#222;">Married</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['Married'];?></small>
             </div>
        </div>
        <div class="form-group row">
             <label for="NumberOfbrothers" class="col-sm-2 col-form-label" style="color:#222;">Number Of Sisters</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['NumberofSisters'];?></small>
             </div>
             <label for="NumberOfbrothers" class="col-sm-1 col-form-label" style="color:#222;">Elder</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['ElderSister'];?></small>
             </div>
             <label for="younger" class="col-sm-2 col-form-label" style="color:#222;">younger</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['YoungerSister'];?></small>
             </div>
             <label for="younger" class="col-sm-2 col-form-label" style="color:#222;">Married</label>
             <div class="col-sm-1">
                <small style="color:#555;"><?php echo $ProfileInfo['MarriedSister'];?></small>
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
            <label for="Community" class="col-sm-2 col-form-label" style="color:#222;">Physically Impaired?</label>
            <div class="col-sm-3"> <small style="color:#555;"><?php echo $ProfileInfo['PhysicallyImpaired'];?></small></div>
            <label for="Name" class="col-sm-2 col-form-label" style="color:#222;">Visually Impaired?</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['VisuallyImpaired'];?></small></div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Vission Impaired?</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['VissionImpaired'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Speech Impaired?</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['SpeechImpaired'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Height</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['Height'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Weight</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['Weight'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Blood Group</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['BloodGroup'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label"  style="color:#222;">Complexation</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['Complexation'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label"  style="color:#222;">Body Type</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['BodyType'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Diet</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['Diet'];?></small>   
             </div>
        </div>
        <div class="form-group row">
             <label for="Date of birth" class="col-sm-2 col-form-label" style="color:#222;">Smoking Habit</label>
             <div class="col-sm-3">
                <small style="color:#555;"><?php echo $ProfileInfo['SmokingHabit'];?></small>
             </div>
             <label for="Sex" class="col-sm-2 col-form-label" style="color:#222;">Drinking Habit</label>
             <div class="col-sm-3" ><small style="color:#555;"><?php echo $ProfileInfo['DrinkingHabit'];?></small>   
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
            <label for="EmailID" class="col-sm-2 col-form-label" style="color:#222;">Email ID</label>
            <div class="col-sm-9"> <small style="color:#555;"><?php echo $ProfileInfo['EmailID'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="MobileNumber" class="col-sm-2 col-form-label" style="color:#222;">Mobile Number</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['MobileNumber'];?></small></div>
            <label for="WhatsappNumber" class="col-sm-2 col-form-label" style="color:#222;">Whatsapp Number</label>
             <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['WhatsappNumber'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label" style="color:#222;">Address</label>
            <div class="col-sm-9"><small style="color:#555;"><?php echo $ProfileInfo['AddressLine1'];?><?php echo $ProfileInfo['AddressLine2'];?><?php echo $ProfileInfo['AddressLine3'];?></small></div>
        </div> 
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label" style="color:#222;">Country</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['Country'];?></small></div>
            <label for="AddressLine2" class="col-sm-2 col-form-label" style="color:#222;">State</label>
             <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['State'];?></small></div>
        </div> 
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label" style="color:#222;">City</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['City'];?></small></div>
            <label for="AddressLine2" class="col-sm-2 col-form-label" style="color:#222;">Other Location</label>
             <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['OtherLocation'];?></small></div>
        </div>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
        <div class="form-group row">
            <label for="EmailID" class="col-sm-2 col-form-label">Star Name</label>
            <div class="col-sm-9"> <small style="color:#555;"><?php echo $ProfileInfo['StarName'];?></small></div>
        </div>
        <div class="form-group row">
            <label for="MobileNumber" class="col-sm-2 col-form-label">Rasi Name</label>
            <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['RasiName'];?></small></div>
            <label for="WhatsappNumber" class="col-sm-2 col-form-label">Lakanam</label>
             <div class="col-sm-3"><small style="color:#555;"><?php echo $ProfileInfo['Lakanam'];?></small></div>
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
  <div style="text-align: right">
        <button type="submit" class="btn btn-success" name="Approve" style="font-family:roboto">Approve</button>&nbsp;
        <button type="submit" class="btn btn-warning" name="Reject" style="font-family:roboto">Reject</button>
        <button type="submit" class="btn btn-danger" name="Delete" style="font-family:roboto">Delete</button>
    </div>
</form>

            