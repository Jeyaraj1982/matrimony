<?php
    $page="OccupationDetails";
   $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
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
                        $_POST['File']= $OccupationAttachments;
                        $res =$webservice->getData("Franchisee","EditDraftOccupationDetails",$_POST);   
                       if ($res['status']=="success") {
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                        $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
                        $ProfileInfo = $response['data']['ProfileInfo'];
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
$(document).ready(function() {
    var text_max = 250;
    var text_length = $('#OccupationDetails').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#OccupationDetails').keyup(function() {
        var text_length = $('#OccupationDetails').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return submitprofile();">
    <h4 class="card-title">Occupation Details</h4>
    <div class="form-group row">
        <label for="Employed As" class="col-sm-2 col-form-label">Employed As<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs" name="EmployedAs" onchange="addOtherWorkingDetails();">
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
        <label for="TypeofOccupation" class="col-sm-2 col-form-label">Occupation Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="TypeofOccupation" name="TypeofOccupation">
                <option value="0">Choose Type of Occupation</option>
                <?php foreach($response['data']['TypeofOccupation'] as $TypeofOccupation) { ?>
                    <option value="<?php echo $TypeofOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'TypeofOccupation'])) ? (($_POST[ 'TypeofOccupation']==$TypeofOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'TypeofOccupation']==$TypeofOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $TypeofOccupation['CodeValue'];?>
                            <?php } ?>    </option>
            </select>
            <span class="errorstring" id="ErrTypeofOccupation"><?php echo isset($ErrTypeofOccupation)? $ErrTypeofOccupation : "";?></span>
        </div>
    </div>
    <div class="form-group row">
      <label for="OccupationType" class="col-sm-2 col-form-label">Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="OccupationType" name="OccupationType" onchange="addOtherOccupation();">
                <option value="0">Choose Occupation Types</option>
                <?php foreach($response['data']['Occupation'] as $OccupationType) { ?>
                    <option value="<?php echo $OccupationType['SoftCode'];?>" <?php echo (isset($_POST[ 'OccupationType'])) ? (($_POST[ 'OccupationType']==$OccupationType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'OccupationType']==$OccupationType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $OccupationType['CodeValue'];?>
                            <?php } ?>      </option>
            </select>
            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
        </div>
        <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-4"  id="Occupation_additionalinfo"><input type="text" class="form-control" id="OtherOccupation" name="OtherOccupation" value="<?php echo (isset($_POST['OtherOccupation']) ? $_POST['OtherOccupation'] : $ProfileInfo['OtherOccupation']);?>">
            <span class="errorstring" id="ErrOtherOccupation"><?php echo isset($ErrOtherOccupation)? $ErrOtherOccupation : "";?></span></div>
    </div> 
    <div class="form-group row">
        <label for="OccupationDescription" class="col-sm-2 col-form-label">Description<span id="star">*</span></label>
        <div class="col-sm-7">                                                                           
            <input type="text" class="form-control" maxlength="50" name="OccupationDescription" id="OccupationDescription" value="<?php echo (isset($_POST['OccupationDescription']) ? $_POST['OccupationDescription'] : $ProfileInfo['OccupationDescription']);?>">
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
         <label for="Country" class="col-sm-2 col-form-label">Worked Place<span id="star">*</span></label>
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
        <div class="col-sm-8">
            <?php if($ProfileInfo['OccupationAttachFileName']==""){  ?>
                <input type="File" id="File" name="File" Placeholder="File">
            <?php }  else {  ?>  
                <div id="attachfilediv"><img src="<?php echo AppUrl;?>uploads/<?php echo $ProfileInfo['OccupationAttachFileName'];?>" style="height:120px;"><br><a href="javascript:void(0)" onclick="showAttachmentOccupation('<?php echo $ProfileInfo['ProfileCode'];?>','<?php echo $ProfileInfo['MemberID'];?>','<?php echo $ProfileInfo['ProfileID'];?>','<?php echo $ProfileInfo['OccupationAttachFileName'];?>')"><img src="<?php echo AppUrl ;?>assets/images/document_delete.png" style="width:16px;height:16px">&nbsp;Remove</a></div><br><input type="File" id="File" name="File" Placeholder="File">
       <?php }?>
       </div>
    </div>
    </div>
     <div class="form-group row">
        <label for="Details" class="col-sm-2 col-form-label">Details<span id="star">*</span></label>
        <div class="col-sm-10">                                                                           
            <textarea class="form-control" maxlength="250" name="OccupationDetails" id="OccupationDetails"><?php echo (isset($_POST['OccupationDetails']) ? $_POST['OccupationDetails'] : $ProfileInfo['OccupationDetails']);?></textarea> <br>
            <div class="col-sm-12">Max 250 Characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></div>
        </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12"><?php echo $errormessage ;?><?php echo $successmessage;?></div>
                        </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
        <div class="col-sm-3"><a href="../FamilyInformation/<?php echo $_GET['Code'].".htm";?>">Next</a></div>
    </div>
  
</form>
</div>
  <div class="modal" id="DeleteNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="height:285px"></div>
    </div>
</div>
<script>
function showAttachmentOccupation(ProfileCode,MemberID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="Occupationfrform_'+ProfileCode+'" name="Occupationfrform_'+ProfileCode+'" > '
                         + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                         + '<input type="hidden" value="'+MemberID+'" name="MemberID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Confirmation For Remove</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                               +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteOccupationAttachmentOnly(\''+ProfileCode+'\')">Yes, remove</button>&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                        +'</form>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
        }
        function DeleteOccupationAttachmentOnly(ProfileCode) {
        var param = $("#Occupationfrform_"+ProfileCode).serialize();
        $('#DeleteNow_body').html(preloader);
        $.post(API_URL + "m=Franchisee&a=DeleteOccupationAttachmentOnly", param, function(result2) {                                             
            $('#DeleteNow_body').html(result2);                                     
           $('#attachfilediv').hide();
        }
        );
        }  
        
        function addOtherWorkingDetails() {
            if ($('#EmployedAs').val()=="O001") {
                $('#Working_additionalinfo').show();
            } else {
                $('#Working_additionalinfo').hide();
            }
        }
        function addOtherOccupation() {
            if ($('#OccupationType').val()=="OT112") {
                $('#Occupation_additionalinfo').show();
            } else {
                $('#Occupation_additionalinfo').hide();
            }
        }
        
        addOtherOccupation();
        addOtherWorkingDetails();
</script>
<?php include_once("settings_footer.php");?>                    