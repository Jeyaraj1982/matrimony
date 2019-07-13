<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Email Log</h4>
                </div>
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="EmailLog" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ActiveEmailLog"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="DeActiveEmailLog"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <h4 class="card-title"></h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Date</th>
                        <th>Mail To</th>
                        <th>Member Code</th>
                        <th>Franchisee Code</th>
                        <th>Subject</th>
                        <th>Mail For</th>
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetEmailLogs",array("Request"=>"DeActive")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo $log['EmailRequestedOn'];?></td>
                            <td><?php echo $log['EmailTo'];?></td>
                            <td style="text-align: right"><?php echo $log['MemberID'];?></td>
                            <td style="text-align: right"><?php echo $log['FranchiseeID'];?></td>
                            <td><?php echo $log['EmailSubject'];?></td>
                            <td><?php echo $log['EmaildFor'];?></td>
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
