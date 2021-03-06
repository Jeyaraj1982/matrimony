<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-3">
            <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Requests</h4>
            <h5 class="card-title" style="font-size: 14px;font-weight: 399; margin-bottom: 10px;Color:#888">Open Request</h5>
            </div>
            <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                <a href="Requests"><small  style="font-weight:bold;text-decoration:underline">Open</small></a>&nbsp;|&nbsp;
                <a href="ActiveRequests"><small>In Proccess</small></a>&nbsp;|&nbsp;
                <a href="DeleteRequests"><small>Closed</small></a>&nbsp;|&nbsp;
            </div>    
            </div>
            <div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                  <thead>  
                    <tr> 
                        <th>Request By code</th>
                        <th>Member Code</th>
                        <th style="width:100px;">Request On</th>
                        <th>Status</th>                          
                        <th style="width:50px;"></th>                          
                    </tr>  
                </thead>
                <tbody> 
                    <?php $response = $webservice->getData("Admin","GetManageRequests",array("Request"=>"Open")); ?>  
                    <?php foreach($response['data'] as $Request) { ?>
                        <tr>
                        <form method="post" id="frmfrn_<?php echo $Request['ReqID'];?>">      
                                        <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $Request['ReqID'];?>">
                                        <input type="hidden" value="<?php echo $Request['ReqCode'];?>" name="ReqID" id="ReqID"> 
                            <?php
                                echo $html->td($Request['RequestByCode']);
                                echo $html->td($Request['MemberCode']);
                                echo $html->td(putDateTime($Request['DeactiveRequestOn']));
                                $txt_a = "";
                                if ($Request['Status']==1) {
                                    $txt_a = 'Open'; 
                                } elseif ($Request['Status']==2) {
                                    $txt_a = 'In Proccess'; 
                                } elseif ($Request['Status']==3){
                                    $txt_a = 'Closed'; 
                                }
                                echo $html->td($txt_a);
                            ?>
                            <td style="text-align:right">
                                <a href="javascript:void(0)" onclick="Member.GetTxnPasswordViewMemberRequest('<?php echo $Request['ReqID'];?>')"><span>View</span></a>
                            </td>
                            </tr>
                         </form>
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