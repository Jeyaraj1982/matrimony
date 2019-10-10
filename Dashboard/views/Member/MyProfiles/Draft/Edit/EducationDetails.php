<?php
    $page="EducationDetails"; 
    include_once("settings_header.php");
    $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
?> 
<div class="col-sm-10" style="margin-top: -8px;">
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
                    <td><?php echo $Document['EducationDegree'];?><BR><span style='color:#888'><?php echo $Document['EducationDescription'];?></span></td>
                    <td>
                        <?php if($Document['FileName']>0){ ?>
                            <?php if($Document['IsVerified']==1) { echo "Attachment Verifiled"; ?>
                                <br><a href="javascript:void(0)" onclick="DraftProfile.showAttachmentEducationInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                            <?php } else { 
                                echo "Attached"; ?>
                                <br><a href="javascript:void(0)" onclick="DraftProfile.showAttachmentEducationInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['FileName'];?>')">View</a>
                            <?php }?>
                        <?php } else {
                            echo "Not Attached";?>
                            <br><a href="<?php echo GetUrl("MyProfiles/Draft/Edit/AttachEducationDetails/". $Document['ProfileCode'].".htm?AttachmentID=".$Document['AttachmentID']."");?>">Attach</a>
                        <?php }?>
                    </td>
                    <td style="width:20px">
                        <?php  if($Document['IsVerified']==0) {?>
                            <a href="javascript:void(0)" onclick="DraftProfile.showConfirmDeleteAttachmentEducationalInformation('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>','<?php  echo $Document['EducationDetails'];?>','<?php  echo $Document['EducationDegree'];?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a>
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
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-2">
            <a href="../GeneralInformation/<?php echo $_GET['Code'].".htm";?>" class="btn btn-primary mr-2" style="font-family:roboto">Previous</a>
        </div>
        <div class="col-sm-2"><a href="../OccupationDetails/<?php echo $_GET['Code'].".htm";?>" class="btn btn-primary mr-2" style="font-family:roboto">Next</a></div>
    </div>
</div>  
<div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="height:285px"></div>
    </div>
</div>
<script>
    function DeleteAttach(AttachmentID) {
        var param = $("#form_"+AttachmentID).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Member&a=DeleteAttach", param, function(result2) {                                             
            $('#DeleteNow_body').html(result2);                                     
            $('#Documentview_'+AttachmentID).hide();
        }
    );
    //$.ajax({url: API_URL + "m=Member&a=DeletDocumentAttachments",success: function(result2){$('#model_body').html(result2);}});
} 
function DeleteEducationAttachmentOnly(AttachmentID) {
        var param = $("#form_"+AttachmentID).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Member&a=DeleteEducationAttachmentOnly", param, function(result2) {                                             
            $('#DeleteNow_body').html(result2);                                     
          //  $('#Documentview_'+AttachmentID).hide();
        }
    );
}    
</script>       
<?php include_once("settings_footer.php");?>                    