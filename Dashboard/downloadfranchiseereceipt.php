<?php
    include("lib/mpdf/mpdf.php");
    
    include_once("config.php");
    $response = $webservice->getData("Franchisee","ViewMemberOrderInvoiceReceiptDetails");
    $Receipt=$response['data']['Receipt'];


    $html = '    
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
                    <td colspan="2">';$html .= $Receipt['MemberName']; $html .='<br>
                        Email  :&nbsp;';$html .= $Receipt['EmailID'];$html .='<br>
                        Mobile :&nbsp;';$html .= $Receipt['MobileNumber'];$html .='
                    </td>
                    <td>
                        Receipt #&nbsp;:&nbsp;';$html .= $Receipt['ReceiptNumber'];$html .='<br>
                        Receipt Date&nbsp;:&nbsp;';$html .= $Receipt['ReceiptDate'];$html .='<br>
						Invoice #&nbsp;:&nbsp;';$html .= $Receipt['InvoiceNumber'];$html .='
                    </td>
                </tr>
            </tbody>
         </table>
         <hr style="margin-right: -22px;margin-left: -19px;">
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