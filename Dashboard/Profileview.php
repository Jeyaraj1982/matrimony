<?php 
    include_once("config.php");
    $response = $webservice->getData("Member","GetFullProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo         = $response['data']['ProfileInfo'];
    $Member              = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation  = $response['data']['PartnerExpectation'];
?>

    
  <div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
<div class="col-12 grid-margin" style="margin-bottom:5px">
    <div class="card" style="background: none;">
        <div class="card-body" style="padding: 0px;background: none;">
            <div class="form-group row" style="background: none;">  
                <div class="col-sm-8 col-form-label" style="background: none;">
                    <div class="form-group row" >                                       
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
        <a href="<?php echo SiteUrl.$pageLinks[$_GET['source']]?>" class="btn btn-primary">?&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pageLinks[$_GET['source']."_string"];?></a>
            
        <?php } ?>
        <br><br>
         <!--<i class="menu-icon mdi mdi-printer" style="font-size: 15px;color: purple;"></i>&nbsp;<label style="background:none">Print</label> 
                 <i class="menu-icon mdi mdi-download" style="font-size: 15px;color: purple;"></i>&nbsp;<label style="background:none">Download</label> -->  
               
            </div>
        </div>
  </div>
</div>
</div>
<div class="col-12 grid-margin" style="margin-bottom: 25px;">                                                     
    <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
        <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <table style="width:100%;" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <div style="border: 1px solid #ccc;padding: 0px;width: 292px;height: 378px;"> 
                            <div class="form-group row">                                                       
                                <div class="col-sm-12">
                                    <div class="photoview" style="float:left;width: 290px;height:290px;margin:0px;">
                                        <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                                    </div>
                                </div> 
                            </div>
                            <div style="padding-left:3px;padding-right: 10px;margin-top:7px">
                            <table>
                                <tr>
                                    <td><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></td>
                                    <td><?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                                            <div class="photoview" style="float: left;margin-left:3px;">
                                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;">
                                            </div>
                                        <?php }?>
                                    </td>
                                    <td><img src="<?php echo SiteUrl?>assets/images/rightarrow.jpg" style="width:30px"></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </td>
                    <td style="color:#737373;vertical-align: top;"> 
                        <table style="width:100%;color: #555;" cellpadding="3" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td><?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php }?></td>
                                </tr>
                                <tr>
                                    <td><?php echo trim($ProfileInfo['MaritalStatus']);?></td>
                                </tr>
                                <?php if($ProfileInfo['MaritalStatusCode']!= "MST001"){?> 
                                    <?php if(trim($ProfileInfo['Children'])>0) {?>
                                        <tr>
                                            <td>
                                            <?php if(trim($ProfileInfo['Children'])=="1") { echo "Child"; } else { echo "Children";} ?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?>&nbsp;&nbsp;
                                                <?php if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {
                                                    if(trim($ProfileInfo['Children'])=="1") { echo "( Child with me )"; } else { echo "( Children with me )";} 
                                                        } else { 
                                                    if(trim($ProfileInfo['Children'])=="1") { echo "( Child not with me )"; } else { echo "( Children not with me )";} 
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                     <?php } else {    ?>
                                        <tr>
                                            <td>Children</td>
                                            <td>:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?></td>
                                        </tr>
                                <?php } } ?>
                                <tr>
                                    <td>
                                        <?php if($ProfileInfo['ReligionCode']== "RN009"){?>
                                            <?php echo trim($ProfileInfo['OtherReligion']);?>
                                        <?php } else { ?>
                                            <?php echo trim($ProfileInfo['Religion']);?>  
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if($ProfileInfo['CasteCode']== "CSTN248"){?>
                                            <?php echo trim($ProfileInfo['OtherCaste']);?>
                                        <?php } else { ?>
                                            <?php echo trim($ProfileInfo['Caste']);?>  
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php if(strlen(trim($ProfileInfo['SubCaste']))>0){   ?>
                                <tr>
                                    <td>Sub caste&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['SubCaste']);?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><?php echo trim($ProfileInfo['Community']);?></td>
                                </tr>
                                <tr>
                                    <td><?php echo trim($ProfileInfo['Nationality']);?></td>
                                </tr>
                                <tr>
                                    <td><?php echo trim($ProfileInfo['MotherTongue']);?></td>
                                </tr>
                                <tr>
                                    <td><?php if((strlen(trim($ProfileInfo['City'])))>0){ echo trim($ProfileInfo['City']);?>,&nbsp;&nbsp;<?php }?><?php if((strlen(trim($ProfileInfo['State'])))>0){ echo trim($ProfileInfo['State']);?>,&nbsp;&nbsp;<?php }?><?php echo trim($ProfileInfo['Country']);?></td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </td>
                </tr>
            </tbody>
        </table>
             
         </div>
</div>
</div>
<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
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
           
          <div style="color:#555"><?php echo trim($ProfileInfo['AboutMe']);?></div>
       
    </div>
  </div>
</div>
 <?php if($Member['IsMobileVerified']==1 && $Member['IsEmailVerified']==1){?>
<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
     <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Education Details</h4></div>
            
         </div>
		 <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Education</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['mainEducation']))> 0 ? trim($ProfileInfo['mainEducation']) : "N/A "; ?></label>
        </div>
         <table style="width:100%;color: #555;" cellpadding="3" cellspacing="0">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                     <th style="border: 1px solid #ddd;">Education</th>
                    <th style="border: 1px solid #ddd;">Education details</th>
                    <th style="border: 1px solid #ddd;">Attachments</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="height: 33px;text-align: left;border: 1px solid #ddd;"><?php echo $Document['EducationDetails'];?></td>
					<td style="height: 33px;text-align: left;border: 1px solid #ddd;">
                        <?php if($Document['EducationDegree']== "Others"){?>
                            <?php echo trim($Document['OtherEducationDegree']);?>
                        <?php } else { ?>
                             <?php echo trim($Document['EducationDegree']);?>  
                        <?php } ?> 
                        <br><?php echo $Document['EducationDescription']; ?></td>
					 <td style="height: 33px;text-align: left;border: 1px solid #ddd;">   
                        <?php if($Document['FileName']>0){ ?>
                            <?php echo $Document['IsVerified']== 1 ? "Attachment Verifiled" : "Attached "; ?> <br>
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

<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Occupation Details</h4></div>
         </div>
         <table style="width:100%;color: #555;" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Employed as</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Occupation type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?></td>
                </tr>
                <?php if($ProfileInfo['EmployedAsCode']=="O001"){ ?>
                <tr>
                    <td width="25%">Occupation type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Occupation</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;  
                        <?php if($ProfileInfo['OccupationTypeCode']=="OT112") {?>
                        <?php echo strlen(trim($ProfileInfo['OtherOccupation']))> 0 ? trim($ProfileInfo['OtherOccupation']) : "N/A "; ?>
                        <?php } else { echo $ProfileInfo['OccupationType']; } ?>&nbsp;&nbsp;
                        <?php if(strlen(trim($ProfileInfo['OccupationDescription']))> 0){
                            echo "(&nbsp;&nbsp;". trim($ProfileInfo['OccupationDescription']) . "&nbsp;&nbsp;)"; }?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">Annual income</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Working country</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;
                        <?php echo strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; ?>&nbsp;&nbsp;
                        <?php if(strlen(trim($ProfileInfo['WorkedCityName']))> 0){
                            echo "(&nbsp;&nbsp;". trim($ProfileInfo['WorkedCityName']) . "&nbsp;&nbsp;)"; }?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">Attachment</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;
                        <?php if($ProfileInfo['OccupationAttachFileName']==""){ echo "Not Attach";} else{ echo "Attached";  }?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
         </table>
        <?php if(strlen(trim($ProfileInfo['OccupationDetails']))> 0){ ?>
        <br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['OccupationDetails']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
    </div>
  </div>
</div>
<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;"> 
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Family Information</h4></div>
         </div>
         <table  style="width:100%;color: #555;" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Father's name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersName']))> 0 ? trim($ProfileInfo['FathersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersAlive'])))>0){?><?php if($ProfileInfo['FathersAlive']=="1") { echo "(Passed away)" ;}?><?php } ?></td>
                </tr>
                <?php if($ProfileInfo['FathersAlive']=="0"){?>
                <tr>
                    <td width="25%">Father's contact</td>
                    <td  colspan="3"style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="25%">Father's occupation</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;
                        <?php if($ProfileInfo['FathersOccupationCode']=="OT112") {?>
                        <?php echo strlen(trim($ProfileInfo['FatherOtherOccupation']))> 0 ? trim($ProfileInfo['FatherOtherOccupation']) : "N/A "; ?>
                        <?php } else { echo strlen(trim($ProfileInfo['FathersOccupation']))> 0 ? trim($ProfileInfo['FathersOccupation']) : "N/A ";  } ?>
                    </td>
                </tr> 
                <?php if($ProfileInfo['FathersOccupationCode']!="OT107") {?>
                <tr>
                    <td width="25%">Father's Income</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;
                        <?php echo strlen(trim($ProfileInfo['FathersIncome']))> 0 ? trim($ProfileInfo['FathersIncome']) : "N/A "; ?>
                    </td>
                </tr>
                <?php } }?>
                   <tr>
                    <td width="25%">Mother's name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersName']))> 0 ? trim($ProfileInfo['MothersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersAlive'])))>0){?><?php if($ProfileInfo['MothersAlive']=="1"){ echo "(Passed away)" ;}?><?php } ?></td>
                </tr>
                <?php if($ProfileInfo['MothersAlive']=="0"){?>
                <tr>
                    <td width="25%">Mother's contact</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>-<?php echo $ProfileInfo['MothersContact'];?><?php  } else{ echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="25%">Mother's occupation</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;
                        <?php if($ProfileInfo['MothersOccupationCode']=="OT112") {?>
                        <?php echo strlen(trim($ProfileInfo['MotherOtherOccupation']))> 0 ? trim($ProfileInfo['MotherOtherOccupation']) : "N/A "; ?>
                        <?php } else { echo strlen(trim($ProfileInfo['MothersOccupation']))> 0 ? trim($ProfileInfo['MothersOccupation']) : "N/A "; } ?>
                    </td>
                </tr> 
                <?php if($ProfileInfo['FathersOccupationCode']!="OT107") {?>
                <tr>
                    <td width="25%">Mother's income</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersIncome']))> 0 ? trim($ProfileInfo['MothersIncome']) : "N/A "; ?></td>
                </tr>
                <?php } }?>
                <tr>
                    <td width="25%">Family location</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyLocation1']))> 0 ? trim($ProfileInfo['FamilyLocation1']) : "N/A "; ?></td>
                </tr>
                <?php if(strlen(trim($ProfileInfo['FamilyLocation2']))> 0) {?>
                <tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyLocation2']))> 0 ? trim($ProfileInfo['FamilyLocation2']) : "N/A "; ?></td>
                </tr>
                <?php } ?>
                 <tr>
                    <td width="25%">Family type</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyType']))> 0 ? trim($ProfileInfo['FamilyType']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Ancestral / origin</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Ancestral']))> 0 ? trim($ProfileInfo['Ancestral']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Family affluence</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyAffluence']))> 0 ? trim($ProfileInfo['FamilyAffluence']) : "N/A "; ?></td>
                    <td>Family value</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyValue']))> 0 ? trim($ProfileInfo['FamilyValue']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Number of brothers</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofBrothers']))> 0 ? trim($ProfileInfo['NumberofBrothers']) : "N/A "; ?></td>
                    <?php if(trim($ProfileInfo['NumberofBrothers']) > 0){?>  
                    <td>Elder</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Elder']))> 0 ? trim($ProfileInfo['Elder']) : "N/A "; ?></td>
                    <td>Younger</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Younger']))> 0 ? trim($ProfileInfo['Younger']) : "N/A "; ?></td>
                    <td>Married</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Married']))> 0 ? trim($ProfileInfo['Married']) : "N/A "; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td width="25%">Number of sisters</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofSisters']))> 0 ? trim($ProfileInfo['NumberofSisters']) : "N/A "; ?></td>
                    <?php if(trim($ProfileInfo['NumberofSisters']) > 0){?>  
                    <td>Elder</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ElderSister']))> 0 ? trim($ProfileInfo['ElderSister']) : "N/A "; ?></td>
                    <td>Younger</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['YoungerSister']))> 0 ? trim($ProfileInfo['YoungerSister']) : "N/A "; ?></td>
                    <td>Married</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MarriedSister']))> 0 ? trim($ProfileInfo['MarriedSister']) : "N/A "; ?></td>
                    <?php } ?>
                </tr>
            </tbody>
         </table>
        <?php if(strlen(trim($ProfileInfo['AboutMyFamily']))> 0){ ?>
        <br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;"> 
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['AboutMyFamily']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Physical Information</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Physically impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PhysicallyImpaired']))> 0 ? trim($ProfileInfo['PhysicallyImpaired']) : "N/A "; ?>&nbsp;
                        <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){ echo ",";?>
                        <?php echo strlen(trim($ProfileInfo['PhysicallyImpaireddescription']))> 0 ? trim($ProfileInfo['PhysicallyImpaireddescription']) : "N/A "; ?>
                        <?php }?>    
                    </td>
                </tr>
                <tr>
                    <td width="25%">Visually impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VisuallyImpaired']))> 0 ? trim($ProfileInfo['VisuallyImpaired']) : "N/A "; ?>&nbsp;
                        <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){ echo ",";?>
                        <?php echo strlen(trim($ProfileInfo['VisuallyImpairedDescription']))> 0 ? trim($ProfileInfo['VisuallyImpairedDescription']) : "N/A "; ?>
                        <?php }?>    
                    </td>
                </tr>
                <tr>
                    <td width="25%">Vision impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VissionImpaired']))> 0 ? trim($ProfileInfo['VissionImpaired']) : "N/A "; ?>&nbsp;
                        <?php if($ProfileInfo['VissionImpaired'] =="Yes"){ echo ",";?>
                        <?php echo strlen(trim($ProfileInfo['VissionImpairedDescription']))> 0 ? trim($ProfileInfo['VissionImpairedDescription']) : "N/A "; ?>
                        <?php }?>    
                    </td>
                </tr>
                <tr>
                    <td width="25%">Speech impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SpeechImpaired']))> 0 ? trim($ProfileInfo['SpeechImpaired']) : "N/A "; ?>&nbsp;
                        <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){ echo ",";?>
                        <?php echo strlen(trim($ProfileInfo['SpeechImpairedDescription']))> 0 ? trim($ProfileInfo['SpeechImpairedDescription']) : "N/A "; ?>
                        <?php }?>    
                    </td>
                </tr>
                <tr>
                    <td width="25%">Height</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?></td>
                    <td>Weight</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['Weight'])))>0){ echo trim($ProfileInfo['Weight']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php } else{ echo "N/A";}?></td>
                </tr>
                <tr>
                    <td width="25%">Blood group</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BloodGroup']))> 0 ? trim($ProfileInfo['BloodGroup']) : "N/A "; ?></td>
                    <td>Complexation</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Complexation']))> 0 ? trim($ProfileInfo['Complexation']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Body type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BodyType']))> 0 ? trim($ProfileInfo['BodyType']) : "N/A "; ?></td>
                    <td>Diet</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Diet']))> 0 ? trim($ProfileInfo['Diet']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Smoking habit</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SmokingHabit']))> 0 ? trim($ProfileInfo['SmokingHabit']) : "N/A "; ?></td>
                    <td>Drinking habit</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DrinkingHabit']))> 0 ? trim($ProfileInfo['DrinkingHabit']) : "N/A "; ?></td>
                </tr>
            </tbody>
         </table>
        <?php if(strlen(trim($ProfileInfo['PhysicalDescription']))> 0){ ?>  <br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['PhysicalDescription']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
    </div>
  </div>
</div>
<?php if(sizeof($ProfileInfo['IsDownload'])>0){?>
 <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;height:486px">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                   <td width="25%">Date of birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; ?></td>
                </tr>
                <tr>
                   <td width="25%">Time Of Birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['TimeOfBirth']))> 0 ? trim($ProfileInfo['TimeOfBirth']) : "N/A "; ?></td>
                </tr>
                <tr>
                   <td>Place Of Birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['PlaceOfBirth']))> 0 ? trim($ProfileInfo['PlaceOfBirth']) : "N/A "; ?></td>
                </tr>
                <tr>
                   <td width="25%">Star Name</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['StarName']))> 0 ? trim($ProfileInfo['StarName']) : "N/A "; ?></td>
                   <td>Rasi Name</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['RasiName']))> 0 ? trim($ProfileInfo['RasiName']) : "N/A "; ?></td>
                </tr>
                <tr>
                   <td width="25%">Lakanam</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['Lakanam']))> 0 ? trim($ProfileInfo['Lakanam']) : "N/A "; ?></td>
                   <td>Chevvai Dhosham</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;<?php  echo strlen(trim($ProfileInfo['ChevvaiDhosham']))> 0 ? trim($ProfileInfo['ChevvaiDhosham']) : "N/A "; ?></td>
                </tr>
            </tbody>
         </table>  
         <div style="float:left; height:100px;margin-top: 10px;margin-right: 65px;">
             <table style="border: 1px solid #ddd;color: #555;">
                <tbody>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R1'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R2'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R3'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R4'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Rasi</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R8'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R9'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R12'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R13'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R14'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R15'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['R16'];?></td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div style="float:left; height:100px;margin-top: 10px;">
            <table style="border: 1px solid #ddd;color:#555">
                <tbody>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A1'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A2'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A3'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A4'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Amsam</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A8'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A9'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A12'];?></td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A13'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A14'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A15'];?></td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;"><?php echo $ProfileInfo['A16']; ?></td>
                  </tr>
                </tbody>
              </table>
        </div>
        </div>
    </div>
  </div> 
  <?php } else {?>
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            
         </div>        
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="<?php echo ImageUrl;?>lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the horoscope details<br><br>
                    <a href="#" class="btn btn-success" style="touch-action: manipulation;user-select: none;border: 1px solid transparent;border-radius: 4px;background-image: none;text-decoration:none;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div> 
  <?php } ?>                                                                                                              
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Partner's Expectations</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Age</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeFrom']))> 0 ? trim($PartnerExpectation['AgeFrom']) : "N/A "; ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeTo']))> 0 ? trim($PartnerExpectation['AgeTo']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Marital status</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['MaritalStatus']))> 0 ? trim($PartnerExpectation['MaritalStatus']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Religion</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Religion']))> 0 ? trim($PartnerExpectation['Religion']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Caste</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Caste']))> 0 ? trim($PartnerExpectation['Caste']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Employed as</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['EmployedAs']))> 0 ? trim($PartnerExpectation['EmployedAs']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td>Income range</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AnnualIncome']))> 0 ? trim($PartnerExpectation['AnnualIncome']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Rasi name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['RasiName']))> 0 ? trim($PartnerExpectation['RasiName']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Star name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['StarName']))> 0 ? trim($PartnerExpectation['StarName']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Chevvai dhosham</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['ChevvaiDhosham']))> 0 ? trim($PartnerExpectation['ChevvaiDhosham']) : "N/A "; ?></td>
                </tr>
            </tbody>
         </table>
         <?php if(strlen(trim($PartnerExpectation['Details']))> 0){ ?><br>
         <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width: 132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;<?php echo trim($PartnerExpectation['Details']); ?></div>
                </fieldset>
            </div>
        </div>
        <?php }?>
    </div>
  </div>
</div>
<?php if(sizeof($ProfileInfo['IsDownload'])>0){?>
<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
         </div>
         <table  style="width:100%;" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Email ID</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmailID']))> 0 ? trim($ProfileInfo['EmailID']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Mobile Number</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MobileNumber']))> 0 ? trim($ProfileInfo['MobileNumber']) : "N/A "; ?></td>
                
                    <td style="text-align:right;">Whatsapp Number</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['WhatsappNumber']))> 0 ? trim($ProfileInfo['WhatsappNumber']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">Address</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AddressLine1']))> 0 ? trim($ProfileInfo['AddressLine1']) : "N/A "; ?></td>
                </tr>
                <?php if((strlen(trim($ProfileInfo['AddressLine2'])))>0){?>
                <tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AddressLine2']))> 0 ? trim($ProfileInfo['AddressLine2']) : "N/A "; ?></td>
                </tr>
                <?php } ?>
                <?php if((strlen(trim($ProfileInfo['AddressLine3'])))>0){?>
                <tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AddressLine3']))> 0 ? trim($ProfileInfo['AddressLine3']) : "N/A "; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td width="25%">Pincode</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Pincode']))> 0 ? trim($ProfileInfo['Pincode']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">City</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['City']))> 0 ? trim($ProfileInfo['City']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td>Other Location</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['OtherLocation']))> 0 ? trim($ProfileInfo['OtherLocation']) : "N/A "; ?></td>
                </tr>
                <tr>
                    <td width="25%">State</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['State']))> 0 ? trim($ProfileInfo['State']) : "N/A "; ?></td>
                    <td style="text-align: right;">Country</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A "; ?></td>
                </tr>
            </tbody>
         </table>
        </div>
    </div>
  </div>
  <?php } else {?>
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication details</h4></div>
         </div>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="<?php echo ImageUrl;?>lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the contact details<br><br>
                     <a href="#" class="btn btn-success" style="touch-action: manipulation;user-select: none;border: 1px solid transparent;border-radius: 4px;background-image: none;text-decoration:none;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div> 
<?php } ?>
  <?php } else { ?>
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
       
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
</div>
