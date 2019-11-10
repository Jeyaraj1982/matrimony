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
                    <form method="post" action="<?php echo SiteUrl;?>Payments/Wallet/Collect/<?php echo $Oreders['OrderNumber'];?>.htm" >
                        <input type="hidden" name="OrderNumber" value="<?php echo $Oreders['OrderNumber'];?>">
                        <input type="hidden" name="PaymentMode" value="Wallet">
                        <button type="submit" name="Confirm" class="btn btn-primary" style="font-family: roboto;">Pay Now ₹&nbsp;<?php echo number_format($Oreders['OrderValue'],2);?></button>
                    </form> 
                    </div>
               </div>
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
</script>
<?php include_once("PaymentModeFooter.php");?>                    