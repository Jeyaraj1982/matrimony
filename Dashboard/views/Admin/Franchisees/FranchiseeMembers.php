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
                                echo $html->td(putDateTime($Member['CreatedOn']));
                            ?>
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
    $('[data-toggle="tooltip"]').tooltip({ container: 'body' }); 
    $('#myTable_filter input').addClass('form-control'); 
    $('#myTable_length select').addClass('form-control'); 
    setTimeout("DataTableStyleUpdate()",500);
});
</script>    


                    