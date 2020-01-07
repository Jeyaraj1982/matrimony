<?php
         
    if (isset($_POST['Btnupdate'])) {
        $_POST['Code'] =$_GET['Code'] ; 
	
        $response = $webservice->EditMember($_POST);
        
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Franchisee","GetMemberDetails");
    $Member=$response['data'];
     $CountryCodes=$Member['Country'];
?>
<script>
    $(document).ready(function () {
        $("#MobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
                return false;
            }
        });
         $("#WhatsappNumber").keypress(function (e) {
             if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrWhatsappNumber").html("Digits Only").fadeIn().fadeIn("fast");
                       return false;
            }
           });
        $("#MemberName").blur(function () {
            IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name");
        });
        $("#MobileNumber").blur(function () {   
            IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
        });
        $("#EmailID").blur(function () {
            IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID");
        }); 
    });
    
    function SubmitNewMember() {
        $('#ErrMemberName').html("");
        $('#ErrMobileNumber').html("");
        $('#ErrWhatsappNumber').html("");
        $('#ErrEmailID').html("");
        
        ErrorCount=0;
        if (IsNonEmpty("MemberName","ErrMemberName","Please Enter Member Name")) {
            IsAlphabet("MemberName","ErrMemberName","Please Enter Alpha Numeric characters only");
        }
        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
            IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid Mobile Number");
        }
        if ($('#WhatsappNumber').val().trim().length>0) {
            IsMobileNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
        }
        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
        }
        return (ErrorCount==0) ? true : false;
    }                                                
</script>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $_GET['Code'];?>" name="SCode" id="SCode">
    <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode">

    <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                    <div style="padding:15px !important;max-width:770px !important;">
                      <h4 class="card-title">Manage My Member</h4>  
                      <h4 class="card-title">Edit Member Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Code</small> </div>
                          <div class="col-sm-3"><input type="text" disabled="disabled" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : $Member['MemberCode']);?>" placeholder="Member Code">
                          <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode : "";?></span></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name<span id="star">*</span></small> </div>
                          <div class="col-sm-9"><input type="text" class="form-control" id="MemberName" name="MemberName" value="<?php echo (isset($_POST['MemberName']) ? $_POST['MemberName'] : $Member['MemberName']);?>" placeholder="Member Name">
                          <span class="errorstring" id="ErrMemberName"><?php echo isset($ErrMemberName)? $ErrMemberName : "";?></span></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Date of birth<span id="star">*</span></small> </div>
                          <div class="col-sm-4">
                                <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                                    <?php $dob=strtotime($Member['DateofBirth'])  ; ?>
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <option value="0">Day</option>
                                        <?php for($i=1;$i<=31;$i++) {?>
                                        <option value="<?php echo $i; ?>" <?php echo (isset($_POST[ 'date'])) ? (($_POST[ 'date']==$i) ? " selected='selected' " : "") : ((date("d",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <option value="0">Month</option>
                                        <?php foreach($_Month as $key=>$value) {?>
                                        <option value="<?php echo $key+1; ?>" <?php echo (isset($_POST[ 'month'])) ? (($_POST[ 'month']==$key+1) ? " selected='selected' " : "") : ((date("m",$dob)==$key+1) ? " selected='selected' " : "");?>><?php echo $value;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <option value="0">Year</option>
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                        <option value="<?php echo $i; ?>" <?php echo (isset($_POST['year'])) ? (($_POST['year']==$i) ? " selected='selected' " : "") : ((date("Y",$dob)==$i) ? " selected='selected' " : "");?>><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>      
                                </div>
                          </div>
                          <div class="col-sm-2"><small>Gender<span id="star">*</span></small></div>
                          <div class="col-sm-3">
                                <select class="selectpicker form-control" data-live-search="true" id="Sex" name="Sex">
                                    <?php foreach($Member['Gender'] as $Sex) { ?>
                                    <option value="<?php echo $Sex['CodeValue'];?>" <?php echo (isset($_POST[ 'Sex'])) ? (($_POST[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "") : (($Member[ 'Sex']==$Sex[ 'CodeValue']) ? " selected='selected' " : "");?>><?php echo $Sex['CodeValue'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Email ID<span id="star">*</span></small></div>
                          <div class="col-sm-9"><input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Member['EmailID']);?>" placeholder="Email ID">
                          <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span></div>
                      </div>
                      <div class="form-group row">
                                <label for="MobileNumber" class="col-sm-3 col-form-label">Mobile Number<span id="star">*</span></label>
                                <div class="col-sm-3">
                                    <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="width: 61px;">
                                       <?php foreach($CountryCodes as $CountryCode) { ?>
                                      <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'CountryCode'])) ? (($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'CountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                                <?php echo $CountryCode['str'];?> </option>
                                       <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" maxlength="10" id="MobileNumber" name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Member['MobileNumber']);?>" placeholder="Mobile Number">
                                    <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="WhatsappNumber" class="col-sm-3 col-form-label">Whatsapp Number</label>
                                <div class="col-sm-3">
                                    <select name="WhatsappCountryCode" class="selectpicker form-control" data-live-search="true" id="WhatsappCountryCode"> 
                                       <?php foreach($CountryCodes as $CountryCode) { ?>
                                      <option value="<?php echo $CountryCode['ParamA'];?>" <?php echo (isset($_POST[ 'WhatsappCountryCode'])) ? (($_POST[ 'WhatsappCountryCode']==$WhatsappCountryCode[ 'ParamA']) ? " selected='selected' " : "") : (($Member[ 'WhatsappCountryCode']==$CountryCode[ 'SoftCode']) ? " selected='selected' " : "");?>>
                                                <?php echo $CountryCode['str'];?> </option>
                                       <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                            <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" value="<?php echo (isset($_POST['WhatsappNumber']) ? $_POST['WhatsappNumber'] : $Member['WhatsappNumber']);?>" placeholder="Whatsapp Number">
                            <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?></span>
                          </div>
                        </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Status<span id="star">*</span></small></div>
                          <div class="col-sm-3">
                                <select name="Status" class="form-control" >
                                    <option value="1" <?php echo ($Member['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                    <option value="0" <?php echo ($Member['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Created On</small></div>
                          <div class="col-sm-4"><small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name</small></div>
                          <div class="col-sm-9"><span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)</small></div>
                      </div>
                      <a href="javascript:void(0)" onclick="Member.ConfirmEditMember()" name="Btnupdate" id="Btnupdate" class="btn btn-primary mr-2">Update Information</a>
                </div>  
                    </div>                                                                                                      
              </div>
</div>        
</form>



<script>
 
    
 
 $( document ).ready(function() {
//     setTimout(function(){
  //   $('.bootstrap-select .form-control').css({"border":"1px solid #ccc !important"});     
    // },2000);
    
});
</script>                                                                                                 

<div class="col-12 grid-margin">
<div class="col-sm-12" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/ViewMember/".$_GET['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">View Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/BlockMember/".$_GET['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/ResetPassword/".$_GET['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div>         
</div>  
 <div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
            
                </div>
            </div>
        </div>       
<script>
function ConfirmEditMember() {
     if(SubmitNewMember()) {
      $('#PubplishNow').modal('show'); 
      var content = ''
                    +''
                    +'<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit member</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit member</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="GetTxnPassword()" style="font-family:roboto">Update Member</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     } else {
            return false;
     }
}
function GetTxnPassword() {
    var content =     '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit member</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group">'
                                + '<h4 style="text-align:center;color:#ada9a9">Please Enter Your Transaction Password</h4>'
                         + '</div>'
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
                        + '<button type="button" onclick="EditMember()" class="btn btn-primary">Update Member</button>'
                    + '</div>';
            $('#Publish_body').html(content);            
}
function EditMember() {
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmfrn").serialize();
    $('#Publish_body').html(preloading_withText("Creating Franchisee ...","95"));
        $.post(API_URL + "m=Franchisee&a=EditMember",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Member Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Members/ManageMembers" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Member</h4>'
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