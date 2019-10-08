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
        
        $.post(API_URL + "m=Member&a=EmailVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
    function ChangeEmailID() {
        $('#Mobile_VerificationBody').html(preloader);
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Member&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
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
            
            return (ErrorCount==0) ? true : false;
         
        },
        showConfirmDeleteAttachmentEducationalInformation:function(AttachmentID,ProfileID,EducationDetails,EducationDegree){
            $('#DeleteNow').modal('show'); 
            var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
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
                           + '<tbody> '
                            +'<tr>'                                                  
                                +'<td>'+EducationDetails+'</td>'
                                +'<td>'+EducationDegree+'</td>'
                            +'</tr>'
                           +'</tbody>'
                           +'</table>'
                        +  '<div style="text-align:center"><button type="button" class="btn btn-primary" name="Delete"  onclick="DeleteAttach(\''+AttachmentID+'\')">Yes, remove</button>&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="cursor:pointer;color:#0599ae">No</a></div>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content); 
        },
        showAttachmentEducationInformation:function(AttachmentID,ProfileID,FileName){
             $('#DeleteNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                        +'<div  style="height: 315px;">'
                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                            + '<h4 class="modal-title">Education Attachment</h4> <br>'
                             + '<div style="text-align:center"><img src="'+AppUrl+'uploads/'+FileName+'" style="height:120px;"></div> <br>'
                        + '</div>'
                    +  '</div>';                                                                                                
            $('#DeleteNow_body').html(content);
        },
        SubmitFamilyInformation:function() {
            
            $('#ErrFatherName').html("");
            $('#ErrMotherName').html("");
            $('#ErrFathersContact').html("");
            $('#ErrMotherContact').html("");
            
            ErrorCount=0;
        
            if (IsNonEmpty("FatherName","ErrFatherName","Please enter your father name")) {
                IsAlphabet("FatherName","ErrFatherName","Please enter alpha numeric characters only");
            }
            if (IsNonEmpty("MotherName","ErrMotherName","Please enter your mother name")) {
                IsAlphabet("MotherName","ErrMotherName","Please enter alpha numeric characters only");
            }
            if ($('#FathersContact').val().trim().length>0) {
                IsMobileNumber("FathersContact","ErrFathersContact","Please Enter Valid Mobile Number");
            }
            if ($('#MotherContact').val().trim().length>0) {
                IsMobileNumber("MotherContact","ErrMotherContact","Please Enter Valid Mobile Number");
            }
            
        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
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
        } else {
            $('#FatherAlive_row_1').show();
            $('#FatherAlive_row_2').show();
        }
    }
    
    function displayFatherIncome() {
        if ($("#FathersOccupation").val()=="OT107" || $("#FathersOccupation").val()==0) {
              
            $('#father_income_1').hide();
            $('#father_income_2').hide();
        } else {
             $('#father_income_1').show();
            $('#father_income_2').show();
        }
    }
    
    function displayMotherIncome() {
        if ($("#MothersOccupation").val()=="OT107" || $("#MothersOccupation").val()==0) {
              
            $('#mother_income_1').hide();
            $('#mother_income_2').hide();
        } else {
             $('#mother_income_1').show();
            $('#mother_income_2').show();
        }
    }
    
     function verifiyMotherPassedaway() {
         if ($('#MothersAlive').is(":checked")){
           
            $('#MotherAlive_row_1').hide();
            $('#MotherAlive_row_2').hide();
        } else {
            $('#MotherAlive_row_1').show();
            $('#MotherAlive_row_2').show();
        }
    }
    
    
function print_sister_counts() {      
        var n_brothers = $('#NumberofSisters').val();
        if (n_brothers=='NS001') {
             $('#elderSister').hide();
             $('#youngerSister').hide();
             $('#marriedSister').hide();
        } else {
            $('#elderSister').show();
            $('#youngerSister').show();
            $('#marriedSister').show();
           
           var c = ['NS001','NS002','NS003','NS004','NS005','NS006','NS007','NS008','NS009','NS010'] ;
          
          $('#elderSister').find('option').remove();
          $('#youngerSister').find('option').remove();
          $('#marriedSister').find('option').remove();
                 
            for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    document.getElementById('elderSister').appendChild(opt);
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
   
    document.getElementById('youngerSister').appendChild(opt);
    
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    
    document.getElementById('marriedSister').appendChild(opt);
}
        }
        
    }
    
function print_brother_counts() {
    var n_brothers = $('#NumberofBrother').val();
        if (n_brothers=='NOB001') {
             $('#belder').hide();
             $('#byounger').hide();
             $('#married').hide();
        } else {
            $('#belder').show();
            $('#byounger').show();
            $('#married').show();
           
           var c = ['NOB001','NOB002','NOB003','NOB004','NOB005','NOB006','NOB007','NOB008','NOB009','NOB010'] ;
          
          $('#belder').find('option').remove();
          $('#byounger').find('option').remove();
          $('#married').find('option').remove();
                 
            for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    document.getElementById('belder').appendChild(opt);
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
   
    document.getElementById('byounger').appendChild(opt);
    
}

  for (var i = 0; i<=c.indexOf(n_brothers); i++){
    var opt = document.createElement('option');
    opt.value = c[i];
    opt.innerHTML = i;
    
    document.getElementById('married').appendChild(opt);
}
        }
        
    }