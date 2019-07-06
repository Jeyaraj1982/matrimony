<form method="post" action="<?php echo GetUrl("Settings/Bank/Add");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Settings</h4>
                <h5 class="card-title">Manage my Bank Accounts</h5>
                <div class="form-group row">
                <div class="col-sm-3"><button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Add Bank</button></div> 
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="ListofBanks" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                <a href="ActiveListofBanks"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                <a href="DeactiveListofBanks"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
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
                      $response =$webservice->getData("Admin","GetManageActiveBanks");
                      $Banks = $response['data'];
                       ?>
                        <?php foreach($Banks as $Bank) { ?>
                                <tr>
                                <td><span class="<?php echo ($Bank['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Bank['BankName'];?></td>
                                <td><?php echo $Bank['AccountName'];?></td>
                                <td><?php echo $Bank['AccountNumber'];?></td>
                                <td><?php echo $Bank['IFSCode'];?></td>
                                <td><a href="<?php echo GetUrl("Settings/Bank/Edit/". $Bank['BankID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Bank/View/". $Bank['BankID'].".htm");?>"><span>View</span></a>
                                </td>
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
