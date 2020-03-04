<?php 
    $page="OpenTickets";
    include_once("service_request_to_menu.php");
?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Open Tickets</h4>
			<div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                  <thead>  
                    <tr> 
                        <th>Request By code</th>
                        <th style="width:100px;">Request On</th>
                        <th>Status</th>                          
                        <th style="width:50px;"></th>                          
                    </tr>  
                </thead>
                <tbody> 
                    <?php $response = $webservice->getData("Franchisee","GetManageServiceRequests",array("Request"=>"Open")); ?>  
                    <?php foreach($response['data'] as $Request) { ?>
                        <tr>
                            <?php
                                echo $html->td($Request['RequestByCode']);
                                echo $html->td(putDateTime($Request['RequestOn']));
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
                                <a href="<?php echo GetUrl("Support/Service/ViewOpenTickets/".$Request['ReqCode'].".htm");?>"><span>View</span></a>
                            </td>
                            </tr>
                    <?php } ?>            
                  </tbody>                        
                 </table>                                                                              
              </div>
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
		