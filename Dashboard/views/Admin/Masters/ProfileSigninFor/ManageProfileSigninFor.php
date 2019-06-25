<form method="post" action="<?php echo GetUrl("Masters/ProfileSigninFor/New");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Manage Profile Signin For</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-plus"></i>Profile Signin For</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ManageProfileSigninFor" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ManageActiveProfileSigninFor"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                    <a href="ManageDeactiveProfileSigninFor"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" width="100%">
                      <thead>
                        <tr>
                          <th width="30px">Code</th>  
                          <th style="width:100px">Profile Signin For</th>
                          <th width="30px"></th> 
                        </tr>
                      </thead>
                      <tbody>  
                        <?php $ProfileSigninFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN'"); ?>
                        <?php foreach($ProfileSigninFors as $ProfileSigninFor) { ?>
                                <tr>
                                <td><span class="<?php echo ($ProfileSigninFor['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php echo $ProfileSigninFor['SoftCode'];?></td>
                                <td><?php echo $ProfileSigninFor['CodeValue'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Masters/ProfileSigninFor/Manage/Edit/". $ProfileSigninFor['SoftCode'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Masters/ProfileSigninFor/Manage/View/". $ProfileSigninFor['SoftCode'].".html");?>"><span>View</span></a></td>
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
