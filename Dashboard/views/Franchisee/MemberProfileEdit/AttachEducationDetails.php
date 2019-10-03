<?php
    $page="EducationDetails";
 ?> 
                   
   <?php                
            $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
            $Education=$response['data']['Attachments'];     
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
                        $res =$webservice->getData("Franchisee","AddEducationalAttachment",$_POST);
                       /* echo  ($res['status']=="success") ? $dashboard->showSuccessMsg($res['message'])
                                                           : $dashboard->showErrorMsg($res['message']);   */
                        if ($response['status']=="success") {                
                             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";
                        } else {
                            $errormessage = $response['message']; 
                        }
                    } 
                }
              
            ?>
             
             
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data">
                     <h4 class="card-title">Educational Details</h4>
                       <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Attachment</label>
                            <div class="col-sm-8"><input type="File" id="File" name="File" Placeholder="File"></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:center;color:red">
                                <span style="color:red"><?php echo $errormessage;?><?php echo $successmessage;?></span> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12" style="text-align:left">
                                <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details</button>
                            </div>
                        </div>
                </form>
                

</div>
<?php include_once("settings_footer.php");?>      
             