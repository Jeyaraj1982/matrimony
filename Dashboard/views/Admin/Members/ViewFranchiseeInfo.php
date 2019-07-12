  
<?php
   $response       = $webservice->getData("Admin","GetFranchiseeInfoInFranchiseeWise");
   $Franchisees     = $response['data']['FranchiseeInfo'];
     
?>                                                                           
<script>               
function GetFranchiseeDetails() {
    $.ajax({
        url: "http://nahami.online/sl/Dashboard/webservice.php?fr=Franchisee&fi=GetDetails&Code="+$('#FranchiseeCode').val(), 
        success: function(result){
            
            var $fr = jQuery.parseJSON(result);
            
            
                $('#FranchiseeName').html(obj.FranchiseName);
                $('#MobileNumber').html(obj.ContactNumber);
                $('#CreatedOn').html(obj.CreatedOn); 
                $('#EmailID').html(obj.ContactEmail);
                $('#myModal').modal('show');
                                                                                            
        }});
}

</script>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">                                    
            <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title">Manage Members</h4>
                <h5 class="card-title">Franchiseewise</h5>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                     <h4 class="card-title">Franchisee Information</h4>
                     <div class="form-group row">
                          <label for="Franchisee Code" class="col-sm-2 col-form-label">Franchisee Code:</label>
                          <label for="Franchisee Code" class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisees['FranchiseeCode'];?></label>
                          <label for="State" class="col-sm-2 col-form-label">State:</label>
                          <label for="State" class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisees['StateName'];?></label>
                     </div>
                     <div class="form-group row">
                          <label for="Franchisee Name" class="col-sm-2 col-form-label">Franchisee Name:</label>
                          <label for="Franchisee Name" class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisees['FranchiseName'];?></label>
                          <label for="District" class="col-sm-2 col-form-label">District Name:</label>
                          <label for="District" class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisees['DistrictName'];?></label>
                     </div>
                     <div class="form-group row">
                          <label for="Status" class="col-sm-2 col-form-label">Status:</label>
                          <label for="Status" class="col-sm-3 col-form-label" style="color:#737373;"><span class="<?php echo ($Franchisees['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;
                              <?php if($Franchisees['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";        
                              }
                              ?>
                       </label>
                       <label for="Mobile Number" class="col-sm-2 col-form-label">Mobile Number:</label>
                       <label for="Mobile Number" class="col-sm-3 col-form-label" style="color:#737373;"><?php echo $Franchisees['ContactNumber'];?></label>
                     </div>
                     <button type="button" onclick="GetFranchiseeDetails()" data-toggle="modal" class="btn btn-success mr-2">Franchisee Details</button>
               </div>
          </div>
        </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List of Members</h4>
                <div class="table-responsive">
                <div class="form-group row">
                <div class="col-sm-3">
                          <button type="submit" class="btn btn-success dropdown-toggle"  data-toggle="dropdown">Export</button>
                            <ul class="dropdown-menu">
                            <li><a href="#">To Excel</a></li>
                            <li><a href="#">To Pdf</a></li>                                                                                                        
                            <li><a href="#">To Htm</a></li>
                            </ul></div>
                </div>
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th>Member Name</th>
                        <th>Created </th>            
                        <th></th>
                        </tr>  
                    </thead>
                    <tbody>
                        <?php foreach($response['data']['Member'] as $Member) {    ?>
                        <tr>
                        <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberName'];?></td>
                        <td><?php echo  putDateTime($Member['CreatedOn']);?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/EditMember/". $Member['MemberID'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo GetUrl("Members/ViewMember/". $Member['MemberID'].".htm"); ?>"><span>View</span></a>&nbsp;&nbsp;&nbsp; 
                        <a href="<?php echo GetUrl("Members/ResetPassword/". $Member['MemberID'].".htm"); ?>"><span>Reset Password</span></a>&nbsp;&nbsp;&nbsp; </td>
                        </tr>
                         <?php } ?> 
                      </tbody>                         
                     </table>
                  </div>                          
                </div>
              </div>
            </div>
       &nbsp;&nbsp;&nbsp; <a href="../Franchiseewise"><small>Back to Franchisee wise</small></a>
        </form>   
        
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="" onsubmit="">
                                <div class="col-12 grid-margin">
                                      <div class="card">
                                        <div class="card-body">
                                          <h4 class="card-title" style="padding-top:20px;">Franchisee Information</h4>  
                                          <form class="forms-sample">
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Franchisee Name:</small> </div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="FranchiseeName"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Mobile Number:</small></div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="MobileNumber"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Created On:</small></div>
                                              <div class="col-sm-3"><small style="color:#737373;" id="CreatedOn"></small></div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-sm-3"><small>Email ID:</small></div>
                                              <div class="col-sm-9"><small style="color:#737373;" id="EmailID"></small></div>
                                          </div>
                                      </div>                                                                                                        
                                  </div>
                                </div>  
                                <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                   </div>
              </div>
           </div>
