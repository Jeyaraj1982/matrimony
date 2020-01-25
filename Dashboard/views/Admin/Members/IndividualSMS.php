<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Individual SMS</h4>
                </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                </div>
                </div>
                <div class="table-responsive">   
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Admin Code</th>
                        <th>Member Code</th>
                        <th>Message</th>                   
                        <th>Sent On</th>
                        <th style="width:50px;"></th>                          
                        </tr>  
                    </thead>
                    <tbody> 
                        <?php $response = $webservice->getData("Admin","GetIndividualMessage",array("Request"=>"SMS")); ?>  
                        <?php foreach($response['data'] as $SMS ) { ?>
                                <tr>
                                <td><?php echo $SMS['MessageFromCode'];?></td>
                                <td><?php echo $SMS['MessageToMemberCode'];?></td>
                                <td><?php echo $SMS['SMSMessage'];?></td>
                                <td><?php echo  putDateTime($SMS['SentOn']);?></td>
                                <td style="text-align:right">
                                    <a href="<?php echo GetUrl("Members/ViewIndividualSMS/". $SMS['ManualSendID'].".htm"); ?>"><span>View</span></a>
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
<?php/* $Franchisees = $mysql->select("select * from _tbl_Franchisees"); ?>
                        <?php foreach($Franchisees as $Franchisee) { */?>
                         <?php // }  
                        ?>