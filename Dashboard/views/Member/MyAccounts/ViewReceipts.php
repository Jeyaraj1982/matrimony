<?php
    $page="MyReceipts";
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $Receipt=$response['data']['Receipt'];
?>
<?php include_once("accounts_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">View Receipt</h4>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Receipt Number </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Receipt['ReceiptNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Invoice Number </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Receipt['InvoiceNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Member Name </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Receipt['MemberName'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Email ID </label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Receipt['EmailID'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Mobile Number</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Receipt['MobileNumber'];?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Receipt Value</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo number_format($Receipt['ReceiptAmount'],2);?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-2 col-form-label">Receipt Date</label>                       
            <label class="col-sm-10 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo putDateTime($Receipt['ReceiptDate']);?></label>
        </div>
        <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-6 col-form-label"><a href="<?php echo GetUrl("MyAccounts/MyReceipts");?>">List Of Receipts</a></label>                       
        </div>
    </div>
<?php include_once("accounts_footer.php");?>                    

 