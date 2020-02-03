<?php 
    $page="IndividualMessagesLog";
    include_once("settings_header.php");
    $response = $webservice->getData("Admin","GetIndividualMessageInfo",array("Request" => "Messages"));
    $Message          = $response['data'][0];
?>
<div class="col-sm-10 rightwidget">   
    <form method="post" action="#" onsubmit="">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-12"><h4 class="card-title">View Individual Message</h4></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message From Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['FromCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Message To Code:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['ToMemberCode'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Subject:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['MessageSubject'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Content:</label>
                <div class="col-sm-9"><small style="color:#737373;"><?php echo $Message['MessageContent'];?></small></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Sent On:</label>
                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Message['CreatedOn']);?></small></div>
            </div>
            <a href="../IndividualMessages">List of Messages</a>
    </form>
</div>
<?php include_once("settings_footer.php");?>                    
