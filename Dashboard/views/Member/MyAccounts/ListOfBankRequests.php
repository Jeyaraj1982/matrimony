<?php
    $page="MyWallet";
    $spage="RefillWallet";
    $sp="Bank";
    $response = $webservice->getData("Member","GetListOfPreviousBankRequests");
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Refill Wallet Bank Requests</h4>
        <?php if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive" style="width: 120%;">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Req Id</th> 
                    <th>Req Date</th> 
                    <th>Bank Name</th> 
                    <th>Txn Amount</th>  
                    <th>Txn Date</th>
                    <th>Txn Mode</th>
                    <th>Status</th>
                    <th></th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Requests) {
            ?>
                <tr>
                    <td><?php echo $Requests['ReqID'];?></td>
                    <td><?php echo PutDateTime($Requests['RequestedOn']);?></td>
                    <td><?php echo $Requests['BankName'];?></td>
                    <td style="text-align:right"><?php echo $Requests['RefillAmount'];?></td>
                    <td><?php echo PutDateTime($Requests['TransferedOn']);?></td>
                    <td><?php echo $Requests['TransferMode'];?></td>
                    <td><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                        echo "Pending";
                        }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                            echo "Approved";
                        }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                            echo "Rejected";}
                    ?></td>
                    <td><a href="<?php echo GetUrl("MyAccounts/ViewBankRequest/". $Requests['ReqID'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
        
         <?php }else { ?>
           <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No Requests found at this time<br><br>
        </div>
    <?php }?>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                    