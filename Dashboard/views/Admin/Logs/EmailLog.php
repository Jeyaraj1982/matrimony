<?php $page="EmailLog";?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10 rightwidget">   
<form method="post" action="#" onsubmit="">
  <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Email Log</h4>
                </div>
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="EmailLog" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="MemberEmailLog"><small>Member</small></a>&nbsp;|&nbsp;
                        <a href="FranchiseeEmailLog"><small>Franchisee</small></a>&nbsp;|&nbsp;
                        <a href="SuccessEmailLog"><small>Success</small></a>&nbsp;|&nbsp;
                        <a href="FailureEmailLog"><small>Failure</small></a>&nbsp;|&nbsp;
                        <a href="Report"><small>Report</small></a>
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
                        <th>Status</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetEmailLogs",array("Request"=>"All")); ?>  
                        <?php foreach($response['data'] as $log) { ?>
                        <tr>
                            <td><?php echo putDate($log['EmailRequestedOn']);?></td>
                            <td><?php echo $log['EmailTo'];?></td>
                            <td style="text-align: right"><?php if($log['MemberID']==0) {echo " ";} else { echo $log['MemberID']; }?><?php ;?></td>
                            <td style="text-align: right"><?php if($log['FranchiseeID']==0) {echo " ";} else { echo $log['FranchiseeID']; }?><?php ;?></td>
                            <td><?php echo $log['EmailSubject'];?></td>
                            <td><?php echo $log['EmaildFor'];?></td>
                            <td><?php echo $log['Status'];?></td>
                            <td></td>
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