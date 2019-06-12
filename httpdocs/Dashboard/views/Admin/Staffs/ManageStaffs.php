<form method="post" action="<?php echo GetUrl("Staffs/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Staffs</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Staff</button></div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="ManageStaffs"><small style="font-weight:bold;text-decoration:underline">All</small> </a>&nbsp;|&nbsp;
                <a href="ManageActiveStaffs"><small style="font-weight:bold;text-decoration:underline">Active</small> </a>&nbsp;|&nbsp;
                <a href="ManageDeactiveDeactive"><small style="font-weight:bold;text-decoration:underline">Deactive</small> </a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Staff Code</th>  
                          <th>Staff Name</th>
                          <th>Mobile no</th>
                          <th>Created</th> 
                          <th></th>
                        </tr>
                      </thead>
                       <tbody>  
                        <?php $Staffs = $mysql->select("select * from _tbl_admin_staffs"); ?>
                        <?php foreach($Staffs as $Staff) { ?>
                                <tr>
                                <td><span class="<?php echo ($Staff['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Staff['StaffCode'];?></td>
                                <td><?php echo $Staff['StaffName'];?></td>
                                <td><?php echo $Staff['MobileNumber'];?></td>
                                <td><?php echo putDateTime($Staff['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Staffs/Edit/". $Staff['StaffID'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Staffs/View/". $Staff['StaffID'].".html");?>"><span>View</span></a>
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
