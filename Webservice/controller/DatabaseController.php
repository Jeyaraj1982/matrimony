<?php

	class MySql {
        
        var $link; 
        var $dbName = "";
        var $qry    = "";
        
        function MySql($dbHost,$dbUser,$dbPass,$dbName){
            $this->dbName = $dbName;
            $this->link = mysql_connect($dbHost,$dbUser,$dbPass) or die("Error");
        }
        
        function select($sql,$ass=false) {
            
            mysql_select_db($this->dbName,$this->link);

            $resultData = array();
            $result     = mysql_query($sql,$this->link);
            
            if ($ass) {
                return mysql_fetch_assoc($result); 
            }
            
            if ($result) { 
                
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_assoc($result)) {
                        $resultData[]=$row;
                    }
                    mysql_free_result($result);  
                }
            }
            
            return $resultData;
        }
        
        function execute($sql) {
            
            $this->qry = $sql;
            mysql_select_db($this->dbName,$this->link);
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows();
        }
        
        function insert($tableName,$rowData) {
            
            $r = "insert into `".$tableName."` (";
            $l = " values (";
            foreach($rowData as $key => $value) {
                $r.="`".$key."`,";
                if ($value=="Null") {
                    $l.="Null,";
                } else {
                    $l.="'".$value."',";    
                }
                
            }
            $r = substr($r,0,strlen($r)-1).")";
            $l = substr($l,0,strlen($l)-1).")";
            $sql = $r.$l;
            
            mysql_select_db($this->dbName,$this->link);

            $this->qry=$sql;  
            mysql_query($this->qry,$this->link) ;
            return mysql_insert_id($this->link);
        }
        
         function update($tableName,$rowData,$where) {
            
            $r = "update `".$tableName."` set ";
 
            foreach($rowData as $key => $value) {
                $r.="`".$key."`='".$value."',";
            }
            $r = substr($r,0,strlen($r)-1);
            $sql = $r." where ".$where;
            
            mysql_select_db($this->dbName,$this->link);
            $this->qry=$sql;  
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows($this->link);
        }
        
        function dbClose() {
            mysql_close($this->link);
        }
    }
   

?>