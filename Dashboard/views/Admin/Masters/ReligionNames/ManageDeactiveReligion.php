<form method="post" action="<?php echo GetUrl("Masters/ReligionNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Religion Names</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Religion Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
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
                         <?php $ReligionNames = $webservice->GetManageDeactiveReligionNames(); ?>
                        <?php foreach($ReligionNames['data'] as $ReligionName) { ?>
                                <tr>
                                <td><span class="<?php echo ($ReligionName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $ReligionName['SoftCode'];?></td>
                                <td><?php echo $ReligionName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/ReligionNames/Manage/Edit/". $ReligionName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/ReligionNames/Manage/View/". $ReligionName['SoftCode'].".html");?>"><span>View</span></a></td>
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
