<?php
    $page="FamilyInformation";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Family Information</h4>
    <div class="form-group row">
        <label for="FatherName" class="col-sm-2 col-form-label">Father's Name<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="FatherName" name="FatherName" value="<?php echo (isset($_POST['FatherName']) ? $_POST['FatherName'] : $ProfileInfo['FathersName']);?>" placeholder="Name">
        </div>
        <label for="FathersOccupation" class="col-sm-3 col-form-label">Fathers Occupation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="FathersOccupation" name="FathersOccupation">
                <option value="0">Choose Father Occupation</option>
                <?php foreach($response['data']['Occupation'] as $FathersOccupation) { ?>
                    <option value="<?php echo $FathersOccupation['CodeValue'];?>" <?php echo (isset($_POST[ 'FathersOccupation'])) ? (($_POST[ 'FathersOccupation']==$FathersOccupation[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'FathersOccupation']==$FathersOccupation[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $FathersOccupation['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="MotherName" class="col-sm-2 col-form-label">Mother's Name<span id="star">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="MotherName" name="MotherName" Placeholder="Mother Name" value="<?php echo (isset($_POST['MotherName']) ? $_POST['MotherName'] : $ProfileInfo['MothersName']);?>">
        </div>
        <label for="MothersOccupation" class="col-sm-3 col-form-label">Mothers Occupation<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="MothersOccupation" name="MothersOccupation">
                <option value="0">Choose Mother Occupation</option>
                <?php foreach($response['data']['Occupation'] as $MothersOccupation) { ?>
                    <option value="<?php echo $MothersOccupation['CodeValue'];?>" <?php echo (isset($_POST[ 'MothersOccupation'])) ? (($_POST[ 'MothersOccupation']==$MothersOccupation[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MothersOccupation']==$MothersOccupation[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $MothersOccupation['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="No of Brothers" class="col-sm-2 col-form-label">No of Brothers<span id="star">*</span></label>
        <div class="col-sm-1" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="NumberofBrother" name="NumberofBrother" size="width:60px">
                <?php foreach($response['data']['NumberofBrother'] as $NumberofBrother) { ?>
                    <option value="<?php echo $NumberofBrother['CodeValue'];?>" <?php echo (isset($_POST[ 'NumberofBrother'])) ? (($_POST[ 'NumberofBrother']==$NumberofBrother[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofBrothers']==$NumberofBrother[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofBrother['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="Elder" class="col-sm-1 col-form-label">Elder</label>
        <div class="col-sm-1">
            <select class="selectpicker form-control" data-live-search="true" id="elder" name="elder" size="width:60px">
                <?php foreach($response['data']['NumberofElderBrother'] as $elder) { ?>
                    <option value="<?php echo $elder['CodeValue'];?>" <?php echo (isset($_POST[ 'elder'])) ? (($_POST[ 'elder']==$elder[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Elder']==$elder[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $elder['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label">younger</label>
        <div class="col-sm-1">
            <select class="selectpicker form-control" data-live-search="true" id="younger" name="younger" size="width:60px">
                <?php foreach($response['data']['NumberofYoungerBrother'] as $younger) { ?>
                    <option value="<?php echo $younger['CodeValue'];?>" <?php echo (isset($_POST[ 'younger'])) ? (($_POST[ 'younger']==$younger[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Younger']==$younger[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $younger['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-1 col-form-label">married</label>
        <div class="col-sm-1">
            <select class="selectpicker form-control" data-live-search="true" id="married" name="married" size="width:60px">
                <?php foreach($response['data']['NumberofMarriedBrother'] as $married) { ?>
                    <option value="<?php echo $married['CodeValue'];?>" <?php echo (isset($_POST[ 'married'])) ? (($_POST[ 'married']==$married[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Married']==$married[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $married['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="No of Sisters" class="col-sm-2 col-form-label">No of Sisters<span id="star">*</span></label>
        <div class="col-sm-1" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="NumberofSisters" name="NumberofSisters" size="width:60px">
                <?php foreach($response['data']['NumberofSisters'] as $NumberofSister) { ?>
                    <option value="<?php echo $NumberofSister['CodeValue'];?>" <?php echo (isset($_POST[ 'NumberofSisters'])) ? (($_POST[ 'NumberofSisters']==$NumberofSister[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NumberofSisters']==$NumberofSister[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $NumberofSister['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-1 col-form-label">elder</label>
        <div class="col-sm-1" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="elderSister" name="elderSister" size="width:60px">
                <?php foreach($response['data']['NumberofElderSisters'] as $elderSister) { ?>
                    <option value="<?php echo $elderSister['CodeValue'];?>" <?php echo (isset($_POST[ 'elderSister'])) ? (($_POST[ 'elderSister']==$elderSister[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'ElderSister']==$elderSister[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $elderSister['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-2 col-form-label">younger</label>
        <div class="col-sm-1" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="youngerSister" name="youngerSister" size="width:60px">
                <?php foreach($response['data']['NumberofYoungerSisters'] as $youngerSister) { ?>
                    <option value="<?php echo $youngerSister['CodeValue'];?>" <?php echo (isset($_POST[ 'youngerSister'])) ? (($_POST[ 'youngerSister']==$youngerSister[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'YoungerSister']==$youngerSister[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $youngerSister['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="elder" class="col-sm-1 col-form-label">married</label>
        <div class="col-sm-1" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="marriedSister" name="marriedSister" size="width:60px">
                <?php foreach($response['data']['NumberofMarriedSisters'] as $marriedSister) { ?>
                    <option value="<?php echo $marriedSister['CodeValue'];?>" <?php echo (isset($_POST[ 'marriedSister'])) ? (($_POST[ 'marriedSister']==$marriedSister[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MarriedSister']==$marriedSister[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $marriedSister['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save as draft</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
    </div>
</div>
              
<?php include_once("settings_footer.php");?>                    