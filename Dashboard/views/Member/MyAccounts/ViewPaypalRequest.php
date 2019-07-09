<?php
    $page="MyWallet";
    $spage="RefillWallet";
    $sp="Paypal";
    $response = $webservice->getData("Member","GetViewPaypalRequests");
     $Requests = $response['data'] ;
?>
<?php include_once("accounts_header.php");?>
    <form method="post" action="" name="form1" id="form1">
        <div class="col-sm-9" style="margin-top: -8px;color:#444">
            <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Paypal Request</h4> <br>
            <div class="form-group row">
                <div class="col-sm-3">Paypal Name</div>
                <div class="col-sm-4"><?php echo $Requests['PayPalName'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Paypal Amout</div>
                <div class="col-sm-4"><?php echo $Requests['Amount'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Paypal Account</div>
                <div class="col-sm-4"><?php echo $Requests['PaypalAccountEmail'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction On</div>
                <div class="col-sm-4"><?php echo $Requests['TransactionOn'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"><a href="../ListOfPayPalRequests" >List of Requests</a></div>
            </div> 
        </div>
    </form>     
<?php include_once("accounts_footer.php");?>                               