<form method="post" action="<?php echo GetUrl("MyAccounts/RefillWallet");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-6">
                   <h4 class="card-title">Wallet Requests</h4>
                    <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Refill Wallet</button>
                    <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                    <ul class="dropdown-menu">
                        <li><a href="#">To Excel</a></li>
                        <li><a href="#">To Pdf</a></li>
                        <li><a href="#">To Htm</a></li>
                    </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="WalletRequests"><small style="font-weight:bold;">All</small></a>&nbsp;|&nbsp;
                    <a href="ListOfPendingWalletRequests"><small style="font-weight:bold;">Pending</small></a>&nbsp;|&nbsp;
                    <a href="SuccessWalletRequests"><small style="font-weight:bold;">Success</small></a>&nbsp;|&nbsp;
                    <a href="RejectWalletRequests"><small style="font-weight:bold;text-decoration:underline">Reject</small></a>
                </div>
            </div>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>
                            <th>Req Id</th> 
                            <th>Req Date</th> 
                            <th>Bank Name</th> 
                            <th>A/C Number</th> 
                            <th>Txn Amount</th>  
                            <th>Txn Date</th>
                            <th>Txn Mode</th>
                            <th>Txn ID</th>
                            <th>Status</th>
                            <th></th>
                        </tr> 
                    </thead>
                     <tbody>  
                        <?php $response = $webservice->getData("Franchisee","GetListOfPreviousBankRequests",array("Request"=>"Reject"));?>
                        <?php foreach($response['data'] as $Requests) { ?>
                        <tr>
                            <td><?php echo $Requests['ReqID'];?></td>
                            <td><?php echo PutDateTime($Requests['RequestedOn']);?></td>
                            <td><?php echo $Requests['BankName'];?></td>
                            <td><?php echo $Requests['AccountNumber'];?></td>
                            <td style="text-align:right"><?php echo number_format($Requests['RefillAmount'],2);?></td>
                            <td><?php echo PutDate($Requests['TransferedOn']);?></td>
                            <td><?php echo $Requests['TransferMode'];?></td>
                            <td><?php echo $Requests['TransactionID'];?></td>
                            <td><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                                echo "Pending";
                                }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                                    echo "Approved";
                                }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                                    echo "Rejected";}
                            ?></td>
                            <td><a href="<?php echo GetUrl("MyAccounts/ViewFranchiseeBankRequests/". $Requests['ReqID'].".htm"); ?>">View</a></td>
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

