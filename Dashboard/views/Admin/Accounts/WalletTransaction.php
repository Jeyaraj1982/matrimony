 <?php   $response = $webservice->getData("Admin","GetMyTransactions",array("Request"=>"All")); 
  if (sizeof($response['data'])>0) {   ?>
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">My Transactions</h4>
                    <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                        <thead>  
                            <tr>
                                <th>Transaction Date</th> 
                                <th>Particulars</th> 
                                <th style="text-align:right">Credits</th> 
                                <th style="text-align:right">Debits</th>  
                                <th style="text-align:right">Available Balance</th>
                            </tr>  
                        </thead>
                        <tbody>  
                      <?php
                        foreach($response['data'] as $Requests) {
                        ?>
                            <tr>
                                <td><?php echo PutDateTime($Requests['TxnDate']);?></td>
                                <td><?php echo $Requests['Particulars'];?></td>
                                <td style="text-align:right"><?php echo number_format($Requests['Credits'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($Requests['Debits'],2);?></td>
                                <td style="text-align:right"><?php echo number_format($Requests['AvailableBalance'],2);?></td>
                            </tr>
                        <?php } ?>            
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
  <?php } else { ?>
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">My Transactions</h4>
                <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                    <img src="<?php echo ImageUrl;?>report.svg" style="height:128px"><Br><Br>
                    No transactions found at this time<br><br>
                </div>
            </div>
        </div>
    </div>
<?php } ?> 