function CreateModal(modelHeight,modelWidth) {
    var modalBoxID = "div_" + Math.random().toString(36).substr(2,5 );
    var m ='<div class="modal" id="'+modalBoxID+'" data-backdrop="static" >'
            + '<div class="modal-dialog" >'
                + '<div class="modal-content" id="'+modalBoxID+'_body"  style="max-height: '+modelHeight+'px;;min-height: '+modelWidth+'px;" >'
            + '</div>'
        + '</div>'
    + '</div>';
    $( "body" ).append( m );
    return modalBoxID;
}
function VisitedWelcomeMsg() {
         $('#FranchiseeWelcome').modal('hide'); 
        $.ajax({
                        url: getAppUrl() + "m=Franchisee&a=VisitedWelcomeMsg", 
                        success: function(result2){
                           //FCheckVerification();
                               
                        }
                    });
    }
  
    function ChangePasswordScreen(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135px"));
		
		$('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Franchisee&a=ChangePasswordScreen", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            });  
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
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Franchisee&a=ChangeNewPassword", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
	function TransactionPasswordScreen(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135"));
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
        $("#frmCTxnPass_error").html("&nbsp;");
        
		 ErrorCount =0;
		 
		 if ($("#TransactionPassword").val().trim() =="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 ErrorCount++;
		 }
		/* if ($("#TransactionPassword").val().trim() <6 || ("#TransactionPassword").val().trim()>20) {
			 $("#frmTxnPass_error").html("Passwords do not match");
			 ErrorCount++;
		 }*/
		 if ($("#ConfirmTransactionPassword").val().trim() =="") {
			 $("#frmCTxnPass_error").html("Please enter confirm transaction password");
			 ErrorCount++;
		 }
		 if ($("#ConfirmTransactionPassword").val().trim() != $("#TransactionPassword").val().trim()) {
			 $("#frmCTxnPass_error").html("Passwords do not match");
			 ErrorCount++;
		 }
          if(ErrorCount>0){ 
            return false;
         }
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135"));
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
	
	
	var FranchiseeStaff = { 
	
		ConfirmCreateFranchiseeStaff:function() {
        if (SubmitNewStaff()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for create franchisee staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                          + '</div>'
                          + '<div class="modal-body">'
                            + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                + '<div class="col-sm-4">'
                                    + '<img src="'+ImgUrl+'icons/franchisee_icon.png" width="128px">' 
                                + '</div>'
                                + '<div class="col-sm-8"><br>'
                                    + '<div class="form-group row">'
                                        +'<div class="col-sm-12">Are you sure want create franchisee staff</div>'
                                    + '</div>'
                                + '</div>'
                            +  '</div>'                    
                          + '</div>' 
                          + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordCreatFrStf()" style="font-family:roboto">Create Franchisee</button>'
                          + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
    },
	
	GetTxnPasswordCreatFrStf:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create franchisee staff</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                        + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
									+ '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
								+ '</div>'
                                + '<div class="col-sm-2"></div>'
							+ '</div>'
                        + '</div>'
                      + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="FranchiseeStaff.CreateFranchiseeStaff()" class="btn btn-primary" >Create Staff</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },
	CreateFranchiseeStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Creating Franchisee Staff ...","95"));
        $.post(getAppUrl() + "m=Franchisee&a=CreateFranchiseeStaff",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Franchisee Staff Created</h3>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Staff Code:' + data.StaffCode+'</h5>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Franchisee Staff</h4>'
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
    },
	ConfirmGotoBackFromCreateFrStaff:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel create franchisee</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Staffs/ManageStaffs" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	ConfirmationfrEditFrStf:function(StaffCode) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
						+ '<h4 class="modal-title">Confirmation for Edit</h4>'
						+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
					+ '</div>'
					+ '<div class="modal-body">'
						+'<div class="col-sm-12">Are you sure want to Edit</div>'
					+ '</div>' 
					+ '<div class="modal-footer">'
						+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<a href="'+AppUrl+'Staffs/Edit/'+StaffCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
					+ '</div>';
            $('#Publish_body').html(content);
	 
     },
	 
	 ConfirmEditFranchiseeStaff:function() {
	 
	if(SubmitNewStaff) {
            $('#PubplishNow').modal('show'); 
			var user_alert="";
			if ($('#MobileNumber').val()!=$('#MobileNumber').attr("OldValue")) {
			user_alert = "You have changed mobile number"	;
			}
			
			if ($('#EmailID').val()!=$('#EmailID').attr("OldValue")) {
			user_alert += ((user_alert!="")  ? "<br>" : "") + "You have changed email id";
			}
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit franchisee staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want edit franchisee<br>'
											+ user_alert  
											+'</div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordEditFrstaff()" style="font-family:roboto">Update Franchisee</button>'
                           + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
	 },
	 
	GetTxnPasswordEditFrstaff:function() {
	var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit franchisee staff</h4>'
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
                                + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="FranchiseeStaff.EditFranchiseeStaff()" style="font-family:roboto">Update Franchisee</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },

    EditFranchiseeStaff:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Updating Franchisee Staff ...","95"));
        $.post(API_URL + "m=Franchisee&a=EditFranchiseeStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Franchisee Staff Information Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Franchisee Staff</h4>'
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
    },
	
	ConfirmGotoBackFromEditFrStaff:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from Edit franchisee staff</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Staffs/ManageStaffs" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	
	ConfirmDeactiveFrStaff:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for deactive franchisee staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want deactive franchisee staff<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordDeactiveFrstaff()" style="font-family:roboto">Yes ,Deactive</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
		
	GetTxnPasswordDeactiveFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for deactive franchisee staff</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.DeactiveFranchiseeStaff()" style="font-family:roboto">Yes ,Deactive</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
	
	DeactiveFranchiseeStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Deactivate ...","95"));
        $.post(API_URL + "m=Franchisee&a=DeactiveFranchiseeStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Deactivated Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Deactive Franchisee Staff</h4>'
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
    },
	
	ConfirmActiveFrStaff:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for active franchisee staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want active franchisee staff<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordActiveFrstaff()" style="font-family:roboto">Yes ,Active</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
		
	GetTxnPasswordActiveFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for active franchisee staff</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.ActiveFranchiseeStaff()" style="font-family:roboto">Yes ,Active</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
	
	ActiveFranchiseeStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Franchisee&a=ActiveFranchiseeStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Activated Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Active Franchisee Staff</h4>'
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
    },
	
	ConfirmFrStaffChnPswd:function() {
		$('#ChnPswdNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for change password</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to change password<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordChnPswdFrstaff()" style="font-family:roboto">Yes ,Change</button>'
                           + '</div>';
            $('#ChnPswd_body').html(content);
     },
		
	GetTxnPasswordChnPswdFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for change password</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
						+ '<div class="row">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8"><h6>Please Enter New Password</h4></div>'
                        + '</div>'
                        + '<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="NewPassword" name="NewPassword" Placeholder="Enter New Password" style="font-weight: normal;font-size: 13px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
							+ '<div class="col-sm-12" id="frmNewPass_error" style="color:red;text-align:center">&nbsp;</div>'
                        + '</div>'
						+ '<div class="row">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8"><h6>Please Enter Confirm New Password</h4></div>'
                        + '</div>'
						+'<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="ConfirmNewPassword" name="ConfirmNewPassword" Placeholder="Enter Confirm New Password" style="font-weight: normal;font-size: 13px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
							+ '<div class="col-sm-12" id="frmCnfmPass_error" style="color:red;text-align:center">&nbsp;</div>'
                        + '</div>'
						+ '<div class="row">'
							+ '<div class="col-sm-2"></div>'
							+ '<div class="col-sm-8" style="padding-left: 15px;">'
								+ '<div class="custom-control custom-checkbox mb-3">'
									+ '<input type="checkbox" class="custom-control-input" id="PasswordFstLogin" name="PasswordFstLogin">'
									+ '<label class="custom-control-label" for="PasswordFstLogin" style="font-weight:normal;margin-top: 2px;">&nbsp;Change password on first login</label>'
								+ '</div>'
							+ '</div>'
							+ '<div class="col-sm-2"></div>'
						+ '</div>'
						+'<div style="background: #f1f1f1;padding: 5px 5px 22px 5px;">'
								+'<div class="">'
								+ '<h6 style="text-align:center;">Please Enter Your Transaction Password</h4>'
								+ '<div class="input-group">'
									+ '<div class="col-sm-2"></div>'
									+ '<div class="col-sm-8">'
										+ '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" Placeholder="Transaction Password" style="font-weight: normal;font-size: 13px;text-align: center;font-family:Roboto;">'
									+ '</div>'
									+ '<div class="col-sm-2"></div>'
								+ '</div>'
								+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center">&nbsp;</div>'
							+ '</div>' 
                        + '</div>' 
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffChnPswd()" style="font-family:roboto">Yes ,Change</button>'
					+ '</div>';
        $('#ChnPswd_body').html(content);            
    },
	
	FranchiseeStaffChnPswd:function() {
		$("#frmNewPass_error").html("");
		$("#frmCnfmPass_error").html("");
		$("#frmTxnPass_error").html("");
		var Error =0;
		if ($("#NewPassword").val().trim()=="") {
			 $("#frmNewPass_error").html("Please enter new password");
			Error++;
		 }
		 if ($("#ConfirmNewPassword").val().trim()=="") {
			 $("#frmCnfmPass_error").html("Please enter confirm new password");
			 Error++;
		 }
		 if ($("#ConfirmNewPassword").val().trim() != $("#NewPassword").val().trim()) {
			 $("#frmCnfmPass_error").html("Passwords do not match");
			 Error++;
		 }
		 if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 Error++;
		 }
		 if(Error>0){ 
			return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
	$("#NewPswd").val($("#NewPassword").val());
	$("#ConfirmNewPswd").val($("#ConfirmNewPassword").val());
	$("#ChnPswdFstLogin").val($("#PasswordFstLogin").val());
        var param = $("#frmfrn").serialize();
        $('#ChnPswd_body').html(preloading_withText("Change Password...","161"));
		$.post(API_URL + "m=Franchisee&a=FranchiseeStaffChnPswd",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#ChnPswd_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 78px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Password Changed Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#ChnPswd_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Change Password</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#ChnPswd_body').html(content);
            }
        });
    },
	
	ConfirmFrStaffResetTxnPswd:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for reset transaction password</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to reset transaction password<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordResetTxnPswdFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
		
	GetTxnPasswordResetTxnPswdFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reset transaction password</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.ResetTxnPswdFranchiseeStaff()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
	
	ResetTxnPswdFranchiseeStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Reset ...","95"));
        $.post(API_URL + "m=Franchisee&a=ResetTxnPswdFranchiseeStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Transaction Password Reset Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reset Transaction Password</h4>'
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
    },
	ConfirmDeleteFrStaff:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for delete franchisee staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to delete franchisee staff<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordDeleteFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
		
	GetTxnPasswordDeleteFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for delete franchisee staff</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.DeleteFranchiseeStaff()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
	
	DeleteFranchiseeStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Delete ...","95"));
        $.post(API_URL + "m=Franchisee&a=DeleteFranchiseeStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Deleted Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Delete Franchisee Staff</h4>'
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
    },
	ConfirmFrStaffMobileVerified:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for mobile number verification</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to mobile number verification<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordMobVerificationFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
	},
	GetTxnPasswordMobVerificationFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for mobile number verification</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffMobverification()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);   
	},
	FranchiseeStaffMobverification:function(){
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Franchisee&a=FranchiseeStaffMobVerification",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Mobile Number Verified Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Franchisee Staff Mobile Number</h4>'
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
    },
	ConfirmFrStaffEmailVerified:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for email verification</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to email verification<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordEmailVerificationFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
	},
	GetTxnPasswordEmailVerificationFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for email verification</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffEmailverification()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);   
	},
	FranchiseeStaffEmailverification:function(){
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Franchisee&a=FranchiseeStaffEmailverification",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Email Verified Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Franchisee Staff Email</h4>'
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
    },
	ConfirmFrStaffChnPswdFstLogin:function() {
		$('#PubplishNow').modal('show'); 
			var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for Change password in first login</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want to change password in first login<br></div>'
										+'</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordChnPswdFrFstLoginFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
	},
	GetTxnPasswordChnPswdFrFstLoginFrstaff:function() {
		var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for change password in first login</h4>'
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
							+ '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffChnPswdFstLogin()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);   
	},
	FranchiseeStaffChnPswdFstLogin:function(){
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Franchisee&a=FranchiseeStaffChnPswdFstLogin",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Franchisee Staff Change Password in First Login</h4>'
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
	
	}
var Member = {
	GetTxnPasswordViewMemberEditScreen:function(MemberCode) {
		$('#PubplishNow').modal('show'); 
        var content =     '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit member</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                            + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="Member.ViewMemberEditScreen(\''+MemberCode+'\')" class="btn btn-primary">Continue</button>'
                        + '</div>';
                $('#Publish_body').html(content);         
    },
    ViewMemberEditScreen:function(MemberCode) {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
	$("#txnPassword_"+MemberCode).val($("#TransactionPassword").val());
     
	 var param = $("#frmfrn_"+MemberCode).serialize();
        $('#Publish_body').html(preloading_withText("Updating Member ...","95"));
        $.post(API_URL + "m=Franchisee&a=ViewMemberEditScreen",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                $('#Publish_body').html(result);
                return ;
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
    },
	ConfirmEditMember:function() {
     if(SubmitNewMember()) {
     $('#PubplishNow').modal('show'); 
      var user_alert="";
            if ($('#MobileNumber').val()!=$('#MobileNumber').attr("OldValue")) {
            user_alert = "You have changed mobile number"    ;
            }
            
            if ($('#EmailID').val()!=$('#EmailID').attr("OldValue")) {
            user_alert += ((user_alert!="")  ? "<br>" : "") + "You have changed email id";
            }
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit member</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit member</div>'
                                     + user_alert 
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" onclick="Member.GetTxnPassword()" style="font-family:roboto">Update Member</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     } else {
            return false;
     }
    },
    GetTxnPassword:function() {
        var content =     '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit member</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div class="form-group" style="text-align:center">'
                                + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                                + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                            + '</div>'
                            + '<div class="form-group">'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="Member.EditMember()" class="btn btn-primary">Update Member</button>'
                        + '</div>';
                $('#Publish_body').html(content);            
    },
    EditMember:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmfrn").serialize();
    $('#Publish_body').html(preloading_withText("Update Member ...","95"));
        $.post(getAppUrl() + "m=Franchisee&a=EditMember",param,function(result) {
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
    },
    ConfirmGotoBackFromEditMember:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from edit member</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Members/ManageMembers" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	GetTxnPasswordViewMember:function(MemberCode) {
		$('#PubplishNow').modal('show'); 
	var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for view member</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="Member.ViewMemberScreen(\''+MemberCode+'\')" style="font-family:roboto">Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
    ViewMemberScreen:function(MemberCode) {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
	$("#txnPassword_"+MemberCode).val($("#TransactionPassword").val());
     
	 var param = $("#frmfrn_"+MemberCode).serialize();
        $('#Publish_body').html(preloading_withText("Updating Member ...","95"));
        $.post(API_URL + "m=Franchisee&a=ViewMemberScreen",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                $('#Publish_body').html(result);
                return ;
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
    },
    GetTxnPasswordTransferAmoutTomemberFromFranchisee:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for transfer amount</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="Member.FranchiseeTransferAmountToMemberWallet()" style="font-family:roboto">Yes ,Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    FranchiseeTransferAmountToMemberWallet:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","95"));
        $.post(API_URL + "m=Franchisee&a=FranchiseeTransferAmountToMemberWallet",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Transfered Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Transfer amount</h4>'
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
    },
    ConfirmMemberChnPswd:function() {
        var mBox = CreateModal(462,462);
        $('#'+mBox).modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for change password</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to change password<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordChnPswdFrFranchisee(\''+mBox+'\')" style="font-family:roboto">Yes ,Change</button>'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
    },
    GetTxnPasswordChnPswdFrFranchisee:function(mBox) {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for change password</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="row">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8"><h6>Please Enter New Password</h4></div>'
                        + '</div>'
                        + '<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="'+mBox+'NewPassword" name="NewPassword" Placeholder="Enter New Password" style="font-weight: normal;font-size: 13px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="'+mBox+'frmNewPass_error" style="color:red;text-align:center">&nbsp;</div>'
                        + '</div>'
                        + '<div class="row">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8"><h6>Please Enter Confirm New Password</h4></div>'
                        + '</div>'
                        +'<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="'+mBox+'ConfirmNewPassword" name="ConfirmNewPassword" Placeholder="Enter Confirm New Password" style="font-weight: normal;font-size: 13px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="'+mBox+'frmCnfmPass_error" style="color:red;text-align:center">&nbsp;</div>'
                        + '</div>'
                        + '<div class="row">'
                            + '<div class="col-sm-2"></div>'
                            + '<div class="col-sm-8" style="padding-left: 15px;">'
                                + '<div class="custom-control custom-checkbox mb-3">'
                                    + '<input type="checkbox" class="custom-control-input" id="'+mBox+'PasswordFstLogin" name="PasswordFstLogin">'
                                    + '<label class="custom-control-label" for="PasswordFstLogin" style="font-weight:normal;margin-top: 2px;">&nbsp;Change password on first login</label>'
                                + '</div>'
                            + '</div>'
                            + '<div class="col-sm-2"></div>'
                        + '</div>'
                        +'<div style="background: #f1f1f1;padding: 5px 5px 22px 5px;">'
                                +'<div class="">'
                                + '<h6 style="text-align:center;">Please Enter Your Transaction Password</h4>'
                                + '<div class="input-group">'
                                    + '<div class="col-sm-2"></div>'
                                    + '<div class="col-sm-8">'
                                        + '<input type="password"  class="form-control" id="'+mBox+'TransactionPassword" name="TransactionPassword" Placeholder="Transaction Password" style="font-weight: normal;font-size: 13px;text-align: center;font-family:Roboto;">'
                                    + '</div>'
                                    + '<div class="col-sm-2"></div>'
                                + '</div>'
                                + '<div class="col-sm-12" id="'+mBox+'frmTxnPass_error" style="color:red;text-align:center">&nbsp;</div>'
                            + '</div>' 
                        + '</div>' 
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.MemberChnPswd(\''+mBox+'\')" style="font-family:roboto">Yes ,Change</button>'
                    + '</div>';
        $('#'+mBox+'_body').html(content);            
    },
    MemberChnPswd:function(mBox) {
        $("#"+mBox+"frmNewPass_error").html("");
        $("#"+mBox+"frmCnfmPass_error").html("");
        $("#"+mBox+"frmTxnPass_error").html("");
        var Error =0;
        if ($("#"+mBox+"NewPassword").val().trim()=="") {
             $("#"+mBox+"frmNewPass_error").html("Please enter new password");
            Error++;
         }
         if ($("#"+mBox+"ConfirmNewPassword").val().trim()=="") {
             $("#"+mBox+"frmCnfmPass_error").html("Please enter confirm new password");
             Error++;
         }
         if ($("#"+mBox+"ConfirmNewPassword").val().trim() != $("#"+mBox+"NewPassword").val().trim()) {
             $("#"+mBox+"frmCnfmPass_error").html("Passwords do not match");
             Error++;
         }
         if ($("#"+mBox+"TransactionPassword").val().trim()=="") {
             $("#"+mBox+"frmTxnPass_error").html("Please enter transaction password");
             Error++;
         }
         if(Error>0){ 
            return false;
         }
    $("#txnPassword").val($("#"+mBox+"TransactionPassword").val());
    $("#NewPswd").val($("#"+mBox+"NewPassword").val());
    $("#ConfirmNewPswd").val($("#"+mBox+"ConfirmNewPassword").val());
    $("#ChnPswdFstLogin").val($("#"+mBox+"PasswordFstLogin").val());
        var param = $("#frmfrn").serialize();
        $('#'+mBox+'_body').html(preloading_withText("Change Password...","161"));
        $.post(getAppUrl() + "m=Franchisee&a=MemberChnPswd",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#'+mBox+'_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 78px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Password Changed Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#'+mBox+'_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Change Password</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#'+mBox+'_body').html(content);
            }
        });
    },
    ConfirmResetPassword:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for reset password</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to reset password</div>'
                                        + '</div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordResetMemberPassword()" style="font-family:roboto">Yes , Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
     GetTxnPasswordResetMemberPassword:function() {
         
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reset password</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.ResetMemberPassword()" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    ResetMemberPassword:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Franchisee&a=ResetMemberPassword",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Reset Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reset member password</h4>'
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
    },
    ShowMemberCurrentPlan:function(PlanCode,PlanName,Duration,Amount,FreeProfiles,StartingDate,EndingDate) {
        var mBox = CreateModal(462,462);
        $('#'+mBox).modal('show'); 
         if (Amount == "0") {
             var PlanAmount = '<a href="javascript:void(0)" class="btn btn-primary">Upgrade Plan</a>';
            }else { 
             var  PlanAmount = "Amount (Rs)  "+Amount; 
            }
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Current Plan Information</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">' 
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Plan Code</div>'
                                    +'<div class="col-sm-8">'+PlanCode+'</div>'
                                +'</div>'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Plan Name</div>'
                                    +'<div class="col-sm-8">'+PlanName+'</div>'
                                +'</div>'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Duration</div>'
                                    +'<div class="col-sm-8">'+Duration+' days</div>'
                                +'</div>'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Allow To Purchase</div>'
                                    +'<div class="col-sm-8">'+FreeProfiles+' Profiles</div>'
                                +'</div>'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Starting Date</div>'
                                    +'<div class="col-sm-8">'+StartingDate+'</div>'
                                +'</div>'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Ending Date</div>'
                                    +'<div class="col-sm-8">'+EndingDate+'</div>'
                                +'</div>'
                                   +'<div class="form-group row">'
                                    +'<div class="col-sm-12">'+PlanAmount+'</div>'
                                +'</div>'
                           +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
     },
    ConfirmResetMobileNumber:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for reset mobile number</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to reset mobile number</div>'
                                        + '</div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordResetMemberMobileNumber()" style="font-family:roboto">Yes , Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordResetMemberMobileNumber:function() {
         
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reset mobile number</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.ResetMemberMobileNumber()" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    ResetMemberMobileNumber:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Franchisee&a=ResetMemberMobileNumber",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Reset Mobile Number Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reset mobile number</h4>'
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
    },
    ConfirmResetEmailID:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for reset email id</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to reset email id</div>'
                                        + '</div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordResetMemberEmailID()" style="font-family:roboto">Yes , Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordResetMemberEmailID:function() {
         
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for reset email id</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.ResetMemberEmailID()" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    ResetMemberEmailID:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Franchisee&a=ResetMemberEmailID",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Reset Email ID Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Reset email id</h4>'
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
    
};
function ConfirmFrTransferAmountToMemberFromFranchisee() {
        if(SubmitDetails()) {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for transfer amount to member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to transfer amount<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="Member.GetTxnPasswordTransferAmoutTomemberFromFranchisee()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
        }  else {
            return false;
     }
     }