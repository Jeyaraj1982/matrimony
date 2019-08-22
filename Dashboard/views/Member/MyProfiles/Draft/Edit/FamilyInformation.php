<?php
    $page="FamilyInformation";

    if (isset($_POST['BtnSaveProfile'])) {
        $response = $webservice->getData("Member","EditDraftFamilyInformation",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Member","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="">
    <h4 class="card-title">Family Information</h4>
    <div class="form-group row">
        <label for="FatherName" class="col-sm-2 col-form-label">Father's Name<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="FatherName" name="FatherName" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : $ProfileInfo['FathersName']);?>" placeholder="Name">
        </div>
        <label for="FathersOccupation" class="col-sm-3 col-form-label">Father's Occupation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FathersOccupation" name="FathersOccupation">
                <option value="0">Choose Father Occupation</option>
                <?php foreach($response['data']['Occupation'] as $FathersOccupation) { ?>
                <option value="<?php echo $FathersOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'FathersOccupation'])) ? (($_POST[ 'FathersOccupation']==$FathersOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersOccupation']==$FathersOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FathersOccupation['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="FatherContact" class="col-sm-2 col-form-label">Father's Contact<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="FathersContact" name="FathersContact" value="<?php echo (isset($_POST['FathersContact']) ? $_POST['FathersContact'] : $ProfileInfo['FathersContact']);?>" placeholder="Father Contact">
        </div>
        <label for="FathersIncome" class="col-sm-3 col-form-label">Father's Income<span id="star">*</span></label>
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
        <label for="MotherName" class="col-sm-2 col-form-label">Mother's Name<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="MotherName" name="MotherName" Placeholder="Mother Name" value="<?php echo (isset($_POST['MotherName']) ? $_POST['MotherName'] : $ProfileInfo['MothersName']);?>">
        </div>
        <label for="MothersOccupation" class="col-sm-3 col-form-label">Mother's Occupation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="MothersOccupation" name="MothersOccupation">
                <option value="0">Choose Mother Occupation</option>
                <?php foreach($response['data']['Occupation'] as $MothersOccupation) { ?>
                    <option value="<?php echo $MothersOccupation['SoftCode'];?>" <?php echo (isset($_POST[ 'MothersOccupation'])) ? (($_POST[ 'MothersOccupation']==$MothersOccupation[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MothersOccupation']==$MothersOccupation[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $MothersOccupation['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="MotherContact" class="col-sm-2 col-form-label">Mother's Contact<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="MotherContact" name="MotherContact" value="<?php echo (isset($_POST['MotherContact']) ? $_POST['MotherContact'] : $ProfileInfo['MothersContact']);?>" placeholder="Mother Contact">
        </div>
        <label for="MothersIncome" class="col-sm-3 col-form-label">Mother's Income<span id="star">*</span></label>
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
        <label for="FatherAlive" class="col-sm-2 col-form-label">Father Alive<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="FathersAlive" name="FathersAlive">
                <?php foreach($response['data']['ParentsAlive'] as $Alive) { ?>
                    <option value="<?php echo $Alive['SoftCode'];?>" <?php echo (isset($_POST[ 'FathersAlive'])) ? (($_POST[ 'FathersAlive']==$Alive[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersAlive']==$Alive[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Alive['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
       </div>
        <label for="MotherAlive" class="col-sm-3 col-form-label">Mother Alive<span id="star">*</span></label>
        <div class="col-sm-3">
                <select class="selectpicker form-control" data-live-search="true" id="MothersAlive" name="MothersAlive">
                <?php foreach($response['data']['ParentsAlive'] as $MAlive) { ?>
                    <option value="<?php echo $MAlive['SoftCode'];?>" <?php echo (isset($_POST[ 'MothersAlive'])) ? (($_POST[ 'MothersAlive']==$MAlive[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MothersAlive']==$MAlive[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $MAlive['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Family Type<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="FamilyType" name="FamilyType">
                <option value="0">Choose Family Type</option>
                <?php foreach($response['data']['FamilyType'] as $FamilyType) { ?>
                <option value="<?php echo $FamilyType['SoftCode'];?>" <?php echo (isset($_POST[ 'FamilyType'])) ? (($_POST[ 'FamilyType']==$FamilyType[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FamilyType']==$FamilyType[ 'CodeValue']) ? " selected='selected' " : "");?>>
                <?php echo $FamilyType['CodeValue'];?> </option>
                <?php } ?> 
            </select>
        </div>
        <label for="Family Value" class="col-sm-3 col-form-label">Family Affluence <span id="star">*</span></label>
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
         <label for="Family Value" class="col-sm-2 col-form-label">Family Value<span id="star">*</span></label>
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
            <select class="selectpicker form-control" data-live-search="true" id="NumberofBrother" name="NumberofBrother">
                <option>Brothers</option>
                <?php foreach($response['data']['NumberofBrother'] as $NumberofBrother) { ?>
                    <option value="<?php echo $NumberofBrother['SoftCode'];?>" <?php echo (isset($_POST[ 'NumberofBrother'])) ? (($_POST[ 'NumberofBrother']==$NumberofBrother[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofBrothers']==$NumberofBrother[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofBrother['CodeValue'];?>   </option>
                            <?php } ?>
            </select>
        </div>
         <label for="Elder" class="col-sm-1 col-form-label" style="text-align:right">Elder</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="elder" name="elder">
                <?php foreach($response['data']['NumberofElderBrother'] as $elder) { ?>
                    <option value="<?php echo $elder['SoftCode'];?>" <?php echo (isset($_POST[ 'elder'])) ? (($_POST[ 'elder']==$elder[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Elder']==$elder[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $elder['CodeValue'];?></option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Younger</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="younger" name="younger" size="width:60px">
                <?php foreach($response['data']['NumberofYoungerBrother'] as $younger) { ?>
                    <option value="<?php echo $younger['SoftCode'];?>" <?php echo (isset($_POST[ 'younger'])) ? (($_POST[ 'younger']==$younger[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Younger']==$younger[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $younger['CodeValue'];?></option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Married</label>
        <div class="col-sm-1" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="married" name="married" size="width:60px">
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
            <select class="selectpicker form-control" data-live-search="true" id="NumberofSisters" name="NumberofSisters" size="width:60px">
                <?php foreach($response['data']['NumberofSisters'] as $NumberofSister) { ?>
                    <option value="<?php echo $NumberofSister['SoftCode'];?>" <?php echo (isset($_POST[ 'NumberofSisters'])) ? (($_POST[ 'NumberofSisters']==$NumberofSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofSisters']==$NumberofSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofSister['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-1 col-form-label" style="text-align:right">Elder</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="elderSister" name="elderSister" size="width:60px">
                <?php foreach($response['data']['NumberofElderSisters'] as $elderSister) { ?>
                    <option value="<?php echo $elderSister['SoftCode'];?>" <?php echo (isset($_POST[ 'elderSister'])) ? (($_POST[ 'elderSister']==$elderSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'ElderSister']==$elderSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $elderSister['CodeValue'];?>  </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Younger</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="youngerSister" name="youngerSister" size="width:60px">
                <?php foreach($response['data']['NumberofYoungerSisters'] as $youngerSister) { ?>
                    <option value="<?php echo $youngerSister['SoftCode'];?>" <?php echo (isset($_POST[ 'youngerSister'])) ? (($_POST[ 'youngerSister']==$youngerSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'YoungerSister']==$youngerSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $youngerSister['CodeValue'];?> </option>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label" style="text-align:right">Married</label>
        <div class="col-sm-1" align="left" style="max-width:100px !important">
            <select class="selectpicker form-control" data-live-search="true" id="marriedSister" name="marriedSister" size="width:60px">
                <?php foreach($response['data']['NumberofMarriedSisters'] as $marriedSister) { ?>
                    <option value="<?php echo $marriedSister['SoftCode'];?>" <?php echo (isset($_POST[ 'marriedSister'])) ? (($_POST[ 'marriedSister']==$marriedSister[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MarriedSister']==$marriedSister[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $marriedSister['CodeValue'];?> </option>
                            <?php } ?>                                                                                                              
            </select>
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
    </div>
    
</div>
              
<?php include_once("settings_footer.php");?>                    