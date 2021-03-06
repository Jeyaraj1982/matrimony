<?php 
$page="ManageEducationTitles";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>

<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/EducationTitles/New");?>" onsubmit="">   
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
         <h4 class="card-title">Masters</h4>
         <h4 class="card-title">Manage Education Title</h4>
          <button type="submit" class="btn btn-primary ">
                          <i class="mdi mdi-plus"></i>Education Title</button>
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
                          <th>Education Title</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $EducationTitles = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                        <?php foreach($EducationTitles['data']['EducationTitle'] as $EducationTitle) { ?>
                                <tr>
                                <td><span class="<?php echo ($EducationTitle['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $EducationTitle['SoftCode'];?></td>
                                <td><?php echo $EducationTitle['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/EducationTitles/Manage/Edit/". $EducationTitle['SoftCode'].".html");?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/EducationTitles/Manage/View/". $EducationTitle['SoftCode'].".html");?>">View</a></td>
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