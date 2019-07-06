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
        
        $('#Mobile_VerificationBody').html(preloader");
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