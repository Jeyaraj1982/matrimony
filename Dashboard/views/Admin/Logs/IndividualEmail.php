<?php $page="IndividualEmailLog";?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10 rightwidget">   
    <form method="post" action="#" onsubmit="">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3"><h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Individual Email</h4></div>
            </div>
            <div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                    <thead>  
                        <tr> 
                            <th>Admin Code</th>
                            <th>Member Code</th>
                            <th>Message Subject</th>                   
                            <th>Message Content</th>                   
                            <th>Sent On</th>
                            <th style="width:50px;"></th>                          
                        </tr>  
                    </thead>
                    <tbody> 
                    <?php $response = $webservice->getData("Admin","GetIndividualMessage",array("Request"=>"Email")); ?>  
                    <?php foreach($response['data'] as $SMS ) { ?>
                        <tr>
                            <td><?php echo $SMS['MessageFromCode'];?></td>
                            <td><?php echo $SMS['MessageToMemberCode'];?></td>
                            <td><?php echo $SMS['EmailSubject'];?></td>
                            <td><?php echo $SMS['EmailContent'];?></td>
                            <td><?php echo  putDateTime($SMS['SentOn']);?></td>
                            <td style="text-align:right">
                                <a href="<?php echo GetUrl("Logs/ViewIndividualEmail/". $SMS['ManualSendID'].".htm"); ?>"><span>View</span></a></td>
                        </tr>
                    <?php } ?>            
                    </tbody>                        
                </table>
              </div>
            </div>
    </form>
</div>
<?php include_once("settings_footer.php");?>                    
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
 
