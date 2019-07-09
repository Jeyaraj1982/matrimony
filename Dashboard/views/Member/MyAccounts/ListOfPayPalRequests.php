<?php
    $page="MyWallet";
    $spage="RefillWallet";
    $sp="Paypal";
    $response = $webservice->getData("Member","GetListOfPreviousPaypalRequests");
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Refill Wallet Paypal Requests</h4>
        <?php if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive" style="width: 120%;">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Req Id</th> 
                    <th>Txn Date</th> 
                    <th>Txn Amount</th>  
                    <th>Status</th>
                    <th></th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Requests) {
            ?>
                <tr>
                    <td><?php echo $Requests['PaypalID'];?></td>
                    <td><?php echo PutDateTime($Requests['TransactionOn']);?></td>
                    <td style="text-align:right"><?php echo $Requests['Amount'];?></td>
                    <td><?php if($Requests['IsSuccess']==0 && $Requests['IsFailure']==0){
                        echo "Pending";
                        }if($Requests['IsSuccess']==1 && $Requests['IsFailure']==0){
                            echo "Success";
                        }if($Requests['IsSuccess']==0 && $Requests['IsFailure']==1){
                            echo "Failure";}
                    ?></td>
                    <td><a href="<?php echo GetUrl("MyAccounts/ViewPaypalRequest/". $Requests['PaypalID'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
        
         <?php }else { ?>
           <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No requests found at this time<br><br>
        </div>
    <?php }?>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                    