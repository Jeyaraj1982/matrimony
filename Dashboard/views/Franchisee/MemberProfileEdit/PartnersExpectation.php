<?php
    $page="PartnersExpectation";
    include_once("settings_header.php");
      $response = $webservice->getData("Franchisee","GetPartnersExpectaionInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
?>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<link href='<?php echo SiteUrl?>assets/css/BsMultiSelect.css' rel='stylesheet' type='text/css'>
<script src="<?php echo SiteUrl?>assets/js/BsMultiSelect.js" type='text/javascript'></script>
<style>
.c-menu {height:200px;overflow:auto;width:200px;}
.badge {padding: 0px 10px !important;background: #f1f1f1 !important;border: 1px solid #ccc !important;color: #888 !important;margin-right:5px;margin-top:2px;margin-bottom:2px;}
.badge:hover {padding: 0px 10px !important;background: #e5e5e5 !important;border: 1px solid #ccc !important;color: #888 !important;}
.badge .close {margin-left:8px;}
</style>
<div class="col-sm-10 rightwidget">
<script>
function submitexpectation() {
       $('#Errage').html("");
       $('#Errtoage').html("");
       $('#ErrMaritalStatus').html("");
       $('#ErrReligion').html("");
       $('#ErrCaste').html("");
       $('#ErrEducation').html("");
       $('#ErrEmployedAs').html("");
       $('#ErrIncomeRange').html("");
       $('#ErrRasiName').html("");
       $('#ErrStarName').html("");
       $('#ErrChevvaiDhosham').html("");
       
        ErrorCount=0;
        
   //    if(($("#age").val() > $("#toage").val())){
             //   ErrorCount++;
             //   document.getElementById("Errtoage").innerHTML="Please select greater than from age"; 
         //   }

           if ($("#_MaritalStatus :selected").length==0) {
            document.getElementById("ErrMaritalStatus").innerHTML="Please select marital status"; 
            ErrorCount++;
           } else {
                var selected=[];
                $('#_MaritalStatus :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#MaritalStatus').val(selected.join(","));
           }
           
           
           if ($("#_Religion :selected").length==0) {
                            document.getElementById("ErrReligion").innerHTML="Please select religion"; 
                             ErrorCount++;
           } else {
                var selected=[];
                $('#_Religion :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#Religion').val(selected.join(","));
           }
           
           if ($("#_Caste :selected").length==0) {
                            document.getElementById("ErrCaste").innerHTML="Please select caste"; 
                             ErrorCount++;
           } else {
                var selected=[];
                $('#_Caste :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#Caste').val(selected.join(","));
           }
           
           if ($("#_Education :selected").length==0) {
                            document.getElementById("ErrEducation").innerHTML="Please select education"; 
                             ErrorCount++;
           }  else {
                var selected=[];
                $('#_Education :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#Education').val(selected.join(","));
           }
           
           if ($("#_EmployedAs :selected").length==0) {
                            document.getElementById("ErrEmployedAs").innerHTML="Please select employed as"; 
                             ErrorCount++;
           }  else {
                var selected=[];
                $('#_EmployedAs :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#EmployedAs').val(selected.join(","));
           }
           if ($("#_IncomeRange :selected").length==0) {
                            document.getElementById("ErrIncomeRange").innerHTML="Please select annual income"; 
                             ErrorCount++;
           }  else {
                var selected=[];
                $('#_IncomeRange :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#IncomeRange').val(selected.join(","));
           }
           if ($("#_RasiName :selected").length==0) {
                            document.getElementById("ErrRasiName").innerHTML="Please select rasi name"; 
                             ErrorCount++;
           } else {
                var selected=[];
                $('#_RasiName :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#RasiName').val(selected.join(","));
           }
           if ($("#_StarName :selected").length==0) {
                            document.getElementById("ErrStarName").innerHTML="Please select star name"; 
                             ErrorCount++;
           } else {
                var selected=[];
                $('#_StarName :selected').each(function(){
                    //selected[$(this).val()]=$(this).text();
                    selected.push($(this).val());
                });
                $('#StarName').val(selected.join(","));
           }
          
           if($("#ChevvaiDhosham").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrChevvaiDhosham").innerHTML="Please select chevvai dhosham"; 
            }
        
        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
    
}
</script>

    <form method="post" action=""  id="frmPE" name="frmPE">
    <input type="hidden" value="" name="MaritalStatus" id="MaritalStatus">
    <input type="hidden" value="" name="Religion" id="Religion">
    <input type="hidden" value="" name="Caste" id="Caste">
    <input type="hidden" value="" name="Education" id="Education">
    <input type="hidden" value="" name="EmployedAs" id="EmployedAs">
    <input type="hidden" value="" name="IncomeRange" id="IncomeRange">
    <input type="hidden" value="" name="RasiName" id="RasiName">
    <input type="hidden" value="" name="StarName" id="StarName">
    
            <input type="hidden" value="" name="txnPassword" id="txnPassword">
            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="Code" id="Code">
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
            <div class="col-sm-3" align="left" style="width:100px">
                <select class="form-control" data-live-search="true" id="toage" name="toage" style="width:100px">
                    <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'toage'])) ? (($_POST[ 'toage']==$i) ? " selected='selected' " : "") : (($ProfileInfo[ 'AgeTo']==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                    <?php } ?>
                </select>
                <span class="errorstring" id="Errtoage"><?php echo isset($Errtoage)? $Errtoage : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="MaritalStatus" class="col-sm-2 col-form-label">Marital status<span id="star">*</span></label>
            <div class="col-sm-10" align="left">
                <?php $sel_maritalstatus = isset($_POST['MaritalStatus']) ? explode(",",$_POST['MaritalStatus']) : explode(",",$ProfileInfo[ 'MaritalStatusCode']); ?>
                <select class="form-control" id="_MaritalStatus" style="display: none;" multiple="multiple"> 
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
                <span class="errorstring" id="ErrMaritalStatus"><?php echo isset($ErrMaritalStatus)? $ErrMaritalStatus : "";?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Religion" class="col-sm-2 col-form-label">Religion<span id="star">*</span></label>
            <div class="col-sm-10" align="left">
                <?php $sel_religionnames = isset($_POST['Religion']) ? explode(",",$_POST['Religion']) : explode(",",$ProfileInfo[ 'ReligionCode']); ?>
                <select class="form-control"  id="_Religion" style="display:none;" multiple="multiple">
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
                     <?php  if($Religion['SoftCode']!= "RN009" && $Religion['SoftCode']!= "RN010"){     ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo $selected; ?>  ><?php echo $Religion['CodeValue'];?></option>
                    <?php } } ?>
                </select>
                <span class="errorstring" id="ErrReligion"></span>
                
            </div>
        </div>
        <div class="form-group row">
            <label for="Caste" class="col-sm-2 col-form-label">Caste<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_castename = isset($_POST['Caste']) ? explode(",",$_POST['Caste']) : explode(",",$ProfileInfo[ 'CasteCode']); ?>
                <select class="form-control" id="_Caste" multiple="multiple" style="display: none;">
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
                    <?php  if($Caste['SoftCode']!= "CSTN248"){     ?>
                    <option value="<?php echo $Caste['SoftCode'];?>"  <?php echo $selected; ?>   ><?php echo $Caste['CodeValue'];?></option>
                    <?php } } ?>
                </select>
                <span class="errorstring" id="ErrCaste"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Education" class="col-sm-2 col-form-label">Education<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php 
                
                
                
                $sel_educations = isset($_POST['Education']) ? explode(",",$_POST['Education']) : explode(",",$ProfileInfo['EducationCode']); 
              
                ?>
                <select class="form-control" id="_Education"  multiple="multiple" style="display: none;">
                    <?php foreach($response['data']['Education'] as $Education) { ?>
                    <?php
                        $selected = "";
                      
                            if (in_array($Education['SoftCode'], $sel_educations))  {
                                 $selected = " selected='selected' ";
                            } 
                        
                    ?>
                    <option value="<?php echo $Education['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $Education['CodeValue'];?>
                    
                    <?php } ?></option>
                </select>
                <span class="errorstring" id="ErrEducation"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="EmployedAs" class="col-sm-2 col-form-label">Employed as<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_employeedas = isset($_POST['EmployedAs']) ? explode(",",$_POST['EmployedAs']) : explode(",",$ProfileInfo['EmployedAsCode']); ?>
                <select  id="_EmployedAs"  multiple="multiple" style="display: none;">
                    <?php foreach($response['data']['EmployedAs'] as $EmployedAs) { ?>
                    <?php
                        $selected = "";
                        
                            if (in_array($EmployedAs['SoftCode'], $sel_employeedas))  {
                                 $selected = " selected='selected' ";
                            } 
                         
                    ?>
                    <?php  if($EmployedAs['SoftCode']!= "OT112"){     ?>
                    <option value="<?php echo $EmployedAs['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $EmployedAs['CodeValue'];?></option>
                    <?php } } ?>
                </select>
                <span class="errorstring" id="ErrEmployedAs"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="IncomeRange" class="col-sm-2 col-form-label">Annual income<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_incomeranges = isset($_POST['IncomeRange']) ? explode(",",$_POST['IncomeRange']) : explode(",",$ProfileInfo[ 'AnnualIncomeCode']); ?>
                <select class="form-control" id="_IncomeRange" multiple="multiple"  style="display: none;">
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
                <span class="errorstring" id="ErrIncomeRange"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="RasiName" class="col-sm-2 col-form-label">Rasi name<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_rasinames = isset($_POST['RasiName']) ? explode(",",$_POST['RasiName']) : explode(",",$ProfileInfo[ 'RasiNameCode']); 
                ?>
                <select class="form-control" id="_RasiName" multiple="multiple"  style="display: none;">
                    <?php foreach($response['data']['RasiName'] as $RasiName) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['RasiName'])) {
                            if (in_array($RasiName['SoftCode'], $sel_rasinames)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($RasiName['SoftCode'], $sel_rasinames))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <?php  if($RasiName['SoftCode']!= "MS012"){     ?>
                        <option value="<?php echo $RasiName['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $RasiName['CodeValue'];?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrRasiName"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="StarName" class="col-sm-2 col-form-label">Star name<span id="star">*</span></label>
            <div class="col-sm-10">
                <?php $sel_starnames = isset($_POST['StarName']) ? explode(",",$_POST['StarName']) : explode(",",$ProfileInfo[ 'StarNameCode']); ?>
                <select class="form-control" id="_StarName"   multiple="multiple"  style="display: none;">
                    <?php foreach($response['data']['StarName'] as $StarName) { ?>
                    <?php
                        $selected = "";
                        if (isset($_POST['StarName'])) {
                            if (in_array($StarName['SoftCode'], $sel_starnames)) {
                                $selected = " selected='selected' ";
                            }
                        } else {
                            if (in_array($StarName['SoftCode'], $sel_starnames))  {
                                 $selected = " selected='selected' ";
                            } 
                        }
                    ?>
                    <?php  if($StarName['SoftCode']!= "STRN007"){     ?>
                    <option value="<?php echo $StarName['SoftCode'];?>" <?php echo $selected; ?> ><?php echo $StarName['CodeValue'];?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
                <span class="errorstring" id="ErrStarName"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Caste" class="col-sm-2 col-form-label" style="padding-right:0px">Chevvai dhosham<span id="star">*</span></label>
            <div class="col-sm-4">
                <select class="form-control" data-live-search="true" id="ChevvaiDhosham" name="ChevvaiDhosham">
                <option value="0">Choose</option>
                    <?php foreach($response['data']['ChevvaiDhosham'] as $ChevvaiDhosham) { ?>
                    <?php  if($ChevvaiDhosham['SoftCode']!= "CD003"){     ?>
                        <option value="<?php echo $ChevvaiDhosham['SoftCode'];?>" <?php echo (isset($_POST[ 'ChevvaiDhosham'])) ? (($_POST[ 'ChevvaiDhosham']==$ChevvaiDhosham[ 'SoftCode']) ? " selected='selected' " : "") : (($ProfileInfo['ChevvaiDhosham']==$ChevvaiDhosham[ 'CodeValue']) ? " selected='selected' " : "");?>>
                            <?php echo $ChevvaiDhosham['CodeValue'];?> </option>
                                <?php } } ?>
                </select>
                <span class="errorstring" id="ErrChevvaiDhosham"></span>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom: 0px;">
            <label for="Details" class="col-sm-12 col-form-label">Additional information</label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                 <textarea class="form-control" maxlength="250" name="Details" id="Details" style="margin-bottom:5px;height:75px"><?php echo (isset($_POST['Details']) ? $_POST['Details'] : $ProfileInfo['Details']);?></textarea>
                 <label class="col-form-label" style="padding-top:0px;">Max 250 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></label>
            </div>
        </div>
       <div class="form-group row" style="margin-bottom:0px;">
            <div class="col-sm-6">
                <a href="javascript:void(0)" onclick="ConfirmUpdatePEInfo()" name="BtnSaveProfile" class="btn btn-primary mr-2" style="font-family:roboto">Save</a>
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
     <div class="modal" id="PubplishNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="Publish_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>
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
    
        $("#_IncomeRange").dashboardCodeBsMultiSelect();
        $("#_Caste").dashboardCodeBsMultiSelect();
        $("#_EmployedAs").dashboardCodeBsMultiSelect();
        $("#_Education").dashboardCodeBsMultiSelect();
        $("#_Religion").dashboardCodeBsMultiSelect();
        $("#_MaritalStatus").dashboardCodeBsMultiSelect();
        $("#_RasiName").dashboardCodeBsMultiSelect();
        $("#_StarName").dashboardCodeBsMultiSelect();   
        
function ConfirmUpdatePEInfo() {
    if(submitexpectation()) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit partners expectation</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit partners expectation</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="GetTxnPswd()" style="font-family:roboto">Update</button>'
                    + '</div>';
            $('#Publish_body').html(content);
      } else {
         return false;
    }
}
function GetTxnPswd() {
            var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit partners expectation</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                        + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                      + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="EditDraftPartnersExpectation()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);             
}
function EditDraftPartnersExpectation() {
    if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmPE").serialize();
    $('#Publish_body').html(preloading_withText("Updating partners expectation ...","95"));
    
        $.post(API_URL + "m=Franchisee&a=AddPartnersExpectaion",param,function(result) {
             
             if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            
            if (obj.status == "success") {
               
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Updated</h3>'             
                                    + '<h4 style="text-align:center;">Partners Expectation</h4>'             
                                    + '<p style="text-align:center;"><a href="../HoroscopeDetails/'+data.Code+'.htm" style="cursor:pointer;color:#489bae">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Partners Expectation</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
            
        });
}        
    </script>                                                     
</div>
<?php include_once("settings_footer.php");?>                      