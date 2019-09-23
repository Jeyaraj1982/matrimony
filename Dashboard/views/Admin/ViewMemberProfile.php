 <?php  
$response = $webservice->getData("Admin","GetPublishProfileInfo",array("ProfileCode"=>$_GET['Code']));   
     $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
?>
<?php                   
  if (isset($_POST['addtolandingpage'])) {         
    $response = $webservice->getData("Admin","AddToLandingPage",array("ProfileCode"=>$_GET['Code'])); 
    if ($response['status']=="success") {
         $successmessage=$response['message'];
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
<form method="post" action="" >
<div class="col-12 grid-margin">
  <div class="card">                                                                                                               
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-10 col-form-label"></label>
            <div class="col-sm-2">
                <i class="menu-icon mdi mdi-printer" style="font-size: 26px;color: purple;"></i>&nbsp;&nbsp; <label>Print</label> 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-10 col-form-label"></label>
                <div class="col-sm-2">
                    <i class="menu-icon mdi mdi-download" style="font-size: 26px;color: purple;"></i>&nbsp;&nbsp; <label>Download</label>   
                </div>
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
                        <label class="col-sm-12 col-form-label" style="color: #1e1e1e;font-size: 17px;"><?php echo strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A "; ?>&nbsp;<?php if((strlen(trim($ProfileInfo['Age'])))>0){ echo trim($ProfileInfo['Age']); ?>&nbsp;&nbsp;&nbsp;yrs ,<?php }?>&nbsp;</label>
                    </div>
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php }?></label>
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
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['City'])))>0){ echo trim($ProfileInfo['City']);?>,&nbsp;&nbsp;<?php }?><?php if((strlen(trim($ProfileInfo['State'])))>0){ echo trim($ProfileInfo['State']);?>,&nbsp;&nbsp;<?php }?><?php echo trim($ProfileInfo['Country']);?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Annual Income</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Occupation</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['OccupationType']))> 0 ? trim($ProfileInfo['OccupationType']) : "N/A "; ?></label>
            <label  class="col-sm-2 col-form-label">Occupation Type</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?>
             </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country</label>                      
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; ?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersName']))> 0 ? trim($ProfileInfo['FathersName']) : "N/A "; ?></label>
                                                                                        
            <label class="col-sm-2 col-form-label">Father's Status</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersAlive'])))>0){?><?php if($ProfileInfo['FathersAlive']=="0"){ echo "Yes";}else { echo "Passed away" ;}?><?php } else{ echo "N/A";}?> </label> 
        </div>
        <?php if($ProfileInfo['FathersAlive']=="0"){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's Occupation</label>         
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersOccupation']))> 0 ? trim($ProfileInfo['FathersOccupation']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Father's Income</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersIncome']))> 0 ? trim($ProfileInfo['FathersIncome']) : "N/A "; ?></label>
        </div>                                                                         
        <?php }?>
        <div class="form-group row">                                                    
             <label class="col-sm-2 col-form-label">Mother's Name</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersName']))> 0 ? trim($ProfileInfo['MothersName']) : "N/A "; ?> </label>
             <label class="col-sm-2 col-form-label">Mother's Status</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersAlive'])))>0){?><?php if($ProfileInfo['MothersAlive']=="0"){ echo "Yes";}else { echo "Passed away" ;}?><?php } else{ echo "N/A";}?></label>
         </div>
         <?php if($ProfileInfo['MothersAlive']=="0"){?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's Occupation</label>         
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersOccupation']))> 0 ? trim($ProfileInfo['MothersOccupation']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Mother's Income</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersIncome']))> 0 ? trim($ProfileInfo['MothersIncome']) : "N/A "; ?></label>
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
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyType']))> 0 ? trim($ProfileInfo['FamilyType']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Family Affluence</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyAffluence']))> 0 ? trim($ProfileInfo['FamilyAffluence']) : "N/A "; ?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family Value</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyValue']))> 0 ? trim($ProfileInfo['FamilyValue']) : "N/A "; ?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Brothers</label>          
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofBrothers']))> 0 ? trim($ProfileInfo['NumberofBrothers']) : "N/A "; ?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Elder']))> 0 ? trim($ProfileInfo['Elder']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Younger']))> 0 ? trim($ProfileInfo['Younger']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>                      
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Married']))> 0 ? trim($ProfileInfo['Married']) : "N/A "; ?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number Of Sisters</label>           
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofSisters']))> 0 ? trim($ProfileInfo['NumberofSisters']) : "N/A "; ?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ElderSister']))> 0 ? trim($ProfileInfo['ElderSister']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['YoungerSister']))> 0 ? trim($ProfileInfo['YoungerSister']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MarriedSister']))> 0 ? trim($ProfileInfo['MarriedSister']) : "N/A "; ?>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PhysicallyImpaired']))> 0 ? trim($ProfileInfo['PhysicallyImpaired']) : "N/A "; ?></label>
            <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PhysicallyImpaireddescription']))> 0 ? trim($ProfileInfo['PhysicallyImpaireddescription']) : "N/A "; ?></label>
            <?php }?>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Visually Impaired?</label>          
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VisuallyImpaired']))> 0 ? trim($ProfileInfo['VisuallyImpaired']) : "N/A "; ?></label>
            <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VisuallyImpairedDescription']))> 0 ? trim($ProfileInfo['VisuallyImpairedDescription']) : "N/A "; ?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Vission Impaired?</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VissionImpaired']))> 0 ? trim($ProfileInfo['VissionImpaired']) : "N/A "; ?> </label>
             <?php if($ProfileInfo['VissionImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VissionImpairedDescription']))> 0 ? trim($ProfileInfo['VissionImpairedDescription']) : "N/A "; ?></label>
            <?php }?>
         </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Speech Impaired?</label>            
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SpeechImpaired']))> 0 ? trim($ProfileInfo['SpeechImpaired']) : "N/A "; ?></label>
             <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>                  
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SpeechImpairedDescription']))> 0 ? trim($ProfileInfo['SpeechImpairedDescription']) : "N/A "; ?></label>
            <?php }?>
        </div>
        <div class="form-group row">                                                    
             <label class="col-sm-2 col-form-label">Height</label>                      
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?>
             </label>
             <label class="col-sm-2 col-form-label">Weight</label>                      
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Weight'])))>0){ echo trim($ProfileInfo['Weight']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Blood Group</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BloodGroup']))> 0 ? trim($ProfileInfo['BloodGroup']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Complexation</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Complexation']))> 0 ? trim($ProfileInfo['Complexation']) : "N/A "; ?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Body Type</label>                    
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BodyType']))> 0 ? trim($ProfileInfo['BodyType']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Diet</label>                         
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Diet']))> 0 ? trim($ProfileInfo['Diet']) : "N/A "; ?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Smoking Habit</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SmokingHabit']))> 0 ? trim($ProfileInfo['SmokingHabit']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Drinking Habit</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DrinkingHabit']))> 0 ? trim($ProfileInfo['DrinkingHabit']) : "N/A "; ?>  
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
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Time Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TimeOfBirth']))> 0 ? trim($ProfileInfo['TimeOfBirth']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Place Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PlaceOfBirth']))> 0 ? trim($ProfileInfo['PlaceOfBirth']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star Name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['StarName']))> 0 ? trim($ProfileInfo['StarName']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Rasi Name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['RasiName']))> 0 ? trim($ProfileInfo['RasiName']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Lakanam</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Lakanam']))> 0 ? trim($ProfileInfo['Lakanam']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Chevvai Dhosham</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ChevvaiDhosham']))> 0 ? trim($ProfileInfo['ChevvaiDhosham']) : "N/A "; ?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AgeFrom']))> 0 ? trim($ProfileInfo['AgeFrom']) : "N/A "; ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AgeTo']))> 0 ? trim($ProfileInfo['AgeTo']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Religion</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Religion']))> 0 ? trim($ProfileInfo['Religion']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Caste</label>                        
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Caste']))> 0 ? trim($ProfileInfo['Caste']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Marital Status</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MaritalStatus']))> 0 ? trim($ProfileInfo['MaritalStatus']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Income Range</label>                
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Education']))> 0 ? trim($ProfileInfo['Education']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed As</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Expectation</label>                  
            <div class="col-sm-12 col-form-label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Details']))> 0 ? trim($ProfileInfo['Details']) : "N/A "; ?></div></div>
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
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmailID']))> 0 ? trim($ProfileInfo['EmailID']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mobile Number</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MobileNumber'])))>0){?><?php echo "+"; echo $ProfileInfo['MobileNumberCountryCode'];?>-<?php echo $ProfileInfo['MobileNumber'];?><?php  } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Whatsapp Number</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['WhatsappNumber'])))>0){?><?php echo "+"; echo $ProfileInfo['WhatsappCountryCode'];?>-<?php echo $ProfileInfo['WhatsappNumber'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">                                                                                
            <label class="col-sm-2 col-form-label">Address</label>                      
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AddressLine1']))> 0 ? trim($ProfileInfo['AddressLine1']) : "N/A "; ?> </label>
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
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Pincode']))> 0 ? trim($ProfileInfo['Pincode']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>                         
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['City']))> 0 ? trim($ProfileInfo['City']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Other Location</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['OtherLocation']))> 0 ? trim($ProfileInfo['OtherLocation']) : "N/A "; ?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">State</label>                       
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['State']))> 0 ? trim($ProfileInfo['State']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Country</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A "; ?></label>
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
                    <label class="col-sm-8 col-form-label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></label>
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
<div class="form-group row">
    <div class="col-sm-12">
        <div class="col-sm-6"> <a href="javascript:void(0)" onclick="showAddToLandingPage('<?php echo $_GET['Code'];?>')" name="addtolandingpage" class="btn btn-success">Add To Landing Page</a></div>
    </div>
</div>
</form>
   <div class="modal" id="PubplishNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Publish_body" style="height:376px">
            
                </div>
            </div>
        </div>
                                                                       
<script>
function showAddToLandingPage(ProfileCode) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+ProfileCode+'" name="frm_'+ProfileCode+'" action="" >'
                     + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                      +  '<div style="text-align:center">Profile Add To Landing Page<br><br>'
                        + '<button type="button" class="close" data-dismiss="modal" style="margin-top: -40px;margin-right: 0px;">&times;</button>'
                        +'<div class="form-group row">'
                            +'<div class="col-sm-3">From </div>'
                            +'<div class="col-sm-2"><select class="form-control" id="date" name="date" style="width:58px;">'
                            +'<option value="1">1</option>'
                            +'<option value="2">2</option>'
                            +'<option value="3">3</option>'
                            +'<option value="4">4</option>'
                            +'<option value="5">5</option>'
                            +'<option value="6">6</option>'
                            +'<option value="7">7</option>'
                            +'<option value="8">8</option>'                                                 
                            +'<option value="9">9</option>'
                            +'<option value="10">10</option>'
                            +'<option value="11">11</option>'
                            +'<option value="12">12</option>'
                            +'<option value="13">13</option>'
                            +'<option value="14">14</option>'
                            +'<option value="15">15</option>'
                            +'<option value="16">16</option>'
                            +'<option value="17">17</option>'
                            +'<option value="18">18</option>'
                            +'<option value="19">19</option>'
                            +'<option value="20">20</option>'
                            +'<option value="21">21</option>'
                            +'<option value="22">22</option>'
                            +'<option value="23">23</option>'
                            +'<option value="24">24</option>'
                            +'<option value="25">25</option>'
                            +'<option value="26">26</option>'
                            +'<option value="27">27</option>'
                            +'<option value="28">28</option>'
                            +'<option value="29">29</option>'
                            +'<option value="30">30</option>'
                            +'<option value="31">31</option>'
                            +'</select></div>'
                        +'<div class="col-sm-3" style="margin-right: -12px;"><select class="form-control" id="month" name="month" style="width:75px;">'
                            +'<option value="1">Jan</option>'
                            +'<option value="2">Feb</option>'
                            +'<option value="3">Mar</option>'
                            +'<option value="4">Apr</option>'
                            +'<option value="5">May</option>'
                            +'<option value="6">Jun</option>'
                            +'<option value="7">Jul</option>'
                            +'<option value="8">Aug</option>'                                                 
                            +'<option value="9">Sep</option>'
                            +'<option value="10">Oct</option>'
                            +'<option value="11">Nov</option>'
                            +'<option value="12">Dec</option>'
                            +'</select></div>'
                        +'<div class="col-sm-3"><select class="form-control" id="year" name="year" style="width:75px">'
                            +'<option value="2019">2019</option>'
                            +'<option value="2020">2020</option>'
                            +'<option value="2021">2021</option>'
                            +'<option value="2022">2022</option>'
                            +'</select></div>'
                        +'</div><br>'
                         +'<div class="form-group row">'
                            +'<div class="col-sm-3">To </div>'
                            +'<div class="col-sm-2"><select class="form-control" id="todate" name="todate" style="width:58px;">'
                            +'<option value="1">1</option>'
                            +'<option value="2">2</option>'
                            +'<option value="3">3</option>'
                            +'<option value="4">4</option>'
                            +'<option value="5">5</option>'
                            +'<option value="6">6</option>'
                            +'<option value="7">7</option>'
                            +'<option value="8">8</option>'                                                 
                            +'<option value="9">9</option>'
                             +'<option value="10">10</option>'
                            +'<option value="11">11</option>'
                            +'<option value="12">12</option>'
                            +'<option value="13">13</option>'
                            +'<option value="14">14</option>'
                            +'<option value="15">15</option>'
                            +'<option value="16">16</option>'
                            +'<option value="17">17</option>'
                            +'<option value="18">18</option>'
                            +'<option value="19">19</option>'
                            +'<option value="20">20</option>'
                            +'<option value="21">21</option>'
                            +'<option value="22">22</option>'
                            +'<option value="23">23</option>'
                            +'<option value="24">24</option>'
                            +'<option value="25">25</option>'
                            +'<option value="26">26</option>'
                            +'<option value="27">27</option>'
                            +'<option value="28">28</option>'
                            +'<option value="29">29</option>'
                            +'<option value="30">30</option>'
                            +'<option value="31">31</option>'
                            +'</select></div>'
                        +'<div class="col-sm-3" style="margin-right: -12px;"><select class="form-control" id="tomonth" name="tomonth" style="width:75px;">'
                            +'<option value="1">Jan</option>'
                            +'<option value="2">Feb</option>'
                            +'<option value="3">Mar</option>'
                            +'<option value="4">Apr</option>'
                            +'<option value="5">May</option>'
                            +'<option value="6">Jun</option>'
                            +'<option value="7">Jul</option>'
                            +'<option value="8">Aug</option>'                                                 
                            +'<option value="9">Sep</option>'
                            +'<option value="10">Oct</option>'
                            +'<option value="11">Nov</option>'
                            +'<option value="12">Dec</option>'
                            +'</select></div>'
                        +'<div class="col-sm-3"><select class="form-control" id="toyear" name="toyear" style="width:75px">'
                            +'<option value="2019">2019</option>'
                            +'<option value="2020">2020</option>'
                            +'<option value="2021">2021</option>'
                            +'<option value="2022">2022</option>'
                            +'</select></div>'
                        +'</div><br>'
                        +'<div class="form-group row">'
                        +'<div class="col-sm-3">Is Show </div>'
                         +'<div class="col-sm-3"><select class="form-control" id="IsShow" name="IsShow" style="width:75px">'
                            +'<option value="1">Yes</option>'
                            +'<option value="0">No</option>'
                            +'</select></div>'
                        +'</div><br>'
                        +'<div class="form-group row">'
                        +'<div class="col-sm-3">Show Contact Details</div>'
                         +'<div class="col-sm-3"><select class="form-control" id="ShowCommunicationDetails" name="ShowCommunicationDetails" style="width:75px">'
                            +'<option value="1">Yes</option>'
                            +'<option value="0">No</option>'
                            +'</select></div>'
                       +'<div class="col-sm-3">Show Horoscope Details</div>'
                         +'<div class="col-sm-3"><select class="form-control" id="ShowHoroscopeDetails" name="ShowHoroscopeDetails" style="width:75px">'
                            +'<option value="1">Yes</option>'
                            +'<option value="0">No</option>'
                            +'</select></div>'
                        +'</div><br>'
                        +  '<button type="button" class="btn btn-primary" name="Publish"  onclick="AddToLandingPage(\''+ProfileCode+'\')">Submit</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No, i will do later</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'                                                   
            +  '</div>';                                                  
            $('#Publish_body').html(content);
}
function AddToLandingPage(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Admin&a=AddToLandingPage",param,function(result2) {$('#Publish_body').html(result2);});
}

</script>