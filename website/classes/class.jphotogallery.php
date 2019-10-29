<?php
     class JPhotogallery {
         
         function getPhotoGalleries($id=0) {
             global $mysql;
             return ($id==0) ? $mysql->select("select * from _jphotogallery ") : $mysql->select("select * from _jphotogallery where groupid='".$id."'");
         }
      
         function getActivePhotoGalleries() { 
             global $mysql;
             return $mysql->select("select * from _jphotogallery where ispublished=1");
         }
          
         function getInActivePhotoGalleries() { 
             global $mysql;
             return $mysql->select("select * from _jphotogallery where ispublished=0");
         }
          
         function deletePhotoGallery($galleryid) {
             global $mysql;
             return $mysql->execute("delete from _jphotogallery where groupid='".$galleryid."'");
         }
          
         function updatePhotoGallery($param,$galleryid) {
             global $mysql;
             $sql  = (isset($param['filename'])) ? ", filepath='".$param['filename']."' " : "";
             return $mysql->execute("update _jphotogallery set groupname='".$param["groupname"]."',groupdescription='".$param["groupdescription"]."',ispublished='".$param["ispublished"]."'".$sql." where groupid='".$param['groupid']."'");  
         }
          
         function addPhotoGallery($param) {
             global $mysql; 
             return $mysql->insert("_jphotogallery",array("groupname"=>$param["groupname"],"groupdescription"=>$param["groupdescription"],"ispublished"=>$param["ispublished"],"filepath"=>$param["filename"],"postedon"=>date("Y-m-d H:i:s")));   
         }
          
         function getGalleryImages($galleryid){
             global $mysql;  
             return $mysql->select("select * from _jphotos where groupid='".$galleryid."'");
         }
          
         function getPhotos($photoid=0) {
             global $mysql;
             return ($photoid==0) ? $mysql->select("select * from _jphotos ") : $mysql->select("select * from _jphotos where photoid='".$photoid."'");
         } 
           
         function addPhoto($param){
             global $mysql; 
             return $mysql->insert("_jphotos",array("phototitle"=>$param["phototitle"],"photodescription"=>$param["photodescription"],"photofilepath"=>$param["filename"],"ispublished"=>$param["ispublished"],"groupid"=>$param["groupname"],"postedon"=>date("Y-m-d H:i:s"))); 
         }
         
         function deletePhoto($photoid) {
             global $mysql;
             return $mysql->execute("delete from _jphotos where photoid='".$photoid."'");
         }
         
         function updatePhoto($param,$photoid){
             global $mysql;
             $sql  = (isset($param['filename'])) ? ", photofilepath='".$param['filename']."' " : "";
             return $mysql->execute("update _jphotos set phototitle='".$param["phototitle"]."',photodescription='".$param["photodescription"]."',ispublished='".$param["ispublished"]."'".$sql." where photoid='".$param['photoid']."'");
         }

     }
?>
