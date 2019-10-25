<?php
    $page="EducationDetails";
    $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
    $Education=$response['data']['Attachments'];
    
    if (isset($_POST['BtnSave'])) {
        
        $target_dir = "uploads/";
        $err=0;
        $_POST['File']= "";
        $acceptable = array('image/jpeg','image/jpg','image/png');
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
            $res =$webservice->getData("Member","AddEducationalDetails",$_POST);
            if ($res['status']=="success") {                
               echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";   
            } else {
                $errormessage = $res['message']; 
            }
        } 
    }
    include_once("settings_header.php");
?>
<script>
function submitEducation()  {
            
            $('#ErrEducationdetails').html("");
            $('#ErrEducationDegree').html("");
            $('#ErrOtherEducationDegree').html("");
            
            ErrorCount=0;
            
            if($("#Educationdetails").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrEducationdetails").innerHTML="Please select education"; 
            } 
            
            if($("#EducationDegree").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrEducationDegree").innerHTML="Please select education Details"; 
            }
            
            if ($('#EducationDegree').val()=="Others") {
                if(IsNonEmpty("OtherEducationDegree","ErrOtherEducationDegree","Please enter your education details")){
                     OtherEducationDegree("OtherEducationDegree","ErrOtherEducationDegree","Please enter alphabet characters only");
                }
            }
              
            
            return (ErrorCount==0) ? true : false;
         
        }


</script>
<div class="col-sm-10 rightwidget">
    <form method="post" action="" name="form1" id="form1" onsubmit="return submitEducation()" enctype="multipart/form-data">
        <h4 class="card-title">Education Details</h4>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Education<span id="star">*</span></label> 
            <div class="col-sm-10">
                <select class="selectpicker form-control" data-live-search="true" name="Educationdetails" id="Educationdetails">
                    <option value="0">Choose Education</option>
                    <?php foreach($response['data']['EducationDetail'] as $EducationDetail) { ?>
                    <option value="<?php echo $EducationDetail['CodeValue'];?>" <?php echo ($_POST['Educationdetails']==$EducationDetail['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDetail['CodeValue'];?></option>
                    <?php } ?> 
                </select>
               <span class="errorstring" id="ErrEducationdetails"><?php echo isset($ErrEducationdetails)? $ErrEducationdetails : "";?></span>
            </div>
        </div>
        <div class="form-group row">                                 
            <label class="col-sm-2 col-form-label">Education details<span id="star">*</span></label> 
            <div class="col-sm-10">
                <select class="selectpicker form-control" data-live-search="true" name="EducationDegree" id="EducationDegree" onchange="DraftProfile.addOtherEducationDetails();">
                    <option value="0">Choose Education Degree</option>
                    <?php foreach($response['data']['EducationDegree'] as $EducationDegree) { ?>
                    <option value="<?php echo $EducationDegree['CodeValue'];?>" <?php echo ($_POST['EducationDegree']==$EducationDegree['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDegree['CodeValue'];?></option>
                    <?php } ?>   
                </select>
                <span class="errorstring" id="ErrEducationDegree"></span>
            </div>                                                
        </div>
        <div class="form-group row" id="Education_additionalinfo">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10" ><input type="text" class="form-control" id="OtherEducationDegree" maxlength="50" placeholder="Education details" name="OtherEducationDegree" value="<?php echo (isset($_POST['OtherEducationDegree']) ? $_POST['OtherEducationDegree'] : $ProfileInfo['OtherEducationDegree']);?>">
            <span class="errorstring" id="ErrOtherEducationDegree"><?php echo isset($ErrOtherEducationDegree)? $ErrOtherEducationDegree : "";?></span></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">                                                        
                <input type="text" class="form-control" maxlength="50" name="EducationDescription" id="EducationDescription" placeholder="Education Description" value="<?php echo (isset($_POST['EducationDescription']) ? $_POST['EducationDescription'] : $response['data']['EducationDescription']);?>" style="margin-bottom:5px">
                 <label class="col-form-label" style="padding-top:0px;">Max 50 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Attachment</label>
            <div class="col-sm-10">
                <input type="File" id="File" name="File" Placeholder="File">
                 <span class="errorstring" id="ErrFile"></span>   
            </div>
            
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-12"><span id="server_message_error"><?php echo $errormessage ;?></span><span id="server_message_success"><?php echo $successmessage;?></span></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12" style="text-align:left">
                <button type="submit" name="BtnSave" id="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details</button>&nbsp;&nbsp;
                <a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>">back</a>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    var text_max = 50;
    var text_length = $('#EducationDescription').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');
    $('#EducationDescription').keyup(function() {
        var text_length = $('#EducationDescription').val().length;
        var text_remaining = text_max - text_length;
        $('#textarea_feedback').html(text_length + ' characters typed');
    });
    DraftProfile.addOtherEducationDetails();
});
</script> 
<?php include_once("settings_footer.php");?>      
             