<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Individual Messages</h4>
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
                        <th>Message Subject</th>                   
                        <th>Message Content</th>                   
                        <th>Created On</th>
                        <th style="width:50px;"></th>                          
                        </tr>  
                    </thead>
                    <tbody> 
                        <?php $response = $webservice->getData("Admin","GetIndividualMessage",array("Request"=>"Messages")); ?>  
                        <?php foreach($response['data'] as $SMS ) { ?>
                                <tr>
                                <td><?php echo $SMS['FromCode'];?></td>
                                <td><?php echo $SMS['ToMemberCode'];?></td>
                                <td><?php echo $SMS['MessageSubject'];?></td>
                                <td><?php echo $SMS['MessageContent'];?></td>
                                <td><?php echo  putDateTime($SMS['CreatedOn']);?></td>
                                <td style="text-align:right">
                                    <a href="<?php echo GetUrl("Members/ViewIndividualMessage/". $SMS['BoardID'].".htm"); ?>"><span>View</span></a>
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