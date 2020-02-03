<?php 
    $page="IndividualSMSLog";
    include_once("settings_header.php");
    $response = $webservice->getData("Admin","GetIndividualMessageInfo",array("Request" => "SMS"));
    $SMS          = $response['data'][0];
?>
<div class="col-sm-10 rightwidget">   
    <form method="post" action="#" onsubmit="">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3"><h4 class="card-title">View Individual SMS</h4></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message From Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['MessageFromCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message To Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['MessageToMemberCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['SMSMessage'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Transaction ID:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $SMS['TxnID'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Sent On:</label>
                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($SMS['SentOn']);?></small></div>
            </div>
            <a href="../IndividualSMS">List of Individual SMS</a>
    </form>
</div>
<?php include_once("settings_footer.php");?>                    
