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
            <form method="post" action="" name="form1" id="form1">
            Refill Amount: (₹)<br> 
            <input type="text" placeholder="Enter Amount" name="Amount" id="Amount" style="border:1px solid #ccc;padding:3px;padding-left:10px;"><br>
            <span style="color:#999;font-size:11px;">Multiples of 100 and Minimum ₹ 500 & Maximum ₹ 10000</span><br>
            <span class="errorstring" id="ErrAmount"></span><br><br><br>
            <input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal">I understand terms of wallet udpate </label>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#termscondition">Learn more</a><Br>
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
    <div class="modal" id="termscondition" role="dialog"  style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" style="width: 367px;">
            <div class="modal-content">
                <div class="modal-body" style="padding:20px">                                                                                                                                                  
                    <div  style="height: 315px;">
                        <h5 style="text-align:center">Refill Wallet Terms</h5>
                        <ul>
                            <li>Instantly credited transfer amount to your wallet</li>
                        </ul>
                        <button type="button" class="btn btn-prinary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
     <?php }?>
<?php include_once("accounts_footer.php");?>                     