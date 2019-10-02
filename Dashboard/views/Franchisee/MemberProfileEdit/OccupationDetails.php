<?php
    $page="OccupationDetails";
   /* if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Franchisee","EditDraftOccupationDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }    */
    
    $response = $webservice->GetDraftProfileInformation(array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
   ?>
    <?php
                if (isset($_POST['BtnSaveProfile'])) {
                    
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
                        $OccupationAttachments = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"], $target_dir . $OccupationAttachments))) {
                           $err++;
                           echo "Sorry, there was an error uploading your file.";
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
                       
                         ErrorCount=0;
                         
                           if($("#EmployedAs").val()=="0"){
                            document.getElementById("ErrEmployedAs").innerHTML="Please select employed as"; 
                             ErrorCount++;
                         } 
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
            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs" name="EmployedAs">
                <option value="0">Choose Employed As</option>
                <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo (isset($_POST[ 'EmployedAs'])) ? (($_POST[ 'EmployedAs']==$EmployedAs[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'EmployedAs']==$EmployedAs[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $EmployedAs['CodeValue'];?>
                            <?php } ?>      </option>
            </select>
            <span class="errorstring" id="ErrEmployedAs"><?php echo isset($ErrEmployedAs)? $ErrEmployedAs : "";?></span>
        </div>
        <label for="OccupationType" class="col-sm-2 col-form-label">Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="OccupationType" name="OccupationType">
                <option value="0">Choose Occupatin Types</option>
                <?php foreach($response['data']['Occupation'] as $OccupationType) { ?>
                    <option value="<?php echo $OccupationType['SoftCode'];?>" <?php echo (isset($_POST[ 'OccupationType'])) ? (($_POST[ 'OccupationType']==$OccupationType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'OccupationType']==$OccupationType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $OccupationType['CodeValue'];?>
                            <?php } ?>      </option>
            </select>
            <span class="errorstring" id="ErrOccupationType"><?php echo isset($ErrOccupationType)? $ErrOccupationType : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="TypeofOccupation" class="col-sm-2 col-form-label">OccupationType<span id="star">*</span></label>
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
    </div>                                                             
    <div class="form-group row">
         <label for="Country" class="col-sm-2 col-form-label">Country<span id="star">*</span></label>
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
        <div class="col-sm-8"><input type="File" id="File" name="File" Placeholder="File"></div>
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
<?php include_once("settings_footer.php");?>                    