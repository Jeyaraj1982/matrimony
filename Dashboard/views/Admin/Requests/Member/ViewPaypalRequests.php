<?php 
$response = $webservice->getData("Admin","GetListMemberPaypalRequests");?>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Requests</h4>
                <h4 class="card-title">Member Wallet Refill Requests</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Req Id</th> 
                    <th>Txn Date</th> 
                    <th>Txn Amount</th>  
                    <th>Status</th>
                    <th>Approve</th>
                    <th>Reject</th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Requests) {
            ?>
                <tr>
                    <td><?php echo $Requests['PaypalID'];?></td>
                    <td><?php echo PutDateTime($Requests['TransactionOn']);?></td>
                    <td style="text-align:right"><?php echo $Requests['Amount'];?></td>
                    <td><?php if($Requests['IsSuccess']==0 && $Requests['IsFailure']==0){
                        echo "Pending";
                        }if($Requests['IsSuccess']==1 && $Requests['IsFailure']==0){
                            echo "Success";
                        }if($Requests['IsSuccess']==0 && $Requests['IsFailure']==1){
                            echo "Failure";}
                    ?></td>
                    <td></td>
                    <td></td>
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
              