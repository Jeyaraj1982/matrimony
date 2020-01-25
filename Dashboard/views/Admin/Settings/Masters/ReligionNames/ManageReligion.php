<?php 
$page="Religion";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
    <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">Manage Religion Names</h4>                   
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <button type="submit" class="btn-sm btn-success btn-sm dropdown-toggle border rounded" style="padding:3px 15px" data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
            <a href="<?php echo GetUrl("Settings/Masters/ReligionNames/New");?>" class="btn-primary btn-sm border rounded" style="text-decoration: none;"><i class="mdi mdi-plus"></i>Religion Name</a>
        </div>
    </div>
    <div class="row" style="margin-bottom:15px;">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="ManageReligion" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
            <a href="ManageActiveReligion"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
            <a href="ManageDeactiveReligion"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th width="30px">ID</th>  
                    <th>Religion Names</th>
                    <th width="80px"></th>        
                </tr>
            </thead>            
            <tbody>                      
            <?php $ReligionNames = $webservice->getData("Admin","GetMastersManageDetails"); ?>
            <?php foreach($ReligionNames['data']['ReligionNames'] as $ReligionName) { ?>
                <tr>
                    <td><span class="<?php echo ($ReligionName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $ReligionName['SoftCode'];?></td>
                    <td><?php echo $ReligionName['CodeValue'];?></td>
                    <td style="text-align:right">
                        <a href="<?php echo GetUrl("Settings/Masters/ReligionNames/Manage/Edit/". $ReligionName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Settings/Masters/ReligionNames/Manage/View/". $ReligionName['SoftCode'].".html");?>"><span>View</span></a>
                    </td>
                </tr>
            <?php } ?>            
            </tbody>
        </table>
    </div>
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