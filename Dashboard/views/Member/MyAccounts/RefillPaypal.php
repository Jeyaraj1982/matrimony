<?php 
    if (isset($_POST['Amount'])) { 
        $response =$webservice->getData("Member","SavePayPalRequest",$_POST);
        if ($response['status']=="success") {
?>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalform">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="nammamarriagejk@gmail.com">
        <input type="hidden" name="item_name" value="MembershipFee">
        <input type="hidden" name="amount" value="<?php echo $_POST['Amount'];?>">
        <input type="hidden" name="currency_code" value="INR">
        <input type="hidden" name="quantity" value="1">
    </form> 
    <script>document.getElementById("paypalform").submit();</script> 
<?php   
            
    } else {
        $errormessage = $response['message']; 
    }
    }
 
    $page  = "MyWallet";
    $spage = "RefillWallet";
    $sp    = "Paypal";
?>
<script>
    $(document).ready(function () {
        $("#Amount").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrAmount").html("Digits Only").fadeIn().fadeIn("fast");
                return false;
            }
        });
        $("#Amount").blur(function () { 
            IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
        });
        $("#check").blur(function () {
            IsNonEmpty("check","Errcheck","If yo agree terms and conditions please select");
        });
    });
    function submitamount() {
        
        $('#ErrAmount').html("");
        $('#Errcheck').html("");
        
        if(IsNonEmpty("Amount","ErrAmount","Please Enter Amount")) {
            
            if (!( parseInt($('#Amount').val())>=500 && parseInt($('#Amount').val())<=10000)) {
                $("#ErrAmount").html("Please enter above 500 and below 10000") ;
                return false;
            }
            
            if (!( parseInt($('#Amount').val() % 100)==0)) {
                $("#ErrAmount").html("Please enter only multiples of 100") ;
                return false;  
            }
        }  
        if(document.form1.check.checked == false) {
            $("#Errcheck").html("if yo agree terms and conditions please select!");
            return false;
        }
        $('#form1').submit();
    }
</script>
<?php include_once("accounts_header.php");
 $response =$webservice->getData("Member","IsPaypalTransferAllowed");
?>
<?php if ($response['data']['IsAllowed']==0)    { ?>
        <div class="col-sm-9" style="margin-top: -8px;">  
        <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Using Paypal</h4>
        <span style="color:#999;">It's is safe transaction and gives refill amount instantly.</span>
            <span style="color:#666"><br><br><br><br><br>Currently Paypal transfer not allowed.<br>
            Please contact support team.
            <br><br><br><br><br><br><br><br><br>
            </span>
        </div> 
    <?php } else { ?>
    
        <div class="col-sm-9" style="margin-top: -8px;color:#444">
            <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Using Paypal</h4>
            <span style="color:#999;">It's is safe transaction and gives refill amount instantly.</span><br><br>
             <?php 
             $verification_info  = $webservice->getData("Member","GetMemberVerfiedDetails");
             $MobileVerification=$verification_info['data']['Member']['IsMobileVerified'];
             $EmailVerification=$verification_info['data']['Member']['IsEmailVerified'];
             $KYCVerification=$verification_info['data']['Documents'];
            if($MobileVerification==0){ ?>
         <br><br>
         <div class="form group row">
            <div class="col-sm-1" style="margin-right: -32px;"><img src="<?php echo SiteUrl;?>assets/images/exclamation-mark.png"></div>
            <DIV class="col-sm-11">Your mobile number is not verified. Click to&nbsp;<a href="javascript:void(0)" onclick="MobileNumberVerification()">verify now</a></div><br>
         </div>
        <?php }   ?>  
       <?php if($EmailVerification==0) { ?>
        <br><div class="form group row">
            <div class="col-sm-1" style="margin-right: -32px;"><img src="<?php echo SiteUrl;?>assets/images/exclamation-mark.png"></div>
            <DIV class="col-sm-11">Your email number is not verified. Click to&nbsp;<a href="javascript:void(0)" onclick="EmailVerification()">verify now</a></div>
         </div>
        <?php }   ?>
        <?php if(sizeof($KYCVerification)==0) { ?>
            <br> <div class="form group row">
            <div class="col-sm-1" style="margin-right: -32px;"><img src="<?php echo SiteUrl;?>assets/images/exclamation-mark.png"></div>
            <DIV class="col-sm-11">Your documents is not verified. Click to&nbsp;<a href="<?php echo GetUrl("MySettings/KYC");?>">Update now</a></div><br>
         </div>
        <?php }   ?>
        <?php if(sizeof($KYCVerification)>0 && $EmailVerification==1 && $MobileVerification==1) { ?>
        
            <form method="post" action="" name="form1" id="form1">
            Refill Amount: (₹)<br> 
            <input type="text" placeholder="Enter Amount" name="Amount" id="Amount" style="border:1px solid #ccc;padding:3px;padding-left:10px;"><br>
            <span style="color:#999;font-size:11px;">Multiples of 100 and Minimum ₹ 500 & Maximum ₹ 10000</span><br>
            <span class="errorstring" id="ErrAmount"></span><br><br><br>
            <input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal">I understand terms of wallet udpate </label>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="PaypalTermsandConditions()">Learn more</a><Br>
            <span class="errorstring" id="Errcheck"></span><br>
            <?php echo $errormessage ;?><?php echo $successmessage;?>
            <div>
                <img src="<?php echo ImageUrl;?>paypal_checkout.png" name="Amount" onclick="submitamount()" style="height:36px;cursor:pointer">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo AppUrl;?>MyAccounts/RefillBank" style="color:#2f5bc4">Continue Bank Transfer</a>
            </div>
            <br>
            <div> 
            <a href="ListOfPayPalRequests" >List of Previous Requests</a>
        </div>
        </form>
    <bR><br>
    <bR><br>
    <bR><br>
    <div style="text-align:right"><img src="<?php echo ImageUrl;?>paypal_lic.png"></div>
    </div>
    <div class="modal" id="termscondition" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="termsandconditions_body" style="height:315px">
            
                </div>
            </div>
        </div> 
     <?php }?>
 <?php } ?>    
    <script>
        function PaypalTermsandConditions() {
      $('#termscondition').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'                                                                              
                          + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        + '<h4 class="modal-title">Terms & Conditions</h4> <br>'
                        +'<div style="text-align:left">Instantly credited transfer amount to yor wallet.<br><br>'
                       +  '</div><br>'
                    +  '</form>'                                                                                                          
                +  '</div>'
            +  '</div>';
            $('#termsandconditions_body').html(content);
}
    </script>
<?php include_once("accounts_footer.php");?>                     