<?php $page="ccavenue";	
	include_once("settings_header.php");
	?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage CCavenue</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/CCavenue");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div>
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Marchant ID</th>
				<th>Secret Key</th>                   
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody>
                <?php 
                    if($_GET['Filter']=="CCavenue"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"CCavenue"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActiveCCavenue")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactiveCCavenue")); 
                            }
                        }
                 ?> 
				<?php foreach($response['data'] as $CCavenue) { ?>
						<tr>
						<td><span class="<?php echo ($CCavenue['VendorStatus']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $CCavenue['VenderName'];?></td>
						<td><?php echo $CCavenue['MarchantID'];?></td>
						<td><?php echo $CCavenue['Secretky'];?></td>
						<td><?php echo $CCavenue['VendorMode'];?></td>
						<td><?php echo  putDateTime($CCavenue['CreatedOn']);?></td>
						<td style="text-align:right">
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/EditCcavenue/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewCcavenue/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/CcavenueTransactions/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Transactions</span></a>
                        </td>
						</tr>
				<?php } ?>            
			</tbody>                        
		</table>
    </div>
</div>
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>
<?php include_once("settings_footer.php");?>                    