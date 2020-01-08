var Franchisee = { 

    ConfirmCreateFranchisee:function() {
        if (Franchisee.SubmitNewFranchisee()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for create franchisee</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                          + '</div>'
                          + '<div class="modal-body">'
                            + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                + '<div class="col-sm-4">'
                                    + '<img src="'+ImgUrl+'icons/franchisee_icon.png" width="128px">' 
                                + '</div>'
                                + '<div class="col-sm-8"><br>'
                                    + '<div class="form-group row">'
                                        +'<div class="col-sm-12">Are you sure want create franchisee</div>'
                                    + '</div>'
                                + '</div>'
                            +  '</div>'                    
                          + '</div>' 
                          + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="Franchisee.GetTxnPassword()" style="font-family:roboto">Create Franchisee</button>'
                          + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
    }, 
    
    GetTxnPassword:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create franchisee</h4>'
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
                            + '<button type="button" onclick="Franchisee.CreateFranchisee()" class="btn btn-primary" >Create Franchisee</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateFranchisee:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }	
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Creating Franchisee ...","123"));
        $.post(API_URL + "m=Admin&a=CreateFranchisee",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Franchisee Created</h3>'
                                    + '<h5 style="text-align:center;color:#ada9a9">FranchiseeCode:' + data.FranchiseeCode+'</h5>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Franchisees/MangeFranchisees" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Franchisee</h4>'
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
	
    getStateNames:function(CountryCode,stateCode) {
        stateCode = (typeof stateCode !== 'undefined') ?  stateCode : "0";
        $('#StateName').empty().append('<option value="0">--Choose State Name--</option>');
        $('#DistrictName').empty().append('<option value="0">--Choose District Name--</option>');
		$("#ErrStateName").html("Please select State Name"); 
		$("#ErrDistrictName").html("Please select District Name"); 
		if(CountryCode !="0"){
		$.ajax({url: API_URL + "action=getStateNames&CountryCode="+CountryCode,success: function(result){
            var obj = JSON.parse(result.trim());
            $.when (
                $.each(obj, function () {
                    var opt = document.createElement('option');
                    opt.value = this.stcode;
                    opt.innerHTML = this.stname;
                    if (stateCode == opt.value) {
                        opt.setAttribute("Selected", "Selected");
                    }
                    document.getElementById('StateName').appendChild(opt);
                })
            ).then(function(){
                $('#StateName') .selectpicker('refresh');
                $('#DistrictName') .selectpicker('refresh');
            });
        }});
		} else {
		$("#ErrCountryName").html("Please select Country Name"); 	
		}
    },

    getDistrictNames:function(StateCode,distCode) {
        distCode = (typeof distCode !== 'undefined') ?  distCode : "0";
        $('#DistrictName').empty().append('<option value="0">--Choose District Name--</option>');     
		$("#ErrDistrictName").html("Please select District Name"); 
		if(StateCode !="0"){
			$("#ErrStateName").html(""); 
        $.ajax({url: API_URL + "action=getDistrictNames&StateCode="+StateCode, success: function(result){
                var obj = JSON.parse(result.trim());
                $.when(
                    $.each(obj, function () {
                        var opt = document.createElement('option');
                        opt.value = this.dtcode;
                        opt.innerHTML = this.dtname;
                         if (distCode == this.dtcode) {
                            opt.setAttribute("Selected", "Selected");
                        }
                        document.getElementById('DistrictName').appendChild(opt);
                    })
                ).then(function(){
                    $('#DistrictName') .selectpicker('refresh');
                });
        }});
		}else {
			$("#ErrStateName").html("Please select State Name");
		}
		
		if(distCode !="0"){
			$("#ErrDistrictName").html("");
		}
    },
    
    ConfirmEditFranchisee:function() {
        if(SubmitNewFranchisee()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit franchisee</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
									+ '<div class="col-sm-4">'
										+ '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
									+ '</div>'
									+ '<div class="col-sm-8"><br>'
										+ '<div class="form-group row">'
											+'<div class="col-sm-12">Are you sure want edit franchisee</div>'
										+ '</div>'
									+ '</div>'
								+ '</div>'
							+'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="Franchisee.GetTxnPasswordEditFranchisee()" style="font-family:roboto">Update Franchisee</button>'
                           + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
    },
    
	GetTxnPasswordEditFranchisee:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit franchisee staff</h4>'
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
						+ '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="Franchisee.EditFranchisee()" style="font-family:roboto">Update Franchisee</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
    },
	
    EditFranchisee:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Updating Franchisee ...","123"));
        $.post(API_URL + "m=Admin&a=EditFranchisee",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Franchisee Information Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Franchisees/MangeFranchisees" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Franchisee</h4>'
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
    
    ConfirmGotoBackFromCreateFranchisee:function() {
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
                        + '<a href="'+AppUrl+'Franchisees/MangeFranchisees" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
    ConfirmGotoBackFromEditFranchisee:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from Edit franchisee</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Franchisees/MangeFranchisees" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	SubmitNewFranchisee:function () {
                         $('#ErrFranchiseeCode').html("");
                         $('#ErrFranchiseeName').html("");
                         $('#ErrFranchiseeEmailID').html("");
                         $('#ErrBusinessMobileNumber').html("");
                         $('#ErrBusinessWhatsappNumber').html("");
                         $('#ErrBusinessLandlineNumber').html("");
                         $('#ErrLandlineStdCode').html("");
                         $('#ErrBusinessAddress1').html("");
                         $('#ErrBusinessAddress2').html("");
                         $('#ErrBusinessAddress3').html("");
                         $('#ErrLandmark').html("");
                         $('#ErrCityName').html("");
                         $('#ErrCountryName').html("");
                         $('#ErrStateName').html("");
                         $('#ErrDistrictName').html("");
                         $('#ErrPinCode').html("");
                         $('#ErrPlan').html("");
                         $('#ErrBankName').html("");
                         $('#ErrAccountName').html("");
                         $('#ErrAccountNumber').html("");
                         $('#ErrIFSCode').html("");
                         $('#ErrAccountType').html("");
                         $('#ErrPersonName').html("");
                         $('#ErrFatherName').html("");
                         $('#ErrSex').html("");
                         $('#ErrEmailID').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
						 $('#ErrAddress1').html("");
                         $('#ErrAddress2').html("");
                         $('#ErrAddress3').html("");
                         $('#ErrIDProof').html("");
                         $('#ErrIDProofNumber').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         
                         ErrorCount=0;
                        if (IsNonEmpty("FranchiseeCode","ErrFranchiseeCode","Please Enter Franchisee Code")) {
							$('html, body').animate({
							scrollTop: $("#FranchiseeCode").offset().top
							}, 2000);
                        IsAlphaNumeric("FranchiseeCode","ErrFranchiseeCode","Please Enter Alpha Numeric characters only");
						}
                        if (IsNonEmpty("FranchiseeName","ErrFranchiseeName","Please Enter Franchisee Name")) {
                        IsAlphabet("FranchiseeName","ErrFranchiseeName","Please Enter Alpha Numeric characters only");
                        }
                        if (IsNonEmpty("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter EmailID")) {
                            IsEmail("FranchiseeEmailID","ErrFranchiseeEmailID","Please Enter Valid EmailID");    
                        }
                        
                        if (IsNonEmpty("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("BusinessMobileNumber","ErrBusinessMobileNumber","Please Enter Valid MobileNumber");
                        }
                        
                        if ($('#BusinessWhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("BusinessWhatsappNumber","ErrBusinessWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        
                        if ($('#BusinessLandlineNumber').val().trim().length>0) {
                            IsNumeric("BusinessLandlineNumber","ErrBusinessLandlineNumber","Please Enter Valid Landline Number");
                            if (IsNonEmpty("LandlineStdCode","ErrLandlineStdCode","Please Enter Std code")) {
                            IsNumeric("LandlineStdCode","ErrLandlineStdCode","Please Enter Valid Std code");
                            }
                        }
                        
                        IsNonEmpty("BusinessAddress1","ErrBusinessAddress1","Please Enter Valid Address Line1");
                        
						if (IsNonEmpty("CityName","ErrCityName","Please Enter Valid City Name")) {
                        IsAlphabet("CityName","ErrCityName","Please Enter Alphabet Charactors only");
                        }
						IsNonEmpty("Landmark","ErrLandmark","Please Enter Landmark");
                        if (IsNonEmpty("PinCode","ErrPinCode","Please Enter Valid PinCode")) {
                        IsNumeric("PinCode","ErrPinCode","Please Enter Numeric Charactors only");
                        }
                        if (IsNonEmpty("AccountName","ErrAccountName","Please Enter Account Name")) {
                        IsAlphabet("AccountName","ErrAccountName","Please Enter Alpha Numeric Characters only");
                        }
                        if (IsNonEmpty("AccountNumber","ErrAccountNumber","Please Enter Account Number")) {
                        IsAlphaNumeric("AccountNumber","ErrAccountNumber","Please Enter Alpha Numeric Characters only");
                        }
						if (IsNonEmpty("IFSCode","ErrIFSCode","Please Enter Valid IFSCode")) {
                        IsAlphaNumeric("IFSCode","ErrIFSCode","Please Enter Alpha Numeric Characters only");
                        }
                        if (IsNonEmpty("PersonName","ErrPersonName","Please Enter Person Name")) {
                        IsAlphabet("PersonName","ErrPersonName","Please Enter Alphanumeric Charactors only");
                        }
                        if (IsNonEmpty("FatherName","ErrFatherName","Please Enter Father's Name")) {
                        IsAlphabet("FatherName","ErrFatherName","Please Enter Alphabet Charactors only");
                        }
                        
                        if (IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID");    
                        }
                        
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        
                        if ($('#WhatsappNumber').val().trim().length>0) {
                            IsWhatsappNumber("WhatsappNumber","ErrWhatsappNumber","Please Enter Valid Whatsapp Number");
                        }
                        IsNonEmpty("Address1","ErrAddress1","Please Enter Valid Address Line1");
                        IsNonEmpty("IDProofNumber","ErrIDProofNumber","Please Enter ID Proof Number");
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter Login Name")) {
                        IsAlphaNumerics("UserName","ErrUserName","Please Enter Alpha Numeric Character only");
                        }
                        if (IsNonEmpty("Password","ErrPassword","Please Enter Login Password")) {
                        IsAlphaNumeric("Password","ErrPassword","Alpha Numeric Characters only");
                        }
                        if ($("#CountryName").val() == "0") {
							$("#ErrCountryName").html("Please select Country Name");
							ErrorCount++;
						}
						if ($("#StateName").val() == "0") {
							$("#ErrStateName").html("Please select State Name");
							ErrorCount++;
						}
						if ($("#DistrictName").val() == "0") {
							$("#ErrDistrictName").html("Please select District Name");
							ErrorCount++;
						}
						if ($("#Plan").val() == "0") {
							$("#ErrPlan").html("Please select Plan");
							ErrorCount++;
						}
						if ($("#BankName").val() == "0") {
							$("#ErrBankName").html("Please select Bank Name");
							ErrorCount++;
						}
						if ($("#AccountType").val() == "0") {
							$("#ErrAccountType").html("Please Select Account Type");
							ErrorCount++;
						}
						if ($("#Sex").val() == "0") {
							$("#ErrSex").html("Please select Gender");
							ErrorCount++;
						}
						if ($("#IDProof").val() == "0") {
							$("#ErrIDProof").html("Please select ID Proof");
							ErrorCount++;
						}
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }
                 }
	
    
};

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
        $('#Publish_body').html(preloading_withText("Creating Franchisee Staff ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateFranchiseeStaff",param,function(result) {
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
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+data.FranchiseeCode+'.html" style="cursor:pointer">Continue</a></p>'
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
	ConfirmGotoBackFromCreateFrStaff:function(FranchiseeCode) {
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
                        + '<a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+FranchiseeCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
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
                        + '<a href="'+AppUrl+'Franchisees/FrStaffEdit/'+StaffCode+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
            $('#Publish_body').html(content);
     
     },
     
      ConfirmEditFranchiseeStaff:function() {
     
    if(SubmitNewStaff) {
            $('#PubplishNow').modal('show'); 
            var user_alert="";
            if ($('#MobileNumber').val()!=$('#MobileNumber').attr("OldValue")) {
            user_alert = "You have changed mobile number"    ;
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
        $('#Publish_body').html(preloading_withText("Updating Franchisee Staff ...","123"));
        $.post(API_URL + "m=Admin&a=EditFranchiseeStaff",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Franchisee Staff Information Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+data.FranchiseeCode+'.html" style="cursor:pointer">Continue</a></p>'
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
    ConfirmGotoBackFromEditFrStaff:function(FranchiseeCode) {
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
                        + '<a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+FranchiseeCode+'.html" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
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
        $('#Publish_body').html(preloading_withText("Deactivate ...","123"));
        $.post(API_URL + "m=Admin&a=DeactiveFranchiseeStaff",param,function(result) {
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
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(API_URL + "m=Admin&a=ActiveFranchiseeStaff",param,function(result) {
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
        $.post(API_URL + "m=Admin&a=FranchiseeStaffChnPswd",param,function(result) {
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
        $('#Publish_body').html(preloading_withText("Reset ...","123"));
		$.post(API_URL + "m=Admin&a=ResetTxnPswdFranchiseeStaff",param,function(result) {
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
        $('#Publish_body').html(preloading_withText("Delete ...","123"));
        $.post(API_URL + "m=Admin&a=DeleteFranchiseeStaff",param,function(result) {
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
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+data.FranchiseeCode+'.html" style="cursor:pointer">Continue</a></p>'
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
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(API_URL + "m=Admin&a=FranchiseeStaffMobVerification",param,function(result) {
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
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(API_URL + "m=Admin&a=FranchiseeStaffEmailverification",param,function(result) {
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
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(API_URL + "m=Admin&a=FranchiseeStaffChnPswdFstLogin",param,function(result) {
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
};

var Member ={
	ConfirmMemberChnPswd:function() {
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
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="Member.GetTxnPasswordChnPswdFrAdmin()" style="font-family:roboto">Yes ,Change</button>'
                           + '</div>';
            $('#ChnPswd_body').html(content);
    },
	GetTxnPasswordChnPswdFrAdmin:function() {
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="Member.MemberChnPswd()" style="font-family:roboto">Yes ,Change</button>'
                    + '</div>';
        $('#ChnPswd_body').html(content);            
    },
	MemberChnPswd:function() {
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
        $.post(API_URL + "m=Admin&a=MemberChnPswd",param,function(result) {
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
	ConfirmEditMember:function() {
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
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
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
                        + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="Member.GetTxnPassword()" style="font-family:roboto">Update Member</button>'
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
    $('#Publish_body').html(preloading_withText("Creating Franchisee ...","95"));
        $.post(API_URL + "m=Admin&a=EditMemberInfo",param,function(result) {
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
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Members/ManageMember" style="cursor:pointer">Continue</a></p>'
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
	
};

var AdminStaff = { 
    ConfirmationfrEditAdminStf:function(StaffCode) {
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
      
      ConfirmEditAdminStaff:function() {
     
    if(SubmitNewStaff) {
            $('#PubplishNow').modal('show'); 
            var user_alert="";
            if ($('#MobileNumber').val()!=$('#MobileNumber').attr("OldValue")) {
            user_alert = "You have changed mobile number"    ;
            }
            
            if ($('#EmailID').val()!=$('#EmailID').attr("OldValue")) {
            user_alert += ((user_alert!="")  ? "<br>" : "") + "You have changed email id";
            }
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit admin staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want edit staff<br>'
                                            + user_alert  
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordEditAdminstaff()" style="font-family:roboto">Update Staff</button>'
                           + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
     },
     GetTxnPasswordEditAdminstaff:function() {
    var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit admin staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" name="Update" class="btn btn-primary" onclick="AdminStaff.EditAdminStaff()" style="font-family:roboto">Update Staff</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
     EditAdminStaff:function() {
         if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Updating Admin Staff ...","95"));
        $.post(API_URL + "m=Admin&a=EditAdminStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Admin Staff Information Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/Edit/'+data.AdminCode+'.html" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Admin Staff</h4>'
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
    ConfirmGotoBackFromEditAdminStaff:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from Edit staff</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
    ConfirmDeactiveAdminStaff:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for deactive staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want deactive staff<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordDeactiveAdminstaff()" style="font-family:roboto">Yes ,Deactive</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
     GetTxnPasswordDeactiveAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for deactive staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.DeactiveAdminStaff()" style="font-family:roboto">Yes ,Deactive</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    DeactiveAdminStaff:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Deactivate ...","95"));
        $.post(API_URL + "m=Admin&a=DeactiveAdminStaff",param,function(result) {
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
                                    +'<h4 class="modal-title">Deactive Staff</h4>'
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
    ConfirmActiveAdminStaff:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for active staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want active staff<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordActiveAdminstaff()" style="font-family:roboto">Yes ,Active</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordActiveAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for active staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.ActiveAdminStaff()" style="font-family:roboto">Yes ,Active</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    
    ActiveAdminStaff:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Admin&a=ActiveAdminStaff",param,function(result) {
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
                                    +'<h4 class="modal-title">Active Staff</h4>'
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
    ConfirmAdminStaffChnPswd:function() {
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
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordChnPswdAdminstaff()" style="font-family:roboto">Yes ,Change</button>'
                           + '</div>';
            $('#ChnPswd_body').html(content);
     },
        
    GetTxnPasswordChnPswdAdminstaff:function() {
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.AdminStaffChnPswd()" style="font-family:roboto">Yes ,Change</button>'
                    + '</div>';
        $('#ChnPswd_body').html(content);            
    },
    
    AdminStaffChnPswd:function() {
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
        $.post(API_URL + "m=Admin&a=AdminStaffChnPswd",param,function(result) {
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
    ConfirmAdminStaffResetTxnPswd:function() {
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
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordResetTxnPswdAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordResetTxnPswdAdminstaff:function() {
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.ResetTxnPswdAdminStaff()" style="font-family:roboto">Yes ,Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    
    ResetTxnPswdAdminStaff:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Reset ...","95"));
        $.post(API_URL + "m=Admin&a=ResetTxnPswdAdminStaff",param,function(result) {
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
    ConfirmDeleteAdminStaff:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for delete staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to delete staff<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordDeleteAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordDeleteAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for delete staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.DeleteAdminStaff()" style="font-family:roboto">Yes ,Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    
    DeleteAdminStaff:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Delete ...","95"));
        $.post(API_URL + "m=Admin&a=DeleteADminStaff",param,function(result) {
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
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Delete Staff</h4>'
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
	ConfirmAdminStaffChnPswdFstLogin:function() {
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
                                + '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordChnPswdFrFstLoginAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
	},
	GetTxnPasswordChnPswdFrFstLoginAdminstaff:function() {
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
						+ '<button type="button" class="btn btn-primary" class="btn btn-primary" onclick="AdminStaff.AdminStaffChnPswdFstLogin()" style="font-family:roboto">Yes ,Continue</button>'
					+ '</div>';
        $('#Publish_body').html(content);   
	},
	AdminStaffChnPswdFstLogin:function(){
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		 }
	$("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","95"));
        $.post(API_URL + "m=Admin&a=AdminStaffChnPswdFstLogin",param,function(result) {
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
                                    +'<h4 class="modal-title">Admin Staff Change Password in First Login</h4>'
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

	function CheckVerification() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
          
        $.ajax({
                        url: getAppUrl() + "m=Admin&a=CheckVerification" , 
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
	function ChangePasswordScreen(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","135px"));
		
		$('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Admin&a=ChangePasswordScreen", 
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
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Admin&a=ChangeNewPassword", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
	function TransactionPasswordScreen(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Admin&a=TransactionPasswordScreen", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            });  
    }
	function AddTransactionPassword(frmid1) {
        $("#frmTxnPass_error").html("&nbsp;");
        $("#frmCTxnPass_error").html("&nbsp;");
        
		 ErrorCount =0;
		 
		 if ($("#TransactionPassword").val().trim() =="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 ErrorCount++;
		 }
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
        
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        
        $.post(getAppUrl() + "m=Admin&a=AddTransactionPassword", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
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
        
        $.post(getAppUrl() + "m=Admin&a=MobileNumberVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
	function ChangeMobileNumber() {
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
         $('#myModal').modal('show'); 
        $.ajax({
                        url: getAppUrl() + "m=Admin&a=ChangeMobileNumber", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
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
        $.post(getAppUrl() + "m=Admin&a=ResendMobileNumberVerificationForm",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
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
        $.post(getAppUrl() + "m=Admin&a=MobileNumberOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
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
        
        $.post(getAppUrl() + "m=Admin&a=EmailVerificationForm", 
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
                        url: getAppUrl() + "m=Admin&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
	function ResendEmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        $('#Mobile_VerificationBody').html(preloading_withText("Loading ...","200"));
        $('#myModal').modal('show'); 
        $.post(getAppUrl() + "m=Admin&a=ResendEmailVerificationForm", param,function(result2) { $('#Mobile_VerificationBody').html(result2); });
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
        $.post(getAppUrl() + "m=Admin&a=EmailOTPVerification",param,function(result2) {$('#Mobile_VerificationBody').html(result2);});
    }