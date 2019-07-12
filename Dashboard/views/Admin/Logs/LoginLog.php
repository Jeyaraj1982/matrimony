<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Login Log</h4>
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
                    <?php $response = $webservice->getData("Admin","GetLoginLogs",array("Request"=>"All")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo $log['LoginOn'];?></td>
                            <td><?php echo $log['MemberID'];?></td>
                            <td><?php echo $log['FranchiseeID'];?></td>
                            <td style="text-align: right"><?php echo $log['BrowserIp'];?></td>
                            <td style="text-align: right"><?php echo $log['BrowserName'];?></td>
                            <td><?php if($log['LoginStatus']==0){ echo "Failed";}else{ echo "Success"; };?></td>
                        </tr>
                        <?php } ?>
                      </tbody>                        
                     </table>
                  </div>
                </div>
              </div>
            </div>
        </form>   
        
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
