<?php
    class JSuccessStory { 
    
        function getStory($storyid=0,$sql="") {
            global $mysql;
            $sql = ($sql=="") ? "" : " and ".$sql; 
            return ($storyid==0)? $mysql->select("select * from _jsuccessstory where storytype='S' ".$sql) : $mysql->select("select * from _jsuccessstory where storytype='S' and storyid=".$storyid.$sql);
        }
      
        function addStory($param){
            global $mysql; 
            return $mysql->insert("_jsuccessstory",array("storytitle"=>$param['storytitle'],"storydescription"=>$param['storydescription'],"storyname"=>$param['storyname'],"email"=>$param['email'],"mobileno"=>$param['mobileno'],"storytype"=>$param['storytype'],"filepath"=>$param['filename'],"postedon"=>date("Y-m-d H:i:s"),"ispublish"=>$param['ispublish']));   
        }
       
        function getTestimonials($testimonialid=0,$sql=""){
            global $mysql;
            $sql = ($sql=="") ? "" : " and ".$sql;
            return($testimonialid==0) ? $mysql->select("select * from _jsuccessstory where storytype='T' ".$sql) :  $mysql->select("select * from _jsuccessstory where storytype='T' and storyid=".$testimonialid.$sql);
        }
  
        function updateStory($param,$storyid){
            global $mysql;
            $sql = (isset($param['filename'])) ? ",filepath='".$param['filename']."' " : "";
            return $mysql->execute("update _jsuccessstory set storytitle='".$param['storytitle']."',storydescription='".$param['storydescription']."',storyname='".$param['storyname']."',email='".$param['email']."',mobileno='".$param['mobileno']."',ispublish='".$param['ispublish']."',lastmodified='".date("Y-m-d H:i:s")."'".$sql." where storyid='".$param['storyid']."'");
        
        }
       
        function deleteStory($storyid) {
           global $mysql;
           return $mysql->execute("delete from _jsuccessstory where storyid='".$storyid."'");
        }   
   }
?>
