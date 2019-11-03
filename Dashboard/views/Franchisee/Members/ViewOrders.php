<?php 
    $response = $webservice->getData("Franchisee","ViewMemberOrderInvoiceReceiptDetails");
    $order=$response['data']['Order']; ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">View Orders</h4>
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
                        <label class="col-sm-6 col-form-label"><a href="<?php echo GetUrl("Members/ManageOrders");?>">List Of Orders</a></label>                       
                    </div>
            </div>
        </div>
    </div>
   