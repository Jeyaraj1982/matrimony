<?php
    class JPages {
        
        function getPages($pageid=0,$sql="") {
            global $mysql;
            $sql = ($sql=="") ? "" : " and ".$sql;  
            return ($pageid==0) ? $mysql->select("select * from _jpages where pagetype='P' ".$sql) : $mysql->select("select * from _jpages where pagetype='P' and pageid=".$pageid.$sql);
        } 
        
        function addPage($param){
            global $mysql; 
            if ($param['ishomepage']==1) {
                $mysql->execute("update _jpages set ishomepage=0 where pagetype='P'");
            }
            if ( ($param['pagetype']=='E') || ($param['pagetype']=='N') ) {
                $param['ishomepage']=0;
            } 
            
           
            $pagefilename = String2FileName($param['pagetitle']);
             
            $param['pagetitle'] = str_replace("'","\'",$param['pagetitle']);    
            $param['pagetitle'] = str_replace('"','\"',$param['pagetitle']);    
            $param['pagetitle'] = str_replace('$','\$',$param['pagetitle']);  
            
            $param['pagedescription'] = str_replace("'","\'",$param['pagedescription']);    
            $param['pagedescription'] = str_replace('"','\"',$param['pagedescription']);    
            $param['pagedescription'] = str_replace('$','\$',$param['pagedescription']); 
       
            return $mysql->insert("_jpages",array("pagetitle"=> $param['pagetitle'],"pagedescription" => $param['pagedescription'],"pagetype"=> $param['pagetype'],"filepath"=> $param['filename'],"postedon" => date("Y-m-d H:i:s"),"lastmodified"=> date("Y-m-d H:i:s"),"eventtime"=> ($param['pagetype']=='E') ? $param['eventtime'] : 'Null',"ispublish"=> $param['ispublish'],"ishomepage"=>$param['ishomepage'],"keywords"=>$param['keywords'],"description"=>$param['description'],"pagefilename"=>$pagefilename)); 
               }
       
        public static function updatePage($param,$pageid=""){
            global $mysql;

            if ($param['ishomepage']==1) {
                $mysql->execute("update _jpages set ishomepage=0 where pagetype='P'");
            }
            $pagefilename = String2FileName($param['pagetitle']);
            
            $param['pagetitle'] = str_replace("'","\'",$param['pagetitle']);    
            $param['pagetitle'] = str_replace('"','\"',$param['pagetitle']);    
            $param['pagetitle'] = str_replace('$','\$',$param['pagetitle']);  
            
            $param['pagedescription'] = str_replace("'","\'",$param['pagedescription']);    
            $param['pagedescription'] = str_replace('"','\"',$param['pagedescription']);    
            $param['pagedescription'] = str_replace('$','\$',$param['pagedescription']);   
            
            $sql = (isset($param['filename'])) ? ", filepath='".$param['filename']."' " : "";
            return $mysql->execute("update _jpages set pagefilename='".$pagefilename."', pagetitle='".$param['pagetitle']."',pagedescription='".$param['pagedescription']."',ispublish='".$param['ispublish']."',ishomepage='".$param['ishomepage']."',keywords='".$param['keywords']."',description='".$param['description']."',lastmodified='".date("Y-m-d H:i:s")."'".$sql." where pageid='".$param['pageid']."'");
        }
       
        function getNews($newsid=0,$sql="") {
            global $mysql;
            $sql = ($sql=="") ? "" : " and ".$sql;
            return ($newsid==0) ? $mysql->select("select * from _jpages where pagetype='N'".$sql): $mysql->select("select * from _jpages where pagetype='N' and pageid=".$newsid.$sql);
        }
      
        function getEvents($eventid=0,$sql="") {
            global $mysql;
            $sql = ($sql=="") ? "" : " and ".$sql;
            return ($eventid==0) ? $mysql->select("select * from _jpages where pagetype='E' ".$sql):  $mysql->select("select * from _jpages where pagetype='E' and pageid=".$eventid.$sql);       
        }
        
        function deletePage($pageid) {
            global $mysql;
            return $mysql->execute("delete from _jpages where pageid='".$pageid."'");
        }

    }
?>