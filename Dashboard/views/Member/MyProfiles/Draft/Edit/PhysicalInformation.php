<?php
    $page="PhysicalInformation";
    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Member","EditDraftPhysicalInformation",$_POST);
        if ($response['status']=="success") {  ?>
         <script> $(document).ready(function() {   $.simplyToast("Success", 'info'); });  </script>
      <?php  } else {              ?>
           <script> $(document).ready(function() {   $.simplyToast("failed", 'danger'); });  </script>
     <?php   }
    }
    
    $response = $webservice->getData("Member","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10 rightwidget">
<script>
$(document).ready(function () {
    $("#PhysicallyImpaired").change(function() {
            if ($("#PhysicallyImpaired").val()=="0") {
                $("#ErrPhysicallyImpaired").html("Please select your Physically Impaired");  
            }else{
                $("#ErrPhysicallyImpaired").html("");  
            }
    });
    $("#VisuallyImpaired").change(function() {
        if ($("#VisuallyImpaired").val()=="0") {
            $("#ErrVisuallyImpaired").html("Please select your Visually Impaired");  
        }else{
            $("#ErrVisuallyImpaired").html("");  
        }
    });
    $("#VissionImpaired").change(function() {
        if ($("#VissionImpaired").val()=="0") {
            $("#ErrVissionImpaired").html("Please select Vission Impaired");  
        }else{
            $("#ErrVissionImpaired").html("");  
        }
    });
    $("#SpeechImpaired").change(function() {
        if ($("#SpeechImpaired").val()=="0") {
            $("#ErrSpeechImpaired").html("Please select Speech Impaired");  
        }else{
            $("#ErrSpeechImpaired").html("");  
        }
    });
    $("#PhysicallyImpairedDescription").change(function() {
        if ($("#PhysicallyImpairedDescription").val()=="") {
            $("#ErrPhysicallyImpairedDescription").html("Please Enter Description");  
        }else{
            $("#ErrPhysicallyImpairedDescription").html("");  
        }
    });
    $("#VisuallyImpairedDescription").change(function() {
        if ($("#VisuallyImpairedDescription").val()=="") {
            $("#ErrVisuallyImpairedDescription").html("Please Enter Description");  
        }else{
            $("#ErrVisuallyImpairedDescription").html("");  
        }
    });
    $("#VissionImpairedDescription").change(function() {
        if ($("#VissionImpairedDescription").val()=="") {
            $("#ErrVissionImpairedDescription").html("Please Enter Description");  
        }else{
            $("#ErrVissionImpairedDescription").html("");  
        }
    });
    $("#SpeechImpairedDescription").change(function() {
        if ($("#SpeechImpairedDescription").val()=="") {
            $("#ErrSpeechImpairedDescription").html("Please Enter Description");  
        }else{
            $("#ErrSpeechImpairedDescription").html("");  
        }
    });
    $("#Height").change(function() {
        if ($("#Height").val()=="0") {
            $("#ErrHeight").html("Please select Height");  
        }else{
            $("#ErrHeight").html("");  
        }
    });
    $("#Weight").change(function() {
        if ($("#Weight").val()=="0") {
            $("#ErrWeight").html("Please select Weight");  
        }else{
            $("#ErrWeight").html("");  
        }
    });
    $("#BloodGroup").change(function() {
        if ($("#BloodGroup").val()=="0") {
            $("#ErrBloodGroup").html("Please select Blood Group");  
        }else{
            $("#ErrBloodGroup").html("");  
        }
    });
    $("#Complexation").change(function() {
        if ($("#Complexation").val()=="0") {
            $("#ErrComplexation").html("Please select Complexation");  
        }else{
            $("#ErrComplexation").html("");  
        }
    });
    $("#BodyType").change(function() {
        if ($("#BodyType").val()=="0") {
            $("#ErrBodyType").html("Please select Body Type");  
        }else{
            $("#ErrBodyType").html("");  
        }
    });
    $("#Diet").change(function() {
        if ($("#Diet").val()=="0") {
            $("#ErrDiet").html("Please select Diet");  
        }else{
            $("#ErrDiet").html("");  
        }
    }); 
    $("#SmookingHabit").change(function() {
        if ($("#SmookingHabit").val()=="0") {
            $("#ErrSmookingHabit").html("Please select Smoking Habit");  
        }else{
            $("#ErrSmookingHabit").html("");  
        }
    });
    $("#DrinkingHabit").change(function() {
        if ($("#DrinkingHabit").val()=="0") {
            $("#ErrDrinkingHabit").html("Please select Drinking Habit");  
        }else{
            $("#ErrDrinkingHabit").html("");  
        }
    });
});
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
 <form method="post" action=""  id="frmPI" onsubmit="return submitprofile();">
 <input type="hidden" value="<?php echo $_GET['Code'];?>" name="Code" id="Code">
    <h4 class="card-title">Physical Information</h4>
                    
    <div class="form-group row">
        <label for="PhysicallyImpaired" class="col-sm-3 col-form-label">Physically impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="PhysicallyImpaired" name="PhysicallyImpaired" onchange="getAdditionalPhysicalInfo()">
                <option value="0">Choose</option>
                <?php foreach($response['data']['PhysicallyImpaired'] as $PhysicallyImpaired) { ?>
                    <option value="<?php echo $PhysicallyImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'PhysicallyImpaired'])) ? (($_POST[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $PhysicallyImpaired['CodeValue'];?></option>
                <?php } ?>
            </select>
            <span class="errorstring" id="ErrPhysicallyImpaired"><?php echo isset($ErrPhysicallyImpaired)? $ErrPhysicallyImpaired : "";?></span>
        </div>
        <div class="col-sm-6" id="pm_input">
            <input type="text" class="form-control" name="PhysicallyImpairedDescription" id="PhysicallyImpairedDescription" maxlength="50" value="<?php echo (isset($_POST['PhysicallyImpairedDescription']) ? $_POST['PhysicallyImpairedDescription'] : $ProfileInfo['PhysicallyImpaireddescription']);?>" Placeholder="Physical Impaired Description">
            <span class="errorstring" id="ErrPhysicallyImpairedDescription"><?php echo isset($ErrPhysicallyImpairedDescription)? $ErrPhysicallyImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="VisuallyImpaired" class="col-sm-3 col-form-label">Visually impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VisuallyImpaired" name="VisuallyImpaired" onchange="getAdditionalVisualInfo()">
                <option value="0">Choose</option>
                <?php foreach($response['data']['VisuallyImpaired'] as $VisuallyImpaired) { ?>
                    <option value="<?php echo $VisuallyImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'VisuallyImpaired'])) ? (($_POST[ 'VisuallyImpaired']==$VisuallyImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VisuallyImpaired']==$VisuallyImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $VisuallyImpaired['CodeValue'];?>      </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrVisuallyImpaired"><?php echo isset($ErrVisuallyImpaired)? $ErrVisuallyImpaired : "";?></span>
        </div>
        <div class="col-sm-6" id="vs_input">
            <input type="text" class="form-control" name="VisuallyImpairedDescription" id="VisuallyImpairedDescription" maxlength="50" Placeholder="Visual Impaired Description" value="<?php echo (isset($_POST['VisuallyImpairedDescription']) ? $_POST['VisuallyImpairedDescription'] : $ProfileInfo['VisuallyImpairedDescription']);?>">
            <span class="errorstring" id="ErrVisuallyImpairedDescription"><?php echo isset($ErrVisuallyImpairedDescription)? $ErrVisuallyImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="VissionImpaired" class="col-sm-3 col-form-label">Vision impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VissionImpaired" name="VissionImpaired" onchange="getAdditionalVissionInfo()">
                <option value="0">Choose</option>
                <?php foreach($response['data']['VissionImpaired'] as $VissionImpaired) { ?>
                    <option value="<?php echo $VissionImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'VissionImpaired'])) ? (($_POST[ 'VissionImpaired']==$VissionImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VissionImpaired']==$VissionImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $VissionImpaired['CodeValue'];?>      </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrVissionImpaired"><?php echo isset($ErrVissionImpaired)? $ErrVissionImpaired : "";?></span>
        </div>
        <div class="col-sm-6" id="vn_input">
            <input type="text" class="form-control" name="VissionImpairedDescription" id="VissionImpairedDescription" maxlength="50" Placeholder="Vision Impaired Description" value="<?php echo (isset($_POST['VissionImpairedDescription']) ? $_POST['VissionImpairedDescription'] : $ProfileInfo['VissionImpairedDescription']);?>">
            <span class="errorstring" id="ErrVissionImpairedDescription"><?php echo isset($ErrVissionImpairedDescription)? $ErrVissionImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="SpeechImpaired" class="col-sm-3 col-form-label">Speech impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SpeechImpaired" name="SpeechImpaired" onchange="getAdditionalSpeechInfo()">
                <option value="0">Choose</option>
                <?php foreach($response['data']['SpeechImpaired'] as $SpeechImpaired) { ?>
                    <option value="<?php echo $SpeechImpaired['SoftCode'];?>" <?php echo (isset($_POST[ 'SpeechImpaired'])) ? (($_POST[ 'SpeechImpaired']==$SpeechImpaired[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SpeechImpaired']==$SpeechImpaired[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $SpeechImpaired['CodeValue'];?>    </option>
                            <?php } ?>
            </select>  
            <span class="errorstring" id="ErrSpeechImpaired"><?php echo isset($ErrSpeechImpaired)? $ErrSpeechImpaired : "";?></span>
        </div>
        <div class="col-sm-6" id="si_input">
            <input type="text" class="form-control" name="SpeechImpairedDescription" id="SpeechImpairedDescription" maxlength="50" Placeholder="Speech Impaired Description" value="<?php echo (isset($_POST['SpeechImpairedDescription']) ? $_POST['SpeechImpairedDescription'] : $ProfileInfo['SpeechImpairedDescription']);?>">
            <span class="errorstring" id="ErrSpeechImpairedDescription"><?php echo isset($ErrSpeechImpairedDescription)? $ErrSpeechImpairedDescription : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="Height" class="col-sm-3 col-form-label">Height<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted" style="font-size: 12px;">approximate</small></label>
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
        <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted" style="font-size: 12px;">approximate</small></label>
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
        <label for="BloodGroup" class="col-sm-3 col-form-label">Blood group<span id="star">*</span></label>
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
        <label for="BodyType" class="col-sm-3 col-form-label">Body type<span id="star">*</span></label>
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
        <label for="SmookingHabit" class="col-sm-3 col-form-label">Smoking habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SmookingHabit" name="SmookingHabit">
                <option value="0">Choose Diet Type</option>
                <?php foreach($response['data']['SmookingHabit'] as $SmookingHabit) { ?>
                    <option value="<?php echo $SmookingHabit['SoftCode'];?>" <?php echo (isset($_POST[ 'SmookingHabit'])) ? (($_POST[ 'SmookingHabit']==$SmookingHabit[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SmokingHabit']==$SmookingHabit[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $SmookingHabit['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrSmookingHabit"><?php echo isset($ErrSmookingHabit)? $ErrSmookingHabit : "";?></span> 
        </div>
        <label for="DrinkingHabit" class="col-sm-3 col-form-label">Drinking habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="DrinkingHabit" name="DrinkingHabit">
                <option value="0">Choose Diet Type</option>
                <?php foreach($response['data']['DrinkingHabit'] as $DrinkingHabit) { ?>
                    <option value="<?php echo $DrinkingHabit['SoftCode'];?>" <?php echo (isset($_POST[ 'DrinkingHabit'])) ? (($_POST[ 'DrinkingHabit']==$DrinkingHabit[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'DrinkingHabit']==$DrinkingHabit[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $DrinkingHabit['CodeValue'];?> </option>
                            <?php } ?>
            </select>
            <span class="errorstring" id="ErrDrinkingHabit"><?php echo isset($ErrDrinkingHabit)? $ErrDrinkingHabit : "";?></span> 
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-form-label">Additional information</label>
        <div class="col-sm-12">                                                        
            <textarea class="form-control" style="margin-bottom:5px;height:75px" maxlength="250" name="PhysicalDescription" id="PhysicalDescription"><?php echo (isset($_POST['PhysicalDescription']) ? $_POST['PhysicalDescription'] : $ProfileInfo['PhysicalDescription']);?></textarea>
            <label class="col-form-label" style="padding-top:0px;">Max 250 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></label>
        </div>
    </div>
   <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <a href="javascript:void(0)" onclick="ConfirmUpdatePInfo()" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</a>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <ul class="pager" style="float:right">
                  <li><a href="../FamilyInformation/<?php echo $_GET['Code'].".htm";?>">&#8249; Previous</a></li>
                  <li>&nbsp;</li>
                  <li><a href="../DocumentAttachment/<?php echo $_GET['Code'].".htm";?>">Next &#8250;</a></li>
            </ul>
        </div>
    </div>
    </form>                                                   
</div>
        <script>
        function getAdditionalPhysicalInfo() {
            
            if ($('#PhysicallyImpaired').val()=="PI001" || $('#PhysicallyImpaired').val()=="0")  {                                
                   $('#PhysicallyImpairedDescription').hide();
            }else {
                   $('#PhysicallyImpairedDescription').show();
            }
        }
        function getAdditionalVisualInfo() {
            
            if ($('#VisuallyImpaired').val()=="VI001" || $('#VisuallyImpaired').val()=="0")  {
                   $('#VisuallyImpairedDescription').hide();
            }else {
                   $('#VisuallyImpairedDescription').show();
            }
        }
        function getAdditionalVissionInfo() {
            
            if ($('#VissionImpaired').val()=="VS001" || $('#VissionImpaired').val()=="0")  {
                   $('#VissionImpairedDescription').hide();
            }else {
                   $('#VissionImpairedDescription').show();
            }
        }
        function getAdditionalSpeechInfo() {
            
            if ($('#SpeechImpaired').val()=="SI001" || $('#SpeechImpaired').val()=="0")  {
                   $('#SpeechImpairedDescription').hide();
            }else {
                   $('#SpeechImpairedDescription').show();
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
        function ConfirmUpdatePInfo() {
    if(submitprofile()) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit physical information</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit physical information</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="EditDraftPhysicalInformation()" style="font-family:roboto">Update</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     } else {
           return false;
     }
}
function EditDraftPhysicalInformation() {
    var param = $("#frmPI").serialize();
    $('#Publish_body').html(preloading_withText("Updating physical information ...","95"));
        $.post(API_URL + "m=Member&a=EditDraftPhysicalInformation",param,function(result) {
            
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Updated</h3>'             
                                    + '<h4 style="text-align:center;">Physical Information</h4>'             
                                    + '<p style="text-align:center;"><a href="../DocumentAttachment/'+data.Code+'.htm" style="cursor:pointer;color:#489bae">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit physical information</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
}
    </script>
<?php include_once("settings_footer.php");?>                    
