<?php 
    $page="OpenTickets";
    include_once("service_request_to_menu.php");
	//$response    = $webservice->getData("Member","GetSupportTeamDetails");
	
?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">View Open Ticket</h4>
			<form method="post" action="">
			<div class="form-group row">
				<div class="col-sm-2">Team</div>
				<div class="col-sm-6"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Subject</div>
				<div class="col-sm-6"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Description</div>
				<div class="col-sm-6"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Attachment</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><a href="<?php echo GetUrl("Support/Service/OpenTickets");?>">List of open tickets</div>
			</div>
			</form>
		</div>
	</div>
</div>
		