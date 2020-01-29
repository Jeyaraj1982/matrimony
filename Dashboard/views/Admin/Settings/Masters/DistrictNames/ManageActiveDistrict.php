<?php 
$page="ManageDistrict";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>

<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Masters/DistrictNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage District Names</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>District Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageDistrict" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveDistrict"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveDistrict"><small>Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>  
                        <th>ID</th>  
                        <th>District Names</th>  
                        <th>State Names</th>  
                        <th>Country Names</th>  
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php $DistrictNames = $webservice->getData("Admin","GetManageActiveDistrictNames"); ?>
                        <?php foreach($DistrictNames['data'] as $DistrictName) { ?>
                                <tr>
                                <td><span class="<?php echo ($DistrictName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $DistrictName['SoftCode'];?></td>
                                <td><?php echo $DistrictName['CodeValue'];?></td>
                                <td><?php echo $DistrictName['ParamA'];?></td>
                                <td><?php echo $DistrictName['ParamB'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/DistrictNames/Manage/Edit/". $DistrictName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/DistrictNames/Manage/View/". $DistrictName['SoftCode'].".html");?>"><span>View</span></a></td> 
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
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    