<form method="post" action="<?php echo GetUrl("Staffs/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Staffs</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Staff</button></div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Staff Code</th>  
                          <th>Staff Name</th>
                          <th>Mobile no</th>
                          <th></th>
                        </tr>
                      </thead>
                       <tbody>  
                        <?php 
                            $response = $webservice->getData("Admin","GetManageStaffs");
                         ?>
                        <?php foreach($response['data'] as $Staff) { ?>
                                <tr>
                                <td><span class="<?php echo ($Staff['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Staff['AdminCode'];?></td>
                                <td><?php echo $Staff['AdminName'];?></td>
                                <td><?php echo $Staff['MobileNumber'];?></td>
                                <td><a href="javascript:void(0)" onclick="AdminStaff.ConfirmationfrEditAdminStf('<?php echo $Staff['AdminCode'];?>')"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Staffs/View/". $Staff['AdminCode'].".html");?>"><span>View</span></a>
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
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 300px;min-height: 300px;" >
            
                </div>
            </div>
        </div>         
