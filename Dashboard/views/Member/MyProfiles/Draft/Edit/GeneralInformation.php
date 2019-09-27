<?php
    $page="GeneralInformation";

    if (isset($_POST['BtnSaveProfile'])) {
        
        $response = $webservice->EditDraftGeneralInformation($_POST);
        if ($response['status']=="success") {
            $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->GetDraftProfileInformation(array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    
?>
    <?php include_once("settings_header.php");?>
 <script>
function submitprofile() {
                         $('#ErrProfileFor').html("");
                         $('#ErrProfileName').html("");
                         $('#ErrSex').html("");
                         $('#ErrMaritalStatus').html("");
                         $('#ErrLanguage').html("");
                         $('#ErrReligion').html("");
                         $('#ErrCaste').html("");
                         $('#ErrCommunity').html("");
                         $('#ErrNationality').html(""); 
                         
                         ErrorCount=0;
                         
                         if (IsNonEmpty("ProfileName","ErrProfileName","Please enter your profile name")) {
                            IsAlphabet("ProfileName","ErrProfileName","Please enter alpha numeric characters only");
                         }
                           if($("#ProfileFor").val()=="0"){
                               ErrorCount++;
                            document.getElementById("ErrProfileFor").innerHTML="Please select profile for"; 
                         } 
                         
                         if($("#Sex").val()=="0"){
                              ErrorCount++;
                            document.getElementById("ErrSex").innerHTML="Please select sex"; 
                         }
                         
                         if($("#MaritalStatus").val()=="0"){  
                         ErrorCount++;   
                            document.getElementById("ErrMaritalStatus").innerHTML="Please select marital status";
                         }
                         
                         
                        if($("#Language").val()=="0"){
                            document.getElementById("ErrLanguage").innerHTML="Please select your maother tongue"; 
                            ErrorCount++;
                         }
                         
                         if($("#Religion").val()=="0"){
                            document.getElementById("ErrReligion").innerHTML="Please select your religion";
                            ErrorCount++;
                         }
                         
                         if($("#Caste").val()=="0"){
                            document.getElementById("ErrCaste").innerHTML="Please select your caste";
                            ErrorCount++;
                         }
                                                                                                                             
                         if($("#Community").val()=="0"){
                            document.getElementById("ErrCommunity").innerHTML="Please select your community";
                            ErrorCount++; 
                         }
                         
                         if($("#Community").val()=="0"){
                            document.getElementById("ErrCommunity").innerHTML="Please select your community";
                            ErrorCount++;
                         }
                         
                         if($("#Nationality").val()=="0"){
                            document.getElementById("ErrNationality").innerHTML="Please select your nationality";
                            ErrorCount++; 
                         }
                              
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                        
    
    
}
$(document).ready(function() {
    var text_max = 250;
    var text_length = $('#AboutMe').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');

    $('#AboutMe').keyup(function() {
        var text_length = $('#AboutMe').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
</script>    
    <div class="col-sm-10" style="margin-top: -8px;width:100%;padding-left:16px">
    <form method="post" action="" onsubmit="return submitprofile();">
        <h4 class="card-title">General Information</h4>
            <div class="form-group row">
                <label for="Community" class="col-sm-2 col-form-label">Profile Created For<span id="star">*</span></label>
                <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="ProfileFor" name="ProfileFor">
                                    <option value="0">Choose Profile Sign In</option>
                                    <?php foreach($response['data']['ProfileSignInFor'] as $ProfileFor) { ?>
                                        <option value="<?php echo $ProfileFor['CodeValue'];?>" <?php echo (isset($_POST[ 'ProfileFor'])) ? (($_POST[ 'ProfileFor']==$ProfileFor[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'ProfileFor']==$ProfileFor[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $ProfileFor['CodeValue'];?>  </option>
                                    <?php } ?>
                                </select>
                                 <span class="errorstring" id="ErrProfileFor"><?php echo isset($ErrProfileFor)? $ErrProfileFor : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ProfileName" name="ProfileName" value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : $ProfileInfo['ProfileName']);?>" placeholder="Name">
                                 <span class="errorstring" id="ErrProfileName"><?php echo isset($ErrProfileName)? $ErrProfileName : "";?></span>
                            </div>
                            </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                                <?php $dob=strtotime($ProfileInfo['DateofBirth'])  ; ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>>
                                            <?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-2">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>>
                                            <?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                           <!-- <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <?php// if(isset($_POST['ProfileFor']) == 'PSF001' || ($_POST['ProfileFor']=='PSF003') || ($_POST['ProfileFor']=='PSF005')) { ?>
                                <input type="text" name="Sex" class="form-control" id="Sex" value="Male">
                                <?php //} else// { ?><input type="text" name="Sex" class="form-control" id="Sex" value="Female"> <?php // }?> 
                            </div> -->
                            <label for="Sex" class="col-sm-2 col-form-label" style="text-align: right;">Sex<span id="star">*</span></label>
                            <div class="col-sm-3">
                                <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                                    <option value="0">Choose Sex</option>
                                    <?php foreach($response['data']['Gender'] as $Sex) { ?>
                                        <option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo trim($Sex['CodeValue']);?>
                                                <?php } ?>       </option>
                                </select>
                                 <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus" name="MaritalStatus" onchange="getHowmanyChildrenInfo()">
                                    <option value="0">Choose Marital Status</option>
                                    <?php foreach($response['data']['MaritalStatus'] as $MaritalStatus) { ?>
                                        <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo (isset($_POST[ 'MaritalStatus'])) ? (($_POST[ 'MaritalStatus']==$MaritalStatus[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MaritalStatus']==$MaritalStatus[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $MaritalStatus['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                                <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>
                            </div>
                            <label for="Caste" class="col-sm-2 col-form-label" style="text-align: right;">Mother Tongue<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Language" name="Language" >
                                    <option value="0">Choose Mother Tongue</option>
                                    <?php foreach($response['data']['Language'] as $Language) { ?>
                                        <option value="<?php echo $Language['SoftCode'];?>" <?php echo (isset($_POST[ 'Language'])) ? (($_POST[ 'Language']==$Language[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MotherTongueCode']==$Language[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $Language['CodeValue'];?> </option>
                                                <?php } ?>
                                </select>
                                <span class="errorstring" id="ErrLanguage"><?php echo isset($ErrLanguage)? $ErrLanguage : "";?></span>
                            </div>
                        </div>
                 
                        <div class="form-group row" id="mstatus_additionalinfo">
                            <label for="HowManyChildren" class="col-sm-2 col-form-label" id="howmanychildren">Children</label>
                            <div class="col-sm-4" id="childrencount_input">
                                    <select class="selectpicker form-control" data-live-search="true" id="HowManyChildren" name="HowManyChildren">
                                    <option>Choose How Many Children</option>
                                    <?php foreach($response['data']['NumberofBrother'] as $HowManyChildren) { ?>
                                        <option value="<?php echo $HowManyChildren['SoftCode'];?>" <?php echo (isset($_POST[ 'HowManyChildren'])) ? (($_POST[ 'HowManyChildren']==$HowManyChildren[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Children']==$HowManyChildren[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $HowManyChildren['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
                            
                            <label for="Description" class="col-sm-2 col-form-label" id="IsChildrenWithYou" style="text-align: right;">Is Children with you?</label>
                            <div class="col-sm-4" id="Childrenwithyou_input">
                                <select class="selectpicker form-control" data-live-search="true" id="ChildrenWithYou" name="ChildrenWithYou">
                                    <option>Choose Children With You</option>
                                    <option value="1" <?php echo (isset($_POST[ 'ChildrenWithYou'])) ? (($_POST[ 'ChildrenWithYou']==1) ? " selected='selected' " : "") : (($ProfileInfo['IsChildrenWithYou']==1)? " selected='selected' " : "");?>>Yes</option>
                                    <option value="0" <?php echo (isset($_POST[ 'ChildrenWithYou'])) ? (($_POST[ 'ChildrenWithYou']==0) ? " selected='selected' " : "") : (($ProfileInfo['IsChildrenWithYou']==0)? " selected='selected' " : "");?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Religion" name="Religion">
                                    <option value="0">Choose Religion</option>
                                    <?php foreach($response['data']['Religion'] as $Religion) { ?>
                                        <option value="<?php echo $Religion['SoftCode'];?>" <?php echo (isset($_POST[ 'Religion'])) ? (($_POST[ 'Religion']==$Religion[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Religion']==$Religion[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Religion['CodeValue'];?>  </option>
                                                <?php } ?>
                                </select>
                                <span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>
                            </div>
                            <label for="Community" class="col-sm-2 col-form-label" style="text-align: right;">Community<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Community" name="Community">
                                    <option value="0">Choose Community</option>
                                    <?php foreach($response['data']['Community'] as $Community) { ?>
                                        <option value="<?php echo $Community['SoftCode'];?>" <?php echo (isset($_POST[ 'Community'])) ? (($_POST[ 'Community']==$Community[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'CommunityCode']==$Community[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo $Community['CodeValue'];?>  </option>
                                                <?php } ?>
                                </select>
                                <span class="errorstring" id="ErrCommunity"><?php echo isset($ErrCommunity)? $ErrCommunity : "";?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
                            <div class="col-sm-4">
                                   <select class="selectpicker form-control" data-live-search="true" id="Caste" name="Caste">
                                <option  value="0">Choose Caste</option>
                                <?php foreach($response['data']['Caste'] as $Caste) { ?>
                                <option value="<?php echo $Caste['SoftCode'];?>" <?php echo (isset($_POST[ 'Caste'])) ? (($_POST[ 'Caste']==$Caste[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'CasteCode']==$Caste[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                    <?php echo trim($Caste['CodeValue']);?>
                                </option>
                                <?php } ?>
                                </select>
                                 <span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>
                            </div>
                            <label for="SubCaste" class="col-sm-2 col-form-label" style="text-align: right;">Sub Caste<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="SubCaste" id="SubCaste" value="<?php echo (isset($_POST['SubCaste']) ? $_POST['SubCaste'] : $ProfileInfo['SubCaste']);?>" placeholder="Sub Caste">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nationality" class="col-sm-2 col-form-label">Nationality<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Nationality" name="Nationality">
                                    <option value="0">Choose Nationality</option>
                                    <?php foreach($response['data']['Nationality'] as $Nationality) { ?>
                                        <option value="<?php echo $Nationality['SoftCode'];?>" <?php echo (isset($_POST[ 'Nationality'])) ? (($_POST[ 'Nationality']==$Nationality[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'NationalityCode']==$Nationality[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                            <?php echo trim($Nationality['CodeValue']);?></option>
                                                <?php } ?>
                                </select> 
                                <span class="errorstring" id="ErrNationality"><?php echo isset($ErrNationality)? $ErrNationality : "";?></span>                                                                                           
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="AboutMe" class="col-sm-2 col-form-label">About Me<span id="star">*</span></label>
                            <div class="col-sm-10">                                                        
                                <textarea class="form-control" maxlength="250" name="AboutMe" id="AboutMe"><?php echo (isset($_POST['AboutMe']) ? $_POST['AboutMe'] : $ProfileInfo['AboutMe']);?></textarea> <br>
                                <div class="col-sm-12">Max 250 Characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></div>
                            </div>
                        </div>
                        <!-- <i class="fa fa-plus"></i> -->
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12"><?php echo $errormessage ;?><?php echo $successmessage;?></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
                                <br>
                                <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
                            </div>
                            <div class="col-sm-3"><a href="../EducationDetails/<?php echo $_GET['Code'].".htm";?>">Next</a></div>
                        </div>
</form>
</div>

    <script>
        function getHowmanyChildrenInfo() {
            if ($('#MaritalStatus').val()=="MST001" || $('#MaritalStatus').val()=="0") {
                $('#mstatus_additionalinfo').hide();
            } else {
                $('#mstatus_additionalinfo').show();
            }
        }
        setTimeout(function(){getHowmanyChildrenInfo();},1000);
        
</script> 
<?php include_once("settings_footer.php");?>  

<!--<script>
                            function getAdditionalInfo(selVal) {
                                if(selVal== 'MST002') {
                                   $('#AdditionalInfo').hide(); 
                                }else {
                                   $('#AdditionalInfo').show();   
                                }
                            
                               // alert (selVal);
                                
                            }
                        </script>
                       
                       <div class="form-group row" id="AdditionalInfo" style="<?php // echo ($_POST['MaritalStatus'] == 'MST002')? "display: none;" : "";?>">
                            <label for="HowManyChildren" class="col-sm-2 col-form-label">How Many Children<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="HowManyChildren" name="HowManyChildren">
                                    <option>Choose How Many Children</option>
                                    <?php // foreach($response['data']['NumberofBrother'] as $HowManyChildren) { ?>
                                        <option value="<?php // echo $HowManyChildren['SoftCode'];?>" <?php // echo (isset($_POST[ 'HowManyChildren'])) ? (($_POST[ 'HowManyChildren']==$HowManyChildren[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'HowManyChildren']==$HowManyChildren[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php // echo $HowManyChildren['CodeValue'];?></option>
                                                <?php // } ?>
                                </select>
                            </div>                                    
                            <label for="Caste" class="col-sm-2 col-form-label">Is Children With You?<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="ChildrenWithYou" name="ChildrenWithYou">
                                    <option>Choose Children With You</option>
                                    <option value="1" <?php // echo ($ProfileInfo['ChildrenWithYou']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php // echo ($ProfileInfo['ChildrenWithYou']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                            </div>
                        </div>
                      -->                  