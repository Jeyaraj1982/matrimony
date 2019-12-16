<?php
    $page="MyInvoices";
    $response = $webservice->getData("Franchisee","GetOrderInvoiceReceiptDetails",array("Request"=>"Invoice"));
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Invoices</h4>
        <?php if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive" style="width: 120%;">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Invoice Number</th> 
                    <th>Invoice Date</th> 
                    <th>Order Number</th> 
                    <th>Order Date</th> 
                    <th style="text-align:right">Invoice Value</th> 
                    <th></th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Invoice) {
            ?>
                <tr>
                    <td><?php echo $Invoice['InvoiceNumber'];?></td>
                    <td><?php echo PutDateTime($Invoice['InvoiceDate']);?></td>
                    <td><?php echo $Invoice['OrderNumber'];?></td>
                    <td><?php echo PutDateTime($Invoice['OrderDate']);?></td>
                    <td style="text-align:right"><?php echo number_format($Invoice['InvoiceValue'],2);?></td>
                    <td><a href="<?php echo GetUrl("MyAccounts/ViewInvoices/". $Invoice['InvoiceNumber'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
    <?php } else {?>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No invoices found at this time<br><br>
        </div>
    <?php } ?>
    </div>
</form>                
<?php include_once("accounts_footer.php");?>                    

