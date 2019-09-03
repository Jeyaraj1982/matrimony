<?php
    $response = $webservice->getData("Member","GetDraftProfileInfo",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
?>
 <style>
 .table-bordered > tbody > tr > td{
     width: 75px;
height: 75px;
text-align:center;
 }
 #doctable > tbody > tr > td{
 width: 75px;
height: 33px;
text-align: left;
 }
 #doctable {
    border-top: 2px solid #ddd;
}
  .form-group {
    margin-bottom: 0px;
}
.photoview {
    float: right;
    margin-right: 10px;
    margin-bottom: 10px;
}
.Documentview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
}

 </style>
<form method="post" action="" onsubmit="">
<?php if($ProfileInfo['RequestToVerify']=="0"){?>
<div style="text-align: right" id="">
        <a href="<?php echo GetUrl("MemberProfileEdit/GeneralInformation/".$_GET['Code'].".htm ");?>">Edit</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmPublish('<?php echo $_GET['Code'];?>')" class="btn btn-success" name="Publish" style="font-family:roboto">Publish Now</a>
</div>
<?php }?>
<br>

<div class="col-12 grid-margin">
  <div class="card">                                                                                                               
    <div class="card-body">
        <?php if($ProfileInfo['RequestToVerify']=="0"){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created On</label>
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['CreatedOn']);?></label>
             </div>
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last saved</label>
                    <label class="col-sm-3 col-form-label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></label>
                   </div>
        <?php } else{?>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created On</label>
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['CreatedOn']);?></label>
             </div>
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Puplished On</label>
                    <label class="col-sm-3 col-form-label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['RequestVerifyOn']);?></label>
                   </div>
        <?php }?>
  </div>
</div>
</div>
<div class="col-12 grid-margin">                                                     
    <div class="card">
        <div class="card-body">
         <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Profile Information</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
              <div class="form-group row">
                <div class="col-sm-7">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Profile For</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['ProfileFor']);?></label>
                         </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Name</label>
                        <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['ProfileName']);?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Age</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Age']);?>&nbsp;years</label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Sex</label>
                         <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Sex']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Marital Status</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['MaritalStatus']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Mother Tongue</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['MotherTongue']);?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Religion</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Religion']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Caste']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Sub Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['SubCaste']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Community</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Community']);?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Nationality</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Nationality']);?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">About me</label>
                         <div class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['AboutMe']);?></div> 
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
     <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Education Details</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
         <table class="table table-bordered" id="doctable">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationDegree'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationRemarks'];?></td>
                </tr>
                <?php } 
            
            } else {?>
                <tr>    
                    <td colspan="3" style="text-align:center">No datas found</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Occupation Details</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['EmployedAs'];?></label>
            <label class="col-sm-2 col-form-label">Annual Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['OccupationType'];?></label>
            <label  class="col-sm-2 col-form-label">Occupation Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['TypeofOccupation'];?>
             </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['WorkedCountry'];?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Family Information</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersName'];?></label>
            <label class="col-sm-2 col-form-label">Father's Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersAlive'];?></label> 
        </div>
        <?php if($ProfileInfo['FathersAlive']=="Yes"){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersOccupation'];?></label>
            <label class="col-sm-2 col-form-label">Father's Income</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersIncome'];?></label>
        </div>
        <?php }?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersName'];?> </label>
             <label class="col-sm-2 col-form-label">Mother's Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersAlive'];?></label>
         </div>
         <?php if($ProfileInfo['MothersAlive']=="Yes"){?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Occupation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersOccupation'];?></label>
             <label class="col-sm-2 col-form-label">Mother's Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersIncome'];?></label>
        </div>
        <?php }?>
        <div class="form-group row">
            <?php if($ProfileInfo['FathersAlive']=="Yes"){?>
             <label class="col-sm-2 col-form-label">Father's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?></label>
            <?php }?>
            <?php if($ProfileInfo['MothersAlive']=="Yes"){?>
             <label class="col-sm-2 col-form-label">Mother's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>-<?php echo $ProfileInfo['MothersContact'];?></label>
            <?php }?>
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
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Physical Information</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Physically Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PhysicallyImpaired'];?></label>
            <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PhysicallyImpaireddescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Visually Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VisuallyImpaired'];?></label>
            <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VisuallyImpairedDescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Vission Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VissionImpaired'];?> </label>
             <?php if($ProfileInfo['VissionImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VissionImpairedDescription'];?></label>
            <?php }?>
         </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Speech Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SpeechImpaired'];?></label>
             <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SpeechImpairedDescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Height</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Height'];?>
             </label>
             <label class="col-sm-2 col-form-label">Weight</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Weight'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Blood Group</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['BloodGroup'];?>
             </label>
             <label class="col-sm-2 col-form-label">Complexation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Complexation'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Body Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['BodyType'];?>
             </label>
             <label class="col-sm-2 col-form-label">Diet</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Diet'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Smoking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SmokingHabit'];?>
             </label>
             <label class="col-sm-2 col-form-label">Drinking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DrinkingHabit'];?>   
             </label>
        </div>
    </div>
  </div>
</div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Date of birth</label>
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DateofBirth'];?></label>
        </div>
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
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Partner's Expectations</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Age </label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeFrom'];?> &nbsp;&nbsp;to&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeTo'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Religion</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Religion'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Caste</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Caste'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Marital Status</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['MaritalStatus'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Income Range</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Education'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['EmployedAs'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Details'];?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email ID</label>
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['EmailID'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mobile Number</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;+<?php echo $ProfileInfo['MobileNumberCountryCode'];?>-<?php echo $ProfileInfo['MobileNumber'];?></label>
            <label class="col-sm-2 col-form-label">Whatsapp Number</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;+<?php echo $ProfileInfo['WhatsappCountryCode'];?>-<?php echo $ProfileInfo['WhatsappNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                
            <label class="col-sm-2 col-form-label">Address</label>
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AddressLine1'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <label class="col-sm-10 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine2'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>                          
            <label class="col-sm-10 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine3'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pincode</label>
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Pincode'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['City'];?></label>
            <label class="col-sm-2 col-form-label">Other Location</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['OtherLocation'];?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">State</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['State'];?></label>
            <label class="col-sm-2 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Country'];?></label>
        </div> 
        </div>
    </div>
  </div>
<div class="col-12 grid-margin">
  <div class="card">                                                                                                        
    <div class="card-body">
    <div class="form-group row">
        <div class="col-sm-6"><h4 class="card-title">Attached Documents</h4></div>
        <div class="col-sm-6" style="text-align: right;"><h4 class="card-title" style="color:green">For Admnistrative Purpose only</h4><br>
            <a href="#">Edit</a>                    
        </div>
    </div>
    
        <div class="form-group row">
         <?php foreach($response['data']['Documents'] as $Doc) {?>
                   <div class="Documentview">
                    <img src="<?php echo $Doc['AttachFileName'];?>" style="width: 200px;height:150px">   <br>
                    <label style="color:#737373;"><?php echo $Doc['DocumentType'];?></label> <br>
                    <label style="color:#737373;">verification pending</label>
                  </div>
                  <?php }?>
         </div>
    </div>
  </div>                                                                                                               
</div>
</form>
 
            
               
 <div class="modal" id="PubplishNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Publish_body" style="height:315px">
            
                </div>
            </div>
        </div>

<script>
function showConfirmPublish(ProfileID) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                          + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        + '<h4 class="modal-title">Profile Publish</h4> <br>'
                     //  +  '<div style="text-align:center">Are you sure want to Publish?  <br><br>'
                        +'<div style="text-align:left"> Dear ,<br>'
                        +'<div style="text-align:left">You have selected to "Publish Now", In this action, your details will send to our Document Authentication Team (DAT). Once our DAT has approved your profile,the profile will live imediately in our portal, so please verify all data<br><br>'
                        + '<input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal"> I agree the terms and conditions  </label><br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Publish"  onclick="SendOtpForProfileforPublish(\''+ProfileID+'\')">Yes,send request</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No, i will do later</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Publish_body').html(content);
}
function SendOtpForProfileforPublish(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=SendOtpForProfileforPublish",param,function(result2) {$('#Publish_body').html(result2);});
}

function ProfilePublishOTPVerification(frmid) {
         var param = $( "#"+frmid).serialize();
         $('#Publish_body').html(preloader);
                    $.post( API_URL + "m=Member&a=ProfilePublishOTPVerification", 
                            param,
                            function(result2) {
                                $('#Publish_body').html(result2);   
                            }
                    );
              
    }
     function ResendSendOtpForProfileforPublish(formid) {                  
     var param = $("#frm_"+formid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=ResendSendOtpForProfileforPublish",param,function(result2) {$('#Publish_body').html(result2);});
}   

</script>
   
            
               