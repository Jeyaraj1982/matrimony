<?php 
$response = $webservice->getData("Admin","GetListMemberBankRequests");?>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Requests</h4>
                <h4 class="card-title">Member Wallet Refill Requests</h4>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" width="100%">
                      <thead>
                        <tr>
                          <th>Req Id</th> 
                          <th>Req Date</th> 
                          <th>Bank Name</th> 
                          <th>Txn Amount</th>  
                          <th>Txn Date</th>
                          <th>Txn Mode</th>
                          <th>Status</th>
                          <th>approve</th>
                          <th>Reject</th>
                        </tr>
                      </thead>
                      <tbody>  
                        <?php foreach($response['data'] as $Requests) { ?>
                <tr>
                    <td><?php echo $Requests['ReqID'];?></td>
                    <td><?php echo $Requests['RequestedOn'];?></td>
                    <td><?php echo $Requests['BankName'];?></td>
                    <td><?php echo $Requests['RefillAmount'];?></td>
                    <td><?php echo $Requests['TransferedOn'];?></td>
                    <td><?php echo $Requests['TransferMode'];?></td>
                    <td><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                        echo "Pending";
                        }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                            echo "Approved";
                        }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                            echo "Rejected";}
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
