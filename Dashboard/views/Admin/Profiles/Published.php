<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                        <div class="col-sm-6">
                        <h4 class="card-title">Published</h4>
                        </div>
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="Drafted"><small>Drafted</small></a>&nbsp;|&nbsp;
                            <a href="Requested"><small>Requested</small></a>&nbsp;|&nbsp;
                            <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a>&nbsp;|&nbsp;
                            <a href="UnPublished"><small>UnPublished</small></a>&nbsp;|&nbsp;
                            <a href="Rejected"><small>Rejected</small></a>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th style="width:50px">Member Code</th>  
                        <th>Published On</th>
                        <th>Member Name</th>
                        <th>Profile Name</th>
                        <th>Plan</th>
                        <th>Expire On</th>
                        <th></th>
                        </tr>  
                    </thead>
                     <tbody>  
                        <?php 
                         $response = $webservice->getData("Admin","GetPublishedProfiles",array("Request"=>"Publish"));                        
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $Profile) { ?>
                                <tr>
                                <td><?php echo $Profile['MemberCode'];?></td> 
                                <td><?php echo $Profile['ApprovedOn'];?></td>
                                <td><?php echo $Profile['MemberName'];?></td>
                                <td><?php echo $Profile['ProfileName'];?></td> 
								<td></td>								
                                <td><?php //echo putDateTime($Profile['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Profiles/ViewPublishProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a></td>
                                </tr>
                        <?php }} ?>                                                                                    
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