<?php
    $page="MyWallet";
    $spage="RefillWallet";
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Refill Wallet</h4>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <table align="center">
                <tr>
                    <td>
                        <img src="<?php echo ImageUrl;?>bankbuilding.png" style="height:77px;margin-top:6px"><Br><Br> 
                    </td>
                    <td width="90px">&nbsp;</td>
                    <td>
                        <img src="<?php echo ImageUrl;?>paypalpayment.png" style="height:85px"><Br> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="color:#999;font-size:11px;">FT/NEFT/IMPS/B2B</span><Br><Br>
                        <img style="margin-top:-3px" src="<?php echo ImageUrl;?>hand_point_right.png" align="absmiddle">&nbsp;&nbsp;<a href="<?php echo GetUrl("MyAccounts/RefillBank");?>" style="color:#2f5bc4">Continue Bank Transfer</a><br>  
                    </td>
                    <td></td>
                    <td>
                        <span style="color:#999;font-size:11px;">Credit/Debit Cards</span><Br><Br>
                        <img style="margin-top:-3px" src="<?php echo ImageUrl;?>hand_point_right.png" align="absmiddle">&nbsp;&nbsp;<a href="<?php echo GetUrl("MyAccounts/RefillPaypal");?>" style="color:#2f5bc4">Continue Paypal</a><br>  
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                    