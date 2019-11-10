<?php
    include("lib/mpdf/mpdf.php");
    
    include_once("config.php");
    $response = $webservice->getData("Member","GetFullProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo         = $response['data']['ProfileInfo'];
    $Member              = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation  = $response['data']['PartnerExpectation'];


    $html = '    
<div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
    <div class="col-12 grid-margin" style="margin-bottom:5px">
        <div class="card" style="background: none;">
            <div class="card-body" style="padding: 0px;background: none;">
                <div class="form-group row" style="background: none;">  
                    <div class="col-sm-8 col-form-label" style="background: none;">
                        <div class="form-group row" >                                       
                            <label class="col-sm-12 col-form-label" style="background: none;color: #222;font-size:24px;font-weight:bold;">';
                                $html .= strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A ";
                                $html .= '&nbsp;(';
                                if((strlen(trim($ProfileInfo['Age'])))>0) { 
                                    $html .= trim($ProfileInfo['Age']). ' Yrs ';
                                }
                               $html .=' ) 
                            </label>
                            <label class="col-sm-12 col-form-label" style="background: none;color: #333;font-size: 14px;padding: 0px 16px;color: #666;">';
                                $html .= strlen(trim($ProfileInfo['ProfileCode']))> 0 ? trim($ProfileInfo['ProfileCode']) : "N/A "; 
                                $html .= '&nbsp;&nbsp;|&nbsp;&nbsp;::ProfileCreatedFor::
                            </label>
                         </div>
                    </div>
                    <div class="col-sm-4"  style="text-align:right">
                    
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
                                        <img src="';$html .= $response['data']['ProfileThumb'];$html .= '" style="height: 290px;width: 291px;">
                                    </div>
                                </div> 
                            </div>
                            <div style="padding-left:3px;padding-right: 10px;margin-top:7px">
                            <table>
                                <tr>
                                    <td><img src="';SiteUrl;$html .= 'assets/images/nextarrow.jpg" style="width:30px"></td>
                                    <td>'; foreach($response['data']['ProfilePhotos'] as $ProfileP) {
                                           $html .= ' <div class="photoview" style="float: left;margin-left:3px;">
                                                <img src="';$html .= $ProfileP['ProfilePhoto'];$html .=' style="height: 62px;width: 44px;">
                                            </div>';
                                         }; $html .= '
                                    </td>
                                    <td><img src="';$html .= SiteUrl;$html .= 'assets/images/rightarrow.jpg" style="width:30px"></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </td>
                    <td style="color:#737373;vertical-align: top;"> 
                        <table style="width:100%;color: #555;" cellpadding="3" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>';
                                         if((strlen(trim($ProfileInfo['Height'])))>0){
                                        $html .= trim($ProfileInfo['Height']);$html .='&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span>';
                                         };
                                    $html .='</td>
                                </tr>
                                <tr>
                                    <td>';$html .= trim($ProfileInfo['MaritalStatus']);$html .='</td>
                                </tr>';
                                 if($ProfileInfo['MaritalStatusCode']!= "MST001"){ 
                                    if(trim($ProfileInfo['Children'])>0) {
                                    $html .='<tr>
                                                <td>';
                                                     if(trim($ProfileInfo['Children'])=="1") { 
                                                         $html .='Child'; } 
                                                     else { $html .='Children';}
                                                     $html .='&nbsp;&nbsp;:&nbsp;&nbsp;'; $html .=trim($ProfileInfo['Children']); $html .='&nbsp;&nbsp;';
                                                     
                                                    if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {
                                                        
                                                    if(trim($ProfileInfo['Children'])=="1") { 
                                                        $html .='( Child with me )'; 
                                                    } else { 
                                                        $html .='( Children with me )';} 
                                                        } 
                                                    else { 
                                                        if(trim($ProfileInfo['Children'])=="1") { 
                                                            $html .='( Child not with me )'; 
                                                        } else { $html .='( Children not with me )';} 
                                                    }
                                                $html .='</td>
                                    </tr>';
                                     } else {  
                                        $html .='<tr>
                                            <td>Children</td>
                                            <td>:&nbsp;&nbsp;'; $html .=trim($ProfileInfo['Children']); $html .='</td>
                                        </tr>';
                                } }
                            $html .='
                                <tr>
                                    <td>';
                                         if($ProfileInfo['ReligionCode']== "RN009"){
                                            $html .=trim($ProfileInfo['OtherReligion']);
                                        } else {
                                            $html .= trim($ProfileInfo['Religion']);
                                         }
                                    $html .='</td>
                                </tr>
                                <tr>
                                    <td>';
                                         if($ProfileInfo['CasteCode']== "CSTN248"){
                                            $html .=trim($ProfileInfo['OtherCaste']);
                                        } else {
                                            $html .= trim($ProfileInfo['Caste']);
                                         }
                                    $html .='</td>
                                </tr>';
                                     if(strlen(trim($ProfileInfo['SubCaste']))>0){ 
                                $html .='<tr>
                                    <td>Sub caste&nbsp;&nbsp;:&nbsp;&nbsp;'; $html .=trim($ProfileInfo['SubCaste']); $html .='</td>
                                </tr>';
                                } 
                            $html .='
                                <tr>
                                    <td>'; $html .=trim($ProfileInfo['Community']); $html .='</td>
                                </tr>
                                <tr>
                                    <td>'; $html .=trim($ProfileInfo['Nationality']); $html .='</td>
                                </tr>
                                <tr>
                                    <td>'; $html .=trim($ProfileInfo['MotherTongue']); $html .='</td>
                                </tr>
                                <tr>
                                    <td>';
                                        if((strlen(trim($ProfileInfo['City'])))>0){ 
                                            $html .=trim($ProfileInfo['City']); $html .=',&nbsp;&nbsp;'; 
                                        }
                                        if((strlen(trim($ProfileInfo['State'])))>0){ 
                                            $html .=trim($ProfileInfo['State']); $html .=',&nbsp;&nbsp;';
                                        } $html .=trim($ProfileInfo['Country']); 
                                    $html .='</td>
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
            <div class="col-sm-6"><h4 class="card-title">';
            if(trim($ProfileInfo['ProfileFor'])=="Myself") { $html .='About Myself'; }
            if(trim($ProfileInfo['ProfileFor'])=="Brother") { $html .='About My Brother'; }
            if(trim($ProfileInfo['ProfileFor'])=="Sister") { $html .='About My Sister'; }
            if(trim($ProfileInfo['ProfileFor'])=="Daughter") { $html .='About My Daughter'; }
            if(trim($ProfileInfo['ProfileFor'])=="Son") { $html .='About My Son'; }
            if(trim($ProfileInfo['ProfileFor'])=="Sister In Law") { $html .='About My Sister In Law'; }
            if(trim($ProfileInfo['ProfileFor'])=="Brother In Law") { $html .='About My Brother In Law'; }
            if(trim($ProfileInfo['ProfileFor'])=="Son In Law") { $html .='About My Son In Law'; }
            if(trim($ProfileInfo['ProfileFor'])=="Daughter In Law") { $html .='About My Daughter In Law'; }
         $html .='</h4></div>
         </div>
          <div style="color:#555">';$html .= trim($ProfileInfo['AboutMe']); $html .='</div>
    </div>
  </div>
</div>';
if($Member['IsMobileVerified']==1 && $Member['IsEmailVerified']==1){
$html .='<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
     <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Education Details</h4></div>
         </div>
         <table style="width:100%;color: #555;" cellpadding="3" cellspacing="0">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                     <th style="border: 1px solid #ddd;">Education</th>
                    <th style="border: 1px solid #ddd;">Education details</th>
                    <th style="border: 1px solid #ddd;">Attachments</th>
                </tr>
            </thead>
            <tbody>';
              if (sizeof($EducationAttachment)>0) {    
                 foreach($EducationAttachment as $Document) { 
                $html .='<tr>    
                    <td style="height: 33px;text-align: left;border: 1px solid #ddd;">'; $html .=$Document['EducationDetails']; $html .='</td>
                    <td style="height: 33px;text-align: left;border: 1px solid #ddd;">';
                        if($Document['EducationDegree']== "Others"){
                            $html .=trim($Document['OtherEducationDegree']);
                         } else { 
                            $html .=trim($Document['EducationDegree']);  
                         }  
                        $html .='<br>'; $html .=$Document['EducationDescription'];$html .='</td>
                    <td style="height: 33px;text-align: left;border: 1px solid #ddd;">';   
                        if($Document['FileName']>0){ 
                            $html .=$Document['IsVerified']== 1 ? "Attachment Verifiled" : "Attached "; $html .='<br>';
                        } else { $html .='Not Attach'; } $html .='</td>
                </tr>';
                 }   } else {
                $html .='<tr>    
                    <td colspan="3" style="text-align:center">No datas found</td>
                </tr>';
                 }
            $html .='</tbody>
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
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Occupation type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A ";  $html .='</td>
                </tr>';
                 if($ProfileInfo['EmployedAsCode']=="O001"){ 
               $html .='<tr>
                    <td width="25%">Occupation type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Occupation</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';  
                         if($ProfileInfo['OccupationTypeCode']=="OT112") {
                        $html .=strlen(trim($ProfileInfo['OtherOccupation']))> 0 ? trim($ProfileInfo['OtherOccupation']) : "N/A "; 
                         } else { $html .= $ProfileInfo['OccupationType']; } $html .='&nbsp;&nbsp;';
                         if(strlen(trim($ProfileInfo['OccupationDescription']))> 0){
                            $html .='(&nbsp;&nbsp;'; $html .=trim($ProfileInfo['OccupationDescription']) . "&nbsp;&nbsp;)"; }
                   $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Annual income</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Working country</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';
                        $html .= strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; $html .='&nbsp;&nbsp;';
                        if(strlen(trim($ProfileInfo['WorkedCityName']))> 0){
                           $html .='(&nbsp;&nbsp;'; $html .= trim($ProfileInfo['WorkedCityName']) . "&nbsp;&nbsp;)"; }
                   $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Attachment</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';
                        if($ProfileInfo['OccupationAttachFileName']==""){ $html .='Not Attach'; } else{ $html .='Attached';  }
                   $html .='</td>
                </tr>';
                 } 
            $html .='</tbody>
         </table>';
           if(strlen(trim($ProfileInfo['OccupationDetails']))> 0){ 
        $html .='<br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;';$html .= trim($ProfileInfo['OccupationDetails']); $html .='</div>
                </fieldset>
            </div>
        </div>';
         }
    $html .='</div>
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
                    <td width="25%">Fathers name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['FathersName']))> 0 ? trim($ProfileInfo['FathersName']) : "N/A "; $html .='&nbsp;&nbsp;&nbsp;&nbsp;'; if(strlen(trim($ProfileInfo['FathersAlive']))>0){  if($ProfileInfo['FathersAlive']=="1") { $html .='(Passed away)' ;}  }$html .='</td>
                </tr>';
                 if($ProfileInfo['FathersAlive']=="0"){
                $html .='<tr>
                    <td width="25%">Fathers contact</td>
                    <td  colspan="3"style="color:#737373;">:&nbsp;&nbsp;'; if(strlen(trim($ProfileInfo['FathersContact']))>0){  $html .='+'; $html .=$ProfileInfo['FathersContactCountryCode']; $html .='-'; $html .= $ProfileInfo['FathersContact'];  } else{ $html .='N/A';} $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Fathers occupation</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';
                        if($ProfileInfo['FathersOccupationCode']=="OT112") {
                        $html .= strlen(trim($ProfileInfo['FatherOtherOccupation']))> 0 ? trim($ProfileInfo['FatherOtherOccupation']) : "N/A "; 
                        } else { $html .=strlen(trim($ProfileInfo['FathersOccupation']))> 0 ? trim($ProfileInfo['FathersOccupation']) : "N/A ";  } 
                    $html .='</td>
                </tr>'; 
                 if($ProfileInfo['FathersOccupationCode']!="OT107") {
                $html .='<tr>
                    <td width="25%">Fathers Income</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';
                        $html .=strlen(trim($ProfileInfo['FathersIncome']))> 0 ? trim($ProfileInfo['FathersIncome']) : "N/A ";
                    $html .='</td>
                </tr>';
                 } }
                   $html .='<tr>
                    <td width="25%">Mothers name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;'; $html .= strlen(trim($ProfileInfo['MothersName']))> 0 ? trim($ProfileInfo['MothersName']) : "N/A "; $html .='&nbsp;&nbsp;&nbsp;&nbsp;'; if(strlen(trim($ProfileInfo['MothersAlive']))>0){  if($ProfileInfo['MothersAlive']=="1"){ $html .='(Passed away)' ;}  } $html .='</td>
                </tr>';
                if($ProfileInfo['MothersAlive']=="0"){
                $html .='<tr>
                    <td width="25%">Mothers contact</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';if((strlen(trim($ProfileInfo['MothersContact'])))>0){  $html .='+'; $html .=$ProfileInfo['MothersContactCountryCode']; $html .='-'; $html .= $ProfileInfo['MothersContact']; } else{ $html .='N/A';} $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Mothers occupation</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';
                        if($ProfileInfo['MothersOccupationCode']=="OT112") {
                        $html .= strlen(trim($ProfileInfo['MotherOtherOccupation']))> 0 ? trim($ProfileInfo['MotherOtherOccupation']) : "N/A "; 
                        } else { $html .=strlen(trim($ProfileInfo['MothersOccupation']))> 0 ? trim($ProfileInfo['MothersOccupation']) : "N/A "; } 
                   $html .=' </td>
                </tr>';
                if($ProfileInfo['FathersOccupationCode']!="OT107") {
                $html .='<tr>
                    <td width="25%">Mothers income</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['MothersIncome']))> 0 ? trim($ProfileInfo['MothersIncome']) : "N/A "; 
                $html .='</tr>';
                 } }
                $html .='<tr>
                    <td width="25%">Family location</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['FamilyLocation1']))> 0 ? trim($ProfileInfo['FamilyLocation1']) : "N/A "; $html .='</td>
                </tr>';
                if(strlen(trim($ProfileInfo['FamilyLocation2']))> 0) {
                $html .='<tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['FamilyLocation2']))> 0 ? trim($ProfileInfo['FamilyLocation2']) : "N/A "; $html .='</td>
                </tr>';
                 } 
                $html .='<tr>
                    <td width="25%">Family type</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['FamilyType']))> 0 ? trim($ProfileInfo['FamilyType']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Ancestral / origin</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['Ancestral']))> 0 ? trim($ProfileInfo['Ancestral']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Family affluence</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['FamilyAffluence']))> 0 ? trim($ProfileInfo['FamilyAffluence']) : "N/A "; $html .='</td>
                    <td>Family value</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['FamilyValue']))> 0 ? trim($ProfileInfo['FamilyValue']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Number of brothers</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['NumberofBrothers']))> 0 ? trim($ProfileInfo['NumberofBrothers']) : "N/A "; $html .='</td>';
                    if(trim($ProfileInfo['NumberofBrothers']) > 0){  
                    $html .='<td>Elder</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';strlen(trim($ProfileInfo['Elder']))> 0 ? trim($ProfileInfo['Elder']) : "N/A "; $html .='</td>
                    <td>Younger</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['Younger']))> 0 ? trim($ProfileInfo['Younger']) : "N/A ";$html .='</td>
                    <td>Married</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['Married']))> 0 ? trim($ProfileInfo['Married']) : "N/A "; $html .='</td>';
                    } $html .='
                </tr>
                <tr>
                    <td width="25%">Number of sisters</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['NumberofSisters']))> 0 ? trim($ProfileInfo['NumberofSisters']) : "N/A "; $html .='</td>';
                     if(trim($ProfileInfo['NumberofSisters']) > 0){  
                    $html .='<td>Elder</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['ElderSister']))> 0 ? trim($ProfileInfo['ElderSister']) : "N/A "; $html .='</td>
                    <td>Younger</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['YoungerSister']))> 0 ? trim($ProfileInfo['YoungerSister']) : "N/A "; $html .='</td>
                    <td>Married</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['MarriedSister']))> 0 ? trim($ProfileInfo['MarriedSister']) : "N/A "; $html .='</td>';
                     } $html .='
                </tr>
            </tbody>
         </table>';
        if(strlen(trim($ProfileInfo['AboutMyFamily']))> 0){ 
        $html .='<br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;"> 
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;';$html .=trim($ProfileInfo['AboutMyFamily']);$html .='</div>
                </fieldset>
            </div>
        </div>';
         }
        $html .='</div>
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
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['PhysicallyImpaired']))> 0 ? trim($ProfileInfo['PhysicallyImpaired']) : "N/A ";$html .='&nbsp;';
                        if($ProfileInfo['PhysicallyImpaired'] =="Yes"){ $html .=',';
                        $html .=strlen(trim($ProfileInfo['PhysicallyImpaireddescription']))> 0 ? trim($ProfileInfo['PhysicallyImpaireddescription']) : "N/A ";
                        }    
                    $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Visually impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['VisuallyImpaired']))> 0 ? trim($ProfileInfo['VisuallyImpaired']) : "N/A "; $html .='&nbsp;';
                        if($ProfileInfo['VisuallyImpaired'] =="Yes"){ $html .=',';
                        $html .=strlen(trim($ProfileInfo['VisuallyImpairedDescription']))> 0 ? trim($ProfileInfo['VisuallyImpairedDescription']) : "N/A "; 
                       }    
                    $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Vision impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['VissionImpaired']))> 0 ? trim($ProfileInfo['VissionImpaired']) : "N/A "; $html .='&nbsp;';
                        if($ProfileInfo['VissionImpaired'] =="Yes"){ $html .=',';
                        $html .=strlen(trim($ProfileInfo['VissionImpairedDescription']))> 0 ? trim($ProfileInfo['VissionImpairedDescription']) : "N/A "; 
                       }    
                    $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Speech impaired?</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['SpeechImpaired']))> 0 ? trim($ProfileInfo['SpeechImpaired']) : "N/A "; $html .='&nbsp;';
                        if($ProfileInfo['SpeechImpaired'] =="Yes"){ echo ",";
                        $html .=strlen(trim($ProfileInfo['SpeechImpairedDescription']))> 0 ? trim($ProfileInfo['SpeechImpairedDescription']) : "N/A "; 
                        }    
                    $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Height</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; if((strlen(trim($ProfileInfo['Height'])))>0){ $html .=trim($ProfileInfo['Height']); $html .='&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span>'; } else{ $html .='N/A';} $html .='</td>
                    <td>Weight</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; if((strlen(trim($ProfileInfo['Weight'])))>0){ $html .=trim($ProfileInfo['Weight']);$html .='<span style="color: #ccc;">(approximate)</span>'; } else{ $html .='N/A';} $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Blood group</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['BloodGroup']))> 0 ? trim($ProfileInfo['BloodGroup']) : "N/A "; $html .='</td>
                    <td>Complexation</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['Complexation']))> 0 ? trim($ProfileInfo['Complexation']) : "N/A ";$html .='</td>
                </tr>
                <tr>
                    <td width="25%">Body type</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['BodyType']))> 0 ? trim($ProfileInfo['BodyType']) : "N/A "; $html .='</td>
                    <td>Diet</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;'; $html .=strlen(trim($ProfileInfo['Diet']))> 0 ? trim($ProfileInfo['Diet']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Smoking habit</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['SmokingHabit']))> 0 ? trim($ProfileInfo['SmokingHabit']) : "N/A "; $html .='</td>
                    <td>Drinking habit</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['DrinkingHabit']))> 0 ? trim($ProfileInfo['DrinkingHabit']) : "N/A "; $html .='</td>
                </tr>
            </tbody>
         </table>';
        if(strlen(trim($ProfileInfo['PhysicalDescription']))> 0){ $html .='  <br>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width:132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;';$html .=trim($ProfileInfo['PhysicalDescription']); $html .='</div>
                </fieldset>
            </div>
        </div>';
         }
    $html .='</div>
  </div>
</div> ';
 if(sizeof($ProfileInfo['IsDownload'])>0){
$html .='<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;height:486px">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                   <td width="25%">Date of birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                   <td width="25%">Time Of Birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['TimeOfBirth']))> 0 ? trim($ProfileInfo['TimeOfBirth']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                   <td>Place Of Birth</td>
                   <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['PlaceOfBirth']))> 0 ? trim($ProfileInfo['PlaceOfBirth']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                   <td width="25%">Star Name</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['StarName']))> 0 ? trim($ProfileInfo['StarName']) : "N/A "; $html .='</td>
                   <td>Rasi Name</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['RasiName']))> 0 ? trim($ProfileInfo['RasiName']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                   <td width="25%">Lakanam</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['Lakanam']))> 0 ? trim($ProfileInfo['Lakanam']) : "N/A "; $html .='</td>
                   <td>Chevvai Dhosham</td>
                   <td style="color:#737373;">:&nbsp;&nbsp;';$html .=strlen(trim($ProfileInfo['ChevvaiDhosham']))> 0 ? trim($ProfileInfo['ChevvaiDhosham']) : "N/A ";$html .='</td>
                </tr>
            </tbody>
         </table>  
         <div style="float:left; height:100px;margin-top: 10px;margin-right:5px;">
             <table style="border: 1px solid #ddd;color: #555;">
                <tbody>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R1']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R2']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R3']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R4']; $html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R5']; $html .='</td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Rasi</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R8']; $html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R9']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R12']; $html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R13']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R14']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R15']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['R16']; $html .='</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div style="float:left; height:100px;margin-top: 10px;">
            <table style="border: 1px solid #ddd;color:#555">
                <tbody>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A1']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A2']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A3']; $html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A4']; $html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A5'];$html .='</td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Amsam</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A8'];$html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A9'];$html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A12'];$html .='</td>
                  </tr>
                  <tr>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A13'];$html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A14'];$html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A15'];$html .='</td>
                    <td style="width: 75px;height: 75px;border: 1px solid #ddd;text-align: center;">';$html .=$ProfileInfo['A16'];$html .='</td>
                  </tr>
                </tbody>
              </table>
        </div>
        </div>
    </div>
  </div>';
 } else {
 $html .='<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
            
         </div>        
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="';ImageUrl;$html .= 'lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the horoscope details<br><br>
                    <a href="#" class="btn btn-success" style="touch-action: manipulation;user-select: none;border: 1px solid transparent;border-radius: 4px;background-image: none;text-decoration:none;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>'; 
  }$html .='
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Partners Expectations</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Age</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['AgeFrom']))> 0 ? trim($PartnerExpectation['AgeFrom']) : "N/A "; $html .= '&nbsp;&nbsp;to&nbsp;&nbsp;'; $html .= strlen(trim($PartnerExpectation['AgeTo']))> 0 ? trim($PartnerExpectation['AgeTo']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Marital status</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['MaritalStatus']))> 0 ? trim($PartnerExpectation['MaritalStatus']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Religion</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['Religion']))> 0 ? trim($PartnerExpectation['Religion']) : "N/A ";$html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Caste</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['Caste']))> 0 ? trim($PartnerExpectation['Caste']) : "N/A "; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Employed as</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['EmployedAs']))> 0 ? trim($PartnerExpectation['EmployedAs']) : "N/A ";$html .='</td>
                </tr>
                <tr>
                    <td>Income range</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['AnnualIncome']))> 0 ? trim($PartnerExpectation['AnnualIncome']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Rasi name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['RasiName']))> 0 ? trim($PartnerExpectation['RasiName']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Star name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['StarName']))> 0 ? trim($PartnerExpectation['StarName']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Chevvai dhosham</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($PartnerExpectation['ChevvaiDhosham']))> 0 ? trim($PartnerExpectation['ChevvaiDhosham']) : "N/A "; $html .= '</td>
                </tr>
            </tbody>
         </table>';
         if(strlen(trim($PartnerExpectation['Details']))> 0){ $html .= '<br>
         <div class="form-group row">
            <div class="col-sm-12">
                <fieldset style="display: block;margin-left: 2px;margin-right: 2px;padding-top: 0.35em;padding-bottom: 0.625em;padding-left: 0.75em;padding-right: 0.75em;border: 1px groove;border-color: #ddd;">
                    <legend style="width: 132px;margin-bottom: 0px;font-size: 13px;border-bottom: none;padding-left: 6px;">Additional information</legend>
                    <div style="color:#737373;width: 710px;">&nbsp;&nbsp;';$html .= trim($PartnerExpectation['Details']); $html .= '</div>
                </fieldset>
            </div>
        </div>';
        }
    $html .= '</div>
  </div>
</div>';
if(sizeof($ProfileInfo['IsDownload'])>0){  
$html .= '<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
         </div>
         <table  style="width:100%;" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Email ID</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['EmailID']))> 0 ? trim($ProfileInfo['EmailID']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Mobile Number</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['MobileNumber']))> 0 ? trim($ProfileInfo['MobileNumber']) : "N/A "; $html .= '</td>
                
                    <td style="text-align:right;">Whatsapp Number</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['WhatsappNumber']))> 0 ? trim($ProfileInfo['WhatsappNumber']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Address</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['AddressLine1']))> 0 ? trim($ProfileInfo['AddressLine1']) : "N/A "; $html .= '</td>
                </tr>';
                if((strlen(trim($ProfileInfo['AddressLine2'])))>0){
                $html .= '<tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['AddressLine2']))> 0 ? trim($ProfileInfo['AddressLine2']) : "N/A "; $html .= '</td>
                </tr>';
                 } 
                 if((strlen(trim($ProfileInfo['AddressLine3'])))>0){
                $html .= '<tr>
                    <td width="25%"></td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;'; $html .= strlen(trim($ProfileInfo['AddressLine3']))> 0 ? trim($ProfileInfo['AddressLine3']) : "N/A "; $html .= '</td>
                </tr>';
                 } 
                $html .= '<tr>
                    <td width="25%">Pincode</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['Pincode']))> 0 ? trim($ProfileInfo['Pincode']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">City</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['City']))> 0 ? trim($ProfileInfo['City']) : "N/A ";$html .= '</td>
                </tr>
                <tr>
                    <td>Other Location</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['OtherLocation']))> 0 ? trim($ProfileInfo['OtherLocation']) : "N/A "; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">State</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['State']))> 0 ? trim($ProfileInfo['State']) : "N/A ";$html .= '</td>
                    <td style="text-align: right;">Country</td>
                    <td style="color:#737373;">:&nbsp;&nbsp;';$html .= strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A "; $html .= '</td>
                </tr>
            </tbody>
         </table>
        </div>
    </div>
  </div>';
  } else {
  $html .= '<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Communication details</h4></div>
         </div>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="';SiteUrl;$html .= 'assets/images/lockimage.png" style="width:30px">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    Upgrade membership to unlock the contact details<br><br>
                     <a href="#" class="btn btn-success" style="touch-action: manipulation;user-select: none;border: 1px solid transparent;border-radius: 4px;background-image: none;text-decoration:none;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;">Upgrade now</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>'; 
 } 
 } else { 
  $html .='<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
       
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="';$html .= SiteUrl;$html .= 'assets/images/lockimage.png" style="width:30px">
                </div>
                <div class="col-sm-12" style="text-align: center;">';
                 if($Member['IsMobileVerified']==o && $Member['IsEmailVerified']==0){
                 $html .=' If you want know the full details please verify your mobile number and email id<br>';
                 } 
                 if($Member['IsMobileVerified']==0 && $Member['IsEmailVerified']==1){
                   $html .='If you want know the full details please verify your mobile number<br>';
                } 
                if($Member['IsMobileVerified']==1 && $Member['IsEmailVerified']==0){
                  $html .='If you want know the full details please verify your email id<br>';
                 } 
                $html .='</div>
            </div>
         </div>
    </div>
  </div>';
   } 
$html .= '</div> ';
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    $mpdf=new mPDF('', 'A4', '', '', 0, 0, 0, 0, 0, 0); 
    $mpdf->WriteHTML($html);
    
    $mpdf->charset_in='UTF-8';
    //$mpdf->SetMargins(0, 0, 65);
    //$mpdf->SetHTMLHeader($pdf_header);
    
    //$mpdf->SetWatermarkText("");
    //$mpdf->showWatermarkText = true;
    //$mpdf->watermarkTextAlpha = 0.1;
            
    //$fname= "assets/pdf/".$data[0]['InvoiceNumber'].'.pdf';
    //$mpdf->SetHTMLFooter($pdf_footer);
    //$mpdf->Output($fname,'F');
    $mpdf->Output();
?> 