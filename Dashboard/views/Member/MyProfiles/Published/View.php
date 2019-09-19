<?php
    $response = $webservice->getData("Member","GetPublishProfileInfo",array("ProfileCode"=>$_GET['Code']));
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
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Created On</label>
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['CreatedOn']);?></label>
             </div>
             <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Published On</label>
                    <label class="col-sm-3 col-form-label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['IsApprovedOn']);?></label>
                   </div>
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
                <div class="col-sm-5">
                    <div style="border: 1px solid black;padding: 0px;width: 318px;height: 378px;"> 
                    <div class="form-group row">                                                       
                        <div class="col-sm-12">
                            <div class="photoview" style="float:left;width: 316px;height:280px">
                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                            </div>
                        </div> 
                    </div>
                    <div style="padding-left: 10px;padding-right: 10px;">
                      <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></div>
                        <div class="col-sm-10">
                        <?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                            <div class="photoview" style="float: left;">
                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;">
                            </div>
                        <?php }?>
                        </div>
                       <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/rightarrow.jpg" style="width:30px"></div>
                  </div>
                </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['ProfileName'])))>0){ echo trim($ProfileInfo['ProfileName']); } else{ echo "N/A";}?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['Age'])))>0){ echo trim($ProfileInfo['Age']); ?>&nbsp;yrs ,<?php }?>&nbsp;<?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);}?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MaritalStatus']);?></label> 
                    </div>
                    <?php if($ProfileInfo['MaritalStatusCode']!= "MST001"){?>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Children</label>
                            <label class="col-sm-2 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?></label> 
                            <label class="col-sm-3 col-form-label">Children with you</label>
                            <label class="col-sm-2 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                            <?php if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {  echo "Yes"; } else  { echo "No";};?></label>   
                    </div>
                    <?php }?>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Religion']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Caste']);?></label>
                    </div>
                     <?php if((strlen(trim($ProfileInfo['SubCaste'])))>0){?>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['SubCaste']);?></label>
                    </div>
                    <?php }?>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Community']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Nationality']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MotherTongue']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['City']);?>,&nbsp;&nbsp;<?php echo trim($ProfileInfo['State']);?>,&nbsp;&nbsp;<?php echo trim($ProfileInfo['Country']);?></label>
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
            <div class="col-sm-6"><h4 class="card-title">About Me</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="#">Edit</a></div>
         </div>
         <table>           
           <?php echo trim($ProfileInfo['AboutMe']);?>
        </table>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['EmployedAs'])))>0){ echo trim($ProfileInfo['EmployedAs']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Annual Income</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['AnnualIncome'])))>0){ echo trim($ProfileInfo['AnnualIncome']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Occupation</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['OccupationType'])))>0){ echo trim($ProfileInfo['OccupationType']); } else{ echo "N/A";}?></label>
            <label  class="col-sm-2 col-form-label">Occupation Type</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['TypeofOccupation'])))>0){ echo trim($ProfileInfo['TypeofOccupation']); } else{ echo "N/A";}?>
             </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country</label>                      
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['WorkedCountry'])))>0){ echo trim($ProfileInfo['WorkedCountry']); } else{ echo "N/A";}?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersName'])))>0){ echo trim($ProfileInfo['FathersName']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Father's Alive</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersAlive'])))>0){?><?php if($ProfileInfo['FathersAlive']=="0"){ echo "Yes";}else { echo "Passed away" ;}?><?php } else{ echo "N/A";}?> </label> 
        </div>
        <?php if($ProfileInfo['FathersAlive']=="0"){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's Occupation</label>         
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersOccupation'])))>0){ echo trim($ProfileInfo['FathersOccupation']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Father's Income</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersIncome'])))>0){ echo trim($ProfileInfo['FathersIncome']); } else{ echo "N/A";}?></label>
        </div>
        <?php }?>
        <div class="form-group row">                                                    
             <label class="col-sm-2 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersName'])))>0){ echo trim($ProfileInfo['MothersName']); } else{ echo "N/A";}?> </label>
             <label class="col-sm-2 col-form-label">Mother's Alive</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersAlive'])))>0){?><?php if($ProfileInfo['MothersAlive']=="0"){ echo "Yes";}else { echo "Passed away" ;}?><?php } else{ echo "N/A";}?></label>
         </div>
         <?php if($ProfileInfo['MothersAlive']=="0"){?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Occupation</label>        
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersOccupation'])))>0){ echo trim($ProfileInfo['MothersOccupation']); } else{ echo "N/A";}?></label>
             <label class="col-sm-2 col-form-label">Mother's Income</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersIncome'])))>0){ echo trim($ProfileInfo['MothersIncome']); } else{ echo "N/A";}?></label>
        </div>
        <?php }?>
        <div class="form-group row">
            <?php if($ProfileInfo['FathersAlive']=="0"){?>                             
             <label class="col-sm-2 col-form-label">Father's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
            <?php }?>
            <?php if($ProfileInfo['MothersAlive']=="0"){?>
             <label class="col-sm-2 col-form-label">Mother's Contact</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
            <?php }?>
        </div>                                                              
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Type</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FamilyType'])))>0){ echo trim($ProfileInfo['FamilyType']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Family Affluence</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FamilyAffluence'])))>0){ echo trim($ProfileInfo['FamilyAffluence']); } else{ echo "N/A";}?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Value</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FamilyValue'])))>0){ echo trim($ProfileInfo['FamilyValue']); } else{ echo "N/A";}?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Brothers</label>          
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['NumberofBrothers'])))>0){ echo trim($ProfileInfo['NumberofBrothers']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Elder'])))>0){ echo trim($ProfileInfo['Elder']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Younger'])))>0){ echo trim($ProfileInfo['Younger']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>                      
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Married'])))>0){ echo trim($ProfileInfo['Married']); } else{ echo "N/A";}?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Sisters</label>           
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['NumberofSisters'])))>0){ echo trim($ProfileInfo['NumberofSisters']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['ElderSister'])))>0){ echo trim($ProfileInfo['ElderSister']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['YoungerSister'])))>0){ echo trim($ProfileInfo['YoungerSister']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>                    
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MarriedSister'])))>0){ echo trim($ProfileInfo['MarriedSister']); } else{ echo "N/A";}?>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['PhysicallyImpaired'])))>0){ echo trim($ProfileInfo['PhysicallyImpaired']); } else{ echo "N/A";}?></label>
            <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['PhysicallyImpaireddescription'])))>0){ echo trim($ProfileInfo['PhysicallyImpaireddescription']); } else{ echo "N/A";}?></label>
            <?php }?>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Visually Impaired?</label>          
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['VisuallyImpaired'])))>0){ echo trim($ProfileInfo['VisuallyImpaired']); } else{ echo "N/A";}?></label>
            <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['VisuallyImpairedDescription'])))>0){ echo trim($ProfileInfo['VisuallyImpairedDescription']); } else{ echo "N/A";}?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Vission Impaired?</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['VissionImpaired'])))>0){ echo trim($ProfileInfo['VissionImpaired']); } else{ echo "N/A";}?> </label>
             <?php if($ProfileInfo['VissionImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['VissionImpairedDescription'])))>0){ echo trim($ProfileInfo['VissionImpairedDescription']); } else{ echo "N/A";}?></label>
            <?php }?>
         </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Speech Impaired?</label>            
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['SpeechImpaired'])))>0){ echo trim($ProfileInfo['SpeechImpaired']); } else{ echo "N/A";}?></label>
             <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                  
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['SpeechImpairedDescription'])))>0){ echo trim($ProfileInfo['SpeechImpairedDescription']); } else{ echo "N/A";}?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Height</label>                      
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Weight</label>                      
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Weight'])))>0){ echo trim($ProfileInfo['Weight']); } else{ echo "N/A";}?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Blood Group</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['BloodGroup'])))>0){ echo trim($ProfileInfo['BloodGroup']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Complexation</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Complexation'])))>0){ echo trim($ProfileInfo['Complexation']); } else{ echo "N/A";}?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Body Type</label>                    
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['BodyType'])))>0){ echo trim($ProfileInfo['BodyType']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Diet</label>                         
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Diet'])))>0){ echo trim($ProfileInfo['Diet']); } else{ echo "N/A";}?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Smoking Habit</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['SmokingHabit'])))>0){ echo trim($ProfileInfo['SmokingHabit']); } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Drinking Habit</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['DrinkingHabit'])))>0){ echo trim($ProfileInfo['DrinkingHabit']); } else{ echo "N/A";}?>  
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
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['DateofBirth'])))>0){ echo trim($ProfileInfo['DateofBirth']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Time Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['TimeOfBirth'])))>0){ echo trim($ProfileInfo['TimeOfBirth']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Place Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['PlaceOfBirth'])))>0){ echo trim($ProfileInfo['PlaceOfBirth']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star Name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['StarName'])))>0){ echo trim($ProfileInfo['StarName']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Rasi Name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['RasiName'])))>0){ echo trim($ProfileInfo['RasiName']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Lakanam</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Lakanam'])))>0){ echo trim($ProfileInfo['Lakanam']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Chevvai Dhosham</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['ChevvaiDhosham'])))>0){ echo trim($ProfileInfo['ChevvaiDhosham']); } else{ echo "N/A";}?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['AgeFrom'])))>0){ echo trim($ProfileInfo['AgeFrom']); } else{ echo "N/A";}?> &nbsp;&nbsp;to&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['AgeTo'])))>0){ echo trim($ProfileInfo['AgeTo']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Religion</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Religion'])))>0){ echo trim($ProfileInfo['Religion']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Caste</label>                        
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Caste'])))>0){ echo trim($ProfileInfo['Caste']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Marital Status</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MaritalStatus'])))>0){ echo trim($ProfileInfo['MaritalStatus']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Income Range</label>                
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['AnnualIncome'])))>0){ echo trim($ProfileInfo['AnnualIncome']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Education'])))>0){ echo trim($ProfileInfo['Education']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['EmployedAs'])))>0){ echo trim($ProfileInfo['EmployedAs']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Details'])))>0){ echo trim($ProfileInfo['Details']); } else{ echo "N/A";}?></label>
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
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['EmailID'])))>0){ echo trim($ProfileInfo['EmailID']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mobile Number</label>   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MobileNumber'])))>0){?><?php echo "+"; echo $ProfileInfo['MobileNumberCountryCode'];?>-<?php echo $ProfileInfo['MobileNumber'];?><?php  } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Whatsapp Number</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['WhatsappNumber'])))>0){?><?php echo "+"; echo $ProfileInfo['WhatsappCountryCode'];?>-<?php echo $ProfileInfo['WhatsappNumber'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">                                                                                
            <label class="col-sm-2 col-form-label">Address</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['AddressLine1'])))>0){ echo trim($ProfileInfo['AddressLine1']); } else{ echo "N/A";}?></label>
        </div>
        <?php if((strlen(trim($ProfileInfo['AddressLine2'])))>0){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <label class="col-sm-10 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine2'];?></label>
        </div>
        <?php }  if((strlen(trim($ProfileInfo['AddressLine3'])))>0){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>                          
            <label class="col-sm-10 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine3'];?></label>
        </div>
        <?php }?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Pincode</label>                     
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Pincode'])))>0){ echo trim($ProfileInfo['Pincode']); } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>                         
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['City'])))>0){ echo trim($ProfileInfo['City']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Other Location</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['OtherLocation'])))>0){ echo trim($ProfileInfo['OtherLocation']); } else{ echo "N/A";}?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">State</label>                      
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['State'])))>0){ echo trim($ProfileInfo['State']); } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Country</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Country'])))>0){ echo trim($ProfileInfo['Country']); } else{ echo "N/A";}?></label>
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
 
            
               
 
            
               