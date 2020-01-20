<?php $page="Payu";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
	<h4 class="card-title">Manage Payu</h4>   
	<a href="<?php echo GetUrl("Settings/PaymentGateway/Payu");?>" class="btn btn-primary">Create</a> 	
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Payu Biz Name</th>
				<th>Marchant ID</th>
				<th>Secret Key</th>                   
				<th>Salt ID</th>
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Payu")); ?>  
				<?php foreach($response['data'] as $Payu) { ?>
						<tr>
						<td><?php echo $Payu['VenderName'];?></td>
						<td><?php echo $Payu['MarchantID'];?></td>
						<td><?php echo $Payu['Secretky'];?></td>
						<td><?php echo $Payu['SaltID'];?></td>
						<td><?php echo $Payu['VendorMode'];?></td>
						<td><?php echo  putDateTime($Payu['CreatedOn']);?></td>
						<td style="text-align:right"><a href="<?php echo GetUrl("Settings/PaymentGateway/EditPayu". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a></td>&nbsp;&nbsp;&nbsp;
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