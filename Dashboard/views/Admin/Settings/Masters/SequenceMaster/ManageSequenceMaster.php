<?php 
$page="ManageSequenceMaster";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="<?php echo GetUrl("Settings/Masters/SequenceMaster/New");?>" onsubmit="">
    <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Sequence Master</h4>                   
        <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Sequence</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                </div>
                </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th width="30px">ID</th>                                                                          
                    <th>Sequence</th>
                    <th>Prefix</th>
                    <th>String Length</th>
                    <th>Last Number</th>
                    <th width="80px"></th>        
                </tr>
            </thead>            
            <tbody>                      
            <?php $Sequence = $webservice->getData("Admin","GetManageSequenceMaster",array("Request" => "All")); ?>
            <?php foreach($Sequence['data'] as $Sequence) { ?>
                <tr>
                    <td><?php echo $Sequence['SequenceID'];?></td>
                    <td><?php echo $Sequence['SequenceFor'];?></td>
                    <td><?php echo $Sequence['Prefix'];?></td>
                    <td><?php echo $Sequence['StringLength'];?></td>
                    <td><?php echo $Sequence['LastNumber'];?></td>
                    <td style="text-align:right">
                        <a href="<?php echo GetUrl("Settings/Masters/SequenceMaster/Manage/Edit/". $Sequence['SequenceID'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Settings/Masters/SequenceMaster/Manage/View/". $Sequence['SequenceID'].".html");?>"><span>View</span></a>
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