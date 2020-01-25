<form method="post" action="<?php echo GetUrl("Franchisees/Wallet/RefillTransfer");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Franchisees</h4>
                <h5 class="card-title">Refill Wallet</h5>
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Refill Wallet</button>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                           <th>Req ID</th> 
                           <th>Bank Name</th>  
                           <th>Amount</th>
                           <th>Transaction ID</th>
                           <th>Date of Transfer</th>
                           <th>Mode</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                         $response = $webservice->getData("Admin","GetFranchiseeRefillWalletManage"); 
                         if (sizeof($response['data'])>0) {
                         ?>
                        <?php foreach($response['data'] as $Wallet) { ?>
                        <tr>
                           <td><?php echo $Wallet['ReqID'];?></td>           
                           <td><?php echo $Wallet['BankName'];?></td>           
                           <td><?php echo $Wallet['Amount'];?></td>           
                           <td><?php echo $Wallet['TransactionID'];?></td>           
                           <td><?php echo $Wallet['DateofTransfer'];?></td>           
                           <td><?php echo $Wallet['Mode'];?></td>           
                           <td></td>           
                       </tr>
                       <?php } } ?>
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

                       