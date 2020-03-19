<?php
    $page="DocumentAttachment";       
    $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code'])); 
   ?>
<?php include_once("settings_header.php");?>
<style>
.photoview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    height: 250px;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
}
.photoview:hover{
    border:1px solid #9b9a9a;
}
</style>
<div class="col-sm-10 rightwidget">
<script>
function submitUpload() {
            $('#ErrDocuments').html("");  
            $('#ErrFile').html("");  
            $('#Errcheck').html("");
            
            ErrorCount==0
            if ($("#Documents").val()=="0") {
                $("#ErrDocuments").html("Please select the Document Type");
                return false;
            }
            if ($("#File").val()=="") {
                $("#ErrFile").html("Please select the Document");
                return false;
            }
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please read the instruction");
                return false;
            }
            if (ErrorCount==0) {
                 setTimeout(function(){$("#BtnSave").attr('disabled', 'disabled');},100);
                            return true;
                        } else{
                            return false;
                        }

        }
</script>
<form method="post" onsubmit="return submitUpload()" name="form1" id="form1" action="" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value='<?php echo $_GET['Code'];?>' name="Code">
    <h4 class="card-title">Document Attachments
    <span style="float:right;color:green">For administrator purpose only</span><br><span style="float:right;color:grey;font-size:12px">Not show to members or others</span></h4>
    
    
    <?php
                if (isset($_POST['BtnSave'])) {
                    
                    $target_dir = "uploads/";
					if (!is_dir('uploads/profiles/'.$_GET['Code'].'/kycdoc')) {
						mkdir('uploads/profiles/'.$_GET['Code'].'/kycdoc', 0777, true);
					}
                    $err=0;
                    $_POST['File']= "";
                    $acceptable = array('image/jpeg',
                                        'image/jpg',
                                        'image/png'
                                    );
                     
                  if(($_FILES['File']['size'] >= 5000000) || ($_FILES["File"]["size"] == 0)) {
                    $err++;
                           $errormessage = "File too large. File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                        $err++;
                           $errormessage = "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
                        $profilephoto = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], 'uploads/profiles/'.$_GET['Code'].'/kycdoc/' . $profilephoto))) {
                           $err++;
                           $errormessage = "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['File']= $profilephoto;
                        $res =$webservice->getData("Franchisee","AttachDocuments",$_POST);
                        if ($res['status']=="success") {                
                             echo $dashboard->showSuccessMsg($res['message']);
                        } else {
                            $errormessage = $res['message']; 
                        }
                     } else {
                        $res =$webservice->getData("Franchisee","AttachDocuments");
                    }
                } else {
                     $res =$webservice->getData("Franchisee","AttachDocuments");
                     
                }
                $DocumentPhoto = $res['data'];
                
              
            ?>       
   <div id="Attachdetails"> 
   <span style="color:#555">  We have implemented certain measures for the safety of our members. registered members must have update      a copy of any specified government issued identity proof to add credibility to their profiles. </span><br><Br><br>
    <div class="form-group row">
        <label for="Documents" class="col-sm-2 col-form-label">Document Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="Documents" name="Documents">
                <option value="0">Choose Documents</option>
                <?php foreach($response['data']['DocumentType'] as $Document) { ?>
                 <option value="<?php echo $Document['SoftCode'];?>" <?php echo ($_POST['Documents']==$Document['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Document['CodeValue'];?></option>
                    <?php } ?>
            </select>
             <span class="errorstring" id="ErrDocuments"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="Attachment" class="col-sm-2 col-form-label">Attachment<span id="star">*</span></label>
        <div class="col-sm-9">
            <input type="File" id="File" name="File" Placeholder="File">
            <span style="color:#888">supports png, jpg, jpeg and pdf & File size Lessthan 5 MB </span><br>
            <span class="errorstring" id="ErrFile"></span>
        </div>
    </div>
    <div class="form-group row">                                                                                                                                                
        <div class="col-sm-12"><input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal"> I read the instructions  </label>&nbsp;&nbsp;<a href="javascript:void(0)"  onclick="showLearnMore()">Learn more</a>
        <br><span class="errorstring" id="Errcheck"></span></div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <a href="javascript:void(0)" onclick="ConfirmSaveDoccumentAttachment()" class="btn btn-primary mr-2" style="font-family:roboto">Update </a>
            <input type="submit" name="BtnSave" id="BtnSave" style="display: none;">
        </div>
    </div>  
    <br><br>
   </div>
   
   <div style="text-align: right;" id="x"></div>
    <br>
    </form>
    
<div>
    <?php if(sizeof($res['data'])==0){  ?>
         <div style="margin-right:10px;text-align: center;">
                 No Documents Found   
        </div>
   <?php }  else {       ?>
    <?php
        foreach($res['data'] as $d) { ?> 
        
        <div id="photoview_<?php echo $d['AttachmentID'];?>" class="photoview">
            <div style="text-align:right;height:22px;">
                <a href="javascript:void(0)" onclick="showConfirmDeleteDoc('<?php  echo $d['AttachmentID'];?>','<?php echo $_GET['Code'];?>')" name="Delete" style="font-family:roboto"><button type="button" class="close" >&times;</button></a>    
            </div>
            <div><img src="<?php echo AppUrl;?>uploads/profiles/<?php echo $_GET['Code'];?>/kycdoc/<?php echo $d['AttachFileName'];?>" style="height:120px;"></div>
            <div>
                <br><?php echo $d['DocumentType'];?><br> 
                <?php if($d['IsVerified']==0){ echo "verification pending" ; } else { echo "Verified" ; }?>
                <br><?php echo PutDateTime($d['AttachedOn']);?>   
            </div> 
            </div>
        <?php }   ?>
         <div style="clear:both"></div>
         <?php }?>    <br><br>
         </div>
   <div class="form-group row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6" style="text-align: right;">
            <ul class="pager" style="float:right;">
                  <li><a href="../PhysicalInformation/<?php echo $_GET['Code'].".htm";?>">&#8249; Previous</a></li>
                  <li>&nbsp;</li>
                  <li><a href="../CommunicationDetails/<?php echo $_GET['Code'].".htm";?>">Next &#8250;</a></li>
            </ul>
        </div>
   </div>
    </div>
<div class="modal" id="LearnMore" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="LearnMore_body" style="height:300px">
            
                </div>
            </div>
        </div>
        <form method="post" id="form_AttachmentID" name="form_AttachmentID">
            <input type="hidden" value="" name="txnPassword" id="txnPassword_delete">
            <input type="hidden" value="" name="AttachmentID" id="AttachmentID_delete">
            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ProfileID">
        </form>
<script>
var available = "<?php echo sizeof($res['data']);?>";
 $('#x').html( available + " out 2 documents");
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
<div class="modal" id="Delete" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="model_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>
<script>
function ConfirmSaveDoccumentAttachment(){
            $('#Delete').modal('show'); 
            var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for save document attachment</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to save this information?</div>'
                                        + '</div>'                                                     
                                    + '</div>'
                                +  '</div>'                    
                            + '</div>' 
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPasswordSaveDocAttachment()" style="font-family:roboto">Continue</button>'
                            + '</div>';                                                                                               
            $('#model_body').html(content);
    }
function GetTxnPasswordSaveDocAttachment () {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for save document attachment</h4>'
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
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="SaveDocAttachment()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#model_body').html(content);            
    }
    function SaveDocAttachment() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        $( "#BtnSave" ).trigger( "click");
        
    }
    <?php if (isset($errormessage) && strlen($errormessage)>0) { ?>
        setTimeout(function(){
            $('#responsemodal').modal("show");
        },1000);
    <?php }    ?>
    function showConfirmDeleteDoc(AttachmentID,ProfileID) {
        $('#Delete').modal('show'); 
        var content =  '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation For remove</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to Delete?</div>'
                                        + '</div>'
                                    + '</div>'
                                +  '</div>'                 
                            + '</div>' 
                            + '<input type="hidden" value="'+AttachmentID+'" name="Attachmentid" id="Attachmentid">'
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Delete"  onclick="GetTxnPswd(\''+AttachmentID+'\')">Yes</button>'
                            + '</div>';
        $('#model_body').html(content);
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
                            + '<button type="button" onclick="ConfirmDeleteDoc(\''+AttachmentID+'\')" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#model_body').html(content);              
}
    function ConfirmDeleteDoc(AttachmentID) {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword_delete").val($("#TransactionPassword").val());
    $("#AttachmentID_delete").val($("#Attachmentid").val());
        var param = $( "#form_AttachmentID").serialize();
        $('#model_body').html(preloading_withText("Deleting ...","95"));
        $.post(API_URL + "m=Franchisee&a=DeletDocumentAttachments", param, function(result) {
            if (!(isJson(result.trim()))) {
                $('#model_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Your selected document has been deleted successfully</h3>'             
                                    + '<p style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#model_body').html(content);
                $('#photoview_'+AttachmentID).hide();
                available--;
                 DisplayDocAttachForm();
                $('#x').html( available + " out 2 documents");
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
            $('#model_body').html(content);
            }
        }
    );
                    
      
        //$.ajax({url: API_URL + "m=Member&a=DeletDocumentAttachments",success: function(result2){$('#model_body').html(result2);}});
}
function DisplayDocAttachForm() {
     if (available==2) {
          $('#Attachdetails').hide();
      } else {
          $('#Attachdetails').show();
      }
}

  setTimeout(function(){
        DisplayDocAttachForm(); 
      
  },500);

</script> 
<div class="modal" id="responsemodal" data-backdrop="static">
  <div class="modal-dialog">
        <div class="modal-content" style="max-width:500px;min-height:300px;overflow:hidden">
            <div class="modal-header">
                <h4 class="modal-title">Save document attachment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body" id="response_message" style="min-height:175px;max-height:175px;">
                <p style="text-align:center;margin-top: 40px;"><img src="<?php echo ImageUrl;?>exclamationmark.jpg" width="10%"></p>
                    <h4 style="text-align:center;"><?php echo $errormessage;?></h4>             
                    <p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color:#489bae">Continue</a></p>
            </div> 
        </div>
  </div>
</div>  
<?php include_once("settings_footer.php");?>