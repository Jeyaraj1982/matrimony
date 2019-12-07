<?php
    $page="MyReceipts";
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $Receipt=$response['data']['Receipt'];
?>
<?php include_once("accounts_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">View Receipt</h4>
		<div style="width:770px;border:1px solid #737373;padding: 10px 20px;">
			<div class="from-group row" style="margin-bottom: -10px;">
				<label class="col-sm-6 col-form-label" style="color:#737373;">Receipt To&nbsp;</label>
				<label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">Receipt Details&nbsp;</label>
			</div>
			<div class="form-group row">
				<label class="col-sm-6 col-form-label" style="color:#737373;">
					<?php echo $Receipt['MemberName'];?><br><br>
					Email  :&nbsp;<?php echo $Receipt['EmailID'];?><br><br>
					Mobile :&nbsp;<?php echo $Receipt['MobileNumber'];?>
				</label>
				<label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">
					Receipt #&nbsp;:&nbsp;<?php echo $Receipt['ReceiptNumber'];?><br><br>
					Receipt Date&nbsp;:&nbsp;<?php echo $Receipt['ReceiptDate'];?><br><br>
					Invoice #&nbsp;:&nbsp;<?php echo $Receipt['InvoiceNumber'];?>
				</label>
			</div>
			<hr style="margin-right: -22px;margin-left: -19px;">
		</div><br><br>
		<div class="form-group row">
			<div class="col-sm-6"><a href="<?php echo GetUrl("MyAccounts/MyReceipts");?>">List Of Receipts</a></div>
			<div class="col-sm-6" style="text-align:right">
				<a href="<?php echo GetUrl("Receipt/".$_GET['Code'].".htm");?>" data-toggle="tooltip" title="Print profile information" target="_blank"><i class="menu-icon mdi mdi-printer" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Print</label></a> 
				<a href="<?php echo GetUrl("DownloadReceipt/".$_GET['Code'].".pdf");?>" data-toggle="tooltip" title="Download profile information" target="_blank"><i class="menu-icon mdi mdi-download" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Download</label></a>   
			</div>
		</div>
    </div>
<?php include_once("accounts_footer.php");?>                    

 