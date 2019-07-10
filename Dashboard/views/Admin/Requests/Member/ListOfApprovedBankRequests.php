<?php 
$response = $webservice->getData("Admin","BankRequests",array("Request"=>"Success"));
?>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
               <div class="col-sm-6">
                <h4 class="card-title">Requests</h4>
                <h4 class="card-title">Member Wallet Refill Requests</h4>
               </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ListOfAllBankRequests" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ListOfPendingBankRequests"><small style="font-weight:bold;text-decoration:underline">Pending</small></a>&nbsp;|&nbsp;
                    <a href="ListOfApprovedBankRequests"><small style="font-weight:bold;text-decoration:underline">Approved</small></a>&nbsp;|&nbsp;
                    <a href="ListOfRejectedBankRequests"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>&nbsp;|&nbsp;
                    <a href="BankRequestReport"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
            </div>
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
                     <td><?php echo $Requests['TxnStatus'];?> </td>
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
