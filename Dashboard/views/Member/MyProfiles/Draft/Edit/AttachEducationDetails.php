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
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], $target_dir . $EducationDetails))) {
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
                                <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details</button>&nbsp;&nbsp;
                                <a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>">back</a>
                            </div>
                        </div>
                </form>
                

</div>
<?php include_once("settings_footer.php");?>      
             