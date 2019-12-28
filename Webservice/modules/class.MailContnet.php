<?php       
     
     class MailContent {
         
         function getMailContent($param) {
             global $mysql,$global;
             $data = $mysql->select("select Content,Title from `mailcontent` where `Category`='".$param."'");
             return $data[0];
         }
         
         function getContent($Content,$MemberData,$ProfileData) {
             
             $content  = str_replace("#MemberName#",$MemberData['MemberName'],$Content);
             $content  = str_replace("#ProfileCode#",$ProfileData['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$ProfileData['PersonName'],$content);
             return $content;
         }
         
     }
     
     
 ?>  