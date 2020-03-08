                function DataTableStyleUpdate() {
                    $("table.dataTable tbody th, table.dataTable tbody td").css({"padding":"12px 19px 0px !important"});
                    $("div.dataTables_wrapper div.dataTables_length label").css({"font-size":"12px"});
                    $("div.dataTables_wrapper div.dataTables_filter label").css({"font-size":"12px"});
                    $("div.dataTables_wrapper div.dataTables_info").css({"font-size":"12px"});
                    $(".dataTables_wrapper .dataTables_paginate .paginate_button").css({"padding":"0px"});
                }

                var ErrorCount = 0;
                
                function IsNonEmpty(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if ($('#'+ElemID).val()=="" || $('#'+ElemID).val().trim()=="") {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);  
                        return false;
                    }
                    return true;
                }

                function IsNumeric(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if(  /[^0-9]/.test( $('#'+ElemID).val() ) ) {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                }
                function OtherEducationDegree(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if(/[^a-zA-Z0-9 ]/.test( $('#'+ElemID).val() ) ) {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                }
                
                function IsAlphaNumeric(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if( /[^a-zA-Z0-9 ]/.test( $('#'+ElemID).val() ) ) {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);                                                  
                        return false;
                    }
                    return true;        
                }

                function IsAlphaNumerics(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if( /[^a-zA-Z0-9]/.test( $('#'+ElemID).val() ) ) {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);                                                  
                        return false;
                    }
                    return true;   
                }

                function IsAlphabet(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if( /[^a-zA-Z ]/.test( $('#'+ElemID).val() ) ) {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }

                function IsMobileNumber(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if (IsNonEmpty(ElemID,ResultDiv,"Please Enter Mobile Number")) {
                        if (!(parseInt($('#'+ElemID).val())<9999999999 && parseInt($('#'+ElemID).val())>6000000000)) {
                            ErrorCount++;
                            $('#'+ResultDiv).html(Message);
                            return false;
                        }
                        return true;   
                    }
                    return false;
                }
                
                function IsWhatsappNumber(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if (IsNonEmpty(ElemID,ResultDiv,"Please Enter Whatsapp Number")) {
                        if (!(parseInt($('#'+ElemID).val())<9999999999 && parseInt($('#'+ElemID).val())>6000000000)) {
                            ErrorCount++;
                            $('#'+ResultDiv).html(Message);
                            return false;
                        }
                        return true;   
                    }
                    return false;
                }

                function IsLogin(ElemID,ResultDiv,Message) {
                    
                    if (IsNonEmpty(ElemID,ResultDiv,"Please Enter Login Name")) {
                        if (!($('#'+ElemID).val().length>=6 && $('#'+ElemID).val().length<=9)) {
                            ErrorCount++;
                            $('#'+ResultDiv).html(Message);
                            return false;                                             
                        }
                        return true;   
                    }
                    return false;
                }

                 function IsPassword(ElemID,ResultDiv,Message){
                  
                    $('#'+ResultDiv).html("");
                    if(( $('#'+ElemID).val().length < 8 ))  {
                        ErrorCount++;                           
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }
                function IsFPassword(ElemID,ResultDiv,Message){
                  
                    $('#'+ResultDiv).html("");
                    if(( $('#'+ElemID).val().length < 6 ))  {
                        ErrorCount++;                           
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }
                
                function IsSearch(ElemID,ResultDiv,Message){
                  
                    $('#'+ResultDiv).html("");
                    if(( $('#'+ElemID).val().length < 3 ))  {
                        ErrorCount++;                           
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }
                    

                function IsNumber(ElemID,ResultDiv,Message){
                    $('#'+ResultDiv).html("");
                    if(( $('#'+ElemID). val() > 100 ))  {
                        ErrorCount++;                           
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }

                function IsNumbers(ElemID,ResultDiv,Message) {
                    $('#'+ResultDiv).html("");
                    if(( $('#'+ElemID). val() > 1000 ))  {
                        ErrorCount++;                           
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                    return true;   
                }

                function IsEmail(ElemID,ResultDiv,Message) {
                    if (/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,8})$/.test($("#"+ElemID).val().toLowerCase())) {
                        return true;       
                    } else {
                        ErrorCount++;
                        $('#'+ResultDiv).html(Message);
                        return false;
                    }
                }
             /*   function IsPassword() {
                    var password = document.getElementById("NewPassword").value;
                    var confirmPassword = document.getElementById("ConfirmNewPassword").value;
                        if (password != confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                        }
                        return true;
                                       }      */
     