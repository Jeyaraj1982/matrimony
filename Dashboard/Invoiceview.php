<?php 
    include_once("config.php");
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $Invoice=$response['data']['Invoice'];
?>

    
  <div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
                                                                                                              
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">View Invoice</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Invoice Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['InvoiceNumber']; ?></td>
                </tr>
                <tr>
                    <td width="25%">Invoice Date</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo putDateTime($Invoice['InvoiceDate']);?></td>
                </tr>
                <tr>
                    <td width="25%">Order Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['OrderNumber'];?></td>
                </tr>
                <tr>
                    <td width="25%">Order Date</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo putDateTime($Invoice['OrderDate']);?></td>
                </tr>
                <tr>
                    <td width="25%">Member Name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['MemberName'];?></td>
                </tr>
                <tr>
                    <td width="25%">Email ID</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['EmailID'];?></td>
                </tr>
                <tr>
                    <td width="25%">Mobile Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo $Invoice['MobileNumber'];?></td>
                </tr>
                <tr>
                    <td width="25%">Invoice Value</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;<?php echo number_format($Invoice['InvoiceValue'],2);?></td>
                </tr>
               
            </tbody>
         </table>
    </div>
  </div>
</div>
</div>
