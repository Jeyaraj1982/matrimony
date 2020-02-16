 <?php 
 if (isset($_POST['Observation'])) {
         $response =$webservice->getData("Admin","ProfileAddToObservationMode",$_POST);
        if ($response['status']=="success") {   ?>
           <script>location.href=location.href;</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
 ?>
 <?php  
	if (isset($_POST['Verify'])) {
        $_POST['ApproveProfilePhoto']=implode(",",$_POST['ApproveProfilePhoto']);
        $response = $webservice->getData("Admin","VerifyProfileDetails",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyEducation'])) {
        $_POST['ApproveEducation']=implode(",",$_POST['ApproveEducation']);
        $response = $webservice->getData("Admin","VerifyEducationDetails",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyDocument'])) {
        $_POST['ApproveDocument']=implode(",",$_POST['ApproveDocument']);
        $response = $webservice->getData("Admin","VerifyDocumentDetails",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyAboutMeInfo'])) {
        $_POST['ApproveAboutMeInfo']=implode(",",$_POST['ApproveAboutMeInfo']);
        $response = $webservice->getData("Admin","VerifyAboutMeDetails",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyOccupationAdditionInfo'])) {
        $_POST['ApproveOccupationDESC']=implode(",",$_POST['ApproveOccupationDESC']);
        $response = $webservice->getData("Admin","VerifyOccupationAdditionalInfo",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyFamilyInfoAdditionInfo'])) {
        $_POST['ApproveFamilyInfoAdditionalInfo']=implode(",",$_POST['ApproveFamilyInfoAdditionalInfo']);
        $response = $webservice->getData("Admin","VerifyFamilyAdditionalInfo",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyPhysicalInfoAdditionInfo'])) {
        $_POST['ApprovePhysicalInfoAdditionalInfo']=implode(",",$_POST['ApprovePhysicalInfoAdditionalInfo']);
        $response = $webservice->getData("Admin","VerifyPhysicallAdditionalInfo",$_POST);
        if ($response['status']=="success") {     
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyHoroscopeDOB'])) {
        $_POST['ApproveHoroscopeDob']=implode(",",$_POST['ApproveHoroscopeDob']);
        $response = $webservice->getData("Admin","VerifyHoroscopeDOB",$_POST);
        if ($response['status']=="success") {     
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyHoroscopeAdditionInfo'])) {
        $_POST['ApproveHoroscopeAdditionalInfo']=implode(",",$_POST['ApproveHoroscopeAdditionalInfo']);
        $response = $webservice->getData("Admin","VerifyHoroscopeAdditionInfo",$_POST);
        if ($response['status']=="success") {     
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyPartnerExpectationAdditionInfo'])) {
        $_POST['ApprovePartnerExpectationAdditionalInfo']=implode(",",$_POST['ApprovePartnerExpectationAdditionalInfo']);
        $response = $webservice->getData("Admin","VerifyPartnersexpectationAdditionInfo",$_POST);
        if ($response['status']=="success") {     
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	if (isset($_POST['VerifyCommunicationAdditionInfo'])) {
        $_POST['ApproveCommunicationAdditionalInfo']=implode(",",$_POST['ApproveCommunicationAdditionalInfo']);
        $response = $webservice->getData("Admin","VerifyCommunicationAdditionalInfo",$_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
	
	$response = $webservice->getData("Admin","GetDraftProfileInfo",array("ProfileCode"=>$_GET['Code']));   
     $ProfileInfo     = $response['data']['ProfileInfo'];
     $GIVerification  = $response['data']['GIVerification'];
     $ODVerification  = $response['data']['ODVerification'];
     $FIVerification  = $response['data']['FIVerification'];
     $PIVerification  = $response['data']['PIVerification'];
     $HDobVerification = $response['data']['HDobVerification'];
     $HDVerification = $response['data']['HDVerification'];
     $PEVerification = $response['data']['PEVerification'];
     $CDVerification = $response['data']['CDVerification'];
	 $Member = $response['data']['Members'];
     $EducationAttachment = $response['data']['EducationAttachments'];
     $PartnerExpectation = $response['data']['PartnerExpectation'];
     $DATSummarys = $response['data']['DATSummary'];
?>
<script>
$(window).on("beforeunload", function() { return confirm("Do you really want to close?"); });
</script>
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
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $ProfileInfo['ProfileCode'];?>" name="Code" id="Code">
    <input type="hidden" value="<?php echo $ProfileInfo['MemberID'];?>" name="MemberID" id="MemberID">
    <input type="hidden" value="<?php echo $ProfileInfo['MemberCode'];?>" name="MemberCode" id="MemberCode">
<div class="col-12 grid-margin">
  <div class="card">                                                                                                               
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-10">
            <?php if($ProfileInfo['IsObservation']=="0") {?>
            <a href="javascript:void(0)" onclick="ConfirmDATActiveObservationModefrSubmittedProfile()"  class="btn btn-success" style="font-family:roboto">Observation</a>
            <?php } if($ProfileInfo['IsObservation']=="1") {?>
            Observation On: <?php echo putDateTime($ProfileInfo['ObservationOn']);?>
            <?php } if($ProfileInfo['IsObservation']=="2") {?>  
            Observation On: <?php echo putDateTime($ProfileInfo['ObservationOn']);?> <br>
            Observation Completed On: <?php echo putDateTime($ProfileInfo['ObservationCompletedOn']);?>
            <?php } ?>
            </div>
            <div class="col-sm-2">
                <i class="menu-icon mdi mdi-printer" style="font-size: 26px;color: purple;"></i>&nbsp;&nbsp; <label>Print</label> 
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
         </div>
              <div class="form-group row" style="height:420px">
                <div class="col-sm-5">
                    <div style="border: 1px solid #e6e6e6;;padding: 0px;width: 318px;height: 420px;"> 
                    <div class="form-group row">                                                       
                        <div class="col-sm-12">
                            <div class="photoview" style="float:left;width: 316px;height:316px">
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
                <div class="col-sm-5">
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="color: #1e1e1e;font-size: 17px;"><?php echo strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A "; ?>&nbsp;<?php if((strlen(trim($ProfileInfo['Age'])))>0){ echo "("." ".trim($ProfileInfo['Age'])." "."yrs".")";  }?>&nbsp;</label>
                    </div>
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php }?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MaritalStatus']);?></label> 
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
                        <?php      echo "Sub caste :" . trim($ProfileInfo['SubCaste']);    }   ?>
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
                <div class="col-sm-2" style="height:420px;overflow: auto;">
                Summary
                <?php foreach($DATSummarys as $DATSummary) {?>
                    <div class="form-group row">
                       <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($DATSummary['Activity']);?></label> 
                    </div>
                    <div class="form-group row">
                       <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo putDateTime($DATSummary['ActivityOn']);?></label> 
                    </div>
                    <hr>
                <?php } ?>
              </div>
              </div>
         </div>
</div>
</div>
<div class="col-12 grid-margin">                                                                                 
	<div class="card">
		<div class="card-body">
			<div class="form-group row">
			<?php
			$i=1;
			foreach($response['data']['AllProfilePhotos'] as $ProfileP) {
				
				?>
				<div class="col-sm-4" style="margin-bottom:10px">
					<div class="col-sm-4">
						<img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 100px;width: 88px;">
					</div>	
				    <div class="col-sm-8">
                    <?php if($ProfileInfo['IsObservation']==1) {?>
					<?php if ($ProfileP['IsApproved']==0) { ?>
						<select class="form-control" name="ApproveProfilePhoto[]" id="ApproveProfilePhoto_<?php echo $i;?>" style="width:95px;padding:4px;margin-top:7px;height: 28px;" onchange="ReasonForRejectProfilePhoto('<?php echo $i;?>');">
							<option value="<?php echo $ProfileP['ProfileCode']."#".$ProfileP['ProfilePhotoID']."#".$ProfileP['ProfileID']."#".$ProfileP['MemberID']."#0";?>" <?php echo ($ProfileP['IsApproved']==0) ? " selected='selected' " : "";?>>No Action</option>
							<option value="<?php echo $ProfileP['ProfileCode']."#".$ProfileP['ProfilePhotoID']."#".$ProfileP['ProfileID']."#".$ProfileP['MemberID']."#1";?>" <?php echo ($ProfileP['IsApproved']==1) ? " selected='selected' " : "";?>>Approve</option>
							<option value="<?php echo $ProfileP['ProfileCode']."#".$ProfileP['ProfilePhotoID']."#".$ProfileP['ProfileID']."#".$ProfileP['MemberID']."#2";?>" <?php echo ($ProfileP['IsApproved']==2) ? " selected='selected' " : "";?>>Reject</option>
						</select>
						<br>
						<div style="display:none;" id="ReasonForRejectProfilePhotoDiv_<?php echo $i;?>">
							<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectProfilePhoto_<?php echo $i;?>" name="ReasonForRejectProfilePhoto_<?php echo $i;?>" value="<?php echo (isset($_POST['ReasonForRejectProfilePhoto_'.$i]) ? $_POST['ReasonForRejectProfilePhoto_'.$i] : $ProfileP['ReasonForReject']);?>">
						</div>
						<div style="display:none;" id="ProfilePhotoDivSave_<?php echo $i;?>" style="float:right">
                            <button type="submit" class="btn btn-success" name="Verify" style="font-family:roboto">Save</button>
                        </div>
					<?php $i++; }  else {?>
						<?php if($ProfileP['IsApproved']==1) { ?>
							<?php if($ProfileP['PriorityFirst']==1) { ?>
								<span style="color:green">Default Thumb</span><br>
							<?php } ?>
							<span>Approved</span><br>
							<span><?php echo putDateTime($ProfileP['IsApprovedOn']);?></span>
						<?php }  else {?>
							<?php if($ProfileP['PriorityFirst']==1) { ?>
								<span style="color:green">Default Thumb</span><br>
							<?php } ?>
							<span>Rejected</span><br>
							<span><?php echo putDateTime($ProfileP['RejectedOn']);?></span><br>
							<span><?php echo $ProfileP['ReasonForReject'];?>
					<?php } } }?>
					</div>
				</div>
			<?php }?>
			</div>
            <?php if($ProfileInfo['IsObservation']==1) {?>
			<?php if($ProfileP['IsApproved']==0) { ?>
			<div style="float:right">
				<button type="submit" class="btn btn-success" name="Verify" style="font-family:roboto">Save</button>
			</div>
			<?php } }?>
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
         <div class="form-group row">
            <label class="col-sm-9 col-form-label" style="color:#737373;font-size:13px"><?php echo trim($ProfileInfo['AboutMe']);?></label>
		    <?php if($ProfileInfo['IsObservation']==1) {?>
        	<div class="col-sm-3" style="border-left: 1px solid #ddd;">
				<?php if($GIVerification['IsVerified']==0) { ?>
					<select class="form-control" name="ApproveAboutMeInfo[]" id="ApproveAboutMeInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectAboutMeInfo();">
						<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($GIVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
						<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($GIVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
						<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($GIVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
					</select>
					<div style="display:none;" id="ReasonForRejectAboutMeInfoDiv">
						<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectAboutMeInformation" name="ReasonForRejectAboutMeInformation" style="margin-top: 10px;">
					</div>
					<div id="AboutMeInfoSave"><button type="submit" class="btn btn-success" name="VerifyAboutMeInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
					<?php }  else {?>
					<?php if($GIVerification['IsVerified']==1) { ?>
						<span>Approved</span><br>
						<span><?php echo putDateTime($GIVerification['IsVerifiedOn']);?></span>
					<?php }  else {?>
						<span>Rejected</span><br>
						<span><?php echo putDateTime($GIVerification['RejectedOn']);?></span><br>
						<span><?php echo $GIVerification['ReasonForReject'];?>
				<?php } } ?>
			</div>
            <?php } ?>
         </div>
    </div>
  </div>
</div>
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php 
					$i=1;
					foreach($EducationAttachment as $Document) { ?>
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
							<a href="javascript:void(0)" onclick="showAttachmentEducationInformationForView('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">
								<img src="<?php echo SiteUrl?>/uploads/profiles/<?php echo $Document['ProfileCode'];?>/edudoc/<?php echo $Document['FileName'];?>" style="height: 100px;width: 88px;border-radius: 0px;">
							</a>
                            <?php echo $Document['IsVerified']== 1 ? "Attachment Verifiled" : ""; ?> <br>
                        <?php } else { echo "Not Attach"; }?>
					</td>
					<td>
                    <?php if($ProfileInfo['IsObservation']==1) {?>
						<?php if($Document['IsVerified']==0) { ?>
						<select class="form-control" name="ApproveEducation[]" id="ApproveEducation_<?php echo $i;?>" style="width:95px;padding:4px;margin-top:7px;height: 28px;" onchange="ReasonForRejectEducation('<?php echo $i;?>');">
							<option value="<?php echo $Document['ProfileCode']."#".$Document['AttachmentID']."#".$Document['ProfileID']."#".$Document['MemberID']."#0";?>" <?php echo ($Document['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
							<option value="<?php echo $Document['ProfileCode']."#".$Document['AttachmentID']."#".$Document['ProfileID']."#".$Document['MemberID']."#1";?>" <?php echo ($Document['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
							<option value="<?php echo $Document['ProfileCode']."#".$Document['AttachmentID']."#".$Document['ProfileID']."#".$Document['MemberID']."#2";?>" <?php echo ($Document['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
						</select>
						<br>
						<div style="display:none;" id="ReasonForRejectEducationDiv_<?php echo $i;?>">
							<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectEducation_<?php echo $i;?>" name="ReasonForRejectEducation_<?php echo $i;?>" value="<?php echo (isset($_POST['ReasonForRejectEducation_'.$i]) ? $_POST['ReasonForRejectEducation_'.$i] : $Document['ReasonForReject']);?>">
						</div>
						<?php $i++; }  else {?>
						<?php if($Document['IsVerified']==1) { ?>
							<span>Approved</span><br>
							<span><?php echo putDateTime($Document['IsVerifiedOn']);?></span>
						<?php }  else {?>
							<span>Rejected</span><br>
							<span><?php echo putDateTime($Document['RejectedOn']);?></span><br>
							<span><?php echo $Document['ReasonForReject'];?>
					<?php } } }?>
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
        <?php if($ProfileInfo['IsObservation']==1) {?>
		<?php if($Document['IsVerified']==0) { ?>
			<div style="float:right">
				<button type="submit" class="btn btn-success" name="VerifyEducation" style="font-family:roboto">Save</button>
			</div>
		<?php } }?>
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
            <label class="col-sm-2 col-form-label">Employed as</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></label>
        </div>
        <?php if($ProfileInfo['EmployedAsCode']=="O001"){ ?>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Occupation type</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Occupation</label>                   
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['OccupationTypeCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['OtherOccupation']))> 0 ? trim($ProfileInfo['OtherOccupation']) : "N/A "; ?>
                <?php } else { echo $ProfileInfo['OccupationType']; } ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['OccupationDescription']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['OccupationDescription']) . "&nbsp;&nbsp;)"; }?>
            </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Annual income</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Working country</label>                      
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['WorkedCityName']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['WorkedCityName']) . "&nbsp;&nbsp;)"; }?>
            </label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Attachment</label>                      
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                <?php if($ProfileInfo['OccupationAttachFileName']==""){ echo "Not Attach";} else{ echo "Attached";?> &nbsp;&nbsp;
                (<a href="javascript:void(0)" onclick="showAttachmentOccupationForView('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $ProfileInfo['MemberID'];?>','<?php echo $ProfileInfo['ProfileID'];?>','<?php echo $ProfileInfo['OccupationAttachFileName'];?>')">View</a>) <?php }?>
            </label>
        </div>
        <?php }?>
        <?php if(strlen(trim($ProfileInfo['OccupationDetails']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
						<div class="form-group row">
							<div class="col-sm-9">
								<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['OccupationDetails']); ?></div>
							</div>
                            <?php if($ProfileInfo['IsObservation']==1) {?>
							<div class="col-sm-3" style="border-left: 1px solid #ddd;">
								<?php if($ODVerification['IsVerified']==0) { ?>
									<select class="form-control" name="ApproveOccupationDESC[]" id="ApproveOccupationDESC" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectOccupationAdditionalInfo();">
										<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($ODVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
										<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($ODVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
										<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($ODVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
									</select>
									<div style="display:none;" id="ReasonForRejectOccupationAdditionalInfoDiv">
										<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectOccupationAdditionalInformation" name="ReasonForRejectOccupationAdditionalInformation" style="margin-top: 10px;">
									</div>
									<div id="OccupationAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyOccupationAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
									<?php }  else {?>
									<?php if($ODVerification['IsVerified']==1) { ?>
										<span>Approved</span><br>
										<span><?php echo putDateTime($ODVerification['IsVerifiedOn']);?></span>
									<?php }  else {?>
										<span>Rejected</span><br>
										<span><?php echo putDateTime($ODVerification['RejectedOn']);?></span><br>
										<span><?php echo $ODVerification['ReasonForReject'];?>
								<?php } }  ?>
							</div>
                            <?php } ?>
						</div>
					
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
            <label class="col-sm-2 col-form-label">Father's name</label>                
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersName']))> 0 ? trim($ProfileInfo['FathersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersAlive'])))>0){?><?php if($ProfileInfo['FathersAlive']=="1") { echo "(Passed away)" ;}?><?php } ?></label>
        </div>
        <?php if($ProfileInfo['FathersAlive']=="0"){?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's contact</label>            
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['FathersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>-<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Father's occupation</label>         
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['FathersOccupationCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['FatherOtherOccupation']))> 0 ? trim($ProfileInfo['FatherOtherOccupation']) : "N/A "; ?>
                <?php } else { echo strlen(trim($ProfileInfo['FathersOccupation']))> 0 ? trim($ProfileInfo['FathersOccupation']) : "N/A "; } ?>
            </label>
        </div>
        <div class="form-group row">
            <?php if($ProfileInfo['FathersOccupationCode']!="OT107") {?>
            <label class="col-sm-2 col-form-label">Father's income</label>              
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FathersIncome']))> 0 ? trim($ProfileInfo['FathersIncome']) : "N/A "; ?></label>
           <?php } ?>
        </div>                                                                         
        <?php }?>
        <div class="form-group row">                                                    
             <label class="col-sm-2 col-form-label">Mother's name</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersName']))> 0 ? trim($ProfileInfo['MothersName']) : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersAlive'])))>0){?><?php if($ProfileInfo['MothersAlive']=="1"){ echo "(Passed away)" ;}?><?php } ?> </label>
         </div>
         <?php if($ProfileInfo['MothersAlive']=="0"){?>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mother's contact</label>           
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MothersContact'])))>0){?><?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>-<?php echo $ProfileInfo['MothersContact'];?><?php  } else{ echo "N/A";}?></label>
         </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Mother's occupation</label>         
              <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['MothersOccupationCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['MotherOtherOccupation']))> 0 ? trim($ProfileInfo['MotherOtherOccupation']) : "N/A "; ?>
                <?php } else { echo strlen(trim($ProfileInfo['MothersOccupation']))> 0 ? trim($ProfileInfo['MothersOccupation']) : "N/A "; } ?>
            </label>
        </div>
        <div class="form-group row">
            <?php if($ProfileInfo['MothersOccupationCode']!="OT107") {?>
             <label class="col-sm-2 col-form-label">Mother's income</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MothersIncome']))> 0 ? trim($ProfileInfo['MothersIncome']) : "N/A "; ?></label>
            <?php } ?>
        </div>
        <?php }?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family location</label>                 
             <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyLocation1']))> 0 ? trim($ProfileInfo['FamilyLocation1']) : "N/A "; ?></label>
        </div>
        <?php if(strlen(trim($ProfileInfo['FamilyLocation2']))> 0) {?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label"></label>                 
             <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyLocation2']; ?></label>
        </div>
        <?php }?>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family type</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyType']))> 0 ? trim($ProfileInfo['FamilyType']) : "N/A "; ?></label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Ancestral / Origin</label>                 
             <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Ancestral']))> 0 ? trim($ProfileInfo['Ancestral']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Family affluence</label>             
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyAffluence']))> 0 ? trim($ProfileInfo['FamilyAffluence']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Family value</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['FamilyValue']))> 0 ? trim($ProfileInfo['FamilyValue']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number of brothers</label>          
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofBrothers']))> 0 ? trim($ProfileInfo['NumberofBrothers']) : "N/A "; ?></label>
             <?php if(trim($ProfileInfo['NumberofBrothers']) > 0){?>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Elder']))> 0 ? trim($ProfileInfo['Elder']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Younger']))> 0 ? trim($ProfileInfo['Younger']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Married</label>                      
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Married']))> 0 ? trim($ProfileInfo['Married']) : "N/A "; ?></label>
             <?php } ?>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Number of sisters</label>           
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['NumberofSisters']))> 0 ? trim($ProfileInfo['NumberofSisters']) : "N/A "; ?></label>
             <?php if(trim($ProfileInfo['NumberofSisters']) > 0){?>
             <label class="col-sm-1 col-form-label">Elder</label>                       
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ElderSister']))> 0 ? trim($ProfileInfo['ElderSister']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Younger</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['YoungerSister']))> 0 ? trim($ProfileInfo['YoungerSister']) : "N/A "; ?></label>
             <label class="col-sm-2 col-form-label">Married</label>                     
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['MarriedSister']))> 0 ? trim($ProfileInfo['MarriedSister']) : "N/A "; ?></label>
             <?php } ?>
        </div>
        <?php if(strlen(trim($ProfileInfo['AboutMyFamily']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
					<div class="form-group row">
						<div class="col-sm-9">
							<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['AboutMyFamily']); ?></div>
						</div>
                        <?php if($ProfileInfo['IsObservation']==1) {?>
						<div class="col-sm-3" style="border-left: 1px solid #ddd;">
							<?php if($FIVerification['IsVerified']==0) { ?>
								<select class="form-control" name="ApproveFamilyInfoAdditionalInfo[]" id="ApproveFamilyInfoAdditionalInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectFamilyInfoAdditionalInfo();">
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($FIVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($FIVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($FIVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
								</select>
								<div style="display:none;" id="ReasonForRejectFamilyInfoAdditionalInfoDiv">
									<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectFamilyInfoAdditionalInformation" name="ReasonForRejectFamilyInfoAdditionalInformation" style="margin-top: 10px;">
								</div>
								<div id="FamilyInfoAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyFamilyInfoAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
								<?php }  else {?>
								<?php if($FIVerification['IsVerified']==1) { ?>
									<span>Approved</span><br>
									<span><?php echo putDateTime($FIVerification['IsVerifiedOn']);?></span>
								<?php }  else {?>
									<span>Rejected</span><br>
									<span><?php echo putDateTime($FIVerification['RejectedOn']);?></span><br>
									<span><?php echo $FIVerification['ReasonForReject'];?>
							<?php } }?>
							</div>
                        <?php } ?>
						</div>
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
            <label class="col-sm-2 col-form-label">Physically impaired?</label>         
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PhysicallyImpaired']))> 0 ? trim($ProfileInfo['PhysicallyImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['PhysicallyImpaireddescription']))> 0 ? trim($ProfileInfo['PhysicallyImpaireddescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Visually impaired?</label>         
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VisuallyImpaired']))> 0 ? trim($ProfileInfo['VisuallyImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['VisuallyImpairedDescription']))> 0 ? trim($ProfileInfo['VisuallyImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vision impaired?</label>         
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['VissionImpaired']))> 0 ? trim($ProfileInfo['VissionImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['VissionImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['VissionImpairedDescription']))> 0 ? trim($ProfileInfo['VissionImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Speech impaired?</label>         
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SpeechImpaired']))> 0 ? trim($ProfileInfo['SpeechImpaired']) : "N/A "; ?>&nbsp;
                <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){ echo ",";?>
                    <?php echo strlen(trim($ProfileInfo['SpeechImpairedDescription']))> 0 ? trim($ProfileInfo['SpeechImpairedDescription']) : "N/A "; ?>
                <?php }?>
            </label>
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
             <label class="col-sm-2 col-form-label">Blood group</label>                 
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BloodGroup']))> 0 ? trim($ProfileInfo['BloodGroup']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Complexation</label>                
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Complexation']))> 0 ? trim($ProfileInfo['Complexation']) : "N/A "; ?>  
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Body type</label>                    
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['BodyType']))> 0 ? trim($ProfileInfo['BodyType']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Diet</label>                         
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Diet']))> 0 ? trim($ProfileInfo['Diet']) : "N/A "; ?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-2 col-form-label">Smoking habit</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['SmokingHabit']))> 0 ? trim($ProfileInfo['SmokingHabit']) : "N/A "; ?>
             </label>
             <label class="col-sm-2 col-form-label">Drinking habit</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DrinkingHabit']))> 0 ? trim($ProfileInfo['DrinkingHabit']) : "N/A "; ?>  
             </label>
        </div>
        <?php if(strlen(trim($ProfileInfo['PhysicalDescription']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
					<div class="form-group row">
						<div class="col-sm-9">
							<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['PhysicalDescription']); ?></div>
                        </div>
                        <?php if($ProfileInfo['IsObservation']==1) {?>
						<div class="col-sm-3" style="border-left: 1px solid #ddd;">
							<?php if($PIVerification['IsVerified']==0) { ?>
								<select class="form-control" name="ApprovePhysicalInfoAdditionalInfo[]" id="ApprovePhysicalInfoAdditionalInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectPhysicalInfoAdditionalInfo();">
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($PIVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($PIVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($PIVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
								</select>
								<div style="display:none;" id="ReasonForRejectPhysicalInfoAdditionalInfoDiv">
									<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectPhysicalInfoAdditionalInformation" name="ReasonForRejectPhysicalInfoAdditionalInformation" style="margin-top: 10px;">
								</div>
								<div id="PhysicalInfoAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyPhysicalInfoAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
								<?php }  else {?>
								<?php if($PIVerification['IsVerified']==1) { ?>
									<span>Approved</span><br>
									<span><?php echo putDateTime($PIVerification['IsVerifiedOn']);?></span>
								<?php }  else {?>
									<span>Rejected</span><br>
									<span><?php echo putDateTime($PIVerification['RejectedOn']);?></span><br>
									<span><?php echo $PIVerification['ReasonForReject'];?>
							<?php } }?>
						</div>
                        <?php } ?>
						</div>
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
            <div class="col-sm-6"><h4 class="card-title">Horoscope Details</h4></div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Date of birth</label>               
            <label class="col-sm-2 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['DateofBirth']))> 0 ? trim($ProfileInfo['DateofBirth']) : "N/A "; ?></label>
				<div class="col-sm-8">
					<div class="col-sm-12">
                    <?php if($ProfileInfo['IsObservation']==1) {?>
					<?php if($HDobVerification['IsVerified']==0) { ?>
						<div class="col-sm-2" style="margin-right:2px">
							<select class="form-control" name="ApproveHoroscopeDob[]" id="ApproveHoroscopeDob" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectHoroscopeDob();">
								<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($HDobVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
								<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($HDobVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
								<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($HDobVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
							</select>
						</div>
						<div class="col-sm-5">
							<div style="display:none;" id="ReasonForRejectHoroscopeDobDiv">
								<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectHoroscopeDobInfo" name="ReasonForRejectHoroscopeDobInfo">
							</div>
						</div>
						<div class="col-sm-2">
							<div id="HoroscopeDobInfoSave"><button type="submit" class="btn btn-success" name="VerifyHoroscopeDOB" style="font-family:roboto">Save</button></div>
						</div>
					
					<?php }  else { ?>
					<?php if($HDobVerification['IsVerified']==1) { ?>
						<div class="col-sm-12">
							Approved &nbsp;&nbsp;<?php echo putDateTime($HDobVerificationDoc['IsVerifiedOn']);?>
						</div>
					<?php }  else {?>
						<div class="col-sm-12">
							Rejected &nbsp;&nbsp;<?php echo putDateTime($HDobVerificationDoc['RejectedOn']);?>&nbsp;&nbsp;<?php echo $HDobVerification['ReasonForReject'];?> 
						</div>
					<?php } } }?>
					</div>
				</div>
			</div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Time of birth</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TimeOfBirth']))> 0 ? trim($ProfileInfo['TimeOfBirth']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Place of birth</label>               
            <label class="col-sm-5 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PlaceOfBirth']))> 0 ? trim($ProfileInfo['PlaceOfBirth']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['StarName']))> 0 ? trim($ProfileInfo['StarName']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Rasi name</label>                   
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['RasiName']))> 0 ? trim($ProfileInfo['RasiName']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Lakanam</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Lakanam']))> 0 ? trim($ProfileInfo['Lakanam']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Chevvai dhosham</label>              
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ChevvaiDhosham']))> 0 ? trim($ProfileInfo['ChevvaiDhosham']) : "N/A "; ?></label>
        </div>
        <?php if(strlen(trim($ProfileInfo['HoroscopeDetails']))> 0){ ?>
         <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width:132px;">Additional information</legend>
					<div class="form-group row">
						<div class="col-sm-9">
							<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['HoroscopeDetails']); ?></div>
						</div>
						<div class="col-sm-3" style="border-left: 1px solid #ddd;">
                        <?php if($ProfileInfo['IsObservation']==1) {?>
							<?php if($HDVerification['IsVerified']==0) { ?>
								<select class="form-control" name="ApproveHoroscopeAdditionalInfo[]" id="ApproveHoroscopeAdditionalInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectHoroscopeAdditionalInfo();">
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($HDVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($HDVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($HDVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
								</select>
								<div style="display:none;" id="ReasonForRejectHoroscopeAdditionalInfoDiv">
									<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectHoroscopeAdditionalInformation" name="ReasonForRejectHoroscopeAdditionalInformation" style="margin-top: 10px;">
								</div>
								<div id="HoroscopeAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyHoroscopeAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
								<?php }  else {?>
								<?php if($HDVerification['IsVerified']==1) { ?>
									<span>Approved</span><br>
									<span><?php echo putDateTime($HDVerification['IsVerifiedOn']);?></span>
								<?php }  else {?>
									<span>Rejected</span><br>
									<span><?php echo putDateTime($HDVerification['RejectedOn']);?></span><br>
									<span><?php echo $HDVerification['ReasonForReject'];?>
							<?php } } } ?>
						</div>
					</div>
				</fieldset>
            </div>
        </div><br>
        <?php }?>
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
         </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Age </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeFrom']))> 0 ? trim($PartnerExpectation['AgeFrom']) : "N/A "; ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AgeTo']))> 0 ? trim($PartnerExpectation['AgeTo']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Marital status</label>               
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['MaritalStatus']))> 0 ? trim($PartnerExpectation['MaritalStatus']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Religion</label>                     
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Religion']))> 0 ? trim($PartnerExpectation['Religion']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Caste</label>                        
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Caste']))> 0 ? trim($PartnerExpectation['Caste']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education</label>                   
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['Education']))> 0 ? trim($PartnerExpectation['Education']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Employed as</label>                 
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['EmployedAs']))> 0 ? trim($PartnerExpectation['EmployedAs']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Income range</label>                
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['AnnualIncome']))> 0 ? trim($PartnerExpectation['AnnualIncome']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rasi name</label>                
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['RasiName']))> 0 ? trim($PartnerExpectation['RasiName']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Star name</label>                
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['StarName']))> 0 ? trim($PartnerExpectation['StarName']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Chevvai dhosham</label>                
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($PartnerExpectation['ChevvaiDhosham']))> 0 ? trim($PartnerExpectation['ChevvaiDhosham']) : "N/A "; ?></label>
        </div>
         <?php if(strlen(trim($PartnerExpectation['Details']))> 0){ ?>
         <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width: 132px;">Additional information</legend>
					<div class="form-group row">
						<div class="col-sm-9">
							<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($PartnerExpectation['Details']); ?></div>
						</div>
                        <?php if($ProfileInfo['IsObservation']==1) {?>
						<div class="col-sm-3" style="border-left: 1px solid #ddd;">
							<?php if($PEVerification['IsVerified']==0) { ?>
								<select class="form-control" name="ApprovePartnerExpectationAdditionalInfo[]" id="ApprovePartnerExpectationAdditionalInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectPartnerExpectationAdditionalInfo();">
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($PEVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($PEVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($PEVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
								</select>
								<div style="display:none;" id="ReasonForRejectPartnerExpectationAdditionalInfoDiv">
									<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectPartnerExpectationAdditionalInformation" name="ReasonForRejectPartnerExpectationAdditionalInformation" style="margin-top: 10px;">
								</div>
								<div id="PartnerExpectationAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyPartnerExpectationAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
								<?php }  else {?>
								<?php if($PEVerification['IsVerified']==1) { ?>
									<span>Approved</span><br>
									<span><?php echo putDateTime($PEVerification['IsVerifiedOn']);?></span>
								<?php }  else {?>
									<span>Rejected</span><br>
									<span><?php echo putDateTime($PEVerification['RejectedOn']);?></span><br>
									<span><?php echo $PEVerification['ReasonForReject'];?>
							<?php } }?>
						</div>
                        <?php } ?>
					</div>
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
            <div class="col-sm-6"><h4 class="card-title">Communication Details</h4></div>
         </div>
         <div class="form-group row">                                                   
            <label class="col-sm-2 col-form-label">Person name</label>                    
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['ContactPersonName']))> 0 ? trim($ProfileInfo['ContactPersonName']) : "N/A "; ?></label>
        </div>
         <div class="form-group row">                                                   
            <label class="col-sm-2 col-form-label">Relation</label>                    
            <label class="col-sm-3 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Relation']))> 0 ? trim($ProfileInfo['Relation']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Primary priority</label>                    
            <label class="col-sm-3 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['PrimaryPriority']))> 0 ? trim($ProfileInfo['PrimaryPriority']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">                                                   
            <label class="col-sm-2 col-form-label">Email id</label>                    
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmailID']))> 0 ? trim($ProfileInfo['EmailID']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mobile number</label>               
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php if((strlen(trim($ProfileInfo['MobileNumber'])))>0){?><?php echo "+"; echo $ProfileInfo['MobileNumberCountryCode'];?>-<?php echo $ProfileInfo['MobileNumber'];?><?php  } else{ echo "N/A";}?></label>
            <label class="col-sm-2 col-form-label">Whatsapp number</label>             
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
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Landmark</label>               
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['OtherLocation']))> 0 ? trim($ProfileInfo['OtherLocation']) : "N/A "; ?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">State</label>                       
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['State']))> 0 ? trim($ProfileInfo['State']) : "N/A "; ?></label>
            <label class="col-sm-2 col-form-label">Country</label>                     
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['Country']))> 0 ? trim($ProfileInfo['Country']) : "N/A "; ?></label>
        </div> 
        <?php if(strlen(trim($ProfileInfo['CommunicationDescription']))> 0){ ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <fieldset>
                    <legend style="width: 132px;">Additional information</legend>
					<div class="form-group row">
						<div class="col-sm-9">
							<div style="color:#737373;">&nbsp;&nbsp;<?php echo trim($ProfileInfo['CommunicationDescription']); ?></div>
						</div>
                        <?php if($ProfileInfo['IsObservation']==1) {?>
						<div class="col-sm-3" style="border-left: 1px solid #ddd;">
							<?php if($CDVerification['IsVerified']==0) { ?>
								<select class="form-control" name="ApproveCommunicationAdditionalInfo[]" id="ApproveCommunicationAdditionalInfo" style="width:95px;padding:4px;height: 28px;" onchange="ReasonForRejectCommunicationAdditionalInfo();">
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#0";?>" <?php echo ($CDVerification['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#1";?>" <?php echo ($CDVerification['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
									<option value="<?php echo $ProfileInfo['ProfileID']."#".$ProfileInfo['MemberID']."#".$ProfileInfo['MemberCode']."#".$ProfileInfo['ProfileCode']."#2";?>" <?php echo ($CDVerification['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
								</select>
								<div style="display:none;" id="ReasonForRejectCommunicationAdditionalInfoDiv">
									<input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectCommunicationAdditionalInformation" name="ReasonForRejectCommunicationAdditionalInformation" style="margin-top: 10px;">
								</div>
								<div id="CommunicationAdditionalInfoSave"><button type="submit" class="btn btn-success" name="VerifyCommunicationAdditionInfo" style="font-family:roboto;margin-top: 10px;">Save</button></div>
								<?php }  else {?>
								<?php if($CDVerification['IsVerified']==1) { ?>
									<span>Approved</span><br>
									<span><?php echo putDateTime($CDVerification['IsVerifiedOn']);?></span>
								<?php }  else {?>
									<span>Rejected</span><br>
									<span><?php echo putDateTime($CDVerification['RejectedOn']);?></span><br>
									<span><?php echo $CDVerification['ReasonForReject'];?>
							<?php } }?>
						</div>
                        <?php } ?>
					</div>
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
        <div class="col-sm-6"><h4 class="card-title">Attached Documents</h4></div>
        <div class="col-sm-6" style="text-align: right;"><h4 class="card-title" style="color:green">For Admnistrative Purpose only</h4><br>
        </div>
    </div>
    
        <div class="form-group row">
         <?php 
			$i=1;
			foreach($response['data']['Documents'] as $Doc) { ?>
                   <div class="Documentview">
                    <img src="<?php echo $Doc['AttachFileName'];?>" style="width: 200px;height:150px">   <br>
                    <label style="color:#737373;"><?php echo $Doc['DocumentType'];?></label> <br>
                    <label style="color:#737373;">
                    <?php if($ProfileInfo['IsObservation']==1) {?>
						<?php if($Doc['IsVerified']==0) { ?>
                        <select class="form-control" name="ApproveDocument[]" id="ApproveDocument_<?php echo $i;?>" style="width:95px;padding:4px;margin-top:7px;height: 28px;" onchange="ReasonForRejectDocuments('<?php echo $i;?>');">
                            <option value="<?php echo $Doc['ProfileCode']."#".$Doc['AttachmentID']."#".$Doc['ProfileID']."#".$Doc['MemberID']."#0";?>" <?php echo ($Doc['IsVerified']==0) ? " selected='selected' " : "";?>>No Action</option>
                            <option value="<?php echo $Doc['ProfileCode']."#".$Doc['AttachmentID']."#".$Doc['ProfileID']."#".$Doc['MemberID']."#1";?>" <?php echo ($Doc['IsVerified']==1) ? " selected='selected' " : "";?>>Approve</option>
                            <option value="<?php echo $Doc['ProfileCode']."#".$Doc['AttachmentID']."#".$Doc['ProfileID']."#".$Doc['MemberID']."#2";?>" <?php echo ($Doc['IsVerified']==2) ? " selected='selected' " : "";?>>Reject</option>
                        </select> <br>
                        <div style="display:none;" id="ReasonForRejectDocumentsDiv_<?php echo $i;?>">
                            <input type="text" class="form-control" placeholder="Reason For Reject" id="ReasonForRejectDocuments_<?php echo $i;?>" name="ReasonForRejectDocuments_<?php echo $i;?>" value="<?php echo (isset($_POST['ReasonForRejectDocuments_'.$i]) ? $_POST['ReasonForRejectDocuments_'.$i] : $Doc['ReasonForReject']);?>">
                        </div>
                                <div style="display:none;" id="DocumentsVerificationSave"><button type="submit" class="btn btn-success" name="VerifyDocument" style="font-family:roboto">Save</button></div>
						<?php $i++; }  else {?>
						<?php if($Doc['IsVerified']==1) { ?>
							<span>Approved</span><br>
							<span><?php echo putDateTime($Doc['IsVerifiedOn']);?></span>
						<?php }  else {?>
							<span>Rejected</span><br>
							<span><?php echo putDateTime($Doc['RejectedOn']);?></span><br>
							<span><?php echo $Doc['ReasonForReject'];?>
					<?php } }?>
                    <?php } ?>
					</label>
                  </div>
                  <?php  }  ?>
         </div>
    </div>
  </div>                                                                                                               
</div>
<?php if($ProfileInfo['IsObservation']==1) {?>
  <div style="text-align: right">
     <?php if($ProfileInfo['IsApproved']==1){?>
         Profile Already Published
     <?php } else {?>
       <a href="javascript:void(0)" onclick="showConfirmPublishForDAT('<?php echo $_GET['Code'];?>')"  class="btn btn-success" name="Approve" style="font-family:roboto">Approve</a>&nbsp;
      <!--  <button type="submit" class="btn btn-success" name="Approve" style="font-family:roboto">Approve</button>&nbsp; -->
        <button type="submit" class="btn btn-warning" name="Reject" style="font-family:roboto">Reject</button>
        <button type="submit" class="btn btn-danger" name="Delete" style="font-family:roboto">Delete</button>
        <?php }?>
    </div>
  <?php }  ?>
 </form> 
        <div class="modal" id="ApproveNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Approve_body" style="height:315px">
            
                </div>
            </div>
        </div>
       <div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
            
                </div>
            </div>
        </div>                                                                                                              
<script>
function ReasonForRejectProfilePhoto(id) {
            if ($('#ApproveProfilePhoto_'+id+'  :selected').text()=="Reject") {
                $('#ReasonForRejectProfilePhotoDiv_'+id).show();
            } else {
                $('#ReasonForRejectProfilePhotoDiv_'+id).hide();
				$('#ReasonForRejectProfilePhoto_'+id).val("");
            }
            if ($('#ApproveProfilePhoto_'+id+' :selected').text()=="No Action") {
                $('#ProfilePhotoDivSave_'+id).hide();
            } else {
                $('#ProfilePhotoDivSave_'+id).show();
                 }
        }
function ReasonForRejectEducation(id) {
            if ($('#ApproveEducation_'+id+'  :selected').text()=="Reject") {
                $('#ReasonForRejectEducationDiv_'+id).show();
            } else {
                $('#ReasonForRejectEducationDiv_'+id).hide();
				$('#ReasonForRejectEducation_'+id).val("");
            }
        }
function ReasonForRejectDocuments(id) {
            if ($('#ApproveDocument_'+id+'  :selected').text()=="Reject") {
                $('#ReasonForRejectDocumentsDiv_'+id).show();
            } else {
                $('#ReasonForRejectDocumentsDiv_'+id).hide();
				$('#ReasonForRejectDocuments_'+id).val("");        
            }
            if ($('#ApproveDocument_'+id+' :selected').text()=="No Action") {
                $('#DocumentsVerificationSave').hide();
            } else {
                $('#DocumentsVerificationSave').show();
                 }
        }
function ReasonForRejectAboutMeInfo() {
            if ($('#ApproveAboutMeInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectAboutMeInfoDiv').show();
            } else {
                $('#ReasonForRejectAboutMeInfoDiv').hide();
				$('#ReasonForRejectAboutMeInformation').val("");
            }
			if ($('#ApproveAboutMeInfo  :selected').text()=="No Action") {
                $('#AboutMeInfoSave').hide();
            } else {
                $('#AboutMeInfoSave').show();
				 }
        }
function ReasonForRejectOccupationAdditionalInfo() {
            if ($('#ApproveOccupationDESC  :selected').text()=="Reject") {
                $('#ReasonForRejectOccupationAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectOccupationAdditionalInfoDiv').hide();
				$('#ReasonForRejectOccupationAdditionalInformation').val("");
            }
			if ($('#ApproveOccupationDESC  :selected').text()=="No Action") {
                $('#OccupationAdditionalInfoSave').hide();
            } else {
                $('#OccupationAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectFamilyInfoAdditionalInfo() {
            if ($('#ApproveFamilyInfoAdditionalInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectFamilyInfoAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectFamilyInfoAdditionalInfoDiv').hide();
				$('#ReasonForRejectFamilyInfoAdditionalInformation').val("");
            }
			if ($('#ApproveFamilyInfoAdditionalInfo  :selected').text()=="No Action") {
                $('#FamilyInfoAdditionalInfoSave').hide();
            } else {
                $('#FamilyInfoAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectPhysicalInfoAdditionalInfo() {
            if ($('#ApprovePhysicalInfoAdditionalInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectPhysicalInfoAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectPhysicalInfoAdditionalInfoDiv').hide();
				$('#ReasonForRejectPhysicalInfoAdditionalInformation').val("");
            }
			if ($('#ApprovePhysicalInfoAdditionalInfo  :selected').text()=="No Action") {
                $('#PhysicalInfoAdditionalInfoSave').hide();
            } else {
                $('#PhysicalInfoAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectPartnerExpectationAdditionalInfo() {
            if ($('#ApprovePartnerExpectationAdditionalInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectPartnerExpectationAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectPartnerExpectationAdditionalInfoDiv').hide();
				$('#ReasonForRejectPartnerExpectationAdditionalInformation').val("");
            }
			if ($('#ApprovePartnerExpectationAdditionalInfo  :selected').text()=="No Action") {
                $('#PartnerExpectationAdditionalInfoSave').hide();
            } else {
                $('#PartnerExpectationAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectCommunicationAdditionalInfo() {
            if ($('#ApproveCommunicationAdditionalInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectCommunicationAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectCommunicationAdditionalInfoDiv').hide();
				$('#ReasonForRejectCommunicationAdditionalInformation').val("");
            }
			if ($('#ApproveCommunicationAdditionalInfo  :selected').text()=="No Action") {
                $('#CommunicationAdditionalInfoSave').hide();
            } else {
                $('#CommunicationAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectHoroscopeAdditionalInfo() {
            if ($('#ApproveHoroscopeAdditionalInfo  :selected').text()=="Reject") {
                $('#ReasonForRejectHoroscopeAdditionalInfoDiv').show();
            } else {
                $('#ReasonForRejectHoroscopeAdditionalInfoDiv').hide();
				$('#ReasonForRejectHoroscopeAdditionalInformation').val("");
            }
			if ($('#ApproveHoroscopeAdditionalInfo  :selected').text()=="No Action") {
                $('#HoroscopeAdditionalInfoSave').hide();
            } else {
                $('#HoroscopeAdditionalInfoSave').show();
				 }
        }
function ReasonForRejectHoroscopeDob() {
            if ($('#ApproveHoroscopeDob  :selected').text()=="Reject") {
                $('#ReasonForRejectHoroscopeDobDiv').show();
            } else {
                $('#ReasonForRejectHoroscopeDobDiv').hide();
				$('#ReasonForRejectHoroscopeDobInfo').val("");
            }
			if ($('#ApproveHoroscopeDob  :selected').text()=="No Action") {
                $('#HoroscopeDobInfoSave').hide();
            } else {
                $('#HoroscopeDobInfoSave').show();
				 }
        }



ReasonForRejectAboutMeInfo();
ReasonForRejectOccupationAdditionalInfo();
ReasonForRejectFamilyInfoAdditionalInfo();
ReasonForRejectPhysicalInfoAdditionalInfo();
ReasonForRejectPartnerExpectationAdditionalInfo();
ReasonForRejectCommunicationAdditionalInfo();
ReasonForRejectHoroscopeAdditionalInfo();
ReasonForRejectHoroscopeDob();


function showConfirmPublishForDAT(ProfileID) {
      $('#PubplishNow').modal('show'); 
      var content = '<div >'
						+'<div>'                                                                              
							+'<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
								+'<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
								+'<div class="modal-header">'
									+'<h4 class="modal-title">Profile Publish</h4>'
									+'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
								+'</div>'
								+'<div class="modal-body" style="min-height: 226px;max-height: 226px;">'
									+'<div style="text-align:left"> Dear ,<br></div>'
									+'<div style="text-align:left">Are you sure want to publish this profile<br><br><br><br><br><br></div>'
								+'</div>' 
								+'<div class="modal-footer">'  
									+'<button type="button" class="btn btn-primary" name="Publish" id="PublishBtn"  onclick="TransactionPasswordSubmitDAT(\''+ProfileID+'\')" style="font-family:roboto">Yes</button>&nbsp;&nbsp;&nbsp;'
									+'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
								+'</div>'
							+'</form>'                                                                                                          
						+'</div>'
					+'</div>';
            $('#Publish_body').html(content);
}
function RequestToModify(ProfileCode) {
       //  var param = $( "#"+frmid).serialize();
         $('#Approve_body').html(preloader);
                    $.post( API_URL + "m=Admin&a=RequestToModify&ProfileCode="+ProfileCode, 
                            "",
                            function(result2) {
                                $('#Approve_body').html(result2);   
                            }
                    );
              
    } 
function TransactionPasswordSubmitDAT(formid) {
    var param = $("#frm_"+formid).serialize();
	$('#Publish_body').html(preloading_withText("Submitting profile ...","95"));
		$.post(API_URL + "m=Admin&a=TransactionPasswordSubmitDAT",param,function(result) {
			
			if (!(isJson(result))) {
				$('#Publish_body').html(result);
				return ;
			}
			var obj = JSON.parse(result);
			if (obj.status=="success") {
				$('#Publish_body').html(result);
			} else {
				var data = obj.data; 
				var content = '<div  style="height: 300px;">'                                                                              
								+'<div class="modal-header">'
									+'<h4 class="modal-title">Profile Verification</h4>'
									+'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
								+'</div>'
								+'<div class="modal-body" style="min-height:175px;max-height:175px;">'
									+ '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
								+'</div>' 
							+'</div>';
            $('#Publish_body').html(content);
			
			 
			}
		});
}
function TransactionPasswordVerificationDAT(frmid) {
        var param = $( "#"+frmid).serialize();
        $('#Publish_body').html(preloading_withText("Submitting profile ...","95"));
        $.post( API_URL + "m=Admin&a=TransactionPasswordVerificationDAT",param).done(function(result) {
			if (!(isJson(result))) {
				$('#Publish_body').html(result);
				return ;
			}
			var obj = JSON.parse(result);
			if (obj.status=="success") {
				
				var data = obj.data; 
				var content = '<div  style="height: 300px;">'                                                                              
								+'<div class="modal-body" style="min-height:175px;max-height:175px;">'
									+ '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
									+ '<h3 style="text-align:center;">Profile has been send to admin </h3>'
									+ '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
								+'</div>' 
							+'</div>';
            $('#Publish_body').html(content);
			
			 
			}
            
    });
}
function showAttachmentEducationInformationForView(AttachmentID,ProfileID,FileName) {
      $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                         + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Education Attachment</h4>'
                             + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div><br>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileID+'/edudoc/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#Approve_body').html(content);
}
function showAttachmentOccupationForView(ProfileCode,MemberID,ProfileID,FileName){
             $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="Occupationform_'+ProfileCode+'" name="Occupationform_'+ProfileCode+'" > '
                         + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                         + '<input type="hidden" value="'+MemberID+'" name="MemberID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Occupation Attachment</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileCode+'/occdoc/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#Approve_body').html(content);
        } 
        
        
</script>
 
   
            