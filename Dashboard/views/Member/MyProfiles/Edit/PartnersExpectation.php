   <?php
    $page="PartnersExpectation";
    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->getData("Member","AddPartnersExpectaion",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Member","GetPartnersExpectaionInformation",array("ProfileID"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
   ?>
       
<?php include_once("settings_header.php");?>
<div class="col-sm-9" style="margin-top: -8px;">
<form method="post" action="" onsubmit="">
    <h4 class="card-title">Partners Expectation</h4>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Age</div>
        <div class="col-sm-2" align="left" style="width:100px">
            <select class="selectpicker form-control" data-live-search="true" id="age" name="age">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'age'])) ? (($_POST[ 'age']==$i) ? " selected='selected' " : "") : (($ProfileInfo[ 'AgeFrom']==$i) ? " selected='selected' " : "");?>>
                        <?php echo $i;?>
                    </option>
                    <?php } ?>
            </select>
        </div>
        <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>
        <div class="col-sm-2" align="left" style="width:100px">
            <select class="selectpicker form-control" data-live-search="true" id="toage" name="toage">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'toage'])) ? (($_POST[ 'toage']==$i) ? " selected='selected' " : "") : (($ProfileInfo[ 'AgeTo']==$i) ? " selected='selected' " : "");?>>
                        <?php echo $i;?>
                    </option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Marital Status</div>
        <div class="col-sm-5" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus" name="MaritalStatus"> 
                <option value="All">All</option>
                <?php foreach($response['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo (isset($_POST[ 'MaritalStatus'])) ? (($_POST[ 'MaritalStatus']==$MaritalStatus[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MaritalStatusCode']==$MaritalStatus[ 'SoftCode']) ? " selected='selected' " : "");?>>
                        <?php echo $MaritalStatus['CodeValue'];?>   
                    </option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Religion</div>
        <div class="col-sm-5" align="left">
            <select class="selectpicker form-control" data-live-search="true" id="Religion" name="Religion">
                <option value="All">All</option>
                <?php foreach($response['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>"<?php echo (isset($_POST[ 'Religion'])) ? (($_POST[ 'Religion']==$Religion[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Religion']==$Religion[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Religion['CodeValue'];?>
                    </option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Caste<span id="star">*</span></div>
        <div class="col-sm-5">
            <select class="selectpicker form-control" data-live-search="true" id="Caste" name="Caste">
                <option value="0">Choose Caste</option>
                <?php foreach($response['data']['Caste'] as $Caste) { ?>
                    <option value="<?php echo $Caste['SoftCode'];?>" <?php echo (isset($_POST[ 'Caste'])) ? (($_POST[ 'Caste']==$Caste[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Caste']==$Caste[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Caste['CodeValue'];?>
                    </option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Education<span id="star">*</span></div>
        <div class="col-sm-5">
            <select class="selectpicker form-control" data-live-search="true" id="Education" name="Education">
                <option value="0">Choose Education</option>
                <?php foreach($response['data']['Education'] as $Education) { ?>
                    <option value="<?php echo $Education['SoftCode'];?>" <?php echo (isset($_POST[ 'Education'])) ? (($_POST[ 'Education']==$Education[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Education']==$Education[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $Education['CodeValue'];?>
                            <?php } ?>
                    </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Annual Income<span id="star">*</span></div>
        <div class="col-sm-5">
            <select class="selectpicker form-control" data-live-search="true" id="IncomeRange" name="IncomeRange">
                <option value="0">Choose IncomeRange</option>
                <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo (isset($_POST[ 'IncomeRange'])) ? (($_POST[ 'IncomeRange']==$IncomeRange[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'AnnualIncome']==$IncomeRange[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $IncomeRange['CodeValue'];?>
                            <?php } ?>
                    </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Employed As<span id="star">*</span></div>
        <div class="col-sm-5">
            <select class="selectpicker form-control" data-live-search="true" id="EmployedAs" name="EmployedAs">
                <option value="0">Choose Employed As</option>
                <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo (isset($_POST[ 'EmployedAs'])) ? (($_POST[ 'EmployedAs']==$EmployedAs[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'EmployedAs']==$EmployedAs[ 'CodeValue']) ? " selected='selected' " : "");?>>
                        <?php echo $EmployedAs['CodeValue'];?>
                            <?php } ?>
                    </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3" align="left">Details<span id="star">*</span></div>
        <div class="col-sm-5"><textarea class="form-control" cols="3" rows="2" name="Details" id="Details"><?php echo $ProfileInfo['Details'];?></textarea>
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
    </div>
    </form>
</div> 
<?php include_once("settings_footer.php");?>                      