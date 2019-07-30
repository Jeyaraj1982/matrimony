<?php
    $page="EducationDetails";
   ?>
   
<?php include_once("settings_header.php");?> 
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Education Details</h4>
        <table class="table table-bordered">
        <?php                 
            $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileID"=>$_GET['Code'])));
                if (sizeof($response['data'])>0) {
                    ?>
                        
            <thead>
                <tr>
                    <th>Education</th>
                    <th>Education Details</th>
                    <th>Attached On</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
                <?php foreach($response['data'] as $Document) { ?>
                        
                <tr id="Documentview_<?php echo $Document['AttachmentID'];?>">    
                    <td><?php echo $Document['EducationDetails'];?></td>
                    <td><?php echo $Document['EducationDegree'];?></td>
                    <td style="width:140px"><?php echo putDateTime($Document['AttachedOn']);?></td>
                    <td><?php if($Document['IsVerified']==0 ) { echo "Not Verified";} else { echo "verified";}?></td>
                    <td style="width:20px"><a href="javascript:void(0)" onclick="showConfirmDeleteAttach('<?php  echo $Document['AttachmentID'];?>','<?php echo $_GET['Code'];?>')"><img src="<?php echo SiteUrl?>assets/images/document_delete.png" style="width:16px;height:16px"></a></td>
                </tr>
                <?php }}?>
            </tbody>
        </table>
        <br>
        <div align="right">
            <a href="<?php echo GetUrl("MyProfiles/Edit/AddEducationalDetails/". $_GET['Code'].".htm");?>" class="btn btn-success mr-2" >add</a>
        </div>
        
    </div>  
    
        
        
        <div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="DeleteNow_body" style="height:200px">
            
                </div>
            </div>
        </div>

<script>
function showConfirmDeleteAttach(AttachmentID,ProfileID) {
      $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                        + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                        + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                        + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                        +  '<div style="text-align:center">Are you sure want to Delete?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteAttach(\''+AttachmentID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';                                                                                               
            $('#DeleteNow_body').html(content);
}
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
</script>       
<?php include_once("settings_footer.php");?>                    