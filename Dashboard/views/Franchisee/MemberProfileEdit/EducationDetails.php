<?php
    $page="EducationDetails";
   ?>
   
<?php include_once("settings_header.php");?> 
<div class="col-sm-10 rightwidget" >
    <h4 class="card-title">Education Details</h4>
    <div align="right">
            <a href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/AddEducationalDetails/".$_GET['Code'].".htm");?>" class="btn btn-success mr-2" >Add Education Details</a>
        </div>
        <br>
        
        <table class="table table-bordered">
        <?php                 
            $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
			
                    ?>
        <?php if (sizeof($response['data'])>0) { ?>
        <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
            <tr>
                <th>Education <?php print_r($_GET['msg']);?></th>
                <th>Education Details</th>
                <th>Attachments</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (sizeof($response['data']['Attachments'])>0) {?>
            <?php foreach($response['data']['Attachments'] as $Document) { ?>
                <tr id="Documentview_<?php echo $Document['AttachmentID'];?>">    
                    <td><?php echo $Document['EducationDetails'];?></td>
                    <td><?php if($Document['EducationDegree']== "Others"){?>
                            <?php echo trim($Document['OtherEducationDegree']);?>
                        <?php } else { ?>
                             <?php echo trim($Document['EducationDegree']);?>  
                        <?php } ?><BR><span style='color:#888'><?php echo $Document['EducationDescription'];?></span></td>
                    <td>
                        <?php if($Document['FileName']>0){ ?>
                          <?php  if($Document['IsVerified']==1) { echo "Attachment Verifiled"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php } else { echo "Attached"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php }?>
                         <?php } else { echo "Add your educational attachment and get more responses";?>
                         <br><a href="<?php echo GetUrl("Member/".$_GET['MCode']."/ProfileEdit/AttachEducationDetails/". $Document['ProfileCode'].".htm?AttachmentID=".$Document['AttachmentID']."");?>">Attach</a>
                        <?php }?></td>
                    <td style="width:20px">
                        <?php  if($Document['IsVerified']==0) {?>
                        <a href="javascript:void(0)" onclick="showConfirmDeleteAttach('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['EducationDetails'];?>','<?php  echo $Document['EducationDegree'];?>','<?php echo $Document['OtherEducationDegree']?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a>
                        <?php }?>
                  </td>  
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4" style="text-align:center;">Education information not found</td>
            </tr>
        <?php } ?>
        </tbody>
        <?php } ?>
    </table>
        <br>
        <div class="form-group row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6" style="text-align:right">
            <ul class="pager" style="float:right">
                <li><a href="../GeneralInformation/<?php echo $_GET['Code'].".htm";?>">&#8249; Previous</a></li>
                <li>&nbsp;</li>
                <li><a href="../OccupationDetails/<?php echo $_GET['Code'].".htm";?>">Next &#8250;</a></li>
            </ul>
        </div>
    </div>
        
    </div>  
    
     <div class="modal" id="DeleteNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>   
 <form method="post" id="form_AttachmentID" name="form_AttachmentID">
        <input type="hidden" value="" name="txnPassword" id="txnPassword">
        <input type="hidden" value="" name="AttachmentID" id="AttachmentID">
        <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ProfileID" id="ProfileID">
 </form>
<script>
function showConfirmDeleteAttach(AttachmentID,ProfileID,EducationDetails,EducationDegree,OtherEducationDegree) {
       $('#DeleteNow').modal('show'); 
             var content ='<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation For remove</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div>Are you sure want to remove below records?  <br><br>'
                                    + '<table class="table table-bordered">'
                                       + '<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;"> '
                                        +'<tr>'
                                            +'<th>Education</th>'
                                            +'<th>Education Details</th>'
                                        +'</tr>'
                                       +'</thead>'
                                       + '<tbody> '
                                        +'<tr>'                                                  
                                            +'<td>'+EducationDetails+'</td>'
                                              +'<td>'+EducationDegree +', '+OtherEducationDegree+'</td>'
                                        +'</tr>'
                                       +'</tbody>'
                                       +'</table>'                  
                                + '</div>' 
                            + '</div>' 
                            + '<input type="hidden" value="'+AttachmentID+'" name="Attachmentid" id="Attachmentid">'
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Delete"  onclick="GetTxnPswd(\''+AttachmentID+'\')">Yes</button>'
                            + '</div>';
        $('#DeleteNow_body').html(content);
}
function GetTxnPswd(AttachmentID) {
    $("#AttachmentID").val($("#Attachmentid").val());
             var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation For remove</h4>'
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
                                    + '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                      + '</div>'
                      + '<input type="hidden" value="'+AttachmentID+'" name="Attachmentid" id="Attachmentid">'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="DeleteAttach(\''+AttachmentID+'\')" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#DeleteNow_body').html(content);              
}

function DeleteAttach(AttachmentID) {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    $("#AttachmentID").val($("#Attachmentid").val());
        var param = $( "#form_AttachmentID").serialize();
        $('#DeleteNow_body').html(preloading_withText("Deleting ...","95"));
        $.post(API_URL + "m=Franchisee&a=DeleteAttach", param, function(result) {
            if (!(isJson(result.trim()))) {
                $('#DeleteNow_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">'+ obj.message+'</h3>'             
                                    + '<p style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#DeleteNow_body').html(content);
                $('#Documentview_'+AttachmentID).hide();
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Confirmation For remove</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#DeleteNow_body').html(content);
            }
        }
    );
}
function ViewAttchment(AttachmentID,ProfileID,FileName) {
      $('#DeleteNow').modal('show'); 
       var content ='<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation For remove</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                                + '<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileID+'/edudoc/'+FileName+'" style="height:120px;"></div> <br>' 
                            + '</div>' 
                            + '<input type="hidden" value="'+AttachmentID+'" name="Attachmentid" id="Attachmentid">'
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Delete"  onclick="GetTxnPswdFrDeleteDocOnly(\''+AttachmentID+'\')">Yes, remove</button>'
                            + '</div>';                                                                                               
            $('#DeleteNow_body').html(content);
} 
function GetTxnPswdFrDeleteDocOnly(AttachmentID) {
    $("#AttachmentID").val($("#Attachmentid").val());
             var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation For remove</h4>'
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
                                    + '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                      + '</div>'
                      + '<input type="hidden" value="'+AttachmentID+'" name="Attachmentid" id="Attachmentid">'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="DeleteEducationAttachmentOnly(\''+AttachmentID+'\')" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#DeleteNow_body').html(content);              
}

function DeleteEducationAttachmentOnly(AttachmentID) {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    $("#AttachmentID").val($("#Attachmentid").val());
        var param = $( "#form_AttachmentID").serialize();
        $('#DeleteNow_body').html(preloading_withText("Deleting ...","95"));
        $.post(API_URL + "m=Franchisee&a=DeleteEducationAttachmentOnly", param, function(result) {
            if (!(isJson(result.trim()))) {
                $('#DeleteNow_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">'+ obj.message+'</h3>'             
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Member/'+data.MemberCode+'/ProfileEdit/EducationDetails/'+data.ProfileCode+'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#DeleteNow_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Confirmation For remove</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#DeleteNow_body').html(content);
            }
        }
    );
}  
<?php if($_GET['msg']=="success") { ?>
        setTimeout(function(){
            $('#responsemodal').modal("show");
        },1000);
    <?php }    ?>                                                     
</script>    
<div class="modal" id="responsemodal" data-backdrop="static">
  <div class="modal-dialog">
        <div class="modal-content" style="max-width:500px;min-height:300px;overflow:hidden">
            <div class="modal-body" id="response_message" style="min-height:175px;max-height:175px;">
                <p style="text-align:center;margin-top: 40px;"><img src="<?php echo ImageUrl;?>verifiedtickicon.jpg" width="100px"></p>
                    <h3 style="text-align:center;">Updated</h3>             
                    <h4 style="text-align:center;">Education Details</h4>             
                    <p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color:#489bae">Continue</a></p>
            </div> 
        </div>
  </div>
</div>
   
<?php include_once("settings_footer.php");?>                                  