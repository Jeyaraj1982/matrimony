<?php 
    $page="ClosedTickets";
    include_once("service_request_to_menu.php");
	$response    = $webservice->getData("Member","GetSupportTicketsDetails",array("Request"=>"Closed"));
?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">View Open Ticket</h4>
			<form method="post" action="">
			<div class="form-group row">
				<div class="col-sm-2">Team</div>
				<div class="col-sm-6"><?php echo $Ticket[0]['Team'];?></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Subject</div>
				<div class="col-sm-6"><?php echo $Ticket[0]['Subject'];?></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Description</div>
				<div class="col-sm-6"><?php echo $Ticket[0]['Content'];?></div>
			</div>
			<div class="form-group row">
                <div class="col-sm-2">Attachment</div>
				<div class="col-sm-6"><img src="<?php echo AppUrl;?>uploads/ServiceRequest/<?php echo $Ticket[0]['MemberCode'];?>/Ticket/<?php echo $Ticket[0]['FileName'];?>" style="height:120px;"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><a href="<?php echo GetUrl("Support/Service/ClosedTickets");?>">List of closed tickets</div>
			</div>
			</form>
		</div>
	</div>
</div>
		