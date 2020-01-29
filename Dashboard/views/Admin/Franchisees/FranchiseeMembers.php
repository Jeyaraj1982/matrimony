<?php 
$page="FranchiseeMembers";
include_once("topmenu.php");  
?>
<form method="post" >
    
 <div class="form-group row">
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div style="padding:15px !important;max-width:770px !important;">
                    <div class="card-body">
                        <h4 class="card-title">Manage Members</h4>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Code</th>
                        <th>Member Name</th>
                        <th>Created </th>            
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>
                    <?php
                       $response       = $webservice->getData("Admin","GetFranchiseeInfoInFranchiseeWise");
                    ?>
                        <?php foreach($response['data']['Member'] as $Member) {    ?>
                        <tr>
                        <td><span class="<?php if($Member['IsActive']==1 && $Member['IsDeleted']==0){ echo 'Activedot'; } if($Member['IsActive']==0 && $Member['IsDeleted']==0){ echo 'Deactivedot'; } if($Member['IsDeleted']==1){ echo 'DeletedDot'; }?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberCode'];?></td>
                        <td><?php echo $Member['MemberName'];?></td>
                        <td><?php echo  putDateTime($Member['CreatedOn']);?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/EditMember/". $Member['MemberCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Members/ViewMember/". $Member['MemberCode'].".htm"); ?>"><span>View</span></a></td>
                        </tr>
                         <?php } ?> 
                      </tbody>                         
                     </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
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


                    