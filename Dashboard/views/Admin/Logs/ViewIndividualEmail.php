<?php 
    $page="IndividualEmailLog";
    include_once("settings_header.php");
    $response = $webservice->getData("Admin","GetIndividualMessageInfo",array("Request" => "Email"));
    $Email    = $response['data'][0];
?>
<div class="col-sm-10 rightwidget">   
    <form method="post" action="#" onsubmit="">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3"><h4 class="card-title">View Individual Email</h4></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message From Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Email['MessageFromCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message To Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Email['MessageToMemberCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Subject:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Email['EmailSubject'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Content:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Email['EmailContent'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Transaction ID:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Email['TxnID'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Sent On:</label>
                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Email['SentOn']);?></small></div>
            </div>
            <a href="../IndividualEmail">List of Individual Email</a>
    </form>
</div>
<?php include_once("settings_footer.php");?>                    
 