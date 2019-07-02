<?php
    $page="CommunicationDetails";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
        <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label for="Email ID" class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $ProfileInfo['EmailID']);?>" placeholder="Email ID">
            </div>
        </div>
        <div class="form-group row">
            <label for="Mobile Number" class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $ProfileInfo['MobileNumber']);?>" placeholder="Mobile Number">
            </div>
            <label for="WhatsappNumber" class="col-sm-3 col-form-label">Whatsapp Number</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $ProfileInfo['WhatsappNumber']);?>" placeholder="Whatsapp Number">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine1" class="col-sm-2 col-form-label">Address<span id="star">*</span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $ProfileInfo['AddressLine1']);?>" placeholder="AddressLine1">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine2" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $ProfileInfo['AddressLine2']);?>" placeholder="AddressLine2">
            </div>
        </div>
        <div class="form-group row">
            <label for="AddressLine3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $ProfileInfo['AddressLine3']);?>" placeholder="AddressLine3">
            </div>
        </div>
        <div class="form-group row">
            <label for="Country" class="col-sm-2 col-form-label">Country<span id="star">*</span></label>
            <div class="col-sm-3">
                <select class="selectpicker form-control" data-live-search="true" id="Country" name="Country">
                    <option value="0">Choose Country</option>
                    <?php foreach($response['data']['CountryName'] as $Country) { ?>
                        <option value="<?php echo $Country['CodeValue'];?>" <?php echo (isset($_POST[ 'Country'])) ? (($_POST[ 'Country']==$Country[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Country']==$Country[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $Country['CodeValue'];?>
                        </option>
                        <?php } ?>
                </select>
            </div>
            <label for="State" class="col-sm-2 col-form-label">State<span id="star">*</span></label>
            <div class="col-sm-3">
                <select class="selectpicker form-control" data-live-search="true" id="StateName" name="StateName">
                    <option value="0">Choose State</option>
                    <?php foreach($response['data']['StateName'] as $StateName) { ?>
                        <option value="<?php echo $StateName['CodeValue'];?>" <?php echo (isset($_POST[ 'StateName'])) ? (($_POST[ 'StateName']==$StateName[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'State']==$StateName[ 'SoftCode']) ? " selected='selected' " : "");?>>
                            <?php echo $StateName['CodeValue'];?>
                                <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 col-form-label">City<span id="star">*</span></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="City" name="City" Placeholder="City" value="<?php echo (isset($_POST['City']) ? $_POST['City'] : $ProfileInfo['City']);?>">
            </div>
            <label for="OtherLocation" class="col-sm-2 col-form-label">Landmark</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="OtherLocation" name="OtherLocation" Placeholder="Other Location" value="<?php echo (isset($_POST['OtherLocation']) ? $_POST['OtherLocation'] : $ProfileInfo['OtherLocation']);?>">
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