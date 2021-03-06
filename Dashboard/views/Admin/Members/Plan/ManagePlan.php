<?php 
    $response = $webservice->getData("Admin","GetManageMemberPlan",array("Request"=>"All"));
    if (sizeof($response['data'])==0) {
        ?>
<div class="form-group row">
     <div class="col-sm-12">
        <div class="card">
        <div class="card-body">
            <div style="text-align: center;padding-top:calc( (100vh - 105px)/2 - 130px) !important;padding-bottom:calc( (100vh - 105px)/2 - 130px) !important;">
                <div>
                    <div style="">
                    <img src="<?php echo ImagePath ?>/plan_icon.svg" style="width:128px;">
                    </div><br>
                    Member Plans Not Found <br><a href="<?php echo GetUrl("Members/Plan/CreatePlan");?>">click here to create plan</a>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
<?php } else {?>
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
                        <a href="ManageActivePlan"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactivePlan"><small>Deactive</small></a>
                </div>
                </div>                                            
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Plan Name</th>
                        <th>Duration</th>
                        <th>Amount</th>
                        <th>Subscribed</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php foreach($response['data'] as $Plan) { ?>
                                <tr>
								
                                <td>
                                <span class="<?php echo ($Plan['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;
                                <?php echo $Plan['PlanName'];?><?php if($Plan['IsDefault']==1) {?>&nbsp;<button class="btn btn-primary" style="padding: 0px 4px;font-size: 12px;background: orange;border: orange">Default</button><?php } ?></td>
                                <td style="text-align:right"><?php echo $Plan['Decreation'];?></td>
                                <td style="text-align:right"><?php echo number_format($Plan['Amount'],2);?></td>
                                <td style="text-align:right"><?php echo ($Plan['cnt']==1) ? '1' : '0';?></td>
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
                         <?php  }  
                        ?>