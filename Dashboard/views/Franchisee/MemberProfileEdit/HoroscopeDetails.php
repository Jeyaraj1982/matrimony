<?php
    $page="HoroscopeDetails";

    if (isset($_POST['BtnSaveProfile'])) {
        $response = $webservice->getData("Franchisee","EditDraftHoroscopeDetails",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileID"=>$_GET['Code']));
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
                            <option value="<?php echo $StarName['SoftCode'];?>" <?php echo (isset($_POST['StarName'])) ? (($_POST[ 'StarName']==$StarName[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo['StarName']==$StarName['CodeValue']) ? " selected='selected' " : "");?>>
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
                                        <option value="<?php echo $RasiName['SoftCode'];?>" <?php echo (isset($_POST[ 'RasiName'])) ? (($_POST[ 'RasiName']==$RasiName[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo['RasiName']==$RasiName[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $RasiName['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
                            <label for="Caste" class="col-sm-2 col-form-label">Lakanam<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Lakanam" name="Lakanam">
                                    <?php foreach($response['data']['Lakanam'] as $Lakanam) { ?>
                                        <option value="<?php echo $Lakanam['SoftCode'];?>" <?php echo (isset($_POST[ 'Lakanam'])) ? (($_POST[ 'Lakanam']==$Lakanam[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo['Lakanam']==$Lakanam[ 'CodeValue']) ? " selected='selected' " : "");?>>
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
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RA1"><?php echo (isset($_POST['RA1']) ? $_POST['RA1'] : $ProfileInfo['R1']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RA2"><?php echo (isset($_POST['RA2']) ? $_POST['RA2'] : $ProfileInfo['R2']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RA3"><?php echo (isset($_POST['RA3']) ? $_POST['RA3'] : $ProfileInfo['R3']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RA4"><?php echo (isset($_POST['RA4']) ? $_POST['RA4'] : $ProfileInfo['R4']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RB1"><?php echo (isset($_POST['RB1']) ? $_POST['RB1'] : $ProfileInfo['R5']);?></textarea></td>
                                    <td colspan="2" rowspan="2">Rasi</td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RB4"><?php echo (isset($_POST['RB4']) ? $_POST['RB4'] : $ProfileInfo['R8']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RC1"><?php echo (isset($_POST['RC1']) ? $_POST['RC1'] : $ProfileInfo['R9']);?></textarea></td>
                                    <td ><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RC4"><?php echo (isset($_POST['RC4']) ? $_POST['RC4'] : $ProfileInfo['R12']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RD1"><?php echo (isset($_POST['RD1']) ? $_POST['RD1'] : $ProfileInfo['R13']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RD2"><?php echo (isset($_POST['RD2']) ? $_POST['RD2'] : $ProfileInfo['R14']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RD3"><?php echo (isset($_POST['RD3']) ? $_POST['RD3'] : $ProfileInfo['R15']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="RD4"><?php echo (isset($_POST['RD4']) ? $_POST['RD4'] : $ProfileInfo['R16']);?></textarea></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A1"><?php echo (isset($_POST['A1']) ? $_POST['A1'] : $ProfileInfo['A1']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A2"><?php echo (isset($_POST['A2']) ? $_POST['A2'] : $ProfileInfo['A2']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A3"><?php echo (isset($_POST['A3']) ? $_POST['A3'] : $ProfileInfo['A3']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A4"><?php echo (isset($_POST['A4']) ? $_POST['A4'] : $ProfileInfo['A4']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A5"><?php echo (isset($_POST['A5']) ? $_POST['A5'] : $ProfileInfo['A5']);?></textarea></td>
                                    <td colspan="2" rowspan="2">Amsam</td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A8"><?php echo (isset($_POST['A8']) ? $_POST['A8'] : $ProfileInfo['A8']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A9"><?php echo (isset($_POST['A9']) ? $_POST['A9'] : $ProfileInfo['A9']);?></textarea></td>
                                    <td ><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A12"><?php echo (isset($_POST['A12']) ? $_POST['A12'] : $ProfileInfo['A12']);?></textarea></td>
                                  </tr>
                                  <tr>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A13"><?php echo (isset($_POST['A13']) ? $_POST['A13'] : $ProfileInfo['A13']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A14"><?php echo (isset($_POST['A14']) ? $_POST['A14'] : $ProfileInfo['A14']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A15"><?php echo (isset($_POST['A15']) ? $_POST['A15'] : $ProfileInfo['A15']);?></textarea></td>
                                    <td><textarea cols="1" rows="2" style="width: 100%;height: 100%;" name="A16"><?php echo (isset($_POST['A16']) ? $_POST['A16'] : $ProfileInfo['A16']);?></textarea></td>
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