<?php $page="paytm";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
	<h4 class="card-title">Manage Paytm</h4>    
	<a href="<?php echo GetUrl("Settings/PaymentGateway/PayTm");?>" class="btn btn-primary">Create</a> 	
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Payu Biz Name</th>
				<th>Marchant ID</th>
				<th>Website</th>
				<th>Identity</th>
				<th>Channel</th>
				<th>Secret Key</th>                   
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Paytm")); ?>  
				<?php foreach($response['data'] as $Paytm) { ?>
						<tr>
						<td><?php echo $Paytm['VenderName'];?></td>
						<td><?php echo $Paytm['MarchantID'];?></td>
						<td><?php echo $Paytm['WebsiteName'];?></td>
						<td><?php echo $Paytm['Identity'];?></td>
						<td><?php echo $Paytm['Channel'];?></td>
						<td><?php echo $Paytm['Secretky'];?></td>
						<td><?php echo $Paytm['VendorMode'];?></td>
						<td><?php echo  putDateTime($Paytm['CreatedOn']);?></td>
						<td style="text-align:right"><a href="<?php echo GetUrl("Settings/PaymentGateway/EditPaytm". $Paytm['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a></td>&nbsp;&nbsp;&nbsp;
						</tr>
				<?php } ?>            
			</tbody>                        
		</table>
    </div>
</div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<?php include_once("settings_footer.php");?>                    