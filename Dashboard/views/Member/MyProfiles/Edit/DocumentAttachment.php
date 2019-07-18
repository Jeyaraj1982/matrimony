<?php
    $page="DocumentAttachment";       
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code'])); 
   ?>
<?php include_once("settings_header.php");?>
<style>
.photoview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    height: 211px;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
}
.photoview:hover{
    border:1px solid #9b9a9a;
}
</style>
<div class="col-sm-10" style="margin-top: -8px;">
<script>
function submitUpload() {
            $('#Errcheck').html("");
            ErrorCount==0
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please read the instruction");
                return false;
            }
            if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }

        }
</script>
<form method="post" onsubmit="return submitUpload()" name="form1" id="form1" action="" enctype="multipart/form-data">
    <h4 class="card-title">Document Attachments<br>
    <span style="float:right;color:green">For administrator purpose only</span><br><span style="float:right;color:grey;font-size:12px">Not show to members or others</span></h4>
    
  <span style="color:#555">  We have implemented certain measures for the safety of our members. registered members must have update      a copy of any specified government issued identity proof to add credibility to their profiles. </span><br><Br><br>
    
    <?php
                if (isset($_POST['BtnSave'])) {
                    
                    $target_dir = "uploads/";
                    $err=0;
                    $_POST['File']= "";
                    $acceptable = array('image/jpeg',
                                        'image/jpg',
                                        'image/png'
                                    );
                     
                  if(($_FILES['File']['size'] >= 5000000) || ($_FILES["File"]["size"] == 0)) {
                    $err++;
                           echo "File too large. File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                        $err++;
                           echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
                        $profilephoto = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], $target_dir . $profilephoto))) {
                           $err++;
                           echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['File']= $profilephoto;
                        $res =$webservice->getData("Member","AttachDocuments",$_POST);
                        if ($res['status']=="success") {
                            echo  $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                    } else {
                        $res =$webservice->getData("Member","AttachDocuments");
                    }
                } else {
                     $res =$webservice->getData("Member","AttachDocuments");
                     
                }
                $DocumentPhoto = $res['data'];
              
            ?>
    
    <div class="form-group row">
        <label for="Documents" class="col-sm-2 col-form-label">Document Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="Documents" name="Documents">
                <option>Choose Documents</option>
                <?php foreach($response['data']['DocumentType'] as $Document) { ?>
                 <option value="<?php echo $Document['SoftCode'];?>" <?php echo ($_POST['Documents']==$Document['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Document['CodeValue'];?></option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="Attachment" class="col-sm-2 col-form-label">Attachment<span id="star">*</span></label>
        <div class="col-sm-9">
            <input type="File" id="File" name="File" Placeholder="File">
            <span style="color:#888">supports png, jpg, jpeg and pdf & File size Lessthan 5 MB </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
           <?php echo $errormessage;?><?php echo $successmessage;?>
        </div>
    </div>
    <div class="form-group row">                                                                                                                                                
        <div class="col-sm-12"><input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal"> I read the instructions  </label>&nbsp;&nbsp;<a href="javascript:void(0)"  onclick="showLearnMore()">Lean more</a>
        <br><span class="errorstring" id="Errcheck"></span></div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Update</button>
        </div>
    </div>
    <br><br>
    <br>
    </form>
    
<div>
    <?php if(sizeof($res['data'])==0){  ?>
         <div style="margin-right:10px;text-align: center;">
                 No Profile Photos Found   
        </div>
   <?php }  else {       ?>
    <?php
        foreach($res['data'] as $d) { ?> 
        <div id="photoview_<?php echo $d['AttachmentID'];?>" class="photoview">
            <div style="text-align:right;height:22px;">
                <a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $d['AttachmentID'];?>','<?php echo $_GET['Code'];?>')" name="Delete" style="font-family:roboto"><button type="button" class="close" >&times;</button></a>    
            </div>
            <div><img src="<?php echo AppUrl;?>uploads/<?php echo $d['AttachFileName'];?>" style="height:120px;"></div>
            <div>
                <?php if($d['IsVerified']==0){ echo "verification pending" ; } else { echo "Verified" ; }?>
                <br><?php echo PutDateTime($d['AttachedOn']);?>   
            </div>
        </div>
   
        <?php }   ?>
         <div style="clear:both"></div>
         <?php }?>
    </div>
</div>
<div class="modal" id="LearnMore" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="LearnMore_body" style="height:300px">
            
                </div>
            </div>
        </div>
<script>
function showLearnMore() {
      $('#LearnMore').modal('show'); 
      var content = '<div class="LearnMore_body" style="padding:20px">'
                    +   '<div  style="height:500px;">'
                       +  '<h5 style="text-align:center">Please follow the below instructions :</h5><button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>'
                            + '<ol> '
                                + '<li>The ID proof must have related to profile information </li>'
                                + '<li>The uploaded ID proofs are not displayed in public and it is purely for administrative purposes.</li>'
                                + '<li>ID proofs once uploaded cannot be edit or delete.</li>'
                                + '<li>If any changes. You should contact the admin for any updates to these documents with a valid reason.</li>'
                                + '</ol>'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>'
                       +  '</div><br>'
                +  '</div>'
            $('#LearnMore_body').html(content);
}
</script>
<div class="modal" id="Delete" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="model_body" style="height: 150px;">
            
                </div>
            </div>
        </div>
<script>
    function showConfirmDelete(AttachmentID,ProfileID) {
        $('#Delete').modal('show'); 
        var content = '<div class="modal-body" style="padding:20px">'
                        + '<div  style="height: 315px;">'
                            + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                                + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                                + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                                + '<div style="text-align:center">Are you sure want to Delete?  <br><br>'
                                    + '<button type="button" class="btn btn-primary" name="Delete"  onclick="ConfirmDelete(\''+AttachmentID+'\')">Yes</button>&nbsp;&nbsp;'
                                    + '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                                + '</div>'
                            + '</form>'
                        + '</div>'
                     +  '</div>';
        $('#model_body').html(content);
    }
    
    function ConfirmDelete(AttachmentID) {
        
        var param = $( "#form_"+AttachmentID).serialize();
        $('#model_body').html(preloader);
        $.post(API_URL + "m=Member&a=DeletDocumentAttachments", param, function(result2) {
            $('#model_body').html(result2);
            $('#photoview_'+AttachmentID).hide();
        }
    );
                    
      
        //$.ajax({url: API_URL + "m=Member&a=DeletDocumentAttachments",success: function(result2){$('#model_body').html(result2);}});
}

</script>
<?php include_once("settings_footer.php");?>                    