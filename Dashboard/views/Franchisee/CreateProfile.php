
<?php
    $response = $webservice->getData("Franchisee","GetMemberProfile",array("ProfileFrom"=>"All"));
    if (sizeof($response['data'])==0) {
        if (isset($_POST['ProfileFor'])) {   
            $response = $webservice->getData("Franchisee","CreateProfile",$_POST);
            if ($response['status']=="success") {
              echo "<script>location.href='MemberProfileEdit/GeneralInformation/".$response['data']['Code'].".htm?msg=1';</script>";
            } else {
                $errormessage = $response['message']; 
            }
        }
        $fInfo = $webservice->getData("Franchisee","GetCodeMasterDatas"); 
?>
<script>
    $(document).ready(function () {
        $("#ProfileName").keyup(function () {
            IsNonEmpty("ProfileName","ErrProfileName","Please enter your profile name");
        });
        $('#ProfileName').keydown(function (e) {
            //e.shiftKey
            if (e.ctrlKey || e.altKey) {
                $('#ErrProfileName').html("Special characters not allowed. only allow alphabets and space");
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                    $('#ErrProfileName').html("Special characters not allowed. only allow alphabets and space");
                    e.preventDefault();
                }
            }
        });
        $("#check").click(function () {
            if ($(this).is(":checked")) {
                $("#Errcheck").html("");
            } else {
                $("#Errcheck").html("Please accept");;
            }
        });
    });
    
    function submitprofile() {
        
        $('#ErrProfileFor').html("");
        $('#ErrProfileName').html("");
        $('#ErrDateofBirth').html("");
        $('#Errcheck').html("");
        
        ErrorCount=0;
        
        if($("#ProfileFor").val()=="0"){
            document.getElementById("ErrProfileFor").innerHTML="Please select profile for"; 
            ErrorCount++;
        }
        
        if (IsNonEmpty("ProfileName","ErrProfileName","Please enter "+$('#label_profile_name').html())) {
            IsAlphabet("ProfileName","ErrProfileName","Please enter alpha numeric characters only");
        }
        
        if($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0"){
            document.getElementById("ErrDateofBirth").innerHTML="Please select date of birth"; 
            ErrorCount++;
        }
        
        if (document.form1.check.checked == false) {
            $("#Errcheck").html("Please accept");
            return false;
        }

        return (ErrorCount==0)  ? true : false;
    }
                         
    function update_label() {
        
        var t = $( "#ProfileFor option:selected" ).text();
      
        if ($("#ProfileFor").val()=="0") {
            $('#label_profile_name').html("Name<span id='star'>*</span>");
            $('#label_profile_dob').html("Date of Birth<span id='star'>*</span>");
            $('#ErrProfileFor').html("Please select profile create for");
        } else {
            if ($("#ProfileFor").val()=="PSF004") {
                $('#label_profile_name').html("Your Name<span id='star'>*</span>");    
                $('#ProfileName').attr("placeholder","Your Name");    
                $('#label_profile_dob').html("Your Date of Birth<span id='star'>*</span>"); 
            } else {
                $('#label_profile_name').html("Your "+t+"'s Name<span id='star'>*</span>");
                $('#ProfileName').attr("placeholder","Your "+t+"'s Name");                  
                $('#label_profile_dob').html(t+"'s Date of Birth<span id='star'>*</span>");    
            }
            $('#ErrProfileFor').html("");
        }
    }
    
    function DateofBirthValidation() {
        
        if ($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0") {
            $('#ErrDateofBirth').html("Please select Date of Birth");
        } else {
            $('#ErrDateofBirth').html("");
        }
    }
</script>
<style>
.errorstring{font-size:13px;}
</style>
<form method="post" action="" name="form1" id="form1" >
	<input type="hidden" value='<?php echo $_GET['Code'];?>' name="MemberCode">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
            <div style="padding:15px !important;max-width:770px !important;">
                <h4 class="card-title" style="font-size:24px;margin-bottom:8px;">Create Profile</h4>
                <div class="form-group row" style="margin-bottom:40px">
                    <div class="col-sm-12" style="color:#777">
                        You can create profile and publish to our portal with simple few steps. 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Community" class="col-sm-3 col-form-label" style="font-size:14px;">Profile create for<span id="star">*</span></label>
                    <div class="col-sm-5" style="max-width:284px !important;">
                        <select onchange="update_label()" class="selectpicker form-control" data-live-search="true" id="ProfileFor" name="ProfileFor">
                            <option value="0">Choose Profile Sign In</option>
                            <?php foreach($fInfo['data']['ProfileFor'] as $ProfileFor) { ?>
                            <?php  if($ProfileFor['CodeValue']!= "Father" && $ProfileFor['CodeValue']!= "Mother"){     ?>
                            <option value="<?php echo $ProfileFor['SoftCode'];?>" <?php echo ($_POST['ProfileFor']==$ProfileFor['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $ProfileFor['CodeValue'];?></option>
                            <?php } } ?>
                        </select>
                        <span class="errorstring" id="ErrProfileFor"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Name" class="col-sm-3 col-form-label" id="label_profile_name" style="font-size:14px;">Name<span id="star">*</span></label>
                    <div class="col-sm-9"><input type="text" class="form-control" id="ProfileName" name="ProfileName"  value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : "");?>" placeholder="Name">
                    <span class="errorstring" id="ErrProfileName"></span>
                </div>
                </div>
                <div class="form-group row">
                <label for="Name" class="col-sm-3 col-form-label" id="label_profile_dob" style="font-size:14px;">Date of birth<span id="star">*</span></label>
                <div class="col-sm-5" >
                <div class="col-sm-4" style="max-width:63px !important;padding:0px !important;">
                    <?php $dob=strtotime($ProfileInfo['DateofBirth'])  ; ?>
                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px" onchange="DateofBirthValidation()">
                        <option value="0">Day</option>
                        <?php for($i=1;$i<=31;$i++) {?>
                        <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px" onchange="DateofBirthValidation()">
                        <option value="0">Month</option>
                        <?php foreach($_Month as $key=>$value) {?>
                        <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px" onchange="DateofBirthValidation()">
                        <option value="0">Year</option>
                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                        <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>                             
                        <?php } ?>
                    </select>
                </div>
                <span class="errorstring" id="ErrDateofBirth"></span>
            </div>
            
            
            
            </div>
                <div class="form-group row"> 
                <div class="col-sm-12">
                    <div style="border:1px solid #C2BFB2;background:#fff8dd;border-radius:5px;padding:5px;color:#777;width:100%">
                        <img src="<?php echo ImageUrl;?>create_profile_notification.png" style="height:32px">
                            Given primary information won't allow you to modify in future.
                    </div>
                </div>
            </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="check" name="check">
                            <label class="custom-control-label" for="check">&nbsp;<a href="<?php echo WebConfig::SIGN_UP_TERMS_URL ?>">I agree the terms of conditions</a></label>
                    <Br><span class="errorstring" id="Errcheck"></span>
                        </div>
                    </div>
                </div>
                <?php if (isset($errormessage)) { ?>
                    <div class="form-group row">
                        <div class="col-sm-12" style="color:red"><?php echo $errormessage;?></div>
                    </div>
                <?php } ?>
                <div class="form-group row"> 
                    <div class="col-sm-3">
                        <a href="javascript:void(0)" onclick="ConfirmCreateProfile($('#ProfileFor option:selected').text(),$('#ProfileName').val(),$('#date option:selected').text(),$('#month option:selected').text(),$('#year option:selected').text())" class="btn btn-primary" style="font-family:roboto">Save &amp; Continue</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div> 
</form>
<div class="modal" id="CreateNow" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content" id="Create_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div> 
<?php } 
 if (sizeof($response['data'])>0){ 
 ?>
<div class="col-12 grid-margin">  
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile Information</h4>  
            <p class="card-description">Profile Already Created</p>
            <div class="form-group row">
                <div class="col-sm-6" style="text-align:center"><a href="ManageProfile">Manage Profile</a> </div>
            </div>
        </div>
    </div>
</div> 
<?php }?>
 
<script>
    function ConfirmCreateProfile(ProfileFor,ProfileName,Date,Month,Year){
        
        if (submitprofile()) {
            
            $('#CreateNow').modal('show'); 
            var dob_label = $('#label_profile_dob').html().substring(0,$('#label_profile_dob').html().length-24);
            var pfl_label = $('#label_profile_name').html().substring(0,$('#label_profile_name').html().length-24);
            
            var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for create profile</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>'+pfl_label+'</b><br>'+ProfileName+'</div>'
                                        + '</div>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>'+dob_label+'</b><br>'+Month+' '+Date+', '+Year+'</div>'
                                        + '</div>'                                                     
                                    + '</div>'
                                +  '</div>'                    
                            + '</div>' 
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPasswordCreatProfile()" style="font-family:roboto">Create Profile</button>'
                            + '</div>';                                                                                               
            $('#Create_body').html(content);
        } else {
            return false;
        }
    }
    
    function GetTxnPasswordCreatProfile () {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create profile</h4>'
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
                            + '<button type="button" onclick="CreateProfile()" class="btn btn-primary" >Create Profile</button>'
                        + '</div>';
        $('#Create_body').html(content);            
    }
    
    function CreateProfile() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $( "#form1").serialize();   
        $('#Create_body').html(preloading_withText("Creating profile ...","95"));
        $.post(API_URL + "m=Franchisee&a=CreateProfile",param,function(result2) {
            var obj = JSON.parse(result2);
            if (obj.status=="success") {
                    var data = obj.data;                                             
                    var content = '<div class="modal-body" style="text-align:center">'
                                    + '<br><img src="<?php echo ImageUrl;?>icons/new_profile_created.png" width="100px">' 
                                    + '<br><br>'
                                    + '<span style="font=size:18px;">'+obj.message+'</span><br>Your Draft Profile ID: ' + data.Code
                                    + '<br><br>'
                                    + '<a href="'+AppUrl+'Member/'+data.MCode+'/ProfileEdit/GeneralInformation/'+data.Code+'.htm?msg=1" class="btn btn-primary" style="font-family:roboto">Continue</a>'
                                  + '</div>' 
                    $('#Create_body').html(content);  
            } else {
                var data = obj.data; 
                var content = '<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Profile</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>';
            $('#Create_body').html(content);
            }
        });
    }
</script>