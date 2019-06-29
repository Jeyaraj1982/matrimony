<?php
    $page="LoginHistory";
?>
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Login History</h4>
        <div class="table-responsive" style="width: 120%;">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>
                        <th></th> 
                        <th>Logged On</th>  
                        <th>Logout On</th>
                        <th>IP Address</th>
                        <th>Country</th>
                        </tr>  
                    </thead>
                     <tbody>  
                     <?php 
                         $response = $webservice->GetLoginHistory(); 
                         if (sizeof($response['data'])>0) {
                    ?>
                        <?php foreach($response['data'] as $History) { ?>
                                <tr>
                                <td>
                                    <?php if ($History['LoginStatus']==1){?>
                                        <img src="<?php echo SiteUrl?>assets/images/tick.gif" style="width: 16px;height: 16px;">
                                        <?php }else{ ?>
                                        <img src="<?php echo SiteUrl?>assets/images/Red-Cross-Mark-PNG-Pic.png" style="width: 10px;height: 10px;">
                                    <?php } ?>
                                </td>
                                <td><?php echo putDateTime($History['LoginOn']);?></td>
                                <td><?php echo (strlen(trim($History['UserLogout']))>0) ? putDateTime($History['UserLogout']) : "";?></td>
                                <td><?php echo $History['BrowserIp'];?></td>
                                <td><?php echo $History['CountryName'];?></td>
                                
                                </tr>
                        <?php } } else {?>            
                        
                        <?php } ?>
                      </tbody>                        
                     </table>
                  </div>
    </div>
</form>
<?php include_once("settings_footer.php");?>                   