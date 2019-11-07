<?php
    include("lib/mpdf/mpdf.php");
    
    include_once("config.php");
    $response = $webservice->getData("Member","GetFullProfileInformation",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo         = $response['data']['ProfileInfo'];
    $Member              = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation  = $response['data']['PartnerExpectation'];


    $html = '    
<div style="width:800px;background:#f2f8f9;padding: 10px 30px;margin:0px auto;font-family: arial;">
    <div class="col-12 grid-margin" style="margin-bottom:5px">
        <div class="card" style="background: none;">
            <div class="card-body" style="padding: 0px;background: none;">
                <div class="form-group row" style="background: none;">  
                    <div class="col-sm-8 col-form-label" style="background: none;">
                        <div class="form-group row" >                                       
                            <label class="col-sm-12 col-form-label" style="background: none;color: #222;font-size:24px;font-weight:bold;">';
                                $html .= strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A ";
                                $html .= '&nbsp;(';
                                if((strlen(trim($ProfileInfo['Age'])))>0) { 
                                    $html .= trim($ProfileInfo['Age']). ' Yrs ';
                                }
                               $html .=' ) 
                            </label>
                            <label class="col-sm-12 col-form-label" style="background: none;color: #333;font-size: 14px;padding: 0px 16px;color: #666;">';
                                
                                $html .= strlen(trim($ProfileInfo['ProfileCode']))> 0 ? trim($ProfileInfo['ProfileCode']) : "N/A "; 
                                $html .= '&nbsp;&nbsp;|&nbsp;&nbsp;::ProfileCreatedFor::
                            </label>
                         </div>
                    </div>
                    <div class="col-sm-4"  style="text-align:right">
                    
                    </div>
                </div>
            </div>
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