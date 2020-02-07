  
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage My Member</h4>
                <div class="form-group row">
                    <div class="col-sm-6">
                       <a href="<?php echo GetUrl("Members/CreateMember");?>" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Member</a>
                        <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                        <ul class="dropdown-menu">
                            <li><a href="#">To Excel</a></li>
                            <li><a href="#">To Pdf</a></li>
                            <li><a href="#">To Htm</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="ManageMembers" ><small>All</small></a>&nbsp;|&nbsp;
                        <a href="ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeactiveMembers"><small>Deactive</small></a>&nbsp;|&nbsp;
                        <a href="ManageDeletedMembers" style="font-weight:bold;text-decoration:underline"><small>Deleted</small></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                            <th>Member Code</th>
                            <th>Member Name</th>
                            <th>Created By</th>
                            <th style="width:100px;">Created</th>
                            <th style="width:50px;"></th>                          
                        </tr>  
                    </thead>
                     <tbody>  
                     <?php 
                         $response = $webservice->getData("Franchisee","GetMyMembers",array("Request"=>"Deleted"));
                         if (sizeof($response['data'])>0) {
                    ?>
                        <?php foreach($response['data'] as $Member) { ?>
                        
                                <tr>
                                    <form method="post" id="frmfrn_<?php echo $Member['MemberCode'];?>">      
                                        <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $Member['MemberCode'];?>">
                                        <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode"> 
                                        <input type="hidden" value="<?php echo session_id() ;?>" name="Session" id="Session"> 
                                        <?php
                                            $txt_a = "";
                                            if ($Member['IsDeleted']==1) {
                                                $txt_a = '<span title="Member: Deleted" data-toggle="tooltip" class="DeletedDot"></span>'; 
                                            } elseif ($Member['IsActive']==1) {
                                                $txt_a = '<span title="Member: Active" data-toggle="tooltip"class="Activedot"></span>'; 
                                            } elseif ($Member['IsActive']==0){
                                                $txt_a = '<span title="Member: Deactivated" data-toggle="tooltip" class="Deactivedot"></span>'; 
                                            }
                                            
                                            if ($Member['Gender']=="Male") {
                                                $txt_a .= '&nbsp;<i class="fa fa-male" data-toggle="tooltip" title="Gender: Male" aria-hidden="true"></i>';
                                            } else {
                                                $txt_a .= '&nbsp;<i class="fa fa-female" data-toggle="tooltip" title="Gender: Female" aria-hidden="true"></i>';
                                            }
                                            $txt_a .= '&nbsp;&nbsp;&nbsp;'.$Member['MemberCode'];
                                            echo $html->td($txt_a);
                                            echo $html->td($Member['MemberName']);
                                            echo $html->td($html->span($Member['CreatedBy'],array("class"=>"btn btn-primary","style"=>"padding: 0px 4px;font-size: 12px;background: #b3d285;border: #b3d285;")));
                                            echo $html->td(putDateTime($Member['CreatedOn']));
                                        ?>
                                        <td style="text-align:right">
                                             <?php if($Member['NoOfProfile']>0) {?>
                                            <a href="<?php echo GetUrl("ViewMemberProfile/".$Member['ProfilesCode'].".htm"); ?>"><span>View</span></a>
                                            <?php if ($Member['IsEditable']==1) { ?>        
                                                &nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Member/".$Member['MemberCode']."/ProfileEdit/GeneralInformation/".$Member['ProfilesCode'].".htm"); ?>"><span>Edit Profile</span></a>
                                            <?php } ?>
                                        <?php } else {?>
                                            <a href="<?php echo GetUrl("CreateProfile/".$Member['MemberCode'].".htm");?>"><span>Create Profile</span></a>&nbsp;&nbsp;  
                                        <?php }  ?>
                                        <a href="javascript:void(0)" onclick="Member.GetTxnPasswordViewMemberEditScreen('<?php echo $Member['MemberCode'];?>')"><span>Edit</span></a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="Member.GetTxnPasswordViewMember('<?php echo $Member['MemberCode'];?>')"><span>View</span></a>
                                        
                                    </form>
                                </tr>
                            
                        <?php } } else {?>            
                        
                        <?php } ?>
                      </tbody>                        
                     </table>
                  </div>
                </div>
              </div>
            </div>
           
 <div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
            
                </div>
            </div>
        </div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    $('[data-toggle="tooltip"]').tooltip({ container: 'body' }); 
    $('#myTable_filter input').addClass('form-control'); 
    $('#myTable_length select').addClass('form-control'); 
    setTimeout("DataTableStyleUpdate()",500);
});
</script>

