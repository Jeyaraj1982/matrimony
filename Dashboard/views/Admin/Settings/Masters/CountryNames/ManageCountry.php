<?php 
$page="CountryNames";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
    <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">Manage Country Names</h4>                   
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <button type="submit" class="btn-sm btn-success btn-sm dropdown-toggle border rounded" style="padding:3px 15px" data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
            <a href="<?php echo GetUrl("Settings/Masters/CountryNames/New");?>" class="btn-primary btn-sm border rounded" style="text-decoration: none;"><i class="mdi mdi-plus"></i>Country Name</a>
        </div>
    </div>
     <div class="row" style="margin-bottom:15px;">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageCountry");?>" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
            <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageActiveCountry");?>"><small>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageDeactiveCountry");?>"><small>Deactive</small></a>&nbsp;|&nbsp;
            <a href="<?php echo GetUrl("Settings/Masters/CountryNames/ManageRegisterAllowCountry");?>"><small>Register Country</small></a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                <?php
                    echo $html->th("Code");
                    echo $html->th("Country Names");
                    echo $html->th("STD Code");
                    echo $html->th("Currency");
                    echo $html->th("Substring");
                    echo $html->th("ShortName");
                    echo $html->th("Allow to Register");
                    echo $html->th("");
                ?>
                </tr>
            </thead>   
            <tbody>
                <?php $CountryNames = $webservice->getData("Admin","GetMastersManageDetails"); ?>
                <?php foreach($CountryNames['data']['CountryName'] as $CountryName) { ?>
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
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    $('#myTable_filter input').addClass('form-control input-sm'); 
    $('#myTable_length select').addClass('form-control select-sm'); 
    setTimeout("DataTableStyleUpdate()",500);
});
</script>           
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    