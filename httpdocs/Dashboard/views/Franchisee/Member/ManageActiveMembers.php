<form method="post" action="<?php echo GetUrl("Member/CreateMember");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage My Member</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Member</button>
                <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                <ul class="dropdown-menu">
                    <li><a href="#">To Excel</a></li>
                    <li><a href="#">To Pdf</a></li>
                    <li><a href="#">To Htm</a></li>
                </ul>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMembers" ><small >All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small  style="font-weight:bold;text-decoration:underline">Deactive</small></a>
                </div> 
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Names</th>  
                        <th>Created</th>
                        <th>No of Profiles</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php $Members = $mysql->select("select * from _tbl_members where IsActive='1'"); ?>
                        <?php foreach($Members as $Member) { ?>
                                <tr>
                                <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberName'];?></td>
                                <td><?php echo putDateTime($Member['CreatedOn']);?></td>
                                <td></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Member/EditMember/". $Member['MemberID'].".html");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Member/ViewMember/". $Member['MemberID'].".html"); ?>"><span>View</span></a></td>
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

