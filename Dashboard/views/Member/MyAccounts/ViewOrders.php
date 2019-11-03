<?php
    $page="MyOrders";
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $order=$response['data']['Order'];
?>
<?php include_once("accounts_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">View Order</h4>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Order Number </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $order['OrderNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Member Name </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $order['MemberName'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Email ID </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $order['EmailID'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Mobile Number</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $order['MobileNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Order Value</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo number_format($order['OrderValue'],2);?></label>
        </div>
        <?php if($order['IsPaid']==1){?>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Invoice Number</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $order['InvoiceNumber'];?></label>
        </div>
        <?php } ?>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-6 col-form-label"><a href="<?php echo GetUrl("MyAccounts/MyOrders");?>">List Of Orders</a></label>                       
        </div>
    </div>
<?php include_once("accounts_footer.php");?>                    

 