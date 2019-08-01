<?php
 $response = $webservice->getData("Admin","GetViewMemberKYCDoc",array("MemberID"=>$_GET['Code']));
 $Member =$response['data']['Member'];
?>
<style>
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
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Manage Members</h4>  
                      <h4 class="card-title">View Member KYC Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Member Code:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Member Name:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;">
                            <?php echo $Member['MobileNumber'];?>&nbsp;&nbsp;
                            <?php if($Member['IsMobileVerified']=="1"){?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" style="margin-top: -15px;width:10%"> <?php }?>
                            </small></div>
                          <div class="col-sm-2"><small>Email ID:</small></div>
                          <div class="col-sm-5"><small style="color:#737373;">
                                <?php echo  $Member['EmailID'];?>&nbsp;&nbsp;
                                <?php if($Member['IsEmailVerified']=="1"){?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" style="margin-top: -13px;width:6%"> <?php }?>
                                </small></div>
                          </div>
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Created on:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                          <div class="col-sm-2"><small>Status:</small></div>
                        <div class="col-sm-3"><small style="color:#737373;">
                              <?php if($Member['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";
                              }
                              ?>
                              </small> 
                        </div>
                      </div>
              </div>                                      
</div>    
</div>  
   
                  
 <div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
          <div class="form-group row">
              <div class="col-sm-6">
                <h4 class="card-title">ID Proof</h4>  
                    <div class="Documentview">
                        <?php foreach($response['data']['IDProof'] as $KycIDP) {?>
                        <img src="<?php echo AppUrl;?>uploads/<?php echo $KycIDP['FileName'];?>" style="width: 200px;height:150px">
                        <?php }?>
                    </div>
                    <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3"><small>File Type</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo $KycIDP['FileType'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Submitted On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycIDP['SubmittedOn']);?></small></div>
                    </div>
                    <?php if($KycIDP['IsVerified']=="1"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Approved On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycIDP['VerifiedOn']);?></small></div>
                    </div>
                    <?php }?>
                    <?php if($KycIDP['IsRejected']=="1"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Rejected On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycIDP['RejectedOn']);?></small></div>
                    </div>
                    <?php }?>
                    <?php if($KycIDP['IsVerified']=="0" && $KycIDP['IsRejected']=="0"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><a href="javascript:void(0)" onclick="showConfirmApproved('<?php echo $KycIDP['DocID'];?>')" class="btn btn-success" name="AddressProofApproved" style="font-family:roboto">Approve</a></div>
                        <div class="col-sm-6"><a href="javascript:void(0)" onclick="showConfirmRejected('<?php echo $KycIDP['DocID'];?>')" class="btn btn-danger" name="AddressProofRejected" style="font-family:roboto">Reject</a></div>
                    </div>
                    <?php }?>
                </div>
              </div>
              <div class="col-sm-6">
                <h4 class="card-title">Address Proof</h4>  
                    <div class="Documentview">
                        <?php foreach($response['data']['AddressProof'] as $KycADP) {?>
                        <img src="<?php echo AppUrl;?>uploads/<?php echo $KycADP['FileName'];?>" style="width: 200px;height:150px">
                        <?php }?>
                    </div>
                    <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3"><small>File Type</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo $KycADP['FileType'];?></small></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Submitted On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycADP['SubmittedOn']);?></small></div>
                    </div>
                    <?php if($KycADP['IsVerified']=="1"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Approved On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycADP['VerifiedOn']);?></small></div>
                    </div>
                    <?php }?>
                    <?php if($KycADP['IsRejected']=="1"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><small>Rejected On</small></div>
                        <div class="col-sm-6"><small style="color:#737373;">:<?php echo putDatetime($KycADP['RejectedOn']);?></small></div>
                    </div>
                    <?php }?>
                    <?php if($KycADP['IsVerified']=="0" && $KycADP['IsRejected']=="0"){?>
                    <div class="form-group row">
                        <div class="col-sm-3"><a href="javascript:void(0)" onclick="showConfirmAddressProofApproved('<?php echo $KycADP['DocID'];?>')" class="btn btn-success" name="AddressProofApproved" style="font-family:roboto">Approve</a></div>
                        <div class="col-sm-6"><a href="javascript:void(0)" onclick="showConfirmAddressProofRejected('<?php echo $KycADP['DocID'];?>')" class="btn btn-danger" name="AddressProofRejected" style="font-family:roboto">Reject</a></div>
                    </div>
                    <?php }?>
                    </div>
              </div>
          </div>   
        </div>
      </div>
 </div>  
 <div class="modal" id="ApproveNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Approve_body" style="height:315px">
            
                </div>
            </div>
        </div>
 <script>
function showConfirmApproved(DocID) {
      $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+DocID+'" name="frm_'+DocID+'" action="" >'
                     + '<input type="hidden" value="'+DocID+'" name="DocID">'
                       +  '<div style="text-align:center">Are you sure want to Approved?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Approve"  onclick="AproveMemberIDProof(\''+DocID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Approve_body').html(content);
}
function AproveMemberIDProof(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Approve_body').html(preloader);
        $.post(API_URL + "m=Admin&a=AproveMemberIDProof",param,function(result2) {$('#Approve_body').html(result2);});
}


function showConfirmAddressProofApproved(DocID) {
      $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+DocID+'" name="frm_'+DocID+'" action="" >'
                     + '<input type="hidden" value="'+DocID+'" name="DocID">'
                       +  '<div style="text-align:center">Are you sure want to Approved?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Approve"  onclick="AproveMemberAddressProof(\''+DocID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Approve_body').html(content);
}
function AproveMemberAddressProof(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Approve_body').html(preloader);
        $.post(API_URL + "m=Admin&a=AproveMemberAddressProof",param,function(result2) {$('#Approve_body').html(result2);});
}

function showConfirmRejected(DocID) {
      $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+DocID+'" name="frm_'+DocID+'" action="" >'
                     + '<input type="hidden" value="'+DocID+'" name="DocID">'
                       +  '<div style="text-align:center">Are you sure want to Rejected?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Rejected"  onclick="RejectMemberIDProof(\''+DocID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Approve_body').html(content);
}
function RejectMemberIDProof(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Approve_body').html(preloader);
        $.post(API_URL + "m=Admin&a=RejectMemberIDProof",param,function(result2) {$('#Approve_body').html(result2);});
}
function showConfirmAddressProofRejected(DocID) {
      $('#ApproveNow').modal('show'); 
      var content = '<div class="Approve_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+DocID+'" name="frm_'+DocID+'" action="" >'
                     + '<input type="hidden" value="'+DocID+'" name="DocID">'
                       +  '<div style="text-align:center">Are you sure want to Rejected?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Rejected"  onclick="RejectMemberAddressProof(\''+DocID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Approve_body').html(content);
}
function RejectMemberAddressProof(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Approve_body').html(preloader);
        $.post(API_URL + "m=Admin&a=RejectMemberAddressProof",param,function(result2) {$('#Approve_body').html(result2);});
}


</script>                                                                                        

