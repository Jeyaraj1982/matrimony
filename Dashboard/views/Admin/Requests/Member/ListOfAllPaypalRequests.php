<?php 
$response = $webservice->getData("Admin","PaypalRequests",array("Request"=>"All"));?>
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
                    <a href="ListOfAllPaypalRequests" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ListOfPendingPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Pending</small></a>&nbsp;|&nbsp;
                    <a href="ListOfApprovedPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Approved</small></a>&nbsp;|&nbsp;
                    <a href="ListOfRejectedPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>&nbsp;|&nbsp;
                    <a href="PaypalReport"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
            </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Req Id</th> 
                    <th>Txn Date</th> 
                    <th>Txn Amount</th>  
                    <th>Status</th>
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Requests) {
            ?>
                <tr>
                    <td><?php echo $Requests['PaypalID'];?></td>
                    <td><?php echo PutDateTime($Requests['TransactionOn']);?></td>
                    <td style="text-align:right"><?php echo $Requests['Amount'];?></td>
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
              