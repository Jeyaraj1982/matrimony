<?php
    $page="EducationDetails";
 ?> 
                   
   <?php                
            $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
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
                           echo "Please upload file. File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                        $err++;
                           echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
                        $EducationDetails = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], 'uploads/profiles/'.$_GET['Code'].'/edudoc/'. $EducationDetails))) {
                           $err++;
                           echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['File']= $EducationDetails;
                        $res =$webservice->getData("Member","AddEducationalAttachment",$_POST);
                       /* echo  ($res['status']=="success") ? $dashboard->showSuccessMsg($res['message'])
                                                           : $dashboard->showErrorMsg($res['message']);   */
                        if ($res['status']=="success") {                
                             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";
                        } else {
                            $errormessage = $res['message']; 
                        }
                    } 
                }
              
            ?>
             
             
<?php include_once("settings_header.php");?>
<div class="col-sm-10  rightwidget">
<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data">
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
                            <div class="col-sm-10"><input type="File" id="File" name="File" Placeholder="File"></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:center;color:red">
                                <span style="color:red"><?php echo $errormessage;?><?php echo $successmessage;?></span> 
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left">
								<input type="submit" name="BtnSave" id="BtnSave" style="display:none">
								<a href="javascript:void(0)" onclick="ConfirmAddEducationalAttachment()" class="btn btn-primary" style="font-family:roboto">Save Education Details</a>
                                <a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                </form>
                

</div>
<script>
	function ConfirmAddEducationalAttachment(){
        $('#PubplishNow').modal('show'); 
		var content = '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for Save Educational Details</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" tyle="padding-top:5px;"></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group row" style="margin:0px;padding-top:10px;">'
								+ '<div class="col-sm-4">'
									+ '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
								+ '</div>'
								+ '<div class="col-sm-8"><br>'
									+ '<div class="form-group row">'
										+'<div class="col-sm-12">Are sure want to add this educational details</div>'
									+ '</div>'                                                     
								+ '</div>'
							+  '</div>'                    
						+ '</div>' 
						+ '<div class="modal-footer">'
							+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
							+ '<button type="button" class="btn btn-primary" name="BtnSaveEducation" class="btn btn-primary" onclick="AddEducationalAttachment()" style="font-family:roboto">Save Education Details</button>'
						+ '</div>';                                                                                               
            $('#Publish_body').html(content);
    }
    
    function AddEducationalAttachment() {
				$( "#BtnSave" ).trigger( "click" );
	}
    
</script>
<?php include_once("settings_footer.php");?>      
             