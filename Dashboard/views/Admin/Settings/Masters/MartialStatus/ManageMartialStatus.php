<?php 
$page="ManageMartialStatus";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/MartialStatus/New");?>" onsubmit=""> 
   <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Marital Status</h4>
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Martial Status</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" width="100%">
                      <thead>
                        <tr>
                          <th width="30px">Code</th>  
                          <th>Marital Status</th>
                          <th width="80px"></th> 
                        </tr>
                      </thead>
                      <tbody>  
                       <?php $MaritalStatuss = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($MaritalStatuss['data']['MaritalStatus'] as  $MartialStatus) { ?>
                                <tr>
                                <td><span class="<?php echo ($MartialStatus['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $MartialStatus['SoftCode'];?></td>
                                <td><?php echo $MartialStatus['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/MartialStatus/Manage/Edit/". $MartialStatus['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/MartialStatus/Manage/View/". $MartialStatus['SoftCode'].".html");?>">View</a></td>
                                </tr>
                        <?php } ?>            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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