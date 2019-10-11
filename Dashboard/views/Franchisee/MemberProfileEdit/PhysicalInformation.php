<?php
    $page="PhysicalInformation";
   
    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Franchisee","EditDraftPhysicalInformation",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
     $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<script>
function submitprofile() {
                         $('#ErrPhysicallyImpaired').html("");
                         $('#ErrVisuallyImpaired').html("");
                         $('#ErrVissionImpaired').html("");
                         $('#ErrSpeechImpaired').html("");
                         $('#ErrHeight').html("");
                         $('#ErrWeight').html("");
                         $('#ErrBloodGroup').html("");
                         $('#ErrComplexation').html("");
                         $('#ErrBodyType').html("");
                         $('#ErrDiet').html("");
                         $('#ErrSmookingHabit').html("");
                         $('#ErrDrinkingHabit').html(""); 
                         $('#ErrPhysicallyImpairedDescription').html("");
                         $('#ErrVisuallyImpairedDescription').html("");
                         $('#ErrVissionImpairedDescription').html("");
                         $('#ErrSpeechImpairedDescription').html("");
                       
                         ErrorCount=0;
                         
                         if($("#PhysicallyImpaired").val()=="0"){
                            document.getElementById("ErrPhysicallyImpaired").innerHTML="Please select Physically Impaired"; 
                             ErrorCount++;
                         } 
                         if($("#VisuallyImpaired").val()=="0"){
                            document.getElementById("ErrVisuallyImpaired").innerHTML="Please select Visually Impaired"; 
                             ErrorCount++;
                         }
                         if($("#VissionImpaired").val()=="0"){
                            document.getElementById("ErrVissionImpaired").innerHTML="Please select Vission Impaired"; 
                             ErrorCount++;
                         } 
                         if($("#SpeechImpaired").val()=="0"){
                            document.getElementById("ErrSpeechImpaired").innerHTML="Please select Speech Impaired"; 
                             ErrorCount++;
                         }
                         if($("#Height").val()=="0"){
                            document.getElementById("ErrHeight").innerHTML="Please select Height"; 
                             ErrorCount++;
                         }
                         if($("#Weight").val()=="0"){
                            document.getElementById("ErrWeight").innerHTML="Please select Weight"; 
                             ErrorCount++;
                         }
                         if($("#BloodGroup").val()=="0"){
                            document.getElementById("ErrBloodGroup").innerHTML="Please select Blood Group"; 
                             ErrorCount++;
                         }
                         if($("#Complexation").val()=="0"){
                            document.getElementById("ErrComplexation").innerHTML="Please select Complexation"; 
                             ErrorCount++;
                         }
                         if($("#BodyType").val()=="0"){
                            document.getElementById("ErrBodyType").innerHTML="Please select Body Type"; 
                             ErrorCount++;
                         }
                         if($("#Diet").val()=="0"){
                            document.getElementById("ErrDiet").innerHTML="Please select Diet"; 
                             ErrorCount++;
                         }
                         if($("#SmookingHabit").val()=="0"){
                            document.getElementById("ErrSmookingHabit").innerHTML="Please select Smooking Habit"; 
                             ErrorCount++;
                         }
                         if($("#DrinkingHabit").val()=="0"){
                            document.getElementById("ErrDrinkingHabit").innerHTML="Please select Drinking Habit"; 
                             ErrorCount++;
                         }
                         if($("#PhysicallyImpaired").val()=="PI002"){
                            if($("#PhysicallyImpairedDescription").val()==""){
                                document.getElementById("ErrPhysicallyImpairedDescription").innerHTML="Please Enter Description"; 
                                 ErrorCount++;
                            }
                         }
                         if($("#VisuallyImpaired").val()=="VI002"){
                            if($("#VisuallyImpairedDescription").val()==""){
                                document.getElementById("ErrVisuallyImpairedDescription").innerHTML="Please Enter Description"; 
                                 ErrorCount++;
                            }
                         }
                         if($("#VissionImpaired").val()=="VS002"){
                            if($("#VissionImpairedDescription").val()==""){
                                document.getElementById("ErrVissionImpairedDescription").innerHTML="Please Enter Description"; 
                                 ErrorCount++;
                            }
                         }
                         if($("#SpeechImpaired").val()=="SI002"){
                             if($("#SpeechImpairedDescription").val()==""){
                                document.getElementById("ErrSpeechImpairedDescription").innerHTML="Please Enter Description"; 
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
    var text_length = $('#PhysicalDescription').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#PhysicalDescription').keyup(function() {
        var text_length = $('#PhysicalDescription').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script>
 <form method="post" action="" onsubmit="return submitprofile();">
    <h4 class="card-title">Physical Information</h4>
                    
   <div class="form-group row">
        <label for="PhysicallyImpaired" class="col-sm-3 col-form-label">Physically Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="PhysicallyImpaired" name="PhysicallyImpaired" onchange="getAdditionalPhysicalInfo()">
                <option value="0">Choose Physically Impaired</option>
                <?php foreach($response['data']['PhysicallyImpaired'] as $PhysicallyImpaired) { ?>
                    <option value="<?php echo $PhysicallyImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'PhysicallyImpaired'])) ? (($_POST[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $PhysicallyImpaired['CodeValue'];?></option>
                <?php } ?>
            </select>
            <span class="errorstring" id="ErrPhysicallyImpaired"><?php echo isset($ErrPhysicallyImpaired)? $ErrPhysicallyImpaired : "";?></span>
        </div>
        <label for="Description" class="col-sm-3 col-form-label" id="pm_description"></label>
        <div class="col-sm-3" id="pm_input">
            <input type="text" class="form-control" name="PhysicallyImpairedDescription" id="PhysicallyImpairedDescription" value="<?php echo (isset($_POST['PhysicallyImpairedDescription']) ? $_POST['PhysicallyImpairedDescription'] : $ProfileInfo['PhysicallyImpaireddescription']);?>">
            <span class="errorstring" id="ErrPhysicallyImpairedDescription"><?php echo isset($ErrPhysicallyImpairedDescription)? $ErrPhysicallyImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="VisuallyImpaired" class="col-sm-3 col-form-label">Visually Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VisuallyImpaired" name="VisuallyImpaired" onchange="getAdditionalVisualInfo()">
                <option value="0">Choose Visually Impaired</option>
                <?php foreach($response['data']['VisuallyImpaired'] as $VisuallyImpaired) { ?>
                    <option value="<?php echo $VisuallyImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'VisuallyImpaired'])) ? (($_POST[ 'VisuallyImpaired']==$VisuallyImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VisuallyImpaired']==$VisuallyImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $VisuallyImpaired['CodeValue'];?>      </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrVisuallyImpaired"><?php echo isset($ErrVisuallyImpaired)? $ErrVisuallyImpaired : "";?></span>
        </div>
        <label for="Description" class="col-sm-3 col-form-label" id="vs_description"></label>
        <div class="col-sm-3" id="vs_input">
            <input type="text" class="form-control" name="VisuallyImpairedDescription" id="VisuallyImpairedDescription" value="<?php echo (isset($_POST['VisuallyImpairedDescription']) ? $_POST['VisuallyImpairedDescription'] : $ProfileInfo['VisuallyImpairedDescription']);?>">
            <span class="errorstring" id="ErrVisuallyImpairedDescription"><?php echo isset($ErrVisuallyImpairedDescription)? $ErrVisuallyImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="VissionImpaired" class="col-sm-3 col-form-label">Vision Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VissionImpaired" name="VissionImpaired" onchange="getAdditionalVissionInfo()">
                <option value="0">Choose Vision Impaired</option>
                <?php foreach($response['data']['VissionImpaired'] as $VissionImpaired) { ?>
                    <option value="<?php echo $VissionImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'VissionImpaired'])) ? (($_POST[ 'VissionImpaired']==$VissionImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VissionImpaired']==$VissionImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $VissionImpaired['CodeValue'];?>      </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrVissionImpaired"><?php echo isset($ErrVissionImpaired)? $ErrVissionImpaired : "";?></span>
        </div>
        <label for="Description" class="col-sm-3 col-form-label" id="vn_description"></label>
        <div class="col-sm-3" id="vn_input">
            <input type="text" class="form-control" name="VissionImpairedDescription" id="VissionImpairedDescription" value="<?php echo (isset($_POST['VissionImpairedDescription']) ? $_POST['VissionImpairedDescription'] : $ProfileInfo['VissionImpairedDescription']);?>">
            <span class="errorstring" id="ErrVissionImpairedDescription"><?php echo isset($ErrVissionImpairedDescription)? $ErrVissionImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="SpeechImpaired" class="col-sm-3 col-form-label">Speech Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SpeechImpaired" name="SpeechImpaired" onchange="getAdditionalSpeechInfo()">
                <option value="0">Choose Speech Impaired</option>
                <?php foreach($response['data']['SpeechImpaired'] as $SpeechImpaired) { ?>
                    <option value="<?php echo $SpeechImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'SpeechImpaired'])) ? (($_POST[ 'SpeechImpaired']==$SpeechImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SpeechImpaired']==$SpeechImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $SpeechImpaired['CodeValue'];?>    </option>
                            <?php } ?>
            </select>  
            <span class="errorstring" id="ErrSpeechImpaired"><?php echo isset($ErrSpeechImpaired)? $ErrSpeechImpaired : "";?></span>
        </div>
        <label for="Description" class="col-sm-3 col-form-label" id="si_description"></label>
        <div class="col-sm-3" id="si_input">
            <input type="text" class="form-control" name="SpeechImpairedDescription" id="SpeechImpairedDescription" value="<?php echo (isset($_POST['SpeechImpairedDescription']) ? $_POST['SpeechImpairedDescription'] : $ProfileInfo['SpeechImpairedDescription']);?>">
            <span class="errorstring" id="ErrSpeechImpairedDescription"><?php echo isset($ErrSpeechImpairedDescription)? $ErrSpeechImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="Height" class="col-sm-3 col-form-label">Height<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Height" name="Height">
                <option value="0">Choose Height</option>
                <?php foreach($response['data']['Height'] as $Height) { ?>
                    <option value="<?php echo $Height['SoftCode'];?>" <?php echo (isset($_POST[ 'Height'])) ? (($_POST[ 'Height']==$Height[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Height']==$Height[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Height['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrHeight"><?php echo isset($ErrHeight)? $ErrHeight : "";?></span>
        </div>
        <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Weight" name="Weight">
                <option value="0">Choose Weight</option>
                <?php foreach($response['data']['Weight'] as $Weight) { ?>
                    <option value="<?php echo $Weight['SoftCode'];?>" <?php echo (isset($_POST[ 'Weight'])) ? (($_POST[ 'Weight']==$Weight[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Weight']==$Weight[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Weight['CodeValue'];?>      </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrWeight"><?php echo isset($ErrWeight)? $ErrWeight : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="BloodGroup" class="col-sm-3 col-form-label">Blood Group<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="BloodGroup" name="BloodGroup">
                <option value="0">Choose Blood Group</option>
                <?php foreach($response['data']['BloodGroup'] as $BloodGroup) { ?>
                    <option value="<?php echo $BloodGroup['SoftCode'];?>" <?php echo (isset($_POST[ 'BloodGroup'])) ? (($_POST[ 'BloodGroup']==$BloodGroup[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'BloodGroup']==$BloodGroup[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $BloodGroup['CodeValue'];?>  </option>
                            <?php } ?>
            </select>   
            <span class="errorstring" id="ErrBloodGroup"><?php echo isset($ErrBloodGroup)? $ErrBloodGroup : "";?></span>                                                                            
        </div>
        <label for="Complexation" class="col-sm-3 col-form-label">Complexation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Complexation" name="Complexation">
                <option value="0">Choose Complexation</option>
                <?php foreach($response['data']['Complexation'] as $Complexation) { ?>
                    <option value="<?php echo $Complexation['SoftCode'];?>" <?php echo (isset($_POST[ 'Complexation'])) ? (($_POST[ 'Complexation']==$Complexation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Complexation']==$Complexation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Complexation['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrComplexation"><?php echo isset($ErrComplexation)? $ErrComplexation : "";?></span> 
        </div>
    </div>
    <div class="form-group row">
        <label for="BodyType" class="col-sm-3 col-form-label">Body Type<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="BodyType" name="BodyType">
                <option value="0">Choose Body Type</option>
                <?php foreach($response['data']['BodyType'] as $BodyType) { ?>
                    <option value="<?php echo $BodyType['SoftCode'];?>" <?php echo (isset($_POST[ 'BodyType'])) ? (($_POST[ 'BodyType']==$BodyType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'BodyType']==$BodyType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $BodyType['CodeValue'];?></option>
                            <?php } ?>
            </select> 
             <span class="errorstring" id="ErrBodyType"><?php echo isset($ErrBodyType)? $ErrBodyType : "";?></span> 
        </div>                                                             
        <label for="Diet" class="col-sm-3 col-form-label">Diet<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Diet" name="Diet">
                <option value="0">Choose Diet Type</option>
                <?php foreach($response['data']['Diet'] as $Diet) { ?>
                    <option value="<?php echo $Diet['SoftCode'];?>" <?php echo (isset($_POST[ 'Diet'])) ? (($_POST[ 'Diet']==$Diet[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Diet']==$Diet[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Diet['CodeValue'];?> </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrDiet"><?php echo isset($ErrDiet)? $ErrDiet : "";?></span> 
        </div>
    </div>
    <div class="form-group row">
        <label for="SmookingHabit" class="col-sm-3 col-form-label">Smoking Habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SmookingHabit" name="SmookingHabit">
                <option value="0">Choose Smoking Habits</option>
                <?php foreach($response['data']['SmookingHabit'] as $SmookingHabit) { ?>
                    <option value="<?php echo $SmookingHabit['SoftCode'];?>" <?php echo (isset($_POST[ 'SmookingHabit'])) ? (($_POST[ 'SmookingHabit']==$SmookingHabit[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SmokingHabit']==$SmookingHabit[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $SmookingHabit['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrSmookingHabit"><?php echo isset($ErrSmookingHabit)? $ErrSmookingHabit : "";?></span> 
        </div>
        <label for="DrinkingHabit" class="col-sm-3 col-form-label">Drinking Habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="DrinkingHabit" name="DrinkingHabit">
                <option value="0">Choose Drinking Habits</option>
                <?php foreach($response['data']['DrinkingHabit'] as $DrinkingHabit) { ?>
                    <option value="<?php echo $DrinkingHabit['SoftCode'];?>" <?php echo (isset($_POST[ 'DrinkingHabit'])) ? (($_POST[ 'DrinkingHabit']==$DrinkingHabit[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'DrinkingHabit']==$DrinkingHabit[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $DrinkingHabit['CodeValue'];?> </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrDrinkingHabit"><?php echo isset($ErrDrinkingHabit)? $ErrDrinkingHabit : "";?></span> 
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Description<span id="star">*</span></label>
        <div class="col-sm-10">                                                        
            <textarea class="form-control" maxlength="250" name="PhysicalDescription" id="PhysicalDescription"><?php echo (isset($_POST['PhysicalDescription']) ? $_POST['PhysicalDescription'] : $ProfileInfo['PhysicalDescription']);?></textarea> <br>
            <div class="col-sm-12">Max 250 Characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></div>
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
                  <li><a href="../FamilyInformation/<?php echo $_GET['Code'].".htm";?>">Previous</a></li>
                  <li><a href="../DocumentAttachment/<?php echo $_GET['Code'].".htm";?>">Next</a></li>
            </ul>
        </div>
    </div>
    </form>                                                   
</div>
      <script>
        function getAdditionalPhysicalInfo() {
            
            if ($('#PhysicallyImpaired').val()=="PI001")  {                                
                   $('#PhysicallyImpairedDescription').hide();
                   $('#pm_description').html('');
            }else {
                   $('#PhysicallyImpairedDescription').show();
                   $('#pm_description').html('Description<span id="star">*</span>');
            }
        }
        function getAdditionalVisualInfo() {
            
            if ($('#VisuallyImpaired').val()=="VI001")  {
                   $('#VisuallyImpairedDescription').hide();
                   $('#vs_description').html('');
            }else {
                   $('#VisuallyImpairedDescription').show();
                   $('#vs_description').html('Description<span id="star">*</span>');
            }
        }
        function getAdditionalVissionInfo() {
            
            if ($('#VissionImpaired').val()=="VS001")  {
                   $('#VissionImpairedDescription').hide();
                   $('#vn_description').html('');
            }else {
                   $('#VissionImpairedDescription').show();
                   $('#vn_description').html('Description<span id="star">*</span>');
            }
        }
        function getAdditionalSpeechInfo() {
            
            if ($('#SpeechImpaired').val()=="SI001")  {
                   $('#SpeechImpairedDescription').hide();
                   $('#si_description').html('');
            }else {
                   $('#SpeechImpairedDescription').show();
                   $('#si_description').html('Description<span id="star">*</span>');
            }
        }
        
        setTimeout(function(){
            getAdditionalPhysicalInfo()
        },1000);
        setTimeout(function(){
            getAdditionalVisualInfo()
        },1000);
        setTimeout(function(){
            getAdditionalVissionInfo()
        },1000);
        setTimeout(function(){
            getAdditionalSpeechInfo()
        },1000);
    </script>
<?php include_once("settings_footer.php");?>                    