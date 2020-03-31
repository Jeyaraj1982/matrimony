<?php $page="instamajo";
	include_once("settings_header.php");
		?>
<div class="col-sm-10 rightwidget">
    <div class="form-group row">
        <div class="col-sm-3">
            <h4 class="card-title">Manage Instamajo</h4>
            <a href="<?php echo GetUrl("Settings/PaymentGateway/InstaMajo");?>" class="btn btn-primary">Create</a>
        </div>
        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=All");?>"><?php if($_GET['Status']=="All") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>All</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=Active");?>"><?php if($_GET['Status']=="Active") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Active</small></a>&nbsp;|&nbsp;
            <a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=Deactive");?>"><?php if($_GET['Status']=="Deactive") { ?><small style="font-weight:bold;text-decoration:underline;"><?php } else{ ?><small><?php } ?>Deactive</small></a>
        </div>    
    </div> 	
	<div class="table-responsive">
		<table id="myTable" class="table table-striped">
			<thead>  
				<tr> 
				<th>Name</th>
				<th>Client ID</th>
				<th>Mode</th> 
				<th>CreatedOn</th>
				<th></th>
				</tr>  
			</thead>
			<tbody> 
                <?php 
                    if($_GET['Filter']=="InstaMajo"){ 
                            if( $_GET['Status']=="All"){
                                $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"Instamajo"));
                            }
                            if( $_GET['Status']=="Active"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"ActiveInstamajo")); 
                            }
                            if( $_GET['Status']=="Deactive"){
                               $response = $webservice->getData("Admin","GetManagePaymentGateway",array("Request"=>"DeactiveInstamajo")); 
                            }
                        }
                 ?>
				<?php foreach($response['data'] as $Instamajo) { ?>
						<tr>
						<td><span class="<?php echo ($Instamajo['VendorStatus']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Instamajo['VenderName'];?></td>
						<td><?php echo $Instamajo['ClientID'];?></td>
						<td><?php echo $Instamajo['VendorMode'];?></td>
						<td><?php echo  putDateTime($Instamajo['CreatedOn']);?></td>
                        <td style="text-align:right">
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/EditInstamajo/". $Instamajo['PaymentGatewayVendorCode'].".htm");?>"><span>Edit</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/ViewInstamajo/". $Instamajo['PaymentGatewayVendorCode'].".htm");?>"><span>View</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo GetUrl("Settings/PaymentGateway/InstamajoTransactions/". $Instamajo['PaymentGatewayVendorCode'].".htm");?>"><span>Transactions</span></a>
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