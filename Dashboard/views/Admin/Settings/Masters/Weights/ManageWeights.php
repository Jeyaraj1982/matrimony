<?php 
$page="ManageWeights";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/Weights/New");?>" onsubmit="">      
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Weight</h4>
                <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Weight</button>
                          <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Weights</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $Weights = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($Weights['data']['Weight'] as $Weight) { ?>
                                <tr>
                                <td><span class="<?php echo ($Weight['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $Weight['SoftCode'];?></td>
                                <td><?php echo $Weight['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/Weights/Manage/Edit/". $Weight['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/Weights/Manage/View/". $Weight['SoftCode'].".html");?>">View</a></td>
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