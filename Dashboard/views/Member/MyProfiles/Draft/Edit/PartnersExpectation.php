<?php
    $page="PartnersExpectation";
    if (isset($_POST['BtnSaveProfile'])) {
        
        $_POST['Code']=$_GET['Code'];
        
        $_POST['MaritalStatus']=implode(",",$_POST['MaritalStatus']);
        $_POST['Religion']=implode(",",$_POST['Religion']);
        $_POST['Caste']=implode(",",$_POST['Caste']);
        $_POST['Education']=implode(",",$_POST['Education']);
        $_POST['IncomeRange']=implode(",",$_POST['IncomeRange']);
        $_POST['EmployedAs']=implode(",",$_POST['EmployedAs']);
        
        $response = $webservice->getData("Member","AddPartnersExpectaion",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Member","GetPartnersExpectaionInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    
    include_once("settings_header.php");
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<link href='<?php echo SiteUrl?>assets/css/BsMultiSelect.css' rel='stylesheet' type='text/css'>
<script src="<?php echo SiteUrl?>assets/js/BsMultiSelect.js" type='text/javascript'></script>
<style>
.dropdown-menu {height:200px;overflow:auto;width:200px;}
.badge {padding: 0px 10px !important;background: #f1f1f1 !important;border: 1px solid #ccc !important;color: #888 !important;margin-right:5px;margin-top:2px;margin-bottom:2px;}
.badge:hover {padding: 0px 10px !important;background: #e5e5e5 !important;border: 1px solid #ccc !important;color: #888 !important;}
.badge .close {margin-left:8px;}
</style>
<div class="col-sm-10 rightwidget">
    <form method="post" action="" onsubmit="">
        <h4 class="card-title">Partner's Expectations</h4>
        <div class="form-group row">
            <label for="age" class="col-sm-2 col-form-label">Age<span id="star">*</span></label>
            <div class="col-sm-2" align="left" style="width:100px">
                <select class="form-control" data-live-search="true" id="age" name="age">
                    <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'age'])) ? (($_POST[ 'age']==$i) ? " selected='selected' " : "") : (($ProfileInfo[ 'AgeFrom']==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                    <?php } ?>
                </select>
            </div>
            <label for="toage" class="col-sm-1 col-form-label">To</label>
            <div class="col-sm-2" align="left" style="width:100px">
                <select class="form-control" data-live-search="true" id="toage" name="toage">
                    <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'toage'])) ? (($_POST[ 'toage']==$i) ? " selected='selected' " : "") : (($ProfileInfo[ 'AgeTo']==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital status<span id="star">*</span></label>
            <div class="col-sm-10" align="left">
                <?php $sel_maritalstatus = isset($_POST['MaritalStatus']) ? explode(",",$_POST['MaritalStatus']) : explode(",",$ProfileInfo[ 'MaritalStatusCode']); ?>
                <select class="form-control" id="MaritalStatus" name="MaritalStatus[]" style="display: none;" multiple="multiple"> 
                    <?php foreach($response['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['MaritalStatus'])) {
                            if (in_array($MaritalStatus['SoftCode'], $sel_maritalstatus)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($MaritalStatus['SoftCode'], $sel_maritalstatus))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo $selected; ?>  ><?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
            <div class="col-sm-10" align="left">
                <?php $sel_religionnames = isset($_POST['Religion']) ? explode(",",$_POST['Religion']) : explode(",",$ProfileInfo[ 'ReligionCode']); ?>
                <select class="form-control"  id="Religion" name="Religion[]" style="display:none;" multiple="multiple">
                    <!--<option value="All">All</option>-->
                    <?php foreach($response['data']['Religion'] as $Religion) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['Religion'])) {
                            if (in_array($Religion['SoftCode'], $sel_religionnames)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($Religion['SoftCode'], $sel_religionnames))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo $selected; ?>  ><?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_castename = isset($_POST['Caste']) ? explode(",",$_POST['Caste']) : explode(",",$ProfileInfo[ 'CasteCode']); ?>
                <select class="form-control" id="Caste" name="Caste[]" multiple="multiple" style="display: none;">
                    <!--<option value="All">All</option>-->
                    <?php foreach($response['data']['Caste'] as $Caste) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['Caste'])) {
                            if (in_array($Caste['SoftCode'], $sel_castename)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($Caste['SoftCode'], $sel_castename))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $Caste['SoftCode'];?>"  <?php echo $selected; ?>   ><?php echo $Caste['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Education" class="col-sm-2 col-form-label">Education<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_educations = isset($_POST['EmployedAs']) ? explode(",",$_POST['Education']) : explode(",",$ProfileInfo[ 'EducationCode']); ?>
                <select class="form-control" id="Education" name="Education[]" multiple="multiple" style="display: none;">
                    <?php foreach($response['data']['Education'] as $Education) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['Education'])) {
                            if (in_array($Education['SoftCode'], $sel_educations)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($Education['SoftCode'], $sel_educations))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $Education['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $Education['CodeValue'];?><?php } ?></option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="EmployedAs" class="col-sm-2 col-form-label">Employed as<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_employeedas = isset($_POST['EmployedAs']) ? explode(",",$_POST['EmployedAs']) : explode(",",$ProfileInfo[ 'EmployedAsCode']); ?>
                <select  id="EmployedAs" name="EmployedAs[]" multiple="multiple" style="display: none;">
                    <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['EmployedAs'])) {
                            if (in_array($EmployedAs['SoftCode'], $sel_employeedas)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($EmployedAs['SoftCode'], $sel_employeedas))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $EmployedAs['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="IncomeRange" class="col-sm-2 col-form-label">Annual income<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_incomeranges = isset($_POST['IncomeRange']) ? explode(",",$_POST['IncomeRange']) : explode(",",$ProfileInfo[ 'AnnualIncomeCode']); ?>
                <select class="form-control" id="IncomeRange" name="IncomeRange[]" multiple="multiple"  style="display: none;">
                    <?php foreach($response['data']['IncomeRange'] as $IncomeRange) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['IncomeRange'])) {
                            if (in_array($IncomeRange['SoftCode'], $sel_incomeranges)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($IncomeRange['SoftCode'], $sel_incomeranges))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <option value="<?php echo $IncomeRange['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $IncomeRange['CodeValue'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom: 0px;">
            <label for="Details" class="col-sm-12 col-form-label">Additional information<span id="star">*</span></label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                 <textarea class="form-control" maxlength="250" name="Details" id="Details" style="margin-bottom:5px;"><?php echo (isset($_POST['Details']) ? $_POST['Details'] : $ProfileInfo['Details']);?></textarea>
                 Max 250 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-12"><span id="server_message_error"><?php echo $errormessage ;?></span><span id="server_message_success"><?php echo $successmessage;?></span></div>
        </div>
        <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-6">
                <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
                <br>
                <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
            </div>
            <div class="col-sm-6" style="text-align:right">
                <ul class="pager" style="float:right;">
                    <li><a href="../ProfilePhoto/<?php echo $_GET['Code'].".htm";?>">&#8249; Previous</a></li>
                    <li>&nbsp;</li>
                    <li><a href="../HoroscopeDetails/<?php echo $_GET['Code'].".htm";?>">Next &#8250;</a></li>
                </ul>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            var text_max = 250;
            var text_length = $('#Details').val().length;
            $('#textarea_feedback').html(text_length + ' characters typed');
            $('#Details').keyup(function() {
                var text_length = $('#Details').val().length;
                var text_remaining = text_max - text_length;
                $('#textarea_feedback').html(text_length + ' characters typed');
            });
        });
    </script>  
    <script>
        $("#IncomeRange").dashboardCodeBsMultiSelect();
        $("#Caste").dashboardCodeBsMultiSelect();
        $("#EmployedAs").dashboardCodeBsMultiSelect();
        $("#Education").dashboardCodeBsMultiSelect();
        $("#Religion").dashboardCodeBsMultiSelect();
        $("#MaritalStatus").dashboardCodeBsMultiSelect();
    </script>                                                     
</div>
<?php include_once("settings_footer.php");?>                      