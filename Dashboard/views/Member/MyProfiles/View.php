<?php
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<div class="col-12 stretch-card">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">General Iformation</h4>
            <div class="form-group row">
                <label for="Community" class="col-sm-2 col-form-label">Profile For<span id="star">*</span></label>
                <div class="col-sm-4"><?php echo $ProfileInfo[ 'ProfileFor'];?></div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                            <div class="col-sm-10"><?php echo $ProfileInfo['ProfileName'];?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['DateofBirth'];?></div>
                            <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['Sex'];?></div>
                        </div>
                        <div class="form-group row">
                            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['MaritalStatus'];?></div>
                            <label for="Caste" class="col-sm-2 col-form-label">Mother Tongue<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['MotherTongue'];?></div>
                        </div>
                        <div class="form-group row">
                            <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['Religion'];?></div>
                            <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['Caste'];?></div>
                        </div>

                        <div class="form-group row">
                            <label for="Community" class="col-sm-2 col-form-label">Community<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['Community'];?></div>
                            <label for="Nationality" class="col-sm-2 col-form-label">Nationality<span id="star">*</span></label>
                            <div class="col-sm-4"><?php echo $ProfileInfo['Nationality'];?></div>
                        </div>
                        <div class="form-group row">
                            <label for="AboutMe" class="col-sm-2 col-form-label">About Me<span id="star">*</span></label>
                            <div class="col-sm-10"><?php echo $ProfileInfo['AboutMe'];?></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-3"><a href="../ManageProfile">Manage Profile</a></div>
                            <div class="col-sm-3">
                                <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                            </div>
                        </div>
                </div>
            </div>
          </div>
<?php include_once("settings_footer.php");?>                    