<?php $page="Bank Details";
    include_once("settings_header.php");
        ?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage Bank Accounts</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/AddBank");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div>
    <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Bank Name</th>  
                          <th>Account Holder Name</th>
                          <th>Account Number</th>
                          <th>IFS Code</th>                 
                          <th></th>
                        </tr>
                      </thead>
                       <tbody> 
                      <?php
                    if($_GET['Filter']=="Banks"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"BankDetails"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActiveBankDetails")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactiveBankDetails")); 
                            }
                        }
                 
                      $Banks = $response['data'];
                       ?>
                      
                        <?php foreach($Banks as $Bank) { ?>
                                <tr>
                                <td><span class="<?php echo ($Bank['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Bank['BankName'];?></td>
                                <td><?php echo $Bank['AccountName'];?></td>
                                <td><?php echo $Bank['AccountNumber'];?></td>
                                <td><?php echo $Bank['IFSCode'];?></td>
                                <td><a href="<?php echo GetUrl("Settings/PaymentGateway/EditBank/". $Bank['BankID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewBank/". $Bank['BankID'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewTransactions/". $Bank['BankID'].".htm");?>"><span>Transactions</span></a>
                                </td>
                                </tr>
                        <?php } ?>            
                      </tbody> 
                    </table>
                  </div>
</div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<?php include_once("settings_footer.php");?>                    