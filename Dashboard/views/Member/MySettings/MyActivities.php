<?php
    $page="MyActivities";
    $response = $webservice->GetNotificationHistory(); 
?>
<?php include_once("settings_header.php");?>
<div class="col-sm-9" style="margin-top: -8px;">
    <h4 class="card-title">My Activities</h4>
        <?php if (sizeof($response['data'])>0) { ?>
        <div class="table-responsive" style="width: 120%;">
            <table id="myTable" class="table table-striped">
                <thead>  
                    <tr>
                        <th style="width: 110px;;">Activity On</th>
                        <th>Activity</th> 
                    </tr>  
                </thead>
                <tbody>  
                <?php foreach($response['data'] as $History) { ?>
                    <tr>
                        <td><?php echo putDateTime($History['ActivityOn']);?></td>
                        <td><?php echo $History['ActivityString'];?></td>
                    </tr>
                <?php } ?>
                </tbody>                        
            </table>
        </div>
        <?php } else {?>            
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>report.svg" style="height:128px"><Br><Br>
            No recent activities found at this time<br><br>
        </div>            
        <?php } ?>
</div>
<?php include_once("settings_footer.php");?>                   