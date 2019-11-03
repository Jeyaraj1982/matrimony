<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Invoices</h4>
        <?php 
            $response = $webservice->getData("Franchisee","GetMemberOrderInvoiceReceiptDetails",array("Request"=>"Invoice"));
            if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive">
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
                    <td><a href="<?php echo GetUrl("Members/ViewInvoices/". $Invoice['InvoiceNumber'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                         
        </table>
    </div>
    <?php } else {?>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No invoice found at this time<br><br>
        </div>
    <?php } ?>
    </div>
                </div>
              </div>
        </form>   
        
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
