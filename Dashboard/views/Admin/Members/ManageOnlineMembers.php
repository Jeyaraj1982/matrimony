<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-3">
            <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Manage Members</h4>
            <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">All Members</h5>
            </div>
            <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            </div>    
            </div>
            <div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                  <thead>  
                    <tr> 
                        <th>Member Code</th>
                        <th>Member Name</th>
                        <th style="width:50px;">Franchisee Code</th>
                        <th>Franchisee Name</th>                   
                        <th>Created By</th>
                        <th style="width:100px;">Created</th>
                        <th style="width:50px;"></th>                          
                    </tr>  
                </thead>
                <tbody> 
                    <?php $response = $webservice->getData("Admin","GetManageMembers",array("Request"=>"OnlineMembers")); ?>  
                    <?php foreach($response['data'] as $Member) { ?>
                        <tr>
                        <form method="post" id="frmfrn_<?php echo $Member['MemberCode'];?>">      
                                        <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $Member['MemberCode'];?>">
                                        <input type="hidden" value="<?php echo $Member['MemberCode'];?>" name="MemberCode" id="MemberCode"> 
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
                                echo $html->td($Member['FranchiseeCode']);
                                echo $html->td($Member['FranchiseeName']);
                                echo $html->td($html->span($Member['CreatedBy'],array("class"=>"btn btn-primary","style"=>"padding: 0px 4px;font-size: 12px;background: #b3d285;border: #b3d285;")));
                                echo $html->td(putDateTime($Member['CreatedOn']));
                            ?>
                            <td style="text-align:right">
                                <a href="javascript:void(0)" onclick="Member.GetTxnPasswordViewMemberEditScreen('<?php echo $Member['MemberCode'];?>')"><span>Edit</span></a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="Member.GetTxnPasswordViewMember('<?php echo $Member['MemberCode'];?>')"><span>View</span></a>
                            </td>
                            </form>
                            </tr>
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