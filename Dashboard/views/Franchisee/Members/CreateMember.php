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

$(document).ready(function () {
  $("#AadhaarNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAadhaarNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
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
   $("#MemberCode").blur(function () {
    
        IsNonEmpty("MemberCode","ErrMemberCode","Please Enter Member Code");
                        
   });
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
                         $('#ErrSex').html("");
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
                        IsNonEmpty("Sex","ErrSex","Please Enter Valid Sex");
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
<form method="post" action="<?php $_SERVER['PHP_SELF']?>" name="form1" id="form1" onsubmit="return SubmitNewMember();">
        <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Create Member</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Member Name" class="col-sm-2 col-form-label">Member Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" maxlength="8" disabled="disabled" id="MemberCode" name="MemberCode" value="<?php echo isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $MemCode;?>">
                            <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Member Name" class="col-sm-2 col-form-label">Member Name<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : "");?>" placeholder="Member Name">
                            <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-2">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>
                                        <?php } ?>                                 
                                    </select>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                                <div class="col-sm-3">
                                    <select class="selectpicker form-control" data-live-search="true" id="Sex"  name="Sex">
                                            <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                                            <option value="<?php echo $Sex['CodeValue'];?>" <?php echo ($_POST['Sex']==$Sex['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="MobileNumber" class="col-sm-2 col-form-label">Mobile Number<span id="star">*</span></label>
                                <div class="col-sm-2" style="margin-right:-25px">
                                    <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width:84%">
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                        <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST[ 'CountryCode']) ?  " selected='selected' " : "" ;?>>
                                            <?php echo $CountryCode['str'];?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" placeholder="Mobile Number">
                                    <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="WhatsappNumber" class="col-sm-2 col-form-label">Whatsapp Number</label>
                                <div class="col-sm-2" style="margin-right:-25px">
                                    <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                                        <?php foreach($CountryCodes as $CountryCode) { ?>
                                            <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo ($_POST[ 'WhatsappCountryCode']) ? " selected='selected' " : "";?>>
                                            <?php echo $CountryCode['str'];?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : "");?>" placeholder="Whatsapp Number">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <label for="EmailID" class="col-sm-2 col-form-label">Email ID<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="type" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>" placeholder="Email ID">
                            <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                          </div>
                        </div>
                       <div class="form-group row">
                          <!--<label for="LoginName" class="col-sm-2 col-form-label">Login Name<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="LoginName" name="LoginName" value="<?php //echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : "");?>" placeholder="Login Name">
                            <span class="errorstring" id="ErrLoginName"><?php //echo isset($ErrLoginName)? $ErrLoginName : "";?></span>
                          </div> -->
                          <label for="LoginPassword" class="col-sm-2 col-form-label">Login Password<span id="star">*</span></label>
                          <div class="col-sm-3">
                            <input type="password" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>" placeholder="Login Password">
                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span></div>
                            <div class="col-sm-2" style="padding-top:5px;"><input type="checkbox" onclick="myFunction()">&nbsp;show</div>
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
</form>  <?php }?>
<div class="modal" id="CreateNow" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content" id="Create_body" style="max-width:500px;min-height:460px;max-height:460p;overflow:hidden"></div>
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
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="CreateMember()" style="font-family:roboto">Create Member</button>'
                            + '</div>';                                                                                                  
            $('#Create_body').html(content);
        } else {
            return false;
        }                                                                                                                                                             
    }
    function CreateMember() {
        
        var param = $( "#form1").serialize();   
        $('#Create_body').html(preloading_withText("Creating member ...","170"));
		$.post(API_URL + "m=Franchisee&a=CreateMember",param,function(result2) {
            var obj = JSON.parse(result2);
            if (obj.status=="success") {
                    var data = obj.data;                                             
                    var content = '<div class="modal-body" style="text-align:center;padding-top:70px">'
                                    + '<br><img src="<?php echo ImageUrl;?>icons/new_profile_created.png" width="100px">' 
                                    + '<br><br>'
                                    + '<span style="font=size:18px;">Member Created.</span><br>Your Member ID: ' + data.Code
                                    + '<br><br>'
									+ '<div class="form-group row"  style="margin-bottom:10px;">'
										+ '<div class="col-sm-12" style="text-align:center">'
												+ '<a href="'+AppUrl+'CreateProfile/'+data.Code+'.htm?msg=1" class="btn btn-primary" style="font-family:roboto">Create Profile</a><br>'
										+ '</div>'
									+ '</div>'
									+ '<div class="form-group row">'
										+ '<div class="col-sm-12" style="text-align:center">'
												+ '<a href="'+AppUrl+'" >Go to dashboard</a>'
										+ '</div>'
									+ '</div>'
                                  + '</div>' 
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