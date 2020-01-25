<?php 
$page="Caste";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>

<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/CasteNames/New");?>" onsubmit="">   
    <h4 class="card-title">Masters</h4>
    <h4 class="card-title">Manage Caste Names</h4>                   
        <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Caste Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageCaste" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveCaste"><small>Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveCaste"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Caste Names</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $CasteNames = $webservice->getData("Admin","GetManageDeactiveCasteNames"); ?>
                        <?php foreach($CasteNames['data'] as $CasteName) { ?>
                                <tr>
                                <td><span class="<?php echo ($CasteName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $CasteName['SoftCode'];?></td>
                                <td><?php echo $CasteName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/CasteNames/Manage/Edit/". $CasteName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/CasteNames/Manage/View/". $CasteName['SoftCode'].".html");?>"><span>View</span></a></td> 
                                </tr>
                        <?php } ?>   
                            </tbody>
                    </table>
                  </div>
</form>
</div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>                                                                                                                 
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    