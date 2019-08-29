<form method="post" action="<?php echo GetUrl("Staffs/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Staffs</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Staff</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageStaffs" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveStaffs"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveStaffs"><small>Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Staff Name</th>  
                          <th>Created </th>
                          <th>Role</th>
                          <th>Login Name</th> 
                          <th>Last Login</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>                      
                        <?php 
                         $response = $webservice->getData("Franchisee","ManageFranchiseeStaffs",array("Request"=>"Active"));
                         if (sizeof($response['data'])>0) {
                    ?>
                        <?php foreach($response['data'] as $Staff) { ?>
                                <tr>
                                <td><span class="<?php echo ($Staff['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;
                                <?php echo $Staff['PersonName'];?></td>
                                <td><?php echo $Staff['CreatedOn'];?></td>
                                <td><?php echo $Staff['UserRole'];?></td>
                                <td><?php echo $Staff['LoginName'];?></td>
                                <td></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Staffs/Edit/". $Staff['PersonID'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Staffs/View/".$Staff['PersonID'].".html"); ?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
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
