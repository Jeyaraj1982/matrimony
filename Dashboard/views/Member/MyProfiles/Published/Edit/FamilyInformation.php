<?php
    $page="FamilyInformation";

    if (isset($_POST['BtnSaveProfile'])) {
        $response = $webservice->getData("Member","EditDraftFamilyInformation",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
          //  echo "<script>location.href='../PhysicalInformation/".$_GET['Code'].".htm'</script>";
        } else {
            $errormessage = $response['message']; 
        }
    }
    
  $response = $webservice->getData("Member","GetPublishedProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
     $CountryCodes =$response['data']['ContactCountrycode'];
?>
<?php include_once("settings_header.php");?>
<script>
 $(document).ready(function () {
        $("#FathersContact").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrFathersContact").html("Digits Only").fadeIn("fast");
                return false;
            }
        });$("#MotherContact").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMotherContact").html("Digits Only").fadeIn("fast");
                return false;
            }
        });
        });
function submitprofile() {
       $('#ErrFatherName').html("");
       $('#ErrMotherName').html("");
       
        ErrorCount=0;
        
        if (IsNonEmpty("FatherName","ErrFatherName","Please enter your father name")) {
            IsAlphabet("FatherName","ErrFatherName","Please enter alpha numeric characters only");
            }
        if (IsNonEmpty("MotherName","ErrMotherName","Please enter your mother name")) {
            IsAlphabet("MotherName","ErrMotherName","Please enter alpha numeric characters only");
            }
            
        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }   
                        
    
    
}
$(document).ready(function() {
    var text_max = 250;
    var text_length = $('#AboutMyFamily').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#AboutMyFamily').keyup(function() {
        var text_length = $('#AboutMyFamily').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="return submitprofile();">
    <h4 class="card-title">Family Information</h4>
    <div class="form-group row">
        <label for="FatherName" class="col-sm-3 col-form-label">Father's Name<span id="star">*</span></label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="FatherName" name="FatherName" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : $ProfileInfo['FathersName']);?>" placeholder="Name">
            <span class="errorstring" id="ErrFatherName"><?php echo isset($ErrFatherName)? $ErrFatherName : "";?></span>
        </div>
        <div class="col-sm-2">
            <input type="checkbox" name="FathersAlive" id="FathersAlive" <?php echo (isset($_POST[ 'FathersAlive'])) ? (($_POST[ 'FathersAlive']=="on") ? " Checked='Checked' " : "") : (($ProfileInfo['FathersAlive']=="1") ? " Checked='Checked' " : "");?>>&nbsp;<label for="FathersAlive">Passed away</label>  
       </div>
        <!--<label for="FatherAlive" class="col-sm-2 col-form-label">Father's Status<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FathersAlive" name="FathersAlive">
                <?php // foreach($response['data']['ParentsAlive'] as $Alive) { ?>
                    <option value="<?php echo $Alive['SoftCode'];?>" <?php echo (isset($_POST[ 'FathersAlive'])) ? (($_POST[ 'FathersAlive']==$Alive[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersAlive']==$Alive[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php // echo $Alive['CodeValue'];?>   </option>
                            <?php // } ?>
            </select>
       </div> -->
    </div>
    <div class="form-group row">
        <label for="FatherContact" class="col-sm-3 col-form-label">Father's Contact<span id="star">*</span></label>
        <div class="col-sm-3">
        <select class="selectpicker form-control" data-live-search="true" name="FathersContactCountryCode" id="FathersContactCountryCode">
                   <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'FathersContactCountryCode'])) ? (($_POST[ 'FathersContactCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersContactCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>                    
                   <?php } ?></option>
        </select>
        </div>
        <div class="col-sm-3" style="margin-left:-30px;">
            <input type="text" class="form-control" id="FathersContact" maxlength="10" name="FathersContact" value="<?php echo (isset($_POST['FathersContact']) ? $_POST['FathersContact'] : $ProfileInfo['FathersContact']);?>" placeholder="Father Contact">
            <span class="errorstring" id="ErrFathersContact"><?php echo isset($ErrFathersContact)? $ErrFathersContact : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="FathersOccupation" class="col-sm-3 col-form-label">Father's Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="FathersOccupation" name="FathersOccupation">
                <option value="0">Choose Father Occupation</option>
                <?php foreach($response['data']['Occupation'] as $FathersOccupation) { ?>
                <option value="<?php echo $FathersOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'FathersOccupation'])) ? (($_POST[ 'FathersOccupation']==$FathersOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersOccupation']==$FathersOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FathersOccupation['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
        <label for="FathersIncome" class="col-sm-2 col-form-label">Father's Income<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FathersIncome" name="FathersIncome">
                <option value="0">Choose IncomeRange</option>
                <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo (isset($_POST[ 'FathersIncome'])) ? (($_POST[ 'FathersIncome']==$IncomeRange[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersIncome']==$IncomeRange[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $IncomeRange['CodeValue'];?>
                            <?php } ?> </option>
            </select>
        </div>
    </div>                                                                                                          
    <div class="form-group row">
        <label for="MotherName" class="col-sm-3 col-form-label">Mother's Name<span id="star">*</span></label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="MotherName" name="MotherName" Placeholder="Mother Name" value="<?php echo (isset($_POST['MotherName']) ? $_POST['MotherName'] : $ProfileInfo['MothersName']);?>">
            <span class="errorstring" id="ErrMotherName"><?php echo isset($ErrMotherName)? $ErrMotherName : "";?></span>
        </div>
       <div class="col-sm-2">
             <input type="checkbox" name="MothersAlive" id="MothersAlive" <?php echo (isset($_POST[ 'MothersAlive'])) ? (($_POST[ 'MothersAlive']=="on") ? " Checked='Checked' " : "") : (($ProfileInfo['MothersAlive']=="1") ? " Checked='Checked' " : "");?>>&nbsp;<label for="MothersAlive">Passed away</label>  
       </div>
    </div>
    <div class="form-group row">
        <label for="MotherContact" class="col-sm-3 col-form-label">Mother's Contact<span id="star">*</span></label>
        <div class="col-sm-3">
        <select class="selectpicker form-control" data-live-search="true"  name="MotherContactCountryCode" id="MotherContactCountryCode" style="width: 61px;">
                   <?php foreach($response['data']['CountryName'] as $CountryCode) { ?>
                  <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'MotherContactCountryCode'])) ? (($_POST[ 'MotherContactCountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MotherContactCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $CountryCode['str'];?>
                   <?php } ?></option>
        </select>
        </div>
        <div class="col-sm-3" style="margin-left:-30px;">
            <input type="text" class="form-control" id="MotherContact" maxlength="10" name="MotherContact" value="<?php echo (isset($_POST['MotherContact']) ? $_POST['MotherContact'] : $ProfileInfo['MothersContact']);?>" placeholder="Mother Contact">
            <span class="errorstring" id="ErrMotherContact"><?php echo isset($ErrMotherContact)? $ErrMotherContact : "";?></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="MothersOccupation" class="col-sm-3 col-form-label">Mother's Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="MothersOccupation" name="MothersOccupation">
                <option value="0">Choose Mother Occupation</option>
                <?php foreach($response['data']['Occupation'] as $MothersOccupation) { ?>
                    <option value="<?php echo $MothersOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'MothersOccupation'])) ? (($_POST[ 'MothersOccupation']==$MothersOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MothersOccupation']==$MothersOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $MothersOccupation['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
        </div>
        <label for="MothersIncome" class="col-sm-2 col-form-label">Mother's Income<span id="star">*</span></label>
        <div class="col-sm-3">
                 <select class="selectpicker form-control" data-live-search="true" id="MothersIncome" name="MothersIncome">
                <option value="0">Choose IncomeRange</option>
                <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo (isset($_POST[ 'MothersIncome'])) ? (($_POST[ 'MothersIncome']==$IncomeRange[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MothersIncome']==$IncomeRange[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $IncomeRange['CodeValue'];?>
                            <?php } ?> </option>
            </select>
        </div>                                                                      
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Family Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="FamilyType" name="FamilyType">
                <option value="0">Choose Family Type</option>
                <?php foreach($response['data']['FamilyType'] as $FamilyType) { ?>
                <option value="<?php echo $FamilyType['SoftCode'];?>" <?php echo (isset($_POST[ 'FamilyType'])) ? (($_POST[ 'FamilyType']==$FamilyType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FamilyType']==$FamilyType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FamilyType['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
        <label for="Family Value" class="col-sm-2 col-form-label">Family Affluence<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FamilyAffluence" name="FamilyAffluence">
                <option value="0">Choose Family Value</option>
                <?php foreach($response['data']['FamilyAffluence'] as $FamilyAffluence) { ?>
                <option value="<?php echo $FamilyAffluence['SoftCode'];?>" <?php echo (isset($_POST[ 'FamilyAffluence'])) ? (($_POST[ 'FamilyAffluence']==$FamilyAffluence[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FamilyAffluence']==$FamilyAffluence[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FamilyAffluence['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
    </div>
    <div class="form-group row">
         <label for="Family Value" class="col-sm-3 col-form-label">Family Value<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FamilyValue" name="FamilyValue">
                <option value="0">Choose Family Value</option>
                <?php foreach($response['data']['FamilyValue'] as $FamilyValue) { ?>
                <option value="<?php echo $FamilyValue['SoftCode'];?>" <?php echo (isset($_POST[ 'FamilyValue'])) ? (($_POST[ 'FamilyValue']==$FamilyValue[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FamilyValue']==$FamilyValue[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FamilyValue['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="No of Brothers" class="col-sm-2 col-form-label">No of Brothers<span id="star">*</span></label>
        <div class="col-sm-1" style="max-width:100px !important" align="left">
            <select class=" form-control"  id="NumberofBrother" onchange="print_brother_counts()" name="NumberofBrother" style="width: 50px;">
                <option>Brothers</option>
                <?php foreach($response['data']['NumberofBrother'] as $NumberofBrother) { ?>
                    <option value="<?php echo $NumberofBrother['SoftCode'];?>" <?php echo (isset($_POST[ 'NumberofBrother'])) ? (($_POST[ 'NumberofBrother']==$NumberofBrother[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofBrothers']==$NumberofBrother[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofBrother['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
        </div>
         <label for="Elder" class="col-sm-1 col-form-label" style="text-align:right">Elder</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class="form-control" id="belder" name="elder" style="width: 50px;">
                <?php foreach($response['data']['NumberofElderBrother'] as $elder) { ?>
                    <option value="<?php echo $elder['SoftCode'];?>" <?php echo (isset($_POST[ 'elder'])) ? (($_POST[ 'elder']==$elder[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Elder']==$elder[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $elder['CodeValue'];?></option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Younger</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class="form-control"  id="byounger" name="younger" style="width: 50px;">
                <?php foreach($response['data']['NumberofYoungerBrother'] as $younger) { ?>
                    <option value="<?php echo $younger['SoftCode'];?>" <?php echo (isset($_POST[ 'younger'])) ? (($_POST[ 'younger']==$younger[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Younger']==$younger[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $younger['CodeValue'];?></option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Married</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class=" form-control"   id="married" name="married" style="width: 50px;">
                <?php foreach($response['data']['NumberofMarriedBrother'] as $married) { ?>
                    <option value="<?php echo $married['SoftCode'];?>" <?php echo (isset($_POST[ 'married'])) ? (($_POST[ 'married']==$married[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Married']==$married[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $married['CodeValue'];?></option>
                            <?php } ?>
            </select>
        </div>  
    </div>
    <div class="form-group row">
        <label for="No of Sisters" class="col-sm-2 col-form-label">No of Sisters<span id="star">*</span></label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="form-control" id="NumberofSisters" onchange="print_sister_counts()" name="NumberofSisters" style="width: 50px;">
                <?php foreach($response['data']['NumberofSisters'] as $NumberofSister) { ?>
                    <option value="<?php echo $NumberofSister['SoftCode'];?>" <?php echo (isset($_POST[ 'NumberofSisters'])) ? (($_POST[ 'NumberofSisters']==$NumberofSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofSisters']==$NumberofSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofSister['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-1 col-form-label" style="text-align:right">Elder</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="form-control" id="elderSister" name="elderSister" style="width: 50px;">
                <?php foreach($response['data']['NumberofElderSisters'] as $elderSister) { ?>
                    <option value="<?php echo $elderSister['SoftCode'];?>" <?php echo (isset($_POST[ 'elderSister'])) ? (($_POST[ 'elderSister']==$elderSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'ElderSister']==$elderSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $elderSister['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Younger</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="form-control" id="youngerSister" name="youngerSister" style="width: 50px;">
                <?php foreach($response['data']['NumberofYoungerSisters'] as $youngerSister) { ?>
                    <option value="<?php echo $youngerSister['SoftCode'];?>" <?php echo (isset($_POST[ 'youngerSister'])) ? (($_POST[ 'youngerSister']==$youngerSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'YoungerSister']==$youngerSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $youngerSister['CodeValue'];?> </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Married</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="form-control" id="marriedSister" name="marriedSister" style="width: 50px;">
                <?php foreach($response['data']['NumberofMarriedSisters'] as $marriedSister) { ?>
                    <option value="<?php echo $marriedSister['SoftCode'];?>" <?php echo (isset($_POST[ 'marriedSister'])) ? (($_POST[ 'marriedSister']==$marriedSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MarriedSister']==$marriedSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $marriedSister['CodeValue'];?> </option>
                            <?php } ?>                                                                                                              
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="AboutMe" class="col-sm-2 col-form-label">About My Family<span id="star">*</span></label>
        <div class="col-sm-10">                                                        
            <textarea class="form-control" maxlength="250" name="AboutMyFamily" id="AboutMyFamily"><?php echo (isset($_POST['AboutMyFamily']) ? $_POST['AboutMyFamily'] : $ProfileInfo['AboutMyFamily']);?></textarea> <br>
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
        <div class="col-sm-3"><a href="../PhysicalInformation/<?php echo $_GET['Code'].".htm";?>">Next</a></div>
    </div>
    
</div>                                                                       
<script>
    function print_brother_counts() {
        var n_brothers = $('#NumberofBrother').val();
        if (n_brothers=='NOB001') {
             $('#belder').hide();
             $('#byounger').hide();
             $('#married').hide();
        } else {
            $('#belder').show();
            $('#byounger').show();
            $('#married').show();
           
           var c = ['NOB001','NOB002','NOB003','NOB004','NOB005','NOB006','NOB007','NOB008','NOB009','NOB010'] ;
          
          $('#belder').find('option').remove();
          $('#byounger').find('option').remove();
          $('#married').find('option').remove();
                 
            for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    document.getElementById('belder').appendChild(opt);
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
   
    document.getElementById('byounger').appendChild(opt);
    
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    
    document.getElementById('married').appendChild(opt);
}
        }
        
    }
    
    setTimeout(function(){
        print_brother_counts();
    },1000);
    
function print_sister_counts() {      
        var n_brothers = $('#NumberofSisters').val();
        if (n_brothers=='NS001') {
             $('#elderSister').hide();
             $('#youngerSister').hide();
             $('#marriedSister').hide();
        } else {
            $('#elderSister').show();
            $('#youngerSister').show();
            $('#marriedSister').show();
           
           var c = ['NS001','NS002','NS003','NS004','NS005','NS006','NS007','NS008','NS009','NS010'] ;
          
          $('#elderSister').find('option').remove();
          $('#youngerSister').find('option').remove();
          $('#marriedSister').find('option').remove();
                 
            for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    document.getElementById('elderSister').appendChild(opt);
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
   
    document.getElementById('youngerSister').appendChild(opt);
    
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    
    document.getElementById('marriedSister').appendChild(opt);
}
        }
        
    }
    
    setTimeout(function(){
        print_sister_counts();
    },1000);
    </script>              
<?php include_once("settings_footer.php");?>                     