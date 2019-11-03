<?php 
    $response = $webservice->getData("Franchisee","ViewMemberOrderInvoiceReceiptDetails");
    $Invoice=$response['data']['Invoice']; ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">View Invoice</h4>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Invoice Number </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['InvoiceNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Invoice Date </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo putDateTime($Invoice['InvoiceDate']);?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Order Number </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['OrderNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Order Date </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo putDateTime($Invoice['OrderDate']);?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Member Name </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['MemberName'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Email ID </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['EmailID'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Mobile Number</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['MobileNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Invoice Value</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo number_format($Invoice['InvoiceValue'],2);?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-6 col-form-label"><a href="<?php echo GetUrl("Members/ManageInvoices");?>">List Of Invoices</a></label>                       
        </div>
            </div>
        </div>
    </div>
   