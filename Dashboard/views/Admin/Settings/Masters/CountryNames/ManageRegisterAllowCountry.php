<?php 
$page="CountryNames";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/CountryNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
           <div class="card-body">
             <h4 class="card-title">Masters</h4>
             <h4 class="card-title">Manage Country Names</h4>
             <div class="form-group row">
             <div class="col-sm-6">
             <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Country Name</button>
             <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageCountry");?>" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageActiveCountry");?>"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageDeactiveCountry");?>"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
                    <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageRegisterAllowCountry");?>"><small style="font-weight:bold;text-decoration:underline">Register Country</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                            <tr>
                                <th>Code</th>
                                <th>Country Names</th>
                                <th>STD Code</th>
                                <th>Currency</th>
                                <th>Substring</th>
                                <th>ShortName</th>
                                <th>Is Allow</th>
                                <th></th>
                            </tr>
                        </thead>
                      <tbody>
                        <?php $CountryNames = $webservice->getData("Admin","GetManageRegisterAllowCountryNames");  ?>
                        <?php foreach($CountryNames['data'] as $CountryName) { ?>
                            <tr>
                                <td><span class="<?php echo ($CountryName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $CountryName['SoftCode'];?></td>
                                <td><?php echo $CountryName['CodeValue'];?></td>
                                <td style="text-align: right"><?php echo $CountryName['ParamA'];?></td>
                                <td><?php echo $CountryName['ParamB'];?></td>
                                <td><?php echo $CountryName['ParamC'];?></td>
                                <td><?php echo $CountryName['ParamD'];?></td>
				                <td><?php if($CountryName['ParamE']==1){ ?><img src="<?php echo SiteUrl?>assets/images/tick.gif" style="height: 23px;width: 31px;"><?php }?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Settings/Masters/CountryNames/Manage/Edit/". $CountryName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Settings/Masters/CountryNames/Manage/View/". $CountryName['SoftCode'].".html");?>"><span>View</span></a></td>
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
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    