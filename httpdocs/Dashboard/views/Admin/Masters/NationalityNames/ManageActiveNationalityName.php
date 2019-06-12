<form method="post" action="<?php echo GetUrl("Masters/NationalityNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Nationality Names</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Nationality</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageNationalityName" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveNationalityName"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveNationalityName"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>  
                          <th>Nationality Names</th>
                          <th></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $NationalityNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and IsActive='1'"); ?>
                        <?php foreach($NationalityNames as $NationalityName) { ?>
                                <tr>
                                <td><span class="<?php echo ($NationalityName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $NationalityName['SoftCode'];?></td>
                                <td><?php echo $NationalityName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/NationalityNames/Manage/Edit/". $NationalityName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/NationalityNames/Manage/View/". $NationalityName['SoftCode'].".html");?>"><span>View</span></a></td> 
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