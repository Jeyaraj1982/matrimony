<form method="post" action="<?php echo GetUrl("Franchisees/Create");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Franchisees</h4>
                <h4 class="card-title">Manage Franchisees</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>New Franchisee</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul></div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="MangeFranchisees" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveFranchisees"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveFranchisees"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Franchisee Names</th>  
                        <th>State Name</th>
                        <th>District Name</th>
                        <th>Plan Name</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php 
                         $response = $webservice->GetManageFranchisee(); 
                         if (sizeof($response['data'])>0) {
                         ?>
                        <?php foreach($response['data'] as $Franchisee) { ?>
                                <tr>
                                <td><span class="<?php echo ($Franchisee['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Franchisee['FranchiseName'];?></td>
                                <td><?php echo $Franchisee['StateName'];?></td>
                                <td><?php echo $Franchisee['DistrictName'];?></td>
                                <td><?php echo $Franchisee['Plan'];?></td>
                                <td><?php echo putDateTime($Franchisee['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Franchisees/Edit/". $Franchisee['FranchiseeID'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/View/". $Franchisee['FranchiseeID'].".html");?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Wallet/RefillTransfer/". $Franchisee['FranchiseeID'].".html");?>"><span>Refill</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Report/". $Franchisee['FranchiseeID'].".html");?>"><span>Report</span></a>
                                </td>
                                </tr>
                        <?php }} ?>            
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