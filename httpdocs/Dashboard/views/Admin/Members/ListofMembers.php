<form method="post" action="#" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Members</h4>
                <div class="form-group row">
                <div class="col-sm-3"></div>
                    <!--<div class="col-sm-3">
                        <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>New Franchisee</button> </div>  -->
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMember" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small style="font-weight:bold;text-decoration:underline">Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small style="font-weight:bold;text-decoration:underline">Deactive</small></a>&nbsp;|&nbsp;
                        <a href="Franchiseewise"><small style="font-weight:bold;text-decoration:underline">Franchiseewise</small></a>
                </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Name</th>
                        <th>Franchisee Code</th>
                        <th>Franchisee Name</th>
                        <th>Created</th>
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>  
                        <?php $Members = $mysql->select("select * from _tbl_members"); ?>
                        <?php foreach($Members as $Member) { ?>
                                <tr>
                                <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberName'];?></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $Member['CreatedOn'];?></td>
                                <td style="text-align:right"><a href="<?php echo GetUrl("Members/EditMember/". $Member['MemberID'].".htm");?>"><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Members/ViewMember/". $Member['MemberID'].".htm"); ?>"><span class="glyphicon glyphicon-pencil">View</span></a>&nbsp;&nbsp;&nbsp;
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
<?php/* $Franchisees = $mysql->select("select * from _tbl_Franchisees"); ?>
                        <?php foreach($Franchisees as $Franchisee) { */?>
                         <?php // }  
                        ?>