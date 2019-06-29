<?php
    $page="MyActivities";
    $response = $webservice->GetMemberInfo();
    $Member=$response['data'];    
?>
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Activities</h4>
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   