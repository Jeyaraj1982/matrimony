<form method="post" action="<?php echo GetUrl("Profile/CreateProfile");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Profile</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Profile</button>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="All" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="Posted"><small style="font-weight:bold;text-decoration:underline">Posted</small></a>&nbsp;|&nbsp;
                    <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a>&nbsp;|&nbsp;
                    <a href="Expired"><small style="font-weight:bold;text-decoration:underline">Expired</small></a>&nbsp;|&nbsp;
                    <a href="#"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>
                </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Profile ID</th>  
                        <th>Profile Name</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php $Profiles = $mysql->select("select * from _tbl_Profile_Draft"); ?>
                        <?php foreach($Profiles as $Profile) { ?>
                                <tr>
                                <td><span class="<?php echo ($Profile['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Profile['ProfileID'];?></td>
                                <td><?php echo $Profile['ProfileName'];?></td>
                                <td><?php echo $Profile['CreatedOn'];?></td>
                                <td><?php echo $Profile['Status'];?></td>
                                <td><a href="<?php echo GetUrl("Profile/Edit/". $Profile['ProfileID'].".htm?msg=1");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Profile/View/". $Profile['ProfileID'].".htm?msg=1");?>"><span class="glyphicon glyphicon-pencil">View</span></a>&nbsp;&nbsp;&nbsp;
                                </td>
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