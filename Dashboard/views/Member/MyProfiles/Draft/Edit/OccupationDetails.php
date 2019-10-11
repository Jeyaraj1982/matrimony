<?php
    $page="OccupationDetails";
   /* if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Member","EditDraftOccupationDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }    */
    
    $response = $webservice->getData("Member","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
   ?>
    <?php
                if (isset($_POST['BtnSaveProfile'])) {
                    
                    $target_dir = "uploads/";
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    
                    if (isset($_FILES['File']['name']) && strlen(trim($_FILES['File']['name']))>0) {
                        
                        if(($_FILES['File']['size'] >= 5000000)) {
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                        }
                        
                        $OccupationAttachments = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], $target_dir . $OccupationAttachments))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST['File']= $OccupationAttachments;
                        }
                        
                    }
                     
                 
                    
                    if ($err==0) {
                        
                        $res =$webservice->getData("Member","EditDraftOccupationDetails",$_POST);   
                       if ($res['status']=="success") {
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                         $response = $webservice->getData("Member","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
                         $ProfileInfo  = $response['data']['ProfileInfo'];
                    }
                }
              
            ?>
<?php include_once("settings_header.php");?>
<script>
function submitprofile() {
                         $('#ErrEmployedAs').html("");
                         $('#ErrOccupationType').html("");
                         $('#ErrTypeofOccupation').html("");
                         $('#ErrIncomeRange').html("");
                         $('#ErrWCountry').html("");
                         $('#ErrWorkedCityName').html("");
                         $('#ErrOtherOccupation').html("");
                       
                         ErrorCount=0;
                         
                         if($("#EmployedAs").val()=="0"){
                            document.getElementById("ErrEmployedAs").innerHTML="Please select employed as"; 
                             ErrorCount++;
                         }
                          if ($('#EmployedAs').val()=="O001") {   
                             if($("#OccupationType").val()=="0"){
                                document.getElementById("ErrOccupationType").innerHTML="Please select occupation"; 
                                 ErrorCount++;
                             }
                             if($("#TypeofOccupation").val()=="0"){
                                document.getElementById("ErrTypeofOccupation").innerHTML="Please select ccupation type"; 
                                 ErrorCount++;
                             } 
                             if($("#IncomeRange").val()=="0"){
                                document.getElementById("ErrIncomeRange").innerHTML="Please select annual income"; 
                                 ErrorCount++;
                             }
                             if($("#WCountry").val()=="0"){
                                document.getElementById("ErrWCountry").innerHTML="Please select country"; 
                                 ErrorCount++;
                             }
                             if($("#WorkedCityName").val()==""){
                                document.getElementById("ErrWorkedCityName").innerHTML="Please enter worked city"; 
                                 ErrorCount++;
                             }
                          }
                          if ($('#OccupationType').val()=="OT112") {  
                              if($("#OtherOccupation").val()==""){
                                document.getElementById("ErrOtherOccupation").innerHTML="Please enter your occupation"; 
                                 ErrorCount++;
                             }
                          }
                         
                        if (ErrorCount==0) {
                            return true;                        
                        } else{
                            return false;
                        }
                        
    
    
}
</script>
<div class="col-sm-10" style="margin-top: -8px;max-width:770px !important">
<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return submitprofile();">
    <h4 class="card-title">Occupation Details</h4>
    <div class="form-group row">
        <label for="Employed As" class="col-sm-2 col-form-label">Employed As<span id="star">*</span></label>   
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs" name="EmployedAs"  onchange="DraftProfile.addOtherWorkingDetails();">
                <option value="0">Choose Employed As</option>
                <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo (isset($_POST[ 'EmployedAs'])) ? (($_POST[ 'EmployedAs']==$EmployedAs[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'EmployedAs']==$EmployedAs[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $EmployedAs['CodeValue'];?>
                            <?php } ?>      </option>
            </select>
            <span class="errorstring" id="ErrEmployedAs"><?php echo isset($ErrEmployedAs)? $ErrEmployedAs : "";?></span>
        </div>
    </div>
    <div id="Working_additionalinfo">
    <div class="form-group row">
        <label for="TypeofOccupation" class="col-sm-2 col-form-label" style="padding-right:0px">Occupation Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="TypeofOccupation" name="TypeofOccupation">
                <option value="0">Choose Type of Occupation</option>
                <?php foreach($response['data']['TypeofOccupation'] as $TypeofOccupation) { ?>
                    <option value="<?php echo $TypeofOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'TypeofOccupation'])) ? (($_POST[ 'TypeofOccupation']==$TypeofOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'TypeofOccupation']==$TypeofOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $TypeofOccupation['CodeValue'];?>
                            <?php } ?>    
                    </option>
            </select>
            <span class="errorstring" id="ErrTypeofOccupation"><?php echo isset($ErrTypeofOccupation)? $ErrTypeofOccupation : "";?></span>
        </div>
    </div>
    <div class="form-group row">
      <label for="OccupationType" class="col-sm-2 col-form-label">Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="OccupationType" name="OccupationType" onchange="DraftProfile.addOtherOccupation();">
                <option value="0">Choose Occupation Types</option>  
                <?php foreach($response['data']['Occupation'] as $OccupationType){ ?>
               <?php  if($OccupationType['SoftCode']!= "OT107"){     ?>
                    <option value="<?php echo $OccupationType['SoftCode'];?>" <?php echo (isset($_POST[ 'OccupationType'])) ? (($_POST[ 'OccupationType']==$OccupationType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'OccupationType']==$OccupationType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $OccupationType['CodeValue'];?>
                            <?php } } ?>      </option>
            </select>
            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
        </div>
        <!--<label class="col-sm-2 col-form-label"></label>-->
            <div class="col-sm-6"  id="Occupation_additionalinfo"><input type="text" class="form-control" id="OtherOccupation" name="OtherOccupation" value="<?php echo (isset($_POST['OtherOccupation']) ? $_POST['OtherOccupation'] : $ProfileInfo['OtherOccupation']);?>">
            <span class="errorstring" id="ErrOtherOccupation"><?php echo isset($ErrOtherOccupation)? $ErrOtherOccupation : "";?></span></div>
    </div> 
    <div class="form-group row">
        <label for="OccupationDescription" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">                                                                           
            <input type="text" class="form-control" placeholder="Occupation description" maxlength="50" name="OccupationDescription" id="OccupationDescription" value="<?php echo (isset($_POST['OccupationDescription']) ? $_POST['OccupationDescription'] : $ProfileInfo['OccupationDescription']);?>">
        </div>
    </div>
                                                                
    <div class="form-group row">
         <label for="IncomeRange" class="col-sm-2 col-form-label">Annual Income<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="IncomeRange" name="IncomeRange">
                <option value="0">Choose IncomeRange</option>
                <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo (isset($_POST[ 'IncomeRange'])) ? (($_POST[ 'IncomeRange']==$IncomeRange[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'AnnualIncome']==$IncomeRange[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $IncomeRange['CodeValue'];?>
                            <?php } ?> </option>
            </select>
            <span class="errorstring" id="ErrIncomeRange"><?php echo isset($ErrIncomeRange)? $ErrIncomeRange : "";?></span>
        </div>
         <label for="Country" class="col-sm-2 col-form-label">Working Country<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="selectpicker form-control" data-live-search="true" id="WCountry" name="WCountry">
                    <option value="0">Choose Country</option>
                    <?php foreach($response['data']['AllCountryName'] as $Country) { ?>
                        <option value="<?php echo $Country['SoftCode'];?>" <?php echo (isset($_POST[ 'WCountry'])) ? (($_POST[ 'WCountry']==$Country[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'WorkedCountry']==$Country['CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $Country['CodeValue'];?>  </option>
                                <?php } ?>
                </select>
                <span class="errorstring" id="ErrWCountry"><?php echo isset($ErrWCountry)? $ErrWCountry : "";?></span>
            </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Attachment</label>
        <div class="col-sm-4">
            <?php if($ProfileInfo['OccupationAttachFileName']==""){  ?>
                <input type="File" id="File" name="File" Placeholder="File">
            <?php }  else {  ?>  
                <div id="attachfilediv"><img src="<?php echo AppUrl;?>uploads/<?php echo $ProfileInfo['OccupationAttachFileName'];?>" style="height:120px;"><br><a href="javascript:void(0)" onclick="DraftProfile.showAttachmentOccupation('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $ProfileInfo['MemberID'];?>','<?php echo $ProfileInfo['ProfileID'];?>','<?php echo $ProfileInfo['OccupationAttachFileName'];?>')"><img src="<?php echo AppUrl ;?>assets/images/document_delete.png" style="width:16px;height:16px">&nbsp;Remove</a></div><br><input type="File" id="File" name="File" Placeholder="File">
       <?php }?>
       </div>
       <label class="col-sm-2 col-form-label">City Name<span id="star">*</span></label>
       <div class="col-sm-4">
           <input type="text" class="form-control" id="WorkedCityName" name="WorkedCityName" value="<?php echo (isset($_POST['WorkedCityName']) ? $_POST['WorkedCityName'] : $ProfileInfo['WorkedCityName']);?>" placeholder="City Name">
            <span class="errorstring" id="ErrWorkedCityName"><?php echo isset($ErrWorkedCityName)? $ErrWorkedCityName : "";?></span>
       </div>
    </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <label for="Details" class="col-sm-2 col-form-label">Details</label>
        </div>
     <div class="form-group row">
        <div class="col-sm-12">                                                                           
            <textarea class="form-control" maxlength="250" style="margin-bottom:5px" name="OccupationDetails" id="OccupationDetails"><?php echo (isset($_POST['OccupationDetails']) ? $_POST['OccupationDetails'] : $ProfileInfo['OccupationDetails']);?></textarea>
            Max 250 Characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span>
        </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12"><?php echo $errormessage ;?><?php echo $successmessage;?></div>
                        </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <ul class="pager">
                <li><a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>">Previous</a></li>
                <li><a href="../FamilyInformation/<?php echo $_GET['Code'].".htm";?>">Next</a></li>
            </ul>
        </div>
    </div>
    
</form>
</div>
<div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="height:285px"></div>
    </div>
</div>
<script>
   $(document).ready(function() {
    var text_max = 250;
    var text_length = $('#OccupationDetails').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#OccupationDetails').keyup(function() {
        var text_length = $('#OccupationDetails').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
        DraftProfile.addOtherOccupation();
        DraftProfile.addOtherWorkingDetails();
    });
    
   function DeleteOccupationAttachmentOnly(ProfileID) {
        var param = $("#Occupationform_"+ProfileID).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Member&a=DeleteOccupationAttachmentOnly", param, function(result2) {                                             
            $('#DeleteNow_body').html(result2);                                     
           $('#attachfilediv').hide();
        }
    );
}  
</script>  
<?php include_once("settings_footer.php");?>                    