<?php
   $response = $webservice->getData("Admin","GetIndividualMessageInfo",array("Request" => "Messages"));
   $Message          = $response['data'][0];
?>
<form method="post" id="frmfrn">
<div class="row">
<div class="col-sm-9">
<div class="col-12 grid-margin">
	<div class="card">
		<div class="card-body">
			<div style="max-width:770px !important;">
				<h4 class="card-title">View Individual Message</h4>  
				<div class="form-group row">
                    <div class="col-sm-3"><small>Message From Code:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['FromCode'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Message To Code:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['ToMemberCode'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Subject:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['MessageSubject'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Content:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['MessageContent'];?></small></div>
                </div>
                <div class="form-group row">
					<div class="col-sm-3"><small>Created On:</small> </div>
					<div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Message['CreatedOn']);?></small></div>
				</div>
			</div>                                      
		</div>    
	</div> 
</div>	
</div>
</div>	
</form>
  <div class="col-sm-12 grid-margin" style="text-align: left; padding-top:5px;color:skyblue;">
    <a href="../IndividualMessages"><small style="font-weight:bold;text-decoration:underline">List of Messages</small></a>
</div>        

  