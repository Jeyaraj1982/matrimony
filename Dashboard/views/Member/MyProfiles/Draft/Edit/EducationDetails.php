<?php
    $page="EducationDetails"; 
    include_once("settings_header.php");
    $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
?> 
<div class="col-sm-10 rightwidget">
    <h4 class="card-title">Education Details</h4>
    <div align="right">
            <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/AddEducationalDetails/". $_GET['Code'].".htm");?>" class="btn btn-success mr-2" >Add Education Details</a>
    </div>
    
	
    <br>
    <table class="table table-bordered">
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
                    <td><?php if($Document['EducationDegree']== "Others"){?>
                            <?php echo trim($Document['OtherEducationDegree']);?>
                        <?php } else { ?>
                             <?php echo trim($Document['EducationDegree']);?>  
                        <?php } ?><BR><span style='color:#888'><?php echo $Document['EducationDescription'];?></span></td>
					 <td>
                        <?php if($Document['FileName']>0){ ?>
                            <?php if($Document['IsVerified']==1) { echo "Attachment Verifiled"; ?>
                                <br><a href="javascript:void(0)" onclick="DraftProfile.showAttachmentEducationInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                            <?php } else { 
                                echo "Attached"; ?>
                                <br><a href="javascript:void(0)" onclick="DraftProfile.showAttachmentEducationInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                            <?php }?>
                        <?php } else {
                            echo "Add your educational attachment and get more responses";?>
                            <br><a href="<?php echo GetUrl("MyProfiles/Draft/Edit/AttachEducationDetails/". $Document['ProfileCode'].".htm?AttachmentID=".$Document['AttachmentID']."");?>">Attach</a>
                        <?php }?>
                    </td>
                    <td style="width:20px">
                        <?php  if($Document['IsVerified']==0) {?>
                            <a href="javascript:void(0)" onclick="DraftProfile.showConfirmDeleteAttachmentEducationalInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['EducationDetails'];?>','<?php  echo $Document['EducationDegree'];?>','<?php  echo $Document['OtherEducationDegree'];?>','<?php  echo $Document['FileName'];?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a>
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

<script>

function DeleteAttach(AttachmentID) {
    var param = $("#form_"+AttachmentID).serialize();
    $('#Publish_body').html(preloading_withText("Deleting education details ...","95"));
        $.post(getAppUrl() + "m=Member&a=DeleteAttach",param,function(result) {
             if (!(isJson(result))) {
                $('#Publish_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div class="modal-header">'
                            +'<h4 class="modal-title">Confirmation For Remove</h4>'
                            +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                        +'</div>'
                        +'<div class="modal-body" style="text-align:center">'
                            +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" style="height:100px;"></p>'
                            +'<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h4>    <br>'
                            +'<a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>'
                         +'</div>';
                 $('#Publish_body').html(content);
            $('#Documentview_'+AttachmentID).hide();
        }
        });
}  
function DeleteEducationAttachmentOnly(AttachmentID) {
    var param = $("#form_"+AttachmentID).serialize();
    $('#Publish_body').html(preloading_withText("Deleting education details ...","95"));
        $.post(getAppUrl() + "m=Member&a=DeleteEducationAttachmentOnly",param,function(result) {
             if (!(isJson(result))) {
                $('#Publish_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div class="modal-header">'
                            +'<h4 class="modal-title">Confirmation For Remove</h4>'
                            +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                        +'</div>'
                        +'<div class="modal-body" style="text-align:center">'
                            +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" style="height:100px;"></p>'
                            +'<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h4>    <br>'
                            +'<a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>'
                         +'</div>';
                 $('#Publish_body').html(content);
        }
        });
} 

</script>       
<?php include_once("settings_footer.php");?>                    