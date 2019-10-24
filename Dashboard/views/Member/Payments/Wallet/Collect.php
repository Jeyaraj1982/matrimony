<?php 
    include_once("../../PaymentModeHeader.php");
    $response = $webservice->getData("Member","CollectPaymentFromWallet",$_POST);  
    print_r($response);
    if ($response['status']=="success") {    
?>
    <div class="col-sm-9" style="margin-top: -8px;" >
        <p style="text-align:center"><img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg"><br>
        Ordered Proccess Successfully<br>
    </div>
<?php } else { ?>
    <div class="col-sm-9" style="margin-top: -8px;" >
        <?php echo $response['message'];?>
    </div>
<?php } ?>
<?php include_once("PaymentModeFooter.php");?>      