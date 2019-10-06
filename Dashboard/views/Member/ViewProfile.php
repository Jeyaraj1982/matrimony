<?php
    $response = $webservice->getData("Member","GetFullProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
?>
<style>
 .table-bordered > tbody > tr > td{width: 75px;height: 75px;text-align:center;}
 #doctable > tbody > tr > td{width: 75px;height: 33px;text-align: left;}
 #doctable {border-top: 2px solid #ddd;}
 .form-group {margin-bottom: 0px;}
 .photoview {float: right;margin:5px;}
 </style>
        <?php
            $pageLinks=array(
                
                "MyRecentViewed"=>"MyContacts/MyRecentViewed",
                "MyRecentViewed_string"=>"back to my recently viewed profile",
            
                "RecentlyWhoViewed"=>"MyContacts/RecentlyWhoViewed",
                "RecentlyWhoViewed_string"=>"back to who viewed my profile",
                
                "MyFavorited"=>"MyContacts/MyFavorited",
                "MyFavorited_string"=>"back to my favorited profile",
                
                "RecentlyWhoFavorited"=>"MyContacts/RecentlyWhofavourited",
                "RecentlyWhoFavorited_string"=>"back to who favorited my profile",
                
                "Mutual"=>"MyContacts/MutualProfiles",
                "Mutual_string"=>"back to mutual profile",
                
                "BrowseMatches"=>"Matches/Browse/BrowseMatches",
                "DashboardLatestUpdatesView"=>"../Dashboard",
                "MyDownloaded"=>"MyContacts/MyDownloaded",
                );
           ?> 
           <div style="width:800px">
<div class="col-12 grid-margin" style="margin-bottom:5px">
    <div class="card" style="background: none;">
        <div class="card-body" style="padding: 0px;background: none;">
            <div class="form-group row" style="background: none;">  
                <div class="col-sm-8 col-form-label" style="background: none;">
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="background: none;color: #222;font-size:24px;font-weight:bold;">
                        <?php echo strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A "; ?>
                        &nbsp;(<?php if((strlen(trim($ProfileInfo['Age'])))>0) { echo trim($ProfileInfo['Age']); ?> Yrs<?php }?>)
                        </label>
                        <label class="col-sm-12 col-form-label" style="background: none;color: #333;font-size: 14px;padding: 0px 16px;color: #666;">
                            <?php echo strlen(trim($ProfileInfo['ProfileCode']))> 0 ? trim($ProfileInfo['ProfileCode']) : "N/A "; ?>&nbsp;&nbsp;|&nbsp;&nbsp;::ProfileCreatedFor::
                        </label>
                    </div>
            </div>
            <div class="col-sm-4"  style="text-align:right">
                 <?php
                  if (isset($pageLinks[$_GET['source']])) {
        ?>
        <a href="<?php echo SiteUrl.$pageLinks[$_GET['source']]?>" class="btn btn-primary">ê&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pageLinks[$_GET['source']."_string"];?></a>
            
        <?php } ?>
        <br><br>
         <i class="menu-icon mdi mdi-printer" style="font-size: 15px;color: purple;"></i>&nbsp;<label style="background:none">Print</label> 
                 <i class="menu-icon mdi mdi-download" style="font-size: 15px;color: purple;"></i>&nbsp;<label style="background:none">Download</label>   
               
            </div>
        </div>
  </div>
</div>
</div>
<div class="col-12 grid-margin">                                                     
    <div class="card">
        <div class="card-body">
              <div class="form-group row">
                <div class="col-sm-5">
                    <div style="border: 1px solid #ccc;padding: 0px;width: 291px;height: 378px;"> 
                    <div class="form-group row">                                                       
                        <div class="col-sm-12">
                            <div class="photoview" style="float:left;width: 290px;height:290px;margin:0px;">
                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                            </div>
                        </div> 
                    </div>
                    <div style="padding-left:3px;padding-right: 10px;margin-top:7px">
                      <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></div>
                        <div class="col-sm-10" style="padding-left:8px;padding-right:5px;">
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
              <div class="col-sm-12">
                  <div class="form-group row">
                    <div class="col-sm-6">
                  <div style="text-align:left;">
                        <?php $rnd = rand(3000,3000000);  if ($ProfileInfo['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $ProfileInfo['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;                                     ">  
                                            <?php } else if ($ProfileInfo['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>  
                   <div style="height: 20px;margin-right: -33px;line-height:12px;font-size: 11px;"><span style="color:#999 !important;">
                            <?php if ($ProfileInfo['LastLogin']!=0) { ?> 
                            My last Login&nbsp;<?php echo time_elapsed_string($ProfileInfo['LastLogin']); } ?><br>
                            <?php if ($ProfileInfo['LastSeen']!=0) { ?> 
                            My last visited&nbsp;<?php echo time_elapsed_string($ProfileInfo['LastSeen']);?>
                            <?php } else { ?>
                            You favourited, but not view this profile.
                            <?php } ?>
                             <br />
                             <?php if($ProfileInfo['isMutured']==1) {?>
                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<?php echo $ProfileInfo['Sex']=="Male" ? "He " : "She "; ?>liked on <?php echo time_elapsed_string($ProfileInfo['MuturedOn']);?>
                             <?php }?>
                            </span></div> 
                   </div>
                   <div class="col-sm-6">
                    <div style="text-align:right">
                        <a onclick="SendToInterest('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" class="btn btn-danger" style="background-color: orange;border-color: orange;padding-top: 0px;padding-bottom: 2px;color:white"><i class="menu-icon mdi mdi-heart"></i>&nbsp;Send Interest</a>
                    </div>
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
     <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">
            <?php if ( trim($ProfileInfo['ProfileFor'])=="Myself") { echo "About Myself"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother"){ echo "About My Brother"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister"){ echo "About My Sister"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter"){ echo "About My Daughter"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Son"){ echo "About My Son"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister In Law"){ echo "About My Sister In Law"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother In Law"){ echo "About My Brother In Law"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Son In Law"){ echo "About My Son In Law"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter In Law"){ echo "About My Daughter In Law"; }?>
             </h4></div>
            
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
            
         </div>
         <table class="table table-bordered" id="doctable">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                     <th>Descriptions</th>
                    <th>Attachments</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationDegree'];?><BR><?php echo $Document['EducationRemarks'];?></td> 
                    <td style="text-align:left"><?php echo $Document['EducationDescription']; ?></td>
                    <td style="text-align:left">
                        <?php if($Document['FileName']>0){ ?>
                          <?php  if($Document['IsVerified']==1) { echo "Attachment Verifiled"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php } else { echo "Attached"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php }?>
                         <?php } else { echo "Not Attached";?>
                        <?php }?>
                    </td>
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
            <label class="col-sm-2 col-form-label">Attachment</label>                      
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['OccupationAttachFileName']> 0 ? "Attached" : "Not Attache"; ?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Family Information</h4></div>
            
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
             <label class="col-sm-2 col-form-label">Brothers</label>          
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
             <label class="col-sm-2 col-form-label">Sisters</label>           
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
<!--  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Date of birth</label>               
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php /* echo strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Time Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php // echo strlen(trim($ProfileInfo['TimeOfBirth']))> 0 ? trim($ProfileInfo['TimeOfBirth']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Place Of Birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php // echo strlen(trim($ProfileInfo['PlaceOfBirth']))> 0 ? trim($ProfileInfo['PlaceOfBirth']) : "N/A "; ?></label>
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
                    <td><?php echo $ProfileInfo['A16']; */?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
  </div> -->
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            
         </div>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="<?php echo ImageUrl;?>lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the horoscope details<br>
                    <a href="#" class="btn btn-success">UPGRADE BUTTON</a><br><br> 
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
<!--<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
            
         </div>
        <div class="form-group row">                                                   
            <label class="col-sm-2 col-form-label">Email ID</label>                    
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php /* echo strlen(trim($ProfileInfo['EmailID']))> 0 ? trim($ProfileInfo['EmailID']) : "N/A "; ?></label>
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A "; */ ?></label>
        </div> 
        </div>
    </div>
  </div>-->
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication details</h4></div>
         </div>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="<?php echo ImageUrl;?>lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the contact details<br>
                     <a href="#" class="btn btn-success">UPGRADE BUTTON</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div> 
</div>
 <div style="width:400px">
 <?php if($_GET['source']=="MyRecentViewed"){?>
<div class="member_dashboard_widget_title">My Recently Viewed</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <?php 
                    $myrecentviewed = $webservice->getData("Member","GetRecentlyViewedProfiles",array("requestfrom"=>"0","requestto"=>"10"));
                    $MyRecentlyViewed = $myrecentviewed['data'];
                 ?>
                    <?php if (sizeof($MyRecentlyViewed)>0) { ?>
                <div>
                    <?php
                     foreach($MyRecentlyViewed as $Profile) { 
                         if ($Profile['ProfileInfo']['ProfileCode']!=$_GET['Code']) {
                            echo dashboard_view_2($Profile);      
                         }
                    }?> 
                </div>
                <?php if (sizeof($MyRecentlyViewed)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MyRecentViewed">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php }?>

<?php if($_GET['source']=="RecentlyWhoViewed"){?>
<div class="member_dashboard_widget_title">Who viewed your profile</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <?php 
                    $whoviewed = $webservice->getData("Member","GetRecentlyWhoViewedProfiles",array("requestfrom"=>"0","requestto"=>"10"));
                    $WhoViewedYourProfile = $whoviewed['data']; 
                 ?>
                    <?php if (sizeof($WhoViewedYourProfile)>0) { ?>
                <div>
                    <?php
                     foreach($WhoViewedYourProfile as $Profile) { 
                         if ($Profile['ProfileInfo']['ProfileCode']!=$_GET['Code']) {
                            echo dashboard_view_2($Profile);      
                         }
                    }?> 
                </div>
                <?php if (sizeof($WhoViewedYourProfile)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/RecentlyWhoViewed">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php }?>

<?php if($_GET['source']=="MyFavorited"){?>
<div class="member_dashboard_widget_title">My Favourited</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <?php 
                    $myfavorited = $webservice->getData("Member","GetFavouritedProfiles",array("requestfrom"=>"0","requestto"=>"10"));
                    $MyFavouritedProfiles = $myfavorited['data'];
                 ?>
                    <?php if (sizeof($MyFavouritedProfiles)>0) { ?>
                <div>
                    <?php
                     foreach($MyFavouritedProfiles as $Profile) { 
                         if ($Profile['ProfileInfo']['ProfileCode']!=$_GET['Code']) {
                            echo dashboard_view_2($Profile);      
                         }
                    }?> 
                </div>
                <?php if (sizeof($MyFavouritedProfiles)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                             <a href="<?php echo SiteUrl;?>MyContacts/MyFavorited">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php }?>
<?php if($_GET['source']=="RecentlyWhoFavorited"){?>
<div class="member_dashboard_widget_title">Who favorited your profile</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <?php 
                    $whofavorited = $webservice->getData("Member","GetWhoFavouriteMyProfiles",array("requestfrom"=>"0","requestto"=>"10"));
                    $WhoFavoritedYourProfiles = $whofavorited['data']; 
                 ?>
                    <?php if (sizeof($WhoFavoritedYourProfiles)>0) { ?>
                <div>
                    <?php
                     foreach($WhoFavoritedYourProfiles as $Profile) { 
                         if ($Profile['ProfileInfo']['ProfileCode']!=$_GET['Code']) {
                            echo dashboard_view_2($Profile);      
                         }
                    }?> 
                </div>
                <?php if (sizeof($WhoFavoritedYourProfiles)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                             <a href="<?php echo SiteUrl;?>RecentlyWhofavourited/MutualProfiles">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php }?>
<?php if($_GET['source']=="Mutual"){?>
<div class="member_dashboard_widget_title">Mutual Profile</div>
            <div class="card"  style="background:#dee9ea;">
                <div class="card-body" style="padding:10px !important;">
                <?php 
                    $mutualprofile = $webservice->getData("Member","GetMutualProfiles",array("requestfrom"=>"0","requestto"=>"10"));
                    $MutualProfiles = $mutualprofile['data']; 
                 ?>
                    <?php if (sizeof($MutualProfiles)>0) { ?>
                <div>
                    <?php
                     foreach($MutualProfiles as $Profile) { 
                         if ($Profile['ProfileInfo']['ProfileCode']!=$_GET['Code']) {
                            echo dashboard_view_2($Profile);      
                         }
                    }?> 
                </div>
                <?php if (sizeof($MutualProfiles)>=4) { ?>
                <div style="clear:both;padding:3px;text-align:center;">
                            <a href="<?php echo SiteUrl;?>MyContacts/MutualProfiles">View All</a>
                         </div>
                <?php } ?>
                 <?php } else { ?>
                    <div class="col-sm-12" id="resCon_a001" style="background:white;height: 443px;">
                        <div style="text-align:center;">
                            <h5 style="margin-top: 197px;color: #aaa;">No Profiles Found </h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php }?>
</div>
  <div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog">
                <div class="modal-content" id="DeleteNow_body" style="height:260px">
            
                </div>
            </div>
        </div>
<script>
function ViewAttchment(AttachmentID,ProfileID,FileName) {
      $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Education Attachment</h4> <br>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
}                                                  
</script>