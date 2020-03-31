<?php $page="Paypal";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage Paypal</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/Paypal");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePaypal?Filter=Paypal&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePaypal?Filter=Paypal&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePaypal?Filter=Paypal&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div>
	<div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Email ID</th>
				<th>Marchant ID</th>
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
                <?php 
                    if($_GET['Filter']=="Paypal"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Paypal"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActivePaypal")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactivePaypal")); 
                            }
                        }
                 ?> 
				<?php foreach($response['data'] as $Paypal) { ?>
						<tr>
						<td><span class="<?php echo ($Paypal['VendorStatus']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Paypal['VenderName'];?></td>
						<td><?php echo $Paypal['EmailID'];?></td>
						<td><?php echo $Paypal['MarchantID'];?></td>
						<td><?php echo  putDateTime($Paypal['CreatedOn']);?></td>
						<td style="text-align:right">
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/EditPaypal/". $Paypal['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewPaypal/". $Paypal['PaymentGatewayVendorCode'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/PaypalTransactions/". $Paypal['PaymentGatewayVendorCode'].".htm");?>"><span>Transactions</span></a>
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