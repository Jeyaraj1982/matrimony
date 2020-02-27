<link rel="stylesheet" type="text/css" href="http://www.matrimony.dev.j2jsoftwaresolutions.com/website/assets/bridegroomslider/es-carousel.css" />
    <link rel="stylesheet" type="text/css" href="http://www.matrimony.dev.j2jsoftwaresolutions.com/website/assets/css/prettyphoto.css" />
<?php
    $response = $webservice->getData("Member","GetFullProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $IsDownload = $response['data']['IsDownload'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
     if ($response['status']=="success") {

?>
<style>
 .table-bordered > tbody > tr > td{width: 75px;height: 75px;text-align:center;}
 #doctable > tbody > tr > td{width: 75px;height: 33px;text-align: left;}
 #doctable {border-top: 2px solid #ddd;}
 .form-group {margin-bottom: 0px;}
 .photoview {
    margin-right:4px;
    margin-top: 10px;
    margin-bottom: 10px;
}
    fieldset {
  display: block;
  margin-left: 2px;
  margin-right: 2px;
  padding-top: 0.35em;
  padding-bottom: 0.625em;
  padding-left: 0.75em;
  padding-right: 0.75em;
  border: 1px groove;
  border-color: #ddd;
}
legend {
    margin-bottom: 0px;font-size: 12px;border-bottom: none;padding-left: 6px;
}
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
                
                "MyDownloaded"=>"MyContacts/MyDownloaded",
                "MyDownloaded_string"=>"back to viewed contacts",
                
                "WhoDownloaded"=>"MyContacts/WhoViewedMyContacts",
                "WhoDownloaded_string"=>"back to viewed contacts",
                
                "MyShortListed"=>"MyContacts/ShortListProfiles",
                "MyShortListed_string"=>"back to shortlisted profile",
                
                "WhoShortListed"=>"MyContacts/WhoShortListProfiles",
                "WhoShortListed_string"=>"back to who shortlisted my profile",
                
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
                            <?php echo strlen(trim($ProfileInfo['ProfileCode']))> 0 ? trim($ProfileInfo['ProfileCode']) : "N/A "; ?>&nbsp;&nbsp;|&nbsp;&nbsp;::ProfileCreatedBy::
							<?php if ( trim($ProfileInfo['ProfileFor'])=="Myself") { echo "Own"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother"){ echo "Brother"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister"){ echo "Sister"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter"){ echo "Mother"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Son"){ echo "Father"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister In Law"){ echo "Sister In Law"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother In Law"){ echo "Brother In Law"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Son In Law"){ echo "Uncle"; }?>
            <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter In Law"){ echo "Aunty"; }?>
                        </label>
                    </div>
            </div>
            <div class="col-sm-4"  style="text-align:right">
                 <?php
                  if (isset($pageLinks[$_GET['source']])) {
        ?>
       <!-- <a href="<?php //echo SiteUrl.$pageLinks[$_GET['source']]?>" class="btn btn-primary">ê&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $pageLinks[$_GET['source']."_string"];?></a> -->
            
        <?php } ?>
        <br><br>
        <form method="post" id="frmfrn">
        <input type="hidden" value="" name="ReportReason" id="ReportReason">
        <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ProfileCode" id="ProfileCode">
        <?php  if(sizeof($ProfileInfo['isShowPermission'])==0){ ?>
         <a href="<?php echo GetUrl("Profile/".$_GET['Code'].".htm");?>" data-toggle="tooltip" title="Print profile information" target="_blank"><i class="menu-icon mdi mdi-printer" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Print</label></a>&nbsp; 
         <a href="<?php echo GetUrl("Download/".$_GET['Code'].".pdf");?>" data-toggle="tooltip" title="Download profile information" target="_blank"><i class="menu-icon mdi mdi-download" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Download</label></a>&nbsp;    
        <?php } ?>
        <?php  if(sizeof($ProfileInfo['isReport'])==0){ ?>
         <a href="javascript:void(0)" onclick="GetReportResonForAbuse()" data-toggle="tooltip" title="Report abuse"><i class="menu-icon mdi mdi-flag-outline" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Report</label></a>&nbsp; 
       <?php } ?>
       <?php  if(sizeof($ProfileInfo['isHidePermission'])==0){ ?>
         <a href="javascript:void(0)" onclick="ConfirmHideMyProfile()" data-toggle="tooltip" title="Hide Profile"><label style="background:none;cursor:pointer">Hide</label></a>&nbsp; 
       <?php } ?>
       </form>        
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
                    <div style="border: 1px solid #ccc;padding: 0px;width: 292px;height: 378px;"> 
                    <div class="form-group row">                                                       
                        <div class="col-sm-12">
                            <div class="photoview" style="float:left;width: 290px;height:290px;margin:0px;">
                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                            </div>
                        </div> 
                    </div>
                    <div style="padding-left: 10px;padding-right: 10px;">
                      <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></div>
                        <div class="col-sm-10">
                        <?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                            <div class="photoview" style="float: left;text-align:center;">
                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;"><br>
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
                         <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MaritalStatus']);?></label> 
                    </div>
                     <?php if($ProfileInfo['MaritalStatusCode']!= "MST001"){?>
                        <?php if(trim($ProfileInfo['Children'])>0) {?>
                            <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if(trim($ProfileInfo['Children'])=="1") { echo "Child"; } else { echo "Children";} ?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?>&nbsp;&nbsp;
                                        <?php if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {
                                            if(trim($ProfileInfo['Children'])=="1") { echo "( Child with me )"; } else { echo "( Children with me )";} 
                                            } else { 
                                            if(trim($ProfileInfo['Children'])=="1") { echo "( Child not with me )"; } else { echo "( Children not with me )";} 
                                            }
                                        ?> 
                                    </label> 
                            </div>
                        <?php } else {    ?>
                        <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;">Children&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?></label>
                            </div>
                        <?php } ?>
                    <?php }?>
                     <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;">
                        <?php if($ProfileInfo['ReligionCode']== "RN009"){?>
                            <?php echo trim($ProfileInfo['OtherReligion']);?>
                        <?php } else { ?>
                             <?php echo trim($ProfileInfo['Religion']);?>  
                        <?php } ?> 
                    </label>
                    </div>
                   <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;">
                        <?php if($ProfileInfo['CasteCode']== "CSTN248"){?>
                            <?php echo trim($ProfileInfo['OtherCaste']);?>
                        <?php } else { ?>
                             <?php echo trim($ProfileInfo['Caste']);?>  
                        <?php } ?> 
                        <?php if((strlen(trim($ProfileInfo['SubCaste'])))>0){   ?>&nbsp;&nbsp; , &nbsp;&nbsp;
                        <?php      echo "Sub caste :"."&nbsp;" . trim($ProfileInfo['SubCaste']);    }   ?>
                    </label>
                    </div>
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
                    </div> 
              </div>
              </div>
         </div>
</div>
</div>
<?php  if(sizeof($ProfileInfo['isShowPermission'])==0){ ?>
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
 <?php if($Member['IsMobileVerified']==1 && $Member['IsEmailVerified']==1){?>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
     <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Education Details</h4></div>
            
         </div>
		 <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Education</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['mainEducation']))> 0 ? trim($ProfileInfo['mainEducation']) : "N/A "; ?></label>
        </div>
         <table class="table table-bordered" id="doctable">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                     <th>Education</th>
                    <th>Education details</th>
                    <th>Attachments</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left">
                        <?php if($Document['EducationDegree']== "Others"){?>
                            <?php echo trim($Document['OtherEducationDegree']);?>
                        <?php } else { ?>
                             <?php echo trim($Document['EducationDegree']);?>  
                        <?php } ?> 
                        <br><?php echo $Document['EducationDescription']; ?></td>
					<td>   
                        <?php if($Document['FileName']>0){ ?>
                            <?php echo $Document['IsVerified']== 1 ? "Attachment Verifiled" : "Attached "; ?> <br>
                            <a href="javascript:void(0)" onclick="DraftProfile.showAttachmentEducationInformationForView('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                        <?php } else { echo "Not Attach"; }?></td>
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
            <label class="col-sm-3 col-form-label">Employed as</label>                 
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></label>
        </div>
        <?php if($ProfileInfo['EmployedAsCode']=="O001"){ ?>
        <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Occupation type</label>              
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Occupation</label>                   
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['OccupationTypeCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['OtherOccupation']))> 0 ? trim($ProfileInfo['OtherOccupation']) : "N/A "; ?>
                <?php } else { echo $ProfileInfo['OccupationType']; } ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['OccupationDescription']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['OccupationDescription']) . "&nbsp;&nbsp;)"; }?>
            </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Annual income</label>                
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Working country</label>                      
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['WorkedCityName']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['WorkedCityName']) . "&nbsp;&nbsp;)"; }?>
            </label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Attachment</label>                      
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                <?php if($ProfileInfo['OccupationAttachFileName']==""){ echo "Not Attach";} else{ echo "Attached";?> &nbsp;&nbsp;
                (<a href="javascript:void(0)" onclick="DraftProfile.showAttachmentOccupationForView('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $ProfileInfo['MemberID'];?>','<?php echo $ProfileInfo['ProfileID'];?>','<?php echo $ProfileInfo['OccupationAttachFileName'];?>')">View</a>) <?php }?>
            </label>
        </div>
        <?php }?>
        <?php if(strlen(trim($ProfileInfo['OccupationDetails']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
                    <div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['OccupationDetails']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
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
            <label class="col-sm-3 col-form-label">Father's name</label>                
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersName']))> 0 ? trim($ProfileInfo['FathersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersAlive'])))>0){?><?php if($ProfileInfo['FathersAlive']=="1") { echo "(Passed away)" ;}?><?php } ?></label>
        </div>
        <?php if($ProfileInfo['FathersAlive']=="0"){?>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father's contact</label>            
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father's occupation</label>         
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['FathersOccupationCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['FatherOtherOccupation']))> 0 ? trim($ProfileInfo['FatherOtherOccupation']) : "N/A "; ?>
                <?php } else { echo strlen(trim($ProfileInfo['FathersOccupation']))> 0 ? trim($ProfileInfo['FathersOccupation']) : "N/A ";  } ?>
            </label>
        </div>
        <div class="form-group row">
            <?php if($ProfileInfo['FathersOccupationCode']!="OT107") {?>
            <label class="col-sm-3 col-form-label">Father's Income</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersIncome']))> 0 ? trim($ProfileInfo['FathersIncome']) : "N/A "; ?></label>
           <?php } ?>
        </div>                                                                         
        <?php }?>
        <div class="form-group row">                                                    
             <label class="col-sm-3 col-form-label">Mother's name</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersName']))> 0 ? trim($ProfileInfo['MothersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersAlive'])))>0){?><?php if($ProfileInfo['MothersAlive']=="1"){ echo "(Passed away)" ;}?><?php } ?> </label>
         </div>
         <?php if($ProfileInfo['MothersAlive']=="0"){?>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mother's contact</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>-<?php echo $ProfileInfo['MothersContact'];?><?php  } else{ echo "N/A";}?></label>
         </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Mother's occupation</label>         
              <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['MothersOccupationCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['MotherOtherOccupation']))> 0 ? trim($ProfileInfo['MotherOtherOccupation']) : "N/A "; ?>
                <?php } else { echo strlen(trim($ProfileInfo['MothersOccupation']))> 0 ? trim($ProfileInfo['MothersOccupation']) : "N/A "; } ?>
            </label>
        </div>
        <div class="form-group row">
            <?php if($ProfileInfo['MothersOccupationCode']!="OT107") {?>
             <label class="col-sm-3 col-form-label">Mother's income</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersIncome']))> 0 ? trim($ProfileInfo['MothersIncome']) : "N/A "; ?></label>
            <?php } ?>
        </div>
        <?php }?>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Family location</label>                 
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyLocation1']))> 0 ? trim($ProfileInfo['FamilyLocation1']) : "N/A "; ?></label>
        </div>
        <?php if(strlen(trim($ProfileInfo['FamilyLocation2']))> 0) {?>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label"></label>                 
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyLocation2']; ?></label>
        </div>
        <?php }?>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Family type</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyType']))> 0 ? trim($ProfileInfo['FamilyType']) : "N/A "; ?></label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Ancestral / origin</label>                 
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Ancestral']))> 0 ? trim($ProfileInfo['Ancestral']) : "N/A "; ?></label>
        </div>
        
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Family affluence</label>             
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyAffluence']))> 0 ? trim($ProfileInfo['FamilyAffluence']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">    
            <label class="col-sm-3 col-form-label">Family value</label>                
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyValue']))> 0 ? trim($ProfileInfo['FamilyValue']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Number of brothers</label>          
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofBrothers']))> 0 ? trim($ProfileInfo['NumberofBrothers']) : "N/A "; ?>
             </label>
             <?php if(trim($ProfileInfo['NumberofBrothers']) > 0){?>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Elder']))> 0 ? trim($ProfileInfo['Elder']) : "N/A "; ?> </label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Younger']))> 0 ? trim($ProfileInfo['Younger']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Married</label>                      
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Married']))> 0 ? trim($ProfileInfo['Married']) : "N/A "; ?></label>
            <?php } ?>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Number of sisters</label>           
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofSisters']))> 0 ? trim($ProfileInfo['NumberofSisters']) : "N/A "; ?></label>
             <?php if(trim($ProfileInfo['NumberofSisters']) > 0){?>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ElderSister']))> 0 ? trim($ProfileInfo['ElderSister']) : "N/A "; ?> </label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['YoungerSister']))> 0 ? trim($ProfileInfo['YoungerSister']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Married</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MarriedSister']))> 0 ? trim($ProfileInfo['MarriedSister']) : "N/A "; ?>  </label>
             <?php } ?>
        </div>
        <?php if(strlen(trim($ProfileInfo['AboutMyFamily']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
                    <div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['AboutMyFamily']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
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
            <label class="col-sm-3 col-form-label">Physically impaired?</label>         
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PhysicallyImpaired']))> 0 ? trim($ProfileInfo['PhysicallyImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['PhysicallyImpaireddescription']))> 0 ? trim($ProfileInfo['PhysicallyImpaireddescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Visually impaired?</label>         
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VisuallyImpaired']))> 0 ? trim($ProfileInfo['VisuallyImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['VisuallyImpairedDescription']))> 0 ? trim($ProfileInfo['VisuallyImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Vision impaired?</label>         
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VissionImpaired']))> 0 ? trim($ProfileInfo['VissionImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['VissionImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['VissionImpairedDescription']))> 0 ? trim($ProfileInfo['VissionImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Speech impaired?</label>         
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SpeechImpaired']))> 0 ? trim($ProfileInfo['SpeechImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['SpeechImpairedDescription']))> 0 ? trim($ProfileInfo['SpeechImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">                                                    
             <label class="col-sm-3 col-form-label">Height</label>                      
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Weight</label>                      
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Weight'])))>0){ echo trim($ProfileInfo['Weight']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Blood group</label>                 
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BloodGroup']))> 0 ? trim($ProfileInfo['BloodGroup']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">    
             <label class="col-sm-3 col-form-label">Complexation</label>                
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Complexation']))> 0 ? trim($ProfileInfo['Complexation']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Body type</label>                    
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BodyType']))> 0 ? trim($ProfileInfo['BodyType']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">     
             <label class="col-sm-3 col-form-label">Diet</label>                         
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Diet']))> 0 ? trim($ProfileInfo['Diet']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Smoking habit</label>               
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SmokingHabit']))> 0 ? trim($ProfileInfo['SmokingHabit']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">     
             <label class="col-sm-3 col-form-label">Drinking habit</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DrinkingHabit']))> 0 ? trim($ProfileInfo['DrinkingHabit']) : "N/A "; ?></label>
        </div>
        <?php if(strlen(trim($ProfileInfo['PhysicalDescription']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
                    <div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['PhysicalDescription']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
    </div>
  </div>
</div>
<?php if(sizeof($IsDownload)>0){?>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Date of birth</label>               
            <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; ?></label>
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
                    <td><?php echo $ProfileInfo['A16']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
  </div>
<?php } else{ ?>
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
                    Upgrade membership to unlock the horoscope details<br><br>
                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $ProfileInfo['ProfileCode'];?>')" class="btn btn-success">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>   
<?php } ?>                                                                                                            
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Partner's Expectations</h4></div>
         </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-3 col-form-label">Age </label>                       
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeFrom']))> 0 ? trim($PartnerExpectation['AgeFrom']) : "N/A "; ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeTo']))> 0 ? trim($PartnerExpectation['AgeTo']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Marital status</label>               
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['MaritalStatus']))> 0 ? trim($PartnerExpectation['MaritalStatus']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Religion</label>                     
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Religion']))> 0 ? trim($PartnerExpectation['Religion']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Caste</label>                        
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Caste']))> 0 ? trim($PartnerExpectation['Caste']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Education</label>                   
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Education']))> 0 ? trim($PartnerExpectation['Education']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employed as</label>                 
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['EmployedAs']))> 0 ? trim($PartnerExpectation['EmployedAs']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Income range</label>                
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AnnualIncome']))> 0 ? trim($PartnerExpectation['AnnualIncome']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Rasi name</label>                
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['RasiName']))> 0 ? trim($PartnerExpectation['RasiName']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Star name</label>                
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['StarName']))> 0 ? trim($PartnerExpectation['StarName']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Chevvai dhosham</label>                
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['ChevvaiDhosham']))> 0 ? trim($PartnerExpectation['ChevvaiDhosham']) : "N/A "; ?></label>
        </div>
         <?php if(strlen(trim($PartnerExpectation['Details']))> 0){ ?>
         <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width: 132px;">Additional information</legend>
                    <div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($PartnerExpectation['Details']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
    </div>
  </div>
</div>
<?php if(sizeof($IsDownload)>0){?>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
            
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
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A ";  ?></label>
        </div> 
        </div>
    </div>
  </div>
<?php } else{?>
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
                    Upgrade membership to unlock the contact details<br><br>
                     <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $ProfileInfo['ProfileCode'];?>')" class="btn btn-success">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div> 
  <?php } ?>
  <?php }  else { ?>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
       
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="<?php echo ImageUrl;?>lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                <?php if($Member['IsMobileVerified']==0 && $Member['IsEmailVerified']==0){?>
                    If you want know the full details please verify your mobile number and email id<br>
                <?php } ?>
                <?php if($Member['IsMobileVerified']==0 && $Member['IsEmailVerified']==1){?>
                    If you want know the full details please verify your mobile number<br>
                <?php } ?>
                <?php if($Member['IsMobileVerified']==1 && $Member['IsEmailVerified']==0){?>
                    If you want know the full details please verify your email id<br>
                <?php } ?>
                     
                </div>
            </div>
         </div>
    </div>
  </div>
  <?php } ?>
  <?php } else { ?>
  <div class="col-12 grid-margin">                                                     
    <div class="card">
        <div class="card-body">
              <div class="form-group row">
                <span>Your not authenticated to view this profile</span>
              </div>
        </div>
    </div>
  </div>
  <?php } ?>
</div>
 
  <div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog">
                <div class="modal-content" id="DeleteNow_body" style="height:260px">
            
                </div>
            </div>
        </div>
        <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
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
function GetReportResonForAbuse() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Report</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + 'Report Reason<br>'
                                        + '<textarea class="form-control" rows="2" cols="3" id="ReportReasonFrAbuse"></textarea>'
                                        +'<div class="col-sm-12" id="frmReportReason_error" style="color:red;text-align:center"></div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>' 
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="SentReportForAbuse()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     } 
function SentReportForAbuse() {                           
     if ($("#ReportReasonFrAbuse").val().trim()=="") {
         $("#frmReportReason_error").html("Please enter reason for report");
         return false;
     }
    $("#ReportReason").val($("#ReportReasonFrAbuse").val());   
    var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Member&a=SentReportForAbuse",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">'+ obj.message+'</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Report</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
    }
    function ConfirmHideMyProfile() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for hide profile</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8">'
                                        + '<div style="text-align:left">Are you sure want to hide?<br><br></div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>' 
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="HideMyProfileDetails()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     }    
    function HideMyProfileDetails() {                           
    var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Member&a=HideMyProfileDetails",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">'+ obj.message+'</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Hide Profile</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
    }                              
</script>

<?php } else {  
   echo HtmlDesign::InformationNotFound($response['message']);
  } ?>
  
  <script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
          