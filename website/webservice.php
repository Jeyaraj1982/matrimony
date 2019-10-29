<?php
    include_once("config.php");
    
    if ($_REQUEST['request']=="faq") {
             if ($_REQUEST['faqstatus']=='y') {
                    $mysql->execute("update _jfaq set isusefulY=isusefulY+1 where faqid=".$_REQUEST['faqId']);
                    $_SESSION['faq'][$_REQUEST['faqId']]=1;
             } else if ($_REQUEST['faqstatus']=="n") {
                     $mysql->execute("update _jfaq set isusefulN=isusefulN+1 where faqid=".$_REQUEST['faqId']); 
                     $_SESSION['faq'][$_REQUEST['faqId']]=1;
             }
             
             $d = $mysql->select("select * from _jfaq where faqid=".$_REQUEST['faqId']);
             
             $p = ( ($d[0]['isusefulY']-$d[0]['isusefulN'])/($d[0]['isusefulY']+$d[0]['isusefulN']) ) * 100;
             
             $_SESSION['faq']['rating']=$p;   
             
           echo  "<div style='width:450px;'><div style='float:left;width:200px;height:15px;background:#f1f1f1;border:1px solid #d5d5d5;border-radius:5px;'>
                    <div style='height:15px;width:".($_SESSION['faq']['rating']*2)."px;background:#7ee572;border:none;border-radius:4px;'></div>
               </div><div style='float:left;padding:1px;'>&nbsp;".number_format($_SESSION['faq']['rating'],2)."%</div></div>
               <br><div  style='clear:both;color:green'>Your suggesstion has been submitted</span>";
               
                                                                     
                
        
    }
?>