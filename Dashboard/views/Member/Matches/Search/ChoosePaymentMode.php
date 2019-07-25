<?php include_once("PaymentModeHeader.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;" >
    <div class="Col-sm-12" id="resdiv" style="width: 74%;">    
              
     
    
     </div>
         <div style="display:none">
        <div class="Bank" id="Bankdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
        <?php
        if (isset($_POST['Confirm'])) {
        
        $response = $webservice->getData("Member","PayContinueBank",$_POST);
        if ($response['status']=="success") {
          //  echo "<script>location.href='../ChoosePaymentMode';</script>";
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
        } 
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
        </div>
    </div>
</form>                   
<script>
 function loadPaymentOption(pOption){
     $("#resdiv").html("Bankdiv");
     if (pOption=="BankDeposite") {
        $("#resdiv").html($('#Bankdiv').html());
        $('#BankDeposite').css({"background":"Transparent","border-right":"none"});
        $('#Paypal').css({"background":"#ccc"});
     }
     if (pOption=="Paypal") {
        $("#resdiv").html($('#Paypaldiv').html());
        $('#BankDeposite').css({"background":"#ccc"});
        $('#Paypal').css({"background":"Transparent","border-right":"none"});
     }
 }
</script>
<?php include_once("PaymentModeFooter.php");?>                    