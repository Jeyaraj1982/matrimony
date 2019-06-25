<form method="post" action="<?php echo GetUrl("Masters/StateNames/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage State Names</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>State Name</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageState" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveState"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveState"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width:64px;">ID</th>  
                          <th style="width:350px;">State Names</th>
                          <th style="width:64px;"></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'"); ?>
                        <?php foreach($StateNames as $StateName) { ?>
                                <tr>
                                <td><span class="<?php echo ($StateName['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $StateName['SoftCode'];?></td>
                                <td><?php echo $StateName['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/StateNames/Manage/Edit/". $StateName['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/StateNames/Manage/View/". $StateName['SoftCode'].".html");?>"><span>View</span></a></td> 
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