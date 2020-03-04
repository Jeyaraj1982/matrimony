<?php 
    $page="ServiceRequest";
    include_once("service_request_to_menu.php");
    $response =$webservice->getData("Franchisee","GetFranchiseeDeleteReason");
?>
<script>
function submitdelete() {
            $('#Errcheck').html("");

            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please agree terms and conditions");
                return false;
            }
            if (document.form1.check.checked == true){
                $(document).ready(function(){
            $("#DeleteModal").modal('show');});
            return false;
            }
                            return true;
        }
</script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div style="max-width:770px !important;">
            <h4 class="card-title">Service Request</h4>
            <h4 class="card-title">Delete Franchisee</h4>
            <span style="color:#666;">If you delete a franchisee it will delete all associated data immediately and permanently. This will also affect your analytics, so we only recommend deleting franchisees that never used in future.</span><br><br>
            <form method="post" action="" name="Deletefrm_<?php echo $_GET['Code'];?>" id="Deletefrm_<?php echo $_GET['Code'];?>">
                <input type="hidden" name="RequestForCode" value="<?php echo $_GET['Code'];?>">
                <div class="form-group row">
                    <label for="DeleteReason" class="col-sm-12 col-form-label" style="margin-bottom: -15px;">Select the reason for deleting your account<span id="star">*</span></label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <select class="selectpicker form-control" data-live-search="true" id="DeleteReason" name="DeleteReason">
                            <?php foreach($response['data']['DeleteReason'] as $DeleteReason) { ?>
                                <option value="<?php echo $DeleteReason['SoftCode'];?>" <?php echo ($_POST['DeleteReason']==$DeleteReason['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $DeleteReason['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Comments" class="col-sm-12 col-form-label" style="margin-bottom: -15px;">Add your Comments<span id="star">*</span></label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <textarea id="Comments" name="Comments" class="form-control"><?php echo (isset($_POST['Comments']) ? $_POST['Comments'] : "");?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="check" name="check">
                            <label class="custom-control-label" for="check" style="vertical-align: middle;">I understand that all content will be delete  </label>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#condition">Learn more</a>
                        </div>
                        <span class="errorstring" id="Errcheck"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" onclick="showConfirmDeleteFranchisee('<?php echo $_GET['Code'];?>')" class="btn btn-danger" name="Delete" style="font-family:roboto">Delete Franchisee</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
 <div class="modal" id="condition" style="padding-top:177px;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 315px;">
                    <h5 style="text-align:center">Delete Franchisee</h5><button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>
                   <ol>
                    <li>Indian Nationals & Citizens. </li>
                    <li> Persons of Indian Origin (PIO). </li>
                    <li> Non Resident Indians (NRI).</li>
                    <li> Persons of Indian Descent or Indian Heritage  </li>
                    <li> Not prohibited or prevented by any applicable law for the time being in force from entering into a valid marriage.</li>
                    <li>Sharing of confidential and personal data with each other but not limited to sharing of bank details, etc.</li>
                   </ol>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="modal" id="DeleteNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Delete_body"  style="max-height: 529px;min-height: 529px;" >
            
                </div>
            </div>
        </div>
<script>
function showConfirmDeleteFranchisee(RequestForCode) {
      $('#DeleteNow').modal('show'); 
      var content = '<div>'
                            +'<div class="modal-header">'
                                +'<h4 class="modal-title">Delete Franchisee</h4>'
                                +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                            +'</div>'
                            + '<div class="modal-body" style="max-height: 406px;min-height: 406px;">'
                                + '<div class="form-group row" style="margin:0px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to delete</div>'
                                        + '</div>'
                                    + '</div>'
                                + '</div>'                    
                            + '</div>' 
                            +'<div class="modal-footer">'  
                                +'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>&nbsp;&nbsp;&nbsp;'
                                +'<button type="button" class="btn btn-primary" name="Delete" id="Delete"  onclick="SendOtpForDeleteFranchisee(\''+RequestForCode+'\')" style="font-family:roboto">Yes</button>'
                            +'</div>'
                    +'</div>';
                $('#Delete_body').html(content);
}
function SendOtpForDeleteFranchisee(formid) {
    var param = $("#Deletefrm_"+formid).serialize();
    $('#Delete_body').html(preloading_withText("Deleting profile ...","199"));
        $.post(getAppUrl() + "m=Franchisee&a=SendOtpForDeleteFranchisee",param,function(result) {
            
             if (!(isJson(result))) {
                $('#Delete_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                + '<input type="hidden" value="'+data.Comments+'" name="Comments">'                            
                                + '<input type="hidden" value="'+data.DeleteReason+'" name="DeleteReason">'                            
                                + '<input type="hidden" value="'+formid+'" name="RequestForCode">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Delete Franchisee</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="DeleteMemberOtp" maxlength="4" name="DeleteMemberOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="DeleteFranchiseeOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="DeletMemberOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForDeleteFranchisee(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                 $('#Delete_body').html(content);
        }
        });
}
function DeleteFranchiseeOTPVerification(frmId) {
        var param = $( "#"+frmId).serialize();
        $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
        $.post( getAppUrl() + "m=Franchisee&a=DeleteFranchiseeOTPVerification",param).done(function(result) {
            if (!(isJson(result))) {
                $('#Delete_body').html(result);
                return ;
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 90px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg"></p>'
                                    + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
            $('#Delete_body').html(content);
            }  else {
             var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm">'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Delete Franchisee</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="DeleteMemberOtp" maxlength="4" name="DeleteMemberOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="DeleteFranchiseeOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="DeletMemberOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForDeleteFranchisee(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                                         
                $('#Delete_body').html(content);
           } 
            
    });
}
    
</script>