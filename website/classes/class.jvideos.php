<?php
    class JVideos{
        
        function getVideos($videoid=0) {
            global $mysql;
            return ($videoid==0) ? $mysql->select("select * from _jvideo"): $mysql->select("select * from _jvideo where videoid=".$videoid);
        }
      
        function addVideos($param){
            global $mysql; 
            return $mysql->insert("_jvideo",array("videotitle"=> $param['videotitle'],"videodescription" =>$param['videodescription'],"videourl"=>$param['videourl'],"postedon"=>date("Y-m-d H:i:s"),"lastmodified"=>date("Y-m-d H:i:s"))); 
        }
        
        function deleteVideos($videoid) {
            global $mysql;
            return $mysql->execute("delete from _jvideo where videoid='".$videoid."'");
        }
     
       function updateVideos($param,$videoid) {
           global $mysql;
           return $mysql->execute("update _jvideo set videotitle='".$param['videotitle']."',videodescription='".$param['videodescription']."',videourl='".$param['videourl']."',lastmodified='".date("Y-m-d H:i:s")."' where videoid='".$param['videoid']."'");
       }
       
    }
  
  class youTube {
      
      var $videoData = "";
    
      function youTube($videoid) {
          
          $url = "https://www.youtube.com/oembed?format=json&url=www.youtube.com/watch?v=".$videoid;
          $ch = curl_init($url); 
          curl_setopt($ch, CURLOPT_URL, $url); 
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
          $output = curl_exec($ch); 
          curl_close($ch);  
          $this->videoData =  json_decode($output);
       }
    
        function getTitle() {
            $d = $this->videoData;
            return $d->title;
        }
    
        function getImage() {
            $d = $this->videoData;
            return $d->thumbnail_url;
        }
  }
  
 
?>
