<?php
    $page="OccupationDetails";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Occupation Details</h4>
    <div class="form-group row">
        <label for="Employed As" class="col-sm-2 col-form-label">Employed As<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs" name="EmployedAs">
                <option value="0">Choose Employed As</option>
                <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <option value="<?php echo $EmployedAs['CodeValue'];?>" <?php echo (isset($_POST[ 'EmployedAs'])) ? (($_POST[ 'EmployedAs']==$EmployedAs[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'EmployedAsCode']==$EmployedAs[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $EmployedAs['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="OccupationType" class="col-sm-2 col-form-label">Occupation<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="OccupationType" name="OccupationType">
                <option value="0">Choose Occupatin Types</option>
                <?php foreach($response['data']['Occupation'] as $OccupationType) { ?>
                    <option value="<?php echo $OccupationType['CodeValue'];?>" <?php echo (isset($_POST[ 'OccupationType'])) ? (($_POST[ 'OccupationType']==$OccupationType[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'OccupationTypeCode']==$OccupationType[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $OccupationType['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="TypeofOccupation" class="col-sm-2 col-form-label">OccupationType<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="TypeofOccupation" name="TypeofOccupation">
                <option value="0">Choose Type of Occupation</option>
                <?php foreach($response['data']['TypeofOccupation'] as $TypeofOccupation) { ?>
                    <option value="<?php echo $TypeofOccupation['CodeValue'];?>" <?php echo (isset($_POST[ 'TypeofOccupation'])) ? (($_POST[ 'TypeofOccupation']==$TypeofOccupation[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'TypeofOccupationCode']==$TypeofOccupation[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $TypeofOccupation['CodeValue'];?>
                            <?php } ?>
            </select>
        </div>
        <label for="IncomeRange" class="col-sm-2 col-form-label">Annual Income<span id="star">*</span></label>
        <div class="col-sm-4">
            <select class="selectpicker form-control" data-live-search="true" id="IncomeRange" name="IncomeRange">
                <option value="0">Choose IncomeRange</option>
                <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['CodeValue'];?>" <?php echo (isset($_POST[ 'IncomeRange'])) ? (($_POST[ 'IncomeRange']==$IncomeRange[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'AnnualIncomeCode']==$IncomeRange[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $IncomeRange['CodeValue'];?>
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