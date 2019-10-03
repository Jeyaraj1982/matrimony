<?php
    $page="EducationDetails";
 /*   if (isset($_POST['BtnSave'])) {
        
        $response = $webservice->getData("Franchisee","AddEducationalDetails",$_POST);
        if ($response['status']=="success") {
              echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";
        } else {
            $errormessage = $response['message']; 
        }  
    }*/
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
                     
                  if(($_FILES['File']['size'] >= 5000000)) {
                    $err++;
                           echo "File must be less than 5 megabytes.";
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
                        $res =$webservice->getData("Franchisee","AddEducationalDetails",$_POST);
                       /* echo  ($res['status']=="success") ? $dashboard->showSuccessMsg($res['message'])
                                                           : $dashboard->showErrorMsg($res['message']);   */
                        if ($res['status']=="success") {                
                             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";   
                        } else {
                            $errormessage = $response['message']; 
                        }
                    } 
                }
              
            ?>
   <?php                 
            $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
$Education=$response['data']['Attachments'];
             ?>
<?php include_once("settings_header.php");?>
<script>
$(document).ready(function() {
    var text_max = 250;
    var text_length = $('#EducationDescription').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#EducationDescription').keyup(function() {
        var text_length = $('#EducationDescription').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script> 
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" enctype="multipart/form-data">
                     <h4 class="card-title">Educational Details</h4>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education<span id="star">*</span></label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="Educationdetails">
                                <option value="0">Choose Education</option>
                                    <?php foreach($response['data']['EducationDetail'] as $EducationDetail) { ?>
                                    <option value="<?php echo $EducationDetail['CodeValue'];?>" <?php echo ($_POST['Educationdetails']==$EducationDetail['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDetail['CodeValue'];?></option>
                            <?php } ?> 
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education Details<span id="star">*</span></label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="EducationDegree">
                                <option value="0">Choose Education Degree</option>
                                    <?php foreach($response['data']['EducationDegree'] as $EducationDegree) { ?>
                                    <option value="<?php echo $EducationDegree['CodeValue'];?>" <?php echo ($_POST['EducationDegree']==$EducationDegree['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDegree['CodeValue'];?></option>
                            <?php } ?>   
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-8"><input type="text" class="form-control" name="EducationRemarks" id="EducationRemarks" value="<?php echo (isset($_POST['EducationRemarks']) ? $_POST['EducationRemarks'] : $response['data']['EducationRemarks']);?>"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Attachment</label>
                            <div class="col-sm-8"><input type="File" id="File" name="File" Placeholder="File"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description<span id="star">*</span></label>
                            <div class="col-sm-10">                                                        
                                <textarea class="form-control" maxlength="250" name="EducationDescription" id="EducationDescription"><?php echo (isset($_POST['EducationDescription']) ? $_POST['EducationDescription'] : $response['data']['EducationDescription']);?></textarea> <br>
                                <div class="col-sm-12">Max 250 Characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></div>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left;color:red">
                                <?php echo $errormessage;?><?php echo $successmessage;?> 
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left">
                                <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details</button>
                            </div>
                        </div>
                </form>
                

</div>
<?php include_once("settings_footer.php");?>      
             