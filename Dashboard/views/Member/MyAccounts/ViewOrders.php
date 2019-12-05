<?php
    $page="MyOrders";
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails"); 
    $order=$response['data']['Order'];      
   $Plans= $response['data']['Plan'];      

if (isset($_POST['Continue'])) {
      $response = $webservice->getData("Member","ViewOrders",array("Code"=>$_GET['Code']));
   $Oreders= $response['data']['Order'];
       
            echo "<script>location.href='../../ChoosePaymentMode/".$Oreders['OrderNumber'].".htm'</script>";   
    } 
    ?>
<?php include_once("accounts_header.php");?>
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">View Order</h4> 
        <div style="width:770px;border:1px solid #737373;padding: 10px 20px;">
                                    <div class="from-group row" style="margin-bottom: -10px;">
                                        <label class="col-sm-6 col-form-label" style="color:#737373;">Order To&nbsp;</label>
                                        <label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">Order Details&nbsp;</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" style="color:#737373;">
                                            <?php echo $order['MemberName'];?><br><br>
                                            Email  :&nbsp;<?php echo $order['EmailID'];?><br><br>
                                            Mobile :&nbsp;<?php echo $order['MobileNumber'];?>
                                        </label>
                                        <label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">
                                            Order #&nbsp;:&nbsp;<?php echo $order['OrderNumber'];?><br><br>
                                            Order Date&nbsp;:&nbsp;<?php echo $order['OrderDate'];?><br>
                                        </label>
                                    </div>
                                    <hr style="margin-right: -22px;margin-left: -19px;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Sl No</td>
                                                <td>Particulars</td>
                                                <td>Qty</td>
                                                <td>Amount</td>
                                            </tr>
                                        </thead>
                                         <tbody>
                                         <?php foreach($Plans as $Plan) {?>
                                            <tr>
                                                <td>1</td>
                                                <td><?php echo "Membership Upgrade to ".$Plan['PlanName'];?><br><?php echo $order['Description'];?></td>
                                                <td>1</td>
                                                <td style="text-align: right"><?php echo number_format($Plan['Amount'],2);?></td>
                                            </tr>
                                         <?php } ?>
                                         <tr>
                                            <td colspan="3" style="text-align:right">Total</td>
                                            <td style="text-align:right"><?php echo number_format($Plans[0]['Amount'],2);?></td>
                                         </tr>
                                         </tbody>
                                    </table>
                                   <?php if($order['IsPaid']==0 && $order['IsCancelled']==0) {?> 
                                    <div class="form-group row">
                                        <div class="col-sm-12" style="text-align: right;">
                                            <form method="post" action="" onsubmit="">
                                                <input type="hidden" name="OrderNumber" value="<?php echo $order['OrderNumber'];?>">
                                                <button type="submit" name="Continue" class="btn btn-primary" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Pay Now</button>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $Order['OrderNumber'];?>')" name="Cancel" class="btn btn-danger" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Cancel</a>&nbsp;&nbsp; 
                                            </form>  
                                        </div>
                                    </div>
                                    <?php }?>
                                    <?php if($order['IsPaid']==1){?>
                                    <div class="form-group row">
                                        <div class="col-sm-12" style="text-align: right;">
                                            Invoice Number : <?php echo $order['InvoiceNumber'];?>   
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                               
     <div class="form-group row">                                                                                                                                                                                             
            <label class="col-sm-6 col-form-label"><a href="<?php echo GetUrl("MyAccounts/MyOrders");?>">List Of Orders</a></label>                       
            <div class="col-sm-6 col-form-label" style="text-align: right"><a href="<?php echo GetUrl("DownloadOrder/".$order['OrderNumber'].".pdf");?>"><i class="menu-icon mdi mdi-download" style="font-size: 15px;color: purple;"></i><label style="background:none;cursor:pointer">Download</label></a> </div>                       
        </div>  
    </div>
<?php include_once("accounts_footer.php");?>                    

                 

 