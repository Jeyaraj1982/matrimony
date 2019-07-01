<?php
    $page="MyWallet";
    $spage="RefillWallet";
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;color:#444">
        <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Using Paypal</h4>
        <span style="color:#999;">It's is safe transaction and gives refill amount instantly.</span> <br><br>
        Refill Amount: (₹)<br> 
        <input type="text" placeholder="Enter Amount" name="Amount" style="border:1px solid #ccc;padding:3px;padding-left:10px;"><br>
        <span style="color:#999;font-size:11px;">Multiples of 100 and Minimum ₹ 500 & Maximum ₹ 10000</span><br><br><br><br>
         <input type="checkbox">&nbsp;I understand terms of wallet udpate <a href="">Lean more</a><Br><br>
        <div><img src="<?php echo ImageUrl;?>paypal_checkout.png" style="height:36px;cursor:pointer">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://nahami.online/sl/Dashboard/MyAccounts/RefillBank" style="color:#2f5bc4">Continue Bank Transfer</a><br>  
        </div>
        <!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="mmminfoshelp@gmail.com">
        <input type="hidden" name="item_name" value="Donation">
        <input type="hidden" name="amount" value="">
        <select name="currency_code" style="padding:4px 10px">
            <option value="USD">USD
            </option><option value="INR">INR
        </option></select><br><br>
        <input type="hidden" name="undefined_quantity" value="1">
        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" name="submit" border="0">
    </form> -->
    
    <bR><br>
    <bR><br>
    <bR><br>
 
    <div style="text-align:right"><img src="<?php echo ImageUrl;?>paypal_lic.png"></div>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                    