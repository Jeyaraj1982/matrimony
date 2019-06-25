<form method="post" action="<?php echo GetUrl("Franchisees/Plan/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Franchisee</h4>
                <h4 class="card-title">Manage Plan Franchisees</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Plan</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="ManagePlan"><small style="font-weight:bold;text-decoration:underline">All</small> </a>&nbsp;|&nbsp;
                <a href="ManageActivePlan"><small style="font-weight:bold;text-decoration:underline">Active</small> </a>&nbsp;|&nbsp;
                <a href="ManageDeactivePlan"><small style="font-weight:bold;text-decoration:underline">Deactive</small> </a>
                </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                           <th>Plan Name</th>  
                           <th>Duration</th>  
                           <th>Amount</th>  
                           <th>Profile Comm</th>
                           <th>Refill Comm</th>
                           <th>Download Comm</th>
                           <th>Created</th>
                           <th>No of Profiles</th>
                           <th></th>
                        </tr>
                      </thead>                                            
                      <tbody>  
                        <?php 
                         $response = $webservice->GetManagePlans(); ?>
                        <?php foreach($response['data'] as $Plan) { ?>
                                <tr>
                                <td>
                                <span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;
                                <?php echo $Plan['PlanName'];?></td>
                                <td><?php echo $Plan['Duration'];?></td>
                                <td><?php echo $Plan['Amount'];?></td>
                                <td>
                                    <?php
                                        if ($Plan['ProfileCommissionWithPercentage']>0) {
                                            echo $Plan['ProfileCommissionWithPercentage']."%";
                                        }
                                        if ($Plan['ProfileCommissionWithRupees']>0) {
                                            echo "Rs. ".$Plan['ProfileCommissionWithRupees'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($Plan['RefillCommissionWithPercentage']>0) {
                                            echo $Plan['RefillCommissionWithPercentage']."%";
                                        }
                                        if ($Plan['RefillCommissionWithRupees']>0) {
                                            echo "Rs. ".$Plan['RefillCommissionWithRupees'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($Plan['ProfileDownloadCommissionWithPercentage']>0) {
                                            echo $Plan['ProfileDownloadCommissionWithPercentage']."%";
                                        }
                                        if ($Plan['ProfileDownloadCommissionWithRupees']>0) {
                                            echo "Rs. ".$Plan['ProfileDownloadCommissionWithRupees'];
                                        }
                                    ?>
                                </td>                                           
                                <td><?php echo putDateTime($Plan['CreatedOn']);?></td>
                                <td style="text-align: right"><?php echo $Plan['cnt'];?></td>
                                <td style="text-align:left">
                                <?php if ($Plan['cnt']>0) {?>
                                <span title="Can't Edit" style="color:#888;cursor:pointer; text-align: left;">Edit</span>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Plan/View/". $Plan['PlanCode'].".html");?>"><span>View</span></a>
                                <?php } else{ ?>
                                <a href="<?php echo GetUrl("Franchisees/Plan/Edit/". $Plan['PlanCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Plan/View/". $Plan['PlanCode'].".html");?>"><span>View</span></a></td>
                                <?php } ?>
                                </tr>                                              
                        <?php } ?>            
                      </tbody>           
                    </table>
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
