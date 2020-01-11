<?php                   
  if (isset($_POST['BtnMember'])) {         
    $response = $webservice->getData("Franchisee","CreateMember",$_POST);
    if ($response['status']=="success") {
        ?>
        <script>location.href='<?php echo AppUrl;?>Members/Created/<?php echo $response['data']['MemberCode'].".htm";?>';</script>
        <?php
    } else {
        $errormessage = $response['message']; 
    }
    }
    $response = $webservice->getData("Franchisee","GetCountryCode");
    $CountryCodes=$response['data']['CountryCode'];
?>  
<script>
ErrorCount=0
$(document).ready(function () {
   $("#WhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWhatsappNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#MemberName").blur(function () {
    
        IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name");
                        
   });
   /*$("#MemberCode").blur(function () {
    
        IsNonEmpty("MemberCode","ErrMemberCode","Please Enter Member Code");
                        
   });*/
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });                                                                                                                                 
   $("#WhatsappNumber").blur(function () {
    
    //    IsNonEmpty("WhatsappNumber","ErrWhatsappNumber","Please Enter Whatsapp Number");
        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
   });
   $("#EmailID").blur(function () {
    
        IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
                        
   }); 
   $("#LoginPassword").blur(function () {
                  
       if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
       IsPassword("LoginPassword","ErrLoginPassword","Please Enter More than 8 characters");  
                  
                        } 
   });
});

function myFunction() {
  var x = document.getElementById("LoginPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function SubmitNewMember() {
                      //   $('#ErrMemberCode').html("");
                         $('#ErrMemberName').html("");
                        // $('#ErrSex').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrLoginPassword').html("");
                         
                         ErrorCount=0;
                        
                       // if (IsNonEmpty("MemberCode","ErrMemberCode","Please Enter Member Code")) {
                        //IsAlphaNumeric("MemberCode","ErrMemberCode","Please Enter Alphabets characters only");
                       // }
                        if (IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name")) {
                        IsAlphabet("MemberName","ErrMemberName","Please Enter Alpha Numeric characters only");
                        }
                      //  IsNonEmpty("Sex","ErrSex","Please Enter Valid Sex");
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
                        }
                        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
                            IsPassword("LoginPassword","ErrLoginPassword","Please Enter More than 8 characters");  
                        }                                                                                                                                
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}                                                
</script>                                                                                                
<?php 
     $fInfo = $webservice->getData("Franchisee","GetMemberCode"); 
     $MemCode="";
        if ($fInfo['status']=="success") {
            $MemCode  =$fInfo['data']['MemberCode'];
        }
        
        {
?>
<form method="post" id="frmfrn" action="<?php $_SERVER['PHP_SELF']?>">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
        <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <div style="padding:15px !important;max-width:770px !important;">
                      <h4 class="card-title">Create Member</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Member Name" class="col-sm-3 col-form-label">Member Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" maxlength="8" disabled="disabled" id="MemberCode" name="MemberCode" value="<?php echo isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $MemCode;?>">
                            <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Member Name" class="col-sm-3 col-form-label">Member Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : "");?>" placeholder="Member Name">
                            <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-4">
                            <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                                <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                    <?php for($i=1;$i<=31;$i++) {?>
                                        <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>>
                                        <?php echo $i;?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:4px;">        
                                <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                    <?php foreach($_Month as $key=>$value) {?>
                                        <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>>
                                        <?php echo $value;?>
                                        </option>
                                    <?php } ?>
                                </select>                                    
                            </div>
                            <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                    <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                        <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                        </option>                             
                                    <?php } ?>                                  
                                </select>
                            </div>
                      </div>
                            <label for="Sex" class="col-sm-2 col-form-label">Gender<span id="star">*</span></label>
                                <div class="col-sm-3">
                                    <select class="selectpicker form-control" data-live-search="true" id="Sex"  name="Sex">
                                            <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                                            <option value="<?php echo $Sex['SofCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                          <label for="EmailID" class="col-sm-3 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>" placeholder="Email ID">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                          </div>
                        </div>
                            <div class="form-group row">
                                <label for="MobileNumber" class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                                <div class="col-sm-3">
                                    <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width:84%">
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST[ 'CountryCode']) ?  " selected='selected' " : "" ;?>> <?php echo $CountryCode['str'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" placeholder="Mobile Number">
                                    <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="WhatsappNumber" class="col-sm-3 col-form-label">Whatsapp Number</label>
                                <div class="col-sm-3">
                                    <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                            <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST[ 'WhatsappCountryCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>" placeholder="Whatsapp Number">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="LoginPassword" class="col-sm-3 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-4">
                            <input type="password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>" placeholder="Login Password">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span></div>
                            <div class="col-sm-2" style="padding-top:5px;"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
							<div class="col-sm-4" style="padding-top: 5px;">
									<div class="custom-control custom-checkbox mb-3">
										<input type="checkbox" class="custom-control-input" id="PasswordFstLogin" name="PasswordFstLogin">
										<label class="custom-control-label" for="PasswordFstLogin" style="margin-top: 7px;">&nbsp;Change password on first login</label>
									</div>
								</div>
						</div>
                          
                       <div class="form-group row">
                        <div class="col-sm-2">
                       <!-- <button type="submit" name="BtnMember" class="btn btn-primary mr-2" style="font-family:roboto">Create Member</button></div>  -->
                        <a href="javascript:void(0)" onclick="ConfirmCreateMember($('#MemberCode').val(),$('#MemberName').val(),$('#date option:selected').text(),$('#month option:selected').text(),$('#year option:selected').text(),$('#Sex option:selected').text(),$('#CountryCode option:selected').text(),$('#MobileNumber').val(),$('#WhatsappCountryCode option:selected').text(),$('#WhatsappNumber').val(),$('#EmailID').val(),$('#LoginPassword').val())" class="btn btn-primary" style="font-family:roboto">Create Member</a></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageMembers">List of Members </a></div>
                        </div> 
                        </form> 
                        <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>                  
                    </div>
                  </div>  
                  </div>                            
                </div>
</form>  <?php }?>
<div class="modal" id="CreateNow" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content" id="Create_body" style="max-width:500px;min-height:460px;max-height:460px;overflow:hidden"></div>
    </div>
</div>

<script>
    function ConfirmCreateMember(MemberCode,MemberName,Date,Month,Year,Sex,CountryCode,MobileNumber,WhatsappCountryCode,WhatsappNumber,EmailID,LoginPassword){
        
        if (SubmitNewMember()) {
            
            $('#CreateNow').modal('show'); 
           var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for create member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>Member Name</b><br>'+MemberName+'</div>'
                                        + '</div>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>Date of birth , Gender</b><br>'+Month+' '+Date+', '+Year+'&nbsp;,&nbsp;'+Sex+'</div>'
                                        + '</div>' 
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>Mobile Number</b><br>'+CountryCode+'-'+MobileNumber+'</div>'
                                        + '</div>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>Whatsapp Number</b><br>'+CountryCode+'-'+WhatsappNumber+'</div>'
                                        + '</div>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12"><b>Email ID</b><br>'+EmailID+'</div>'
                                        + '</div>'
                                    + '</div>'
                                +  '</div>'                    
                            + '</div>' 
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPassword()" style="font-family:roboto">Create Member</button>'
                            + '</div>';                                                                                                  
            $('#Create_body').html(content);
        } else {
            return false;
        }                                                                                                                                                             
    }
    function GetTxnPassword() {
        var content =     '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for create member</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                         +'<p style="text-align:center;padding: 20px;Padding-bottom:0px"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'                                 
                                   +' <h4 style="text-align:center;color:#ada9a9">Please enter transaction Password</h4>'
                        + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" onclick="CreateMember()" class="btn btn-primary" >Create Franchisee</button>'
                    + '</div>';
            $('#Create_body').html(content);            
}
    function CreateMember() {
        $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmfrn").serialize();
    $('#Create_body').html(preloading_withText("Creating Member ...","110"));
        $.post(API_URL + "m=Franchisee&a=CreateMember",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Create_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div class="modal-body" style="text-align:center;padding-top:70px">'
                                    + '<br><img src="<?php echo ImageUrl;?>icons/new_profile_created.png" width="100px">' 
                                    + '<br><br>'
                                    + '<span style="font=size:18px;">Member Created.</span><br>Your Member ID: ' + data.MemberCode
                                    + '<br><br>'
                                    + '<div class="form-group row"  style="margin-bottom:10px;">'
                                        + '<div class="col-sm-12" style="text-align:center">'
                                                + '<a href="'+AppUrl+'CreateProfile/'+data.MemberCode+'.htm?msg=1" class="btn btn-primary" style="font-family:roboto">Create Profile</a><br>'
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="form-group row">'
                                        + '<div class="col-sm-12" style="text-align:center">'
                                                + '<a href="'+AppUrl+'/Members/ManageMembers" >Go to dashboard</a>'
                                        + '</div>'
                                    + '</div>'
                                  + '</div>' 
                $('#Create_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Member</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Create_body').html(content);
            }
        });
}
        
        
        
     
 /*   function CreateMember() {
        
        var param = $( "#form1").serialize();
        $('#Create_body').html(preloader);
        $('#CreateNow').modal('show'); 
        $.post(API_URL + "m=Franchisee&a=CreateMember",param,function(result2) {$('#Create_body').html(result2);});
    }*/
    
   
</script>