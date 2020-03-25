<?php $page="paytm";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage Paytm</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/PayTm");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayTm?Filter=Paytm&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayTm?Filter=Paytm&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayTm?Filter=Paytm&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div>
    <div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Payu Biz Name</th>
				<th>Marchant ID</th>
				<th>Website</th>
				<th>Identity</th>
				<th>Channel</th>
				<th>Secret Key</th>                   
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
                <?php 
                    if($_GET['Filter']=="Paytm"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Paytm"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActivePaytm")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactivePaytm")); 
                            }
                        }
                 ?> 
				<?php foreach($response['data'] as $Paytm) { ?>
						<tr>
						<td><span class="<?php echo ($Paytm['VendorStatus']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Paytm['VenderName'];?></td>
						<td><?php echo $Paytm['MarchantID'];?></td>
						<td><?php echo $Paytm['WebsiteName'];?></td>
						<td><?php echo $Paytm['Identity'];?></td>
						<td><?php echo $Paytm['Channel'];?></td>
						<td><?php echo $Paytm['Secretky'];?></td>
						<td><?php echo $Paytm['VendorMode'];?></td>
						<td><?php echo  putDateTime($Paytm['CreatedOn']);?></td>
						<td style="text-align:right">
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/EditPaytm/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewPaytm/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/PaytmTransactions/". $Payu['PaymentGatewayVendorCode'].".htm");?>"><span>Transactions</span></a>
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