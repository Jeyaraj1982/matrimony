<form method="post" action="<?php echo GetUrl("RefillWallet");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Wallet Requests</h4>
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Refill Wallet</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Refill Amount</th>  
                        <th>Bank Name</th>
                        <th>Date of Birth</th>
                        <th>Transaction ID</th>
                        <th>Remarks</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php $Wallets = $mysql->select("select * from _tbl_franchisees_refillwallet"); ?>
                        <?php foreach($Wallets as $Wallet) { ?>
                                <tr>
                                <td><?php echo $Wallet['RefillAmount'];?></td>
                                <td><?php echo $Wallet['BankName'];?></td>
                                <td><?php echo $Wallet['DateofBirth'];?></td>
                                <td><?php echo $Wallet['TransactionID'];?></td>
                                <td><?php echo $Wallet['Remarks'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Edit/". $Wallet['RefillID'].".html");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("View/". $Wallet['RefillID'].".html"); ?>"><span class="glyphicon glyphicon-pencil">View</span></a>&nbsp;&nbsp;&nbsp;
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

