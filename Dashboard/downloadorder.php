<?php
    include("lib/mpdf/mpdf.php");
    
    include_once("config.php");
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $order=$response['data']['Order'];


    $html = '    
<div class="col-12 grid-margin" style="margin-bottom: 25px;">
  <div class="card" style="border: 0;border-radius: 2px;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color:#fff;background-clip: border-box;">
    <div class="card-body" style="padding: 1.88rem 1.81rem;flex: 1 1 auto;">
    <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Order</h4></div>
         </div>
         <table  style="width:100%;color:#555" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td width="25%">Order Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= $order['OrderNumber']; $html .='</td>
                </tr>
                <tr>
                    <td width="25%">Member Name</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= $order['MemberName']; $html .= '</td>
                </tr>
                 <tr>
                    <td width="25%">Email ID</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= $order['EmailID']; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Mobile Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= $order['MobileNumber']; $html .= '</td>
                </tr>
                <tr>
                    <td width="25%">Order Value</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= number_format($order['OrderValue'],2); $html .= '</td>
                </tr>';
                if($order['IsPaid']==1){
                $html .='<tr>
                    <td width="25%">Invoice Number</td>
                    <td colspan="3" style="color:#737373;">:&nbsp;&nbsp;';$html .= $order['InvoiceNumber']; $html .='</td>
                </tr>';
                }
            $html .='</tbody>
         </table>
            </div>
  </div>
</div> ';
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    $mpdf=new mPDF('', 'A4', '', '', 0, 0, 0, 0, 0, 0); 
    $mpdf->WriteHTML($html);
    
    $mpdf->charset_in='UTF-8';
    //$mpdf->SetMargins(0, 0, 65);
    //$mpdf->SetHTMLHeader($pdf_header);
    
    //$mpdf->SetWatermarkText("");
    //$mpdf->showWatermarkText = true;
    //$mpdf->watermarkTextAlpha = 0.1;
            
    //$fname= "assets/pdf/".$data[0]['InvoiceNumber'].'.pdf';
    //$mpdf->SetHTMLFooter($pdf_footer);
    //$mpdf->Output($fname,'F');
    $mpdf->Output();
?> 