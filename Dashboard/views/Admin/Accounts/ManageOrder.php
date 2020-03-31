<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <div class="form-group row">
               <div class="col-sm-6">
                <h4 class="card-title">Orders</h4>
               </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="<?php  echo GetUrl("Accounts/ManageOrder?Filter=Order&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
                    <a href="<?php  echo GetUrl("Accounts/ManageOrder?Filter=Order&Status=Paid");?>"><?php if($_GET['Status']=="Paid") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Paid</small></a>&nbsp;|&nbsp;
                    <a href="<?php  echo GetUrl("Accounts/ManageOrder?Filter=Order&Status=Unpaid");?>"><?php if($_GET['Status']=="Unpaid") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Unpaid</small></a>&nbsp;|&nbsp;
                    <a href="<?php  echo GetUrl("Accounts/ManageOrder?Filter=Order&Status=Cancelled");?>"><?php if($_GET['Status']=="Cancelled") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Cancelled</small></a>
                </div>
            </div>
        <?php 
             if($_GET['Filter']=="Order"){ 
                    if( $_GET['Status']=="All"){
                        $response = $webservice->getData("Admin","GetOrderInvoiceReceiptDetails",array("Request"=>"Order"));
                    }
                    if( $_GET['Status']=="Paid"){
                       $response = $webservice->getData("Admin","GetOrderInvoiceReceiptDetails",array("Request"=>"PaidOrder")); 
                    }
                    if( $_GET['Status']=="Unpaid"){
                       $response = $webservice->getData("Admin","GetOrderInvoiceReceiptDetails",array("Request"=>"UnpaidOrder")); 
                    }
                    if( $_GET['Status']=="Cancelled"){
                       $response = $webservice->getData("Admin","GetOrderInvoiceReceiptDetails",array("Request"=>"CancellOrder")); 
                    }
                }
            if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Order Number</th> 
                    <th>Member ID</th> 
                    <th>Member Name</th> 
                    <th>Order Date</th> 
                    <th>Plan Name</th> 
                    <th style="text-align:right">Order Value</th> 
                    <th>Invoice Number</th> 
                    <th></th> 
                </tr>  
            </thead>
            <tbody>  
            <?php 
                foreach($response['data'] as $Orders) {
            ?>
                <tr>
                    <td><?php echo $Orders['OrderNumber'];?></td>
                    <td><?php echo $Orders['OrderByMemberCode'];?></td>
                    <td><?php echo $Orders['MemberName'];?></td>
                    <td><?php echo PutDateTime($Orders['OrderDate']);?></td>
                    <td><?php echo $Orders['OrderName'];?></td>
                    <td style="text-align:right"><?php echo number_format($Orders['OrderValue'],2);?></td>
                    <td>
                        <?php if($Orders['IsPaid']==1){ 
                             echo $Orders['InvoiceNumber'];
                        } else{ ?>
                           <button type="submit" name="Paynow" class="btn btn-primary" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Pay Now</button>&nbsp;&nbsp; 
                           <button type="submit" name="Cancel" class="btn btn-danger" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Cancel</button> 
                      <?php }  ?>
                        
                    </td>
                    <td><a href="<?php echo GetUrl("Accounts/ViewOrders/". $Orders['OrderNumber'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
    <?php } else {?>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No orders found at this time<br><br>
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
