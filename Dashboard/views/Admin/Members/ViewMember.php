<?php
   $response = $webservice->getData("Admin","GetMemberInfo");
   $Member          = $response['data']['MemberInfo'];
   $Plan=$response['data']['Plan'];
?>
<div class="row">
<div class="col-sm-9">
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div style="max-width:770px !important;">
                <h4 class="card-title" style="font-weight:399">View Member Information</h4>  
                 <?php if($Member['IsDeleted']==1){ ?>
                            <div class="alert alert-warning">
                                <strong>Warning!</strong>&nbsp;Member Status has deleted So you can't edit the details
                            </div> 
                            <?php } else {?>
                            <?php if($Member['IsActive']==0) {?>
                            <div class="alert alert-warning">
                                <strong>Warning!</strong>&nbsp;Member Status has deactivated So you can't edit the details
                            </div>
                            <?php } }?>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Member Code:</small> </div>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Member Name:</small> </div>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Date of Birth:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo PutDate($Member['DateofBirth']);?></small></div>
                </div>
                <div class="form-group row">    
                    <div class="col-sm-3"><small>Gender:</small> </div>
                    <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['Sex'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Mobile Number:</small></div>
                    <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?></small>&nbsp;&nbsp;
                        <?php if($Member['IsMobileVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?>
                    </div>
                </div>
                <?php if(strlen($Member['WhatsappNumber'])>0){ ?>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Whatsapp Number:</small></div>
                    <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Member['WhatsappCountryCode'];?>-<?php echo $Member['WhatsappNumber'];?></small></div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Email ID:</small></div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo  $Member['EmailID'];?></small> &nbsp;&nbsp;
                        <?php if($Member['IsEmailVerified']==1){ ?> <img src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } else {?><img class="imageGrey" src="<?php echo SiteUrl?>assets/images/icon_verified.png"><?php } ?>
                    </div>
                </div>
                                                                                                                       
            </div>                                      
        </div>    
    </div> 
</div>    

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div style="padding:15px !important;max-width:770px !important;">
                <?php if(sizeof($response['data']['IDProof'])==0 && sizeof($response['data']['AddressProof'])==0 ) { ?>
                    <h4 class="card-title">Kyc</h4>
                    <span style="text-align:center">No documents Available</span>
                <?php } else { ?>
                <div class="form-group row"> 
                  <div class="col-sm-6">
                    <h4 class="card-title">ID Proof</h4>  
                      <?php foreach($response['data']['IDProof'] as $KycIDP) {?>
                        <form method="post" id="frmfrn_<?php echo $KycIDP['DocID'];?>" >
                        <input type="hidden" value="" name="IDPtxnPassword" id="IDPtxnPassword_<?php echo $KycIDP['DocID'];?>">
                        <input type="hidden" value="" name="IDApproveReaseon" id="IDApproveReaseon_<?php echo $KycIDP['DocID'];?>">
                        <input type="hidden" value="" name="IDRejectReaseon" id="IDRejectReaseon_<?php echo $KycIDP['DocID'];?>">
                        <input type="hidden" value="" name="IsApproved" id="IsApproved_<?php echo $KycIDP['DocID'];?>">
                        <input type="hidden" value="" name="IsRejected" id="IsRejected_<?php echo $KycIDP['DocID'];?>">
                        <input type="hidden" value="<?php echo $_GET['Code'];?>" name="MemberID" id="MemberID">
                        <input type="hidden" value="<?php echo $KycIDP['DocID'];?>" name="DocID" id="DocID">
                        </form>
                         <div class="Documentview">
                            <img src="<?php echo AppUrl;?>uploads/members/<?php echo $Member['MemberCode'];?>/kyc/<?php echo $KycIDP['FileName'];?>" style="width: 200px;height:150px;border: 2px solid #d9d8d8;">
                        </div> 
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-12"><small style="color:#737373;font-weight: 600;"><?php echo $KycIDP['FileType'];?></small></div>
                        </div>
                        <div class="form-group row"  style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small>Submitted On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycIDP['SubmittedOn']);?></small></div>
                        </div>
                        <?php if($KycIDP['IsVerified']=="1" && $KycIDP['IsRejected']=="0"){?>
                        <div class="form-group row"  style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: green;">Verified On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycIDP['VerifiedOn']);?></small></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"><small style="color: green;">Verified By</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycIDP['VerifyByName'];?></small></div>
                        </div>
                        <?php }?>
                        <?php if($KycIDP['IsRejected']=="1"){?>
                        <div class="form-group row"  style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: red;">Rejected On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycIDP['RejectedOn']);?></small></div>
                        </div>
                        <div class="form-group row"  style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: red;">Reason</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycIDP['RejectedRemarks'];?></small></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"><small style="color: red;">Rejected By</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycIDP['VerifyByName'];?></small></div>
                        </div>
                        <?php }?>
                        <?php if($KycIDP['IsVerified']=="0" && $KycIDP['IsRejected']=="0"){?>
                        <div class="form-group row">
                            <div class="col-sm-3"><a href="javascript:void(0)" onclick="showConfirmApproved('<?php echo $KycIDP['DocID'];?>')" class="btn btn-success" name="AddressProofApproved" style="font-family:roboto">Approve</a></div>
                            <div class="col-sm-6"><a href="javascript:void(0)" onclick="showConfirmRejected('<?php echo $KycIDP['DocID'];?>')" class="btn btn-danger" name="AddressProofRejected" style="font-family:roboto">Reject</a></div>
                        </div>  
                        <?php }?>
                    <?php }?>
                    
                  </div>
                  <div class="col-sm-6">
                    <h4 class="card-title">Address Proof</h4>  
                            <?php foreach($response['data']['AddressProof'] as $KycADP) { ?>
                            <form method="post" id="frmfrAd_<?php echo $KycADP['DocID'];?>" >
                            <input type="hidden" value="" name="ADPtxnPassword" id="ADPtxnPassword_<?php echo $KycADP['DocID'];?>">
                            <input type="hidden" value="" name="AddressApproveReaseon" id="AddressApproveReaseon_<?php echo $KycADP['DocID'];?>">
                            <input type="hidden" value="" name="AddressRejectReaseon" id="AddressRejectReaseon_<?php echo $KycADP['DocID'];?>">
                            <input type="hidden" value="" name="IsApproved" id="IsApproved_<?php echo $KycADP['DocID'];?>">
                            <input type="hidden" value="" name="IsRejected" id="IsRejected_<?php echo $KycADP['DocID'];?>">
                            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="MemberID" id="MemberID">
                            <input type="hidden" value="<?php echo $KycADP['DocID'];?>" name="DocID" id="DocID">
                            </form>
                         <div class="Documentview">
                            <img src="<?php echo AppUrl;?>uploads/members/<?php echo $Member['MemberCode'];?>/kyc/<?php echo $KycADP['FileName'];?>" style="width: 200px;height:150px;border: 2px solid #d9d8d8;">
                        </div>
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-12"><small style="color:#737373;font-weight: 600;"><?php echo $KycADP['FileType'];?></small></div>
                        </div>
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small>Submitted On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycADP['SubmittedOn']);?></small></div>
                        </div>
                        <?php if($KycADP['IsVerified']=="1" && $KycADP['IsRejected']=="0"){?>
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: green;">Verified On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycADP['VerifiedOn']);?></small></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"><small style="color: green;">Verified By</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycADP['VerifyByName'];?></small></div>
                        </div>
                        <?php }?>
                        <?php if($KycADP['IsRejected']=="1"){?>
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: red;" style="margin-bottom: 2px;">Rejected On</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo putDatetime($KycADP['RejectedOn']);?></small></div>
                        </div>
                        <div class="form-group row" style="margin-bottom: 2px;">
                            <div class="col-sm-4"><small style="color: red;" style="margin-bottom: 2px;">Reason</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycADP['RejectedRemarks'];?></small></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"><small style="color: red;">Rejected By</small></div>
                            <div class="col-sm-8"><small style="color:#737373;"><?php echo $KycADP['VerifyByName'];?></small></div>
                        </div>
                        <?php }?>
                        <?php if($KycADP['IsVerified']=="0" && $KycADP['IsRejected']=="0"){?>
                        <div class="form-group row">
                            <div class="col-sm-3"><a href="javascript:void(0)" onclick="showConfirmAddressProofApproved('<?php echo $KycADP['DocID'];?>')" class="btn btn-success" name="AddressProofApproved" style="font-family:roboto">Approve</a></div>
                            <div class="col-sm-6"><a href="javascript:void(0)" onclick="showConfirmAddressProofRejected('<?php echo $KycADP['DocID'];?>')" class="btn btn-danger" name="AddressProofRejected" style="font-family:roboto">Reject</a></div>
                        </div>
                        <?php }?>
                         <?php }?>
                  </div> 
                </div>
                <?php } ?>
            </div>
        </div> 
    </div>
</div>    
 <div class="modal" id="ApproveNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Approve_body" style="height:235px">
            
                </div>
            </div>
        </div>  
    <div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>
</div>
<div class="col-sm-3">
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="" name="DeletedRemarks" id="DeletedRemarks">
    <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode">
            <div class="col-sm-12 col-form-label">
                Created On <br>
                <?php echo putDateTime($Member['CreatedOn']);?><br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                Franchisee <br>
                <span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)<br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                <span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>
                 &nbsp;&nbsp;&nbsp;
                 <small style="color:#737373;">
                    <?php if($Member['IsActive']==1){
                      echo "Active";
                    }else{
                      echo "Deactive"."( ".PutDatetime($Member['DeactivatedOn'])." )";
                    }?>
                 </small>
            </div>
            <?php if($Member['IsDeleted']==1) { ?>
                <div class="col-sm-12 col-form-label">
                     Deleted On <br>
                <?php echo putDateTime($Member['DeletedOn']);?>
                </div>
            <?php } ?>
            <div class="col-sm-12 col-form-label"><a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a></div>
            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/EditMember/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">Edit Member</small></a></div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmMemberChnPswd()"><small style="font-weight:bold;text-decoration:underline">Change Password</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Change Password</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmResetPassword()"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Reset Password</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label"><?php if($Member['IsActive']==1) { ?>
                <a href="javascript:void(0)" onclick="Member.ConfirmDeactiveMember()"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>                                   
                 <?php } else {    ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmActiveMember()"><small style="font-weight:bold;text-decoration:underline">Active</small></a>                                   
                <?php } ?>
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <?php if($Member['IsDeleted']==0) { ?>
                        <a href="javascript:void(0)" onclick="Member.ConfirmDeleteMember()"><small style="font-weight:bold;text-decoration:underline">Delete</small></a>                                   
                    <?php } else { ?>    
                        <a href="javascript:void(0)" onclick="Member.ConfirmRestoreMember()"><small style="font-weight:bold;text-decoration:underline">Restore</small></a>                                   
                    <?php } ?>
                <?php } else { ?> 
                    <?php if($Member['IsDeleted']==0) { ?>
                        <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Delete</small></a>
                     <?php } else { ?>
                         <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Restore</small></a>
                <?php } }  ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick=""><small style="font-weight:bold;text-decoration:underline">Profiles</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Profiles</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ShowMemberCurrentPlan('<?php echo $Plan['PlanCode'];?>','<?php echo $Plan['PlanName'];?>','<?php echo $Plan['Decreation'];?>','<?php echo $Plan['Amount'];?>','<?php echo $Plan['FreeProfiles'];?>','<?php echo PutDateTime($Plan['StartingDate']);?>','<?php echo PutDateTime($Plan['EndingDate']);?>')"><small style="font-weight:bold;text-decoration:underline">Member Plan</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Member Plan</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmSendIndividualSmsToMember('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>','<?php echo $Member['MobileNumber'];?>')"><small style="font-weight:bold;text-decoration:underline">Send Individual Sms</small></a>&nbsp;&nbsp;<a href="<?php echo GetUrl("Members/ListOfIndividualSMS/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">List</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Send Individual Sms</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmSendIndividualEmailToMember('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>','<?php echo $Member['EmailID'];?>')"><small style="font-weight:bold;text-decoration:underline">Send Individual Email</small></a>&nbsp;&nbsp;<a href="<?php echo GetUrl("Members/ListOfIndividualEmail/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">List</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Send Individual Email</small></a>
                <?php }   ?> 
            </div>
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsActive']==1 && $Member['IsDeleted']==0 ) { ?>
                    <a href="javascript:void(0)" onclick="Member.ConfirmPopupMessage('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>')"><small style="font-weight:bold;text-decoration:underline">Popup Message</small></a>&nbsp;&nbsp;<a href="<?php echo GetUrl("Members/ListOfIndividualMessages/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">List</small></a>
                <?php } else { ?> 
                    <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Popup Message</small></a>
                <?php }   ?> 
            </div>
           </form> 
        </div>
</div>    
<div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <h4 class="card-title">Drafted</h4>
                    </div>
                </div>
                  <?php 
                         $response = $webservice->getData("Admin","GetMemberProfileforView",array("ProfileFrom"=>"All"));   
                         
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                   ?>
               <div style="min-height: 200px;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                        <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                            <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                        <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $P['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Last Saved: ".time_elapsed_string($Profile['LastUpdatedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==0){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } ?>
                                    <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==1) {  ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewPublishProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php }?>
                                    <?php if($Profile['RequestToVerify']==0 && $Profile['IsApproved']==0) {  ?>
                                        <a href="<?php echo GetUrl("Profiles/ViewDraftProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php  }    ?>     
                            </div>
                        </div>  
                        <br> 
                  <?php }} else {?>  
                  <div style="padding:80px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found in your account
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                    </div> 
                  <?php } ?>
                </div>
              </div>
            </div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="form-group-row">
                <div class="col-sm-12">
                    <div class="col-sm-3" style="width: 15%;">
                        <div class="sidemenu" style="width: 170px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                            <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WalletRequests") ? ' linkactive1 ':'';?>" id="WalletRequests" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WalletRequests')" class="Notification" style="text-decoration:none"><span>Wallet Requests</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WalletTransactions") ? ' linkactive1 ':'';?>" id="WalletTransactions" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WalletTransactions')" class="Notification" style="text-decoration:none"><span>Wallet Transactions</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Orders") ? ' linkactive1 ':'';?>" id="Orders" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Orders')" class="Notification" style="text-decoration:none"><span>Orders</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Invoice") ? ' linkactive1 ':'';?>" id="Invoice" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Invoice')" class="Notification" style="text-decoration:none"><span>Invoice</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="RecentlyViewed") ? ' linkactive1 ':'';?>" id="RecentlyViewed" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('RecentlyViewed')" class="Notification" style="text-decoration:none"><span>Recently Viewed</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="RecentlyWhoViewed") ? ' linkactive1 ':'';?>" id="RecentlyWhoViewed" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('RecentlyWhoViewed')" class="Notification" style="text-decoration:none"><span>Recently Who Viewed</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Favorited") ? ' linkactive1 ':'';?>" id="Favorited" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Favorited')" class="Notification" style="text-decoration:none"><span>Favorited</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Mutual") ? ' linkactive1 ':'';?>" id="Mutual" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Mutual')" class="Notification" style="text-decoration:none"><span>Mutual</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WhoLiked") ? ' linkactive1 ':'';?>" id="WhoLiked" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WhoLiked')" class="Notification" style="text-decoration:none"><span>Who Liked</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="LoginLogs") ? ' linkactive1 ':'';?>" id="LoginLogs" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('LoginLogs')" class="Notification" style="text-decoration:none"><span>Login Logs</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Activities") ? ' linkactive1 ':'';?>" id="Activities" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Activities')" class="Notification" style="text-decoration:none"><span>Activities</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="EmailLog") ? ' linkactive1 ':'';?>" id="EmailLog" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('EmailLog')" class="Notification" style="text-decoration:none"><span>Email Log</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="SMSLog") ? ' linkactive1 ':'';?>" id="SMSLog" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('SMSLog')" class="Notification" style="text-decoration:none"><span>SMS Log</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>  
                    <div class="col-sm-9" style="margin-top: -8px;" >
                        <div class="Col-sm-12" id="resdiv" style="width: 100%;">    

                         </div>
                         <div style="display:none">
                            <div class="WalletRequests" id="WalletRequestsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Wallet Requests</h4>
                                <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"WalletRequests")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                                <tr>
                                                    <th>Req Id</th> 
                                                    <th>Req Date</th> 
                                                    <th>Bank Name</th> 
                                                    <th>A/C Number</th> 
                                                    <th>Txn Amount</th>  
                                                    <th>Txn Date</th>
                                                    <th>Txn Mode</th>
                                                    <th>Txn ID</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>  
                                            </thead>
                                            <tbody>  
                                            <?php foreach($response['data'] as $Requests) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $Requests['ReqID'];?></td>
                                                    <td><?php echo PutDateTime($Requests['RequestedOn']);?></td>
                                                    <td><?php echo $Requests['BankName'];?></td>
                                                    <td><?php echo $Requests['AccountNumber'];?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['RefillAmount'],2);?></td>
                                                    <td><?php echo PutDate($Requests['TransferedOn']);?></td>
                                                    <td><?php echo $Requests['TransferMode'];?></td>
                                                    <td><?php echo $Requests['TransactionID'];?></td>
                                                    <td><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                                                        echo "Pending";
                                                        }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                                                            echo "Approved";
                                                        }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                                                            echo "Rejected";}
                                                    ?></td>
                                                    <td><a href="<?php echo GetUrl("MyAccounts/ViewBankRequest/". $Requests['ReqID'].".htm");?>">View</a></td>
                                                </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Requests found at this time<br><br>
                                </div>     
                              <?php } ?>                                   
                            </div>
                            
                            <div class="WalletTransactions" id="WalletTransactionsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Wallet Transactions</h4>
                                  <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"WalletTransactions")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th>Transaction Date</th> 
                                                    <th>Particulars</th> 
                                                    <th style="text-align:right">Credits</th> 
                                                    <th style="text-align:right">Debits</th>  
                                                    <th style="text-align:right">Available Balance</th>
                                                </tr> 
                                            </thead>
                                            <tbody>  
                                            <?php foreach($response['data'] as $Requests) {
                                            ?>
                                                <tr>
                                                    <td><?php echo PutDateTime($Requests['TxnDate']);?></td>
                                                    <td><?php echo $Requests['Particulars'];?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['Credits'],2);?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['Debits'],2);?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['AvailableBalance'],2);?></td>
                                                </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No transactions found at this time<br><br>
                                </div>     
                              <?php } ?>   
                            </div>
                            
                            <div class="Orders" id="Ordersdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Orders</h4>
                                <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Order")); ?>
                                 <?php if (sizeof($response['data'])>0) {   ?>
                                    <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                        <thead>  
                                            <tr>
                                                <th>Order Number</th> 
                                                <th>Order Date</th> 
                                                <th style="text-align:right">Order Value</th> 
                                                <th>Invoice Number</th> 
                                                <th></th> 
                                            </tr>  
                                        </thead>
                                        <tbody>  
                                        <?php foreach($response['data'] as $Orders) {
                                        ?>
                                            <tr>
                                                <td><?php echo $Orders['OrderNumber'];?></td>
                                                <td><?php echo PutDateTime($Orders['OrderDate']);?></td>
                                                <td style="text-align:right"><?php echo number_format($Orders['OrderValue'],2);?></td>
                                                <td>
                                                    <?php if($Orders['IsPaid']==1){ 
                                                         echo $Orders['InvoiceNumber'];
                                                    } else{ ?>
                                                       <button type="submit" name="Paynow" class="btn btn-primary" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Pay Now</button>&nbsp;&nbsp; 
                                                       <button type="submit" name="Cancel" class="btn btn-danger" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Cancel</button> 
                                                  <?php }  ?>
                                                    
                                                </td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                        <?php } ?>            
                                        </tbody>                        
                                    </table>
                                </div>
                                <?php } else {?>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No orders found at this time<br><br>
        </div>
                                <?php } ?>
                            </div>
                            <div class="Invoice" id="Invoicediv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Invoice</h4>
                                         <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Invoice")); ?>
                                         <?php if (sizeof($response['data'])>0) {   ?>
                                    <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                        <thead>  
                                            <tr>
                                                <th>Invoice Number</th> 
                                                <th>Invoice Date</th> 
                                                <th>Order Number</th> 
                                                <th>Order Date</th> 
                                                <th style="text-align:right">Invoice Value</th> 
                                                <th></th>
                                            </tr>  
                                        </thead>
                                        <tbody>  
                                        <?php foreach($response['data'] as $Invoice) {
                                        ?>
                                            <tr>
                                                <td><?php echo $Invoice['InvoiceNumber'];?></td>
                                                <td><?php echo PutDateTime($Invoice['InvoiceDate']);?></td>
                                                <td><?php echo $Invoice['OrderNumber'];?></td>
                                                <td><?php echo PutDateTime($Invoice['OrderDate']);?></td>
                                                <td style="text-align:right"><?php echo number_format($Invoice['InvoiceValue'],2);?></td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                        <?php } ?>            
                                        </tbody>                        
                                    </table>
                                </div>
                                <?php } else {?>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No invoices found at this time<br><br>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="RecentlyViewed" id="RecentlyVieweddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Recently Viewed</h4>
                                   <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Recentlyviewed")); ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                      <?php foreach($response['data']as $P) { 
                                            $Profile = $P['ProfileInfo'];
                                            ?>
                                        <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                                            <div class="form-group row">
                                                <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                                                        <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                                    </div>
                                                <div class="col-sm-9">
                                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                                        <div class="form-group row">                                                                                     
                                                            <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                                            <div class="col-sm-4">
                                                                <div style="text-align:right;">
                                                                <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                                    <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                                    <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                                                <?php } else if ($Profile['isMutured']==1) {?>
                                                                    <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                                                <?php } else{?>
                                                                    <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                                                <?php }?>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="form-group row">
                                                           <div class="col-sm-7">
                                                                <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                                           </div>
                                                           <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                                           <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                                <br>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                                        <div><?php echo $Profile['Height'];?></div>
                                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                                        <div><?php echo $Profile['Caste'];?></div>
                                                    </div>
                                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                                        <div><?php echo $Profile['OccupationType'];?></div>
                                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                                    </div>
                                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                                        <?php echo $Profile['AboutMe'];?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="float:right;line-height: 1px;">
                                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                                <?php } else { ?>
                                                    Alredy Downloaded
                                                <?php } ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyRecentViewed");?>">view</a>
                                            </div>
                                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                                <div class="modal-dialog" style="width: 367px;">
                                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                                </div>
                                            </div>
                                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                                <div class="modal-dialog" style="width: 367px;">
                                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } else { ?>
                                        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                            No profiles found at this time<br><br>
                                        </div>     
                                      <?php } ?> 
                                
                            </div>
                            <div class="RecentlyWhoViewed" id="RecentlyWhoVieweddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Recently Who Viewed</h4>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No profiles found at this time<br><br>
                                    </div>
                            </div>
                            <div class="Favorited" id="Favoriteddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Favorited</h4>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No profiles found at this time<br><br>
                                    </div>
                            </div> 
                            <div class="WhoLiked" id="WhoLikeddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Who Liked</h4>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No profiles found at this time<br><br>
                                    </div>
                            </div>
                            <div class="Mutual" id="Mutualdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Mutual</h4>
                                <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No profiles found at this time<br><br>
                                    </div>
                            </div>
                            <div class="LoginLogs" id="LoginLogsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Login Logs</h4>
                                       <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"LoginLogs")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                             <thead>  
                                                <tr>
                                                    <th></th> 
                                                    <th></th> 
                                                    <th></th> 
                                                    <th>Loggedin</th>  
                                                    <th>Last accessed</th>  
                                                    <th>Loggedout</th>
                                                    <th>IP Address</th>
                                                    <th>Country</th>
                                                </tr>  
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) {
                    
                                                if ($History['LoginFrom']=="Web") {
                                                    $LoginFrom   = "domain.svg";
                                                    $accessTitle ="Web Browser";
                                                } 
                                                
                                                if ($History['Device']=="Desktop") {
                                                    $device      = "desktop.svg";
                                                    $deviceTitle = "Desktop";
                                                }
                                                
                                                if ($History['Device']=="Mobile") {
                                                    $device      = "smartphone.svg";
                                                    $deviceTitle = "Smart Phone";
                                                }
                                        ?>
                                        <tr>
                                            <td style="width:16px">
                                                <?php if ($History['LoginStatus']==1){?>
                                                    <img src="<?php echo ImagePath?>tick.gif" tilte="Successed Login" style="border-radius:0px !important;width: 16px;height: 16px;">
                                                <?php }else{ ?>
                                                    <img src="<?php echo ImagePath?>Red-Cross-Mark-PNG-Pic.png" tilte="Failed Login"  style="border-radius:0px !important;width: 10px;height: 10px;">
                                                <?php } ?>
                                            </td>
                                            <td style="width:16px"><img src="<?php echo ImagePath.$LoginFrom?>" title="<?php echo $accessTitle;?>" style="border-radius:0px !important;width: 16px;height: 16px;"></td>
                                            <td style="width:16px"><img src="<?php echo ImagePath.$device?>" title="<?php echo $deviceTitle;?>" style="border-radius:0px !important;width: 16px;height: 16px;"></td>
                                            <td style="width:110px"><?php echo putDateTime($History['LoginOn']);?></td>                         
                                            <td style="width:110px"><?php echo (strlen(trim($History['LastAccessOn']))>0) ? putDateTime($History['LastAccessOn']) : "";?></td>
                                            <td style="width:110px"><?php echo (strlen(trim($History['UserLogout']))>0) ? putDateTime($History['UserLogout']) : "";?></td>
                                            <td style="width:80px"><?php echo $History['BrowserIp'];?></td>
                                            <td><?php echo $History['CountryName'];?></td>
                                        </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No transactions found at this time<br><br>
                                </div>     
                              <?php } ?> 
                            </div>
                            <div class="Activities" id="Activitiesdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Activities</h4>
                                  <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Activities","Code"=>$_GET['Code'])); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th style="width: 110px;;">Activity On</th>
                                                    <th>Activity</th> 
                                                </tr>
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) { ?>
                                                <tr>
                                                    <td><?php echo putDateTime($History['ActivityOn']);?></td>
                                                    <td><?php echo $History['ActivityString'];?></td>
                                                </tr>
                                            <?php } ?>          
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Activities found at this time<br><br>
                                </div>     
                              <?php } ?>  
                            </div>
                            <div class="EmailLog" id="EmailLogdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Email Log</h4>
                                  <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"EmailLog","Code"=>$_GET['Code'])); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th style="width: 110px;;">Email On</th>
                                                    <th>Subject</th> 
                                                </tr>
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) { ?>
                                                <tr>
                                                    <td><?php echo putDateTime($History['EmailRequestedOn']);?></td>
                                                    <td><?php echo $History['EmailSubject'];?></td>
                                                </tr>
                                            <?php } ?>          
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Logs found at this time<br><br>
                                </div>     
                              <?php } ?>  
                            </div>
                            <div class="SMSLog" id="SMSLogdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>SMS Log</h4>
                                  <?php $response = $webservice->getData("Admin","GetMemberWalletAndProfileDetails",array("DetailFor"=>"SMSLog","Code"=>$_GET['Code'])); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th style="width: 110px;;">Email On</th>
                                                    <th>Subject</th> 
                                                </tr>
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) { ?>
                                                <tr>
                                                    <td><?php echo putDateTime($History['RequestedOn']);?></td>
                                                    <td><?php echo $History['TextMessage'];?></td>
                                                </tr>
                                            <?php } ?>          
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Logs found at this time<br><br>
                                </div>     
                              <?php } ?>  
                            </div>
                         </div>
                     </div>
                   </div>
                  </div>
                 </div> 
                </div>
</div>
<script>
 function loadPaymentOption(pOption){
     $("#resdiv").html("WalletRequestsdiv");
     if (pOption=="WalletRequests") {                  
        $("#resdiv").html($('#WalletRequestsdiv').html());
        $('#WalletRequests').css({"background":"#95abfb"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="WalletTransactions") {                  
        $("#resdiv").html($('#WalletTransactionsdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"#95abfb"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="Orders") {                  
        $("#resdiv").html($('#Ordersdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"#95abfb"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="Invoice") {                  
        $("#resdiv").html($('#Invoicediv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"#95abfb"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="RecentlyViewed") {                  
        $("#resdiv").html($('#RecentlyVieweddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"#95abfb"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"SMSLog"});
     }
     if (pOption=="RecentlyWhoViewed") {                  
        $("#resdiv").html($('#RecentlyWhoVieweddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"#95abfb"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="Favorited") {                  
        $("#resdiv").html($('#Favoriteddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"#95abfb"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="Mutual") {                  
        $("#resdiv").html($('#Mutualdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"#95abfb"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="WhoLiked") {                  
        $("#resdiv").html($('#WhoLikeddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"#95abfb"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="LoginLogs") {                  
        $("#resdiv").html($('#LoginLogsdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"#95abfb"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="Activities") {                  
        $("#resdiv").html($('#Activitiesdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"#95abfb"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="EmailLog") {                  
        $("#resdiv").html($('#EmailLogdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"#95abfb"});
        $('#SMSLog').css({"background":"Transparent"});
     }
     if (pOption=="SMSLog") {                  
        $("#resdiv").html($('#SMSLogdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
        $('#EmailLog').css({"background":"Transparent"});
        $('#SMSLog').css({"background":"#95abfb"});
     }
 }

function showConfirmApproved(DocID) {
    $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for approve</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to approve</div>'
                                + '</div>'
                                + 'Reason for Approved<br>'
                                + '<textarea class="form-control" rows="2" cols="3" id="ApproveRemarks_IDProof"></textarea>'
                                +'<div class="col-sm-12" id="frmRemark_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="GetTxnPswdfrApproveIDProof(\''+DocID+'\')" style="font-family:roboto">Yes, I want to appove</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
}
function GetTxnPswdfrApproveIDProof(DocID) {
        if ($("#ApproveRemarks_IDProof").val().trim()=="") {
             $("#frmRemark_error").html("Please enter reason");
             return false;
         }
        $("#IDApproveReaseon_"+DocID).val($("#ApproveRemarks_IDProof").val());
        $("#IsApproved_"+DocID).val('1');
        $("#IsRejected_"+DocID).val('0');
        var content =   '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for approve</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                             + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="AproveMemberIDProof(\''+DocID+'\')" class="btn btn-primary">Continue</button>'
                        + '</div>';
                $('#Publish_body').html(content);            
    }
function AproveMemberIDProof(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
         $("#frmTxnPass_error").html("Please enter transaction password");
         return false;
    }
    
    $("#IDPtxnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=AproveMemberIDProof",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">successfully Approved.</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Approve Document</h4>'
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
function showConfirmRejected(DocID) {
    $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reject</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to reject</div>'
                                + '</div>'
                                + 'Reason for Reject<br>'
                                + '<textarea class="form-control" rows="2" cols="3" id="RejectRemarks_IDProof"></textarea>'
                                +'<div class="col-sm-12" id="frmRejRemark_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" name="Create" class="btn btn-danger" onclick="GetTxnPswdfrRejectIDProof(\''+DocID+'\')" style="font-family:roboto">Yes, I want to reject</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
}
function GetTxnPswdfrRejectIDProof(DocID) {
        if ($("#RejectRemarks_IDProof").val().trim()=="") {
             $("#frmRejRemark_error").html("Please enter reason");
             return false;
         }
        $("#IDRejectReaseon_"+DocID).val($("#RejectRemarks_IDProof").val());
        $("#IsApproved_"+DocID).val('0');
        $("#IsRejected_"+DocID).val('1');
        var content =   '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for reject</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                             + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="RejectMemberIDProof(\''+DocID+'\')" class="btn btn-primary">Continue</button>'
                        + '</div>';
                $('#Publish_body').html(content);            
    }
function RejectMemberIDProof(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
         $("#frmTxnPass_error").html("Please enter transaction password");
         return false;
    }
    
    $("#IDPtxnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=RejectMemberIDProof",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">successfully Rejected.</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reject Document</h4>'
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


function showConfirmAddressProofApproved(DocID) {
    $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for approve</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to approve</div>'
                                + '</div>'
                                + 'Reason for Approved<br>'
                                + '<textarea class="form-control" rows="2" cols="3" id="ApproveRemarks_AddressProof"></textarea>'
                                +'<div class="col-sm-12" id="frmRemark_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="GetTxnPswdfrApproveAddressProof(\''+DocID+'\')" style="font-family:roboto">Yes, I want to appove</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
}
function GetTxnPswdfrApproveAddressProof(DocID) {
        if ($("#ApproveRemarks_AddressProof").val().trim()=="") {
             $("#frmRemark_error").html("Please enter reason");
             return false;
         }
        $("#AddressApproveReaseon_"+DocID).val($("#ApproveRemarks_AddressProof").val());
        $("#IsApproved_"+DocID).val('1');
        $("#IsRejected_"+DocID).val('0');
        var content =   '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for approve</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                             + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="AproveMemberAddressProof(\''+DocID+'\')" class="btn btn-primary">Continue</button>'
                        + '</div>';
                $('#Publish_body').html(content);            
    }
function AproveMemberAddressProof(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
         $("#frmTxnPass_error").html("Please enter transaction password");
         return false;
    }
    
    $("#ADPtxnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrAd_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=AproveMemberAddressProof",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">successfully Approved.</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Approve Document</h4>'
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

function showConfirmAddressProofRejected(DocID) {
    $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reject</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                          + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to reject</div>'
                                + '</div>'
                                + 'Reason for Reject<br>'
                                + '<textarea class="form-control" rows="2" cols="3" id="RejectRemarks_AddressProof"></textarea>'
                                +'<div class="col-sm-12" id="frmRejRemark_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-danger" onclick="GetTxnPswdfrRejectAddressProof(\''+DocID+'\')" style="font-family:roboto">Yes, I want to reject</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
}
function GetTxnPswdfrRejectAddressProof(DocID) {
        if ($("#RejectRemarks_AddressProof").val().trim()=="") {
             $("#frmRejRemark_error").html("Please enter reason");
             return false;
         }
        $("#AddressRejectReaseon_"+DocID).val($("#RejectRemarks_AddressProof").val());
        $("#IsApproved_"+DocID).val('0');
        $("#IsRejected_"+DocID).val('1');
        var content =   '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for reject</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                             + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="RejectMemberAddressProof(\''+DocID+'\')" class="btn btn-primary">Continue</button>'
                        + '</div>';
                $('#Publish_body').html(content);            
    }
function RejectMemberAddressProof(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
         $("#frmTxnPass_error").html("Please enter transaction password");
         return false;
    }
    
    $("#ADPtxnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrAd_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=RejectMemberAddressProof",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">successfully Rejected.</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reject Document</h4>'
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


  