<?php
    $response = $webservice->getData("Admin","GetMemberInfo");
    $Member          = $response['data']['MemberInfo'];
?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="" name="NewPswd" id="NewPswd">
    <input type="hidden" value="" name="ConfirmNewPswd" id="ConfirmNewPswd">
    <input type="hidden" value="" name="ChnPswdFstLogin" id="ChnPswdFstLogin">
    <input type="hidden" value="" name="DeletedRemarks" id="DeletedRemarks">
    <input type="hidden" value="" name="SmsMessage" id="SmsMessage">
    <input type="hidden" value="" name="EmailSubjectMessage" id="EmailSubjectMessage">
    <input type="hidden" value="" name="EmailContentMessage" id="EmailContentMessage">
    <input type="hidden" value="" name="PopupSubjectMessage" id="PopupSubjectMessage">
    <input type="hidden" value="" name="PopupContentMessage" id="PopupContentMessage">
    <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode">
    <?php
         $disbaled = ( $Member['IsActive']==0 || $Member['IsDeleted']==1 ) ? true : false;
         $stars = (!($disbaled)) ? '<span id="star">*</span>' : ""; 
     ?>
    <div class="row">
        <div class="col-sm-9">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
            <div style="max-width:770px !important;">
                <h4 class="card-title" style="font-weight:399">Member Information</h4>  
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
                    <div style="max-width:770px !important;">
                        <h4 class="card-title">Indvidual Email</h4>
                        <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                          <thead>  
                            <tr> 
                            <th>Message From Code</th>  
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Sent On</th>
                            <th></th>
                            </tr>  
                        </thead>
                         <tbody>  
                            <?php 
                                $response = $webservice->getData("Admin","GetIndividualMessagesList",array("Request"=>"Email"));
                                foreach($response['data'] as $Email) { ?>
                                    <tr>
                                    <td><?php echo $Email['MessageFromCode'];?></td>
                                    <td><?php echo $Email['EmailSubject'];?></td>
                                    <td><?php echo $Email['EmailContent'];?></td>
                                    <td><?php echo PutDateTime($Email['SentOn']);?></td>  
                                    <td><a href="<?php echo GetUrl("Members/ViewIndividualEmail/". $_GET['Code'].".htm?ManualSendID=".$Email['ManualSendID']."");?>"><span>View</span></a></td>                                                                                                                                                                                                                                                    
                                    </tr>
                            <?php } ?>            
                          </tbody>                        
                         </table>
                      </div>   
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="col-sm-12 col-form-label">
                Created On <br>
                <?php echo putDateTime($Member['CreatedOn']);?><br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                Franchisee <br>
                <span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)<br><br> 
            </div>
            <div class="col-sm-12 col-form-label">
                <span class="<?php if($Member['IsDeleted']==1){ echo "DeletedDot"; } else { if($Member['IsActive']==0) { echo "Deactivedot"; } else { echo "Activedot"; } }?>"></span>
                 &nbsp;&nbsp;&nbsp;
                 <small style="color:#737373;"> 
                 <?php if($Member['IsDeleted']==1){ 
                           echo "Deleted";
                       } else {  
                           if($Member['IsActive']==0) {
                             echo "Deactive"."( ".PutDatetime($Member['DeactivatedOn'])." )";
                           } else {
                              echo "Active";   
                             } 
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
            <div class="col-sm-12 col-form-label"><a href="<?php echo GetUrl("Members/ViewMember/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">View Member</small></a></div>
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
            <div class="col-sm-12 col-form-label">
                <?php if($Member['IsDeleted']==1 ){   ?>
                    <?php if($Member['IsActive']==1) { ?>
                        <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Active</small></a>
                    <?php } else { ?>
                        <a><small style="font-weight:bold;text-decoration:underline;color: #5555;">Deactive</small></a>
                    <?php }   ?>
                <?php  } else {  
                              if($Member['IsActive']==0) {  ?>
                                    <a href="javascript:void(0)" onclick="Member.ConfirmActiveMember()"><small style="font-weight:bold;text-decoration:underline">Active</small></a>                                         
                           <?php } else {     ?>
                              <a href="javascript:void(0)" onclick="Member.ConfirmDeactiveMember()"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a> 
                        <?php } 
                       }?>
            </div>
            <div class="col-sm-12 col-form-label"> 
                    <?php if($Member['IsDeleted']==0) { ?>
                        <a href="javascript:void(0)" onclick="Member.ConfirmDeleteMember()"><small style="font-weight:bold;text-decoration:underline">Delete</small></a>                                   
                    <?php } else { ?>    
                        <a href="javascript:void(0)" onclick="Member.ConfirmRestoreMember()"><small style="font-weight:bold;text-decoration:underline">Restore</small></a>                                   
                    <?php } ?>
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
                    <a href="javascript:void(0)" onclick="Member.ConfirmSendIndividualSmsToMember('<?php echo $Member['MemberCode'];?>','<?php echo $Member['MemberName'];?>','<?php echo $Member['MobileNumber'];?>','<?php echo $Member['CountryCode'];?>')"><small style="font-weight:bold;text-decoration:underline">Send Individual Sms</small></a>&nbsp;&nbsp;<a href="<?php echo GetUrl("Members/ListOfIndividualSMS/".$_REQUEST['Code'].".htm ");?>"><small style="font-weight:bold;text-decoration:underline">List</small></a>
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
        </div>    
    </div>
</form> 
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>
     <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>