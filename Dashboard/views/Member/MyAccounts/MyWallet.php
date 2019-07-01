<?php
    $page="MyWallet";
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Wallet</h4>
        <div style="padding:40px;padding-bottom:100px;text-align:center">
            <img src="<?php echo ImageUrl;?>wallet.svg" style="height:128px"><Br><Br>
            You have ₹ 0.00<br><br>
            <img style="margin-top:-3px" src="<?php echo ImageUrl;?>hand_point_right.png" align="absmiddle">&nbsp;&nbsp;<a href="<?php echo GetUrl("MyAccounts/RefillWallet");?>" style="color:#2f5bc4">Refill your wallet</a><br>  
            <span style="color:#999;font-size:11px;">Refill your wallet Using Bank Transfer or Paypal.</span>
        </div>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                     