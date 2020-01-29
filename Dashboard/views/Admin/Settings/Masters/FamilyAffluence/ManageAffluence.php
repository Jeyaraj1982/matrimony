<?php 
$page="ManageAffluence";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/FamilyAffluence/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Family Value</h4>
                 <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Family Affluence</button>
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
                          <th>Family Affluence</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $FamilyAffluences = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($FamilyAffluences['data']['FamilyAffluence'] as $FamilyAffluence) { ?>
                                <tr>
                                <td><span class="<?php echo ($FamilyAffluence['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $FamilyAffluence['SoftCode'];?></td>
                                <td><?php echo $FamilyAffluence['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/FamilyAffluence/Manage/Edit/". $FamilyAffluence['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/FamilyAffluence/Manage/View/". $FamilyAffluence['SoftCode'].".html");?>">View</a></td>
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