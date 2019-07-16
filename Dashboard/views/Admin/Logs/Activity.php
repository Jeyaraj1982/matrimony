<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Activity Log</h4>
                </div>
                    <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="Activity" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="MemberActivity"><small style="font-weight:bold;text-decoration:underline">Member</small></a>&nbsp;|&nbsp;
                    <a href="FranchiseeActivity"><small style="font-weight:bold;text-decoration:underline">Franchisee</small></a>&nbsp;|&nbsp;
                    <a href="Report"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Date</th>
                        <th>Member Code</th>
                        <th>Franchisee Code</th>
                        <th>Activity</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetActivityHistory",array("Request"=>"All")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo putDateTime($log['ActivityOn']);?></td>
                            <td><?php echo $log['MemberCode'];?></td>
                            <td><?php echo $log['FranchiseeID'];?></td>
                            <td><?php echo $log['ActivityString'];?></td>
                            <!--<td><a href="<?php // echo GetUrl("Logs/View/". $log[''].".html");?>"></td>-->
                            <td>View</td>
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
