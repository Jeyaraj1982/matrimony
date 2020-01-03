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
                        + '</div>'
                      + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="Franchisee.CreateFranchisee()" class="btn btn-primary" >Create Franchisee</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    },

    CreateFranchisee:function() {
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Creating Franchisee ...","95"));
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
    
    EditFranchisee:function() {
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Updating Franchisee ...","95"));
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
    
    GetTxnPasswordEditFranchisee:function() {
        var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for edit franchisee</h4>'
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
                        + '</div>'
                    + '</div>'
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
						+ '<button type="button" class="btn btn-primary" name="Create" class="btn btn-primary" onclick="Franchisee.EditFranchisee()" style="font-family:roboto">Update Franchisee</button>'
					+ '</div>';
        $('#Publish_body').html(content);            
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