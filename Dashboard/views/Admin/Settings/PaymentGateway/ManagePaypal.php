<?php $page="Paypal";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
	<h4 class="card-title">Manage Paypal</h4>    
	<a href="<?php echo GetUrl("Settings/PaymentGateway/Paypal");?>" class="btn btn-primary">Create</a> 	
    
	<div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Email ID</th>
				<th>Marchant ID</th>
				<th>Secret Key</th>                   
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Paypal")); ?>  
				<?php foreach($response['data'] as $Paypal) { ?>
						<tr>
						<td><?php echo $Paypal['VenderName'];?></td>
						<td><?php echo $Paypal['EmailID'];?></td>
						<td><?php echo $Paypal['MarchantID'];?></td>
						<td><?php echo $Paypal['Secretky'];?></td>
						<td><?php echo  putDateTime($Paypal['CreatedOn']);?></td>
						<td style="text-align:right"><a href="<?php echo GetUrl("Settings/PaymentGateway/EditPaypal". $Paypal['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a></td>
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