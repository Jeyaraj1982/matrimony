<?php 
$page="Star";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>

<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/StarNames/New");?>" onsubmit="">   
    <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Star Names</h4>                   
        <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Star Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageStar" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveStar"><small>Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveStar"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Star Names</th>
                          <th></th> 
                        </tr>
                      </thead>
                       <tbody>  
                          <?php $StarNames = $webservice->getData("Admin","GetManageDeactiveStarNames"); ?>
                        <?php foreach($StarNames['data'] as $StarName) { ?>
                                <tr>
                                <td><span class="<?php echo ($StarName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $StarName['SoftCode'];?></td>
                                <td><?php echo $StarName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/StarNames/Manage/Edit/". $StarName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/StarNames/Manage/View/". $StarName['SoftCode'].".html");?>"><span>View</span></a></td>
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