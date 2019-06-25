<?php
include_once("mpdf.php");
   $mpdf = new mPDF();
   
   $html  = "<div style='background:#f1f1f1;font-size:13px;padding:10px;'>Welcome</div>";
$mpdf->WriteHTML($html);
 
//call watermark content aand image
$mpdf->SetWatermarkText('phpflow.COM');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
 
 
//save the file put which location you need folder/filname
//$mpdf->Output("phpflow.pdf", 'F');
 
 
//out put in browser below output function
$mpdf->Output();
?> 