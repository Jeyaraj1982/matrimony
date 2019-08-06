<?php
    $page="GeneralInformation";

    if (isset($_POST['BtnSaveProfile'])) {
        $response = $webservice->getData("Franchisee","EditDraftGeneralInformation",$_POST);
                         
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
   $response = $webservice->getData("Franchisee","GetDraftProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
    <?php include_once("settings_header.php");?>
    <div class="col-sm-10" style="margin-top: -8px;width:100%;padding-left:16px">
    <form method="post" action="" onsubmit="">
        
        <input type="hidden" value="<?php echo $_GET['Code'];?>"  name="ProfileCode">
        <h4 class="card-title">General Iformation</h4>
            <div class="form-group row">
                <label for="Community" class="col-sm-2 col-form-label">Profile For<span id="star">*</span></label>
                <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="ProfileFor" name="ProfileFor">
                                    <option>Choose Profile Sign In</option>
                                    <?php foreach($response['data']['ProfileSignInFor'] as $ProfileFor) { ?>
                                        <option value="<?php echo $ProfileFor['CodeValue'];?>" <?php echo (isset($_POST[ 'ProfileFor'])) ? (($_POST[ 'ProfileFor']==$ProfileFor[ 'CodeValue']) ? " selected='selected' " : "") : (($ProfileInfo[ 'ProfileFor']==$ProfileFor[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $ProfileFor['CodeValue'];?>  </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ProfileName" name="ProfileName" value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : $ProfileInfo['ProfileName']);?>" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <?php

                          if (isset($_POST['DateofBirth'])) {
                            $dob=$_POST['DateofBirth']  ;
                          } else {
                              $dob=strtotime($ProfileInfo['DateofBirth'])  ;  
                               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
                          } 

                          ?>
                                    <input type="date" class="form-control" id="DateofBirth" name="DateofBirth" style="line-height:15px !important" value="<?php echo $dob;?>">
                                    <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth: "";?></span>
                            </div>
                           <!-- <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <?php// if(isset($_POST['ProfileFor']) == 'PSF001' || ($_POST['ProfileFor']=='PSF003') || ($_POST['ProfileFor']=='PSF005')) { ?>
                                <input type="text" name="Sex" class="form-control" id="Sex" value="Male">
                                <?php //} else// { ?><input type="text" name="Sex" class="form-control" id="Sex" value="Female"> <?php // }?> 
                            </div> -->
                            <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                                    <option>Choose Sex</option>
                                    <?php foreach($response['data']['Gender'] as $Sex) { ?>
                                        <option value="<?php echo $Sex['SoftCode'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Sex['CodeValue'];?>
                                                <?php } ?>       </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital Status<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="MaritalStatus" name="MaritalStatus" onchange="getHowmanyChildrenInfo())">
                                    <option>Choose Marital Status</option>
                                    <?php foreach($response['data']['MaritalStatus'] as $MaritalStatus) { ?>
                                        <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo (isset($_POST[ 'MaritalStatus'])) ? (($_POST[ 'MaritalStatus']==$MaritalStatus[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MaritalStatus']==$MaritalStatus[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $MaritalStatus['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
                            <label for="Caste" class="col-sm-2 col-form-label">Mother Tongue<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Language" name="Language" >
                                    <option>Choose Mother Tongue</option>
                                    <?php foreach($response['data']['Language'] as $Language) { ?>
                                        <option value="<?php echo $Language['SoftCode'];?>" <?php echo (isset($_POST[ 'Language'])) ? (($_POST[ 'Language']==$Language[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'MotherTongue']==$Language[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Language['CodeValue'];?> </option>
                                                <?php } ?>
                                </select>
                            </div>
                        </div>
                                         <script>
        function getHowmanyChildrenInfo() {
            
            if ($('#MaritalStatus').val()=="MST002")  {
                   $('#HowManyChildren').attr("disabled", "disabled");
                   $('#howmanychildren').html('How Many Children');
                  // $('#ChildrenWithYou').attr("disabled", "disabled");
                  // $('#IsChildrenWithYou').html('Is Children With You?');
            }else {
                   $('#HowManyChildren').removeAttr("disabled");
                   $('#howmanychildren').html('How Many Children<span id="star">*</span>');
                 //  $('#ChildrenWithYou').removeAttr("disabled");
                  // $('#IsChildrenWithYou').html('Is Children WithYou?<span id="star">*</span>');
            }
        }
        
        setTimeout(function(){
            getHowmanyChildrenInfo()
        },1000);
        
</script>  
                        <div class="form-group row">
                            <label for="HowManyChildren" class="col-sm-2 col-form-label" id="howmanychildren"></label>
                            <div class="col-sm-3" id="childrencount_input">
                                    <select class="selectpicker form-control" data-live-search="true" id="HowManyChildren" name="HowManyChildren">
                                    <option>Choose How Many Children</option>
                                    <?php foreach($response['data']['NumberofBrother'] as $HowManyChildren) { ?>
                                        <option value="<?php echo $HowManyChildren['SoftCode'];?>" <?php echo (isset($_POST[ 'HowManyChildren'])) ? (($_POST[ 'HowManyChildren']==$HowManyChildren[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'HowManyChildren']==$HowManyChildren[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $HowManyChildren['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
        
                            <label for="Description" class="col-sm-3 col-form-label" id="IsChildrenWithYou"></label>
                            <div class="col-sm-3" id="Childrenwithyou_input">
                                <select class="selectpicker form-control" data-live-search="true" id="ChildrenWithYou" name="ChildrenWithYou">
                                    <option>Choose Children With You</option>
                                    <option value="1" <?php echo ($ProfileInfo['ChildrenWithYou']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($ProfileInfo['ChildrenWithYou']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                            </div>
                        </div>
                        <script>
                            function getAdditionalInfo(selVal) {
                                if(selVal== 'MST002') {
                                   $('#AdditionalInfo').hide(); 
                                }else {
                                   $('#AdditionalInfo').show();   
                                }
                            
                               // alert (selVal);
                                
                            }
                        </script>
                        <div class="form-group row">
                            <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Religion" name="Religion">
                                    <option>Choose Religion</option>
                                    <?php foreach($response['data']['Religion'] as $Religion) { ?>
                                        <option value="<?php echo $Religion['SoftCode'];?>" <?php echo (isset($_POST[ 'Religion'])) ? (($_POST[ 'Religion']==$Religion[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Religion']==$Religion[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Religion['CodeValue'];?>  </option>
                                                <?php } ?>
                                </select>
                            </div>
                            <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Caste" name="Caste">
                                    <option value="0">Choose Caste</option>
                                    <?php foreach($response['data']['Caste'] as $Caste) { ?>
                                        <option value="<?php echo $Caste['SoftCode'];?>" <?php echo (isset($_POST[ 'Caste'])) ? (($_POST[ 'Caste']==$Caste[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Caste']==$Caste[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Caste['CodeValue'];?> </option>
                                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Community" class="col-sm-2 col-form-label">Community<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Community" name="Community">
                                    <option>Choose Community</option>
                                    <?php foreach($response['data']['Community'] as $Community) { ?>
                                        <option value="<?php echo $Community['SoftCode'];?>" <?php echo (isset($_POST[ 'Community'])) ? (($_POST[ 'Community']==$Community[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Community']==$Community[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Community['CodeValue'];?>  </option>
                                                <?php } ?>
                                </select>
                            </div>
                            <label for="Nationality" class="col-sm-2 col-form-label">Nationality<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="selectpicker form-control" data-live-search="true" id="Nationality" name="Nationality">
                                    <option>Choose Nationality</option>
                                    <?php foreach($response['data']['Nationality'] as $Nationality) { ?>
                                        <option value="<?php echo $Nationality['SoftCode'];?>" <?php echo (isset($_POST[ 'Nationality'])) ? (($_POST[ 'Nationality']==$Nationality[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo[ 'Nationality']==$Nationality[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                            <?php echo $Nationality['CodeValue'];?></option>
                                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="AboutMe" class="col-sm-2 col-form-label">About Me<span id="star">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="AboutMe" id="AboutMe"><?php echo $ProfileInfo['AboutMe'];?></textarea>
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
                        </div>
</form>
</div>
<?php include_once("settings_footer.php");?>                    