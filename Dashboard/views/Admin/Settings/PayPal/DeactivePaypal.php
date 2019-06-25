<form method="post" action="<?php echo GetUrl("Settings/PayPal/Create");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Settings</h4>
                <h5 class="card-title">Manage Paypal</h5>
                <div class="form-group row">
                <div class="col-sm-3"><button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create</button> </div>
                <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="Paypal" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                <a href="ActivePaypal"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                <a href="DeactivePaypal"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>
                        <th>Paypal Account Name</th> 
                        <th>Account Email</th>
                        <th>Created On</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>  
                        <?php $Paypals = $mysql->select("select * from _tbl_settings_paypal where IsActive='0'"); ?>
                        <?php foreach($Paypals as $Paypal) { ?>
                                <tr>
                                <td><span class="<?php echo ($Paypal['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Paypal['PaypalName'];?></td>
                                <td><?php echo $Paypal['PaypalEmailID'];?></td>
                                <td><?php echo putDateTime($Paypal['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Settings/PayPal/Edit/". $Paypal['PaypalID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/PayPal/View/". $Paypal['PaypalID'].".htm");?>"><span>View</span></a>
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
