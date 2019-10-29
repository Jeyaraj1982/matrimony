<?php

    class JFaq {
        
        function getFaq($faqid=0) { 
            global $mysql; 
            return ($faqid==0) ? $mysql->select("select * from _jfaq"): $mysql->select("select * from _jfaq where faqid=".$faqid);        
        }
      
        function addFaq($param){
            global $mysql; 
            return $mysql->insert("_jfaq",array("faqquestion"=>$param["faqquestion"],"faqanswer"=>$param["faqanswer"],"ispublished"=>$param["ispublished"],"postedon"=>date("Y-m-d H:i:s"))); 
        }
       
        function updateFaq($param,$faqid) {
            global $mysql;
            return $mysql->execute("update _jfaq set faqquestion='".$param["faqquestion"]."',faqanswer='".$param["faqanswer"]."',ispublished='".$param["ispublished"]."' where faqid='".$param["faqid"]."'");
        }
       
        function deleteFaq($faqid){
            global $mysql;
            return $mysql->execute("delete from _jfaq where faqid='".$faqid."'");
       } 
  }
?>
