<?php 
    include_once("config.php");
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $order=$response['data']['Order'];
    $Plans= $response['data']['Plan'];
?>

    
  <div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
                                                                                                              
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Order</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td colspan="2">Order To</td>
                    <td>Order Details</td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $order['MemberName'];?><br>
                        Email  :&nbsp;<?php echo $order['EmailID'];?><br>
                        Mobile :&nbsp;<?php echo $order['MobileNumber'];?>
                    </td>
                    <td>
                        Order #&nbsp;:&nbsp;<?php echo $order['OrderNumber'];?><br>
                        Order Date&nbsp;:&nbsp;<?php echo $order['OrderDate'];?>
                    </td>
                </tr>
            </tbody>
         </table>
         <hr style="margin-right: -22px;margin-left: -19px;">
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Sl No</td>
                            <td colspan="2">Particulars</td>
                            <td>Qty</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                     <tbody>
                    <?php   foreach($Plans as $Plan) {      ?>
                       <tr>
                            <td>1</td>
                            <td colspan="2"><?php echo "Membership Upgrade to ".$Plan['PlanName'];?><br><?php echo $order['Description'];?></td>
                            <td>1</td>
                            <td style="text-align: right"><?php echo number_format($Plan['Amount'],2)?></td>
                        </tr>
                   <?php   }     ?>
                     <tr>
                        <td colspan="4" style="text-align:right">Total</td>
                        <td style="text-align:right"><?php echo number_format($Plans[0]['Amount'],2);?></td>
                     </tr>
                     </tbody>
                </table>
                </div>
  </div>
  </div>
</div>
