<?php include_once("PaymentModeHeader.php");?>
    <div class="col-sm-9" style="margin-top: -8px;" >
    <div class="Col-sm-12" id="resdiv" style="width: 74%;">    
              
     
    
     </div>
         <div style="display:none">  
        <div class="Bank" id="Bankdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
        <?php
       
        ?>
          <div align="center">
                        <img src="<?php echo ImageUrl;?>bankbuilding.png" style="height:77px;margin-top:6px"><Br><Br> 
                        <ul style="text-align: left;">
                            <li>Walk into any of the Bank accross India, Make cheque or cash payments directly to the below account:</li>
                        </ul> <br>
                        <button type="submit" name="Confirm" class="btn btn-primary">Confirm</button>
          </div>
        </div>
        <div class="Paypal" id="Paypaldiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <table align="center">
                <tr>
                    <td>
                        <img src="<?php echo ImageUrl;?>paypalpayment.png" style="height:77px;margin-top:6px"><Br><Br> 
                    </td>
                    </tr>
                <tr>
                </tr>
            </table>
        </div>
        <div class="CreditCard" id="CreditCarddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <table align="center">
                <tr>
                    <td>
                        Credit Card
                    </td>
                    </tr>
                <tr>
                </tr>
            </table>
        </div>
        <div class="Wallet" id="Walletdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <h5 class="card-title">Using Wallet Balance</h5>
           <?php
               $response = $webservice->getData("Member","ViewOrdersAmountForTransaction",array("Code"=>$_GET['Code']));
               $Oreders= $response['data']['Order'];
               $Wallet= $response['data']['Wallet'];
                ?>
                <div style="text-align:center">
                    <img src="<?php echo ImageUrl;?>wallet.svg" style="width:60px;color:white">
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label" style="color:#737373;text-align: center">
                        You have ₹<?php echo $Wallet;?> in your wallet.
                    </label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label" style="color:#737373;text-align: center">
                        Order Number&nbsp;&nbsp;:&nbsp;<?php echo $Oreders['OrderNumber'];?>
                    </label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label" style="color:#737373;text-align: center">
                        Order Value&nbsp;&nbsp;:&nbsp;₹&nbsp;<?php echo number_format($Oreders['OrderValue'],2);?>
                    </label>
                </div>
               <div class="form-group row">
                    <div class="col-sm-12" style="text-align:center">
                   <!-- <form method="post" action="<?php echo SiteUrl;?>Payments/Wallet/Collect/<?php echo $Oreders['OrderNumber'];?>.htm" > -->
                        <input type="hidden" name="OrderNumber" value="<?php echo $Oreders['OrderNumber'];?>">
                        <input type="hidden" name="PaymentMode" value="Wallet">
                        <a href="javascript:void(0)" onclick="showConfirmPayNow('<?php echo $Oreders['OrderByMemberCode'];?>','<?php echo number_format($Oreders['OrderValue'],2);?>','<?php echo $Oreders['OrderNumber'];?>')" name="Confirm" class="btn btn-primary" style="font-family: roboto;">Pay Now ₹&nbsp;<?php echo number_format($Oreders['OrderValue'],2);?></a>
                    <!--</form> -->
                    </div>
               </div>
        </div>
        </div>
    </div>
    <div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 300px;min-height: 300px;" >
            
                </div>
            </div>
        </div>
<script>
 function loadPaymentOption(pOption){    
     $("#resdiv").html("Bankdiv");
     if (pOption=="BankDeposite") {                  
        $("#resdiv").html($('#Bankdiv').html());
        $('#BankDeposite').css({"background":"#95abfb"});
        $('#Paypal').css({"background":"Transparent"});
        $('#CreditCard').css({"background":"Transparent"});
        $('#Wallet').css({"background":"Transparent"});
     }
     if (pOption=="Paypal") {
        $("#resdiv").html($('#Paypaldiv').html());
        $('#BankDeposite').css({"background":"Transparent"});
        $('#Paypal').css({"background":"#95abfb"});
        $('#CreditCard').css({"background":"Transparent"});
        $('#Wallet').css({"background":"Transparent"});
     }
     if (pOption=="CreditCard") {
        $("#resdiv").html($('#CreditCarddiv').html());
        $('#BankDeposite').css({"background":"Transparent"});
        $('#Paypal').css({"background":"Transparent"});
        $('#CreditCard').css({"background":"#95abfb"});
        $('#Wallet').css({"background":"Transparent"});
     }
     if (pOption=="Wallet") {
        $("#resdiv").html($('#Walletdiv').html());
        $('#BankDeposite').css({"background":"Transparent"});
        $('#Paypal').css({"background":"Transparent"});
        $('#CreditCard').css({"background":"Transparent"});
        $('#Wallet').css({"background":"#95abfb"});
     }
 }
 $(document).ready(function () {
      loadPaymentOption('Wallet');
 });  
 
 function showConfirmPayNow(MemberCode,OrderValue,OrderNumber) {
      $('#PubplishNow').modal('show'); 
      var content = '<div >'
                        +'<div>'                                                                              
                            +'<form method="post" id="frm_'+MemberCode+'" name="frm_'+MemberCode+'" action="" >'
                                +'<input type="hidden" value="'+MemberCode+'" name="MemberCode">'
                                +'<input type="hidden" value="'+OrderNumber+'" name="OrderNumber">'
                                +'<input type="hidden" name="PaymentMode" value="Wallet">'
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Confirmation For Pay Now</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="max-height: 175px;min-height: 175px;">'
                                    +'<div style="text-align:left"> Dear ,<br></div>'
                                    +'<div style="text-align:center">Order value&nbsp;&nbsp;:&nbsp;₹&nbsp;'+OrderValue+' </div><br><br>'
                                +'</div>' 
                                +'<div class="modal-footer">' 
                                    +'<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>&nbsp;&nbsp;&nbsp;' 
                                    +'<button type="button" class="btn btn-primary" name="Paynow" id="Paynow"  onclick="SendOtpForPayNow(\''+MemberCode+'\')" style="font-family:roboto">Yes, Continue</button>'
                                +'</div>'
                            +'</form>'                                                                                                          
                        +'</div>'
                    +'</div>';
            $('#Publish_body').html(content);
}
function SendOtpForPayNow(formid) {
    var param = $("#frm_"+formid).serialize();
    $('#Publish_body').html(preloading_withText("Loading ...","95"));
        $.post(getAppUrl() + "m=Member&a=SendOtpForPayNow",param,function(result) {
            
            if (!(isJson(result))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                $('#Publish_body').html(result);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Confirmation For Pay Now</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
                                +'</div>' 
                                +'<div class="modal-footer">'  
                                    +'<a class="btn btn-primary"  location.href="location.href" style="cursor:pointer">continue</a>'
                                +'</div>'
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
}
function ResendSendOtpForPayNow(frmid) {
    var param = $("#"+frmid).serialize();
    $('#Publish_body').html(preloading_withText("Loading ...","95"));
        $.post(getAppUrl() + "m=Member&a=ResendSendOtpForPayNow",param,function(result) {
            
             if (!(isJson(result))) {
                $('#Publish_body').html(result);
                return ;                                                                   
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                 var randString = "form_" + randomStrings(5);
                   var data = obj.data; 
                 var content = '<div id="otpfrm" >'
                                + '<form method="POST" id="'+randString+'" name="'+randString+'">'
                                + '<input type="hidden" value="'+data.securitycode+'" name="reqId">'
                                + '<input type="hidden" value="'+data.MemberCode+'" name="MemberCode">'
                                + '<input type="hidden" value="'+data.OrderNumber+'" name="OrderNumber">'
                                +'<input type="hidden" name="PaymentMode" value="Wallet">'
                                    +'<div class="modal-header">'
                                        + '<h4 class="modal-title">Confirmation for pay now</h4>'
                                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                                    +'</div>'
                                    +'<div class="modal-body">'
                                         +'<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'+data.EmailID+'<br>&amp;<br>'+data.MobileNumber+'</h4></p>'
                                         + '<div class="form-group">'
                                            + '<div class="input-group">'
                                                + '<div class="col-sm-12">'
                                                    + '<div class="col-sm-3"></div>'
                                                    + '<div class="col-sm-6">'
                                                        + '<input type="text"  class="form-control" id="PayNowOtp" maxlength="4" name="PayNowOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">'
                                                        + '<button type="button" onclick="PayNowOTPVerification(\''+randString+'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>'
                                                    + '</div>'
                                                    + '<div class="col-sm-3"></div>'
                                                     + '<div class="col-sm-12" style="color:red;text-align:center" id="PaynowOtp_error"></div>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForPayNow(\''+randString+'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5>' 
                                + '</form>'
                             + '</div>';
                 $('#Publish_body').html(content);
        }
        });
}
function PayNowOTPVerification(frmid) {
        var param = $( "#"+frmid).serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","95"));
        $.post( API_URL + "m=Member&a=PayNowOTPVerification",param).done(function(result) {
            if (!(isJson(result))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result);
            if (obj.status=="success") {
                
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h5 style="text-align:center;color:#ada9a9">' + obj.message+'</h5>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            
             
            }
            
    });
}
 
</script>
<?php include_once("PaymentModeFooter.php");?>                    