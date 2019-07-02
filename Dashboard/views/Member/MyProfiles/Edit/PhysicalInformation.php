<?php
    $page="PhysicalInformation";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Physical Information</h4>
    <div class="form-group row">
        <label for="PhysicallyImpaired" class="col-sm-3 col-form-label">Physically Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="PhysicallyImpaired" name="PhysicallyImpaired">
                <option value="0">Choose Physically Impaired</option>
                <?php foreach($response['data']['PhysicallyImpaired'] as $PhysicallyImpaired) { ?>
                    <option value="<?php echo $PhysicallyImpaired['CodeValue'];?>" <?php echo (isset($_POST[ 'PhysicallyImpaired'])) ? (($_POST[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'PhysicallyImpaired']==$PhysicallyImpaired[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $PhysicallyImpaired['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="VisuallyImpaired" class="col-sm-3 col-form-label">Visually Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VisuallyImpaired" name="VisuallyImpaired">
                <option value="0">Choose Visually Impaired</option>
                <?php foreach($response['data']['VisuallyImpaired'] as $VisuallyImpaired) { ?>
                    <option value="<?php echo $VisuallyImpaired['CodeValue'];?>" <?php echo (isset($_POST[ 'VisuallyImpaired'])) ? (($_POST[ 'VisuallyImpaired']==$VisuallyImpaired[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VisuallyImpaired']==$VisuallyImpaired[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $VisuallyImpaired['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="VissionImpaired" class="col-sm-3 col-form-label">Vission Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="VissionImpaired" name="VissionImpaired">
                <option value="0"> Vission Impaired</option>
                <?php foreach($response['data']['VissionImpaired'] as $VissionImpaired) { ?>
                    <option value="<?php echo $VissionImpaired['CodeValue'];?>" <?php echo (isset($_POST[ 'VissionImpaired'])) ? (($_POST[ 'VissionImpaired']==$VissionImpaired[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'VissionImpaired']==$VissionImpaired[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $VissionImpaired['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="SpeechImpaired" class="col-sm-3 col-form-label">Speech Impaired?<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SpeechImpaired" name="SpeechImpaired">
                <option value="0">Choose Speech Impaired</option>
                <?php foreach($response['data']['SpeechImpaired'] as $SpeechImpaired) { ?>
                    <option value="<?php echo $SpeechImpaired['CodeValue'];?>" <?php echo (isset($_POST[ 'SpeechImpaired'])) ? (($_POST[ 'SpeechImpaired']==$SpeechImpaired[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SpeechImpaired']==$SpeechImpaired[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $SpeechImpaired['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="Height" class="col-sm-3 col-form-label">Height<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Height" name="Height">
                <option value="0">Choose Height</option>
                <?php foreach($response['data']['Height'] as $Height) { ?>
                    <option value="<?php echo $Height['CodeValue'];?>" <?php echo (isset($_POST[ 'Height'])) ? (($_POST[ 'Height']==$Height[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Height']==$Height[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $Height['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="Weight" class="col-sm-3 col-form-label">Weight<span id="star">*</span> &nbsp;&nbsp;<small class="mb-0 mr-2 text-muted text-muted">approximate</small></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Weight" name="Weight">
                <option value="0">Choose Weight</option>
                <?php foreach($response['data']['Weight'] as $Weight) { ?>
                    <option value="<?php echo $Weight['CodeValue'];?>" <?php echo (isset($_POST[ 'Weight'])) ? (($_POST[ 'Weight']==$Weight[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Weight']==$Weight[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $Weight['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="BloodGroup" class="col-sm-3 col-form-label">Blood Group<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="BloodGroup" name="BloodGroup">
                <option value="0">Choose Blood Group</option>
                <?php foreach($response['data']['BloodGroup'] as $BloodGroup) { ?>
                    <option value="<?php echo $BloodGroup['CodeValue'];?>" <?php echo (isset($_POST[ 'BloodGroup'])) ? (($_POST[ 'BloodGroup']==$BloodGroup[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'BloodGroup']==$BloodGroup[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $BloodGroup['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="Complexation" class="col-sm-3 col-form-label">Complexation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Complexation" name="Complexation">
                <option value="0">Choose Complexation</option>
                <?php foreach($response['data']['Complexation'] as $Complexation) { ?>
                    <option value="<?php echo $Complexation['CodeValue'];?>" <?php echo (isset($_POST[ 'Complexation'])) ? (($_POST[ 'Complexation']==$Complexation[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Complexation']==$Complexation[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $Complexation['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="BodyType" class="col-sm-3 col-form-label">Body Type<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="BodyType" name="BodyType">
                <option value="0">Choose Body Type</option>
                <?php foreach($response['data']['BodyType'] as $BodyType) { ?>
                    <option value="<?php echo $BodyType['CodeValue'];?>" <?php echo (isset($_POST[ 'BodyType'])) ? (($_POST[ 'BodyType']==$BodyType[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'BodyType']==$BodyType[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $BodyType['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="Diet" class="col-sm-3 col-form-label">Diet<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Diet" name="Diet">
                <option value="0">Choose Body Type</option>
                <?php foreach($response['data']['Diet'] as $Diet) { ?>
                    <option value="<?php echo $Diet['CodeValue'];?>" <?php echo (isset($_POST[ 'Diet'])) ? (($_POST[ 'Diet']==$Diet[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Diet']==$Diet[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $Diet['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="SmookingHabit" class="col-sm-3 col-form-label">Smooking Habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="SmookingHabit" name="SmookingHabit">
                <option value="0">Choose Smiking Habits</option>
                <?php foreach($response['data']['SmookingHabit'] as $SmookingHabit) { ?>
                    <option value="<?php echo $SmookingHabit['CodeValue'];?>" <?php echo (isset($_POST[ 'SmookingHabit'])) ? (($_POST[ 'SmookingHabit']==$SmookingHabit[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'SmokingHabit']==$SmookingHabit[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $SmookingHabit['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="DrinkingHabit" class="col-sm-3 col-form-label">Drinking Habit<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="DrinkingHabit" name="DrinkingHabit">
                <option value="0">Choose Drinking Habits</option>
                <?php foreach($response['data']['DrinkingHabit'] as $DrinkingHabit) { ?>
                    <option value="<?php echo $DrinkingHabit['CodeValue'];?>" <?php echo (isset($_POST[ 'DrinkingHabit'])) ? (($_POST[ 'DrinkingHabit']==$DrinkingHabit[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'DrinkingHabit']==$DrinkingHabit[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $DrinkingHabit['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
    </div>
</div>
 
<?php include_once("settings_footer.php");?>                    