<?php 
$page="FranchiseeStaffs";
include_once("topmenu.php");  
?>
<form method="post" >
    
 <div class="form-group row">
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row mb0">
                            <div style="padding:15px !important;max-width:770px !important;">
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
                    <a href="<?php echo GetUrl("Franchisees/FranchiseeStaffs/".$_GET['Code'].".html"); ?>" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="<?php echo GetUrl("Franchisees/ActiveFranchiseeStaffs/".$_GET['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="<?php echo GetUrl("Franchisees/DeactiveFranchiseeStaffs/".$_GET['Code'].".html"); ?>"><small>Deactive</small></a>
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
                         $response = $webservice->getData("Admin","ManageFranchiseeStaffs",array("Request"=>"Active"));
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
                                <td style="text-align:right"><a href="javascript:void(0)" onclick="FranchiseeStaff.ConfirmationfrEditFrStf('<?php echo $Staff['StaffCode'];?>')"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Franchisees/FrStaffView/".$Staff['StaffCode'].".html"); ?>"><span>View</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Staffs/LoginHistory/".$Staff['STaffCode'].".html"); ?>"><span>Login History</span></a>&nbsp;&nbsp;&nbsp;
                                </tr>
                        <?php }} ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
                    </div>
                        </div>
                        
                    </div>
                </div>
        <div class="col-sm-3">
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
            <div class="modal-content" id="Publish_body"  style="max-height: 313px;min-height: 313px;" >
        
            </div>
        </div>
    </div>

                    