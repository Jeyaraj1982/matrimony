<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Receipt</h4>
        <?php 
            $response = $webservice->getData("Admin","GetOrderInvoiceReceiptDetails",array("Request"=>"Receipt"));
            if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Receipt Number</th> 
                    <th>Receipt Date</th> 
                    <th>Invoice Number</th> 
                    <th style="text-align:right">Receipt Value</th> 
                    <th></th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Receipt) {
            ?>
                <tr>
                    <td><?php echo $Receipt['ReceiptNumber'];?></td>
                    <td><?php echo PutDateTime($Receipt['ReceiptDate']);?></td>
                    <td><?php echo $Receipt['InvoiceNumber'];?></td>
                    <td style="text-align:right"><?php echo number_format($Receipt['ReceiptAmount'],2);?></td>
                    <td><a href="#">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
    <?php } else {?>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No receipt found at this time<br><br>
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
