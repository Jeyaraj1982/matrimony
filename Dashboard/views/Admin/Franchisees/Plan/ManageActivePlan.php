<form method="post" action="<?php echo GetUrl("Franchisees/Plan/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Plans</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>New Plan</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="ManagePlan"><small>All</small> </a>&nbsp;|&nbsp;
                <a href="ManageActivePlan"><small style="font-weight:bold;text-decoration:underline">Active</small> </a>&nbsp;|&nbsp;
                <a href="ManageDeactivePlan"><small>Deactive</small> </a>
                </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                           <th>Plan Name</th>  
                           <th>Profile Commision</th>
                           <th>Refill Commission</th>
                           <th>Download Commission</th>
                           <th>Created</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <?php 
                         $response = $webservice->getData("Admin","GetManageActivePlans"); ?>
                        <?php foreach($response['data'] as $Plan) { ?>
                                <tr>
                                <td>
                                <span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;
                                <?php echo $Plan['PlanName'];?><?php if($Plan['IsDefault']==1) {?>&nbsp;<button class="btn btn-primary" style="padding: 0px 4px;font-size: 12px;background: orange;border: orange">Default</button><?php } ?></td>
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
                                        if ($Plan['ProfileDownloadCommissionWithRupees']>0) {
                                            echo "Rs. ".$Plan['ProfileDownloadCommissionWithRupees'];
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
                                <td><?php echo $Plan['CreatedOn'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Franchisees/Plan/Edit/". $Plan['PlanCode'].".html");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/Plan/View/". $Plan['PlanCode'].".html");?>"><span class="glyphicon glyphicon-pencil">View</span></a></td>
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
