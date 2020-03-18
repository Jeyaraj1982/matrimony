<?php
    $page="EducationDetails";
 ?> 
                   
   <?php                
            $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
            $Education=$response['data']['AttachAttachments'];     
             ?>
             

   <?php
                if (isset($_POST['BtnSave'])) {
                    
                    $target_dir = "uploads/";
					if (!is_dir('uploads/profiles/'.$_GET['Code'].'/edudoc')) {
						mkdir('uploads/profiles/'.$_GET['Code'].'/edudoc', 0777, true);
					}
                    $err=0;
                    $_POST['File']= "";
                    $acceptable = array('image/jpeg',
                                        'image/jpg',
                                        'image/png'
                                    );
                     
                  if(($_FILES['File']['size'] >= 5000000) || ($_FILES["File"]["size"] == 0)) {
                    $err++;
                           $errormessage= "Please upload file. File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                        $err++;
                           $errormessage= "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
                        $EducationDetails = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"],'uploads/profiles/'.$_GET['Code'].'/edudoc/' . $EducationDetails))) {
                           $err++;
                           $errormessage= "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['File']= $EducationDetails;
                        $res =$webservice->getData("Franchisee","AddEducationalAttachment",$_POST);
                       /* echo  ($res['status']=="success") ? $dashboard->showSuccessMsg($res['message'])
                                                           : $dashboard->showErrorMsg($res['message']);   */
                        if ($res['status']=="success") {                
                             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm?msg=success'</script>";
                        } else {
                            $errormessage = $res['message']; 
                        }
                    } 
                }
              
            ?>
             
             
<?php include_once("settings_header.php");?>
<div class="col-sm-10  rightwidget">
<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data">
<input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value='<?php echo $_GET['Code'];?>' name="Code">
                     <h4 class="card-title">Education Details</h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Education</label>
                            <label class="col-sm-10 col-form-label"><?php echo $Education['EducationDetails'];?></label>
                        </div>
                       <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Education Degree</label>
                            <label class="col-sm-10 col-form-label">
                                 <?php if($Education['EducationDegree']== "Others"){?>
                                    <?php echo trim($Education['OtherEducationDegree']);?>
                                <?php } else { ?>
                                     <?php echo trim($Education['EducationDegree']);?>  
                                <?php } ?> 
                          </label>
                        </div>
                        <?php if(strlen($Education['EducationDescription'])>0){ ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descriptions</label>
                            <label class="col-sm-10 col-form-label"><?php echo $Education['EducationDescription'];?></label>
                        </div>
                        <?php } ?>
                       <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Attachment</label>
                            <div class="col-sm-8"><input type="File" id="File" name="File" Placeholder="File"></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left">
                                <a href="javascript:void(0)" onclick="ConfirmSaveEducationAttachment()" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details </a>
                                <input type="submit" name="BtnSave" id="BtnSave" style="display: none;">
                                <a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                </form>
</div>
 <div class="modal" id="DeleteNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>
<script>
function ConfirmSaveEducationAttachment(){
            $('#DeleteNow').modal('show'); 
            var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for save education details</h4>'
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
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPasswordSaveEducationAttachment()" style="font-family:roboto">Continue</button>'
                            + '</div>';                                                                                               
            $('#DeleteNow_body').html(content);
    }
function GetTxnPasswordSaveEducationAttachment () {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for save education details</h4>'
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
                            + '<button type="button" onclick="SaveEducationAttachment()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#DeleteNow_body').html(content);            
    }
    function SaveEducationAttachment() {
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
</script>
<div class="modal" id="responsemodal" data-backdrop="static">
  <div class="modal-dialog">
        <div class="modal-content" style="max-width:500px;min-height:300px;overflow:hidden">
            <div class="modal-header">
                <h4 class="modal-title">Save education attachment</h4>
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
             