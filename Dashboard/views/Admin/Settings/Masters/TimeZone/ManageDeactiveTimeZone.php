<?php 
$page="ManageTimeZone";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/TimeZone/New");?>" onsubmit="">
    <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Time Zone</h4>                   
        <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Time Zone</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageTimeZone" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveTimeZone"><small>Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveTimeZone"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th width="30px">ID</th>  
                    <th>TimeZone</th>
                    <th width="80px"></th>        
                </tr>
            </thead>            
            <tbody>                      
            <?php $TimeZones = $webservice->getData("Admin","GetManageDeactiveTimeZone"); ?>
            <?php foreach($TimeZones['data'] as $TimeZone) { ?>
                <tr>
                    <td><span class="<?php echo ($TimeZone['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $TimeZone['SoftCode'];?></td>
                    <td><?php echo $TimeZone['CodeValue'];?></td>
                    <td style="text-align:right">
                        <a href="<?php echo GetUrl("Settings/Masters/TimeZone/Manage/Edit/". $TimeZone['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Settings/Masters/TimeZone/Manage/View/". $TimeZone['SoftCode'].".html");?>"><span>View</span></a>
                    </td>
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
    $('#myTable_filter input').addClass('form-control input-sm'); 
    $('#myTable_length select').addClass('form-control select-sm'); 
    setTimeout("DataTableStyleUpdate()",500);
});
</script>                                                                                                                 
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    