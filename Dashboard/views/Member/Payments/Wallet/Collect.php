<?php 
    include_once("../../PaymentModeHeader.php");
    $response = $webservice->getData("Member","CollectPaymentFromWallet",$_POST);  
    if ($response['status']=="success") {    
?>
<div class="col-12 grid-margin">
    <div class="card" style="padding:50px !important">
        <div class="card-body" style="text-align:center;color:green">
          <p style="text-align:center"><img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg"><br>
        Ordered Proccess Successfully<br>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="col-12 grid-margin">
    <div class="card" style="padding:50px !important">
        <div class="card-body" style="text-align:center;color:#E2574C">
          <img src="<?php echo SiteUrl; ?>assets/images/cancel.png" style="width: 128px;"><br><br><br>
          <?php echo $response['message'];?>
        </div>
        <p align="center">
            <a href="<?php echo SiteUrl;?>MyAccounts/MyOrders">Continue</a>
        </p>
    </div>
</div>
<?php } ?>
<?php include_once("PaymentModeFooter.php");?>      