function VisitedWelcomeMsg() {
         $('#FranchiseeWelcome').modal('hide'); 
        $.ajax({
                        url: getAppUrl() + "m=Franchisee&a=VisitedWelcomeMsg", 
                        success: function(result2){
                           FCheckVerification();
                               
                        }
                    });
    }
  
    function TransactionPasswordScreen(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Franchisee&a=TransactionPasswordScreen", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            });  
    }
	function MobileNumberVerificationForm(frmid1) {
		 if($("#new_mobile_number").length) {
        $("#frmMobileNoVerification_error").html("&nbsp;");
		 if ($("#new_mobile_number").val().trim()=="") {
			 $("#frmMobileNoVerification_error").html("Please enter new mobile number");
			 return false;
		 }
		}
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Franchisee&a=MobileNumberVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
	function AddTransactionPassword(frmid1) {
        $("#frmTxnPass_error").html("&nbsp;");
		 if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
		if ($("#ConfirmTransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter comfirm transaction password");
			 return false;
		 }
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Franchisee&a=AddTransactionPassword", 
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
                        url: getAppUrl() + "m=Franchisee&a=ChangeMobileNumber", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
    function EmailVerificationForm(frmid1) {
		if($("#new_email").length) {
        $("#frmEmailIDVerification_error").html("&nbsp;");
		 if ($("#new_email").val().trim()=="") {
			 $("#frmEmailIDVerification_error").html("Please enter new email id");
			 return false;
		 }
		}
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Franchisee&a=EmailVerificationForm", 
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
                        url: getAppUrl() + "m=Franchisee&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
    
	 function getAppUrl() {
	   return API_URL + "rndval="+Math.floor(Math.random() * 10001) +"&";
   }
   
    function FCheckVerification() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
          
        $.ajax({
                        url: getAppUrl() + "m=Franchisee&a=CheckVerification" , 
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
   
    function MobileNumberOTPVerification(frmid1) {
        $("#frmMobileNoVerification_error").html("&nbsp;");
		 if ($("#mobile_otp_2").val().trim()=="") {
			 $("#frmMobileNoVerification_error").html("Please enter verification code");
			 return false;
		 }
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Franchisee&a=MobileNumberOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    function EmailOTPVerification(frmid1) {
        $("#frmEmailIDVerification_error").html("&nbsp;");
		 if ($("#email_otp").val().trim()=="") {
			 $("#frmEmailIDVerification_error").html("Please enter verification code");
			 return false;
		 }
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Franchisee&a=EmailOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
  
     function ResendMobileNumberVerificationForm(frmid1) {
        $("#frmMobileNoVerification_error").html("&nbsp;");
		 if ($("#mobile_otp_2").val().trim()=="") {
			 $("#frmMobileNoVerification_error").html("Please enter verification code");
			 return false;
		 }
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Franchisee&a=ResendMobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }
    function ResendEmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Franchisee&a=ResendEmailVerificationForm", param,function(result2) { $('#Mobile_VerificationBody').html(result2); });
    }
	
	
	// function  url, success, failure 