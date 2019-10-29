<?php
    class JDownloads{
        
        function getDownloadAlbum($id=0) {
            global $mysql;
            return ($id==0) ? $mysql->select("select * from _jdownalbum ") : $mysql->select("select * from _jdownalbum where dalbumid='".$id."'");
        }
            
        function addDownloadAlbum($param){
            global $mysql; 
            return $mysql->insert("_jdownalbum",array("albumtit"=>$param["albumtitle"],"albumdesc"=>$param["albumdescription"],"filepath"=>$param["filename"],"ispublish"=>$param["ispublished"],"postedon"=>date("Y-m-d H:i:s"))); 
        }
   
        function updateDownloadAlbum($param,$albumid) {
            global $mysql;
            $sql  = (isset($param['filename'])) ? ", filepath='".$param['filename']."' " : "";
            return $mysql->execute("update _jdownalbum set albumtit='".$param["albumtitle"]."',albumdesc='".$param["albumdescription"]."',ispublish='".$param["ispublished"]."'".$sql." where dalbumid='".$param['dalbumid']."'");
        }
        
        function deleteDownloadAlbum($albumid) {
            global $mysql;
            return $mysql->execute("delete from _jdownalbum where dalbumid='".$albumid."'");
        }         

        function getAlbumImages($albumid) { 
            global $mysql;
            return $mysql->select("select * from _jdownloads where albumid='".$albumid."'");
        }
        
        function getDownloads($downloadid=0) {
            global $mysql;
            return ($downloadid==0) ? $mysql->select("select * from _jdownloads ") : $mysql->select("select * from _jdownloads where downloadid='".$downloadid."'");
        }       
 
        function addDownloads($param){
            global $mysql; 
            return $mysql->insert("_jdownloads",array("downloadtitle"=>$param["downloadtitle"],"downloaddescription"=>$param["downloaddescription"],"downloadfilepath"=>$param["filename"],"thumbfile"=>$param["thumbfile"],"ispublished"=>$param["ispublished"],"albumid"=>$param["albumid"],"postedon"=>date("Y-m-d H:i:s"))); 
        }
   
        function updateDownloads($param,$downloadid) {
            global $mysql;
            $sql  = (isset($param['filename'])) ? ", downloadfilepath='".$param['filename']."' " : "";
            $tsql = (isset($param['thumbfile'])) ? ", thumbfile='".$param['thumbfile']."' " : "";
            return $mysql->execute("update _jdownloads set downloadtitle='".$param["downloadtitle"]."',downloaddescription='".$param["downloaddescription"]."',ispublished='".$param["ispublished"]."'".$sql."".$tsql." where downloadid='".$param['downloadid']."'");
        }
        
        function deleteDownloads($downloadid) {
            global $mysql;
            return $mysql->execute("delete from _jdownloads where downloadid='".$downloadid."'");
        }

    }
?>
