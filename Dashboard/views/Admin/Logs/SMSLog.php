<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">SMS Log</h4>
                </div>
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="SMSLog" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="MemberSMSLog"><small style="font-weight:bold;text-decoration:underline">Member</small></a>&nbsp;|&nbsp;
                        <a href="FranchiseeSMSLog"><small style="font-weight:bold;text-decoration:underline">Franchisee</small></a>&nbsp;|&nbsp;
                        <a href="SuccessSMSLog"><small style="font-weight:bold;text-decoration:underline">Success</small></a>&nbsp;|&nbsp;
                        <a href="FailureSMSLog"><small style="font-weight:bold;text-decoration:underline">Failure</small></a>&nbsp;|&nbsp;
                        <a href="Report"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Date</th>
                        <th>SMS To</th>
                        <th>Message</th>
                        <th>ApiID</th>
                        <th>Status</th>
                        </tr>                            
                    </thead>
                       <tbody> 
                    <?php $response = $webservice->getData("Admin","GetSMSLogs",array("Request"=>"All")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo putDateTime($log['RequestedOn']);?></td>
                            <td><?php echo $log['MobileNumber'];?></td>
                            <td><?php echo $log['TextMessage'];?></td>
                            <td><?php echo $log['APIID'];?></td>
                            <td><?php echo $log['Status'];?></td>
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
