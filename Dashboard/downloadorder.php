<?php
    include("lib/mpdf/mpdf.php");
    
    include_once("config.php");
    $response = $webservice->getData("Member","ViewOrderInvoiceReceiptDetails");
    $order=$response['data']['Order'];   
    $Plans= $response['data']['Plan'];  


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
                    <td colspan="2">Order To</td>
                    <td>Order Details</td>
                </tr>
                <tr>
                    <td colspan="2">';$html .= $order['MemberName']; $html .='<br>
                        Email  :&nbsp;';$html .= $order['EmailID'];$html .='<br>
                        Mobile :&nbsp;';$html .= $order['MobileNumber'];$html .='
                    </td>
                    <td>
                        Order #&nbsp;:&nbsp;';$html .= $order['OrderNumber'];$html .='<br>
                        Order Date&nbsp;:&nbsp;';$html .= $order['OrderDate'];$html .='
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
                     <tbody>';
                      foreach($Plans as $Plan) {
                        $html .='<tr>
                            <td>1</td>
                            <td colspan="2">';$html .="Membership Upgrade to ".$Plan['PlanName'];$html .='<br>';$html .=$order['Description'];$html .='</td>
                            <td>1</td>
                            <td style="text-align: right">';$html .=number_format($Plan['Amount'],2);$html .='</td>
                        </tr>';
                      } 
                     $html .='<tr>
                        <td colspan="4" style="text-align:right">Total</td>
                        <td style="text-align:right">';$html .=number_format($Plans[0]['Amount'],2);$html .='</td>
                     </tr>
                     </tbody>
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