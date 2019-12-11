    function MobileNumberVerification() {
        
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.ajax({
            url: API_URL + "m=Member&a=ChangeMobileNumberFromVerificationScreen", 
            success: function(result){
               $('#Mobile_VerificationBody').html(result); 
               
               if ( $( "#verifydiv" ).length ) {
                    $( "#verifydiv").hide(500);
               }
            }});
    }
    
    function EmailVerification() {
        
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.ajax({
            url: API_URL + "m=Member&a=ChangeEmailFromVerificationScreen", 
            success: function(result){
               $('#Mobile_VerificationBody').html(result); 
            }});
    } 
    
    function MobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Member&a=MobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    
    function ChangeMobileNumber() {
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.ajax({url: API_URL + "m=Member&a=ChangeMobileNumber",success: function(result2){$('#Mobile_VerificationBody').html(result2);}});
    } 
    
    function EmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Member&a=EmailVerificationForm",param,function(result2) {
            $('#Mobile_VerificationBody').html(result2);  
        });
    }
    
    function ChangeEmailID() {
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.ajax({url: API_URL + "m=Member&a=ChangeEmailID", success: function(result2){
            $('#Mobile_VerificationBody').html(result2);
        }});
    } 
    
    function CheckVerification() {
        $('#Mobile_VerificationBody').html(preloader);
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Member&a=CheckVerification", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
     function MobileNumberOTPVerification(frmid) {
         var param = $( "#"+frmid).serialize();
         $('#Mobile_VerificationBody').html(preloader);
                    $.post( API_URL + "m=Member&a=MobileNumberOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    } 
   /* function EmailVerificationForm() {
        $('#Mobile_VerificationBody').html("loging....");
         $('#myModal').modal('show');  
        $.ajax({
            url: API_URL + "m=Member&a=IsMobileVerified", 
            success: function(result){
                
              if (!(result)) {
                    $.ajax({
                        url: API_URL + "m=Views&a=EmailVerificationForm", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
               } 
            }
        });
              
    }*/
    function EmailOTPVerification(frmid1) {
         var param = $( "#"+frmid1).serialize();
         $('#Mobile_VerificationBody').html(preloader);
                    $.post(API_URL + "m=Member&a=EmailOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }
    //var obj = jQuery.parseJSON(result);
    //$('#myModal').modal('show');                                                                                   
    
     function ResendMobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Member&a=ResendMobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    function ResendEmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloader);
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Member&a=ResendEmailVerificationForm", param,function(result2) { $('#Mobile_VerificationBody').html(result2); });
    }
    
    function AddtoFavourite(ProfileCode,ImgId) {
        $('#img_'+ImgId).attr("onclick","javascript:void(0)");
        var grey = $('#img_'+ImgId).attr("src");
        var red = $('#img_'+ImgId).attr("src_a");
        $.ajax({
                url: API_URL + "m=Member&a=AddToFavourite&ProfileCode="+ProfileCode, 
                success: function(result){
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
        $.ajax({
                url: API_URL + "m=Member&a=RemoveFromFavourite&ProfileCode="+ProfileCode, 
                success: function(result){
                    
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
        //var grey = $('#img_'+ImgId).attr("src");
       // var red = $('#img_'+ImgId).attr("src_a");
        $.ajax({
                url: API_URL + "m=Member&a=AddToShortList&ProfileCode="+ProfileCode, 
                success: function(result){
                    //$('#img_'+ImgId).attr("src",red);
                   // $('#img_'+ImgId).attr("src_a",grey);
					$('#img_'+ImgId).html("Shortlisted");
                    $('#img_'+ImgId).attr("onclick","RemoveFromShortList('"+ProfileCode+"','"+ImgId+"')");
                    $.simplyToast("Profile ID: "+ProfileCode+" has been shortlisted", 'info');
        }});
    }
	function RemoveFromShortList(ProfileCode,ImgId) {
        $('#img_'+ImgId).attr("onclick","javascript:void(0)");
       // var grey = $('#img_'+ImgId).attr("src_a");
      //  var red = $('#img_'+ImgId).attr("src");
        $.ajax({
                url: API_URL + "m=Member&a=RemoveFromShortList&ProfileCode="+ProfileCode, 
                success: function(result){
                    
                    if (MyShortListedPage==1) {
                        $('#div_'+ProfileCode).hide(500);
                    }
        
                   // $('#img_'+ImgId).attr("src",grey); 
                   // $('#img_'+ImgId).attr("src_a",red); 
					  $('#img_'+ImgId).html("Add To Shortlist");
                    $('#img_'+ImgId).attr("onclick","AddToShortList('"+ProfileCode+"','"+ImgId+"')");
                    $.simplyToast("Profile ID: "+ProfileCode+" has been removed from shortlist", 'warning');
        }});
    }
	
    function SendToInterest(ProfileCode,ImgId) {
        $('#img_'+ImgId).attr("onclick","javascript:void(0)");
        //$.ajax({
           $.ajax({url: API_URL + "m=Member&a=SendToInterest",success: function(result2){}});

        //});
    }                                    
    
                                     
    var DraftProfile = {
    
        SubmitGeneralInformation:function() {
            
            $('#ErrProfileFor').html("");
            $('#ErrProfileName').html("");
            $('#ErrSex').html("");
            $('#ErrMaritalStatus').html("");
            $('#ErrLanguage').html("");
            $('#ErrReligion').html("");
            $('#ErrCaste').html("");
            $('#ErrCommunity').html("");
            $('#ErrNationality').html(""); 
            $('#ErrReligionOthers').html(""); 
            $('#Errdate').html("");
            $('#Errmonth').html("");
            $('#Erryear').html("");
            $('#ErrMainEducation').html("");
            
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
            if($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0"){
                document.getElementById("ErrDateofBirth").innerHTML="Please select date of birth"; 
                ErrorCount++;
            }   
            
            return (ErrorCount==0) ? true : false;
         
        },                                                                    
        showConfirmDeleteAttachmentEducationalInformation:function(AttachmentID,ProfileID,EducationDetails,EducationDegree,OtherEducationDegree){
            $('#DeleteNow').modal('show'); 
            var content = '<div class="Publish_body" style="padding:20px">'
                            +'<div  style="height: 315px;">'
                                + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                                    + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                                    + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                                    + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                    + '<h4 class="modal-title">Confirmation For Remove</h4> <br>'
                                        + '<div>Are you sure want to remove below records?  <br><br>'
                                            + '<table class="table table-bordered">'
                                                + '<thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;"> '
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
                                        +'<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteAttach(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;'
                                        +'<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                                    +'</div><br>'
                            +'</form>'
                       +'</div>'
            +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content); 
        },
        showAttachmentEducationInformation:function(AttachmentID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                            + '<form method="post" id="form_'+AttachmentID+'" name="form_'+AttachmentID+'" > '
                                + '<input type="hidden" value="'+AttachmentID+'" name="AttachmentID">'
                                + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                                    + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                    + '<h4 class="modal-title">Comfirmation For Remove</h4>'
                                    + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                                        + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                                        +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteEducationAttachmentOnly(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;'
                                        +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                                    + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
        },
           showAttachmentEducationInformationForView:function(AttachmentID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Education Attachment</h4>'
                             + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div><br>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
        },
        showAttachmentOccupation:function(ProfileCode,MemberID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="Occupationform_'+ProfileCode+'" name="Occupationform_'+ProfileCode+'" > '
                         + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                         + '<input type="hidden" value="'+MemberID+'" name="MemberID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Confirmation For Remove</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                               +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteOccupationAttachmentOnly(\''+ProfileCode+'\')">Yes, remove</button>&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
        },
        showAttachmentOccupationForView:function(ProfileCode,MemberID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                         + '<form method="post" id="Occupationform_'+ProfileCode+'" name="Occupationform_'+ProfileCode+'" > '
                         + '<input type="hidden" value="'+ProfileCode+'" name="ProfileCode">'
                         + '<input type="hidden" value="'+MemberID+'" name="MemberID">'
                         + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Occupation Attachment</h4>'
                              + '<div class="card-title" style="text-align:right;color:green;">For Administrative Purpose Only</div>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
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
