<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <h4 class="card-title">Drafted</h4>
                    </div>
                    <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="<?php  echo GetUrl("Drafted?Filter=Draft&Gender=All");?>"><small style="font-weight:bold;text-decoration:underline">Drafted</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Requested?Filter=Post&Gender=All");?>"><small>Submitted to review</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Published?Filter=Publish&Gender=All");?>"><small>Published</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("UnPublished?Filter=UnPublished&Gender=All");?>"><small>UnPublished</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Rejected?Filter=Rejected&Gender=All");?>"><small>Rejected</small></a>
                    </div>
                </div>
                <?php $res = $webservice->getData("Admin","ProfilesBrideGroomCount",array("ProfileFrom"=>"Request")); ?>
                    <div class="form-group row">
                        <div class="col-sm-6" style="padding-top:5px;">
                            <a href="<?php  echo GetUrl("Drafted?Filter=Draft&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Drafted?Filter=Draft&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr> 
                        <th style="width:50px">Member Code</th>  
                        <th>Member Name</th>
                        <th>Profile For</th>
                        <th>Created On</th>
                        <th></th>
                        </tr>                                                                                           
                    </thead>
                     <tbody>
                        <?php 
                            if($_GET['Filter']=="Draft"){ 
                                if( $_GET['Gender']=="All"){
                                    $response = $webservice->getData("Admin","GetDraftedProfiles",array("Request"=>"Draft"));
                                }
                                if( $_GET['Gender']=="Bride"){
                                   $response = $webservice->getData("Admin","GetDraftedProfiles",array("Request"=>"DraftBride")); 
                                }
                                if( $_GET['Gender']=="Groom"){
                                   $response = $webservice->getData("Admin","GetDraftedProfiles",array("Request"=>"DraftGroom")); 
                                }                                                                                                      
                            }
                        ?>  
                        <?php 
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $Profile) { ?>
                                <tr>
                                <td><?php echo $Profile['MemberCode'];?></td>
                                <td><?php echo $Profile['MemberName'];?></td>
                                <td><?php echo $Profile['ProfileFor'];?></td>                                         
                                <td><?php echo putDateTime($Profile['CreatedOn']);?></td>
                                <td><a href="<?php echo GetUrl("Profiles/ViewDraftProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a></td>
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