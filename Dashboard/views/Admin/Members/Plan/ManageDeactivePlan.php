<form method="post" action="<?php echo GetUrl("Members/Plan/CreatePlan");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Manage Plans</h4>  
                <div class="form-group row">
                    <div class="col-sm-6">                                                                                     
                        <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Plan</button> 
                        <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                            <ul class="dropdown-menu">
                                <li><a href="#">To Excel</a></li>
                                <li><a href="#">To Pdf</a></li>
                                <li><a href="#">To Htm</a></li>
                            </ul>                   </div> 
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManagePlan" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActivePlan"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactivePlan"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>                                            
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Plan Name</th>
                        <th>Duration</th>
                        <th>Amount</th>
                        <th>No of Profiles</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                         <?php $response = $webservice->getData("Admin","GetManageMemberPlan",array("Request"=>"Deactive")); ?>  
                        <?php foreach($response['data'] as $Plan) { ?>
                                <tr>
                                <td>
                                <span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;
                                <?php echo $Plan['PlanName'];?></td>
                                <td><?php echo $Plan['Decreation'];?></td>
                                <td><?php echo $Plan['Amount'];?></td>
                                <td></td>
                                <td><?php echo putDateTime($Plan['CreatedOn']);?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Members/Plan/EditPlan/". $Plan['PlanCode'].".htm");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Members/Plan/View/". $Plan['PlanCode'].".htm");?>">View</a></td>
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
<?php/* $Franchisees = $mysql->select("select * from _tbl_Franchisees"); ?>
                        <?php foreach($Franchisees as $Franchisee) { */?>
                         <?php // }  
                        ?>