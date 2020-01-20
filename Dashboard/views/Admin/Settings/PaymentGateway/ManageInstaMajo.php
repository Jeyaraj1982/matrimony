<?php $page="instamajo";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
	<h4 class="card-title">Manage Instamajo</h4> 
	<a href="<?php echo GetUrl("Settings/PaymentGateway/InstaMajo");?>" class="btn btn-primary">Create</a> 	
	<div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Action Url</th>
				<th>Client ID</th>
				<th>Secret Key</th>                   
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Instamajo")); ?>  
				<?php foreach($response['data'] as $Instamajo) { ?>
						<tr>
						<td><?php echo $Instamajo['VenderName'];?></td>
						<td><?php echo $Instamajo['ActionUrl'];?></td>
						<td><?php echo $Instamajo['ClientID'];?></td>
						<td><?php echo $Instamajo['Secretky'];?></td>
						<td><?php echo $Instamajo['VendorMode'];?></td>
						<td><?php echo  putDateTime($Instamajo['CreatedOn']);?></td>
						<td style="text-align:right"><a href="<?php echo GetUrl("Settings/PaymentGateway/EditInstamajo". $Instamajo['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a></td>&nbsp;&nbsp;&nbsp;
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