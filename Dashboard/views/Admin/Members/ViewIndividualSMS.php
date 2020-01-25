<?php
   $response = $webservice->getData("Admin","GetIndividualMessageInfo",array("Request" => "SMS"));
   $SMS          = $response['data'][0];
?>
<form method="post" id="frmfrn">
<div class="row">
<div class="col-sm-9">
<div class="col-12 grid-margin">
	<div class="card">
		<div class="card-body">
			<div style="max-width:770px !important;">
				<h4 class="card-title">View Individual SMS</h4>  
				<div class="form-group row">
                    <div class="col-sm-3"><small>Message From Code:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['MessageFromCode'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Message To Code:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['MessageToMemberCode'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Message:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['SMSMessage'];?></small></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3"><small>Transaction ID:</small> </div>
                    <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['TxnID'];?></small></div>
                </div>
                <div class="form-group row">
					<div class="col-sm-3"><small>Sent On:</small> </div>
					<div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($SMS['SentOn']);?></small></div>
				</div>
			</div>                                      
		</div>    
	</div> 
</div>	
</div>
</div>	
</form>
<div class="col-sm-12 grid-margin" style="text-align: left; padding-top:5px;color:skyblue;">
    <a href="../IndividualSMS"><small style="font-weight:bold;text-decoration:underline">List of Messages</small></a>
</div>
          

  