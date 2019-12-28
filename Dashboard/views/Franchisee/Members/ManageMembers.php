  <form method="post" action="<?php echo GetUrl("Members/CreateMember");?>" onsubmit="">      
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
                        <a href="ManageMembers" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small>Deactive</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeletedMembers"><small>Deleted</small></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Code</th>  
                        <th>Member Names</th>  
                        <th>Created</th>
                        <th>No of Profiles</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                     <?php 
                         $response = $webservice->getData("Franchisee","GetMyMembers",array("Request"=>"All"));
                         if (sizeof($response['data'])>0) {
                    ?>
                        <?php foreach($response['data'] as $Member) { ?>
                                <tr>
                                <td><?php echo $Member['MemberCode'];?></td>
                                <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberName'];?></td>
                                <td><?php echo putDateTime($Member['CreatedOn']);?></td>
                                <td></td>
                                <td style="text-align:right">
                                     <?php if($Member['NoOfProfile']>0) {?>
                                    <a href="<?php echo GetUrl("ViewMemberProfile/".$Member['ProfilesCode'].".htm"); ?>"><span>View</span></a>
                                    <?php if ($Member['IsEditable']==1) { ?>        
                                        &nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Member/".$Member['MemberCode']."/ProfileEdit/GeneralInformation/".$Member['ProfilesCode'].".htm"); ?>"><span>Edit Profile</span></a>
                                    <?php } ?>
                                <?php } else {?>
                                    <a href="<?php echo GetUrl("CreateProfile/".$Member['MemberCode'].".htm");?>"><span>Create</span></a>  
                                <?php }  ?>
                                <a href="javascript:void(0)" onclick="ConfirmationfrEdit('<?php echo $Member['MemberID'];?>')"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo GetUrl("Members/ViewMember/".$Member['MemberID'].".html"); ?>"><span>View</span></a></td>
                                </tr>
                        <?php } } else {?>            
                        
                        <?php } ?>
                      </tbody>                        
                     </table>
                  </div>
                </div>
              </div>
            </div>
        </form>   
 <div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 300px;min-height: 300px;" >
            
                </div>
            </div>
        </div>
 <script>
 function ConfirmationfrEdit(MemberID) {
    $('#PubplishNow').modal('show'); 
      var content = '<div class="modal-header">'
                        + '<h4 class="modal-title">Confirmation for Edit</h4>'
                        + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                    + '</div>'
                    + '<div class="modal-body">'
                        +'<div class="col-sm-12">Are you sure want to Edit</div>'
                    + '</div>' 
                    + '<div class="modal-footer">'
                        + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                        + '<a href="'+AppUrl+'Members/EditMember/'+MemberID+'.html" class="btn btn-primary" name="Create" class="btn btn-primary" style="font-family:roboto;color:white">Yes</a>'
                    + '</div>';
            $('#Publish_body').html(content);
     
     }
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>

