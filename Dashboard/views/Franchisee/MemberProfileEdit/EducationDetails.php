<?php
    $page="EducationDetails";
   ?>
   
<?php include_once("settings_header.php");?> 
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Education Details</h4>
    <div align="right">
            <a href="<?php echo GetUrl("MemberProfileEdit/AddEducationalDetails/". $_GET['Code'].".htm");?>" class="btn btn-success mr-2" >Add Education Details</a>
        </div>
        <br>
        
        <table class="table table-bordered">
        <?php                 
            $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
                    ?>
        <?php if (sizeof($response['data'])>0) { ?>
        <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
            <tr>
                <th>Education</th>
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
                    <td><?php echo $Document['EducationDegree'];?><BR><span style='color:#888'><?php echo $Document['EducationDescription'];?></span></td>
                    <td>
                        <?php if($Document['FileName']>0){ ?>
                          <?php  if($Document['IsVerified']==1) { echo "Attachment Verifiled"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php } else { echo "Attached"; ?>
                                <br><a href="javascript:void(0)" onclick="ViewAttchment('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                          <?php }?>
                         <?php } else { echo "Not Attached";?>
                         <br><a href="<?php echo GetUrl("MemberProfileEdit/AttachEducationDetails/". $Document['ProfileCode'].".htm?AttachmentID=".$Document['AttachmentID']."");?>">Attach</a>
                        <?php }?></td>
                    <td style="width:20px">
                        <?php  if($Document['IsVerified']==0) {?>
                        <a href="javascript:void(0)" onclick="showConfirmDeleteAttach('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['EducationDetails'];?>','<?php  echo $Document['EducationDegree'];?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a>
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
            <ul class="pager">
                <li><a href="../GeneralInformation/<?php echo $_GET['Code'].".htm";?>">Previous</a></li>
                <li><a href="../OccupationDetails/<?php echo $_GET['Code'].".htm";?>">Next</a></li>
            </ul>
        </div>
    </div>
        
    </div>  
    
        
                                                                                                                                                                                                          
        <div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="DeleteNow_body" style="height:285px">
            
                </div>
            </div>
        </div>

<script>
function showConfirmDeleteAttach(AttachmentID,ProfileID,EducationDetails,EducationDegree) {
       $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                        + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                        + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                        + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                        + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        + '<h4 class="modal-title">Confirmation For Remove</h4> <br>'
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
                                +'<td>'+EducationDegree+'</td>'
                            +'</tr>'
                           +'</tbody>'
                           +'</table>'
                        +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteAttach(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
}
 function DeleteAttach(AttachmentID) {
        
        var param = $("#form_"+AttachmentID).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Franchisee&a=DeleteAttach", param, function(result2) {
            $('#DeleteNow_body').html(result2);
            $('#Documentview_'+AttachmentID).hide();
        }
    );
                    
      
        //$.ajax({url: API_URL + "m=Member&a=DeletDocumentAttachments",success: function(result2){$('#model_body').html(result2);}});
}

function ViewAttchment(AttachmentID,ProfileID,FileName) {
      $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                         + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Confirmation For Remove</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                              +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteEducationAttachmentOnly(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;'
                              +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
} 
function DeleteEducationAttachmentOnly(AttachmentID) {
        var param = $("#form_"+AttachmentID).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Franchisee&a=DeleteEducationAttachmentOnly", param, function(result2) {                                             
            $('#DeleteNow_body').html(result2);                                     
          //  $('#Documentview_'+AttachmentID).hide();
        }
    );
}                                                        
</script>       
<?php include_once("settings_footer.php");?>                                  