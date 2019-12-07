<?php 
    include_once("config.php");
    $response = $webservice->getData("Admin","ViewOrderInvoiceReceiptDetails");
    $Receipt=$response['data']['Receipt'];
?>

    
  <div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
                                                                                                              
  <div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Receipt</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td colspan="2">Receipt To</td>
                    <td>Receipt Details</td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $Receipt['MemberName'];?><br>
                        Email  :&nbsp;<?php echo $Receipt['EmailID'];?><br>
                        Mobile :&nbsp;<?php echo $Receipt['MobileNumber'];?>
                    </td>
                    <td>
                        Receipt #&nbsp;:&nbsp;<?php echo $Receipt['ReceiptNumber'];?><br>
                        Receipt Date&nbsp;:&nbsp;<?php echo $Receipt['ReceiptDate'];?><br>
                        Invoice #&nbsp;:&nbsp;<?php echo $Receipt['InvoiceNumber'];?><br>
                    </td>
                </tr>
            </tbody>
         </table>
         <hr style="margin-right: -22px;margin-left: -19px;">
           
                </div>
  </div>
  </div>
</div>
