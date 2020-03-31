<?php $page="Payu";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage Payu</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/Payu");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div>
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Payu Biz Name</th>
				<th>Marchant ID</th>
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
				<?php 
                    if($_GET['Filter']=="Payu"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Payu"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActivePayu")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactivePayu")); 
                            }
                        }
                 ?>  
				<?php foreach($response['data'] as $Payu) { ?>
						<tr>
						<td><span class="<?php echo ($Payu['VendorStatus']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Payu['VenderName'];?></td>
						<td><?php echo $Payu['MarchantID'];?></td>
						<td><?php echo $Payu['VendorMode'];?></td>
						<td><?php echo  putDateTime($Payu['CreatedOn']);?></td>
						<td style="text-align:right">
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/EditPayu/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewPayu/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/PayuTransactions/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Transactions</span></a>
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