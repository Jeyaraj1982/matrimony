<?php $page="LoginLog";?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10 rightwidget">   
<form method="post" action="#" onsubmit="">
<div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Login Log</h4>
                </div>
                    <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="LoginLog" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="MemberLoginLog"><small>Member</small></a>&nbsp;|&nbsp;
                    <a href="FranchiseeLoginLog"><small>Franchisee</small></a>&nbsp;|&nbsp;
                    <a href="SuccessLoginLog"><small>Success</small></a>&nbsp;|&nbsp;
                    <a href="FailureLoginLog"><small style="font-weight:bold;text-decoration:underline">Failure</small></a>&nbsp;|&nbsp;
                    <a href="Report"><small>Report</small></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Date</th>
                        <th>Member Code</th>                                                                   
                        <th>Franchisee Code</th>                                                                         
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>Status</th>
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetLoginLogs",array("Request"=>"Failure")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo putDate($log['LoginOn']);?></td>
                            <td><?php if($log['MemberID']==0) {echo " ";} else { echo $log['MemberID']; }?></td>
                            <td><?php if($log['FranchiseeID']==0) {echo " ";} else { echo $log['FranchiseeID']; }?><?php ;?></td>
                            <td style="text-align: right"><?php echo $log['BrowserIp'];?></td>
                            <td style="text-align: right"><?php echo $log['BrowserName'];?></td>
                            <td><?php if($log['LoginStatus']==0){ echo "Failed";}else{ echo "Success"; };?></td>
                        </tr>
                        <?php } ?>                                                                                       
                      </tbody>                        
                     </table>
                  </div>
                </div>
</form>
<?php include_once("settings_footer.php");?>                    
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>