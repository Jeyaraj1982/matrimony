<?php
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code']));
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
<div style="text-align: right" id="">
        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$_GET['Code'].".htm ");?>">Edit</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmPublish('<?php echo $_GET['Code'];?>')" class="btn btn-success" name="Publish" style="font-family:roboto">Publish Now</a>
</div>
<br>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created On</label>
            <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo PutDateTime($ProfileInfo['CreatedOn']);?></label>
             </div>
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last saved</label>
                    <label class="col-sm-3 col-form-label"  style="color:#888;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></label>
                   </div>
  </div>
</div>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile Information</h4>
              <div class="form-group row">
                <div class="col-sm-7">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Profile For</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['ProfileFor'];?></label>
                         </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <label class="col-sm-8 col-form-label"  style="color:#737373;"><?php echo $ProfileInfo['ProfileName'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Date of birth</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['DateofBirth'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Sex</label>
                         <label class="col-sm-8 col-form-label"  style="color:#737373;"><?php echo $ProfileInfo['Sex'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Marital Status</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MaritalStatus'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Mother Tongue</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['MotherTongue'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Religion</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Religion'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Caste'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Community</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Community'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Nationality</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Nationality'];?></label>   
                    </div>
              </div>
              <div class="col-sm-5">
              <div class="form-group row">
             <div class="col-sm-12" style="text-align:right">
                   <div class="photoview">
                    <img src="<?php echo $response['data']['ProfilePhotoFirst']['ProfilePhoto'];?>" style="height: 200px;width: 150px;">
                  </div>
              </div> 
             </div>
             <div class="form-group row" style="text-align:right">
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
         <table class="table table-bordered" id="doctable">           
            <thead>
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationDegree'];?></td>
                </tr>
                <?php } } else {?>
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
            <label class="col-sm-10 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['AddressLine1'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <label class="col-sm-10 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['AddressLine2'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <label class="col-sm-10 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['AddressLine3'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pincode</label>
            <label class="col-sm-10 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Pincode'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['City'];?></label>
            <label class="col-sm-2 col-form-label">Other Location</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['OtherLocation'];?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">State</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['State'];?></label>
            <label class="col-sm-2 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $ProfileInfo['Country'];?></label>
        </div> 
        </div>
    </div>
  </div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
        <div class="col-sm-6"><h4 class="card-title">Document Attachment</h4></div>
        <div class="col-sm-6" style="text-align: right;"><h4 class="card-title" style="color:green">For Admnistrative Purpose only</h4></div>
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
                       +  '<div style="text-align:center">Are you sure want to Publish?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Publish"  onclick="SendOtpForProfileforPublish(\''+ProfileID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
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

</script>
   
            
               