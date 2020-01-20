<?php $page="ccavenue";	
	include_once("settings_header.php");
	?>
<div class="col-sm-10 rightwidget">
	<h4 class="card-title">Manage CCavenue</h4>
	<a href="<?php echo GetUrl("Settings/PaymentGateway/CCavenue");?>" class="btn btn-primary">Create</a> 	
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Marchant ID</th>
				<th>Secret Key</th>                   
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"CCavenue")); ?>  
				<?php foreach($response['data'] as $CCavenue) { ?>
						<tr>
						<td><?php echo $CCavenue['VenderName'];?></td>
						<td><?php echo $CCavenue['MarchantID'];?></td>
						<td><?php echo $CCavenue['Secretky'];?></td>
						<td><?php echo $CCavenue['VendorMode'];?></td>
						<td><?php echo  putDateTime($CCavenue['CreatedOn']);?></td>
						<td style="text-align:right"><a href="<?php echo GetUrl("Settings/PaymentGateway/EditCcavenue". $CCavenue['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a></td>&nbsp;&nbsp;&nbsp;
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