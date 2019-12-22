function VisitedWelcomeMsg() {
         $('#FranchiseeWelcome').modal('hide'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=VisitedWelcomeMsg", 
                        success: function(result2){
                           FCheckVerification();
                               
                        }
                    });
    }
   
    function MobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Franchisee&a=MobileNumberVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
    function ChangeMobileNumberF() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=ChangeMobileNumber", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
    function EmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Franchisee&a=EmailVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    ); 
    }  
    
    function ChangeEmailID() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Franchisee&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
    function FCheckVerification() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
          
        $.ajax({
                        url: API_URL + "m=Franchisee&a=CheckVerification", 
                        success: function(result2){
                            var v = $.trim(result2).length;
                            if (parseInt(v)>0) {    
                                $('#Mobile_VerificationBody').html(result2);
                            } else {
                                setTimeout(function(){
                                  $('#myModal').modal('hide');  
                                },1000);
                            }
                        }
                    });
    } 
   /* function MobileNumberOTPVerification(frmid) {
         
         $('#errormsg').html("");
         if ($.trim($("#mobile_otp_2").val()).length!=4){
         $('#errormsg').html("Verification code is invalid");
         return false;
         }                       
                         
         var param = $( "#"+frmid).serialize();
         $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
                    $.post(API_URL+"m=Franchisee&a=MobileNumberOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }       */
    function MobileNumberOTPVerification(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Franchisee&a=MobileNumberOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    function EmailOTPVerification(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Franchisee&a=EmailOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
  /*   function EmailOTPVerification(frmid1) {
         
         $('#errormsg').html("");
         if ($.trim($("#email_otp").val()).length!=4){
         $('#errormsg').html("Verification code is invalid");
         return false;
         }
         
         var param = $( "#"+frmid1).serialize();
         $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
                    $.post(API_URL+"m=Franchisee&a=EmailOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }   */
     function ResendMobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Franchisee&a=ResendMobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    function ResendEmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(API_URL + "m=Franchisee&a=ResendEmailVerificationForm", param,function(result2) { $('#Mobile_VerificationBody').html(result2); });
    }