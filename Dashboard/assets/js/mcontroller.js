var response="";
function restcall(url,param){
     $.post(getAppUrl() + url,param,function(response) {return response});
}

function ChangePasswordScreen(frmid1) {
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135px"));$('#myModal').modal('show');
    $.post(getAppUrl() + "m=Member&a=ChangePasswordScreen",param,function(response) {$('#Mobile_VerificationBody').html(response);});  
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ChangePasswordScreen",param));
}

function ChangeNewPassword(frmid1) {
    $("#frmNewPass_error").html("&nbsp;");
    $("#frmCfmNewPass_error").html("&nbsp;");
    ErrorCount =0;
    IsNonEmpty("NewPassword","frmNewPass_error","Please enter new password");
	IsNonEmpty("NewPassword","frmCfmNewPass_error","Please enter confirm new password");
    if ($("#ConfirmNewPassword").val().trim() != $("#NewPassword").val().trim()) {
	    $("#frmCfmNewPass_error").html("Passwords do not match");
		ErrorCount++;
	}
    if(ErrorCount>0){ 
        return false;
    }
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.post(getAppUrl() + "m=Member&a=ChangeNewPassword",param,function(response) {$('#Mobile_VerificationBody').html(response);});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ChangeNewPassword",param));
}

function MobileNumberVerification() {
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show');
    $.ajax({url: getAppUrl() + "m=Member&a=ChangeMobileNumberFromVerificationScreen", 
            success: function(result){
                $('#Mobile_VerificationBody').html(result); 
                if ($("#verifydiv" ).length ) {
                    $("#verifydiv").hide(500);
                }
    }});
}
    
function EmailVerification() {
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show');
    $.ajax({url: getAppUrl() + "m=Member&a=ChangeEmailFromVerificationScreen", success: function(result){$('#Mobile_VerificationBody').html(result); }});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ChangeEmailFromVerificationScreen",""));
} 
    
function MobileNumberVerificationForm(frmid1) {
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.post(getAppUrl() + "m=Member&a=MobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=MobileNumberVerificationForm",param));
}

function ChangeMobileNumber() {
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.ajax({url: getAppUrl() + "m=Member&a=ChangeMobileNumber",success: function(result2){$('#Mobile_VerificationBody').html(result2);}});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ChangeMobileNumber",""));
} 
    
function EmailVerificationForm(frmid1) {
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.post(getAppUrl() + "m=Member&a=EmailVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=EmailVerificationForm",param));
}
    
function ChangeEmailID() {
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.ajax({url: getAppUrl() + "m=Member&a=ChangeEmailID", success: function(result2){$('#Mobile_VerificationBody').html(result2);}});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ChangeEmailID",""));
} 
    
function CheckVerification() {
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.ajax({url: getAppUrl() + "m=Member&a=CheckVerification", success: function(result2){
						if(result2 ==1){
						    location.href=AppUrl+"MyProfiles/CreateProfile";
						}else {         
						    $('#Mobile_VerificationBody').html(result2);
						}  
					}
    });
}

function MobileNumberOTPVerification(frmid) {
		 $("#frmMobileNoVerification_error").html("&nbsp;");
		 if ($("#mobile_otp_2").val().trim()=="") {
			 $("#frmMobileNoVerification_error").html("Please enter verification code");
			 return false;
		 }
         var param = $( "#"+frmid).serialize();
         $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $.post( getAppUrl() + "m=Member&a=MobileNumberOTPVerification", param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
         //$('#Mobile_VerificationBody').html(restcall("m=Member&a=MobileNumberOTPVerification",param));
    } 
    
function EmailOTPVerification(frmid1) {
    $("#frmMobileNoVerification_error").html("&nbsp;");
	if ($("#email_otp").val().trim()=="") {
	    $("#frmMobileNoVerification_error").html("Please enter verification code");
		return false;
	}
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $.post(getAppUrl() + "m=Member&a=EmailOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=EmailOTPVerification",param));
}

function ResendMobileNumberVerificationForm(frmid1) {
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    post(getAppUrl() + "m=Member&a=ResendMobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ResendMobileNumberVerificationForm",param));
}

function ResendEmailVerificationForm(frmid1) {
    var param = $( "#"+frmid1).serialize();
    $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
    $('#myModal').modal('show'); 
    $.post(getAppUrl() + "m=Member&a=ResendEmailVerificationForm", param,function(result2) { $('#Mobile_VerificationBody').html(result2); });
    //$('#Mobile_VerificationBody').html(restcall("m=Member&a=ResendEmailVerificationForm",param));
}

function AddtoFavourite(ProfileCode,ImgId) {
    $('#img_'+ImgId).attr("onclick","javascript:void(0)");
    var grey = $('#img_'+ImgId).attr("src");
    var red = $('#img_'+ImgId).attr("src_a");
    $.ajax({url: getAppUrl() + "m=Member&a=AddToFavourite&ProfileCode="+ProfileCode, success: function(result){
                    $('#img_'+ImgId).attr("src",red);
                    $('#img_'+ImgId).attr("src_a",grey);
                    $('#img_'+ImgId).attr("onclick","removeFavourited('"+ProfileCode+"','"+ImgId+"')");
                    $.simplyToast("Profile ID: "+ProfileCode+" has been favourited", 'info');
    }});
}

function removeFavourited(ProfileCode,ImgId) {
    $('#img_'+ImgId).attr("onclick","javascript:void(0)");
    var grey = $('#img_'+ImgId).attr("src_a");
    var red = $('#img_'+ImgId).attr("src");
    $.ajax({url: getAppUrl() + "m=Member&a=RemoveFromFavourite&ProfileCode="+ProfileCode, success: function(result){
                    if (MyFavoritedPage==1) {
                        $('#div_'+ProfileCode).hide(500);
                    }
                    $('#img_'+ImgId).attr("src",grey); 
                    $('#img_'+ImgId).attr("src_a",red); 
                    $('#img_'+ImgId).attr("onclick","AddtoFavourite('"+ProfileCode+"','"+ImgId+"')");
                    $.simplyToast("Profile ID: "+ProfileCode+" has been unfavourited", 'warning');
        }});
    }
    
function AddToShortList(ProfileCode,ImgId) {
    $('#img_'+ImgId).attr("onclick","javascript:void(0)");
    var request = $.post(getAppUrl() + "m=Member&a=AddToShortList&ProfileCode="+ProfileCode,"",function(result) {
        var obj = JSON.parse(result);
        if (obj.status=="success") {
            $('#img_'+ImgId).html("Shortlisted");
            $('#img_'+ImgId).attr("onclick","RemoveFromShortList('"+ProfileCode+"','"+ImgId+"')");
            $.simplyToast(obj.message, 'info');
        } else {
            $('#img_'+ImgId).attr("onclick","AddToShortList('"+ProfileCode+"','"+ImgId+"')");
            $.simplyToast(obj.message, 'danger');
        }
    }).fail(function(xhr, status, error) {
        $('#img_'+ImgId).attr("onclick","AddToShortList('"+ProfileCode+"','"+ImgId+"')");
        $.simplyToast("Network unavailable" ,'danger');
    }); 
}                    

function RemoveFromShortList(ProfileCode,ImgId) {
    $('#img_'+ImgId).attr("onclick","javascript:void(0)");
    $.ajax({url: getAppUrl() + "m=Member&a=RemoveFromShortList&ProfileCode="+ProfileCode, success: function(result){
            if (MyShortListedPage==1) {
                $('#div_'+ProfileCode).hide(500);
            }
			$('#img_'+ImgId).html("Add To Shortlist");
            $('#img_'+ImgId).attr("onclick","AddToShortList('"+ProfileCode+"','"+ImgId+"')");
            $.simplyToast("Profile ID: "+ProfileCode+" has been removed from shortlist", 'warning');
    }});
}

function SendToInterest(ProfileCode,ImgId) {
    $('#img_'+ImgId).attr("onclick","javascript:void(0)");
    $.ajax({url: getAppUrl() + "m=Member&a=SendToInterest",success: function(result2){}});
}                                    

var DraftProfile = {
    
        SubmitGeneralInformation:function() {
            
            $('#ErrMaritalStatus').html("");
            $('#ErrLanguage').html("");
            $('#ErrReligion').html("");
            $('#ErrCaste').html("");
            $('#ErrCommunity').html("");
            $('#ErrNationality').html(""); 
            $('#ErrReligionOthers').html(""); 
            $('#ErrMainEducation').html("");
            
            ErrorCount=0;
            
            
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
			if($("#MainEducation").val()==""){
                document.getElementById("ErrMainEducation").innerHTML="Please enter your education";
                ErrorCount++; 
            }
            
            if ($('#Religion').val()=="RN009") {
                if(IsNonEmpty("ReligionOthers","ErrReligionOthers","Please enter your religion name")){
                     IsAlphabet("ReligionOthers","ErrReligionOthers","Please enter alphabet characters only");
                }
            }
            if ($('#Caste').val()=="CSTN248") {
                 if(IsNonEmpty("OtherCaste","ErrOtherCaste","Please enter your caste name")){
                     IsAlphabet("OtherCaste","ErrOtherCaste","Please enter alphabet characters only");
                }
            }
              
            
            return (ErrorCount==0) ? true : false;
         
        },                                                                    
        showConfirmDeleteAttachmentEducationalInformation:function(AttachmentID,ProfileID,EducationDetails,EducationDegree,OtherEducationDegree,FileName){
            $('#PubplishNow').modal('show'); 
		  var content = '<div >'
							+'<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
								+'<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
								+'<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
								+'<div class="modal-header">'
									+'<h4 class="modal-title">Confirmation For Remove</h4>'
									+'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
								+'</div>'
								+'<div class="modal-body" style="min-height:175px;max-height:175px;">'
									+'<div style="text-align:left">Are you sure want to remove below records?<br><br></div>'
									+'<table class="table table-bordered">'
										+'<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;"> '
											+'<tr>'
												+'<th>Education</th>'
												+'<th>Education Details</th>'
											+'</tr>'
										+'</thead>'
										+'<tbody> '
											+'<tr>'                                                  
												+'<td>'+EducationDetails+'</td>'
												+'<td>'+EducationDegree +', '+OtherEducationDegree+'</td>'
											+'</tr>'
										+'</tbody>'
									+'</table>'
								+'</div>' 
								+'<div class="modal-footer">'  
									+'<button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteAttach(\''+AttachmentID+'\')" style="font-family:roboto">Yes, send request</button>&nbsp;&nbsp;&nbsp;'
									+'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
								+'</div>'
							+'</form>'                                                                                                          
						+'</div>';
				$('#Publish_body').html(content);
        },
        showAttachmentEducationInformation:function(AttachmentID,ProfileID,FileName){
             $('#PubplishNow').modal('show'); 
      var content = '<div>'
                        +'<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
							+ '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
							+ '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
							+'<div class="modal-header">'
								+'<h4 class="modal-title">Confirmation For Remove</h4>'
								+'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
							+'</div>'
							+'<div class="modal-body" style="min-height:175px;max-height:175px;">'
								+'<div class="card-title" style="text-align:right;color:green;margin-bottom:0px">For Administrative Purpose Only</div>'
								 +'<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileID+'/edudoc/'+FileName+'" style="height:120px;"></div> <br>'
							+'</div>'
							+'<div class="modal-footer">'  
								+'<button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteEducationAttachmentOnly(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;&nbsp;'
								+'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
							+'</div>'
						+'</form>'
                    +'</div>';                                                                                                
            $('#Publish_body').html(content);
        },
           showAttachmentEducationInformationForView:function(AttachmentID,ProfileID,FileName,Status){
             $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Education Attachment</h4>'
                             + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div><br>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileID+'/edudoc/'+FileName+'" style="height:120px;"><br><br><br><br></div> <br>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#Publish_body').html(content);
        },
        showAttachmentOccupation:function(ProfileCode,MemberID,ProfileID,FileName){
             $('#PubplishNow').modal('show'); 
      var content = '<div>'
						+'<form method="post" id="Occupationform_'+ProfileCode+'" name="Occupationform_'+ProfileCode+'" > '
							+ '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
							+ '<input type="hidden" value="'+MemberID+'" name="MemberID">'
							+ '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
							+'<div class="modal-header">'
								+'<h4 class="modal-title">Confirmation For Remove</h4>'
								+'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
							+'</div>'
							+'<div class="modal-body" style="min-height:175px;max-height:175px;">'
								+'<div class="card-title" style="text-align:right;color:green;margin-bottom:0px">For Administrative Purpose Only</div>'
								 +'<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileCode+'/occdoc/'+FileName+'" style="height:120px;"></div> <br>'
							+'</div>'
							+'<div class="modal-footer">'  
								+'<button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteOccupationAttachmentOnly(\''+ProfileCode+'\')">Yes, remove</button>&nbsp;&nbsp;&nbsp;'
								+'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
							+'</div>'
                    +'</div>';                                                                                                
            $('#Publish_body').html(content);
        },
        showAttachmentOccupationForView:function(ProfileCode,MemberID,ProfileID,FileName){
             $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="Occupationform_'+ProfileCode+'" name="Occupationform_'+ProfileCode+'" > '
                         + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                         + '<input type="hidden" value="'+MemberID+'" name="MemberID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Occupation Attachment</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/profiles/'+ProfileCode+'/occdoc/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#Publish_body').html(content);
        },
        SubmitFamilyInformation:function() {
            
            $('#ErrFatherName').html("");
            $('#ErrMotherName').html("");
            $('#ErrFathersContact').html("");
            $('#ErrMotherContact').html("");
            $('#ErrFamilyLocation1').html("");
            $('#ErrAncestral').html("");
            $('#ErrFamilyType').html("");
            $('#ErrFamilyAffluence').html("");
            $('#ErrFamilyValue').html("");
            
            ErrorCount=0;
        
            if (IsNonEmpty("FatherName","ErrFatherName","Please enter your father's name")) {
                IsAlphabet("FatherName","ErrFatherName","Please enter alpha numeric characters only");
            }
            if (IsNonEmpty("MotherName","ErrMotherName","Please enter your mother's name")) {
                IsAlphabet("MotherName","ErrMotherName","Please enter alpha numeric characters only");
            }
           
            if ($('#FathersContact').val().trim().length>0) {
                IsMobileNumber("FathersContact","ErrFathersContact","Please Enter Valid Mobile Number");
            }
            if ($('#MotherContact').val().trim().length>0) {
                IsMobileNumber("MotherContact","ErrMotherContact","Please Enter Valid Mobile Number");
            } 
            if ($('#FathersOccupation').val()=="OT112") {
                if(IsNonEmpty("FatherOtherOccupation","ErrFatherOtherOccupation","Please enter your father other occupation")){
                   IsAlphabet("FatherOtherOccupation","ErrFatherOtherOccupation","Please enter alphabet characters only");
                }
            }
            if ($('#MothersOccupation').val()=="OT112") {
                if(IsNonEmpty("MotherOtherOccupation","ErrMotherOtherOccupation","Please enter your mother other occupation")){
                   IsAlphabet("MotherOtherOccupation","ErrMotherOtherOccupation","Please enter alphabet characters only");
                }
            }
            IsNonEmpty("FamilyLocation1","ErrFamilyLocation1","Please enter your family location");                                                                                                          
            IsNonEmpty("Ancestral","ErrAncestral","Please enter your ancestral");       
            if($("#FamilyType").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrFamilyType").innerHTML="Please select family type"; 
            }
            if($("#FamilyAffluence").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrFamilyAffluence").innerHTML="Please select family affluence"; 
            }
            if($("#FamilyValue").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrFamilyValue").innerHTML="Please select family value"; 
            }                                                                                                    
            
        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }   
                        
        },
        addOtherReligionName: function() {
        if ($('#Religion').val()=="RN009") {
            $('#Religion_additionalinfo').show();
        } else {
            $('#Religion_additionalinfo').hide();
        }
        },
        addOtherCasteName: function() {
            if ($('#Caste').val()=="CSTN248") {
                $('#CasteName_additionalinfo').show();
            } else {
                $('#CasteName_additionalinfo').hide();
            }
        },
        addOtherEducationDetails: function() {
            if ($('#EducationDegree').val()=="Others") {
                $('#Education_additionalinfo').show();
            } else {
                $('#Education_additionalinfo').hide();
            }
        },
        addOtherOccupation: function() {
            if ($('#OccupationType').val()=="OT112") {
                $('#Occupation_additionalinfo').show();
            } else {
                $('#Occupation_additionalinfo').hide();
            }
        },
        addOtherWorkingDetails: function() {
            if ($('#EmployedAs').val()=="O001") {
                $('#Working_additionalinfo').show();
            } else {
                $('#Working_additionalinfo').hide();
            }
        },
        addPartnersExpectationAnnualWorkingDetails: function() {
            if ($('#EmployedAs').val()=="OT107") {
                $('#AnnualadditionalInfo').hide();
            } else {
                $('#AnnualadditionalInfo').show();
            }
        },
        changeAboutLable: function() {
        if ($('#ProfileFor').val()=="Myself") {
            $('#Aboutlabel').html("About me<span style='color:red'>*</span>");                                                         
        }
        if ($('#ProfileFor').val()=="Brother") {
            $('#Aboutlabel').html("About my brother<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Sister") {
            $('#Aboutlabel').html("About my sister<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Daughter") {
            $('#Aboutlabel').html("About my daughter<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Son") {
            $('#Aboutlabel').html("About my Son<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Sister In Law") {
            $('#Aboutlabel').html("About my sister in law<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Brother In Law") {
            $('#Aboutlabel').html("About my brother in law<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Son In Law") {
            $('#Aboutlabel').html("About my son in law<span style='color:red'>*</span>");
        }
        if ($('#ProfileFor').val()=="Daughter In Law") {
            $('#Aboutlabel').html("About my daughter in law<span style='color:red'>*</span>");
        }
    },
        Personal:function() {
            alert("personal");
        }
};

    function getHowmanyChildrenInfo() {
        if ($('#MaritalStatus').val()=="MST001" || $('#MaritalStatus').val()=="0") {
            $('#mstatus_additionalinfo').hide();
        } else {
            $('#mstatus_additionalinfo').show();
            getChildrenwithWhom();
        }
    }
    
     function getChildrenwithWhom() {
            if ($('#HowManyChildren').val()=="NOB001" || $('#HowManyChildren').val()==-1) {
                 // $('#ChildrenWithYou').attr("disabled","disabled");
                  $('#IsChildrenWithYou').css({"display":"none"});
                  $('#Childrenwithyou_input').css({"display":"none"});
            } else {
               //$('#ChildrenWithYou').removeAttr("disabled"); 
               $('#IsChildrenWithYou').css({"display":"block"});
               $('#Childrenwithyou_input').css({"display":"block"});
            }
        }
        
        function verifiyFatherPassedaway() {
         if ($('#FathersAlive').is(":checked")){
            
            $('#FatherAlive_row_1').hide();
            $('#FatherAlive_row_2').hide();
            $('#FatherAlive_row_3').hide();
        } else {
            $('#FatherAlive_row_1').show();
            $('#FatherAlive_row_2').show();
            $('#FatherAlive_row_3').show();
        }
    }
    
    function displayFatherIncome() {     
       
         if ($("#FathersOccupation").val()=="OT107" || $("#FathersOccupation").val()==0) {
            $('#father_income_1').hide();
            $('#father_income_2').hide();
             $('#FatherOccupation_additionalinfo').hide(); 
        } else {
            
            if ($("#FathersOccupation").val()=="OT112")  {
                 $('#FatherOccupation_additionalinfo').show(); 
                  $('#father_income_1').show();
            $('#father_income_2').show();
            } else {
            
             $('#father_income_1').show();
            $('#father_income_2').show();
            $('#FatherOccupation_additionalinfo').hide(); 
            }
        }
    }
    
function displayMotherIncome() {
    if ($("#MothersOccupation").val()=="OT107" || $("#MothersOccupation").val()==0) {
        $('#mother_income_1').hide();
        $('#mother_income_2').hide();
        $('#MotherOccupation_additionalinfo').hide(); 
    } else {
        if ($("#MothersOccupation").val()=="OT112")  {
            $('#MotherOccupation_additionalinfo').show(); 
            $('#mother_income_1').show();
            $('#mother_income_2').show();
        } else {
            $('#mother_income_1').show();
            $('#mother_income_2').show();
            $('#MotherOccupation_additionalinfo').hide(); 
        }
    }
}
    
function verifiyMotherPassedaway() {
    if ($('#MothersAlive').is(":checked")){
        $('#MotherAlive_row_1').hide();
        $('#MotherAlive_row_2').hide();
        $('#MotherAlive_row_3').hide();
    } else {
        $('#MotherAlive_row_1').show();
        $('#MotherAlive_row_2').show();
        $('#MotherAlive_row_3').show();
    }
}

function print_sister_counts() {
        
        var n_brothers = $('#NumberofSisters').val();
        
        if (n_brothers=='NS001') {
            $('#div_elderSister').hide();
            $('#div_youngerSister').hide();
            $('#div_marriedSister').hide();
        } else {
            $('#div_elderSister').show();
            $('#div_youngerSister').show();
            $('#div_marriedSister').show();
            
            var eld = $('#elderSister').val();
            var ynr = $('#youngerSister').val();
            var mrd = $('#marriedSister').val();
            
            var nc = ['NS001','NS002','NS003','NS004','NS005','NS006','NS007','NS008','NS009','NS010'] ;
            
            $('#elderSister').find('option').remove();
            $('#youngerSister').find('option').remove();
            $('#marriedSister').find('option').remove();
            
            var c = ['ES001','ES002','ES003','ES004','ES005','ES006','ES007','ES008','ES009','ES010'] ;     
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (eld==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('elderSister').appendChild(opt);
            }
            
            var c = ['YS001','YS002','YS003','YS004','YS005','YS006','YS007','YS008','YS009','YS010'] ;
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (ynr==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('youngerSister').appendChild(opt);
            }
            
            var c = ['MS001','MS002','MS003','MS004','MS005','MS006','MS007','MS008','MS009','MS010'] ;
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (mrd==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('marriedSister').appendChild(opt);
            }
        }
    }
    
    function print_brother_counts() {
        var n_brothers = $('#NumberofBrother').val();
        
        if (n_brothers=='NOB001') {
            $('#div_elder').hide();
            $('#div_younger').hide();
            $('#div_married').hide();
        } else {
            $('#div_elder').show();
            $('#div_younger').show();
            $('#div_married').show();
            
            var nc = ['NOB001','NOB002','NOB003','NOB004','NOB005','NOB006','NOB007','NOB008','NOB009','NOB010'] ;
            
            var eld = $('#belder').val();
            var ynr = $('#byounger').val();
            var mrd = $('#married').val();
            
            $('#belder').find('option').remove();
            $('#byounger').find('option').remove();
            $('#married').find('option').remove();
            
            var c = ['EB001','EB002','EB003','EB004','EB005','EB006','EB007','EB008','EB009','EB010'] ;     
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (eld==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('belder').appendChild(opt);
            }
            
            var c = ['YB001','YB002','YB003','YB004','YB005','YB006','YB007','YB008','YB009','YB010'] ;
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (ynr==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('byounger').appendChild(opt);
            }

            var c = ['MB001','MB002','MB003','MB004','MB005','MB006','MB007','MB008','MB009','MB010'] ;
            for (var i = 0; i<=nc.indexOf(n_brothers); i++){
                var opt = document.createElement('option');
                opt.value = c[i];
                if (mrd==c[i]) {
                    var att = document.createAttribute("selected");
                    att.value = "selected";
                    opt.setAttributeNode(att); 
                }
                opt.innerHTML = i;
                document.getElementById('married').appendChild(opt);
            }
        }
    }
    
    function ConfirmChangeMobileNumber() {
        $('#NewMobileNumber').val("");
        $('#NewMobileNumber_error').html("");
        $('#ChangeMobile_body').html($('#primary_content').html());
        $('#ChangeMobile').modal('show'); 
    }
    
    
    function randomStrings(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}


function ResendOtpForChangeMobileNumber(frmid) {
     var param = $("#"+frmid).serialize();
    $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
      $.post(getAppUrl() + "m=Member&a=ResendOtpForChangeMobileNumber",param,function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Mobile Number</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">+'+data.CountryCode+'-'+data.mobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="ChangemobilenumberOtp" maxlength="4" name="ChangemobilenumberOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeMobileNumberOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeMobileNumber(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';                               
                                         
                $('#ChangeMobile_body').html(content);
                
            } else {
                var data = obj.data;
                $('#NewMobileNumber_error').html(obj.message);
                $('#ChangeMobile_body').html($('#primary_content').html());
                $('#ChangeMobile').modal('show'); 
                $('#NewMobileNumber').val(data.mobileNumber);
            }
        });
}
    function ChangeMemberMobileNumber() {
        if ($("#NewMobileNumber").val().trim()=="") {
             $("#NewMobileNumber_error").html("Please enter new mobile number");
             return false;
        }
        if(!($("#NewMobileNumber").val()>6000000000 && $("#NewMobileNumber").val()<9999999999)) {
             $("#NewMobileNumber_error").html("Invalid Mobile Number");
             return false;
        }
        var param = $("#FrmChnMob").serialize();
        $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
        $.post(getAppUrl() + "m=Member&a=SendOtpForChangeMobileNumber",param,function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Mobile Number</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">+'+data.CountryCode+'-'+data.mobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="ChangemobilenumberOtp" maxlength="4" name="ChangemobilenumberOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeMobileNumberOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="ChangemobilenumberOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeMobileNumber(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';                               
                                         
                $('#ChangeMobile_body').html(content);
                
            } else {
                var data = obj.data;
                $('#NewMobileNumber_error').html(obj.message);
                $('#ChangeMobile_body').html($('#primary_content').html());
                $('#ChangeMobile').modal('show'); 
                $('#NewMobileNumber').val(data.mobileNumber);
            }
        });
    }
    function ChangeMobileNumberOTPVerification(frmId) {
        if ($("#ChangemobilenumberOtp").val().trim()=="") {
             $("#ChangemobilenumberOtp_error").html("Please enter verification code");
             return false;
        }
        var param = $( "#"+frmId).serialize();
        $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
        $.post( getAppUrl() + "m=Member&a=ChangeMobileNumberOTPVerification",param).done(function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
                return ;
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;"margin-top: 90px;><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg"></p>'
                                    + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
            $('#ChangeMobile_body').html(content);
            }  else {
             var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm">'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                   +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Mobile Number</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                       +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                       +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">+'+data.CountryCode+'-'+data.mobileNumber+'</h4></p>'
                                        + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="ChangemobilenumberOtp" maxlength="4" name="ChangemobilenumberOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeMobileNumberOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-12" style="color:red;text-align:center">'+obj.message+'</div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                       +'</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeMobileNumber(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                                         
                $('#ChangeMobile_body').html(content);
                
            } 
            
    });
}
    function ConfirmChangeEmailID() {
        $('#NewEmailID').val("");
        $('#NewEmailID_error').html("");
        $('#ChangeMobile').modal('show'); 
        var content = '<form method="post" id="FrmChnMob" >'  
                     +'<div class="modal-header">'
                            +'<h4 class="modal-title">Confirmation for change email id</h4>'
                            +'<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        +'</div>'
                       +'<div class="modal-body" style="max-height:400px;min-height:400px;">'
                            +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                            +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;"><b>Caution!</b> You are going to change your primary Email ID. All further communication from us ill be delivered on this new Email ID.</p>'
                            +'<div class="form-group row" style="margin-bottom:0px">'
                                +'<div class="col-sm-2"></div>'
                                +'<label class="col-sm-10" style="color:#ada9a9;font-size: 14px;">Email ID</label>'
                            +'</div>' 
                            +'<div class="form-group row">'
                                +'<div class="col-sm-2"></div>'
                                +'<div class="col-sm-8"><input type="text" class="form-control" id="NewEmailID" name="EmailID"></div>'
                                +'<div class="col-sm-12" id="NewEmailID_error" style="color:red;text-align:center"></div>'
                            +'</div>'
                        +'</div>' 
                        +'<div class="modal-footer">'
                            +'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            +'<button type="button" class="btn btn-primary" name="Create" onclick="SendOtpForChangeEmailID()" style="font-family:roboto">Continue</button>'
                        +'</div>'
                     +'</form>';
        $('#ChangeMobile_body').html(content);
    }
    function SendOtpForChangeEmailID() {
        if ($("#NewEmailID").val().trim()=="") {
             $("#NewEmailID_error").html("Please enter new email id");
             return false;
        }
       /* if(!($("#NewEmailID").val()== /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,8})$/)) {
             $("#NewEmailID_error").html("Invalid Email ID");
             return false;
        }  */
        
        var param = $("#FrmChnMob").serialize();
        $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
        
        $.post(getAppUrl() + "m=Member&a=SendOtpForChangeEmailID",param,function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Email ID</h4>'
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
                                                        + '<input type="text"  class="form-control" id="ChangeemailidOtp" maxlength="4" name="ChangeemailidOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeEmailIDOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="ChangeemailidOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeEmailID(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';                               
                                         
                $('#ChangeMobile_body').html(content);
                
            } else {
                var data = obj.data;
                $('#NewEmailID_error').html(obj.message);
                $('#ChangeMobile').modal('show'); 
                $('#NewEmailID').val(data.EmailID);
            }
        });
    }
    
    function ResendOtpForChangeEmailID(frmid) {
     var param = $("#"+frmid).serialize();
    $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
      $.post(getAppUrl() + "m=Member&a=ResendOtpForChangeEmailID",param,function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Email ID</h4>'
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
                                                        + '<input type="text"  class="form-control" id="ChangeemailidOtp" maxlength="4" name="ChangeemailidOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeEmailIDOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="ChangeemailidOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeEmailID(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';                               
                                         
                $('#ChangeMobile_body').html(content);
                
            } else {
                var data = obj.data;
                $('#NewMobileNumber_error').html(obj.message);
                $('#ChangeMobile_body').html($('#primary_content').html());
                $('#ChangeMobile').modal('show'); 
                $('#NewMobileNumber').val(data.mobileNumber);
            }
        });
}
    
     function ChangeEmailIDOTPVerification(frmId) {
        if ($("#ChangeemailidOtp").val().trim()=="") {
             $("#ChangeemailidOtp_error").html("Please enter verification code");
             return false;
        }
        var param = $( "#"+frmId).serialize();
        $('#ChangeMobile_body').html(preloading_withText("Loading ...","195"));
        $.post( getAppUrl() + "m=Member&a=ChangeEmailIDOTPVerification",param).done(function(result) {
            if (!(isJson(result))) {
                $('#ChangeMobile_body').html(result);
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
            $('#ChangeMobile_body').html(content);
            }  else {
             var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm">'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                   +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Change Email ID</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                       +'<p style="text-align:center;"><img src="'+AppUrl+'assets/images/email_verification.png"></p>'
                                       +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'</h4></p>'
                                        + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="ChangeemailidOtp" maxlength="4" name="ChangeemailidOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ChangeEmailIDOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-12" style="color:red;text-align:center" id="ChangeemailidOtp_error">'+obj.message+'</div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                       +'</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOtpForChangeEmailID(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                                         
                $('#ChangeMobile_body').html(content);
                
            } 
            
    });
}
    
//791