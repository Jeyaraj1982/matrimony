<?php 
    $page="ServiceRequest";
    include_once("service_request_to_menu.php");
?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Service Request</h4>
			<form method="post" action="">
			<div class="form-group row">
				<div class="col-sm-4" style="margin-right: -23px;">
					<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" id="CreateNewSupportTicket" name="ServiceRequest">
						<label class="custom-control-label" for="CreateNewSupportTicket">Create New Support Ticket &nbsp;&nbsp;<a href="<?php echo GetUrl("Support/Service/CreateNewSupportTicket");?>">Click here</a></label>
					</div>
				</div>
			</div>
				<div class="form-group row" >
					<div class="col-sm-4" style="margin-right: -23px;">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="ServiceReq" name="ServiceRequest">
							<label class="custom-control-label" for="ServiceReq">Profile Delete</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="custom-control custom-radio">
						  <input type="radio" class="custom-control-input" id="MembershipDelete" name="ServiceRequest" >
						  <label class="custom-control-label" for="MembershipDelete">Membership Delete</label>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<div class="col-sm-4" style="margin-right: -23px;">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="ProfileUnPublish" name="ServiceRequest">
							<label class="custom-control-label" for="ProfileUnPublish">Profile UnPublish</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="custom-control custom-radio">
						  <input type="radio" class="custom-control-input" id="UnPublishProfileToPublish" name="ServiceRequest" >
						  <label class="custom-control-label" for="UnPublishProfileToPublish">UnPublish Profile To Publish</label>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<div class="col-sm-4" style="margin-right: -23px;">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="ChangeProfileBasicInformation" name="ServiceRequest">
							<label class="custom-control-label" for="ChangeProfileBasicInformation">Change Profile Basic Information</label>
						</div>
					</div>
				</div>
				<!--<div class="form-group row">
					<div class="col-sm-1" style="margin-right: -23px;"><input type="radio"  id="ServiceRequest"  name="ChangeProfileBasicInformation"  <?php //echo ($Service['ChangeProfileBasicInformation']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
					<label for="ChangeProfileBasicInformation" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Change Profile Basic Information</label>
				</div>-->
				<div class="form-group row">
					<div class="col-sm-3"><button type="submit" name="SubmitRequest" id="SubmitRequest" class="btn btn-primary" style="font-family:roboto">Continue</button></div>
				</div>
			</form>
		</div>
	</div>
</div>
		