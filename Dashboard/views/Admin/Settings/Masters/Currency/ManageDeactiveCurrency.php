<?php 
$page="ManageCurrency";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/Currency/New");?>" onsubmit="">
    <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Currency</h4>                   
        <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Currency</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageCurrency" ><small>All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveCurrency"><small>Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveCurrency"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th width="30px">ID</th>  
                    <th>Currency</th>
                    <th width="80px"></th>        
                </tr>
            </thead>            
            <tbody>                      
            <?php $Currencys = $webservice->getData("Admin","GetManageDeactiveCurrency"); ?>
            <?php foreach($Currencys['data'] as $Currency) { ?>
                <tr>
                    <td><span class="<?php echo ($Currency['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Currency['SoftCode'];?></td>
                    <td><?php echo $Currency['CodeValue'];?></td>
                    <td style="text-align:right">
                        <a href="<?php echo GetUrl("Settings/Masters/Currency/Manage/Edit/". $Currency['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Settings/Masters/Currency/Manage/View/". $Currency['SoftCode'].".html");?>"><span>View</span></a>
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