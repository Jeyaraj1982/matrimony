<?php
    $page="MyWallet";
    $spage="RefillWallet";
    $sp="Bank";
    $response = $webservice->getData("Member","GetViewBankRequests");
     $Requests = $response['data'] ;
?>
<?php include_once("accounts_header.php");?>
    <form method="post" action="" name="form1" id="form1">
        <div class="col-sm-9" style="margin-top: -8px;color:#444">
            <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Bank Request</h4> <br>
            <div class="form-group row">
                <div class="col-sm-3">Request ID</div>
                <div class="col-sm-4"><?php echo $Requests['ReqID'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Request On</div>
                <div class="col-sm-4"><?php echo PutDateTime($Requests['RequestedOn']);?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Bank Name</div>
                <div class="col-sm-4"><?php echo $Requests['BankName'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction Amount</div>
                <div class="col-sm-4"><?php echo number_format($Requests['RefillAmount'],2);?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction Date</div>
                <div class="col-sm-4"><?php echo PutDate($Requests['TransferedOn']);?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction Mode</div>
                <div class="col-sm-4"><?php echo $Requests['TransferMode'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction ID</div>
                <div class="col-sm-4"><?php echo $Requests['TransactionID'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Status</div>
                <div class="col-sm-4"><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                        echo "Pending";
                        }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                            echo "Approved";
                        }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                            echo "Rejected";}
                    ?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"><a href="../ListOfBankRequests" >List of Requests</a></div>
            </div> 
        </div>
    </form>     
<?php include_once("accounts_footer.php");?>                               
                    