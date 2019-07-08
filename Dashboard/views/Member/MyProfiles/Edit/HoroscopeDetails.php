<?php
    $page="HoroscopeDetails";

    if (isset($_POST['BtnSaveProfile'])) {
        $response = $webservice->getData("Member","EditDraftHoroscopeDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    
?>
    <?php include_once("settings_header.php");?>
    <div class="col-sm-10" style="margin-top: -8px;width:100%;padding-left:16px">
    <form method="post" action="" onsubmit="">
        <h4 class="card-title">Horoscope Details</h4>
            <div class="form-group row">
                <label for="Community" class="col-sm-2 col-form-label">Star Name<span id="star">*</span></label>
                <div class="col-sm-4">
                    <select class="selectpicker form-control" data-live-search="true" id="StarName" name="StarName">
                        <?php foreach($response['data']['StarName'] as $StarName) { ?>
                            <option value="<?php echo $StarName['SoftCode'];?>" <?php echo (isset($_POST['StarName'])) ? (($_POST[ 'StarName']==$StarName[ 'SoftCode']) ? " selected='selected' " : "") : (($StarName['StarName']==$StarName['SoftCode']) ? " selected='selected' " : "");?>>
                                <?php echo $StarName['CodeValue'];?>  </option>
                                    <?php } ?>
                    </select>
                    </div>
                        </div>
                        <div class="form-group row">
                            <label for="MaritalStatus" class="col-sm-2 col-form-label">Rasi Name<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="RasiName" name="RasiName">
                                    <?php foreach($response['data']['RasiName'] as $RasiName) { ?>
                                        <option value="<?php echo $RasiName['SoftCode'];?>" <?php echo (isset($_POST[ 'RasiName'])) ? (($_POST[ 'RasiName']==$RasiName[ 'SoftCode']) ? " selected='selected' " : "") : (($RasiName[ 'RasiName']==$RasiName[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $RasiName['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
                            <label for="Caste" class="col-sm-2 col-form-label">Lakanam<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Lakanam" name="Lakanam">
                                    <?php foreach($response['data']['Lakanam'] as $Lakanam) { ?>
                                        <option value="<?php echo $Lakanam['SoftCode'];?>" <?php echo (isset($_POST[ 'Lakanam'])) ? (($_POST[ 'Lakanam']==$Lakanam[ 'SoftCode']) ? " selected='selected' " : "") : (($Lakanam[ 'Lakanam']==$Lakanam[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Lakanam['CodeValue'];?> </option>
                                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td colspan="2" rowspan="2"></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td ><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td colspan="2" rowspan="2"></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td ><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;"></textarea></td>
                                  </tr>
                                </tbody>
                              </table>
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