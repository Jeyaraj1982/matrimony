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
