        <!--<footer class="footer">
            <div class="container-fluid clearfix">
                <!--<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright &copy; 2018
               <a href="http://www.bootstrapdash.com/" target="_blank">XXXXXXXX</a>. All rights reserved.</span>-->
            <!--</div>
        </footer>-->
        <!--<script src="<?php echo SiteUrl?>assets/vendors/js/vendor.bundle.base.js"></script> 
        <script src="<?php echo SiteUrl?>assets/vendors/js/vendor.bundle.addons.js"></script>
        <script src="<?php echo SiteUrl?>assets/js/off-canvas.js"></script>    
        <script src="<?php echo SiteUrl?>assets/js/misc.js"></script>     -->
        <script src="<?php echo SiteUrl?>assets/simpletoast/simply-toast.js"></script>                                      
        
        <!-- Member --->
        <?php if (isset($_Member['LoginID']) && $_Member['LoginID']>0) { ?>
        <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Member['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>     
        <script src="<?php echo SiteUrl?>assets/js/mcontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
      <!--  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="Mobile_VerificationBody" style="">
                            <img src='../../../images/loader.gif'> Loading ....
                        </div>
                    </div>
                </div>
            </div>
        </div>   -->
        <div class="modal" id="myModal" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Mobile_VerificationBody"  style="/*max-height: 300px;min-height: 300px;*/" >
                    <img src='../../../images/loader.gif'> Loading ....
                </div>
            </div>
        </div> 
        
        
        <?php } ?>                  
        
        <?php if (isset($_Franchisee['LoginID']) && $_Franchisee['LoginID']>0) { ?>
         <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Franchisee['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>
        <script src="<?php echo SiteUrl?>assets/js/fcontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
       
        <?php } ?>
<?php if (isset($_Admin['LoginID']) && $_Admin['LoginID']>0) { ?>
         <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Admin['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>
     <script src="<?php echo SiteUrl?>assets/js/AdminController.js?rand=<?php echo rand(3000,3300000);?>"></script> 
        
        
        <?php } ?>
         
    </body>
</html>
<script>


function RequestToshowUpgrades(PProfileID) {
        $('#Upgrades_body').html(preloader);
        $('#Upgrades').modal('show'); 
        var html_design="";
        $.ajax({
            url: getAppUrl() + "m=Member&a=RequestToshowUpgrades&PProfileID="+PProfileID, 
            success: function(result){
                var obj = JSON.parse(result); 
                if (obj.status=="success") {
                    var objdata =obj.data;
                    if (parseInt(objdata.balancecredits)>0) {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >'
                                        +'<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                        + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                        + '<div align="center" style="padding-top: 33px;">'
                                            + '<table>'
                                                + '<tr>'
                                                    + '<td>Your Total Credits &nbsp;&nbsp;'+objdata.BalCr+'</td>'
                                                + '</tr>'
                                                + '<tr>'
                                                    + '<td>Used Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+objdata.BalDr+'</td>'
                                                + '</tr>'
                                                + '<tr>'
                                                    + '<td>Balance Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+objdata.BalCr+'</td>'
                                                + '</tr>'
                                            + '</table>'
                                            + '<br>'
                                            + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                        + '</div>'
                                        + '<br>'
                                        + '</form>'
                                    + '</div>'
                    } else {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >' 
                                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                            + '<h4 class="modal-title">Download Profile</h4>'
                                            + '<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                            + '<div style="text-align:center">'
                                                + 'No credits found please upgrade<br><br>'
                                                + '<a href="'+AppUrl+'Matches/Search/ViewPlans/'+PProfileID+'.htm " class="btn btn-primary" name="Continue">Upgrade Membership</a>&nbsp;'
                                                + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                            + '</div><br>'
                                        + '</form>'
                                    + '</div>';
                }
                } else {
                   html_design = obj.message; 
                }
               $('#Upgrades_body').html(html_design); 
            }});
    }
    
    function RequestToDownload(PProfileID) {
        
        $('#OverAll_body').html(preloader);
        $('#OverAll').modal('show'); 
        var html_design="";
        $.ajax({
            url: getAppUrl() + "m=Member&a=RequestToDownload&PProfileID="+PProfileID, 
            success: function(result){
                
                var obj = JSON.parse(result); 
                if (obj.status=="success") {
                    var objdata =obj.data;
                    if (parseInt(objdata.balancecredits)>0) {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >'
                                        + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                        + '<h4 class="modal-title">Download Profile</h4>'
                                        + '<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                        + '<div align="center" style="padding-top: 33px;">'
                                            + '<table>'
                                                + '<tr>'
                                                    + '<td>You have remainig profiles to download &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+objdata.balancecredits+'</td>'
                                                + '</tr>'
                                            + '</table>'
                                            + '<br>'
                                            + '<button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP(\''+PProfileID+'\')">Continue</button>&nbsp;'
                                            + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                        + '</div>'
                                        + '<br>'
                                        + '</form>'
                                    + '</div>';
                        
                    } else {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >' 
                                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                            + '<h4 class="modal-title">Download Profile</h4>'
                                            + '<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                            + '<div style="text-align:center">'
                                                + 'You don\'t have credits to download profile in your account<br>'
                                                + 'Please upgrade your membership.'
                                                + '<br><br>'
                                                + '<a href="'+AppUrl+'Matches/Search/ViewPlans/'+PProfileID+'.htm " class="btn btn-primary" name="Continue">Upgrade Membership</a>&nbsp;'
                                                + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                            + '</div><br>'
                                        + '</form>'
                                    + '</div>';
                }
                } else {
                   html_design = obj.message; 
                }
               $('#OverAll_body').html(html_design); 
            }});
    }
 
function OverallSendOTP(formid) {
    var param = $("#frm_"+formid).serialize();
    $('#OverAll_body').html(preloading_withText("Loading ...","95"));
        $.post(getAppUrl() + "m=Member&a=OverallSendOtp",param,function(result) {
            
             if (!(isJson(result))) {
                $('#OverAll_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                + '<input type="hidden" value="'+data.PProfileCode+'" name="PProfileCode">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">OTP</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'<br>&amp;<br>'+data.MobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="otpcheck" maxlength="4" name="otpcheck" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ViewProfileOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="DeletMemberOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOverallSendOtp(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                 $('#OverAll_body').html(content);
        }
        });
}

function ViewProfileOTPVerification(frmid) {
        var param = $( "#"+frmid).serialize();
        $('#OverAll_body').html(preloading_withText("Loading ...","95"));
        $.post( API_URL + "m=Member&a=ViewProfileOTPVerification",param).done(function(result) {
            if (!(isJson(result))) {
                $('#OverAll_body').html(result);
                return ;
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
                                    + '<p style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
            $('#OverAll_body').html(content);
            } else {
               var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                + '<input type="hidden" value="'+data.PProfileCode+'" name="PProfileCode">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">OTP</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'<br>&amp;<br>'+data.MobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text" value="'+data.otpcheck+'"  class="form-control" id="otpcheck" maxlength="4" name="otpcheck" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ViewProfileOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="DeletMemberOtp_error">'+data.error+'</div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOverallSendOtp(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                 $('#OverAll_body').html(content);
            }
    });
}
function ResendOverallSendOtp(frmid) {
    var param = $("#"+frmid).serialize();
    $('#OverAll_body').html(preloading_withText("Loading ...","95"));
        $.post(getAppUrl() + "m=Member&a=ResendOverallSendOtp",param,function(result) {
            
             if (!(isJson(result))) {
                $('#OverAll_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                + '<input type="hidden" value="'+data.PProfileCode+'" name="PProfileCode">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">OTP</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'<br>&amp;<br>'+data.MobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="otpcheck" maxlength="4" name="otpcheck" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="ViewProfileOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="DeletMemberOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendOverallSendOtp(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                 $('#OverAll_body').html(content);
        }
        });
}
</script>