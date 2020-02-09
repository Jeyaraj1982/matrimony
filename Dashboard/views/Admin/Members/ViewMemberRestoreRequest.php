<?php
   $response = $webservice->getData("Admin","MemberRequestFromFranchiseeInfo");
   $Request        = $response['data']['Request'];
   $Member         = $response['data']['Member'];
   $Franchisee     = $response['data']['Franchisee'];
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div style="padding:15px !important;max-width:770px !important;">
                 <h4 class="card-title">Restore Request</h4>  
                        <form method="post" id="frmfrn_<?php echo $Request['ReqID'];?>" >
                            <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="ApproveReason" id="ApproveReason_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="RejectReason" id="RejectReason_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="IsApproved" id="IsApproved_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="IsRejected" id="IsRejected_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ReqID" id="ReqID">
                            <input type="hidden" value="<?php echo $Request['MemberCode'];?>" name="MemberCode" id="MemberCode">
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request By Code:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['RequestByCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request By Name:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['PersonName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Member Code:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Member Name:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Reason For Deactive:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['DeleteReason'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request On:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Request['DeleteRequestOn']);?></small></div>
                            </div>
                            <?php if($Request['IsVerified']==1){?>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Approved On:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Request['VerifiedOn']);?></small></div>
                            </div>
                            <?php } ?>
                            <?php if($Request['IsVerified']==2){?>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Rejected On:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Request['VerifiedOn']);?></small></div>
                            </div>
                            <?php } ?>
                            <?php if($Request['IsVerified']==0){?>
                                <div class="form-group row">
                                    <div class="col-sm-12"><a href="javascript:void(0)" onclick="Member.showConfirmApproveMemRestoreReq('<?php echo $Request['ReqID'];?>')" class="btn btn-success" name="ApproveDeactiveReq" style="font-family:roboto">Approve</a>
                                    &nbsp;&nbsp;<a href="javascript:void(0)" onclick="Member.showConfirmRejectMemRestoreReq('<?php echo $Request['ReqID'];?>')" class="btn btn-danger" name="RejectDeactiveReq" style="font-family:roboto">Reject</a>
                                    </div>
                                </div>
                            <?php } ?>  
                   </form>   
                  </div>
                 
                </div>
           
            </div>
        </div> 
    <div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>