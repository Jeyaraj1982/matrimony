<?php 
    $page="ClosedTickets";
    include_once("service_request_to_menu.php");
?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Closed Tickets</h4>
			<div class="table-responsive">
				<table id="myTable" class="table table-striped" width="100%">
				  <thead>
					<tr>
					  <th>ID</th>  
					  <th>Tickets</th>
					  <th></th> 
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><a href="<?php echo GetUrl("Support/Service/ViewClosedTickets");?>">View</a></td>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>   
		