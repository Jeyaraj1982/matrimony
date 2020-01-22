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
                            + '<button type="button" class="btn btn-primary" name="Create" onclick="Franchisee.GetTxnPassword()" style="font-family:roboto">Create Franchisee</button>'
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
        $.post(getAppUrl() + "m=Admin&a=CreateFranchisee",param,function(result) {
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
		$.ajax({url: getAppUrl() + "action=getStateNames&CountryCode="+CountryCode,success: function(result){
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
        $.ajax({url: getAppUrl() + "action=getDistrictNames&StateCode="+StateCode, success: function(result){
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
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="Franchisee.GetTxnPasswordEditFranchisee()" style="font-family:roboto">Update Franchisee</button>'
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
						+ '<button type="button" class="btn btn-primary" name="Create" onclick="Franchisee.EditFranchisee()" style="font-family:roboto">Update Franchisee</button>'
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
        $.post(getAppUrl() + "m=Admin&a=EditFranchisee",param,function(result) {
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
                        + '<a href="'+AppUrl+'Franchisees/MangeFranchisees" class="btn btn-primary" name="Create" style="font-family:roboto;color:white">Yes</a>'
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
                        + '<a href="'+AppUrl+'Franchisees/MangeFranchisees" class="btn btn-primary" name="Create" style="font-family:roboto;color:white">Yes</a>'
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
                            + '<button type="button" class="btn btn-primary" name="Create" onclick="FranchiseeStaff.GetTxnPasswordCreatFrStf()" style="font-family:roboto">Create Franchisee</button>'
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
                        + '<a href="'+AppUrl+'Franchisees/FranchiseeStaffs/'+FranchiseeCode+'.html" class="btn btn-primary" name="Create" style="font-family:roboto;color:white">Yes</a>'
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
                        + '<a href="'+AppUrl+'Franchisees/FrStaffEdit/'+StaffCode+'.html" class="btn btn-primary" name="Create" style="font-family:roboto;color:white">Yes</a>'
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
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="FranchiseeStaff.GetTxnPasswordEditFrstaff()" style="font-family:roboto">Update Franchisee</button>'
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
                        + '<button type="button" class="btn btn-primary" name="Update" onclick="FranchiseeStaff.EditFranchiseeStaff()" style="font-family:roboto">Update Franchisee</button>'
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
        $.post(getAppUrl() + "m=Admin&a=EditFranchiseeStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordDeactiveFrstaff()" style="font-family:roboto">Yes ,Deactive</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.DeactiveFranchiseeStaff()" style="font-family:roboto">Yes ,Deactive</button>'
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
        $.post(getAppUrl() + "m=Admin&a=DeactiveFranchiseeStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordActiveFrstaff()" style="font-family:roboto">Yes ,Active</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.ActiveFranchiseeStaff()" style="font-family:roboto">Yes ,Active</button>'
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
        $.post(getAppUrl() + "m=Admin&a=ActiveFranchiseeStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordChnPswdFrstaff()" style="font-family:roboto">Yes ,Change</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffChnPswd()" style="font-family:roboto">Yes ,Change</button>'
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
        $.post(getAppUrl() + "m=Admin&a=FranchiseeStaffChnPswd",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordResetTxnPswdFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.ResetTxnPswdFranchiseeStaff()" style="font-family:roboto">Yes ,Continue</button>'
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
		$.post(getAppUrl() + "m=Admin&a=ResetTxnPswdFranchiseeStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordDeleteFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.DeleteFranchiseeStaff()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=DeleteFranchiseeStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordMobVerificationFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffMobverification()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=FranchiseeStaffMobVerification",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordEmailVerificationFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffEmailverification()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=FranchiseeStaffEmailverification",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.GetTxnPasswordChnPswdFrFstLoginFrstaff()" style="font-family:roboto">Yes ,Continue</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="FranchiseeStaff.FranchiseeStaffChnPswdFstLogin()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=FranchiseeStaffChnPswdFstLogin",param,function(result) {
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

var Member ={
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
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordChnPswdFrAdmin(\''+mBox+'\')" style="font-family:roboto">Yes ,Change</button>'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
    },
	GetTxnPasswordChnPswdFrAdmin:function(mBox) {
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
        $.post(getAppUrl() + "m=Admin&a=MemberChnPswd",param,function(result) {
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
        $.post(getAppUrl() + "m=Admin&a=EditMemberInfo",param,function(result) {
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
                        + '<a href="'+AppUrl+'Members/ManageMember" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	ConfirmCreateMemberPlan:function() {
     if(SubmitNewPlan()) {
     $('#PubplishNow').modal('show'); 
      var content = ''
                    +''
                    +'<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for create plan</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to create member plan</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" onclick="Member.GetTxnPasswordfrCreateMemberPlan()" style="font-family:roboto">Create Plan</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     } else {
            return false;
     }
	},
	GetTxnPasswordfrCreateMemberPlan:function() {
		var content =     '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for create member plan</h4>'
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
							+ '<button type="button" onclick="Member.CreateMemberPlan()" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
	CreateMemberPlan:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmfrn").serialize();
    $('#Publish_body').html(preloading_withText("Creating Plan ...","95"));
        $.post(getAppUrl() + "m=Admin&a=CreateMemberPlan",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Member Plan Created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Members/Plan/ManagePlan" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Member Plan</h4>'
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
	ConfirmGotoBackFromCreatePlan:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from create member plan</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Members/Plan/ManagePlan" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	ConfirmEditMemberPlan:function() {
     if(SubmitNewPlan()) {
     $('#PubplishNow').modal('show'); 
      var content = ''
                    +''
                    +'<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit plan</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8"><br>'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want edit member plan</div>'
                                + '</div>'
                            + '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" name="Create" onclick="Member.GetTxnPasswordfrMemberPlan()" style="font-family:roboto">Update Plan</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     } else {
            return false;
     }
	},
	GetTxnPasswordfrMemberPlan:function() {
		var content =     '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for edit member plan</h4>'
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
							+ '<button type="button" onclick="Member.EditMemberPlan()" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
	EditMemberPlan:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
    var param = $("#frmfrn").serialize();
    $('#Publish_body').html(preloading_withText("Updating Plan ...","95"));
        $.post(getAppUrl() + "m=Admin&a=EditMemberPlan",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Member Plan Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Members/Plan/ManagePlan" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Member Plan</h4>'
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
	ConfirmGotoBackFromEditPlan:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from edit member plan</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Members/Plan/ManagePlan" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
	showConfirmDeleteDraftProfile:function(ProfileCode) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for delete</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to delete</div>'
                                + '</div><br>'
								+ 'Reason for Delete<br>'
								+ '<textarea class="form-control" rows="2" cols="3" id="DeleteRemarks_DraftProfile"></textarea>'
								+'<div class="col-sm-12" id="frmDeleteRemark_error" style="color:red;text-align:center"></div>'
							+ '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" name="Create" class="btn btn-danger" onclick="Member.GetTxnPswdfrDeleteDraftProfile(\''+ProfileCode+'\')" style="font-family:roboto">Yes, I want to delete</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
},
    GetTxnPswdfrDeleteDraftProfile:function(ProfileCode) {
		if ($("#DeleteRemarks_DraftProfile").val().trim()=="") {
             $("#frmDeleteRemark_error").html("Please enter reason");
             return false;
         }
		$("#DeleteProfileRemarks_"+ProfileCode).val($("#DeleteRemarks_DraftProfile").val());
		var content =   '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for delete</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group" style="text-align:center">'
								+ '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
								+ '<h4 style="text-align:center;color:#ada9a9;">Please Enter Your Transaction Password</h4>'
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
							+ '<button type="button" onclick="Member.DeleteMemberDraftProfile(\''+ProfileCode+'\')" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
    DeleteMemberDraftProfile:function(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
		 $("#frmTxnPass_error").html("Please enter transaction password");
		 return false;
	}
	
    $("#txnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=DeleteMemberDraftProfile",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">successfully Deleted.</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Delete Profile</h4>'
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
	showConfirmUnPublishProfile:function(ProfileCode) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for unpublish</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to unpublish this profile</div>'
                                + '</div><br>'
								+ 'Reason for Unpublish<br>'
								+ '<textarea class="form-control" rows="2" cols="3" id="UnpublishRemarks_Profile"></textarea>'
								+'<div class="col-sm-12" id="frmUnpublishRemark_error" style="color:red;text-align:center"></div>'
							+ '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" name="Create" class="btn btn-danger" onclick="Member.GetTxnPswdfrUnpublishProfile(\''+ProfileCode+'\')" style="font-family:roboto">Yes, I want to Unpublish</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
},
    GetTxnPswdfrUnpublishProfile:function(ProfileCode) {
		if ($("#UnpublishRemarks_Profile").val().trim()=="") {
             $("#frmUnpublishRemark_error").html("Please enter reason");
             return false;
         }
		$("#UnpublishProfileRemarks_"+ProfileCode).val($("#UnpublishRemarks_Profile").val());
		var content =   '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for unpublish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group" style="text-align:center">'
								+ '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
								+ '<h4 style="text-align:center;color:#ada9a9;">Please Enter Your Transaction Password</h4>'
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
							+ '<button type="button" onclick="Member.UnpublishMemberPublishProfile(\''+ProfileCode+'\')" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
    UnpublishMemberPublishProfile:function(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
		 $("#frmTxnPass_error").html("Please enter transaction password");
		 return false;
	}
	
    $("#txnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=UnpublishMemberPublishProfile",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Unpublished successfully.</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Unpublish Profile</h4>'
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
	showConfirmPublishProfile:function(ProfileCode) {
	$('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for publish</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="form-group row" style="margin:0px;">'
                            + '<div class="col-sm-4">'
                                + '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
                            + '</div>'
                            + '<div class="col-sm-8">'
                                + '<div class="form-group row">'
                                    +'<div class="col-sm-12">Are you sure want to publish this profile</div>'
                                + '</div><br>'
							+ '</div>'
                        +  '</div>'                    
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" name="Create" class="btn btn-primary" onclick="Member.GetTxnPswdfrPublishProfile(\''+ProfileCode+'\')" style="font-family:roboto">Yes, I want to Publish</button>'
                    + '</div>';
            $('#Publish_body').html(content);
     
},
    GetTxnPswdfrPublishProfile:function(ProfileCode) {
		var content =   '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for publish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group" style="text-align:center">'
								+ '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
								+ '<h4 style="text-align:center;color:#ada9a9;">Please Enter Your Transaction Password</h4>'
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
							+ '<button type="button" onclick="Member.PublishMemberPublishProfile(\''+ProfileCode+'\')" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
    PublishMemberPublishProfile:function(formid) {
 
if ($("#TransactionPassword").val().trim()=="") {
		 $("#frmTxnPass_error").html("Please enter transaction password");
		 return false;
	}
	
    $("#txnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("Activate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=PublishMemberPublishProfile",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Published successfully.</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Publish Profile</h4>'
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
    ConfirmDeactiveMember:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for deactive member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want deactive member<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordDeactiveMember()" style="font-family:roboto">Yes ,Deactive</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordDeactiveMember:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for deactive member</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="Member.DeactiveMember()" style="font-family:roboto">Yes ,Deactive</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    DeactiveMember:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Deactivate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=DeactiveMember",param,function(result) {
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
                                    +'<h4 class="modal-title">Deactive member</h4>'
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
    ConfirmActiveMember:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for active member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want active member<br></div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordActiveMember()" style="font-family:roboto">Yes ,Active</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordActiveMember:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for active member</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="Member.ActiveMember()" style="font-family:roboto">Yes ,Active</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    ActiveMember:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Deactivate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=ActiveMember",param,function(result) {
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
                                    +'<h4 class="modal-title">Active member</h4>'
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
    ConfirmDeleteMember:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for delete member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to delete</div>'
                                        + '</div>'
                                        + 'Reason for Delete<br>'
                                        + '<textarea class="form-control" rows="2" cols="3" id="DeletedReason"></textarea>'
                                        +'<div class="col-sm-12" id="frmDeletedReason_error" style="color:red;text-align:center"></div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-danger" onclick="Member.GetTxnPasswordDeleteMember()" style="font-family:roboto">Yes ,Delete</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordDeleteMember:function() {
         if ($("#DeletedReason").val().trim()=="") {
             $("#frmDeletedReason_error").html("Please enter reason for delete");
             return false;
         }
        $("#DeletedRemarks").val($("#DeletedReason").val());
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for delete member</h4>'
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
                        + '<button type="button" class="btn btn-danger" class="btn btn-primary" onclick="Member.DeleteMember()" style="font-family:roboto">Yes ,Delete</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    DeleteMember:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Deactivate ...","123"));
        $.post(getAppUrl() + "m=Admin&a=DeleteMember",param,function(result) {
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
                                    +'<h4 class="modal-title">Delete member</h4>'
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
    ConfirmRestoreMember:function() {
        $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for restore member</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                     + '<div class="col-sm-8">'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to restore</div>'
                                        + '</div>'
                                     + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordRestoreMember()" style="font-family:roboto">Yes ,Restore</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
    GetTxnPasswordRestoreMember:function() {
         
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for restore member</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="Member.RestoreMember()" style="font-family:roboto">Yes ,Restore</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    },
    RestoreMember:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Restore ...","123"));
        $.post(getAppUrl() + "m=Admin&a=RestoreMember",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Restored Successfully</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Restore member</h4>'
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
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordResetMemberPassword()" style="font-family:roboto">Yes ,Reset</button>'
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
        $.post(getAppUrl() + "m=Admin&a=ResetMemberPassword",param,function(result) {
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
    ConfirmSendIndividualSmsToMember:function(MemCode,MemName,Mob) {
        var mBox = CreateModal(360,360);
        $('#'+mBox).modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Send Individual sms</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Member Name</div>'
                                    +'<div class="col-sm-6">'+MemName+' ['+MemCode+']</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Mobile Number</div>'
                                    +'<div class="col-sm-6">'+Mob+'</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-12">Message</div>'
                                        +'<div class="col-sm-12">'
                                            + '<textarea class="form-control" rows="2" cols="3" id="'+mBox+'SendMessage"></textarea>'
                                        +'</div>'
                                    +'<div class="col-sm-12" id="'+mBox+'frmSendMessage_error" style="color:red;text-align:center"></div>'
                                 + '</div>'
                           +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordSendIndividualSmsToMember(\''+mBox+'\')" style="font-family:roboto">Send</button>'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
     },
    GetTxnPasswordSendIndividualSmsToMember:function(mBox) {
         if ($("#"+mBox+"SendMessage").val().trim()=="") {
             $("#"+mBox+"frmSendMessage_error").html("Please enter message");
             return false;
         }
        $("#SmsMessage").val($("#"+mBox+"SendMessage").val());
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Send Individual sms</h4>'
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
                                    + '<input type="password"  class="form-control" id="'+mBox+'TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="'+mBox+'frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.SendIndividualSmsToMember(\''+mBox+'\')" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#'+mBox+'_body').html(content);         
    },
    SendIndividualSmsToMember:function(mBox) {
        if ($("#"+mBox+"TransactionPassword").val().trim()=="") {
             $("#"+mBox+"frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#"+mBox+"TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#'+mBox+'_body').html(preloading_withText("Sending ...","123"));
        $.post(getAppUrl() + "m=Admin&a=SendIndividualSmsToMember",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#'+mBox+'_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Message Sent</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#'+mBox+'_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Send Individual sms</h4>'
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
    ConfirmSendIndividualEmailToMember:function(MemName,MemCode,EmailID) {
        var mBox = CreateModal(462,462);
        $('#'+mBox).modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Send Individual Email</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">' 
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Member Name</div>'
                                    +'<div class="col-sm-6">'+MemName+' ['+MemCode+']</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Email ID</div>'
                                    +'<div class="col-sm-6">'+EmailID+'</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-12">Subject</div>'
                                    +'<div class="col-sm-12"><input type="text" class="form-control" id="'+mBox+'EmailSubject"></div>'
                                    +'<div class="col-sm-12" id="'+mBox+'frmEmailSubject_error" style="color:red;text-align:center"></div>' 
                                 +'</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-12">Content</div>'
                                    +'<div class="col-sm-12"><textarea class="form-control" id="'+mBox+'EmailContent" rows="3"></textarea></div>'
                                    +'<div class="col-sm-12" id="'+mBox+'frmEmailContent_error" style="color:red;text-align:center"></div>' 
                                 +'</div>' 
                           +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordSendIndividualEmailToMember(\''+mBox+'\')" style="font-family:roboto">Send</button>'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
     },
    GetTxnPasswordSendIndividualEmailToMember:function(mBox) {
         if ($("#"+mBox+"EmailSubject").val().trim()=="") {
             $("#"+mBox+"frmEmailSubject_error").html("Please enter subject");
             return false;
         }
         if ($("#"+mBox+"EmailContent").val().trim()=="") {
             $("#"+mBox+"frmEmailContent_error").html("Please enter content");
             return false;
         }
        $("#EmailSubjectMessage").val($("#"+mBox+"EmailSubject").val());
        $("#EmailContentMessage").val($("#"+mBox+"EmailContent").val());
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Send Individual Email</h4>'
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
                                    + '<input type="password"  class="form-control" id="'+mBox+'TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="'+mBox+'frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.SendIndividualEmailToMember(\''+mBox+'\')" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#'+mBox+'_body').html(content);          
    },
    SendIndividualEmailToMember:function(mBox) {
        if ($("#"+mBox+"TransactionPassword").val().trim()=="") {
             $("#"+mBox+"frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#"+mBox+"TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#'+mBox+'_body').html(preloading_withText("Sending ...","123"));
        $.post(getAppUrl() + "m=Admin&a=SendIndividualEmailToMember",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#'+mBox+'_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 105px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Email Sent</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#'+mBox+'_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Send Individual Email</h4>'
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
    ConfirmPopupMessage:function(MemCode,MemName) {
        var mBox = CreateModal(462,462);
        $('#'+mBox).modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Popup Message</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">' 
                                +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Member Code</div>'
                                    +'<div class="col-sm-6">'+MemCode+'</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-4">Member Name</div>'
                                    +'<div class="col-sm-6">'+MemName+'</div>'
                                 + '</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-12">Subject</div>'
                                    +'<div class="col-sm-12"><input type="text" class="form-control" id="'+mBox+'PopupSubject"></div>'
                                    +'<div class="col-sm-12" id="'+mBox+'frmPopupSubject_error" style="color:red;text-align:center"></div>' 
                                 +'</div>'
                                 +'<div class="form-group row">'
                                    +'<div class="col-sm-12">Content</div>'
                                    +'<div class="col-sm-12"><textarea class="form-control" id="'+mBox+'PopupContent" rows="3"></textarea></div>'
                                    +'<div class="col-sm-12" id="'+mBox+'frmPopupContent_error" style="color:red;text-align:center"></div>' 
                                 +'</div>' 
                           +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" onclick="Member.GetTxnPasswordSendIndividualPopupToMember(\''+mBox+'\')" style="font-family:roboto">Send</button>'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
     },
    GetTxnPasswordSendIndividualPopupToMember:function(mBox) {
         if ($("#"+mBox+"PopupSubject").val().trim()=="") {
             $("#"+mBox+"frmPopupSubject_error").html("Please enter subject");
             return false;
         }
         if ($("#"+mBox+"PopupContent").val().trim()=="") {
             $("#"+mBox+"frmPopupContent_error").html("Please enter content");
             return false;
         }
        $("#PopupSubjectMessage").val($("#"+mBox+"PopupSubject").val());
        $("#PopupContentMessage").val($("#"+mBox+"PopupContent").val());
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Popup Message</h4>'
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
                                    + '<input type="password"  class="form-control" id="'+mBox+'TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="'+mBox+'frmTxnPass_error" style="color:red;text-align:center"></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="Member.SetIndividualPopupToMember(\''+mBox+'\')" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#'+mBox+'_body').html(content);          
    },
    SetIndividualPopupToMember:function(mBox) {
        if ($("#"+mBox+"TransactionPassword").val().trim()=="") {
             $("#"+mBox+"frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#"+mBox+"TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#'+mBox+'_body').html(preloading_withText("Sending ...","123"));
        $.post(getAppUrl() + "m=Admin&a=SetIndividualPopupToMember",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#'+mBox+'_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top:105px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Message Sent</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#'+mBox+'_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Popup Message</h4>'
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
    ShowMemberCurrentPlan:function() {
        var mBox = CreateModal(462,462);
        $('#'+mBox).modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Current Plan</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">' 
                             + '<br><br><br><br><br><br><br>'  
                           +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                           + '</div>';
            $('#'+mBox+'_body').html(content);
     }
	
};

var AdminStaff = { 
	
	ConfirmCreateAdminStaff:function() {
        if (SubmitNewStaff()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for create admin staff</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                          + '</div>'
                          + '<div class="modal-body">'
                            + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                + '<div class="col-sm-4">'
                                    + '<img src="'+ImgUrl+'icons/franchisee_icon.png" width="128px">' 
                                + '</div>'
                                + '<div class="col-sm-8"><br>'
                                    + '<div class="form-group row">'
                                        +'<div class="col-sm-12">Are you sure want create Admin staff</div>'
                                    + '</div>'
                                + '</div>'
                            +  '</div>'                    
                          + '</div>' 
                          + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" class="btn btn-primary" name="Create" onclick="AdminStaff.GetTxnPasswordCreatAdminStf()" style="font-family:roboto">Create Staff</button>'
                          + '</div>';
            $('#Publish_body').html(content);
        } else {
            return false;
        }
    },
	
	GetTxnPasswordCreatAdminStf:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create admin staff</h4>'
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
                            + '<button type="button" onclick="AdminStaff.CreateAdminStaff()" class="btn btn-primary" >Create Staff</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },
	CreateAdminStaff:function() {
		if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Creating Admin Staff ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateAdminStaff",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Admin Staff Created</h3>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Staff Code:' + data.StaffCode+'</h5>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Admin Staff</h4>'
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
	ConfirmGotoBackFromCreateAdminStaff:function() {
        $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Exit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                            +'<div class="col-sm-12">Are you sure want to cancel from Create admin staff</div>'
                      + '</div>' 
                      + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Staffs/ManageStaffs" style="cursor:pointer" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
        $('#Publish_body').html(content);
    },
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
                        + '<a href="'+AppUrl+'Staffs/Edit/'+StaffCode+'.html" class="btn btn-primary" name="Create" style="font-family:roboto;color:white">Yes</a>'
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
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AdminStaff.GetTxnPasswordEditAdminstaff()" style="font-family:roboto">Update Staff</button>'
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
                        + '<button type="button" class="btn btn-primary" name="Update" onclick="AdminStaff.EditAdminStaff()" style="font-family:roboto">Update Staff</button>'
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
        $.post(getAppUrl() + "m=Admin&a=EditAdminStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordDeactiveAdminstaff()" style="font-family:roboto">Yes ,Deactive</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
     GetTxnPasswordDeactiveAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for deactive staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="AdminStaff.DeactiveAdminStaff()" style="font-family:roboto">Yes ,Deactive</button>'
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
        $.post(getAppUrl() + "m=Admin&a=DeactiveAdminStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordActiveAdminstaff()" style="font-family:roboto">Yes ,Active</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordActiveAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for active staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="AdminStaff.ActiveAdminStaff()" style="font-family:roboto">Yes ,Active</button>'
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
        $.post(getAppUrl() + "m=Admin&a=ActiveAdminStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordChnPswdAdminstaff()" style="font-family:roboto">Yes ,Change</button>'
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
                        + '<button type="button" class="btn btn-primary" onclick="AdminStaff.AdminStaffChnPswd()" style="font-family:roboto">Yes ,Change</button>'
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
        $.post(getAppUrl() + "m=Admin&a=AdminStaffChnPswd",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordResetTxnPswdAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordResetTxnPswdAdminstaff:function() {
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
                        + '<button type="button" class="btn btn-primary" onclick="AdminStaff.ResetTxnPswdAdminStaff()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=ResetTxnPswdAdminStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordDeleteAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     },
        
    GetTxnPasswordDeleteAdminstaff:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for delete staff</h4>'
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
                        + '<button type="button" class="btn btn-primary" onclick="AdminStaff.DeleteAdminStaff()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=DeleteADminStaff",param,function(result) {
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
                                + '<button type="button" class="btn btn-primary" onclick="AdminStaff.GetTxnPasswordChnPswdFrFstLoginAdminstaff()" style="font-family:roboto">Yes ,Continue</button>'
                           + '</div>';
            $('#Publish_body').html(content);
	},
	GetTxnPasswordChnPswdFrFstLoginAdminstaff:function() {
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
						+ '<button type="button" class="btn btn-primary" onclick="AdminStaff.AdminStaffChnPswdFstLogin()" style="font-family:roboto">Yes ,Continue</button>'
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
        $.post(getAppUrl() + "m=Admin&a=AdminStaffChnPswdFstLogin",param,function(result) {
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
    $.ajax({url: getAppUrl() + "m=Admin&a=CheckVerification", success: function(result2) {
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
	function ConfirmEditTemplate() {
     
    if(SubmitTemplate()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit template</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want edit template<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrEditTemplate()" style="font-family:roboto">Update Staff</button>'
                           + '</div>';
            $('#Publish_body').html(content);
        } else {
           return false;
        }
     }
    function GetTxnPasswordFrEditTemplate() {
    var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit template</h4>'
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
                        + '<button type="button" class="btn btn-primary" name="Update" onclick="EditTemplate()" style="font-family:roboto">Update Staff</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    }
    function EditTemplate() {
         if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
    $("#txnPassword").val($("#TransactionPassword").val());
	$('#EmailContent').val($("#EmailContent_ifr").contents().find("#tinymce").html());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Updating Admin Staff ...","95"));
        $.post(getAppUrl() + "m=Admin&a=EditTemplate",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Template Updated</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/ManageTemplates" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Edit Template</h4>'
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
	
    function CreateTemplate() {
		  $('#PubplishNow').modal('show'); 
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Create Template</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        + '<div class="row">'
                                + '<div class="col-sm-8"><h6>Category<span style="color:red">*</span></h6></div>'
                        + '</div>'
                        + '<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-12">'
                                    + '<input type="text" onblur="text_blur(\'CategoryName\',\'frmCategory_error\',\'Please Enter Category\')" class="form-control" id="CategoryName" name="CategoryName" Placeholder="Enter Category">'
                                + '</div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmCategory_error" style="color:red;">&nbsp;</div>'
                        + '</div>'
						+ '<div class="row">'
                                + '<div class="col-sm-8"><h6>Description<span style="color:red">*</span></h6></div>'
                        + '</div>'
                        + '<div class="row">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-12">'
                                    + '<input type="text" onblur="text_blur(\'Description\',\'frmDescription_error\',\'Please Enter Description\')" class="form-control" id="Description" name="Description" Placeholder="Enter Description">'
                                + '</div>'
                            + '</div>'
                            + '<div class="col-sm-12" id="frmDescription_error" style="color:red;">&nbsp;</div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<button type="button" class="btn btn-primary" onclick="GetTxnPasswordFrCreateTemplate()" style="font-family:roboto">Create</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    }
	
	function text_blur(txtBox,errorDiv,errorMsg){
	
			$("#"+txtBox).blur(function () {
				if(IsNonEmpty(txtBox,errorDiv,errorMsg)){
					//IsAlphaNumeric(txtBox,"frmCategory_error","Please enter alpha numerics characters only");
				}
			});
	
	}
	
	function GetTxnPasswordFrCreateTemplate() {
		$("#frmCategory_error").html("");
        $("#frmDescription_error").html("");
      var Error =0;
        if ($("#CategoryName").val().trim()=="") {
             $("#frmCategory_error").html("Please enter category");
            Error++;
         }if ($("#Description").val().trim()=="") {
             $("#frmDescription_error").html("Please enter description");
            Error++;
         }
       
         if(Error>0){ 
            return false;
         }
		  $("#Category").val($("#CategoryName").val());
		 $("#CategoryDescription").val($("#Description").val());
    var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Create Template</h4>'
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
                        + '<button type="button" class="btn btn-primary" name="Update" onclick="TemplateCreate()" style="font-family:roboto">Continue</button>'
                    + '</div>';
        $('#Publish_body').html(content);            
    }
    
    function TemplateCreate() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
		 $("#txnPassword").val($("#TransactionPassword").val());
		
		var param = $("#FrmTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Creating...","161"));
        $.post(getAppUrl() + "m=Admin&a=TemplateCreate",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 78px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Template Created</h3>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Template</h4>'
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

var LandingPage = {    
	showConfirmUnPublishLandingProfile:function(ProfileCode) {
		$('#PubplishNow').modal('show'); 
		  var content = '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for unpublish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group row" style="margin:0px;">'
								+ '<div class="col-sm-4">'
									+ '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
								+ '</div>'
								+ '<div class="col-sm-8">'
									+ '<div class="form-group row">'
										+'<div class="col-sm-12">Are you sure want to unpublish this profile</div>'
									+ '</div><br>'
									+ 'Reason for Unpublish<br>'
									+ '<textarea class="form-control" rows="2" cols="3" id="UnpublishRemarks_Profile"></textarea>'
									+'<div class="col-sm-12" id="frmUnpublishRemark_error" style="color:red;text-align:center"></div>'
								+ '</div>'
							+  '</div>'                    
						+ '</div>' 
						+ '<div class="modal-footer">'
							+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
							+ '<button type="button" name="Create" class="btn btn-danger" onclick="LandingPage.GetTxnPswdfrUnpublishLandingProfile(\''+ProfileCode+'\')" style="font-family:roboto">Yes, I want to Unpublish</button>'
						+ '</div>';
				$('#Publish_body').html(content);
	},
	GetTxnPswdfrUnpublishLandingProfile:function(ProfileCode) {
		if ($("#UnpublishRemarks_Profile").val().trim()=="") {
             $("#frmUnpublishRemark_error").html("Please enter reason");
             return false;
         }
		$("#UnpublishProfileRemarks_"+ProfileCode).val($("#UnpublishRemarks_Profile").val());
		var content =   '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for unpublish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group" style="text-align:center">'
								+ '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
								+ '<h4 style="text-align:center;color:#ada9a9;">Please Enter Your Transaction Password</h4>'
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
							+ '<button type="button" onclick="LandingPage.UnpublishMemberLandingProfile(\''+ProfileCode+'\')" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
	UnpublishMemberLandingProfile:function(formid) {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		}
	
		$("#txnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=UnpublishMemberLandingProfile",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Unpublished successfully.</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Unpublish Profile</h4>'
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
	showConfirmPublishLandingProfile:function(ProfileCode) {
		$('#PubplishNow').modal('show'); 
		  var content = '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for publish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group row" style="margin:0px;">'
								+ '<div class="col-sm-4">'
									+ '<img src="'+AppUrl+'assets/images/icons/confirmation_profile.png" width="128px">' 
								+ '</div>'
								+ '<div class="col-sm-8">'
									+ '<div class="form-group row">'
										+'<div class="col-sm-12">Are you sure want to publish this profile</div>'
									+ '</div><br>'
								+ '</div>'
							+  '</div>'                    
						+ '</div>' 
						+ '<div class="modal-footer">'
							+ '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
							+ '<button type="button" name="Create" class="btn btn-primary" onclick="LandingPage.GetTxnPswdfrPublishLandingProfile(\''+ProfileCode+'\')" style="font-family:roboto">Yes, I want to Publish</button>'
						+ '</div>';
				$('#Publish_body').html(content);
	},
	GetTxnPswdfrPublishLandingProfile:function(ProfileCode) {
		var content =   '<div class="modal-header">'
							+ '<h4 class="modal-title">Confirmation for publish</h4>'
							+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
						+ '</div>'
						+ '<div class="modal-body">'
							+ '<div class="form-group" style="text-align:center">'
								+ '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
								+ '<h4 style="text-align:center;color:#ada9a9;">Please Enter Your Transaction Password</h4>'
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
							+ '<button type="button" onclick="LandingPage.PublishMemberLandingProfile(\''+ProfileCode+'\')" class="btn btn-primary">Continue</button>'
						+ '</div>';
				$('#Publish_body').html(content);            
	},
	PublishMemberLandingProfile:function(formid) {
		if ($("#TransactionPassword").val().trim()=="") {
			 $("#frmTxnPass_error").html("Please enter transaction password");
			 return false;
		}
	
		$("#txnPassword_"+formid).val($("#TransactionPassword").val());
        var param = $("#frmfrn_"+formid).serialize();
        $('#Publish_body').html(preloading_withText("loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=PublishMemberLandingProfile",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }  
            var obj = JSON.parse(result.trim());
            if (obj.status == "success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/icon_success_verification.png" width="100px"></p>'
                                    + '<h3 style="text-align:center;">Published successfully.</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Publish Profile</h4>'
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

var AppSettings = {    
   
 ConfirmCreateOrdersHeaderFooter:function() {
     
  //  if(SubmitOrderHeaderFooter()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create order header and footer</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create order header and footer<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AppSettings.GetTxnPasswordFrCreateOrderHeaderFooter()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     //   } else {
     //      return false;
     //   }
     } ,
     GetTxnPasswordFrCreateOrderHeaderFooter:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create order header and footer</h4>'
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
                            + '<button type="button" onclick="AppSettings.CreateOrderHeaderFooter()" class="btn btn-primary" >Update</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateOrderHeaderFooter:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $('#OrderHeader').val($( "#OrderHeader_ifr" ).contents().find('body').html());
        $('#OrderFooter').val($( "#OrderFooter_ifr" ).contents().find('body').html());
        var param = $("#frmfrTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateOrderHeaderFooter",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Header and Footer created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/Order/OrderHeaderFooter" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create Order header and footer</h4>'
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
    ConfirmCreateInvoiceHeaderFooter:function() {
     
  //  if(SubmitOrderHeaderFooter()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create invoice header and footer</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create invoice header and footer<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AppSettings.GetTxnPasswordFrCreateInvoiceHeaderFooter()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     //   } else {
     //      return false;
     //   }
     } ,
     GetTxnPasswordFrCreateInvoiceHeaderFooter:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create invoice header and footer</h4>'
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
                            + '<button type="button" onclick="AppSettings.CreateInvoiceHeaderFooter()" class="btn btn-primary" >Update</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateInvoiceHeaderFooter:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $('#InvoiceHeader').val($( "#InvoiceHeader_ifr" ).contents().find('body').html());
        $('#InvoiceFooter').val($( "#InvoiceFooter_ifr" ).contents().find('body').html());
        var param = $("#frmfrTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateInvoiceHeaderFooter",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Header and Footer created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/Invoice/InvoiceHeaderFooter" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create invoice header and footer</h4>'
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
    ConfirmCreateReceiptHeaderFooter:function() {
     
  //  if(SubmitOrderHeaderFooter()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create receipt header and footer</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create receipt header and footer<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AppSettings.GetTxnPasswordFrCreateReceiptHeaderFooter()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     //   } else {
     //      return false;
     //   }
     } ,
     GetTxnPasswordFrCreateReceiptHeaderFooter:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create receipt header and footer</h4>'
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
                            + '<button type="button" onclick="AppSettings.CreateReceiptHeaderFooter()" class="btn btn-primary" >Update</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateReceiptHeaderFooter:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $('#ReceiptHeader').val($( "#ReceiptHeader_ifr" ).contents().find('body').html());
        $('#ReceiptFooter').val($( "#ReceiptFooter_ifr" ).contents().find('body').html());
        var param = $("#frmfrTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateReceiptHeaderFooter",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Header and Footer created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/Receipt/ReceiptHeaderFooter" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create receipt header and footer</h4>'
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
     ConfirmCreateEmailHeaderFooter:function() {
     
  //  if(SubmitOrderHeaderFooter()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create email header and footer</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create email header and footer<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AppSettings.GetTxnPasswordFrCreateEmailHeaderFooter()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     //   } else {
     //      return false;
     //   }
     } ,
     GetTxnPasswordFrCreateEmailHeaderFooter:function() {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create email header and footer</h4>'
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
                            + '<button type="button" onclick="AppSettings.CreateEmailHeaderFooter()" class="btn btn-primary" >Update</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateEmailHeaderFooter:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $('#EmailHeader').val($( "#EmailHeader_ifr" ).contents().find('body').html());
        $('#EmailFooter').val($( "#EmailFooter_ifr" ).contents().find('body').html());
        var param = $("#frmfrTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateEmailHeaderFooter",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Header and Footer created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/Email/EmailHeaderFooter" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create email header and footer</h4>'
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
    ConfirmCreateProfileDownloadHeaderFooter:function() {
     
  //  if(SubmitOrderHeaderFooter()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create profile header and footer</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create profile download header and footer<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="AppSettings.GetTxnPasswordFrCreateProfileHeaderFooter()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
     //   } else {
     //      return false;
     //   }
     } ,
     GetTxnPasswordFrCreateProfileHeaderFooter:function() {
                                                                                                                                                 
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create profile header and footer</h4>'
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
                            + '<button type="button" onclick="AppSettings.CreateProfileDownloadHeaderFooter()" class="btn btn-primary" >Update</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateProfileDownloadHeaderFooter:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $('#ProfileDownloadHeader').val($( "#ProfileDownloadHeader_ifr" ).contents().find('body').html());
        $('#ProfileDownloadFooters').val($( "#ProfileDownloadFooters_ifr" ).contents().find('body').html());
        var param = $("#frmfrTemplate").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateProfiledownloadHeaderFooter",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Header and Footer created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/Template/ProfileDownload/ProfileDownloadHeaderFooter" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create profile download header and footer</h4>'
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
var PaymentGateway = {    
   
 ConfirmCreatePayu:function() {
     
    if(SubmitPayu()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create payu</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create payu<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="PaymentGateway.GetTxnPasswordFrCreatePayu()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } ,
	 GetTxnPasswordFrCreatePayu:function() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create payu</h4>'
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
                            + '<button type="button" onclick="PaymentGateway.CreatePayu()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreatePayu:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
		var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreatePayu",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Payu created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ManagePayu" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create payu</h4>'
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
	ConfirmCreatePaytm:function() {
     
    if(SubmitPaytm()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create paytm</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create paytm<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="PaymentGateway.GetTxnPasswordFrCreatePaytm()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } ,
	 GetTxnPasswordFrCreatePaytm:function() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create paytm</h4>'
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
                            + '<button type="button" onclick="PaymentGateway.CreatePaytm()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreatePaytm:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
		var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreatePaytm",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Paytm created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ManagePayTm" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create paytm</h4>'
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
	ConfirmCreateCcavenue:function() {
     
    if(SubmitCCavenue()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create ccavenue</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create ccavenue<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="PaymentGateway.GetTxnPasswordFrCreateCcavenue()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } ,
	 GetTxnPasswordFrCreateCcavenue:function() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create ccavenue</h4>'
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
                            + '<button type="button" onclick="PaymentGateway.CreateCcavenue()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateCcavenue:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
		var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateCcavenue",param,function(result) {
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
                                    + '<h3 style="text-align:center;">CCavenue created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ManageCCavenue" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create ccavenue</h4>'
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
	ConfirmCreateInstamajo:function() {
     
    if(SubmitInstamajo()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create instamajo</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create instamajo<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="PaymentGateway.GetTxnPasswordFrCreateInstamajo()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } ,
	 GetTxnPasswordFrCreateInstamajo:function() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create instamajo</h4>'
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
                            + '<button type="button" onclick="PaymentGateway.CreateInstamajo()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateInstamajo:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
		var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreateInstamajo",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Instamajo created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ManageInstaMajo" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create instamajo</h4>'
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
	ConfirmCreatePaypal:function() {
     
    if(SubmitPaypal()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create paypal</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create paypal<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="PaymentGateway.GetTxnPasswordFrCreatePaypal()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } ,
	 GetTxnPasswordFrCreatePaypal:function() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create paypal</h4>'
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
                            + '<button type="button" onclick="PaymentGateway.CreatePaypal()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreatePaypal:function() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
		var param = $("#frmfrPaymentGateway").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=CreatePaypal",param,function(result) {
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
                                    + '<h3 style="text-align:center;">Paypal created</h3>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Settings/PaymentGateway/ManagePaypal" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Create paypal</h4>'
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
   //3078